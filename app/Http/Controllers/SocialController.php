<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class SocialController extends Controller
{
    use HasRoles;
    public function facebookRedirect(){
        return Socialite::driver('facebook')->redirect();
    }

    // google callback
    public function facebookCallback(){
        $user=Socialite::driver('facebook')->stateless()->user();
        $this->_registerOrLoginUser($user);

        //return to home page after login
        return redirect()->route('home');
    }

    protected function _registerOrLoginUser($incomingUser){
        $role=Role::where('name','Buyer')->first();
        $user=User::where('facebook_id',$incomingUser->id)->first();
        if(!$user){
            $user=new User();
            $user->name=$incomingUser->name;
            $user->email=$incomingUser->email;
            $user->facebook_id=$incomingUser->id;
            $user->role=$role->name;
            $user->email_verified_at=Carbon::now();

            $user->assignRole($role->name);
            $user->save();

            Auth::login($user);
        }else{
            Auth::login($user);
        }
    }

    //google authentication functions
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
      
            $user = Socialite::driver('google')->stateless()->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('home');
       
            }else{
                $role=Role::where('name','Buyer')->first();
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'role'=>$role->name,
                    'email_verified_at'=>Carbon::now(),
                    'created_by'=>$user->name
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('home');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    
}
