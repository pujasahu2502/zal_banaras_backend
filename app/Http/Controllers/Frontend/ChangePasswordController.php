<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth,Hash,Validator};
use App\Jobs\CustomerChangePasswordJob;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(){
        try{
            // check session 
               orderNumberHelper();
            return view('frontend.pages.dashboard.include.change-password');   
        }catch (Exception $ex) {
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }  
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        try {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|max:20', //regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/
            
        ]);

        if ($validator->fails()) {
            // dd($validator->errors());
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors(),
            ]);
        }
       
            if (
                !Hash::check(
                    $request->get('current_password'),
                    Auth::user()->password
                )
            ) {
                // The passwords matches
                return response()->json([
                    'status' => 'error',
                    'error' => [
                        'current_password' => __(
                            'password_not_match_with_Current'
                        ),
                    ],
                ]);
            }

            if (
                strcmp(
                    $request->get('current_password'),
                    $request->get('new_password')
                ) == 0
            ) {
                // Current password and new password same
                return response()->json([
                    'status' => 'error',
                    'error' => [
                        'not_match_password' => __('password_not_match'),
                    ],
                ]);
            }

            //Change Password
            $user = Auth::user();
            $user->password = Hash::make($request->get('new_password'));
            $user->save();

            /* === Send Mail to Change Password === */
            CustomerChangePasswordJob::dispatch($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Password changed successfully !',
            ]);
        } catch (Exception $ex) {
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }
}
