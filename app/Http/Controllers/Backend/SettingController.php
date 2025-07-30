<?php

namespace App\Http\Controllers\Backend;

use Log;
use Exception;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try {
            $settingData = Setting::where('id', '1')->first();
            $settingModel = view('backend.setting.admin-setting', compact('settingData'))->render();
            return response()->json([ 'status' => 'success', 'output' => $settingModel ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
     * Store the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {
            $data = [
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ];
            $settingData = Setting::where('id', $request->setting_id)->first();
            if($settingData){
                $settingData->update($data);
            }else{
                Setting::create($data);
            }
            return response()->json([ 'status'=>'success', "message"=>"Website settings saved successfully!" ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}