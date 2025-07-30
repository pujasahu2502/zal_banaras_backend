@extends('backend.layouts.app', ['title' => 'Customer Report'])
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="bar-chart"></i>Customer Report</h4>        
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="page-filter" action="{{ route('customer.report') }}" autocomplete="off">
                <select name="year" class="form-control form-select yearwise" autocomplete="off" data-toggle="tooltip" title="Filter Year">
                    @for($year = 2014; $year <= date('Y'); $year++)
                        <option value="{{$year }}" {{ request()->year == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>

                <select name="sr" class="form-control form-select time" autocomplete="off" data-toggle="tooltip" title="Filter Report">
                    <option value="tw" {{ request()->sr == 'tw' ? 'selected' : 'selected' }} {{ request()->year != date('Y') ? 'disabled' : ''}}>This Week</option>
                    <option value="tm" {{ request()->sr == 'tm' ? 'selected' : '' }} {{ request()->year != date('Y') ? 'disabled' : ''}}>This Month</option>
                    <option value="ty" {{ request()->sr == 'ty' ? 'selected' : '' }}>Year</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('customer.report') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- PIE CHART -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                <div class="card">
                    <div class="card-header dashboard-order-header dashboard-report-header d-flex align-items-center flex-wrap">
                        <h3 class="mb-0" style="color:#F16E22;">{{ isset($allUser['customer']) ? $allUser['customer'] : '0' }}</h3>
                        <h4 class="title">Signups in This Period</h4>
                    </div>
                    {{-- <div class="card-body">
                        <h6 class="title">
                            <b>Guest: {{ isset($allUser['guest']) ? $allUser['guest'] : '0' }}</b>
                        </h6>
                    </div> --}}
                </div>
                <br>
                <div class="card mb-4">
                    <div class="card-header dashboard-order-header d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="title">Total Orders</h4>
                    </div>
                    <div class="mt-2" id="pieChart" style="height: 230px; width: 100%; padding-bottom: 12px;"></div>
                </div>
            </div>
            <!-- BAR CHART -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                <div class="card mb-4">
                    <div class="card-header dashboard-order-header d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="title">Customers</h4>
                    </div>
                    <div class="mt-2" id="chartContainer" style="height: 370px; width: 100%; padding-bottom: 12px;"></div>
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

    /* ==================== PIE CHART ==================== */
        let orders = '{!! json_encode($allOrder) !!}' 
        let order =JSON.parse(orders);
        CanvasJS.addColorSet("usershades",
            [ 
                "#f4dd89",
                "#cfdbea",
            ]
        );
        var pieChart = {
            colorSet: "usershades",
            data: [{
                type: "doughnut",
                showInLegend: true,
                legendText: "{indexLabel}",
                toolTipContent: "{y} Orders",
                dataPoints: [{
                        y: order.customerUser,
                        indexLabel: "Customer Orders",
                    },
                    {
                        y: order.guestUser,
                        indexLabel: "Guest Orders",
                    },
                ]
            }]
        }
        $('#pieChart').CanvasJSChart(pieChart)

    /* ==================== BAR CHART ==================== */
        let report = '{!! json_encode($reports) !!}' 
        let repData =JSON.parse(report);

        let userReport = '{!! json_encode($userReports) !!}' 
        let userRepData =JSON.parse(userReport);

        CanvasJS.addColorSet("saleshades",
            [
                "#F16E22",
                "#f4dd89"
            ]
        );
        var options = {
            animationEnabled: true,
            colorSet: "saleshades",
            axisY:{
                title:"Customers",
            },
            data: [
                // {
                //     type: "column",
                //     name: "Orders",
                //     toolTipContent: "{y} Orders",
                //     showInLegend: true,
                //     dataPoints: repData,
                // },
                {
                    type: "line",
                    name: "Customers",
                    toolTipContent: "{y} Customer",
                    showInLegend: true,
                    dataPoints: userRepData,
                },
            ]
        };
        $("#chartContainer").CanvasJSChart(options);
    }
</script>
@endsection