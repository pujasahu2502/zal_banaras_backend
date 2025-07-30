@extends('frontend.layouts.include.app', ['title' => 'Faq Info'])
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
                    <li class="breadcrumb-item active">Faq/Info</li>
                </ol>
            </nav>
        </div>
        <div class="breadcrumb-bg-block mt-2">
            <h4 class="text-uppercase mb-2">frequently asked questions</h4>
            <p>Here are our most frequently asked questions. If you still have questions, please submit your question on the <a href="{{route('contact')}}"><b>CONTACT</b></a> page or give us a call.</p>
        </div>
    </div>
</section>
<!-- --------End-breadcrumb-section--------- -->

<!-- --------Start-faq-section--------- -->
<section class="faq-section">
    <div class="container">
        <!-- added faq  -->
        @php $i = 0; @endphp
        @forelse ($faqData as $faqKey => $faqValue)
        <div class="faq-block pb-4">
            <div class="faq-product-head mb-3">
                <h5 class="text-uppercase">{{ $faqKey }}</h5>
            </div>
            <div id="accordionExample" class="accordion">
                @forelse ($faqValue as $faq)
                <div class="card">
                    <div id="heading-{{$faq['id']}}" class="card-header border-0">
                        <h2 class="mb-0">
                            <button type="button" data-toggle="collapse" data-target="#collapse-{{$faq['id']}}" aria-expanded="false" aria-controls="collapse-{{$faq['id']}}" class="btn btn-link text-uppercase collapsible-link"><span class="faq-head">{{ $faq['question'] }}</span></button>
                        </h2>
                    </div>
                    <div id="collapse-{{$faq['id']}}" aria-labelledby="heading-{{$faq['id']}}" data-parent="#accordionExample" class="collapse">
                        <div class="card-body">
                            <p class="m-0">{{ $faq['answer'] ?? '' }}</p>
                            {!! $faq['url'] ?? '' !!}
                        </div>
                    </div>
                </div>
                @php $i++; @endphp
                @empty
                @endforelse
            </div>
        </div>
        @empty
        @endforelse
        <!-- end faq  here-->
    </div>
</section>
<!-- --------End-faq-section--------- -->
@endsection