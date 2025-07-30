<?php

namespace App\Http\Controllers\Frontend;

use Validator;
use Illuminate\Http\Request;
use App\Models\{Order, Address, User,Tax,Shipping};
use App\Http\Controllers\Controller;
use App\Jobs\AdminCustomerRegJob;
use App\Jobs\CustomerOrderJob;
use Exception;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Illuminate\Support\Facades\{Session,Auth,Hash};

class CheckoutController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth'); // later enable it when needed user login while payment
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makePayment(){ 
        removeFreeProduct();
        $cartItems = \Cart::content();
        if($cartItems->count()) {
            \Session::forget(["discount", "totalAmount","coupon_code","tax","shipping","coupon","free-product"]); //,"free-product"
            $cartItems = \Cart::content();
            $totalPrice = \Cart::subtotal();
            $allAddress = auth()->guard("web")->check() ? Address::where('user_id',auth()->guard("web")->id())->where("type",'customer')->get() : [];
            return view('frontend.pages.checkout.checkout', compact('cartItems', 'totalPrice','allAddress'));
        }
        abort(404);
    }

    // Payment Request
    public function paymentStore(Request $request) {
        $cartItems = \Cart::content();
        if($cartItems->count()) {
            $validator = Validator::make($request->all(),
                [
                    'first_name' => 'required|string|max:100',
                    'last_name' => 'required|string|max:100',
                    'email' => 'required|email:rfc,dns',
                    'address' => 'required|string',
                    'state' => 'required|string',
                    'city' => 'required|string',
                    'zipcode' => 'required',
                    'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                    'card_number' => 'required',
                    'month' => 'required',
                    'year' => 'required',
                    'cvc' => 'required',
                    'shipping_first_name' => 'exclude_if:filladdress,1|required|string|max:100',
                    'shipping_last_name' => 'exclude_if:filladdress,1|required|string|max:100',
                    'shipping_email' => 'exclude_if:filladdress,1|required|email',
                    'shipping_address' => 'exclude_if:filladdress,1|required|string',
                    'shipping_state' => 'exclude_if:filladdress,1|required|string',
                    'shipping_city' => 'exclude_if:filladdress,1|required|string',
                    'shipping_zipcode' => 'exclude_if:filladdress,1|required',
                    'shipping_phone_number' => 'exclude_if:filladdress,1|required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                ],[
                    'phone_number.required' => 'The mobile number field is required.',
                ],[
                    'shipping_first_name' => 'first name',
                    'shipping_last_name' => 'last name',
                    'shipping_email' => 'email',
                    'shipping_address' => 'address',
                    'shipping_state' => 'state',
                    'shipping_city' => 'city',
                    'shipping_zipcode' => 'zipcode',
                    'shipping_phone_number' => 'mobile',
                    'phone_number' => 'mobile',
                ]
            );
            if ($validator->passes()) {
                $input = $request;
                session()->forget(["tax","shipping"]); 
                $shipping = $request['shipping_state'] ?? $request['state'];  
                $this->checkShippingTax($shipping);
            
                $input['total_price'] = totalAmount();
          
                $price = str_replace( '₹','', $input['total_price']);
                // Check User Id
                $user = null;
                if(auth()->guard("web")->check()) {
                    $user = [
                        'id' => auth()->guard("web")->id()
                    ];
                } else {
                    $user = ['id' => (User::where("email", $input["email"])->first()->id ?? null)];
                    if(!$user["id"]) {
                        $user = $this->createUser($input);
                    }
                }

                /* Create a merchantAuthenticationType object with authentication details
                retrieved from the constants file */
                $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
                $merchantAuthentication->setName(env('MERCHANT_LOGIN_ID'));
                $merchantAuthentication->setTransactionKey(env('MERCHANT_TRANSACTION_KEY'));

                // Set the transaction's refId
                $refId = 'ref'.time();

                $cardNumber = preg_replace('/\s+/', '', $input['card_number']);

                // Create the payment data for a credit card
                $creditCard = new AnetAPI\CreditCardType();
                $creditCard->setCardNumber($cardNumber);
                $creditCard->setExpirationDate($input['year'] . "-" .$input['month']);
                $creditCard->setCardCode($input['cvc']);

                // Add the payment data to a paymentType object
                $paymentOne = new AnetAPI\PaymentType();
                $paymentOne->setCreditCard($creditCard);

                $orderNu = time();
                // Create order information
                $order = new AnetAPI\OrderType();
                $order->setInvoiceNumber($orderNu);
                $order->setDescription("An Order Placed on DNZ PRODUCTS");

                // Add some merchant defined fields. These fields won't be stored with the transaction, but will be echoed back in the response.
                $merchantDefinedField1 = new AnetAPI\UserFieldType();
                $merchantDefinedField1->setName("customerLoyaltyNum");
                $merchantDefinedField1->setValue($orderNu);

                // Create a TransactionRequestType object and add the previous objects to it
                $transactionRequestType = new AnetAPI\TransactionRequestType();
                $transactionRequestType->setTransactionType("authCaptureTransaction");
                $transactionRequestType->setAmount($price);
                $transactionRequestType->setOrder($order);
                $transactionRequestType->setPayment($paymentOne);

                // Assemble the complete transaction request
                $requests = new AnetAPI\CreateTransactionRequest();
                $requests->setMerchantAuthentication($merchantAuthentication);
                $requests->setRefId($refId);
                $requests->setTransactionRequest($transactionRequestType);

                // Create the controller and get the response
                $controller = new AnetController\CreateTransactionController($requests);
                $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

                // $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

                if ($response != null) {
                    // Check to see if the API request was successfully received and acted upon
                    if ($response->getMessages()->getResultCode() == "Ok") {
                        // Since the API request was successful, look for a transaction response
                        // and parse it to display the results of authorizing the card
                        $tresponse = $response->getTransactionResponse();

                        if ($tresponse != null && $tresponse->getMessages() != null) {

                            $message_text = $tresponse->getMessages()[0]->getDescription().", Transaction ID: " . $tresponse->getTransId();
                            $msg_type = "success";    

                            $transactionResponse = [
                                'response_code' => $tresponse->getResponseCode() ?? null,
                                'transaction_id' => $tresponse->getTransId() ?? null,
                                'auth_id' => $tresponse->getAuthCode() ?? null,
                                'message_code' => $tresponse->getMessages()[0]->getCode() ?? null,
                                'amount' => $price
                            ];
                            // store payment in order table
                            $orderStatus = $this->createOrder($user, $transactionResponse, $input);
                            if($orderStatus) {
                                $this->destroyOrderSession();
                            }
                            \Session::flash("success",$message_text);
                        } else {
                            $message_text = __('payment_error_msg');
                            $msg_type = "error";                                    
                            if ($tresponse->getErrors() != null) {
                                $message_text = $tresponse->getErrors()[0]->getErrorText();
                                $msg_type = "error";                                    
                            }
                        }
                        // Or, print errors if the API request wasn't successfulhec
                    } else {
                        $message_text = __('payment_error_msg');
                        $msg_type = "error";
                        $tresponse = $response->getTransactionResponse();
                        if ($tresponse != null && $tresponse->getErrors() != null) {
                            $message_text = $tresponse->getErrors()[0]->getErrorText();
                            $msg_type = "error";                    
                        } else {
                            $message_text = $response->getMessages()->getMessage()[0]->getText();
                            $msg_type = "error";
                        }                
                    }
                } else {
                    $message_text = __('no_response_msg');
                    $msg_type = "error";
                }
                // Session::forget(['totalAmount', 'discount']);
                // Session::put(['name' => $input['first_name'], 'transaction_id' => $tresponse->getTransId()]);
                return response()->json(['status'=> $msg_type, 'errors' => [ "card_number" => ['There were some issue with the payment. Please check your details.']]]);
            } else {
                return response()->json(['status'=>'error', 'errors'=>$validator->errors()]);
            }   
        }else {
            return response()->json(['status'=>'timeout', 'reload'=> "we can't proceed this request, please try again.",'url' => route('home')]);
        }
    }

    public function createUser($input){
        // creating new user with payment details
        $user = User::create([   
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'display_name' => $input['first_name'],
            'email' => $input['email'],
            'mobile' => $input['phone_number'],
            'password' => Hash::make('password'),
            'status' => '0',
            'address_status' => 1,
            'address' => $input['address'],
            'type' => (Auth::id()) ? 'customer' : 'guest',
        ]);
        $user->assignRole('user');
        $data = [
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'display_name' => $input['first_name'],
            'email' => $input['email'],
            'mobile' => $input['phone_number'],
            'password' => Hash::make('password'),
            'status' => '0',
            'address_status' => 1,
            'address' => $input['address'],
            'real_password' =>  '=h+hX%U7+8EJR+xB',
        ];
        // AdminCustomerRegJob::dispatch($data);
        return [
            'id' => $user["id"]
        ];
    }

    public function createOrder($user,$transactionResponse,Request $input)
    {
       try {
        $billing = $shipping = null;
        $input["address_type"] =  $input->has("address_type") ? explode('/',$input["address_type"])[4] : '';
        // if($input->has("address_type")) {
        //     Address::where('first_name',$input["first_name"])->where('last_name',$input["last_name"])->where('email',$input["email"])->where('phone_number',$input["phone_number"])->where('address',$input["address"])->where('state',$input["state"])->where('city',$input["city"])->where('zipcode',$input["zipcode"])->where('user_id',auth()->guard("web"))->find($input["address_type"]);
        // }

        if($input->has('filladdress')) {
            $shipping = $billing = $input["address_type"] ? $this->createOrderAddress($user ,$input["address_type"],$input) : $this->createAddress($user,$input,['customer','order']);
        }else{
           
            $billing = $input["address_type"] ? $this->createOrderAddress($user ,$input["address_type"],$input) : $this->createAddress($user,$input,['customer','order']);

            $shippingInput = [
                'first_name' => $input['shipping_first_name'],
                'last_name' => $input['shipping_last_name'],
                'email' => $input['shipping_email'],
                'phone_number' => $input['shipping_phone_number'],
                'address' => $input['shipping_address'],
                'state' => $input['shipping_state'],
                'city' => $input['shipping_city'],
                'zipcode' => $input['shipping_zipcode'],
            ];
            // dd($input->has("shipping_address_type"));

            $shipping = $input->has("shipping_address_type") ? $this->createOrderAddress($user ,$input["shipping_address_type"],$shippingInput)   : $this->createAddress($user,$shippingInput,['customer','order']);
        }

            $order = Order::create([     
            'order_id' => orderNumber(),                                    
            'amount' => $transactionResponse['amount'], 
            'response_code' => $transactionResponse['response_code'],
            'transaction_id' => $transactionResponse['transaction_id'],
            'auth_id' => $transactionResponse['auth_id'],
            'message_code' => $transactionResponse['message_code'],
            'name_on_card' => trim($input['first_name']),
            'user_id' => $user['id'],
            'shipping_address_id' => $shipping,
            'billing_address_id'=> $billing,
            'payment_status' => '2',
            // 'tax' => session()->has('tax') ? collect(session('tax'))->sum('taxInDollar') : 0 
        ]);
        // $shippingAddress = Address::where('id',$order->shipping_address_id)->first();
        // $billingAddress = Address::where('id',$order->billing_address_id)->first();
        Session::forget('thankyou');
        Session::put('thankyou',[
            'id' => $order['id'],
            'order_id' => $order['order_id'],                                    
            'amount' => $transactionResponse['amount'], 
            'transaction_id' => $transactionResponse['transaction_id'],
            'date' => dbDateFormat($order['created_at'])
        ]);
        $cartItems = cartItems();
        
        $orderItems = []; 
        
        foreach($cartItems as $item) {
            $orderItems[] = [
                'product_id' => $item->id,
                'quantity'  =>  $item->qty,
                'real_price' => $item->price,
                'sell_price' => $item->price ?? 10,
                'variation_id' => $item->options->variation_id ?? null
            ];
        }
        $order->orderItems()->createMany($orderItems);
        
        $chargesArr = [];
        if(session()->has('tax')) {
            foreach(session('tax') as $tax) {
                $chargesArr[] = [
                    'name' => $tax['name'],
                    'charge' => $tax['taxInDollar'],
                    'type' => 'tax'
                ];
            }
        }

        if(session()->has('shipping')) {
            foreach(session('shipping') as $tax) {
                $chargesArr[] = [
                    'name' => $tax['name'],
                    'charge' => $tax['tax'],
                    'type' => 'shipping'
                ];
                
            }
        }

        if(session()->has('coupon')) {
            $coupon = session('coupon');
            $chargesArr[] = [
                'name' => $coupon['code'],
                'charge' => $coupon['charge'],
                'type' => 'coupon'
            ];
        }
        $order->orderCharges()->createMany($chargesArr);
        $order = Order::with('shippingAddress','billingAddress')->latest()->first();
        $userData = User::where('id', $user['id'])->first();
        CustomerOrderJob::dispatch($order, $userData);
        return true;
       }catch (Exception $ex) {
        \Log::error($ex);
        return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
       }
    }
    
    
    public function createAddress($user, $input,$addressTypeArray) 
    {
        //store address and payment detail in address table
        foreach ($addressTypeArray as $type) {
            $address = Address::create([   
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'mobile' => $input['phone_number'] ?? $input['mobile'],
                'address' => $input['address'],
                'state' => $input['state'],
                'city' => $input['city'],
                'zipcode' => $input['zipcode'],
                'user_id' => $user['id'],
                'type' => $type
            ]);
            // if($type == 'order') return $address["id"];
        }
        return Address::where('user_id',$user['id'])->where('type','order')->orderBy('id','DESC')->first()->id;
    }

    public function updateAddress($user,$address_id,$input) 
    {
        
            // $address = Address::find($address_id);
            $data =[   
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'mobile' => $input['phone_number'],
                'address' => $input['address'],
                'state' => $input['state'],
                'city' => $input['city'],
                'zipcode' => $input['zipcode'],
                'user_id' => $user['id'],
                // 'type' => $address['type']
            ];
            
            // $address->update($data);
            Address::where('id',$address_id)->update($data);
            return $this->createAddress($user,$data,['order']);
        //   Address::where('user_id',$user['id'])->where('type','order')->first()->id;
    }


    public function createOrderAddress($user,$address_id,$input)
    { 
        // $address = Address::find($address_id);
        if($address_id != ' '){
            return $this->updateAddress($user,$address_id,$input);
        }else{
            return $this->createAddress($user,$input,['order']);
        }
    }

    public function destroyOrderSession(){
        \Session::forget(["discount", "totalAmount","coupon_code","tax","shipping","coupon",'free-product']);
        \Cart::destroy();
    }

    public function checkShippingTax($shippingState)
    {
        $allTax = Tax::select('name','state','tax')->where("status",'1')->where("state",$shippingState)->get();
        $allShipping  = Shipping::select("zone_name as name", "state","fixed_amount as tax")->where("state",$shippingState)->where("status","1")->get();
        
        \Session::forget(["tax","shipping"]);
        \Session::put(["tax" => $allTax, "shipping" => $allShipping]);
        return true;
    }

    /**
     * Load thank you page
     * 
     */
    public function thankyou() {
        if(session()->has('thankyou')) {
            $order = session('thankyou');
            return view('frontend.pages.checkout.thank-you-page',compact('order'));
        }
        abort(404);
    }
}