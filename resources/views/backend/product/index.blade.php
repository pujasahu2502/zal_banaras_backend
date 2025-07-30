@extends('backend.layouts.app', ['title' => 'Product'])
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="shopping-cart"></i>Product</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="product-filter" action="{{ route('product.index') }}" autocomplete="off">
                <input type="text" name="search" value="{{ app('request')->input('search') }}" class="form-control product-search-input filter-right search" placeholder="Search" autocomplete="off" data-toggle="tooltip" title="Search via Product Name, Category Name">

                <select name="sort_by" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Sort Product">
                    <option value="2" {{ request()->sort_by == '2' ? 'selected' : '' }}>Sort by New</option>
                    <option value="1" {{ request()->sort_by == '1' ? 'selected' : '' }}>Sort by Old</option>
                    <option value="3" {{ request()->sort_by == '3' ? 'selected' : '' }}>Sort by A-Z</option>
                    <option value="4" {{ request()->sort_by == '4' ? 'selected' : '' }}>Sort by Z-A</option>
                </select>

                <select name="pt" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Product Type">
                    <option value="a" {{ request()->pt == 'a' ? 'selected' : '' }}>All Type</option>
                    <option value="1" {{ request()->pt == '1' ? 'selected' : '' }}>Simple</option>
                    <option value="2" {{ request()->pt == '2' ? 'selected' : '' }}>Variable</option>
                </select>

                <select name="ps" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Product Status">
                    <option value="a" {{ request()->ps == 'a' ? 'selected' : '' }}>All Status</option>
                    <option value="1" {{ request()->ps == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request()->ps == '0' ? 'selected' : '' }}>Inactive</option>
                    <option value="2" {{ request()->ps == '2' ? 'selected' : '' }}>Draft</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('product.index') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
            <a href="{{ route('product.create1',['1','0']) }}" class="btn btn-primary add-data-filter-btn" data-toggle="tooltip" title="Add Product"><i class="fa fa-plus p-1"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" width="5%">S.No.</th>
                            <th scope="col" class="text-center">Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Category Name</th>
                            <th scope="col" class="text-center">Product Type</th>
                            <th scope="col" class="text-center">Stock Status</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="product-table admin-table">
                        @include('backend.product.include.product-table')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="view-btn">
    {{ $productData->links() }}
</div>
@endsection

@section('javascript')
<script>
    var createUrl = "{{ route('product.create') }}";
    var productStoreUrl = "{{ route('product.store') }}";
</script>
<script src="{{ asset('backend/js/product.js') }}"></script>
@endsection