<div class="modal fade {{ isset($order) ? ' ' : 'modal-create' }}" id="{{ isset($order) ? 'editOrderModal' : 'OrderModal' }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fe-icon mr-2" data-feather="book-open"></i>Order Details</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="order-view-modal">

                    <div class="order-info-block mb-3 d-md-flex justify-content-between">
                        <div class="order-describe-block">
                            <h5 class="text-uppercase">Order ID #{{$order->order_id ?? '-'}}</h5>
                            {{-- <div class="specification-btn-hide">
                                <a class="btn-primary" href="{{route('user.review.create')}}">Review</a> --}}
                            </div>
                            <p class="font-weight-bold">Order #{{$order->order_id ?? '-'}} was placed on <a href="">{{dateFormatWithMonthName($order->created_at) ?? '-'}}</a> and is currently <a href="">{{$order->order_status == 1 ? 'Processing' : ($order->order_status == 2 ? 'On hold' : 'Completed') }}</a>.</p>
                        </div>
                        {{-- <div class="order-download-block">
                            <a href="{{ route('orders.downloadInvoice',$order->id) }}" class="btn-primary"><img src="{{ asset('front-end/assets/image/invoice-download-icon.svg') }}" alt="" class="mr-2"> Download Invoice</a>
                        </div> --}}
                    </div>

                    <div class="card order-table-block mt-4">
                        <div class="table-responsive">
                            <table class="table table-strip my-order">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width:55%" class="text-left">Item</th>
                                        <th style="width:15%" class="text-center">Qty</th>
                                        <th style="width:15%" class="text-center">Price</th>
                                        <th style="width:15%" class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order["orderItems"] as $key => $item)
                                    <tr>
                                        <td>
                                            <div class="product-title mb-3">
                                                {{-- <h5 class="text-uppercase"></h5> --}}
                                                <img src="{{$item->product->getMedia('featured_product_image')->first() ? $item->product->getMedia('featured_product_image')->first()->getUrl()  : asset('front-end/assets/image/single-product-1.jpg') }}" style="height:auto;width:100px;"/>
                                            </div>
                                            <div class="product-title mb-4 d-flex align-items-center">
                                                <h5 class="text-uppercase mb-0 mr-3">{{$item->product->name ?? '-'}}</h5>
                                                {{-- <div class="specification-btn-hide">
                                                    <a class="btn-primary view-more">View More</a>
                                                </div> --}}
                                            </div>
                                            {{-- <div class="product-specification-block order-item-detail">
                                                <table class="table table-bordered table-hover">
                                                    <tbody>
                                                        @foreach ($item->product->productAttribute as $attrKey => $attrVal)
                                                            <tr>
                                                                <td class="table-left-block">
                                                                    {{ $attrVal->attribute->name ?? '' }}
                                                                </td>
                                                                <td>
                                                                    @if($attrVal->totalVariation)
                                                                        @foreach ($attrVal->totalVariation as $varKey => $varVal)
                                                                            {{$varVal->name}}, 
                                                                        @endforeach
                                                                    @endif
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
                                            </div> --}}
                                        </td>
                                        <td class="text-center align-baseline">
                                            <p>{{$item->quantity ?? '-'}} Item</p>
                                        </td>
                                        <td class="text-center align-baseline">
                                            <p><del class="mr-1">{{'₹'.$item->real_price ?? '-'}}</del> <ins>{{'₹'.$item->sell_price ?? '-'}}</ins></p>
                                        </td>
                                        <td class="text-center align-baseline">
                                            <p>{{'₹'.($item->sell_price*$item->quantity) ?? '-'}}</p>
                                        </td>
                                    </tr>                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="order-payment-block">
                        <div class="order-payment-field d-flex align-items-center justify-content-between">
                            <div class="order-payment-text">
                                <p>SubTotal</p>
                            </div>
                            <div class="order-payment-price">
                                <p>${{collect($order["orderItems"])->sum('total_amount')}}</p>
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
                                        <p>{{$charge['type'] == 'coupon' ? '-' : ''}}${{isset($charge['charge']) ? number_format($charge['charge'],2) : 0}}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="order-payment-field payment-method-field d-flex align-items-center justify-content-between">
                            <div class="order-payment-text">
                                <p class="mb-0">Payment Method</p>
                            </div>
                            <div class="order-payment-price">
                                <p class="mb-0">Authorized.net</p>
                            </div>
                        </div>
                    </div>
                    <div class="total-payment-field d-flex align-items-center justify-content-between">
                        <div class="total-payment-text">
                            <p class="text-uppercase">Total</p>
                        </div>
                        <div class="total-payment-price">
                            <p>${{number_format($order["amount"],2)}}</p>
                        </div>
                    </div>
                    {{-- <div class="order-address-block">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="card address-card-block mt-2 mb-2">
                                    <div class="address-title">
                                        <h5 class="text-uppercase">billing address <span class="text-uppercase pt-2"></span></h5>
                                    </div>
                                    <div class="user-detail-block mt-2">
                                        <p>{{$order->billingAddress->first_name ?? ''}} {{$order->billingAddress->last_name ?? ''}}</p>
                                        <p>DNZ Products</p>
                                        <p>{{$order->billingAddress->address ?? ''}}</p>
                                        <p>{{$order->billingAddress->city ?? ''}}</p>
                                        <p>{{$order->billingAddress->state ?? ''}}, {{$order->billingAddress->zipcode ?? ''}}</p>
                                        <p>{{$order->billingAddress->mobile ?? ''}}</p>
                                        <p>{{$order->billingAddress->email ?? ''}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="card address-card-block mt-2 mb-2">
                                    <div class="address-title">
                                    <h5 class="text-uppercase">shipping address <span class="text-uppercase pt-2"></span></h5>
                                    </div>
                                    <div class="user-detail-block mt-2">
                                        <p>{{$order->shippingAddress->first_name ?? ''}} {{$order->shippingAddress->last_name ?? ''}}</p>
                                        <p>DNZ Products</p>
                                        <p>{{$order->shippingAddress->address ?? ''}}</p>
                                        <p>{{$order->shippingAddress->city ?? ''}}</p>
                                        <p>{{$order->shippingAddress->state ?? ''}}, {{$order->shippingAddress->zipcode ?? ''}}</p>
                                        <p>{{$order->shippingAddress->mobile ?? ''}}</p>
                                        <p>{{$order->shippingAddress->email ?? ''}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="row">
                        <div class="col-lg-4 col-sm-4">
                            <h4>Deatils</h4>
                            <span>Order ID: {{ $order->order_id ?? '-'}}</span>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <h4>Shipping Address</h4>
                            <p>{{ $order->shippingAddress->first_name ?? ('-' . ' ' . $order->shippingAddress->last_name ?? '-') }}
                            </p>
                            <p>{{ $order->shippingAddress->email ?? '-' }}</p>
                            <p>{{ $order->shippingAddress->mobile ?? '-' }}</p>
                            <p>{{ $order->shippingAddress->address ?? '-' }}</p>
                            <p>{{ $order->shippingAddress->state ?? '-' }}</p>
                            <p>{{ $order->shippingAddress->city ?? '-' }}</p>
                            <p>{{ $order->shippingAddress->zipcode ?? '-' }}</p>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <h4>Billing Address</h4>
                            <p>{{ $order->billingAddress->first_name ?? ('-' . ' ' . $order->billingAddress->last_name ?? '-') }}</p>
                            <p>{{ $order->billingAddress->email ?? '-' }}</p>
                            <p>{{ $order->billingAddress->mobile ?? '-' }}</p>
                            <p>{{ $order->billingAddress->address ?? '-' }}</p>
                            <p>{{ $order->billingAddress->state ?? '-' }}</p>
                            <p>{{ $order->billingAddress->city ?? '-' }}</p>
                            <p>{{ $order->billingAddress->zipcode ?? '-' }}</p>
                        </div>
                    </div>
                    <form id="{{ isset($order) ? 'editOrderForm' : 'addOrderForm' }}" class="{{ isset($order) ? 'update-order' : 'save-order' }}" action="{{ isset($order) ? route('order.update', $order['id']) : route('order.store') }}" autocomplete="off">
                        @csrf
                        @method(isset($order) ? 'put' : 'post')
                        <!-- <div class="col-lg-6 col-sm-6">
                        <div class="form-group Order-input">
                            <label>Customer Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control name" name="name" id="name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100" data-msg-required="{{ __('required_Order_name') }}" value="{{ isset($order) ? $order['customer']['full_name'] : '' }}">
                            <span class="text-danger error name-error"></span>
                        </div>
                        </div> -->
                        <div class="col-lg-12 col-sm-12">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" width="5%">S.No.</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col" class="text-center">Regular Price</th>
                                        <th scope="col" class="text-center">Sell Price</th>
                                        <th scope="col" class="text-center">Quantity</th>
                                        <th scope="col" class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order['orderItems'] as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-capitalize">{{ $item->product->name ?? '-' }}</td>
                                            <td class="text-center">{{ '₹' . $item->real_price ?? '-' }}</td>
                                            <td class="text-center">{{ '₹' . $item->sell_price ?? '-' }}</td>
                                            <td class="text-center">{{ $item->quantity ?? '-' }}</td>
                                            <td class="text-center">{{ '₹' . $item->sell_price * $item->quantity ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" style="text-align: end;font-weight:700;">Total</td>
                                        <td class="text-center text-danger" style="font-weight:700">${{ collect($order['orderItems'])->sum('total_amount') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form> --}}
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary common-btn">{{ isset($order) ? 'Update' : 'Add' }}</button>
            </div> -->
        </div>
    </div>
</div>