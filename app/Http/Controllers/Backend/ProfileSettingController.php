<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileSettingRequest;

class ProfileSettingController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try {
            $profileSettingModel = view('backend.profile-setting.profile-setting')->render();
            return response()->json([ 'status' => 'success', 'output' => $profileSettingModel ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileSettingRequest $request, $id){
        $profileData = ['first_name' => $request->first_name, 'email' => $request->email];
        Admin::where('id', $id)->update($profileData);
        return response()->json([ 'status'=>'success', "message"=>"Profile updated successfully!",'name'=> $request['first_name']]);
    }
}