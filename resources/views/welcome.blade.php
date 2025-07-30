@extends('backend.layouts.app', ['title' => 'Dashboard'])
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
            <div class="row dashboard">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <a href="{{ route('customer.index') }}" class="dashboard-title mb-2">
                        <div class="dashboard-card card">
                            <div class="card-body">
                                <div class="inner-dashboard-title mb-2 d-flex align-items-center justify-content-between">
                                    <div class="card-order-title">
                                        <h4>Total Customers</h4>
                                    </div> 
                                    <div class="card-order-icon">
                                        <i class="c-sidebar-nav-icon" data-feather="users"></i>
                                    </div>
                                </div>
                                <div class="card-count">
                                    <h4 class="font-weight-bold">{{ number_format($customers->count()) ?? '0' }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <a href="{{ route('category.index') }}" class="dashboard-title mb-2">
                        <div class="dashboard-card card">
                            <div class="card-body">
                                <div class="inner-dashboard-title mb-2 d-flex align-items-center justify-content-between">
                                    <div class="card-order-title">
                                        <h4>Total Categories</h4>
                                    </div>
                                    <div class="card-order-icon">
                                        <i class="c-sidebar-nav-icon" data-feather="briefcase"></i>
                                    </div>
                                </div>
                                <div class="card-count">
                                    <h4 class="font-weight-bold">{{ number_format($categories) ?? '0' }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <a href="{{ route('attribute.index') }}" class="dashboard-title mb-2">
                        <div class="dashboard-card card">
                            <div class="card-body">
                                <div class="inner-dashboard-title mb-2 d-flex align-items-center justify-content-between">
                                    <div class="card-order-title">
                                        <h4>Total Attributes</h4>
                                    </div>
                                    <div class="card-order-icon">
                                        <i class="c-sidebar-nav-icon" data-feather="shopping-bag"></i>
                                    </div>
                                </div>
                                <div class="card-count">
                                    <h4 class="font-weight-bold">{{ number_format($attributes) ?? '0' }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <a href="{{ route('product.index') }}" class="dashboard-title mb-2">
                        <div class="dashboard-card card">
                            <div class="card-body">
                                <div class="inner-dashboard-title mb-2 d-flex align-items-center justify-content-between">
                                    <div class="card-order-title">
                                        <h4>Total Products</h4>
                                    </div>
                                    <div class="card-order-icon">
                                        <i class="c-sidebar-nav-icon" data-feather="shopping-cart"></i>
                                    </div>
                                </div>
                                <div class="card-count">
                                    <h4 class="font-weight-bold">{{ number_format($products) ?? '0' }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 mt-2">
                    <a href="{{ route('order.index') }}" class="dashboard-title mb-2">
                        <div class="dashboard-card card">
                            <div class="card-body">
                                <div class="inner-dashboard-title mb-2 d-flex align-items-center justify-content-between">
                                    <div class="card-order-title">
                                        <h4>Total Orders</h4>
                                    </div>
                                    <div class="card-order-icon">
                                        <i class="c-sidebar-nav-icon" data-feather="book-open"></i>
                                    </div>
                                </div> 
                                <div class="card-count">
                                    <h4 class="font-weight-bold">{{ number_format($orders) ?? '0' }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 mt-2">
                    <a href="{{ route('blogs.index') }}" class="dashboard-title mb-2">
                        <div class="dashboard-card card">
                            <div class="card-body">
                                <div class="inner-dashboard-title mb-2 d-flex align-items-center justify-content-between">
                                    <div class="card-order-title">
                                        <h4>Total Blogs</h4>
                                    </div>
                                    <div class="card-order-icon">
                                        <i class="c-sidebar-nav-icon" data-feather="edit"></i>
                                    </div>
                                </div>
                                <div class="card-count">
                                    <h4 class="font-weight-bold">{{ number_format($blogs) ?? '0' }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 mt-2">
                    <a href="{{ route('dealer.index') }}" class="dashboard-title mb-2">
                        <div class="dashboard-card card">
                            <div class="card-body">
                                <div class="inner-dashboard-title mb-2 d-flex align-items-center justify-content-between">
                                    <div class="card-order-title">
                                        <h4>Total Dealers</h4>
                                    </div>
                                    <div class="card-order-icon">
                                        <i class="c-sidebar-nav-icon" data-feather="user-check"></i>
                                    </div>
                                </div>
                                <div class="card-count">
                                    <h4 class="font-weight-bold">{{ number_format($dealers) ?? '0' }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 mt-2">
                    <a href="{{ route('order.index') }}" class="dashboard-title mb-2">
                        <div class="dashboard-card card">
                            <div class="card-body">
                                <div class="inner-dashboard-title mb-2 d-flex align-items-center justify-content-between">
                                    <div class="card-order-title">
                                        <h4>Total Sale</h4>
                                    </div>
                                    <div class="card-order-icon">
                                        <i class="c-sidebar-nav-icon" data-feather="dollar-sign"></i>
                                    </div>
                                </div>
                                <div class="card-count">
                                    <h4 class="font-weight-bold">{{'₹'.number_format($totalSale,2) ?? '0' }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
            <div class="card transition-card mb-4">
                <div class="card-header dashboard-order-header d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="dollar-sign"></i> Transaction</h4>
                </div>
                <div class="card-body">
                    <div class="inner-dashboard-title mb-3 d-flex align-items-center justify-content-between">
                        <div class="card-order-title">
                            <h4>This Week</h4>
                        </div>
                        <div class="card-order-icon">
                            <h4>${{ number_format($last7DaysTransaction, 2) ?? '0' }}</h4>
                        </div>
                    </div>
                    <div class="inner-dashboard-title mb-3 d-flex align-items-center justify-content-between">
                        <div class="card-order-title">
                            <h4>This Month</h4>
                        </div>
                        <div class="card-order-icon">
                            <h4>${{ number_format($last30DaysTransaction, 2) ?? '0' }}</h4>
                        </div>
                    </div>
                    <div class="inner-dashboard-title mb-3 d-flex align-items-center justify-content-between">
                        <div class="card-order-title">
                            <h4>This Year</h4>
                        </div>
                        <div class="card-order-icon">
                            <h4>${{ number_format($last365DaysTransaction, 2) ?? '0' }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
            <div class="card recentaly-order-card-block mb-4">
                <div class="card-header dashboard-order-header d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="users"></i> Recently Joined</h4>
                    <a class="edit-faq-modal btn button-success tooltip-top btn-xs" href="{{ route('customer.index') }}">View All </a>
                </div>
               
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col" class="text-center">Created at</th>
                                </tr>
                            </thead>
                            <tbody class="admin-table">
                                @if (isset($customerList))
                                @forelse ($customerList as $key => $customer)
                                <tr>
                                    <td>
                                        @php $fullName = $customer->first_name.' '.$customer->last_name; @endphp
                                        @if(strlen($fullName) > 30)
                                            <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($fullName) ?? '-'}}">{{ Str::limit(ucwords($fullName), 30) ?? '-'}}</span>
                                        @else
                                            <span>{{ ucwords($fullName) ?? '-'}}</span>
                                        @endif
                                    </td>
                                    <td class="text-center"><i class="fa fa-calendar"></i> {{ dbCustomDateFormat($customer->created_at) ?? '' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="15">
                                        <div class="text-center mb-3">
                                            <i data-feather="alert-circle"></i>
                                            <h4 class="title">@lang('no_customer')</h4>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                                @else
                                <tr>
                                    <td colspan="15">
                                        <div class="text-center mb-3">
                                            <i data-feather="alert-circle"></i>
                                            <h4 class="title">@lang('no_customer')</h4>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card recentaly-order-card-block mb-4">
                <div class="card-header dashboard-order-header d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="book-open"></i> Recent Orders</h4>
                    <a class="btn button-success" href="{{ route('order.index') }}">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col" class="text-center">Order Id</th>
                                    <th scope="col" class="text-center">Order Date</th>
                                    <th scope="col" class="text-center">Order Amount</th>
                                </tr>
                            </thead>
                            <tbody class="admin-table">
                                @if (isset($orderList))
                                @forelse ($orderList as $key => $order)
                                <tr>
                                    <td>
                                        @php $fullName = ($order->customer->first_name ?? '') .' '. ($order->customer->last_name ?? ''); @endphp

                                        @if(strlen($fullName) > 30)
                                            <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($fullName) ?? '-'}}">{{ Str::limit(ucwords($fullName), 30) ?? '-'}}</span>
                                        @else
                                            <span>{{ ucwords($fullName) ?? '-'}}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{$order['id'] ?? '-'}}</td>

                                    {{-- <td class="text-capitalize">
                                        @if(collect($order->orderItems)->pluck('product.name')->count())

                                            @if(strlen(implode(', ',json_decode(collect($order->orderItems)->pluck('product.name')))) > 30)
                                                <span class="tooltip-top-large-contain" data-tooltip="{{ucwords(implode(', ',json_decode(collect($order->orderItems)->pluck('product.name')))) ?? '-'}}">
                                                    {{ Str::limit(ucwords(implode(', ',json_decode(collect($order->orderItems)->pluck('product.name')))), 30) ?? '-'}}
                                                </span>
                                            @else
                                                <span>{{ ucwords(implode(', ',json_decode(collect($order->orderItems)->pluck('product.name')))) ?? '-'}}</span>
                                            @endif

                                        @else
                                            {{ '-' }}
                                        @endif

                                    </td> --}}
                                    <td class="text-center"><i class="fa fa-calendar"></i> {{ dbCustomDateFormat($order->created_at) ?? '' }}</td>
                                    <td class="text-center">${{collect($order["orderItems"])->sum('total_amount')}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="15">
                                        <div class="text-center mb-3">
                                            <i data-feather="alert-circle"></i>
                                            <h4 class="title">@lang('no_order')</h4>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                                @else
                                <tr>
                                    <td colspan="15">
                                        <div class="text-center mb-3">
                                            <i data-feather="alert-circle"></i>
                                            <h4 class="title">@lang('no_order')</h4>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script src='{{asset("/backend/js/order.js")}}'></script>
@endsection