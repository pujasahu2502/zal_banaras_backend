@extends('backend.layouts.app', ['title' => 'Review'])
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="star"></i>Review</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="review-filter" action="{{ route('review.index') }}" autocomplete="off">

                <select name="sort_by" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Sort Review">
                    <option value="2" {{ request()->sort_by == '2' ? 'selected' : '' }}>Sort by New</option>
                    <option value="1" {{ request()->sort_by == '1' ? 'selected' : '' }}>Sort by Old</option>
                    {{-- <option value="3" {{ request()->sort_by == '3' ? 'selected' : '' }}>Sort by A-Z</option>
                    <option value="4" {{ request()->sort_by == '4' ? 'selected' : '' }}>Sort by Z-A</option> --}}
                </select>

                {{-- <div class="form-rating-block">
                    <select name="ss" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Star Rating">
                        <option value="a" {{ request()->ss == 'a' ? 'selected' : '' }}>All</option>
                        <option value="1" {{ request()->ss == '1' ? 'selected' : '' }}>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                        </option>
                        <option value="2" {{ request()->ss == '2' ? 'selected' : '' }}>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                        </option>
                        <option value="3" {{ request()->ss == '3' ? 'selected' : '' }}>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                        </option>
                        <option value="4" {{ request()->ss == '4' ? 'selected' : '' }}>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                        </option>
                        <option value="5" {{ request()->ss == '5' ? 'selected' : '' }}>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                            <span style="font-size:300%;color:yellow;">&starf;</span>
                        </option>
                    </select>
                </div> --}}

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('review.index') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" width="5%">S.No.</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Customer Name</th>
                        {{-- <th scope="col" class="text-center">Star Rating</th> --}}
                        <th scope="col" class="text-center">Submitted On</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="review-table admin-table">
                    @include('backend.review.include.review-table')
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="view-btn">
    {{ $reviews->links() }}
</div>
@endsection
@section('javascript')
<script src="{{ asset('backend/js/review.js') }}"></script>
@endsection