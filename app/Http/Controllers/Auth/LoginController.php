<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\{User,Admin};

class LoginController extends Controller{
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
    protected function authenticated(Request $request, $user){
        if ($user->hasRole('admin')) {
            return redirect()->route('admin-home');
        } else {
            return response()->json([ 'status' => 'success', 'message' => 'Login Successful!' ]);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm(){
        return abort(404);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function adminLoginForm(){
        if(auth()->guard('admin')->check()) {
            return redirect()->route('admin.home');
        }
        return view('auth.login');
    }

    public function login(Request $request){
        $userData = User::where('email', $request->email)->with('roles')->first();
        if($userData != ''){
            if(isset($userData->status) && $userData->status == 1){
                $credentials = $request->only('email', 'password');
                if (Auth::guard('web')->attempt($credentials)) { 
                    \Session::flash('success', 'Customer login successfully!');
                   return response()->json(['status' => 'success', 'url' => url()->previous(), 'message' => "Customer login successfully!" ]); 
                }else{
                    return response()->json(['status' => 'error', 'errors' =>[ 'email' =>  __('invalid_credentials')]]); 
                }
            }else{
                return response()->json(['status' => 'error', 'errors' =>[ 'email' =>  __('login_deactivated_error')]]); 
            }
        }else {
            return response()->json(['status' => 'error', 'errors' =>[ 'email' =>  __('Email is not registered in the system. please register')]]); 
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request){
        $userType =Auth::guard('admin')->check() ? 'admin' : 'user';
        $carData = cartItems();
        
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        if($userType) {
            collect($carData)->each(function($rows, $identifier) {
                \Cart::add($rows);
            });
        }
        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        if ($userType == 'user') {
            return  redirect('home');
        }
        return $request->wantsJson() ? new JsonResponse([], 204) : redirect('/projection-booth');
    }
}