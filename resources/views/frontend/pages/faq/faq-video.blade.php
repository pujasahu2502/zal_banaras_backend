@extends('frontend.layouts.include.app', ['title' => 'Faq'])
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
                    <li class="breadcrumb-item active">DNZ Videos</li>
                </ol>
            </nav>
        </div>
        <div class="breadcrumb-bg-block mt-2">
            <h4 class="text-uppercase mb-2">DNZ Videos</h4>
            {{-- <p>Need something cleared up? Here are our most frequently asked questions. We have tried to give as much answers as possible, if you still have questions, don’t hesitate to ask your questions. Use form on CONTACT US to send us your questions!</p> --}}
        </div>
    </div>
</section>
<!-- --------End-breadcrumb-section--------- -->

<!-- --------Start-faq-video-section--------- -->
<section class="faq-video-section">
    @forelse ($faqData as $faqKey => $faqValue)
    <div class="container">
        <div class="faq-product-head mb-3 mt-4">
            <h5 class="text-uppercase">{{ $faqKey }}</h5>
        </div>
        @forelse ($faqValue as $faq)
        <div class="card faq-video-block">
            <h5>{{$faq['question'] ?? ' '}}</h5>
            <div class="faq-video mt-2">
                <p class="m-0">{{ $faq['answer'] ?? '' }}</p>
                {!! $faq['url'] ?? '' !!}
            </div>
        </div>
        @empty
        @endforelse   
    </div>
    @empty
    @endforelse
</section>
<!-- --------End-faq-video-section--------- -->

@endsection