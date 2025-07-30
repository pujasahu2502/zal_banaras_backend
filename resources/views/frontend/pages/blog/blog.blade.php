@extends('frontend.layouts.include.app', ['title' => 'Blog Page'])
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
                            <li class="breadcrumb-item active"><a>Blogs</a></li>
                        </ol>
                    </nav>
                </div>
                <h3 class="text-uppercase">Blogs</h3>
                <p>From traditional hunting mounts to tactical and long-range precision mounts, we offer a range of options to suit your needs. In this blog, we'll explore the latest developments in scope mount technology, share tips on how to choose the best mount for your rifle, and showcase our range of products. Join us on this journey as we delve into the fascinating world of hunting</p>
            </div>
        </div>
    </div>
</section>
<!-- --------End-jumbotron-section--------- -->

<!-- --------Start-breadcrumb-section--------- -->
<!-- <section class="breadcrumb-bg-section faq-bg-section">
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/home">Home</a></li>
                    <li class="breadcrumb-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg></li>
                    <li class="breadcrumb-item active">Blogs</li>
                </ol>
            </nav>
        </div>
        <div class="breadcrumb-bg-block mb-3">
            <h4>Blogs</h4>
            <p>From traditional hunting mounts to tactical and long-range precision mounts, we offer a range of options to suit your needs. In this blog, we'll explore the latest developments in scope mount technology, share tips on how to choose the best mount for your rifle, and showcase our range of products. Join us on this journey as we delve into the fascinating world of hunting</p>
        </div>
    </div>
</section> -->
<!-- --------End-breadcrumb-section--------- -->

<!-- --------Start-blog-card-section--------- -->
<section class="blog-card-section">
    <div class="container">
        <div class="row">
            @forelse ($blogs as $blog)
            <div class="col-md-4 col-sm-4 col-xs-12">
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
                            <p>{!!Str::limit($blog->description , 250) ?? '-'!!}</p>
                        </div>
                    </div>
                </a>
            </div>   
            @empty
            <div class="d-flex align-items-center justify-content-center" style="width:100%;">
                <section class="no-data-section">
                    <div class="container">
                        <div class="no-data-block">
                            <img alt="logo" src="{{asset('front-end/assets/image/no-data-empty.png')}}">
                            <h3 class="mt-3">Currently, there is no blog available.</h3>
                            <p>The data you are looking for might have been removed or is temporarily unavailable.</p>
                            <a href="{{route("home")}}" class="btn-primary">Go to homepage</a>
                        </div>
                    </div>
                </section>
            </div>

            @endforelse
            
        </div>
    </div>
</section>
<!-- --------End-blog-block-section--------- -->

@endsection