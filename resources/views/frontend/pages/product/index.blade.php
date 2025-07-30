@extends('frontend.layouts.include.app', ['title' => 'Products'])
@section('content')
@include('frontend.layouts.include.breadcrumb',['url' => route('frontend.products.index'),'title'=> 'Products','subTitle' => 'SHOP ALL CATEGORIES'])
<section class="listing-product-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                @include("frontend.pages.product.include.filter")
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                         @include("frontend.pages.product.include.sort-by-paginate")
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                        <div class="pagination-inner-block">
                            <nav aria-label="Page navigation example">
                                {{ $allProducts->links()}}
                            </nav>
                        </div>

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
                                @if ($product->type == '1')
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
                    {{-- <div class="d-flex align-items-center justify-content-center" style="width:100%;">
                        <h3 class="text-uppercase">Currently, there is no product available.</h3>
                    </div> --}}
                    <div class="d-flex align-items-center justify-content-center" style="width:100%;">
                        <section class="no-data-section">
                            <div class="container">
                                <div class="no-data-block">
                                    <img alt="logo" src="{{ asset('front-end/assets/image/no-data-empty.png') }}" />
                                    <h3 class="mt-3">Currently, there is no product available.</h3>
                                    @if( count(request()->has('category') ? request()->input('category') : [] ) > 1 )
                                        <p>No products were found matching your selection, please try with some other filters.</p>
                                    @else
                                        <p>The data you are looking for might have been removed or is temporarily unavailable.</p>
                                    @endif
                                    <a href="{{ route('frontend.products.index') }}" class="btn reset-filter">Reset</a>
                                </div>
                            </div>
                        </section>
                    </div>
                    @endforelse
                </div>
                <div class="{{--pagination-block--}}">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @include("frontend.pages.product.include.sort-by-paginate")
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                            <div class="pagination-inner-block">
                                <nav aria-label="Page navigation example">
                                    {{ $allProducts->links()}}
                                </nav>
                            </div>
                            {{-- <div class="pagination-inner-block">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- --------End-listing-product-section--------- -->
@endsection
@section("javascript")
<script src="{{asset('front-end/product.js')}}"></script>
@endsection