@extends('frontend.layouts.include.app', ['title' => 'Help Center'])
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
                    <li class="breadcrumb-item active">Help Center</li>
                </ol>
            </nav>
        </div>
        <div class="breadcrumb-bg-block mt-2">
            <h4 class="text-uppercase mb-2">DNZ help center</h4>
            <p>The DNZ help centre is your go to place to get started with DNZ products. Find installation guides and helpful topics for your scope mount, making it easier to get the most out of your gear.</p>
        </div>
    </div>
</section>
<!-- --------End-breadcrumb-section--------- -->

<!-- --------Start-faq-section--------- -->
<section class="help-center-section">
    <div class="container">
        <div class="help-tips-block">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="help-product-list">
                        <h5 class="text-uppercase">products</h5>
                        <ul>
                            <li><img src="{{ asset('front-end/assets/image/product-icon.svg') }}" alt=""> Installation guide for Game Reaper series</li>
                            <li><img src="{{ asset('front-end/assets/image/product-icon.svg') }}" alt=""> Mounting guide for tactical 251 series</li>
                            <li><img src="{{ asset('front-end/assets/image/product-icon.svg') }}" alt=""> Installation guide for Freedom Reaper series</li>
                            <li><img src="{{ asset('front-end/assets/image/product-icon.svg') }}" alt=""> Get started with DNZ accessories</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="help-product-list">
                        <h5 class="text-uppercase">safety</h5>
                        <ul>
                            <li><img src="{{ asset('front-end/assets/image/product-icon.svg') }}" alt=""> Things to keep in mind while mounting a scope</li>
                            <li><img src="{{ asset('front-end/assets/image/product-icon.svg') }}" alt=""> 5 best practice if you are new to the mounting </li>
                            <li><img src="{{ asset('front-end/assets/image/product-icon.svg') }}" alt=""> 10 ways to get most out of your scopes by following simple rules</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="help-product-list">
                        <h5 class="text-uppercase">tips and tricks</h5>
                        <ul>
                            <li><img src="{{ asset('front-end/assets/image/product-icon.svg') }}" alt=""> 5 hunting tips for newbies</li>
                            <li><img src="{{ asset('front-end/assets/image/product-icon.svg') }}" alt=""> Best hunting places in USA 2023 [updated]</li>
                            <li><img src="{{ asset('front-end/assets/image/product-icon.svg') }}" alt=""> Build your own compact looking scope</li>
                            <li><img src="{{ asset('front-end/assets/image/product-icon.svg') }}" alt=""> 3 unique rifle brand you must checkout in 2023</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- --------End-faq-section--------- -->

@endsection