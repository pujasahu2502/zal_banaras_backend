@extends('backend.layouts.app', ['title' => 'Blog'])
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="edit-3"></i>Blog</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="blog-filter" action="{{ route('blogs.index') }}" autocomplete="off">
                <input type="text" name="search" value="{{ app('request')->input('search') }}" class="form-control blog-search-input filter-right search" placeholder="Search" autocomplete="off" data-toggle="tooltip" title="Search via Blog Title">

                <select name="ss" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Blog Status">
                    <option value="a" {{ request()->ss == 'a' ? 'selected' : '' }}>All Status</option>
                    <option value="1" {{ request()->ss == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request()->ss == '0' ? 'selected' : '' }}>Inactive</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('blogs.index') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
            <button type="button" id="addBlog" class="btn btn-primary add-data-filter-btn add-blog-modal" data-toggle="tooltip" data-placement="top" title="Add Blog" data-url="{{ route('blogs.create') }}"><i class="fa fa-plus p-1"></i></button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center" width="5%">S.No.</th>
                    <th scope="col" class="text-center" width="10%">Blog Image</th>
                    <th scope="col">Blog Title</th>
                    <th scope="col" class="text-center" width="15%">Status</th>
                    <th scope="col" class="text-center" width="15%">Published On</th>
                    <th scope="col" class="text-center" width="15%">Action</th>
                </tr>
            </thead>
            <tbody class="faq-table admin-table pages-table blog-table">
                @include('backend.blog.include.blog-table')
            </tbody>
        </table>
    </div>
</div>
<div class="view-btn">{{ $blogData->links() }}</div>
@endsection

@section('javascript')
<script src="{{asset('backend/js/blog.js')}}"></script>
@endsection