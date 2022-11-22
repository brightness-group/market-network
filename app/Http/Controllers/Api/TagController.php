<?php
    
namespace App\Http\Controllers\Api;
    
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseHelper;
use Exception;
use App\Models\Tag;
use App\Http\Controllers\Controller;
    
class TagController extends Controller
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
    public function index()
    {
        try {
            $tags = Tag::select('id', 'name')->get();

            // Set response data
            $apiMessage = ($tags->isEmpty()) ? 'No records found' : 'Tag list';
            return $this->response->success($apiMessage, $tags->toArray());
        } catch (Exception $e) {
            return $this->response->error(
                $e->getMessage()
            );
        }
    }

}
