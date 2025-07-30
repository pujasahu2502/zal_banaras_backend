@extends('frontend.layouts.include.app', ['title' => 'Add to Cart'])
@section('content')
@if(count($cartItems))
<section class="cart-section">
    <div class="container">
        <div class="wrap">
            <header class="cart-header">
                <strong>Items in Your Cart</strong>
            </header>
            <div class="table-responsive">
                <table class="product-table" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="product-remove">#</th>
                            <th class="product-thumbnail"></th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-subtotal">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cartItems as $key => $item)
                            @if($item->options->coupon == false)
                                <tr>
                                    <td class="product-remove">
                                        <a href="{{ route('cart.remove',['cart'=> $key]) }}" class="remove" aria-label="Remove this item" data-toggle="tooltip" title="Remove">×</a>
                                    </td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img width="270" height="161" src="{{ $item->options->image }}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" sizes="(max-width: 270px) 100vw, 270px" onerror="this.remove()"></a>
                                    </td>
                                    <td class="product-name text-capitalize" data-title="Product">
                                        {{ $item->name }}
                                        @if($item->options["attribute"])
                                            {{-- <a href="javascript:;" class="view-more">View Details</a> --}}
                                            <div class="product-details">
                                            @foreach ( $item->options['attribute'] as $keyOption =>  $option)
                                            <div class="variation-block d-flex align-items-center">
                                                <span class="variation-option d-block">{{$keyOption .' : '}}</span>
                                                <span class="d-block">{{$option}}</span>
                                                </div>
                                            @endforeach
                                            </div>
                                        @endif
                                    </td>
                                    <td class="product-price" data-title="Price">
                                        <span class="amount"><bdi><span>$</span>{{ number_format($item->price, 2) }}</bdi></span>
                                    </td>
                                    <td class="product-quantity" data-title="Quantity">
                                        <div class="quantity-block">
                                            <div class="qty-container cart-quantity">
                                                <button class="qty-btn-minus btn-light quantity-button" data-class="minus" type="button" data-url = "{{route('price.calculation')}}" id="qty-minus-{{ $item->id }}" data-key={{$key}}><i class="fa fa-minus"></i></button>
                                                <input type="text" name="qty" id="product-qty" value="{{ $item->qty }}" min="1" max="100" class="input-qty" readonly/>
                                                <button class="qty-btn-plus btn-light quantity-button" data-class="add" type="button" data-url = "{{route('price.calculation')}}" data-id="{{ $item->id }}" data-key={{$key}}><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal" data-title="Subtotal">
                                        <span class="amount sub-product-amount"><bdi><span>$</span>{{ number_format($item->price * $item->qty, 2) }}</bdi></span>
                                    </td>
                                </tr>
                            @endif
                        @empty
                        <tr>
                            <td colspan="10" style="text-align:center">No Products found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="sub-table cart-block">
                <div class="summary-block">
                    <ul id="custom-list">
                        <li class="subtotal"><span class="sb-label sub-total">Sub Total :</span><span class="sb-value">${{ Cart::subtotal() }}</span></li>
                        {{-- <li class="shipping"><span class="sb-label">Shipping :</span><span class="sb-value">n/a</span></li> --}}
                        {{-- <li class="tax"><span class="sb-label">Est. Tax :</span><span class="sb-value">$5.00</span></li> --}}
                        <li class="grand-total"><span class="sb-label">Grand Total :</span><span class="sb-value final-total">${{ Cart::subtotal() }}</span></li>

                    </ul>
                </div>
            </div>
            <div class="cart-footer cart-block">
                <a href="{{ route('frontend.products.index') }}" class="btn cont-shopping"><span>Continue Shopping</span> </a>
                <a href="{{ route('checkout.makePayment') }}" class="btn checkout-btn {{ Auth::guard('admin')->check() ? 'disabled-link' : '' }}" data-toggle="tooltip" data-placement="top" title="{{ Auth::guard('admin')->check() ? 'Admin can not Proceed to checkout!' : ''}}" {{--style="pointer-events: none;"--}}><span>Proceed to Checkout</span> <i data-feather="chevron-right" class="feather ml-2"></i></a>
            </div>
        </div>
    </div>
</section>
@else
    @include('frontend.pages.cart.empty-cart')
@endif

@endsection

<!-- added script section here -->
@section('javascript')
<script src="{{ asset('front-end/cart.js') }}"></script>
@endsection