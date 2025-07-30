@extends('frontend.layouts.include.app', ['title' => 'Product'], ['name' => $metaProductData['title'] ?? 'DNZ Product', 'description'=>isset($metaProductData["description"]) ? strip_tags($metaProductData["description"]) : 'The Reef Reaper is designed to be bent if you cannot work it free'])
@section('content')
<style>
    .greenColor {
        color: #f4dd89;
    }

    .greyColor {
        color: #bbbbbb;
    }
</style>
@include("frontend.layouts.include.breadcrumb",['title' => "Products",'subTitle'=>$product["name"], 'url'=> route('frontend.products.index')])
<!-- --------Start-single-product-section--------- -->
<section class="single-product-section">
    <div class="container">
        <div class="single-product-inner-block">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    {{-- Product Image Start --}}
                    <div class="product-img-block mt-4">
                        <div class="product-details-img product-horizontal-style clearfix mb-3 mb-md-0">
                            <div class="zoompro-wrap product-zoom-right w-100 p-0" style="border: 1px solid #ccc;">
                                <div class="zoompro-span"><img id="zoompro" class="zoompro" src="{{ $product->getMedia('featured_product_image')->count() ? $product->getMedia('featured_product_image')[0]->getUrl() : asset('front-end/assets/image/single-product-1.jpg') }}" data-zoom-image="{{ $product->getMedia('featured_product_image')->count() ? $product->getMedia('featured_product_image')[0]->getUrl() : asset('front-end/assets/image/single-product-1.jpg') }}" alt="product" /></div>
                                <div class="product-buttons">
                                    <a href="#" class="btn rounded prlightbox"><i class="icon" data-feather="maximize"></i> <span class="tooltip-label">Zoom Image</span></a>
                                </div>
                            </div>
                            <div class="product-thumb product-horizontal-thumb w-100 pt-2 mt-1">
                                <div id="gallery" class="product-thumb-style1 overflow-hidden">
                                    @if ($product->getMedia('featured_product_image')->count() || $product->getMedia('product')->count())
                                    @foreach ($product->getMedia('featured_product_image') as $mediaKey => $media)
                                    @if($mediaKey == 0)
                                    <a data-image="{{$media->getUrl()}}" data-zoom-image="{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}" class="slick-slide slick-cloned active">
                                        <img class="blur-up lazyload" data-src="{{$media->getUrl()}}" src="{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}" alt="product" />
                                    </a>
                                    @endif
                                    @endforeach
                                    @foreach ($product->getMedia('product') as $media)
                                    <a data-image="{{$media->getUrl()}}" data-zoom-image="{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}" class="slick-slide slick-cloned">
                                        <img class="blur-up lazyload" data-src="{{$media->getUrl()}}" src="{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}" alt="product" />
                                    </a>
                                    @endforeach
                                    @else
                                    <a data-image="{{ asset('front-end/assets/image/single-product-1.jpg') }}" data-zoom-image="{{ asset('front-end/assets/image/single-product-1.jpg') }}" class="slick-slide slick-cloned active">
                                        <img class="blur-up lazyload" data-src="{{ asset('front-end/assets/image/single-product-1.jpg') }}" src="{{ asset('front-end/assets/image/single-product-1.jpg') }}" alt="product" />
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="lightboximages">
                                @if ($product->getMedia('featured_product_image')->count() || $product->getMedia('product')->count())
                                @foreach ($product->getMedia('featured_product_image') as $media)
                                <a href="{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}" data-size="1000x1280"></a>
                                @endforeach
                                @foreach ($product->getMedia('product') as $media)
                                <a href="{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}" data-size="1000x1280"></a>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- --------------start-zoom-image-with-slide-code----------------- -->
                        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="pswp__bg"></div>
                            <div class="pswp__scroll-wrap">
                                <div class="pswp__container">
                                    <div class="pswp__item"></div>
                                    <div class="pswp__item"></div>
                                    <div class="pswp__item"></div>
                                </div>
                                <div class="pswp__ui pswp__ui--hidden">
                                    <div class="pswp__top-bar">
                                        <div class="pswp__counter"></div>
                                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                        <button class="pswp__button pswp__button--share" title="Share"></button>
                                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                                        <div class="pswp__preloader">
                                            <div class="pswp__preloader__icn">
                                                <div class="pswp__preloader__cut">
                                                    <div class="pswp__preloader__donut"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                        <div class="pswp__share-tooltip"></div>
                                    </div>
                                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                                    <div class="pswp__caption">
                                        <div class="pswp__caption__center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- --------------end-zoom-image-with-slide-code----------------- -->
                    </div>
                    {{-- Product Image End --}}
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    {{-- @if($product['type'] == '1') --}}
                    @include('frontend.pages.product.include.simple-product')
                    {{-- @elseif ($product['type'] == '2')
                        @include('frontend.pages.product.include.varitaion')
                   @endif --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- --------End-single-product-section--------- -->

<!-- --------Start-product-detail-section--------- -->
<section class="product-detail-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="product-detail-block wow slideInLeft mb-3">
                    <h2 class="common-title text-uppercase mb-4">Enhanced Precision and Performance</h2>
                    <div class="product-detail-text mt-3 mb-3">
                        <p>If you own a Thompson Center rifle, you already know that it's a top-quality firearm. However, to get the most out of your rifle, you need a high-quality scope mount that will securely attach your scope to your rifle and ensure accurate shot placement. That's where the Game Reaper scope mount comes in.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="product-detail-img wow slideInRight">
                    <img src="{{ asset('front-end/assets/image/single-product-img.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- --------End-product-detail-section--------- -->

<!-- --------Start-single-product-content-section--------- -->
@if(!empty($product["productAttribute"]))
    @if($filterStatus == 'showFilter' && count($variationList) > 0 )
        <section class="single-product-section mt-4 mb-2">
            <div class="container">
                <div class="product-content-tab mt-4">
                    <h3 class="mb-3">Specifications</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                {{-- {{dd($variationList )}} --}}
                                @foreach ( $variationList as $key => $variation )
                                <tr>
                                    <td class="table-left-block text-capitalize">{{$key ?? "" }}</td>
                                    <td class="text-capitalize">{{ implode(", ",json_decode(collect($variation)->pluck("name"))) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif
<!-- --------End-single-product-content-section--------- -->

<!-- --------Start-product-tab-section--------- -->
{{-- @if($product["product_information"]== '' && $product["product_information"] == '') --}}

<section class="product-tab-section">
    <div class="container">
        <div class="product-tab-inner-block">
            <nav class="product-tabs-list">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Description</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Product Info</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="product-description-block mt-4">
                        {!!$product["product_information"] ?? '' !!}
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="product-info-block mt-4">
                        {!!$product["additional_information"] ?? '' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- @endif --}}
<!-- --------End-product-tab-section--------- -->

<!-- --------Start-product-video-section--------- -->
<section class="product-video-section">
    <div class="container">
        <div class="product-video-inner-block">
            <div class="head-block text-center mb-5 wow bounceInUp">
                <h2 class="text-uppercase">WATCH: Game Reaper <span class="inner-text"> review and installation </span></h2>
            </div>
            <div class="product-video-block">
                <iframe width="100%" height="400px" src="https://www.youtube.com/embed/idvOdfe2eWw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
<!-- --------End-product-video-section--------- -->

<!-- --------Start-user-review-section--------- -->
<section class="user-review-section mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 col-sm-5 col-xs-12">
                <div class="review-content-block text-center wow slideInLeft mb-4">
                    <div class="review-text mb-3">
                        <p>“I have Game Reaper mounts on my .35 Rem 30-30 Winchester and .444 marlin and just put one on my Remington 700 LA. Customer service is on point with fitting your rifle with the right height mount. They ALL fit like they are supposed to and they are rock solid!“ <span class="review-title">-Savannah Dan</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="review-img-block wow slideInRight">
                    <img src="{{ asset('front-end/assets/image/review-img.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- --------End-user-review-section--------- -->

<!-- --------Start-new-user-review-section--------- -->
@if ($reviews->count() > 0)
    <section class="client-review-section mb-4">
        @include('frontend.pages.product.include.reviews')
    </section>
@endif
<!-- --------End-new-user-review-section--------- -->

<!-- --------Start-product-section--------- -->
@if(count($relatedProducts) > 0)
<section class="product-section product-single-section">
    <div class="container">
        <div class="head-block text-center mb-4">
            <h4><span>RELEATED</span> PRODUCTS</h4>
        </div>
        <div class="slick-carousel review-items-slider">
            @foreach ($relatedProducts as $product)
            <div class="slide-content">
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
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- --------End-product-section--------- -->

@endsection

@section('javascript')
<script src="{{asset("front-end/product.js")}}"></script>
<script>
    $(function() {

        $('#reviewForm').on('submit', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '{{ route("product.addReview") }}',
                data: $('#reviewForm').serialize(),
                success: function(response) {
                    if (response.status == 'error') {
                        toastr.error(response.message, 'Error!');
                    } else {
                        toastr.success(response.message, 'Success!');
                        $('#reviewSection').html(response.data);
                    }
                }
            });

        });

    });
</script>
@endsection