<?php
    
namespace App\Http\Controllers\Api;
    
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseHelper;
use App\Models\CalendarCategories;
use App\Models\User;
use App\Models\Calendar;
use App\Http\Controllers\Controller;
use App\Http\Requests\Calendar\StoreRequest;
use Exception;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
    
class CalendarController extends Controller
{  
    /**
     * @var App\Helpers\ResponseHelper
     */
    private $response;

    /**
     * Create a new controller instance.
     *
     * @param App\Helpers\ResponseHelper $response
     * 
     * @return void
     */
    public function __construct(
        ResponseHelper $response
    ) {
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        try {
            $userId = Auth::user()->id;
            $query = Calendar::with('attendees', 'category')->where(['status' => 1, 'user_id' => $userId]);
            $search = $request->input('search') ? strtolower($request->input('search')) : null;
            if ((!is_null($request->search))) {            
                $query->where('title', 'like', '%' . $search . '%');            
            }
            if ((!is_null($request->category))) {  
                $category = explode(',', $request->category);  
                $categoryArray = [];
                foreach ($category as $cat) {
                    $category = CalendarCategories::where('name', $cat)->first('id');
                    $categoryArray[] = $category->id;
                }
                $query->whereIn('category_id', $categoryArray);
            }
            $calendar = $query->get();

            // Get calendar's data
            $query1 = Calendar::with('attendees', 'category')->where(['status' => 1]);
            $search = $request->input('search') ? strtolower($request->input('search')) : null;
            if ((!is_null($request->search))) {            
                $query1->where('title', 'like', '%' . $search . '%');            
            }
            if ((!is_null($request->category))) {  
                $category = explode(',', $request->category);  
                $categoryArray = [];
                foreach ($category as $cat) {
                    $category = CalendarCategories::where('name', $cat)->first('id');
                    $categoryArray[] = $category->id;
                }
                $query1->whereIn('category_id', $categoryArray);
            }
            $query1->whereHas('attendees',function (Builder $q) use ($userId) {
                return $q->where('attendee_id', $userId);
             })->get();

            $attendeeCalendar = $query1->get();

            $calendarData = array_merge($attendeeCalendar->toArray(), $calendar->toArray());

            $category = CalendarCategories::pluck('id', 'name');

            $deadlinesCount = Calendar::where(['status' => 1, 'user_id' => Auth::user()->id, 'category_id' => $category['Deadline']])->get()->count();
            $deadlinesAttendeeCount = Calendar::where(['status' => 1, 'category_id' => $category['Deadline']])->whereHas('attendees',function (Builder $q) use ($userId) {
                return $q->where('attendee_id', $userId);
             })->get()->count();
            $meetingsCount = Calendar::where(['status' => 1, 'user_id' => Auth::user()->id, 'category_id' => $category['Meeting']])->get()->count();
            $meetingsAttendeeCount =  Calendar::where(['status' => 1, 'category_id' => $category['Deadline']])->whereHas('attendees',function (Builder $q) use ($userId) {
                return $q->where('attendee_id', $userId);
             })->get()->count();
            $eventsCount = Calendar::where(['status' => 1, 'user_id' => Auth::user()->id, 'category_id' => $category['Event']])->get()->count();
            $eventsAttendeeCount = Calendar::where(['status' => 1, 'category_id' => $category['Event']])->whereHas('attendees',function (Builder $q) use ($userId) {
                return $q->where('attendee_id', $userId);
             })->get()->count();

            $response['calendar'] = $calendarData;
            $response['deadlines_count'] = $deadlinesCount + $deadlinesAttendeeCount;
            $response['meetings_count'] = $meetingsCount + $meetingsAttendeeCount;
            $response['events_count'] = $eventsCount + $eventsAttendeeCount;

            // Set response data
            $apiMessage = (!$calendar) ? 'No records found' : 'Calendar events list';
            return $this->response->success($apiMessage, $response);
        } catch (Exception $e) {
            return $this->response->error(
                $e->getMessage()
            );
        }
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function attendees()
    {
        try {
            $users = User::select('id', 'name')->where('id', '<>', Auth::user()->id)->where('is_admin', 0)->get();

            // Set response data
            $apiMessage = ($users->isEmpty()) ? 'No records found' : 'Attendees list';
            return $this->response->success($apiMessage, $users->toArray());
        } catch (Exception $e) {
            return $this->response->error(
                $e->getMessage()
            );
        }
    }

    // StoreRequest
    public function saveCalendar(StoreRequest $request) 
    {
        try {

            // if (!$request->all_day) {
                // change date format as required
                $startDateTime =  Carbon::createFromFormat('m/d/Y h:i A', $request->start_date_time)->format('Y-m-d H:i:s');
                $endDateTime =  Carbon::createFromFormat('m/d/Y h:i A', $request->end_date_time)->format('Y-m-d H:i:s');
            // }
            $calendar = new Calendar;

            $calendar->user_id = Auth::user()->id;       
            $calendar->title = $request->title;
            $calendar->category_id = $request->category_id;
            $calendar->all_day = $request->all_day;
            
            // if (!$request->all_day) {
                $calendar->start_date_time = $startDateTime;
                $calendar->end_date_time = $endDateTime;
            // }
            $calendar->save();

            $calendar->attendees()->sync($request->attendees, false);

            // Set response data
            $apiMessage = 'Calendar details saved successfully';            
            return $this->response->success($apiMessage, [$calendar]);
        } catch (Exception $e) {
            return $this->response->error(
                $e->getMessage()
            );
        }
    }

}
