<section class="product-section home-product-section">
    <div class="container">
        <div class="head-block text-left d-flex justify-content-between mb-4">
            <h2 class="wow slideInLeft common-title text-uppercase mb-4"><span class="inner-text">Featured </span> Products</h2>
            <div class="feature-btn">
                {{-- {{dd($allProducts)}} --}}
                <a href="{{route('frontend.products.index',['featProduct' => '1'])}}" class="btn view-btn">View All</a>
            </div>
        </div>
        <div class="row">
            @forelse($allProducts as $product)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    @if($product->type == 1)
                        @if(isset($product->sale_price) && $product->regular_price > $product->sale_price )
                            <div class="sale-tag-block">
                                <p>Sale</p>
                            </div>
                        @endif
                        {{-- @else
                        @if(collect($product->productVariation)->min('sale_price')!== null && collect($product->productVariation)->min('regular_price') > collect($product->productVariation)->min('sale_price') )
                            <div class="sale-tag-block">
                                <p>Sale</p>
                            </div>
                        @endif --}}
                    @endif
                    <div class="product-content">
                        <h5 class="text-capitalize">{{$product->name ?? 'NA'}}</h5>
                        <p>{{$product['category']['name'] ?? ''}}</p>
                    </div>
                    <div class="product-img">
                        @if ($product->getMedia('featured_product_image')->count())
                        @foreach ($product->getMedia('featured_product_image') as $mediaKey => $media)
                        @if($mediaKey == 0)
                        <img src="{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}" class="d-block " alt="">
                        @endif
                        @endforeach
                        @else
                        <img src="{{ asset('front-end/assets/image/single-product-1.jpg') }}" class="d-block " alt="">
                        @endif
                    </div>
                    <div class="product-btn">
                        {{-- <p class="mb-2"><del class="mr-1">${{ ($product->sale_price != '') ? $product->sale_price : $product->regular_price }}</del> $14.30</p> --}}

                        <!-- added code to display regular and sale price based on condition -->
                        @if ($product->type == 1)
                        @if ($product->sale_price != '' && $product->regular_price != $product->sale_price)
                        <p class="mb-2"><del class="mr-1">${{ $product->regular_price }}</del> ${{ $product->sale_price }}</p>
                        @else
                        <p class="mb-2">${{ $product->regular_price }}</p>
                        @endif
                        @else
                        @if (collect($product->productVariation)->max('sale_price') != '' && collect($product->productVariation)->min('regular_price') != collect($product->productVariation)->max('sale_price') )
                        <p class="mb-2">{{'₹'.collect($product->productVariation)->min(collect($product->productVariation)->min('regular_price') >= collect($product->productVariation)->min('sale_price') ? 'sale_price' :'reguler_price')}} - {{'₹'.collect($product->productVariation)->max('regular_price')}}</p>
                        @else
                        <p class="mb-2">{{'₹'.collect($product->productVariation)->min('regular_price')}}</p>
                        @endif
                        @endif

                        <!-- end price code here -->

                        <p class="mb-2"></p>
                        @if($product["type"] == 1)
                        @if($product["stock_status"] == 'Out of stock')
                        <button type="button" class="btn-danger cart-stock-btn">Out Of Stock</button>
                        @else
                        <button type="button" data-url="{{route('cart.store',$product["slug"])}}" class="btn-primary cart-btn {{$product["stock_status"] == 'Out of stock' ? 'disabled-link' : 'addToCart' }}" {{auth()->guard('admin')->check() ? 'disabled' : ''}}>Add to Cart</button>
                        @endif
                        @else
                        @if($product["stock_status"] == 'Out of stock')
                        <button type="button" class="btn-danger cart-stock-btn">Out Of Stock</button>
                        @else
                        <a href="{{route('product.detail',$product->slug)}}"><button type="button" class="btn-primary cart-btn">Select Option</button></a>
                        @endif

                        @endif
                    </div>
                    @if($product["type"] == 1 || $product["stock_status"] == 'Out of stock' )
                    <div class="product-detail-btn">
                        <a href="{{route('product.detail',$product->slug)}}" class="btn-primary view-more-btn">View More</a>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            {{-- <div class="d-flex align-items-center justify-content-center" style="width:100%; height:500px">
                <h3 class="text-uppercase">Currently, there is no product available.</h3>
            </div> --}}
            <div class="d-flex align-items-center justify-content-center" style="width:100%; height:500px">
                <section class="no-data-section">
                    <div class="container">
                        <div class="no-data-block">
                            <img alt="logo" src="{{ asset('front-end/assets/image/no-data-empty.png') }}" />
                            <h3 class="mt-3">Currently, there is no product available.</h3>
                            <p>The data you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
                            <a href="{{ 'home' }}" class="btn-primary">Go to homepage</a>
                        </div>
                    </div>
                </section>
            </div>
            @endforelse
        </div>

    </div>
</section>