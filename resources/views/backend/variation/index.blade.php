@extends('backend.layouts.app', ['title' => $attribute->name ?? ''])
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="framer"></i>Variant</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="variation-filter" action="{{ route('variant.index',$attribute->id) }}" autocomplete="off">
                <input type="text" name="search" value="{{ app('request')->input('search') }}" class="form-control variation-search-input filter-right search" placeholder="Search" autocomplete="off" data-toggle="tooltip" title="Search via Variant Name">

                <select name="ss" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Variant Status">
                    <option value="a" {{ request()->ss == 'a' ? 'selected' : '' }}>All Status</option>
                    <option value="1" {{ request()->ss == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request()->ss == '0' ? 'selected' : '' }}>Inactive</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('variant.index',$attribute->id) }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
            <button type="button" id="addVariation" class="btn btn-secondary add-data-filter-btn add-variation-modal" data-toggle="tooltip" data-coreui-placement="top" title="Add Variant" data-url="{{ route('variant.create') }}" data-attribute-id="{{ $attribute->id ?? '' }}"><i class="fa fa-plus p-1"></i></button>
        </div>
    </div>
    <div class="card-body">
        {{-- <h6><i class="c-sidebar-nav-icon fe-icon" data-feather="shopping-bag"></i><b> Attribute: {{ $attribute->name ?? '' }}</b></h6> --}}
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" width="5%">S.No.</th>
                        <th scope="col">Variant Name</th>
                        <th scope="col">Attribute Name</th>
                        <th scope="col" class="text-center" width="15%">Published On</th>
                        <th scope="col" class="text-center" width="15%">Status</th>
                        <th scope="col" class="text-center" width="15%">Action</th>
                    </tr>
                </thead>
                <tbody class="variation-table admin-table">
                    @include('backend.variation.include.variation-table')
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="view-btn">{{ $variationData->links() }}</div>
@endsection

@section('javascript')
<script src="{{ asset('backend/js/variation.js') }}"></script>
@endsection