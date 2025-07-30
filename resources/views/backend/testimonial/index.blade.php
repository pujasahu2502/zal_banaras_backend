@extends('backend.layouts.app', ['title' => 'Testimonial'])
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="message-circle"></i>Testimonial</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="testimonial-filter" action="{{ route('testimonial.index') }}" autocomplete="off">
                <input type="text" name="search" value="{{ app('request')->input('search') }}" class="form-control testimonial-search-input filter-right search tooltip-top" placeholder="Search" autocomplete="off" data-toggle="tooltip" data-coreui-placement="top" title="Search via Testimonial Name">

                <select name="ss" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Testimonial Status">
                    <option value="a" {{ request()->ss == 'a' ? 'selected' : '' }}>All Status</option>
                    <option value="1" {{ request()->ss == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request()->ss == '0' ? 'selected' : '' }}>Inactive</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right tooltip-top" data-toggle="tooltip" data-coreui-placement="top" title="Search"> <i class="fa fa-search"></i></button>

                <a href="{{ route('testimonial.index') }}" class="btn reset-filter-btn btn-secondary tooltip-top" data-toggle="tooltip" data-coreui-placement="top" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
            <button type="button" id="addTestimonial" class="btn btn-secondary add-data-filter-btn add-testimonial-modal" data-toggle="tooltip" data-coreui-placement="top" title="Add Testimonial" data-url="{{ route('testimonial.create') }}"><i class="fa fa-plus p-1"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" width="5%">S.No.</th>
                        <th scope="col">Author's Name</th>
                        <th scope="col">Testimonial</th>
                        <th scope="col" class="text-center">Published On</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="testimonial-table admin-table">
                    @include('backend.testimonial.include.testimonial-table')
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="view-btn">{{ $testimonialData->links() }}</div>
@endsection

@section('javascript')
<script src="{{ asset('backend/js/testimonial.js') }}"></script>
@endsection