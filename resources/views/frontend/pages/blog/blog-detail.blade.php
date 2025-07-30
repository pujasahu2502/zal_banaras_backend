@extends('frontend.layouts.include.app', ['title' => 'Blog Detail Page'])
@section('content')

<!-- --------Start-breadcrumb-section--------- -->
<section class="breadcrumb-bg-section faq-bg-section">
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg></li>
                    <li class="breadcrumb-item"><a href="{{route('blog')}}">Blogs</a></li>
                    <li class="breadcrumb-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg></li>
                    <li class="breadcrumb-item active">{{$blog->title ?? ' '}}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- --------End-breadcrumb-section--------- -->

<!-- --------Start-blog-detail-section--------- -->
<section class="blog-detail-section">
    <div class="container">
        <div class="blog-detail-block mb-4">
            <div class="topbar-blog d-flex align-items-center justify-content-between mt-3">
                <div class="blog-title">
                    <span class="date-tilte py-2">Published on {{dateFormatWithMonthName($blog->created_at) ?? '-'}}</span>
                    <h3>{{$blog->title ?? '-'}}</h3>
                </div>
                {{-- <div class="blog-user-block mb-2 d-flex align-items-center">
                    <img src="{{ asset('front-end/assets/image/blog-user-img.png') }}" alt="">
                    <p class="ml-2 mb-0">By Pema Genyam</p>
                </div> --}}
            </div>
            @if ($blog->getMedia('blog')->count())
                <div class="blog-img mt-2">
                    <img src="{{ $blog->getMedia('blog')->first()->getUrl() }}" class="d-block m-auto" alt="">
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="blog-detail-block">
                    {!!$blog->description ?? ''!!}
                </div>
            </div>
            {{-- <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="promotion-slider-block promotion-blog-block">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="call-log-block">
                                    <div class="inner-call-log">
                                        <div class="call-img mb-3">
                                            <img alt="logo" src="{{ asset('front-end/assets/image/phone-join.png') }}" />
                                        </div>
                                        <h5>Need help finding the product?</h5>
                                        <p>Our team is always available to assist you with any questions or concerns.</p>
                                        <a href="#" class="btn-primary">1800-6452-5250</a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="call-log-block">
                                    <div class="inner-call-log">
                                        <div class="call-img mb-3">
                                            <img alt="logo" src="{{ asset('front-end/assets/image/phone-join.png') }}" />
                                        </div>
                                        <h5>Need help finding the product?</h5>
                                        <p>Our team is always available to assist you with any questions or concerns.</p>
                                        <a href="#" class="btn-primary">1800-6452-5250</a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="call-log-block">
                                    <div class="inner-call-log">
                                        <div class="call-img mb-3">
                                            <img alt="logo" src="{{ asset('front-end/assets/image/phone-join.png') }}" />
                                        </div>
                                        <h5>Need help finding the product?</h5>
                                        <p>Our team is always available to assist you with any questions or concerns.</p>
                                        <a href="#" class="btn-primary">1800-6452-5250</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="article-blog-block">
            <div class="article-title">
                <h4 class="text-uppercase">related articles</h4>
            </div>
            <div class="row">
                @forelse ($relatedblogs as $blog)
                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-12">
                    <a href="{{route('blog-details',$blog->slug)}}" class="blog-link-card">
                        <div class="card blog-card text-left">
                            @if ($blog->getMedia('blog')->count())
                                <div class="blog-img">
                                    <img src="{{ $blog->getMedia('blog')->first()->getUrl() }}" class="d-block w-100" alt="">
                                </div>
                            @endif
                            <div class="blog-content">
                                {{-- <div class="blog-user-block mb-2 d-flex align-items-center">
                                    <img src="{{ asset('front-end/assets/image/blog-user-img.png') }}" alt="">
                                    <p class="ml-2 mb-0">By Pema Genyam</p>
                                </div> --}}
                                <h5>{{$blog->title ?? '-'}}</h5>
                                <span class="date-tilte py-2">{{dateFormatWithMonthName($blog->created_at) ?? '-'}}</span>
                                {{-- <p>{{$blog->description ?? '-'}}</p> --}}
                            </div>
                        </div>
                    </a>
                </div>  
                @empty
                    <div class="d-flex align-items-center justify-content-center" style="width:100%; height:500px">
                        <h3 class="text-uppercase">Currently, there is no blog available.</h3>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- --------End-blog-detail-section--------- -->

@endsection