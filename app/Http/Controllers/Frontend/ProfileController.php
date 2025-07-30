<?php

namespace App\Http\Controllers\Frontend;

use Log;
use Exception;
use Illuminate\Http\Request;
use App\Models\{Address,User};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Validator,Auth};

class ProfileController extends Controller{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

    public function index(){
        try{
            $userData = User::find(auth()->id());
            return view('frontend.pages.dashboard.include.my-profile',compact('userData'));
        }catch (\Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }

    public function update(Request $request) {
        try{
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => ['required','email:rfc,dns', 'max:255','unique:users,email,'.auth()->id()],
                'mobile' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error','error' => $validator->errors()]);
            }

            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile' => $request->mobile,
                'email' => $request->email,
            ];

            $userData = User::find(Auth()->id());
            $userData->update($data);
            $userData = $userData->refresh();
            $myProfileData = view('frontend.pages.dashboard.include.my-profile-form',compact('userData'))->render();
            return response()->json(['status' => 'success','message' => 'Profile has been updated successfully !','output' => $myProfileData,]);
        }catch (\Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }
}