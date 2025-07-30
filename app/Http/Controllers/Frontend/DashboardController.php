<?php

namespace App\Http\Controllers\Frontend;

use Log;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){
        try{
            return view('frontend.pages.dashboard.index');
        }catch (Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }

    public function myProfile(){
        try{
            orderNumberHelper();
            return view('frontend.pages.dashboard.include.my-profile');
        }
        catch (Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }
}