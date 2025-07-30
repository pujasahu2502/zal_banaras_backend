<?php

namespace App\Http\Controllers\Frontend;

use Log;
use PDF;
use Exception;
use App\Models\{Booking,User};
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OrderHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    try{
        
          $orderHistory = Booking::with('webinar','bookingPerPerson','payment')->where('user_id', Auth::user()->id)->withCount('bookingPerPerson')->orderBy('id','desc')->paginate(config('app.paginate'));
        return view('frontend.pages.dashboard.include.order-history', compact('orderHistory'));
    }catch (\Exception $ex) {
        \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
        $bookingData = Booking::with('bookingPerPerson', 'user', 'webinar', 'payment','shippingAddress','billingAddress')->Where('order_number', $id)->withCount('bookingPerPerson')->first();
            if ($bookingData) {
                return view('frontend.pages.dashboard.include.order-detail', compact('bookingData'));
            }
            return abort('404');
        }catch (\Exception $ex) {
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }

    public function generatePDF($id)
    {
        try{
            $booking = Booking::with('bookingPerPerson', 'user', 'webinar', 'payment','shippingAddress','billingAddress')->where('user_id', Auth()->id())->withCount('bookingPerPerson')->find($id);
            $fileName= $booking->webinar->name;
            $todaydate = \Carbon\Carbon::now()->format('d-m-Y h:i');
            // return view('frontend.pages.dashboard.include.order-pdf-download', compact('booking'));
            return  PDF::loadView('frontend.pages.dashboard.include.order-pdf-download', compact('booking'))->setPaper('A3')->download($fileName.$todaydate.'.pdf');
        }catch (\Exception $ex) {
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }
}
