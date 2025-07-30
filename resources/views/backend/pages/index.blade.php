@extends('backend.layouts.app', ['title' => 'Page'])
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="book"></i>Page</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="page-filter" action="{{ route('page.index') }}" autocomplete="off">
                <select name="ss" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Page Status">
                    <option value="a" {{ request()->ss == 'a' ? 'selected' : '' }}>All Status</option>
                    <option value="1" {{ request()->ss == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request()->ss == '0' ? 'selected' : '' }}>Inactive</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('page.index') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="5%">S.No.</th>
                        <th scope="col">Page Title</th>
                        <th scope="col">Page Slug</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="admin-table pages-table">
                    @include('backend.pages.include.page-table')
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="view-btn">{{ $pages->links() }}</div>
@endsection
@section('javascript')
<script src="{{asset('backend/js/pages.js')}}"></script>
@endsection