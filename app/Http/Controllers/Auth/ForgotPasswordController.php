<?php 

  

namespace App\Http\Controllers\Auth; 
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller

{

    use ResetsPasswords;

    //declaring that this can be accessed by an unlogged in user
    public function __construct()
    {
        $this->middleware('guest');
    }

      //return the forgot password form so user can input their egistered email
      public function showForgetPasswordForm()

      {
         return view('auth.forgot-password');
      }

      //process the forgot password form request
      public function submitForgetPasswordForm(Request $request)

      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);

          $token = Str::random(64);
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);

          Mail::send('email.forgotPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
          return back()->with('message', 'We have e-mailed your password reset link!');

      }

    
      //show the password reset form where user can change their password from
      public function showResetPasswordForm($token) { 

         return view('auth.reset-password', ['token' => $token]);

      }

      //submitting the password reset form and updating the specific user password

      public function submitResetPasswordForm(Request $request)

      {
          $request->validate([

              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'

          ]);
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ]) ->first();

          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');

          }

          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          return redirect('/login')->with('success', 'Your password has been changed successfully!!');

      }

}