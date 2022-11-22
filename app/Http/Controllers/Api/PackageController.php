<?php
    
namespace App\Http\Controllers\Api;
    
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Package\StoreRequest;
use App\Models\Package;
use App\Http\Controllers\Controller;
use Exception;
use Auth;
    
class PackageController extends Controller
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
            $packages = Package::where('user_id', Auth::user()->id)->get();
            $packageData = [];
            foreach ($packages as $package) {
                $packageData[$package->type] = $package;
            }

            // Set response data
            $apiMessage = (empty($packageData)) ? 'No records found' : 'Package list';
            return $this->response->success($apiMessage, $packageData);
        } catch (Exception $e) {
            return $this->response->error(
                $e->getMessage()
            );
        }
    }

    /**
     * Create the resource.
     *
     */
    public function store(StoreRequest $request)
    {
        // Create/update new package records
        foreach ($request->toArray() as $data) {
            if (\is_array($data)) {
                $package = Package::updateOrCreate([
                    'user_id'   => Auth::user()->id,
                    'type'   => $data['type'],
                ],[
                    'type' => $data['type'],
                    'price' => $data['price'],
                    'user_id' => Auth::user()->id,
                    'per_price' => $data['per_price'],
                    'offer' => $data['offer'],
                    'description'=> $data['description'],
                    'includes'=> $data['includes'],
                    'draft'=> $request->draft
                ]);
            }
        }

        // Get packages for logged in user
        $packages = Package::where('user_id', Auth::user()->id)->get()->toArray();
        // Set response data
        $apiStatus = Response::HTTP_CREATED;
        $apiMessage = "Package records created";
        $apiData = $packages;

        return $this->response->success($apiMessage, $apiData, $apiStatus);
    }

    /**
     * Display single  resource.
     *
     */
    public function show(string $packageType)
    {
        try {
            $package = Package::where(['user_id' => Auth::user()->id, 'type' => $packageType])->first();
            
            // Set response data
            $apiMessage = (!is_null($package)) ? 'No records found' : 'Package detail';
            return $this->response->successSingleRecord($apiMessage, $package);
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
    public function userPackages($userId)
    {
        try {
            $packages = Package::where('user_id', $userId)->get();
            $packageData = [];
            foreach ($packages as $package) {
                $packageData[$package->type] = $package;
            }

            // Set response data
            $apiMessage = (empty($packageData)) ? 'No records found' : 'Package list';
            return $this->response->success($apiMessage, $packageData);
        } catch (Exception $e) {
            return $this->response->error(
                $e->getMessage()
            );
        }
    }

}
