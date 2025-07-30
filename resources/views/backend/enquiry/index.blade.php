@extends('backend.layouts.app', ['title' => 'Contact Us'])
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="phone"></i>Contact Us</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="enquiry-filter" action="{{ route('contact-us.index') }}" autocomplete="off">

                <select name="sort_by" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Sort Contact Us">
                    <option value="2" {{ request()->sort_by == '2' ? 'selected' : '' }}>Sort by New</option>
                    <option value="1" {{ request()->sort_by == '1' ? 'selected' : '' }}>Sort by Old</option>
                    <option value="3" {{ request()->sort_by == '3' ? 'selected' : '' }}>Sort by A-Z</option>
                    <option value="4" {{ request()->sort_by == '4' ? 'selected' : '' }}>Sort by Z-A</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('contact-us.index') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" width="5%">S.No.</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Email</th>
                        <th scope="col" class="text-center">Mobile Number</th>
                        <th scope="col" class="text-center">Received On</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="enquiry-table admin-table">
                    @include('backend.enquiry.include.enquiry-table')
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="view-btn">{{ $contactUsData->links() }}</div>
@endsection

@section('javascript')
<script src="{{ asset('backend/js/enquiry.js') }}"></script>
@endsection