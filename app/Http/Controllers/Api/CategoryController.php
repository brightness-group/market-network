<?php
    
namespace App\Http\Controllers\Api;
    
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseHelper;
use Exception;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Auth;
    
class CategoryController extends Controller
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
            $parentCategories = Category::where('parent_id', 0)->get();

            foreach ($parentCategories as $parent) {
                $childCategories = Category::where('parent_id', $parent->id)->get()->toArray();
                $parent['child'] = $childCategories;
            }
            
            // Set response data
            $apiMessage = (!$parentCategories) ? 'No records found' : 'Category list';
            return $this->response->success($apiMessage, $parentCategories->toArray());
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
    public function allCategories()
    {
        try {
            $categories = Category::where('parent_id', '<>', 0)->get();

            // Set response data
            $apiMessage = ($categories->isEmpty()) ? 'No records found' : 'Category list';
            return $this->response->success($apiMessage, $categories->toArray());
        } catch (Exception $e) {
            return $this->response->error(
                $e->getMessage()
            );
        }
    }

    public function childCategories() 
    {
        try {
            $categoryData = Category::where('parent_id', '<>', 0)->get();
            $parentCategories = Category::where('parent_id', 0)->pluck('name', 'id');
            $categories = [];
            foreach ($categoryData as $category) {
                $parentCat = str_replace('&', 'and', $parentCategories[$category->parent_id]);
                $categories[$parentCat][] = $category;
            }

            // Set response data
            $apiMessage = (empty($categories)) ? 'No records found' : 'Category list';
            return $this->response->success($apiMessage, $categories);
        } catch (Exception $e) {
            return $this->response->error(
                $e->getMessage()
            );
        }
    }

}
