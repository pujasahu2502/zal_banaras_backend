@extends('frontend.layouts.include.app', ['title' => 'Checkout'])
@section('content')

<!-- --------Start-breadcrumb-section--------- -->
<section class="breadcrumb-bg-section faq-bg-section">
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/home">Home</a></li>
                    <li class="breadcrumb-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </nav>
        </div>
        <div class="breadcrumb-bg-block mb-3">
            <h4>Payment Checkout</h4>
        </div>
    </div>
</section>
<!-- --------End-breadcrumb-section--------- -->

<!-- --------Start-Cart-section--------- -->
<section class="cart-section">
    <div class="container">
        @include("frontend.pages.checkout.include.guest-message")
        <div class="checkout-block">
            <form id="checkout-form">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <!-- <input type="hidden" id="" value="bill_state"> -->
                        <div class="address-form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="order-payment-form">
                                        <div class="payment-heading mb-4">
                                            <h4 class="text-uppercase">Billing Address</h4>
                                        </div>
                                        <div class="pb-3">
                                            @if(count($allAddress))
                                            <div class="form-group">
                                                <div class="custom_select mb-4">
                                                    <select class="form-control bill bill_state placeholder-select w-100 fillDataOnAddress" name="address_type" data-location="billing">
                                                        <option disabled selected>Select address</option>
                                                        @forelse ($allAddress as $addressKey => $address)
                                                        <option value="{{route('fill.address',$address->id)}}" data-value="{{$addressKey}}" data-state="{{$address->id}}" {{$address->default_address == "1" ? "selected" : ""}}>{{($address->first_name ?? '').' '.($address->last_name ?? '').' '.($address->email ?? '').' '.($address->mobile ?? '').' '.($address->address ?? '').' '.($address->city ?? '').' '.($address->state ?? '').' '.($address->zipcode ?? '') }}</option>
                                                        @empty
                                                        <option value="" disabled> No Address Found!</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <input type="text" required="" class="form-control bill first_name alpha" name="first_name" id="first_name" value="{{old('first_name')}}" placeholder="First Name *">
                                                <label class="text-danger error first_name-error"></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" class="form-control bill last_name alpha" name="last_name" id="last_name" value="{{old('last_name')}}" placeholder="Last Name *">
                                                <label class="text-danger error last_name-error"></label>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control bill mobile numberonly" required="" type="text" name="phone_number" id="phone_number" value="{{old('phone_number')}}" placeholder="Mobile Number *">
                                                <label class="text-danger error phone_number-error"></label>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control bill email" required="" type="email" name="email" id="email" value="{{old('email')}}" placeholder="Email *">
                                                <label class="text-danger error email-error"></label>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control bill address" name="address" value="{{old('address')}}" id="address" required="" placeholder="Address *">
                                                <label class="text-danger error address-error"></label>
                                            </div>

                                            <div class="form-group">
                                                <div class="custom_select">
                                                    <select class="form-control bill bill_state placeholder-select w-100 state" id="state" name="state" data-state="billing">
                                                        <option disabled="" selected="">Select state*</option>
                                                            @foreach (getUsState() as $key => $state)
                                                                <option {{ old('state') == $state ? 'selected="selected"' : '' }} value="{{ $state }}" data-value="{{ $key }}" data-state="{{ $state }}">{{$state .' - '.($key)}} </option>
                                                            @endforeach
                                                    </select>
                                                    <label class="text-danger error state-error"></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control bill city alpha" required="" type="text" id="city" name="city" value="{{old('city')}}" placeholder="City / Town *">
                                                <label class="text-danger error city-error"></label>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control bill zipcode" required="" type="text" id="zipcode" name="zipcode" value="{{old('zipcode')}}" placeholder="Zipcode *">
                                                <label class="text-danger error zipcode-error"></label>
                                            </div>
                                            <div class="form-group">
                                                <input class="bill" type="checkbox" id="filladdress" data-count={{count($allAddress)}} name="filladdress" value="1" checked>
                                                <label for="filladdress"> Same As Billing Address</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 shipping-form"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="payment-order-block">
                            <div class="order-card-block d-flex justify-content-between align-items-center mb-3">
                                <div class="payment-heading ">
                                    <h5 class="text-uppercase mb-0">Order Summary <a href="#"><span>({{count($cartItems)}})</span></a></h5>
                                </div>
                                {{-- <div class="order-edit-block">
                                    <a href="{{route('cart.list')}}" class="order-action-btn edit-btn d-flex"><img src="{{ asset('front-end/assets/image/edit-icon.svg') }}" alt="" class="mr-2"> Edit</a>
                                </div> --}}
                            </div>
                            <div class="outer-order-card-block mb-2">
                             
                                @foreach ($cartItems as $item)
                                @if(!$item->options->coupon)
                                <div class="card order-card">
                                    <div class="order-inner-block">
                                        <div class="order-img align-self-center">
                                            <img width="270" height="161" src="{{ $item->options->image }}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" sizes="(max-width: 270px) 100vw, 270px">
                                        </div>
                                        <div class="order-content">
                                            <h6 class="text-uppercase">{{$item->name ?? ''}}</h6>
                                            <p class="text-uppercase">
                                                Qty : {{$item->qty}}
                                            </p>
                                            <p class="text-uppercase">
                                                @forelse ($item->options->attribute as $key => $attribute)
                                                {{ $key.' : '.$attribute.',' }}
                                                @empty
                                                {{-- No Configration Found! --}}
                                                @endforelse
                                            </p>
                                        </div>
                                        <div class="order-price">
                                            <p>{{ $item->price ? '₹'.number_format($item->price,2) : '$0.00'}}</p>
                                        </div>
                                    </div>
                                </div>
                                @else
                                @include('frontend.pages.checkout.include.free-product')
                                @endif

                                @endforeach
                            </div>
                            <div class="main-payment-block">
                                <div class="order-payment-field d-flex align-items-center justify-content-between subtotal">
                                    <div class="order-payment-text">
                                        <p class="text-uppercase">Cart Sub Total</p>
                                    </div>
                                    <div class="order-payment-price">
                                        <p>${{ $totalPrice }}</p>
                                    </div>
                                </div>

                                @include('frontend.pages.checkout.include.tax-shipping',["title" => "shipping"])

                                @include('frontend.pages.checkout.include.tax-shipping',["title" => "tax"])
                                <div class="order-payment-field promo-code d-none">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="order-payment-text">
                                            <p class="text-uppercase">Promocode</p>
                                        </div>
                                        
                                        <div class="order-payment-price">
                                            <p class="discount">${{ Session::get('discount') ?? 0.00 }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="promo-inner-block">
                                    <div class="form-group formgroup-input mb-0">
                                        <img src="{{ asset('front-end/assets/image/coupon-icon.svg') }}" alt="">
                                        <input type="text" class="form-control coupon-code" placeholder="Enter Promo Code" name="promo_code" maxleng="" th="20" data-bvalidator="required,maxlength[20]" data-bvalidator-msg=" ">
                                        <button class="btn-primary apply-code-btn apply-coupon" type="button" data-url="{{route("coupon")}}">Apply</button>
                                    </div>
                                    <span class="error coupon-error"></span>
                                </div>
                                @if(Session::has('coupon_code'))
                                @include('frontend.pages.checkout.include.coupon-message')
                                @endif
                                <div class="total-payment-block d-flex align-items-center justify-content-between mt-3">
                                    <div class="payment-text">
                                        <p class="text-uppercase">total Amount</p>
                                    </div>
                                    <div class="payment-price">
                                        <p class="amount">${{ Session::get('totalAmount') ?? $totalPrice }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="order-review mt-4">
                            <div class="payment_method">
                                <div class="payment-heading mb-4">
                                    <h5 class="text-uppercase">Payment</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text log font-weight-bold">-</div>
                                            </div>
                                            <input type="text" class="form-control card_number number-data" name="card_number" id="card-number" required="" value="{{old('card_number')}}" placeholder="Card Number *" autocomplete="cc-number" inputmode="numeric" pattern="[0-9\s]{13,19}">
                                        </div>
                                        <label class="text-danger error card_number-error"></label>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="custom_select">
                                                    <select class="form-control placeholder-select" name="month" id="" required="" value="{{old('month')}}">
                                                        <option disabled selected>Expiry Month</option>
                                                        @foreach ( getMonths() as $monthKey => $month)
                                                        <option value="{{$monthKey}}">{{$month}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="text-danger error month-error"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="custom_select">
                                                    <select class="form-control placeholder-select" name="year" required="" value="{{old('year')}}" id="">
                                                        <option disabled selected>Expiry Year</option>
                                                        @foreach(getLatestYears() as $year)
                                                        <option value="{{$year}}">{{$year}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="text-danger error year-error"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control ship cvc number-data" name="cvc" id="" required="" value="{{old('cvc')}}" placeholder="CVV / CVC *">
                                                <label class="text-danger error cvc-error"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="paynow btn-primary w-100 mt-2 btn-submit" data-url-checkout="{{ route('checkout.makePayment.store') }}" data-url="{{ route('thank-you') }}">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- --------End-Cart-section--------- -->

@endsection

@section('javascript')
<script>
    var states = '{!!json_encode(getUsState())!!}';
    var addresses = '{!!json_encode($allAddress)!!}'
    var fillAddressUrl = "{{route('fill.address','DNZTEMPDATA')}}";
    var taxShippingCalculation = "{{route('tax.shipping.calculation')}}"
</script>
<script src="{{asset('front-end/payment.js')}}"></script>
<script src="{{ asset('front-end/credit-card-validator.js') }}"></script>
<script src="{{ asset('front-end/checkout.js') }}"></script>
@endsection