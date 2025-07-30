<form id="form-add-to-cart-id">
    <div class="product-content-block mt-3">
        {{-- Product Ratting  Start --}}
        @if(!empty($product['avg_rating']))
            <div class="rating-block d-flex align-items-center">
                <div class="star-rating">
                    @for($i = 1; $i <= $product['avg_rating']; $i++)
                        <svg class="svg-inline--fa fa-star fa-w-18 active greenColor"  aria-hidden="true" focusable="false" data-prefix="fa"
                            data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                            data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z">
                            </path>
                        </svg>
                    @endfor
                    @for($i = 1; $i <= (5-$product['avg_rating']); $i++)
                        <svg class="svg-inline--fa fa-star fa-w-18 active greyColor"  aria-hidden="true" focusable="false" data-prefix="fa"
                            data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                            data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z">
                            </path>
                        </svg>
                    @endfor
                </div> 
                <div class="rating-text ml-2">
                    <p> {{ sprintf("%02d",$product->reviews_count) }} Reviews </p>
                </div>
            </div>
        @endif
        {{-- Product Ratting End --}}
        <div class="product-title">
            <h2 class="text-uppercase">{{$product['name'] ?? '' }}</h2>
           @if($product['sku'] != '')
                <p>SKU: <span class="sku-code">{{ $product['sku'] ?? 'NA' }}</span></p>
           @endif
           @if(count($product->productCategory) > 0)
                <p class="category-tag mb-3">Category : {{ json_decode(collect($product->productCategory)->pluck('category.name')) ? implode(", ",json_decode(collect($product->productCategory)->pluck('category.name'))) : "-" }}</p>
            @endif
        </div>
        @if($product['type'] == '2')
        <div class="product-detail">
            <div class="price-block">
                <h4 class="d-flex align-items-center">
                    {{-- @if($product['type'] == '2') --}}
                        @if (collect($product->productVariation)->max('sale_price') != '' && collect($product->productVariation)->min('regular_price') != collect($product->productVariation)->max('sale_price') )    
                            <span class="range-price text-uppercase">Price : </span> <span class="ml-2">{{'₹'.collect($product->productVariation)->min(collect($product->productVariation)->min('regular_price') >= collect($product->productVariation)->min('sale_price') ? 'sale_price' :'reguler_price')}} - {{'₹'.collect($product->productVariation)->max('regular_price')}}</span>
                        @else
                            <span class="range-price text-uppercase">Price : </span> <span class="ml-2">{{'₹'.collect($product->productVariation)->min('regular_price')}}</span>
                        @endif    
                    {{-- @endif --}}
                </h4>
            </div>
            @if($product['type'] == '2')
                {{-- @if($filterStatus == 'showFilter') --}}
                    <div class="product-detail-inner-block">
                        @include('frontend.pages.product.include.variation-filter',['slug'=>Request::segment(2),'filterStatus' => false])
                    </div>
                    <span class="text-danger cart-error"></span>
                {{-- @else --}}
                {{-- <div class="product-btn mt-4">
                    <button type="button" class="btn-danger cart-stock-btn">Not Available For Sale</button>
                </div>
                @endif --}}
                <div class="variation-loading" style="display: none;"></div>
            @endif
        </div>
        @endif
        @if($product["stock_status"] == 'Out of stock')
            <div class="product-btn mt-4">
                <button type="button" class="btn-danger cart-stock-btn">Out Of Stock</button>
            </div>
        @else
            {{-- @if($filterStatus == 'showFilter') --}}
                <div class="price-block mt-3 price-parent {{$product['type'] == '2' ? 'd-none' : ''}}">
                    @if ($product['sale_price'] != '')
                        <h5 class="d-flex align-items-center"><span class="range-price text-uppercase"></span> <span class="price-total-data"> ${{$product['sale_price'] ?? '0'}}</span></h5>
                    @else
                    <h5 class="d-flex align-items-center"><span class="range-price text-uppercase"></span> <span class="price-total-data"> ${{$product['regular_price'] ?? '0'}}</span></h5>
                    @endif
                </div>
                <div class="cart-detail-block d-flex mt-4">
                    <div class="quantity-block mr-3">
                        <p class="quantity-text text-uppercase mb-2">Quantity :</p>
                        <div class="qty-container">
                            <button class="qty-btn-minus btn-light quantity-button" data-class="minus" type="button" id="qty-minus"><i class="fa fa-minus"></i></button>
                                <input type="text" name="qty" id="product-qty" value="1" min="1" max="100" data-price="{{$product->sale_price != '' ? $product->sale_price : $product->regular_price}}"  class="input-qty" readonly />
                            <button class="qty-btn-plus btn-light quantity-button" data-class="add" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="cart-btn mt-4">
                        <button type="button" class="btn-primary add-cart-btn {{$product["stock_status"] == 'Out of stock' ? 'disabled-link' : 'addToCart' }}" {{auth()->guard('admin')->check() ? 'disabled' : ''}} data-url={{route('cart.store',$product["slug"])}}><span class="cart-text">Add to Cart</span></button>
                    </div>
                </div>
            {{-- @endif --}}
        @endif
    </div>
</form>

@include('frontend.pages.product.include.varitaion-staus')