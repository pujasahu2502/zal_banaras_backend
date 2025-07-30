@extends('backend.layouts.app', ['title' => 'Order'])
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="book-open"></i>Order</h4>
        <div class="right-filter-block order-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="order-filter" action="{{ route('order.index') }}" autocomplete="off">

                <input type="text" name="search" value="{{ app('request')->input('search') }}" class="form-control product-search-input filter-right search" placeholder="Search" autocomplete="off" data-toggle="tooltip" title="Search via Order Id, Customer Name, Customer Email">

                <input type="text" id="start_date" name="start_date" value="{{ app('request')->input('start_date') }}" class="form-control date " placeholder="Order From Date" autocomplete="off" data-toggle="tooltip" title="Choose Order From Date">

                <input type="text" id="end_date" name="end_date" value="{{ app('request')->input('end_date') }}" class="form-control date " placeholder="Order To Date" autocomplete="off" data-toggle="tooltip" title="Choose Order To Date">

                <select name="sort_by" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Sort Order">
                    <option value="2" {{ request()->input('sort_by') == '2' ? 'selected' : '' }}>Sort by New</option>
                    <option value="1" {{ request()->input('sort_by') == '1' ? 'selected' : '' }}>Sort by Old</option>
                    {{-- <option value="3" {{ request()->sort_by == '3' ? 'selected' : '' }}>Sort by A-Z</option>
                    <option value="4" {{ request()->sort_by == '4' ? 'selected' : '' }}>Sort by Z-A</option> --}}
                </select>

                <select name="os" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Order Status">
                    <option value="a" {{ request()->input('os') == 'a' ? 'selected' : '' }}>All Order Status</option>
                    <option value="1" {{ request()->input('os') == '1' ? 'selected' : '' }}>Processing</option>
                    <option value="2" {{ request()->input('os') == '2' ? 'selected' : '' }}>On hold</option>
                    <option value="3" {{ request()->input('os') == '3' ? 'selected' : '' }}>Completed</option>
                    <option value="4" {{ request()->input('os') == '4' ? 'selected' : '' }}>Refunded</option>
                    <option value="9" {{ request()->input('os') == '9' ? 'selected' : '' }}>Cancelled</option>
                    <option value="10" {{ request()->input('os') == '10' ? 'selected' : '' }}>Failed</option>
                </select>

                <select name="ps" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Filter Payment Status">
                    <option value="a" {{ request()->input('ps') == 'a' ? 'selected' : '' }}>All Payment Status</option>
                    <option value="1" {{ request()->input('ps') == '1' ? 'selected' : '' }}>Pending</option>
                    <option value="2" {{ request()->input('ps') == '2' ? 'selected' : '' }}>Completed</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('order.index') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" width="5%">S.No.</th>
                        <th scope="col">Order Id</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Email</th>
                        <th scope="col" class="text-center">Mobile Number</th>
                        <th scope="col" class="text-center">Placed On</th>
                        {{-- <th scope="col">Product</th> --}}
                        <th scope="col" class="text-center">Payment Status</th>
                        <th scope="col" class="text-center" width="12%">Order Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="order-table admin-table">
                    @include('backend.order.include.order-table')
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="view-btn">{{ $orders->links() }}</div>
@endsection

@section('javascript')
<script src='{{asset("/backend/js/order.js")}}'></script>

<script>
    $(document).ready(function() {
        // $('.date').datepicker({
        //     format: 'yyyy-mm-dd',
        // });
        assignDatePick();
        /* === PRODUCT DETAIL === */
        $(".order-item-detail").hide();
        $(".view-more").click(function() {
            $(".order-item-detail").show();
        });
    });

    /* =============== ON DTAE CHANGE ASSIGN DATEPICKER =============== */
function assignDatePick() {
    var dateFormat = "yyyy-mm-dd",
        from = $("#start_date").datepicker({
            format: dateFormat,
            autoclose: true,
        }).on("change", function (selected) {
            var toMinDate = $("#start_date").datepicker().val();
            var dateDate = toMinDate.split('-');

            var startDate = new Date(dateDate[0], (parseInt(dateDate[1]) - 1), (parseInt(dateDate[2]) + 1));
            to.datepicker("setStartDate", startDate);
        }),

        to = $("#end_date").datepicker({
            format: dateFormat,
            autoclose: true,
        }).on("change", function () {
            var fromMaxDate = $("#end_date").datepicker().val();
            var dateDate = fromMaxDate.split('-');
            var startDate = new Date(dateDate[0], (parseInt(dateDate[1]) - 1), (parseInt(dateDate[2]) - 1));
            from.datepicker("setEndDate", startDate);
        });
}

    
</script>

@endsection