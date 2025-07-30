@extends('backend.layouts.app', ['title' => 'Analytics'])
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
            <div class="card mb-4">
                <div class="card-header dashboard-order-header d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="users"></i> Number of Customers</h4>
                </div>
                <div class="mt-2 mb-3" id="pieChart" style="height: 330px; width: 100%; padding-bottom: 12px;"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header dashboard-order-header d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="book-open"></i> Customer and Guest Order</h4>
                </div>
                <div class="mt-2 mb-3" id="barChart" style="height: 330px; width: 100%; padding-bottom: 12px;"></div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
{{-- <script src='{{asset("/backend/js/order.js")}}'></script> --}}
<script>
    let users = '{!! json_encode($activeUser) !!}'
    let usersData =JSON.parse(users);

    let customerGuestSale = '{!! json_encode($customerGuestSale) !!}'
    let sale =JSON.parse(customerGuestSale);

    window.onload = function() {
        CanvasJS.addColorSet("usershades",
            [ 
                "#f4dd89",
                "#cfdbea",
            ]
        );
        CanvasJS.addColorSet("saleshades",
            [
                "#f4dd89",
                "#cfdbea",
            ]
        );
        /* === PIE CHART === */
        var chart = {
            colorSet: "usershades",
            // title: {
            //     text: "Number of users"
            // },
            data: [{
                type: "doughnut",
                showInLegend: true,
                legendText: "{indexLabel}",
                toolTipContent: "<b>{label}:</b> {y} Customer",
                dataPoints: [{
                        y: usersData.activeUser,
                        indexLabel: "Active Customer",
                        label: "Active",
                    },
                    {
                        y: usersData.inActiveUser,
                        indexLabel: "Inactive Customer",
                        label: "Inactive",
                    },
                ]
            }]
        }
        $('#pieChart').CanvasJSChart(chart)

        /* === BAR CHART === */
        var chart = {
            colorSet: "saleshades",
            axisY:{
    			title:"Orders",
    		},
            data: [
                {
                    // type: "stackedColumn",
                    type: "column",
                    legendText: "Customer Order",
    			    toolTipContent: "<b>{legendText}: </b> {y}", 
                    showInLegend: "true",
                    dataPoints: sale.customerSale,
                },
                {
                    // type: "stackedColumn",
                    type: "column",
                    legendText: "Guest Order",
                    toolTipContent: "<b> {legendText} : </b> {y}", 
                    showInLegend: "true",
                    dataPoints: sale.guestSale
                }
            ]
        }
        $('#barChart').CanvasJSChart(chart)
    }
</script>
@endsection