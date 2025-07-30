@if(session()->has('free-product'))
@php
    $sessionData = session('free-product')
@endphp
<div class="order-sale-tag-block">
    <p class="">FREE</p>
</div>
<div class="card order-card">
    <div class="order-inner-block d-flex">
        <div class="order-img align-self-center">
            <img width="270" height="161" src="{{  $sessionData['options']['image'] }}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" sizes="(max-width: 270px) 100vw, 270px">
        </div>
        <div class="order-content">
            <h6 class="text-uppercase">{{$item['name'] ?? ''}}</h6>
            <p class="text-uppercase">
                Quantity : 1
            </p>
            <p class="text-uppercase">
                {{-- @forelse ($item->options->attribute as $key => $attribute)
                    {{ $key.' : '.$attribute.',' }}
                @empty --}}
                    No Configration Found!
                {{-- @endforelse --}}
                {{-- <span class="bg bg-danger p-2 text-white">Free</span> --}}
            </p>
        </div>
        <div class="order-price">
            <p>{{ $sessionData['price'] ? '₹'.number_format($sessionData['price'],2) : '$0.00'}}</p>
        </div>
    </div>
</div>
@endif