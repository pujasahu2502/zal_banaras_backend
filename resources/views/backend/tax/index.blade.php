@extends('backend.layouts.app', ['title' => 'Tax'])
@section('content')
<style type="text/css">
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0; 
    }
</style>
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="percent"></i>Tax</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="tax-filter" action="{{ route('tax.index') }}" autocomplete="off">
                <input type="text" name="search" value="{{ app('request')->input('search') }}" class="form-control tax-search-input filter-right search" placeholder="Search" autocomplete="off" data-toggle="tooltip" title="Search via Tax Name, State Name">

                <select name="ss" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Tax Status">
                    <option value="a" {{ request()->ss == 'a' ? 'selected' : '' }}>All Status</option>
                    <option value="1" {{ request()->ss == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request()->ss == '0' ? 'selected' : '' }}>Inactive</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('tax.index') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
            <button type="button" class="btn btn-primary add-data-filter-btn add-tax-modal" data-toggle="tooltip" data-url="{{ route('tax.create') }}" data-coreui-placement="top" title="Add Tax"><i class="fa fa-plus p-1"></i></button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center" width="5%">S.No.</th>
                    <th scope="col">Tax Name</th>
                    <th scope="col">State Name</th>
                    <th scope="col" class="text-center" width="15%">Tax (%)</th>
                    <th scope="col" class="text-center" width="15%">Status</th>
                    <th scope="col" class="text-center" width="10%">Action</th>
                </tr>
            </thead>
            <tbody class="tax-table admin-table">
                @include('backend.tax.include.tax-table')
            </tbody>
        </table> 
    </div>
</div>
<div class="view-btn">{{ $taxes->links() }}</div>
@endsection
@section('javascript')
<script src='{{asset("/backend/js/tax.js")}}'></script>
@endsection