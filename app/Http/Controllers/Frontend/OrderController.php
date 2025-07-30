<?php

namespace App\Http\Controllers\Frontend;

use DB;
use Log;
use PDF;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{User, Order};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller{
    /**
     *
     *initialized constructor for permission's.
     *
     */
    public function __construct(){

    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
        try{
            $orders = Order::with("customer")->where('user_id', auth()->guard('web')->id())->latest()->paginate(config('app.paginate'));
            return view('frontend.pages.dashboard.include.order.index', compact('orders'));
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
    public function orderDetail($id){
        try{
            $order = Order::with("customer", "shippingAddress", "billingAddress","reviews")->where('order_id',$id)->first();
            if($order) {
                return view('frontend.pages.dashboard.include.order.show',compact('order'));
            }
        }catch(\Exception $ex){
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
        abort(404);
    }

    public function downloadInvoice($id){
        try{
            ini_set('max_execution_time', 180);
             $order = Order::with("customer", "shippingAddress", "billingAddress")->where('user_id',auth()->guard('web')->id())->find($id);
            if($order){
                // return view('frontend.pdf.invoice',compact('order'));
                $pdf = PDF::loadView('frontend.pdf.invoice', compact('order'));
                return $pdf->download('Invoice-'.$id.'.pdf');
            }
            abort('404');
            // download PDF file with download method
        }catch(\Exception $ex){
            abort('404');
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}