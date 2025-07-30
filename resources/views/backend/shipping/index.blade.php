@extends('backend.layouts.app', ['title' => 'Shipping'])
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="truck"></i>Shipping</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="user-filter" action="{{ route('shipping.index') }}" autocomplete="off">
                <input type="text" name="search" value="{{ request()->input('search') }}" class="form-control user-search-input filter-right search" placeholder="Search" autocomplete="off" data-toggle="tooltip" title="Search via Zone Name, Shipping State">

                <select name="ss" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Shipping Status">
                    <option value="a" {{ request()->ss == 'a' ? 'selected' : '' }}>All Status</option>
                    <option value="1" {{ request()->ss == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request()->ss == '0' ? 'selected' : '' }}>Inactive</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('shipping.index') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
            <button type="button" class="btn btn-primary add-data-filter-btn add-shipping-modal" data-toggle="tooltip" data-url="{{ route('shipping.create') }}" data-placement="top" title="Add Shipping"><i class="fa fa-plus p-1"></i></button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col" width="5%" class="text-center">S.No.</th>
                    <th scope="col">Zone Name</th>
                    <th scope="col">Shipping State</th>
                    <th scope="col" class="text-center" width="15%">Flat Rate</th>
                    <th scope="col" class="text-center" width="15%">Status</th>
                    <th scope="col" class="text-center" width="10%">Action</th>
                </tr>
            </thead>
            <tbody class="shipping-table admin-table pages-table">
                @include('backend.shipping.include.list')
            </tbody>
        </table>
    </div>
</div>
<div class="view-btn"> {{ $shippings->links() }}</div>
@endsection
@section('javascript')
<script src='{{asset("/backend/js/shipping.js")}}'></script>
@endsection