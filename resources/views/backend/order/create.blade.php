<div class="modal fade {{ isset($order) ? ' ' : 'modal-create' }}"
    id="{{ isset($order) ? 'editOrderModal' : 'OrderModal' }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fe-icon mr-2" data-feather="book-open"></i>Order Details</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <h5 class="text-uppercase">Order ID #{{ $order->order_id ?? '-' }}</h5>
                        <p>Order <span class="font-weight-bold">#{{ $order->order_id ?? '-' }}</span> was placed on 
							<span class="font-weight-bold">{{ dateFormatWithMonthName($order->created_at) ?? '-' }}</span> and is
                            currently <span class="font-weight-bold">{{ $order->order_status == 1 ? 'Processing' : ($order->order_status == 2 ? 'On hold' : 'Completed') }}</span>.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="card order-view-modal-popup">
                                <div class="card-body">
                                    <div class="address-title">
                                        <h5>Customer Details</h5>
                                        <hr>
                                    </div>
                                    <div class="mt-2">
                                        <h6 class="text-capitalize">{{ $order->customer->first_name ?? '-' }}
                                            {{ $order->customer->last_name ?? '-' }}</h6>
                                        <h6>{{ $order->customer->email ?? '-' }}</h6>
                                        <h6>{{ $order->customer->mobile ?? '-' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="card order-view-modal-popup">
                                <div class="card-body">
                                    <div class="address-title">
                                        <h5>Billing Address</h5>
                                        <hr>
                                    </div>
                                    <div class="mt-2">
                                        <h6 class="text-capitalize">{{ $order->billingAddress->first_name ?? '' }}
                                            {{ $order->billingAddress->last_name ?? '' }}</h6>
										<h6>{{ $order->billingAddress->email ?? '' }}</h6>
										<h6>{{ $order->billingAddress->mobile ?? '' }}</h6>
                                        <h6 class="text-capitalize">{{ $order->billingAddress->address ?? '' }}</h6>
                                        <h6 class="text-capitalize">{{ $order->billingAddress->city ?? '' }}</h6>
                                        <h6 class="text-capitalize">{{ $order->billingAddress->state ?? '' }},
                                            {{ $order->billingAddress->zipcode ?? '' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="card order-view-modal-popup">
                                <div class="card-body">
                                    <div class="address-title">
                                        <h5>Shipping Address</h5>
                                        <hr>
                                    </div>
                                    <div class="mt-2">
                                        <h6 class="text-capitalize">{{ $order->shippingAddress->first_name ?? '' }}
                                            {{ $order->shippingAddress->last_name ?? '' }}</h6>
										<h6 class="text-capitalize">{{ $order->shippingAddress->email ?? '' }}</h6>
										<h6>{{ $order->shippingAddress->mobile ?? '' }}</h6>
                                        <h6 class="text-capitalize">{{ $order->shippingAddress->address ?? '' }}</h6>
                                        <h6 class="text-capitalize">{{ $order->shippingAddress->city ?? '' }}</h6>
                                        <h6 class="text-capitalize">{{ $order->shippingAddress->state ?? '' }},
                                            {{ $order->shippingAddress->zipcode ?? '' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="view-order-modal-block">
                        <div class="row mt-3">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:15%" class="text-left">Item</th>
                                            <th style="width:40%" class="text-left">Product Name</th>
                                            <th style="width:15%" class="text-center">Qty</th>
                                            <th style="width:15%" class="text-center">Price</th>
                                            <th style="width:15%" class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="admin-table">
                                        @foreach ($order['orderItems'] as $key => $item)
                                        <tr>
                                                <td>
                                                    <img src="{{ $item->product->getMedia('featured_product_image')->first()? $item->product->getMedia('featured_product_image')->first()->getUrl(): asset('front-end/assets/image/single-product-1.jpg') }}"
                                                        style="height:90px;width:90px;" />
                                                </td>
                                                <td>
                                                    <p class="{{$item['productVariation'] ? 'product-title' : "" }} font-weight-bold mb-3">{{ $item->product->name ?? '-' }}</p>
                                                    @if ($item['productVariation'])
                                                    <p>
                                                        <span class="font-weight-bold">SKU </span><span> : </span><span> {{$item['productVariation']['sku']}}</span>
                                                    </p>  
                                                    
                                                        @foreach ($item['productVariation']['variation'] as $attrKey => $attrVal)
                                                        <p>
                                                                <span class="font-weight-bold">{{ $attrVal['allAttribute']['name'] ?? '-' }}</span>
                                                                <span>:</span>
                                                                <span>{{ $attrVal['name'] ?? '-' }}</span>
                                                            </p>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <p>{{ $item->quantity ?? '-' }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <p>{{ '₹' . number_format($item->sell_price, 2) ?? '-' }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <p>{{ '₹' . number_format($item->sell_price * $item->quantity, 2) ?? '-' }}
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: right;"><b>SubTotal :</b></td>
                                            <td style="text-align: right; padding-right: 32px">
                                                <span>${{ number_format(collect($order['orderItems'])->sum('total_amount'), 2) }}</span>
                                            </td>
                                        </tr>
                                        @if (count($order['orderCharges']))
                                            @foreach ($order['orderCharges'] as $charge)
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td style="text-align: right;">
                                                        <b>{{ ucfirst($charge['type']) ?? 'NA' }}
                                                            ({{ $charge['name'] }}) :</b>
                                                    </td>
                                                    <td style="text-align: right; padding-right: 32px">
                                                        <span>{{ $charge['type'] == 'coupon' ? '- ' : '' }}${{ isset($charge['charge']) ? number_format($charge['charge'], 2) : 0 }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align: right;">
                                                    <b>Tax :</b>
                                                </td>
                                                <td style="text-align: right; padding-right: 32px">
                                                    <span>$0.00</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align: right;">
                                                    <b>Shipping :</b>
                                                </td>
                                                <td style="text-align: right; padding-right: 32px">
                                                    <span>$0.00</span>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: right;"><b>Total :</b></td>
                                            <td style="text-align: right; padding-right: 32px">
                                                <span>${{ number_format($order['amount'], 2) }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
