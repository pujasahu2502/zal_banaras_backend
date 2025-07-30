@extends('backend.layouts.app', ['title' => 'Coupon'])
<style type="text/css">
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="gift"></i>Coupon</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="coupon-filter" action="{{ route('coupon.index') }}" autocomplete="off">
                <input type="text" name="search" value="{{ app('request')->input('search') }}" class="form-control coupon-search-input filter-right search" placeholder="Search" autocomplete="off" data-toggle="tooltip" title="Search via Coupon Code">

                <select name="st" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Coupon Type">
                    <option value="a" {{ request()->st == 'a' ? 'selected' : '' }}>All Type</option>
                    <option value="1" {{ request()->st == '1' ? 'selected' : '' }}>Flat Rate</option>
                    <option value="2" {{ request()->st == '2' ? 'selected' : '' }}>Fixed Price</option>
                    <option value="3" {{ request()->st == '3' ? 'selected' : '' }}>Buy 1 Get 1 Free</option>
                </select>

                <select name="ss" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Coupon Status">
                    <option value="a" {{ request()->ss == 'a' ? 'selected' : '' }}>All Status</option>
                    <option value="1" {{ request()->ss == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request()->ss == '0' ? 'selected' : '' }}>Inactive</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('coupon.index') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
            <button type="button" id="addCoupon" class="btn btn-primary add-data-filter-btn add-coupon-modal" data-toggle="tooltip" data-placement="top" title="Add Coupon" data-url="{{ route('coupon.create') }}"><i class="fa fa-plus p-1"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" width="5%">S.No.</th>
                        <th scope="col" width="15%">Coupon Code</th>
                        <th scope="col" class="text-center" width="10%">Apply On</th>
                        <th scope="col" class="text-center" width="10%">Coupon Type</th>
                        <th scope="col" class="text-center" width="10%">Amount</th>
                        <th scope="col" class="text-center" width="10%">Usage Limit</th>
                        <th scope="col" class="text-center" width="10%">Start Date</th>
                        <th scope="col" class="text-center" width="10%">End Date</th>
                        <th scope="col" class="text-center" width="10%">Status</th>
                        <th scope="col" class="text-center" width="10%">Action</th>
                    </tr>
                </thead>
                <tbody class="coupon-table admin-table">
                    @include('backend.coupon.include.coupon-table')
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="view-btn">
    {{ $couponData->links() }}
</div>
@endsection
@section('javascript')
<script src="{{ asset('backend/js/coupon.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
@endsection