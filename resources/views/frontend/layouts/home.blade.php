@extends('frontend.layouts.include.app', ['title' => 'Home'])
@section('content')
<!-- --------Start-banner-section--------- -->
<section class="banner-section">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('front-end/assets/image/slide-img-new-1.jpg') }}" class="d-block w-100" alt="">
                <!-- <div class="carousel-caption banner-content">
                    <h1 class="wow slideInLeft">#ACCURACY</h1>
                    <p class="wow slideInRight">Every DNZ Scope Mount is precision machined in North Carolina from Top Grade, Solid Billet Aluminum. Ultralight with maximum shock absorption, there are no movable parts between rifle and scope. Simply put, we machine the finest, most accurate scope mounts in the world. #Accuracy is a must.</p>
                </div> -->
            </div>
            <div class="carousel-item">
                <div class="banner-slider-block">
                    <img src="{{ asset('front-end/assets/image/slide-img-new-2.jpg') }}" class="d-block w-100" alt="">
                    <a href="{{route('frontend.products.index',['category[]' => 'game-reaper' ])}}" class="banner-btn">Browse</a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="banner-slider-block">
                    <img src="{{ asset('front-end/assets/image/slide-img-new-3.jpg') }}" class="d-block w-100" alt="">
                    <a href="{{route('frontend.products.index',['category[]' => 'freedom-reaper' ])}}" class="banner-btn">Browse</a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="banner-slider-block">
                    <img src="{{ asset('front-end/assets/image/slide-img-new-4.jpg') }}" class="d-block w-100" alt="">
                    <a href="{{route('frontend.products.index',['category[]' => 'game-reaper-2' ])}}" class="banner-btn banner-fortn-btn">Browse</a>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<!-- --------End-banner-section--------- -->

<!-- --------Start-mount-section--------- -->
@include('frontend/layouts/home-include/mount-section')
<!-- --------End-mount-section--------- -->

<!-- --------Start-about-section--------- -->
@include('frontend/layouts/home-include/about-section')
<!-- --------End-about-section--------- -->

<!-- --------Start-testimonial-dnz-section--------- -->
@include('frontend/layouts/home-include/testimonial')
<!-- --------End-testimonial-dnz-section--------- -->

<!-- --------Start-second-about-section--------- -->
@include('frontend/layouts/home-include/second-about-section')
<!-- --------End-second-about-section--------- -->

<!-- --------Start-category-section--------- -->
@include('frontend/layouts/home-include/category-section')
<!-- --------End-category-section--------- -->

<!-- --------Start-explore-product-section--------- -->
<!-- <section class="explore-product-section">
    <div class="container">
        <div class="inner-explore-product-block text-center mb-3">
            <div class="head-block text-center mb-3 wow bounceInUp">
                <h2 class="common-title text-uppercase mb-4"><span class="inner-text">Explore </span> DNZ Products</h2>
            </div>
            <div class="explore-product-text">
                <p>Step into the realm of excellence with DNZ Products and experience the ultimate in accuracy and reliability, as we enhance your mission for precision shooting.</p>
            </div>
        </div>
        <div class="explore-product-img mt-4 wow slideInRight">
            <img src="{{ asset('front-end/assets/image/explore-product-img.png') }}" alt="">
        </div>
    </div>
</section> -->
<!-- --------End-explore-product-section--------- -->

<!-- --------Start-warranty-section--------- -->
@include('frontend/layouts/home-include/warranty-section')
<!-- --------End-warranty-section--------- -->

<!-- --------Start-product-section--------- -->

@if(count($allProducts) > 0)
@include('frontend/layouts/home-include/featured-product')
@endif
<!-- --------End-product-section--------- -->

<!-- --------Start-special-product-section--------- -->
@include('frontend/layouts/home-include/special-product-section')
<!-- --------End-special-product-section--------- -->

<!-- --------Start-video-modal-popup--------- -->
@include('frontend/layouts/home-include/category-modal')
<!-- --------End-video-modal-popup--------- -->
@endsection
@section('javascript')
<script>
    $(document).on('click','#category-video',function(){
        let url = $(this).attr('data-url');
        if(url == null){
            $('.cat-video-link').attr('src',' ');
        }
        else{
            $('.cat-video-link').attr('src',url);
        }
    })
</script>
@endsection