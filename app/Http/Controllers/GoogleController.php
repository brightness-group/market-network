<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $findUser = User::where('social_id', $user->id)->first();
            $findUserByEmail= User::where('email', $user->email)->first();
       
            if($findUser || $findUserByEmail){
       
                if ($findUser) {
                    Auth::login($findUser);          
                    return redirect()->intended('dashboard');
                }

                if ($findUserByEmail) {
                    Auth::login($findUserByEmail);          
                    return redirect()->intended('dashboard');
                }
       
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'uuid' => \Str::uuid()->toString(),
                    'email' => $user->email,
                    'social_id'=> $user->id,
                    'social_type'=> 'google',
                    'password' => encrypt('123456dummy')
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('dashboard');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}