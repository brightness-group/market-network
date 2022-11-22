<?php
    
namespace App\Http\Controllers\Api;
    
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseHelper;
use Exception;
use App\Models\CalendarCategories;
use App\Models\Calendar;
use App\Http\Controllers\Controller;
use Auth;
    
class CalendarCategoryController extends Controller
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
    public function index()
    {
        try {
            $categories = CalendarCategories::where('status', 1)->get();

            // Set response data
            $apiMessage = (!$categories) ? 'No records found' : 'Category list';
            return $this->response->success($apiMessage, $categories->toArray());
        } catch (Exception $e) {
            return $this->response->error(
                $e->getMessage()
            );
        }
    }
}
