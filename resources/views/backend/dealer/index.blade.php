@extends('backend.layouts.app', ['title' => 'Dealer'])
@section('content')
<style>
    /* === REMOVE INPUT TYPE NUMBER TIP === */
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="user-check"></i>Dealer</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="user-filter" action="{{ route('dealer.index') }}" autocomplete="off">
                <input type="text" name="search" value="{{ request()->input('search') }}" class="form-control user-search-input filter-right search" placeholder="Search" autocomplete="off" data-toggle="tooltip" title="Search via Dealer Title"> 
                <select name="ss" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Dealer Status">
                    <option value="a" {{ request()->ss == 'a' ? 'selected' : '' }}>All Status</option>
                    <option value="1" {{ request()->ss == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request()->ss == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('dealer.index') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>

            <button type="button" class="btn btn-primary add-data-filter-btn add-dealer-modal" data-toggle="tooltip" data-url="{{ route('dealer.create') }}" data-placement="top" title="Add Dealer"><i class="fa fa-plus p-1"></i></button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center" width="5%">S.No.</th>
                    <th scope="col" class="text-center">Image</th>
                    <th scope="col">Dealer Title</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="text-center">Mobile Number</th>
                    <th scope="col" class="text-center">State</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody class="dealer-table admin-table pages-table">
                @include('backend.dealer.include.dealer-table')
            </tbody>
        </table>
    </div>
</div>
<div class="view-btn">{{ $dealerData->links() }}</div>
@endsection
@section('javascript')
<script src='{{asset("/backend/js/dealer.js")}}'></script>
@endsection