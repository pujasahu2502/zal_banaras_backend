@extends('backend.layouts.app', ['title' => 'Order Report'])
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="pie-chart"></i>Order Report</h4>        
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="page-filter" action="{{ route('order.report') }}" autocomplete="off">

                <select name="year" class="form-control form-select yearwise" autocomplete="off" data-toggle="tooltip" title="Filter Year">
                    @for($year = 2014; $year <= date('Y'); $year++)
                        <option value="{{$year }}" {{ request()->year == $year ? 'selected' : 'selected' }}>{{ $year }}</option>
                    @endfor
                </select>
                <select name="sr" class="form-control form-select time" autocomplete="off" data-toggle="tooltip" title="Filter Report">
                    <option value="tw" {{ request()->sr == 'tw' ? 'selected' : 'selected' }} {{ request()->year != null && request()->year != date('Y') ? 'disabled' : ''}}>This Week</option>
                    <option value="tm" {{ request()->sr == 'tm' ? 'selected' : '' }} {{ request()->year != null && request()->year != date('Y') ? 'disabled' : ''}}>This Month</option>
                    <option value="ty" {{ request()->sr == 'ty' ? 'selected' : '' }}>Year</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('order.report') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- NET SALE -->
            <div class="col-sm-2 col-lg-2">
                <div class="card text-center">                    
                    <div class="mt-3" data-toggle="tooltip" title="This is the sum of the order totals after any refunds and including shipping and taxes."  style="color: #3498db;">
                        {{-- {{dd($grossSale)}} --}}
                        <h4>${{ number_format($grossSale, 2) ?? '0' }}</h4>
                        <span>Gross Sales in This Period</span>
                    </div>
                    <hr>
                    <div data-toggle="tooltip" title="This is the sum of the order totals after any refunds and excluding shipping and taxes." style="color: #cab03f;">
                        <h4>${{ number_format($netSale, 2) ?? '0' }}</h4>
                        <span>Net Sales in This Period</span>
                    </div>
                    <hr>
                    <div style="color: #f4dd89;">
                        <h4>{{ $orderPlaced ?? '0' }}</h4>
                        <span>Orders Placed</span>
                    </div>
                    {{-- <hr>
                    <div style="color: #F16E22;">
                        <h4>{{ $itemPurchased ?? '0' }}</h4>
                        <span>Items Purchased</span>
                    </div> --}}
                </div>
            </div>
            <!-- BAR CHART -->
            <div class="col-sm-10 col-lg-10">
                <div class="card mb-4">
                    <div class="card-header dashboard-order-header d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="title">Orders and Sales</h4>
                    </div>
                    <div class="mt-2" id="chartContainer" style="height: 400px; width: 100%; padding-bottom: 12px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $(document).on("change",".yearwise",function() {
        let currentYear = new Date().getFullYear();
        if( this.value == currentYear) {
            $(".time option[value=tw]").removeAttr('disabled');
            $(".time option[value=tm]").removeAttr('disabled');
        }else{
            $(".time option[value=tw]").prop('disabled','disabled');
            $(".time option[value=tm]").prop('disabled','disabled');
        }
    })
</script>

<script type="text/javascript">
    
    window.onload = function () {

    /* ==================== BAR CHART ==================== */
        let report = '{!! json_encode($reports) !!}' 
        let repData =JSON.parse(report);

        let grossSaleChart = '{!! json_encode($grossSaleData) !!}' 
        let grossSale =JSON.parse(grossSaleChart);

        let netSaleChart = '{!! json_encode($netSaleData) !!}' 
        let netSale =JSON.parse(netSaleChart);

        let itemPurchasedChart = '{!! json_encode($itemPurchasedData) !!}' 
        let itemPurchased =JSON.parse(itemPurchasedChart);

        CanvasJS.addColorSet("saleshades",
            [
                "#f4dd89",
                "#3498db",
                "#cab03f",
                "#F16E22",
            ]
        );
        var options = {
            animationEnabled: true,
            colorSet: "saleshades",
            data: [
                {
                    type: "column",
                    name: "Orders",
                    toolTipContent: "{y} Orders",
                    showInLegend: true,
                    dataPoints: repData,
                },
                {
                    type: "line",
                    name: "Gross Sale",
                    toolTipContent: "${y}",
                    showInLegend: true,
                    dataPoints: grossSale,
                },
                {
                    type: "line",
                    name: "Net Sale",
                    toolTipContent: "${y}",
                    showInLegend: true,
                    dataPoints: netSale,
                },
                // {
                //     type: "line",
                //     name: "Items Purchased",
                //     toolTipContent: "{y} Items",
                //     showInLegend: true,
                //     dataPoints: itemPurchased,
                // },
            ]
        };
        $("#chartContainer").CanvasJSChart(options);
    }
</script>
@endsection