<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        try {
            $flag = '';
            $orders = Order::with("customer");
          
            /* === FILTER SHORT BY=== */
            if($request->sort_by != null){
                $flag = 1;
                $sortBy = $request->sort_by;
                if($sortBy == '1'){
                    $orders = $orders->oldest();
                }elseif($sortBy == '2'){
                    $orders = $orders->latest();
                }
                else{
                }
            }
            /* === FILTER ORDER STATUS === */
            if($request->os != null){
                $flag = 1;
                if($request->os == '1'){
                    $orders = $orders->where('order_status', $request->os);
                }elseif($request->os == '2'){
                    $orders = $orders->where('order_status', $request->os);
                }elseif($request->os == '3'){
                    $orders = $orders->where('order_status', $request->os);
                }elseif($request->os == '4'){
                    $orders = $orders->where('order_status', $request->os);
                }elseif($request->os == '9'){
                    $orders = $orders->where('order_status', $request->os);
                }elseif($request->os == '10'){
                    $orders = $orders->where('order_status', $request->os);
                }
            }
            if($request->ps != null){
                $flag = 1;
                if($request->ps == '1'){
                    $orders = $orders->where('payment_status', $request->ps);
                }elseif($request->ps == '2'){
                    $orders = $orders->where('payment_status', $request->ps);
                }
                else{
                }
            }
           
             /* === FILTER Date === */
            if(($request->start_date != null) && ($request->end_date != null) ){
                $flag = 1;
                $from = $request->start_date;
                $to = $request->end_date;
                $orders = $orders->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
            }
            if($request->search && $request->search != null){
                $flag = 1;
                $search = $request->search;
                if($this->startsWith($search,'Dnz') || is_numeric($search) && strlen($search) < 10) {
                    $orders = $orders->where('order_id', 'like', '%' . $search . '%');
                }else{
                    $orders = $orders->whereRelation('customer',function($query) use ($search){
                        if(strpos($search,'@') > 0) {
                            $query->where('email', 'like', '%' . $search . '%');
                        }elseif(is_numeric($search) && strlen($search) == 10) {
                            $query->where('mobile', 'like', '%' . $search . '%');
                        }elseif(strpos($search,'@') == 0) {
                            $query->where('username', 'like', '%' . $search . '%');
                        }    
                    });
                }
            }
            $orders = $orders->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.order.index',compact('orders','flag'));
        } catch (\Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }


    function startsWith ($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $order = Order::with("customer","shippingAddress", "billingAddress")->find($id);
        $output = view("backend.order.create", compact('order'))->render();
        return response()->json([ "status" => "success", "output" => $output ]);
    }

    /**
    * Status of the  specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function orderStatus(Request $request, $id){
        try {
            $status = Order::find($id);
            if ($status) {
                $status->update(['order_status' => $request->orderVal]);
            }
            $orders = Order::with("customer")->orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $orderTable = view('backend.order.include.order-table', compact('orders'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Order status updated successfully!', 'output' => $orderTable ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    public function downloadInvoice($id){
        try{
            ini_set('max_execution_time', 180);
            $order = Order::with("customer", "shippingAddress", "billingAddress")->find($id);
            // return view('frontend.pdf.invoice',compact('order'));
            $pdf = Pdf::loadView('frontend.pdf.invoice', compact('order'));
            /* === Download PDF file with download method === */
            return $pdf->download('Invoice-'.$id.'.pdf');
        }catch(\Exception $ex){
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}