<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseHelper;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\SocialRegisterRequest;
use Exception;
use Auth;
use DB;
use Mail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Snapshot;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepository;

class AuthController extends Controller
{
    /**
     * @var App\Helpers\ResponseHelper
     */
    private $response;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param App\Helpers\ResponseHelper $response
     * @param Illuminate\Http\Request $request
     * @param App\Repositories\User\UserRepository $userRepository
     *
     * @return void
     */
    public function __construct(
        ResponseHelper $response,
        UserRepository $userRepository
    ) {
        $this->response = $response;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->userRepository->store($request->toArray());

        if ($request->hasFile('avatar')) {
            $user = $this->userRepository->uploadProfileImage($request->toArray(), $user->id);
        }
        $user = User::with('city.state.country', 'profession')->find($user->id);

        // Create API token
        $token = $user->createToken('API Token')->plainTextToken;
        $tokenArray= \explode("|", $token);
        $user['token'] = $tokenArray[1];

        $user['followers'] = 0;
        $user['followees'] = 0;
        $user['likes'] = 0;
        $user['seens'] = 0;

        $apiMessage = 'Register successfully';

        return $this->response->success(
            $apiMessage,
            [$user]
        );
    }

    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);

        if (!Auth::attempt($attr)) {
            return $this->response->error(
                'Credentials not match',
                Response::HTTP_UNAUTHORIZED
            );
        }

        $user = User::with('city.state.country', 'profession')->find(Auth::user()->id);
        $token = auth()->user()->createToken('API Token')->plainTextToken;
        $tokenArray= \explode("|", $token);
        $user['token'] = $tokenArray[1];
    
        // user is followed by
        $followers = $user->followers()->get();
    
        // user is following
        $followees = $user->followees()->get();
        
        $snapshots = Snapshot::with('likes')->where('user_id', Auth::user()->id)->get();
        
        // likes
        $likes = 0;        
        foreach ($snapshots as $snapshot) {
            $likes += $snapshot->likes->count() ?? 0;
        }

        $user['followers'] = $followers->count();
        $user['followees'] = $followees->count();
        $user['likes'] = $likes;
        $user['seens'] = $snapshots->count();

        $apiMessage = 'Successfully logged in';
        
        return $this->response->success(
            $apiMessage,
            [$user]
        );
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = \Str::random(64);

        $rec = DB::table('password_resets')->where('email', $request->email)->delete();

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => Hash::make($token), 
            'created_at' => Carbon::now()
        ]);

        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $request->email,
        ], false));

        Mail::send('email.forgot-password', ['token' => $token, 'url' => $url], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        $apiMessage = 'Mail sent successfully';
        
        return $this->response->success(
            $apiMessage,
            []
        );
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'otp_type' => 'required|in:registration,change_password',
        ]);

        $otp = rand(100000, 999999);

        $rec = DB::table('user_otps')->where(['email' => $request->email, 'otp_type' => $request->otp_type])->delete();

        DB::table('user_otps')->insert([
            'email' => $request->email, 
            'otp' => $otp, 
            'otp_type' => $request->otp_type, 
            'created_at' => Carbon::now()
        ]);

        $data['otp'] = $otp;

        if ($request->otp_type == 'registration') {
            $otpType = 'registration verification';
        }
        if ($request->otp_type == 'change_password') {
            $otpType = 'change password';
        }

        Mail::send('email.send-otp', ['otpType' => $otpType, 'otp' => $otp], function($message) use($request, $otpType){
            $message->to($request->email);
            $message->subject('SEEN: OTP for '.$otpType);
        });

        $apiMessage = 'Mail sent successfully';
        
        return $this->response->success(
            $apiMessage,
            [$data]
        );
    }

    /**
     * Create new resource.
     *
     */
    public function socialRegister(Request $request)
    {
        $finduser = User::where('social_id', $request->social_id)->first();
       
        if($finduser){
            // user is already exixt in system
            if ($request->hasFile('avatar')) {
                $user = $this->userRepository->uploadProfileImage($request->toArray(), $finduser->id);
            }
            $user = User::with('city.state.country', 'profession')->find($finduser->id);
        }else{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
                'city_id' => 'nullable',
                'avatar'  => 'image|mimes:jpeg,png,jpg|max:2048',
                'bio'     => 'string',
                'social_id' => 'required',
                'social_type' => 'required'
            ]);

            $user = User::create([
                'name' => $request->name,
                'uuid' => \Str::uuid()->toString(),
                'email' => $request->email,
                'social_id'=> $request->social_id,
                'social_type'=> $request->social_type,
                'password' => $request->password ? Hash::make($request->password) : Hash::make('Seen@123')
            ]);
    
            if ($request->hasFile('avatar')) {
                $user = $this->userRepository->uploadProfileImage($request->toArray(), $user->id);
            }
            $user = User::with('city.state.country', 'profession')->find($user->id);
        }

        // Create API token
        $token = $user->createToken('API Token')->plainTextToken;
        $tokenArray= \explode("|", $token);
        $user['token'] = $tokenArray[1];

        $apiMessage = 'Success';

        return $this->response->success(
            $apiMessage,
            [$user]
        );
    }

}
