<?php

namespace App\Http\Controllers\Auth;

use DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest');
    }

    public function customReset(Request $request){
        $data = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
        if(isset($data) && $data != []){
            $created_date = Carbon::parse($data->created_at);
            $current_date = Carbon::parse(Carbon::now());
            $diff = $created_date->diffInMinutes($current_date);
            if($diff <= 60){
                if($request->password_confirmation == $request->password){
                    User::where('email',  $request->email)->update(['password' => Hash::make($request->password)]);
                    DB::table('password_resets')->where(['email'=> $request->email])->delete();
                    \Session::flash('success', 'Your password has been changed successfully!');
                    return redirect()->route('home'); 
                }else{
                    return back()->withInput()->with('error', 'Confirm password does not match.');
                }
            }else{
                return back()->withInput()->with('error', 'The password reset token time has been expired.');
            }
        }else{
            return back()->withInput()->with('error', 'The password reset token is invalid.');
        }
    }
}