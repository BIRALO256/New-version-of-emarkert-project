<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated(Request $request, $user)
    {
        $loggedUser=User::where('email',$request['email'])
            ->where('password',bcrypt($request['password']))->first();
        
        if($loggedUser){
            if($loggedUser->email_verified_at){
                if($loggedUser->hasRole('Admin')){
                    return redirect()->route('dashboard')->with('success','Successifully logged in');
                }
                if($loggedUser->hasRole('Vendor')){
                    return redirect()->route('dashboard')->with('success','Successifully logged in');

                }
                else{
                    return redirect()->route('home')->with('success','Successifully logged in');
                }
            }
            else{
                return redirect()->route('login')->with('success','Please verify your email before logging in');
            }
        }
        else{
            return redirect()->route('login')->with('success','Your details are incorrect');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
