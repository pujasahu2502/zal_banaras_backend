@extends('frontend.pages.dashboard.user-base', ['title' => 'Address','titleUrl' =>( Request::segment(2) ? route('address.index') : null),'subtitle' => ( Request::segment(2) ? ( Request::segment(2) == 'create' ? 'Add Address' : 'Edit Address') : '' )])
@section('user-section')
    <!-- --------Start-breadcrumb-section--------- -->
    {{-- <section class="breadcrumb-bg-section faq-bg-section">
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/home">Home</a></li>
                    <li class="breadcrumb-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg></li>
                    <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/home">My Account</a></li>
                    <li class="breadcrumb-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg></li>
                    <li class="breadcrumb-item active">Address</li>
                </ol>
            </nav>
        </div>
        <div class="breadcrumb-bg-block mb-3">
            <h4>Saved Addresses</h4>
        </div>
    </div>
</section> --}}
    <!-- --------End-breadcrumb-section--------- -->

    <section class="user-dashboard mb-3 pt-0">
        <div class="container">
            <div class="dashboard-wrap">
                <div class="row">
                    <!-- MAIN -->
                    <div class="col-md-12">
                        <div class="dashboard-right-block">
                            <div class="order-view-block address-order-block">
                                <div class="order-info-block">
                                    <div class="order-download-block">
                                        <a class="btn-primary add-new-address {{ Request::is('address/create') ? 'd-none' : ' ' }}" href="{{ route('address.create') }}">Add New Address <img src="{{ asset('front-end/assets/image/plus-icon.svg') }}" alt="" class="plus-icon ml-2"></a>
                                    </div>
                                </div>
                                <div class="address-table">
                                    @if(Request::is('address'))
                                        @include('frontend.pages.dashboard.include.address.include.address-table')
                                    @endif
                                </div>  
                            </div>
                            @if(Request::is('address/create') || Request::is('address/' . Request()->segment(2) . '/edit'))
                                @include('frontend.pages.dashboard.include.address.include.add-address')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script src="{{ asset('front-end/address.js') }}"></script>
@endsection