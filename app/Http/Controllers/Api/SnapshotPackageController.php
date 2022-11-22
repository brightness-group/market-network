<?php
    
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;    
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Snapshot\StoreRequest;
use App\Http\Requests\Snapshot\UploadSnapshotRequest;
use App\Helpers\ResponseHelper;
use App\Models\User;
use App\Models\Snapshot;
use App\Models\SnapshotPackage;
use App\Models\Media;
use Validator;
use Illuminate\Validation\Rule;
use Auth;
use Exception;
    
class SnapshotPackageController extends Controller
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
            if (Auth::user()) {
                $snapshots = SnapshotPackage::with('snapshot')->where('snapshot.user_id', Auth::user()->id)->get();
            }

            // Set response data
            $apiMessage = (!empty($snapshots)) ? 'No record found' : 'Snapshot package list';
            return $this->response->successSingleRecord($apiMessage, $snapshots);
        } catch (Exception $e) {
            return $this->response->error(
                $e->getMessage()
            );
        }
    }
}
