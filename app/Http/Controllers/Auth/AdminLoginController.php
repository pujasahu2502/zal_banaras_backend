<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{User,Admin};
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller{
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
            return response()->json([ 'status'=>'success', 'message'=>'Login successful!' ]);
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

      
        return view('auth.login');
    }

    public function login(Request $request){
        if ($request['admin_form']) {
            $credentials = $request->only('email', 'password');
            if (Auth::guard('admin')->attempt($credentials)) {
                \Session::flash('success', 'Admin login successfully!');
                return redirect()->route('admin-home');
            } else {
                return \Redirect::back()->withErrors(['email' => __('invalid_credentials')]);
            }
        }

        $this->incrementLoginAttempts($request);

        return back();
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request){
        $userType = Auth::user()->hasRole('user');
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        if ($userType) {
            return $request->wantsJson() ? new JsonResponse([], 204) : redirect('/');
        }
        return $request->wantsJson() ? new JsonResponse([], 204) : redirect('/projection-booth');
    }
}