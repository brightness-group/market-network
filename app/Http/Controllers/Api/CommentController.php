<?php
    
namespace App\Http\Controllers\Api;
    
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseHelper;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use Exception;
use Auth;
    
class CommentController extends Controller
{  
    /**
     * @var App\Helpers\ResponseHelper
     */
    private $response;

    /**
     * Create a new controller instance.
     *
     * @param App\Helpers\ResponseHelper $response
     * @param Illuminate\Http\Request $request
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
        $perPage = ($request->perPage) ?? 5;
        try {
            $comments = Comment::with('user')->where('snapshot_id', $request->snapshot_id)->orderBy('created_at', 'DESC')->paginate($perPage);

            // Set response data
            $apiMessage = ($comments->isEmpty()) ? 'No record found' : 'Snapshot list';
            return $this->response->successWithPagination($apiMessage, $comments);
        } catch (Exception $e) {
            return $this->response->error(
                $e->getMessage()
            );
        }
    }

    /**
     * Save comments
     * 
     */
    public function saveComment(StoreRequest $request)
    {
        $comment = Comment::create([
            'snapshot_id' => $request->snapshot_id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment
        ]);

        // Set response data
        $apiStatus = Response::HTTP_CREATED;
        $apiMessage = "Comment added";
        $apiData = [$comment];

        return $this->response->success($apiMessage, $apiData, $apiStatus);
    }
}
