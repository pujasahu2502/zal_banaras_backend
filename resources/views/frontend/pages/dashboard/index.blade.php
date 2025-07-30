@extends('frontend.pages.dashboard.user-base', ['title' => 'Dashboard', 'subtitle' => ''])
@section('user-section')
{{-- Front End dashboard --}}
<div class="row">
    <div class="col-sm-5 col-lg-5 col-xs-12">
        <a href="my-order" class="dashboard-title mb-3">
            <div class="dashboard-card card">
                <div class="card-body">
                    <div class="inner-dashboard-title mb-4 d-flex align-items-center justify-content-between">
                        <div class="card-order-title">
                            <h4 class="text-uppercase">Total Order</h4>
                        </div>
                        <div class="card-order-icon">
                            <i data-feather="shopping-cart" class="feather"></i>
                        </div>
                    </div>
                    <div class="card-count">
                        <h4 class="font-weight-bold">4</h4>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

@endsection