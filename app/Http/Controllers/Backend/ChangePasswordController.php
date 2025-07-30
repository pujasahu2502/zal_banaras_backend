<?php

namespace App\Http\Controllers\Backend;

use Log;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth,Hash,Validator};
use App\Jobs\{AdminChangePasswordJob};

class ChangePasswordController extends Controller{
    /**
    *
    *initialized constructor for permission's.
    *
    */
    public function __construct(){
        $this->middleware('permission:view-change-password', ['only' => ['index'],]);
        $this->middleware('permission:store-change-password', ['only' => ['store'],]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){
        try {
            $changePasswordModel = view('backend.change-password.change-password')->render();
            return response()->json([ 'status' => 'success', 'output' => $changePasswordModel ]);
        } catch (Exception $ex) {
            \Log::error($ex);return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
            }

            if (!Hash::check($request->get('current_password'), Auth::user()->password)) {
                // The passwords matches
                return response()->json([ 'status' => 'error', 'error' => ['current_password' => __('password_not_match_with_Current'),] ]);
            }

            if ( strcmp($request->get('current_password'),$request->get('new_password')) == 0){
                // Current password and new password same
                return response()->json([ 'status' => 'error', 'error' => [ 'not_match_password' => __('password_not_match') ] ]);
            }

            //Change Password
            $user = Auth::user();
            $user->password = Hash::make($request->get('new_password'));
            $user->save();
            /* === Send Mail to Change Password === */
            AdminChangePasswordJob::dispatch($user);

            return response()->json([ 'status' => 'success', 'message' => 'Password changed successfully!' ]);
        } catch (Exception $ex) {
            \Log::error($ex);return response()->json(['status' => 'error','message' => $ex->getMessage() ]);
        }
    }
}