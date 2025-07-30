@extends('backend.layouts.app', ['title' => 'Listing'])
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="title">
                <i class="c-sidebar-nav-icon fe-icon" data-feather="list"></i>Listing
            </h4>
            <div class="filter-search-block d-flex justify-content-between">
                <button id="addlistning" class="btn btn-primary add-listing-modal" data-toggle="tooltip"
                    data-url="{{ route('listing.create') }}" data-placement="top" style="float: right"
                    aria-label="Add Raffle"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col" width="5%" class="text-center">S.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col" class="text-center">Price</th>
                            <th scope="col" class="text-center">Listening Type</th>
                            <th scope="col" class="text-center">Status</th>
                            <th class="text-center" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="listing-table admin-table">
                      @include('backend.listing.include.listing-table')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('backend/js/listning.js') }}"></script>
@endsection
