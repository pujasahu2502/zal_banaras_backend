<?php

namespace App\Http\Controllers\Auth;

use DB;
use File;
use Input;
use Redirect;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Jobs\{CustomerRegistrationJob, CustomerPasswordResetJob};

class RegisterController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(){
        return abort(404);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */

    public function register(Request $request){
        $rule = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|string|email:rfc,dns|max:255',
            // 'email'      => 'required|string|email:rfc,dns|max:255|unique:users',
            'mobile'     => 'required|numeric|digits:10',
            'password'   => 'required|string|min:8|confirmed', //regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/
        ];
        $messages = array(
            'mobile.required' => 'The mobile number field is required.',
            'mobile.digits' => 'The mobile number must be 10 digits.',
            'mobile.numeric' => 'The mobile number must be a number.',
        );
        $validation = \Validator::make($request->all(), $rule, $messages);
        if( $validation->fails() ){
            return response()->json(['status' =>'error', 'errors' => $validation->errors()]);
        }

        $userCustomerData = User::where('email', $request->email)->where('type', 'customer')->first();
        if($userCustomerData){
            return response()->json(['status' => 'error', 'errors' =>[ 'email' =>  __('The email has already been taken.')]]); 
        }else{
            $userGuestData = User::where('email', $request->email)->where('type', 'guest')->first();
            if($userGuestData){
                $this->updateGuest($request->all(), $userGuestData);
            }else{
                $user = $this->create($request->all());
            }
        }

        $credentials = $request->only('email', 'password');
        if (\Auth::guard('web')->attempt($credentials)) { 
            return response()->json(['status' => 'success', 'url' => url()->previous(), 'message' => "Customer registered successfully" ]); 
        }
        return response()->json(['status'=> 'success', 'message' => 'Customer registered successfully' ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data){
        $user =  User::create([
            'first_name'     => $data['first_name'],
            'last_name'      => $data['last_name'],
            'display_name'   => $data['first_name'].' '.$data['last_name'],
            'email'          => $data['email'],
            'password'       => Hash::make($data['password']),
            'mobile'         => $data['mobile'],
            'remember_token' => \Str::random(10),
            // 'username' => \Str::random(10),
            'type'           => 'customer',
         ]);
        $user->assignRole('user');
        /* === Send Mail to Reg === */
        CustomerRegistrationJob::dispatch($user);
        return $user;
    }

    protected function updateGuest(array $data, $userGuestData){
        $user = [
            'first_name'     => $data['first_name'],
            'last_name'      => $data['last_name'],
            'display_name'   => $data['first_name'].' '.$data['last_name'],
            'email'          => $data['email'],
            'password'       => Hash::make($data['password']),
            'mobile'         => $data['mobile'],
            'remember_token' => \Str::random(10),
            'type'           => 'customer',
        ];
        User::where('id', $userGuestData->id)->update($user);
        /* === Send Mail to Reg === */
        CustomerRegistrationJob::dispatch($user);
        return $user;
    }

    /**
     * Reset password
     * @param request
     * @return response
     */
    public function resetPassword(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('failed', 'Failed! email is not registered.');
        }

        $token = \Str::random(60);

        $updatePassword = DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        if(!$updatePassword){
            return back()->withInput()->with('error', 'The password reset token is invalid.');
        }

        $url = route('password.reset', [
            'token' => $token,
            'email' => $request->email
        ]);

        $data = [
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email']
        ];
        /* === Send Mail to Reset Password === */        
        CustomerPasswordResetJob::dispatch($data, $url);
        return response()->json([ 'status'=>'success', 'message'=>'Password reset link has been sent to your email.' ]);
    }
}