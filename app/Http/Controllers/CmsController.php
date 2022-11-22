<?php
    
namespace App\Http\Controllers;

class CmsController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('cms');
    }
}
