<?php
    
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class UserController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     */
    public function login()
    {
        return view('admin.login');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function users()
    {
        return view('admin.users');
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        return redirect('/admin');
    }

    /**
     * Display a detail of the resource.
     *
     */
    public function userProfile($uuid) {
        $user = User::where('uuid', $uuid)->first();
        $id = $user->id;
        return view('admin.userdetail')->with(compact('id', 'uuid'));
    }

    /**
     * Display page
     */
    public function forgotPassword()
    {
        return view('admin.forgot-password');
    }
    
    /**
     * Display page
     */
    public function resetPassword(Request $request)
    {
        $email_id = $request->email;
        $reset_token = $request->token;
        return view('admin.reset-password')->with(compact('email_id', 'reset_token'));
    }

    /**
     * Display page
     */
    public function reviews()
    {
        return view('admin.reviews');
    }


}
