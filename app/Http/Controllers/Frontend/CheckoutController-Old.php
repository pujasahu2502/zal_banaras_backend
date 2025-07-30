<?php

namespace App\Http\Controllers\Frontend;

use Log;
use Stripe;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Validator,Session};
use App\Jobs\{UserWebinarBookingJob, WebinarBookingJob};
use App\Models\{Address,Booking,Webinar,GiftCard,Payment,AssignGiftCard};


class CheckoutController extends Controller
{

    public function index(){
        return view('errors.404.blade.php');
    }
   
 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
          // return $request->all();
        //  $validator = Validator::make($request->all(), [
        //     'shipping_address1'=> 'required',
        //     'shipping_address2'=>'required',
        //     'shipping_country'=>'required',
        //     'shipping_state'=>'required',
        //     'shipping_city'=>'required',
        //     'shipping_zip_code'=>'required',
        //     'billing_address1'=>'required',
        //     'billing_address2'=>'required',
        //     'billing_country'=>'required',
        //     'billing_state'=>'required',
        //     'billing_city'=>'required',
        //     'billing_zip_code'=>'required',
        // ]);

        // if ($validator->fails()) {
        //     // dd($validator->errors());
        //     return response()->json([
        //         'status' => 'error',
        //         'error' => $validator->errors(),
        //     ]);
        // }
        try{
            $slug = explode('/', url()->previous())[4];
            $webinar = Webinar::where('slug', $slug)->with('booking_per_person')->first();
            if(\Cache::has('booked_seat_'.$slug)) {
                $bookedSeatCache = \Cache::get('booked_seat_'.$slug);
                \Cache::forget('booked_seat_'.$slug);
                \Cache::forget('min_price');
                $bookedSeat = array_unique(array_merge($bookedSeatCache, $request->seat_number));
            }else{
                $bookedSeat = $webinar->booking_per_person->pluck('seat_number')->toArray();
                $bookedSeat = array_merge($bookedSeat,$request->seat_number);
            }
    
            $bookingPerPerson = [];
            foreach ($request->seat_number as $seatKey => $seatVal) {
                $bookingPerPerson[] = [
                    'first_name' => $request->first_name[$seatKey],
                    'last_name' => $request->last_name[$seatKey],
                    'seat_number' => $seatVal,
                    'webinar_id' => $webinar->id,
                ];
            }
             
            
            
             //Store Address
            $address = $this->addressStore($request);
            $bookingDetail = [
                'webinar_id' => $webinar['id'],
                'webinar_name' => $webinar['name'],
                'current_time' => todayDate()->addMinutes(10),
                'seat_number' => $request->seat_number,
                'bookingPerPerson' => $bookingPerPerson,
                'price' => $webinar->price,
                'address' => $address,
                'slug' => $slug
            ];
            session()->forget([ 'applied_giftCard']);
            \Cache::forget(auth()->user()->email);
            \Cache::Put(auth()->user()->email, $bookingDetail, now()->addMinute(10));
            \Cache::Put('booked_seat_'.$slug, $bookedSeat,now()->addMinute(10));
            return redirect()->route('checkout.makePayment');
        }catch(Exception $ex){
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try{
            $productDetail = Webinar::with('booking_per_person')
            ->where('slug', $slug)
            ->first();
        return view(
            'frontend.pages.checkout.checkout-seats',
            compact('productDetail')
        );
        }catch(Exception $ex){
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $productDetail = Webinar::where('id', $id)->first();
            return view(
                'frontend.pages.checkout.address',
                compact('productDetail')
            );
        }catch(Exception $ex){
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
       
    }

    public function addressStore(Request $request)
    {
      
        try{
              // return $request;
        $addressTypeData = '1';
        $addressType = $request->address_type;
        /* ===== ADDRESS TABLE ===== */
        $shippingAddressData = [
            'address1' => $request->shipping_address1,
            'address2' => $request->shipping_address2,
            'country' => $request->shipping_country,
            'state' => $request->shipping_state,
            'city' => $request->shipping_city,
            'zip_code' => $request->shipping_zip_code,
            'user_id' => auth()->id(),
        ];

        $defaultAddress = [
            'address1' => $request->shipping_address1,
            'address2' => $request->shipping_address2,
            'country' => $request->shipping_country,
            'state' => $request->shipping_state,
            'city' => $request->shipping_city,
            'zip_code' => $request->shipping_zip_code,
            'user_id' => auth()->id(),
            'address_type' => '0',
        ];
        
       
        if ($addressType == 'on') {
            $addressTypeData = '1';
            // $billingAddress = Address::create($shippingAddressData);
        } else {
            $addressTypeData = '0';
            $billingAddressData = [
                'address1' => $request->billing_address1,
                'address2' => $request->billing_address2,
                'country' => $request->billing_country,
                'state' => $request->billing_state,
                'city' => $request->billing_city,
                'zip_code' => $request->billing_zip_code,
                'user_id' => auth()->id(),
                'address_type' => '1',
            ];
            // $billingAddress = Address::create($billingAddressData);
        }

        return [
            // 'billing_address_id' => $billingAddress->id ?? null,
            'billing_address_data' => $billingAddressData ?? null,
            'default_address_data' => $defaultAddress ?? null,
            'default_address_type' => $request->address_default ?? null,
            // 'shipping_address_id' => $shippingAddress->id ?? null,
            'shipping_address_data' => $shippingAddressData ?? null,
            'address_type' => $addressTypeData,
            'address_default' => $request->address_default ?? null
        ];
        }catch(Exception $ex){
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
       
    }

    public function pendingPayment($id)
    {
        try{
            if (session()->has('booking_id')) {
                return redirect()->route('checkout.makePayment');
            } else {
                session()->put(['booking_id' => $id]);
                return redirect()->route('checkout.makePayment');
            }
        }
        catch(Exception $ex){
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }
    public function makePayment()
    {
        
        // if (session()->has('applied_giftCard')) {
        //     session()->forget(['applied_giftCard']);
        // }
        // if (session()->has('booking_id')) {
        //     $bookingData = Booking::with('webinar')->find(
        //         session()->get('booking_id')
        //     );
        //     $intent = auth()
        //         ->user()
        //         ->createSetupIntent();
        //     return view(
        //         'frontend.pages.checkout.payment',
        //         compact('bookingData', 'intent')
        //     );
        // }
        \Cache::get(auth()->user()->email);
        
        if(\Cache::has(auth()->user()->email)) {
            $total_booking = count(\Cache::get(auth()->user()->email)['seat_number']);
             $webinar =  Webinar::find(\Cache::get(auth()->user()->email)['webinar_id']);
            // $bookingData = Booking::with('webinar')->find(session()->get('booking_id'));
            $intent = auth()->user()->createSetupIntent();
            return view('frontend.pages.checkout.payment',compact('webinar', 'intent', 'total_booking'));
        }
        return abort('419');
    }

    public function paymentStore(Request $request)
    {
        try{
            if(\Cache::has(auth()->user()->email)) {    
                $bookingData = \Cache::get(auth()->user()->email);
                $total_booking = count(\Cache::get(auth()->user()->email)['seat_number']);
                $webinar = Webinar::where('id', $bookingData['webinar_id'])->with('booking_per_person')->first();
    
                $BookedSeat =  $webinar->booking_per_person->pluck('seat_number');
    
                $seatRegister = [];
                $seatFlag = false;
                if($BookedSeat->count()) {
                    foreach($bookingData['bookingPerPerson'] as $requestSeat) {
                        foreach($BookedSeat as $seat ) {
                            if( $seat == $requestSeat['seat_number']) {
                                $seatRegister[] = $requestSeat['seat_number'];
                                $seatFlag = true;
                            }
                        }
                    }
                } 
               
                if($seatFlag) {
                    return response()->json(['status' => 'booked', 'message' => 'Sorry for your inconvenience. Seat Number '.implode(',',$seatRegister).' Booked. Try with different seat.']);
                }
    
                
                // STRIPE SET API 
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
                //FOR BOOKING AMOUNT CALCULATION
                $totalAmount = '';
                if (session()->has('booking_amount')) {
                    //AMOUNT WITH WEBINAR GIFT CARD REDEMPTION
                    $totalAmount = session()->get('booking_amount');
                }else{
                    //Actually Amount
                    $totalAmount = $bookingData['price'] * $total_booking;
                }
    
                // return $request['paymentMethod'];
                // SEND Request For Stripe Payment 
                $payment = Stripe\Charge::create([
                    'amount' => $totalAmount * 100,
                    'currency' => 'usd',
                    'source' => $request['paymentMethod'],
                    'description' => 'Payment for Raffle ' .$bookingData['webinar_name'].' ' .Auth()->user()->email,
                ]);
    
                //insert data in payment table
                $paymentTable = Payment::create([
                    'transaction_id' => $payment->balance_transaction,
                    'user_id' => auth()->id(),
                    'total_amount' => $payment->amount / 100,
                    'assign_gift_card_id' => \session()->has('coupon_code') ? session()->get('coupon_code') : null,
                ]);
                // address data create 
                if(\Cache::get(auth()->user()->email)['address']){
                    $addressData = \Cache::get(auth()->user()->email)['address'];
                    if ($addressData['default_address_type'] == 'on') {
                        $shippingAddress = Address::create($addressData['default_address_data']);
                        $shippingAddress->refresh();
                        $updateAnother = Address::where('user_id', auth()->id())->where(
                            'address_type',
                            '0'
                        );
                        if ($updateAnother) {
                            $updateAnother->update(['address_type' => '1']);
                        }
                    } else {
                        $shippingAddress = Address::create($addressData['shipping_address_data']);
                    }

                    if ($addressData['address_type'] == '1') {
                        $addressTypeData = '1';
                        $billingAddress = Address::create($addressData['shipping_address_data']);
                    } else {
                        $addressTypeData = '0';
                        $billingAddress = Address::create($addressData['billing_address_data']);
                    }


                }
    
                // =========================
                $reviewData = [
                    'payment_id' => $paymentTable->id,
                    'invoice_id' => invoiceID(),
                    'order_number' => orderNumber(),
                    'total_amount' => $payment->amount / 100,
                    'payment_status' => '1',
                    'user_id' => \Auth::id(),
                    'webinar_id' => $bookingData['webinar_id'],
                    'total_booking' => $total_booking,
                    'billing_address_id' => $billingAddress->id,
                    'shipping_address_id' => $shippingAddress->id,
                    'address_type' =>  $addressData['address_type']
                ];
    
                //Insert Data in Booking Table
                $booking = Booking::create($reviewData);
    
                // Put session for order number 
                session()->put(['order_number' => $booking->order_number]);
    
    
                if($bookingData['bookingPerPerson']) {
                    $booking->bookingPerPerson()->createMany($bookingData['bookingPerPerson']);
                }
    
                //Check Gift card Applied then it will expire gift card
                if (session()->has('gift_card_Price')) {
                    $giftCard = GiftCard::find(session()->get('gift_card_Price'));
                    $giftCard->update(['status' => '0']);
                }
    
                $bookingCount =  Booking::where('webinar_id', $bookingData['webinar_id'])->where('payment_status', '1')->count();
                $webinar = Webinar::find($bookingData['webinar_id']);
                
                $seatCount = $webinar->consumed_seats + $total_booking;
                $webinar->update(['consumed_seats' => $seatCount]);
    
                if ($webinar->total_seats == $bookingCount) {
                    WebinarBookingJob::dispatch($webinar);
                }
                
                $bookingMailData = Booking::with('bookingPerPerson', 'user', 'webinar', 'payment','shippingAddress','billingAddress')->Where('id', $booking->id)->withCount('bookingPerPerson')->first();
                // send mail to user
                UserWebinarBookingJob::dispatch($bookingMailData);
                //clear all cache 
                \Cache::flush();
                // destroying all sessions 
                session()->forget(['booking_id', 'booking_amount', 'applied_giftCard', 'gift_card_Price', 'coupon_code']);
              
                return response()->json([
                    'status' => 'success',
                    'url' => route('checkout.orderConfirmation'),
                ]);
            }
            return response()->json(['status' => 'booked','message' => 'your payment time is exceed the limit.']);  
        }catch(Exception $ex){
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
       
    }
    public function freeWebinar(Request $request)
    {
        try{
            if(\Cache::has(auth()->user()->email)) {    
                $bookingData = \Cache::get(auth()->user()->email);
                $total_booking = count(\Cache::get(auth()->user()->email)['seat_number']);
                $webinar = Webinar::where('id', $bookingData['webinar_id'])->with('booking_per_person')->first();
    
                $BookedSeat =  $webinar->booking_per_person->pluck('seat_number');
    
                $seatRegister = [];
                $seatFlag = false;
                if($BookedSeat->count()) {
                    foreach($bookingData['bookingPerPerson'] as $requestSeat) {
                        foreach($BookedSeat as $seat ) {
                            if( $seat == $requestSeat['seat_number']) {
                                $seatRegister[] = $requestSeat['seat_number'];
                                $seatFlag = true;
                            }
                        }
                    }
                } 
               
                if($seatFlag) {
                    return response()->json(['status' => 'booked', 'message' => 'Sorry for your inconvenience. Seat Number '.implode(',',$seatRegister).' Booked. Try with different seat.']);
                }
    
                
             
                //FOR BOOKING AMOUNT CALCULATION
                $totalAmount = '';
                if (session()->has('booking_amount')) {
                    //AMOUNT WITH WEBINAR GIFT CARD REDEMPTION
                    $totalAmount = session()->get('booking_amount');
                }else{
                    //Actually Amount
                    $totalAmount = $bookingData['price'] * $total_booking;
                }
    
              
    
                //insert data in payment table
                $paymentTable = Payment::create([
                    'transaction_id' => 'IMPS',
                    'user_id' => auth()->id(),
                    'total_amount' => 00,
                    'assign_gift_card_id' => \session()->has('coupon_code') ? session()->get('coupon_code') : null,
                ]);
                // address data create 
                if(\Cache::get(auth()->user()->email)['address']){
                    $addressData = \Cache::get(auth()->user()->email)['address'];
                    if ($addressData['default_address_type'] == 'on') {
                        $shippingAddress = Address::create($addressData['default_address_data']);
                        $shippingAddress->refresh();
                        $updateAnother = Address::where('user_id', auth()->id())->where(
                            'address_type',
                            '0'
                        );
                        if ($updateAnother) {
                            $updateAnother->update(['address_type' => '1']);
                        }
                    } else {
                        $shippingAddress = Address::create($addressData['shipping_address_data']);
                    }

                    if ($addressData['address_type'] == '1') {
                        $addressTypeData = '1';
                        $billingAddress = Address::create($addressData['shipping_address_data']);
                    } else {
                        $addressTypeData = '0';
                        $billingAddress = Address::create($addressData['billing_address_data']);
                    }


                }
    
                // =========================
                $reviewData = [
                    'payment_id' => $paymentTable->id,
                    'invoice_id' => invoiceID(),
                    'order_number' => orderNumber(),
                    'total_amount' => 00,
                    'payment_status' => '1',
                    'user_id' => \Auth::id(),
                    'webinar_id' => $bookingData['webinar_id'],
                    'total_booking' => $total_booking,
                    'billing_address_id' => $billingAddress->id,
                    'shipping_address_id' => $shippingAddress->id,
                    'address_type' =>  $addressData['address_type']
                ];
    
                //Insert Data in Booking Table
                $booking = Booking::create($reviewData);
    
                // Put session for order number 
                session()->put(['order_number' => $booking->order_number]);
    
    
                if($bookingData['bookingPerPerson']) {
                    $booking->bookingPerPerson()->createMany($bookingData['bookingPerPerson']);
                }
    
                //Check Gift card Applied then it will expire gift card
                if (session()->has('gift_card_Price')) {
                    $giftCard = GiftCard::find(session()->get('gift_card_Price'));
                    $giftCard->update(['status' => '0']);
                }
    
                $bookingCount =  Booking::where('webinar_id', $bookingData['webinar_id'])->where('payment_status', '1')->count();
                $webinar = Webinar::find($bookingData['webinar_id']);
                
                $seatCount = $webinar->consumed_seats + $total_booking;
                $webinar->update(['consumed_seats' => $seatCount]);
    
                if ($webinar->total_seats == $bookingCount) {
                    WebinarBookingJob::dispatch($webinar);
                }
    
                $bookingMailData = Booking::with('bookingPerPerson', 'user', 'webinar', 'payment','shippingAddress','billingAddress')->Where('id', $booking->id)->withCount('bookingPerPerson')->first();
                // send mail to user
                UserWebinarBookingJob::dispatch($bookingMailData);
                //clear all cache 
                \Cache::flush();
                // destroying all sessions 
                session()->forget(['booking_id', 'booking_amount', 'applied_giftCard', 'gift_card_Price', 'coupon_code']);
              
                return response()->json([
                    'status' => 'success',
                    'url' => route('checkout.orderConfirmation'),
                ]);
            }
            return response()->json(['status' => 'booked','message' => 'your payment time is exceed the limit.']);  
        }catch(Exception $ex){
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
       
    }
    public function giftCardApply(Request $request)
    {
       
     try{
        if (session()->has('applied_giftCard')) {
            return response()->json([
                'status' => 'already',
                'message' => 'Gift Card Already Applied',
            ]);
        } else {
            if (\Cache::has(auth()->user()->email)) {
                   
                $bookingData = \Cache::get(auth()->user()->email);
                 $webinar = Webinar::find($bookingData['webinar_id']);
                $checkGiftCard = AssignGiftCard::where('purchase_webinar_id',$bookingData['webinar_id'])->where('user_id', auth()->id())->first();
                if ($checkGiftCard) {
                    // $checkGiftCardCode = GiftCard::where('id',$checkGiftCard->gift_card_id)->where('code', $request->couponCode)->where('status', '1')->first();
                    $checkGiftCardCode = GiftCard::where('code', $request->couponCode)->where('status', '1')->first();
                        // dd($checkGiftCardCode);
                    if ($checkGiftCardCode) {
                        $total_booking = count(\Cache::get(auth()->user()->email)['seat_number']);
                        $price =  $webinar->price * $total_booking - $checkGiftCardCode->price;
                        session()->put([
                                    'booking_amount' => count($bookingData['bookingPerPerson']) * ($bookingData['price']) - $checkGiftCardCode['price'],
                                    'coupon_code' => $checkGiftCardCode->id,
                                    'applied_giftCard' => $checkGiftCardCode->price,
                                    'gift_card_Price' => $checkGiftCardCode->id,
                                ]);
                        $total_booking = count($bookingData['bookingPerPerson']);
                            $paymentPage = view('frontend/pages/checkout/include/free-webinar')->render();
                        $giftCardHtml = view('frontend.pages.checkout.include.gift-card-render',compact('checkGiftCardCode', 'bookingData','total_booking','webinar'))->render();
                        return response()->json(['status' => 'success', 'paymentPage'=>$paymentPage, 'total_price' => $price, 'output' => $giftCardHtml,'message' => 'gift card applied successfully']);
                    } else {
                        return response()->json(['status' => 'error','message' =>'Invalid Gift Card. Please Enter valid Gift Card']);
                    }
                } else {
                    return response()->json(['status' => 'error','message' =>'Invalid Gift Card. Please Enter valid Gift Card']);
                }
            }else{
                return response()->json(['status' => 'error','message' =>'Server is not responding you request. Please try again.']);
            }
        }
     }catch(Exception $ex){
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }

    public function orderConfirmation()
    {
        try{
           return view('frontend.pages.checkout.confirmation');
        }catch (Exception $ex) {
            \Log::error($ex); return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
        }
    }

}
