@extends('backend.layouts.app', ['title' => 'FAQ'])
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="help-circle"></i>FAQ</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="faq-filter" action="{{ route('faq.index') }}" autocomplete="off">

                <select name="ss" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter FAQ Status">
                    <option value="a" {{ request()->ss == 'a' ? 'selected' : '' }}>All Status</option>
                    <option value="1" {{ request()->ss == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request()->ss == '0' ? 'selected' : '' }}>Inactive</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('faq.index') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
            <button type="button" id="addfaq" class="btn btn-primary add-data-filter-btn add-faq-modal" data-toggle="tooltip" title="Add FAQ" data-url="{{route('faq.create')}}"><i class="fa fa-plus p-1"></i></button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center" width="5%">S.No.</th>
                    <th scope="col">FAQ Category</th>
                    <th scope="col">Question</th>
                    <th scope="col">Answer</th>
                    <th scope="col" class="text-center" width="10%">Status</th>
                    <th scope="col" class="text-center" width="10%">Action</th>
                </tr>
            </thead>
            <tbody class="faq-table admin-table">
                @include('backend.faq.include.faq-table')
            </tbody>
        </table>
    </div>
</div>
<div class="view-btn">{{ $faqs->links() }}</div>
@endsection
@section('javascript')
<script src="{{asset('backend/js/faq.js')}}"></script>
@endsection