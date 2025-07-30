@extends('frontend.pages.dashboard.user-base', ['title' => 'My Orders','subtitle' => 'Order Details', 'titleUrl' => route('orders.index') ])
@section('user-section')
<div class="dashboard-right-block">
    <div class="order-view-block">
        <div class="order-info-block mb-3 d-md-flex justify-content-between">
            <div class="order-describe-block">
                <h5 class="text-uppercase">Order #{{$order->order_id ?? '-'}}</h5>
                <div class="specification-btn-hide">
                    {{-- <a class="btn-primary" href="{{route('user.review.create',$order->id)}}">Review</a> --}}
                    {{-- <a class="btn-primary" href="{{url('/review/create/?orderId=.'$order->orderItems[0]->product_id'.')}}">Review</a> --}}
                </div>
                <p class="font-weight-bold mt-2">Order #{{$order->order_id ?? '-'}} was placed on <a href="">{{dateFormatWithMonthName($order->created_at) ?? '-'}}</a> and is currently <a href="">{{$order->order_status == 1 ? 'Processing' : ($order->order_status == 2 ? 'On hold' : 'Completed') }}</a>.</p>
            </div>
            <div class="order-download-block">
                <a href="{{ route('orders.downloadInvoice',$order->id) }}" class="btn-primary" data-toggle="tooltip" data-placement="top" data-original-title="Download Invoice">
                    <img src="{{ asset('front-end/assets/image/invoice-download-icon.svg') }}" alt="" class="mr-2"> Download Invoice
                </a>
            </div>
        </div>
        <div class="order-address-block">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="card address-card-block mt-2 mb-2">
                        <div class="address-title">
                            <h5 class="text-uppercase">billing address <span class="text-uppercase pt-2"></span></h5>
                        </div>
                        <div class="user-detail-block mt-2">
                            <p><span class="arrow-icon"><i data-feather="user" class="feather mr-2"></i></span>{{$order->billingAddress->first_name ?? ''}} {{$order->billingAddress->last_name ?? ''}}</p>
                            <p><span class="arrow-icon"><i data-feather="navigation" class="feather mr-2"></i></span>{{$order->billingAddress->address ?? 'NA'}}</p>
                            <p><span class="arrow-icon"><i data-feather="globe" class="feather mr-2"></i></span>{{$order->billingAddress->city ?? 'NA'}}</p>
                            <p><span class="arrow-icon"><i data-feather="map-pin" class="feather mr-2"></i></span>{{$order->billingAddress->state ?? ''}}, {{$order->billingAddress->zipcode ?? ''}}</p>
                            <p><span class="arrow-icon"><i data-feather="phone" class="feather mr-2"></i></span>{{$order->billingAddress->mobile ?? 'NA'}}</p>
                            <p><span class="arrow-icon"><i data-feather="mail" class="feather mr-2"></i></span>{{$order->billingAddress->email ?? 'NA'}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="card address-card-block mt-2 mb-2">
                        <div class="address-title">
                            <h5 class="text-uppercase">shipping address <span class="text-uppercase pt-2"></span></h5>
                        </div>
                        <div class="user-detail-block mt-2">
                            <p><span class="arrow-icon"><i data-feather="user" class="feather mr-2"></i></span>{{$order->shippingAddress->first_name ?? 'NA'}} {{$order->shippingAddress->last_name ?? ''}}</p>
                            <p><span class="arrow-icon"><i data-feather="navigation" class="feather mr-2"></i></span>{{$order->shippingAddress->address ?? 'NA'}}</p>
                            <p><span class="arrow-icon"><i data-feather="globe" class="feather mr-2"></i></span>{{$order->shippingAddress->city ?? ''}}</p>
                            <p><span class="arrow-icon"><i data-feather="map-pin" class="feather mr-2"></i></span>{{$order->shippingAddress->state ?? 'NA'}}, {{$order->shippingAddress->zipcode ?? ''}}</p>
                            <p><span class="arrow-icon"><i data-feather="phone" class="feather mr-2"></i></span>{{$order->shippingAddress->mobile ?? 'NA'}}</p>
                            <p><span class="arrow-icon"><i data-feather="mail" class="feather mr-2"></i></span>{{$order->shippingAddress->email ?? 'NA'}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card order-table-block mt-4">
            <div class="table-responsive">
                <table class="table table-strip my-order">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:45%" class="text-left">Order Item</th>
                            <th style="width:15%" class="text-center">Price</th>
                            <th style="width:10%" class="text-center">Qty</th>
                            <th style="width:10%" class="text-center">Total</th>
                            @if($order->order_status == 3)
                            <th style="width:10%" class="text-center">Review</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order["orderItems"] as $key => $item)
                        <tr>
                            <td class="d-block">
                                <div class="product-title d-flex align-items-center mb-3">
                                    {{-- <h5 class="text-uppercase"></h5> --}}
                                    <div class="order-product-img">
                                        <img src="{{$item->product->getMedia('featured_product_image')->first() ? $item->product->getMedia('featured_product_image')->first()->getUrl()  : asset('front-end/assets/image/single-product-1.jpg') }}" style="height:auto;width:60px;" />
                                    </div>
                                    <div class="product-titled-flex align-items-center">
                                        <h5 class="text-uppercase mb-0 ml-3">{{$item->product->name ?? '-'}}</h5>
                                    </div>
                                </div>
                                <!-- <div class="specification-btn-hide">
                                    <a class="btn-primary view-more">View More</a>
                                </div> -->
                                @if($item['productVariation'])
                                <div class="product-specification-block order-item-detail mt-4">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Variation</th>
                                            </tr>
                                        </thead>
                                        <tbody>    
                                            @foreach ($item['productVariation']['variation'] as $attrKey => $attrVal)
                                            <tr>
                                                <td class="table-left-block">
                                                    {{ $attrVal['attribute']['name'] ?? "-"}}
                                                </td>
                                                <td>
                                                    {{ $attrVal["name"] ?? "-"}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            <!-- <tr>
                                                <td class="table-left-block">Size</td>
                                                <td>1 INCH, 30 MM</td>
                                            </tr>
                                            <tr>
                                                <td class="table-left-block">Model</td>
                                                <td>Encore/Omega-Tactical, Contender Rifle &amp; Pistol, Encore/Flat Rimfire, Encore/Omega, Encore/Omega-EER, Encore/Pistol, Strike-3" to 4" eye relief, Strike-4" to 5 1/2" eye relief, TC Venture &amp; TC Compass</td>
                                            </tr>
                                            <tr>
                                                <td class="table-left-block">Action</td>
                                                <td>Long Action, NA, Normal, Short Action</td>
                                            </tr>
                                            <tr>
                                                <td class="table-left-block">Height</td>
                                                <td>High, Low, Medium, X-High</td>
                                            </tr>
                                            <tr>
                                                <td class="table-left-block">Color</td>
                                                <td>Black, Silver, apg-camo, Camo</td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </td>
                            <td class="text-center align-baseline">
                                @if($item->real_price == 0)
                                <p class="text-danger">Free</p>
                                @else
                                <p>{{'₹'.number_format($item->sell_price, 2) ?? '-'}}</p>
                                @endif

                            </td>
                            <td class="text-center align-baseline">
                                <p>{{$item->quantity ?? '-'}} Item</p>
                            </td>
                            <td class="text-center align-baseline">
                                @if($item->real_price == 0)
                                <p class="text-danger">Free</p>
                                @else
                                <p>{{'₹'.number_format(($item->sell_price*$item->quantity), 2) ?? '-'}}</p>
                                @endif
                            </td>
                            @if($order->order_status == 3)
                            @php
                                $cron = collect($order->reviews)->pluck('product_id')->toArray();
                            @endphp
                            <td class="text-center align-baseline">
                                <a href="{{ route('user.review.create',["slug" => $item->product->slug, "order_id" => $order->order_id]) }}" class="btn-primary">
                                    {{ in_array( $item->product_id, $cron) > 0 ? 'Reviewed' : 'Review'}}
                                </a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="order-payment-block">
            <div class="order-payment-field d-flex align-items-center justify-content-between">
                <div class="order-payment-text">
                    <p>Sub Total</p>
                </div>
                <div class="order-payment-price">
                    <p>${{ number_format(collect($order["orderItems"])->sum('total_amount'), 2) }}</p>
                    {{-- <p>${{collect($order["amount"])}}</p> --}}

                </div>
            </div>
            @if(count($order["orderCharges"]))
            @foreach($order["orderCharges"] as $charge)
            <div class="order-payment-field d-flex align-items-center justify-content-between">
                <div class="order-payment-text">
                    <p><span class="text-uppercase">{{$charge['type'] ?? 'NA'}}</span> ({{ $charge['name']}})</p>
                </div>
                <div class="order-payment-price">
                    <p>{{$charge['type'] == 'coupon' ? '- ' : ''}}${{isset($charge['charge']) ? number_format($charge['charge'],2) : 0}}</p>
                </div>
            </div>
            @endforeach
            @else
            <div class="order-payment-field d-flex align-items-center justify-content-between">
                <div class="order-payment-text">
                    <p><span class="text-uppercase">Tax</p>
                </div>
                <div class="order-payment-price">
                    <p>$0.00</p>
                </div>
            </div>
            <div class="order-payment-field d-flex align-items-center justify-content-between">
                <div class="order-payment-text">
                    <p><span class="text-uppercase">Shipping</p>
                </div>
                <div class="order-payment-price">
                    <p>$0.00</p>
                </div>
            </div>
            @endif
            {{-- <div class="order-payment-field payment-method-field d-flex align-items-center justify-content-between">
                <div class="order-payment-text">
                    <p class="mb-0">Payment Method</p>
                </div>
                <div class="order-payment-price">
                    <p class="mb-0">Authorized.net</p>
                </div>
            </div> --}}
        </div>
        <div class="total-payment-field d-flex align-items-center justify-content-between">
            <div class="total-payment-text">
                <p class="text-uppercase">Total</p>
            </div>
            <div class="total-payment-price">
                <p>${{number_format($order["amount"], 2)}}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('user-javascript')
<!-- <script>
        $(document).on('click','.view-more',function () {
            let className = $(".order-item-detail").hasClass('d-none');
            if(className == true){
                $(".order-item-detail").removeClass('d-none')
            }else{
                $(".order-item-detail").addClass('d-none')
            }
        });
</script> -->
@endsection