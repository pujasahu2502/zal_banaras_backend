<?php

namespace App\Http\Controllers\Frontend;

use DB;
use Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{Order, Product, User, Review};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller{
    /**
     *
     *initialized constructor for permission's.
     *
     */
    public function __construct(){

    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create($product_slug,$order_id){
    
            $product = Product::where('slug',$product_slug)->first();
            $order = Order::where('order_id',$order_id)->where('user_id',auth()->guard('web')->id())->first();
            if($order && $product) {
                $review = Review::where(['order_id'=>$order['id'], 'product_id' => $product['id']])->first();
                return view('frontend.pages.dashboard.include.review.create',compact('order','product','review'));
            }
            abort(404);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request,$slug,$order_id){
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    // 'rating' => [ 'required' ],
                    'review' => [ 'required', 'string', 'max:200' ],
                ]
            );

            if($validate->fails()){
                return back()->withErrors($validate->errors())->withInput();
            }

            $order = Order::where('order_id',$order_id)->where('user_id',auth()->guard("web")->id())->first();
            $product = Product::where('slug',$slug)->first();
            $review = $order->orderItems()->where(['order_id'=>$order['id'], 'product_id' => $product['id']])->first();

            if($review) {
                $data = [
                    'user_id'    => auth()->guard("web")->id(),
                    'product_id' => $product->id,
                    'order_id' =>   $order->id,
                    'rating'     => $request->rating,
                    'review'     => $request->review,
                ];
                Review::create($data);
                \Session::flash('success', 'Review added successfully!');
                return redirect()->route('orders.details',$order_id);
            }
            \Session::flash('success', 'Order Mismatch! Try again');
            return redirect()->route('orders.details',$order_id);
            
        } catch (\Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}