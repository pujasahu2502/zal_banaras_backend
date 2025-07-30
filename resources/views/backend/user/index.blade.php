@extends('backend.layouts.app', ['title' => 'Customer'])
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
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="users"></i>Customer</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="user-filter" action="{{ route('customer.index') }}" autocomplete="off">
                <input type="text" name="search" value="{{ app('request')->input('search') }}" class="form-control user-search-input filter-right search" placeholder="Search" autocomplete="off" data-toggle="tooltip" title="Search via Customer Name, Customer Email, Mobile Number">

                <select name="sort" class="form-control form-select" data-toggle="tooltip" title="Sort Customer">
                    <option selected disabled>Sort Customer</option>
                    {{-- <option value="first_name" {{ request()->sort == 'first_name' ? 'selected' : '' }}>Customer Name</option>
                    <option value="email" {{ request()->sort == 'email' ? 'selected' : '' }}>Customer Email</option> --}}
                    <option value="2" {{ request()->input('sort') == '2' ? 'selected' : '' }}>Sort by New</option>
                    <option value="1" {{ request()->input('sort') == '1' ? 'selected' : '' }}>Sort by Old</option>
                    <option value="3" {{ request()->input('sort') == '3' ? 'selected' : '' }}>Sort by A-Z</option>
                    <option value="4" {{ request()->input('sort') == '4' ? 'selected' : '' }}>Sort by Z-A</option>
                </select>

                <select name="cs" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Customer Status">
                    <option value="a" {{ request()->input('cs') == 'a' ? 'selected' : '' }}>All Status</option>
                    <option value="1" {{ request()->input('cs') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request()->input('cs') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('customer.index') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>

                <!-- <a href="#" class="btn pdf-filter-btn btn-secondary" data-toggle="tooltip" title="Export Customers"><i class="fa fa-file-pdf-o pt-1"></i></a> -->

            </form>
            <button type="button" id="addUser" class="btn btn-secondary add-data-filter-btn add-user-modal" data-toggle="tooltip" title="Add Customer" data-url="{{ route('customer.create') }}"><i class="fa fa-plus p-1"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" width="5%">S.No.</th>
                        <th scope="col">Customer Name</th>
                        {{-- <th scope="col">Username</th> --}}
                        <th scope="col">Customer Email</th>
                        <th scope="col" class="text-center">Mobile Number</th>
                        <th scope="col" class="text-center">Type</th>
                        <th scope="col" class="text-center">Created at</th>
                        <th scope="col" class="text-center">Last Active</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="user-table admin-table">
                    @include('backend.user.include.user-table')
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="view-btn ">
    {{ $userData->links() }}
</div>
@endsection

@section('javascript')
<script src="{{ asset('backend/js/user.js') }}"></script>
@endsection