@extends('frontend.layouts.include.app', ['title' => 'Product Info'])
@section('content')

<!-- --------Start-jumbotron-section--------- -->
<section class="jumbotron-section">
    <div class="container">
        <div class="jumbotron-bg-img">
            <div class="jumbotron-content wow slideInLeft">
                <div class="bs-example">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-arrow"><i data-feather="chevron-right"></i></li>
                            <li class="breadcrumb-item active"><a>{{'Product Info'  ?? ''}}</a></li>
                        </ol>
                    </nav>
                </div>
                <h3 class="text-uppercase">{{'Product Info' ?? ''}}</h3>
                {{-- <p>From traditional hunting mounts to tactical and long-range precision mounts, we offer a range of options to suit your needs. In this blog, we'll explore the latest developments in scope mount technology, share tips on how to choose the best mount for your rifle, and showcase our range of products. Join us on this journey as we delve into the fascinating world of hunting</p> --}}
            </div>
        </div>
    </div>
</section>
<!-- --------End-jumbotron-section--------- -->
<!-- --------Start-new-product-info-section--------- -->
<section class="about-section">
    <div class="container">
        <div class="product-tab-block mt-3">
            <ul>
                @foreach ($productInfo as $key => $info)
                <li><a href="#{{$info->slug}}" class="btn {{ Request::is($info->slug) ? 'active' : '' }}">{{$info->name}}</a></li>
                @endforeach
            </ul>
        </div>
        {{-- @foreach ($productInfo as $key => $info)
        <div class="product-tab-content-block">
                <div class="product-about-info-block mt-4" id="{{$info->slug}}">
        <h3>{{$info->name}}</h3>
        {!!$info->description ?? ''!!}
    </div>
    </div>
    @endforeach --}}
    </div>
</section>

<!-- ----------bottom-to-top-scroll-btn-block--------- -->
<button onclick="topFunction()" id="scrollBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>

@foreach ($productInfo as $key => $info)
<section class="about-section pt-5" id="{{$info->slug}}">
    <div class="container">
        <div class="product-tab-content-block">
            <div class="product-about-info-block pt-4">
                <h3>{{$info->name}}</h3>
                {!!$info->description ?? ''!!}
            </div>
        </div>
    </div>
</section>
@endforeach

<!-- --------End-new-product-info-section--------- -->
<!-- --------Start-blog-card-section--------- -->
<!-- <section class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 mt-4">
                <div class="about-detail-block">{!!$page->description ?? ''!!}</div>
            </div>
        </div>
    </div>
</section> -->
<!-- --------End-blog-block-section--------- -->
@endsection
@section('javascript')
<script>
    $(document).ready(function() {
      $('.btn').click(function() {
        // Remove 'active' class from all links
        $('.btn').removeClass('active');
        
        // Add 'active' class to the clicked link
        $(this).addClass('active');
      });
    });
  </script>
@endsection
