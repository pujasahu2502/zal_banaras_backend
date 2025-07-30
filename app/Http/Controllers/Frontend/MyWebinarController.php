<?php

namespace App\Http\Controllers\Frontend;

use Log;
use Exception;
use Illuminate\Http\Request;
use App\Models\Webinar;
use App\Http\Controllers\Controller;
use App\Models\Booking;

class MyWebinarController extends Controller
{
    public function index()
    {
      try{
          // check session 
          orderNumberHelper();
        $webinars = Booking::with(['webinar'=> function($q) {$q->whereTime('releasing_time','>','releasing_time'); }])->whereHas('webinar' , function($q) {
        $q->whereTime('releasing_time','>','releasing_time'); 
        })->where('user_id',auth()->user()->id)->get()->unique('webinar_id');
      return view('frontend.pages.dashboard.include.my-webinar', compact('webinars'));
      }catch (\Exception $ex) {
        \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
      }
    }    //
}