<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderCharge;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{ 

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $date = Carbon::today();
            $currentDate = $date->toDateTimeString();

            // $subTotalAmount = $request->subTotalAmount;
            $amount = 00;

           // check coupon exist
            $existCoupon = Coupon::where([['code', '=', $request->couponCode], ['status', '=', '1']])->first();
            if (!empty($existCoupon)) {
            $couponLimit = OrderCharge::where('name',$existCoupon->code)->get()->count();
               // return $currentDate;
               // check coupon for based on start and end date
               $startDateValidate = $existCoupon->start_date <=  $currentDate;//->whereDate('end_date', '>=', $currentDate)->first();
               $endDateValidate = $existCoupon->end_date >=  $currentDate;


               if (empty($startDateValidate) ) {
                   return response()->json(['status' => 'error', 'error' => "coupon is not activated yet."]);
               }

               if (empty($endDateValidate) ) {
                   return response()->json(['status' => 'error', 'error' => "This coupon is no longer available."]);
               }
           }
           if (!empty($existCoupon)) {

               // if($existCoupon["apply_on"] == "") {}
               if ($existCoupon["usage_limit"] == 0) {
                   // continue 
               }elseif($existCoupon["usage_limit"] == $couponLimit){
                   return  response()->json(['status' => 'error', 'error' => "This coupon code is invalid"]);
               }
                $applyOn = $existCoupon["apply_on"];
                // $cart = cartItems();
                \Session::forget(["discount", "totalAmount","coupon_code","coupon","free-product"]);
                switch ($applyOn) {
                    case 1: {
                            $total = subAmount();
                            $discountValue = $existCoupon->amount;
                            $discount = number_format($this->couponType($existCoupon["type"], $discountValue, $total,$existCoupon),2);
                            $totalAmount = totalAmount() - $discount; 
                            if($totalAmount < 1) {
                                return response()->json(['status' => 'error', 'error' => "Can't apply this coupon. add more product to proceed."]);
                            }
                            \Session::put("discount", $discount);
                            \Session::put("totalAmount", $totalAmount);                            
                            \Session::put("coupon_code", $existCoupon["code"]);
                            \Session::put("coupon", [
                                'code' => $existCoupon["code"],
                                'charge' => $discount,
                                'type'  => 'coupon'
                            ]);
                            $alertOutput = view("frontend.pages.checkout.include.coupon-message")->render();
                            $freeProductOutput = ['status' => false];
                            if(session()->has('free-product')) {
                                $discount = 'Free Product';
                                $freeProductOutput = [
                                    'status' => true,
                                    'output' => view('frontend.pages.checkout.include.free-product')->render(),
                                ];
                            }
                            return response()->json(["status" => "success", "discount" => $discount, "totalAmount" => number_format($totalAmount,2), "message" => "Coupon is applied successfully", "alertOutput" => $alertOutput, 'freeProduct' => $freeProductOutput ]);
                        };
                    case 2: {
                            $total = subAmount();
                            $discountValue = $existCoupon->amount;
                            $Ids = json_decode($existCoupon->couponApply()->pluck('apply_on_value'));
                            $cartItems = \Cart::content();

                            $totalProductAmount = 0; 
                            foreach ($cartItems as $cart) {
                                if(in_array($cart->id,$Ids) > 0 ) {
                                    $totalProductAmount += $cart->price;
                                }
                            }
                            // return $totalProductAmount;

                            $discount = number_format($this->couponType($existCoupon["type"], $discountValue, $totalProductAmount,$existCoupon),2);
                            $totalAmount = $totalProductAmount - $discount; 
                            if($totalAmount < 1) {
                                return response()->json(['status' => 'error', 'error' => "Can't apply this coupon. add more product to proceed."]);
                            }
                            $totalAmount = totalAmount() - $discount;

                            \Session::put("discount", $discount);
                            \Session::put("totalAmount", $totalAmount);                            
                            \Session::put("coupon_code", $existCoupon["code"]);
                            \Session::put("coupon", [
                                'code' => $existCoupon["code"],
                                'charge' => $discount,
                                'type'  => 'coupon'
                            ]);
                            $alertOutput = view("frontend.pages.checkout.include.coupon-message")->render();
                            $freeProductOutput = ['status' => false];
                            if(session()->has('free-product')) {
                                $discount = 'Free Product';
                                $freeProductOutput = [
                                    'status' => true,
                                    'output' => view('frontend.pages.checkout.include.free-product')->render(),
                                ];
                            }
                            return response()->json(["status" => "success", "discount" => $discount, "totalAmount" => number_format($totalAmount,2), "message" => "Coupon is applied successfully", "alertOutput" => $alertOutput, 'freeProduct' => $freeProductOutput]);
                        };
                    case 3: {
                            $total = subAmount();
                            $discountValue = $existCoupon->amount;
                            $Ids = $existCoupon->couponApply()->pluck('apply_on_value');
                            $productId = json_decode(Product::whereIn('category_id',$Ids)->where('status','1')->pluck('id'));
                            $cartItems = \Cart::content();
                            $totalProductAmount=0;
                            foreach ($cartItems as $cart) {
                                if(in_array($cart->id,$productId) > 0 ) {
                                    $totalProductAmount += $cart->price;
                                }
                            }
                            $discount = number_format($this->couponType($existCoupon["type"], $discountValue, $totalProductAmount,json_decode($existCoupon)),2);
                            $totalAmount = $totalProductAmount - $discount; 
                            if($totalAmount < 1) {
                                return response()->json(['status' => 'error', 'error' => "Can't apply this coupon. add more product to proceed."]);
                            }
                            $totalAmount = totalAmount() - $discount;

                            \Session::put("discount", $discount);
                            \Session::put("totalAmount", $totalAmount);                            
                            \Session::put("coupon_code", $existCoupon["code"]);
                            \Session::put("coupon", [
                                'code' => $existCoupon["code"],
                                'charge' => $discount,
                                'type'  => 'coupon'
                            ]);
                            $alertOutput = view("frontend.pages.checkout.include.coupon-message")->render();

                            $freeProductOutput = ['status' => false];
                            if(session()->has('free-product')) {
                                $discount = 'Free Product';
                                $freeProductOutput = [
                                    'status' => true,
                                    'output' => view('frontend.pages.checkout.include.free-product')->render(),
                                ];
                            }
                            return response()->json(["status" => "success", "discount" => $discount, "totalAmount" => number_format($totalAmount,2), "message" => "Coupon is applied successfully", "alertOutput" => $alertOutput,  'freeProduct' => $freeProductOutput]);

                        }
                }
                // apply discount on subtotal amount
                // $amount = (float) $subTotalAmount - (float) $couponData->amount;

                //set amount and discount amount in session
                // Session::put(['totalAmount' => $amount, 'discount' => number_format($couponData->amount, 2)]);

                // return response()->json(['discount' => number_format($couponData->amount, 2), 'totalAmount' => number_format($amount, 2)]);

            } else {
                return response()->json(['error' => 'This coupon code is invalid.']);
            }
        } else {
            return response()->json(['error' => 'Please enter a coupon code.']);
        }
    }

    public function couponType($type, $discountValue, $total,$coupon)
    {
        if ($type == 1) {
            $discount = ($total * $discountValue) / 100;
            return $discount;
        } else if ($type == 2) {
            $discount = $discountValue;
            return  $discount;
        } else if($type == 3) {
            $product = Product::find($coupon['product_id']);
            $imgURL = $product->getMedia('featured_product_image')->first()? $product->getMedia('featured_product_image')->first()->getUrl() : asset('front-end/assets/image/single-product-1.jpg');
            $cart = [
                'id' => $product["id"],
                'name' => $product['name'],
                'price' =>   0,
                'qty' => 1,
                'taxRate' => 0,
                'options' => array(
                    'image' => $imgURL,
                    'coupon' => true,
                    )
            ]; 
            \Cart::add($cart);
            Session::put("free-product",$cart);
            return "0";
        }
    }
}
