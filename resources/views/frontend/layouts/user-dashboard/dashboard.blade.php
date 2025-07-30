@extends('frontend.layouts.include.app', ['title' => 'Dashboard Page'])
@section('content')

<!-- --------Start-breadcrumb-section--------- -->
<section class="breadcrumb-bg-section faq-bg-section">
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/home">Home</a></li>
                    <li class="breadcrumb-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg></li>
                    <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/home">My Account</a></li>
                    <li class="breadcrumb-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg></li>
                    <li class="breadcrumb-item active">DASHBOARD</li>
                </ol>
            </nav>
        </div>
        <div class="breadcrumb-bg-block mb-3">
            <h4>DASHBOARD</h4>
        </div>
    </div>
</section>
<!-- --------End-breadcrumb-section--------- -->

<section class="user-dashboard mt-3 mb-3">
    <div class="container">
        <div class="dashboard-wrap">
            <div class="row">
                <a class="mobile-toogle toogle-dashboard-btn flex xl-hidden nav-border-right" id="dashboard-toggle" href="javascript:void(0)" title="mobile menu" aria-expanded="false" data-testid="mobile-btn">Dashboard Menu <i data-feather="airplay" class="feather feather-chevron-down ml-2"></i>
                </a>
                <div class="col-md-3 mb-3 d-none d-sm-block">
                    <div class="sidebar-block">
                        <div class="nav flex-column nav-pills text-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <ul class="dashboard-left-nav">
                                <li>
                                    <a class="nav-link active" href="dashboard">
                                        <span class="arrow-icon">
                                            <img src="{{ asset('front-end/assets/image/dashboard.svg') }}" alt="" class="mr-2">
                                        </span>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="my-order"><span class="arrow-icon">
                                            <img src="{{ asset('front-end/assets/image/order.svg') }}" alt="" class="mr-2">
                                        </span> Orders
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="my-profile"><span class="arrow-icon">
                                            <img src="{{ asset('front-end/assets/image/address.svg') }}" alt="" class="mr-2">
                                        </span> Address
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="my-profile"><span class="arrow-icon">
                                            <img src="{{ asset('front-end/assets/image/account-settings.svg') }}" alt="" class="mr-2">
                                        </span> Account Settings
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link " href="user-change-password"><span class="arrow-icon">
                                            <img src="{{ asset('front-end/assets/image/signout.svg') }}" alt="" class="mr-2">
                                        </span> Log Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mobile-toogle-dashboard" style="display: none">
                    <ul class="dashboard-left-nav">
                        <li>
                            <a class="nav-link active" href="dashboard">
                                <span class="arrow-icon">
                                    <img src="{{ asset('front-end/assets/image/dashboard.svg') }}" alt="" class="mr-2">
                                </span>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="my-order"><span class="arrow-icon">
                                    <img src="{{ asset('front-end/assets/image/order.svg') }}" alt="" class="mr-2">
                                </span> Orders
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="my-profile"><span class="arrow-icon">
                                    <img src="{{ asset('front-end/assets/image/address.svg') }}" alt="" class="mr-2">
                                </span> Address
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="user-change-password"><span class="arrow-icon">
                                    <img src="{{ asset('front-end/assets/image/account-settings.svg') }}" alt="" class="mr-2">
                                </span> Account Settings
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="user-change-password"><span class="arrow-icon">
                                    <img src="{{ asset('front-end/assets/image/signout.svg') }}" alt="" class="mr-2">
                                </span> Log Out
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- MAIN -->
                <div class="col-md-9">
                    <div class="dashboard-right-block">
                        <div class="dashboard-card-block mb-3">
                            <div class="row">
                                <div class="col-sm-5 col-lg-5 col-xs-12">
                                    <a href="my-order" class="dashboard-title mb-3">
                                        <div class="dashboard-card card">
                                            <div class="card-body">
                                                <div class="inner-dashboard-title mb-4 d-flex align-items-center justify-content-between">
                                                    <div class="card-order-title">
                                                        <h4 class="text-uppercase">Total Order</h4>
                                                    </div>
                                                    <div class="card-order-icon">
                                                        <img src="{{ asset('front-end/assets/image/total-order-icon.svg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="card-count">
                                                    <h4 class="font-weight-bold">1400</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-order-table-block">
                            <div class="order-heading-block mb-3">
                                <h5 class="text-uppercase">Recent Orders</h5>
                            </div>
                            <div class="card order-table-block">
                                <div class="table-responsive">
                                    <table class="table table-strip my-order">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width:6%" class="text-center">Order</th>
                                                <th style="width:12%" class="text-center">Product</th>
                                                <th style="width:12%" class="text-center">Date</th>
                                                <th style="width:7%" class="text-center">Qty</th>
                                                <th style="width:15%" class="text-center">Total</th>
                                                <th style="width:10%" class="text-center">Status</th>
                                                <th style="width:10%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">#50050</td>
                                                <td class="text-center">Game Reaper</td>
                                                <td class="text-center">07 Apr 2023</td>
                                                <td class="text-center">3 Item</td>
                                                <td class="text-center">$2500.75</td>
                                                <td class="text-center"><span class="order-status success-order"><img src="{{ asset('front-end/assets/image/complete-icon.svg') }}" alt="" class="mr-2"> Complete</span></td>
                                                <td class="text-center">
                                                    <span class="view-order-block"><a href="#" class="action-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><span class="view-order-title">View <img src="{{ asset('front-end/assets/image/eye-icon.svg') }}" alt="" class="ml-1"></span>
                                                        </a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">#50050</td>
                                                <td class="text-center">Game Reaper 2</td>
                                                <td class="text-center">07 Apr 2023</td>
                                                <td class="text-center">3 Item</td>
                                                <td class="text-center">$2500.75</td>
                                                <td class="text-center"><span class="order-status pending-order"><img src="{{ asset('front-end/assets/image/pending-icon.svg') }}" alt="" class="mr-2"> Pending</span></td>
                                                <td class="text-center">
                                                    <span class="view-order-block"><a href="#" class="action-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><span class="view-order-title">View <img src="{{ asset('front-end/assets/image/eye-icon.svg') }}" alt="" class="ml-1"></span>
                                                        </a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">#50050</td>
                                                <td class="text-center">Game Reaper</td>
                                                <td class="text-center">07 Apr 2023</td>
                                                <td class="text-center">3 Item</td>
                                                <td class="text-center">$2500.75</td>
                                                <td class="text-center"><span class="order-status success-order"><img src="{{ asset('front-end/assets/image/complete-icon.svg') }}" alt="" class="mr-2"> Complete</span></td>
                                                <td class="text-center">
                                                    <span class="view-order-block"><a href="#" class="action-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><span class="view-order-title">View <img src="{{ asset('front-end/assets/image/eye-icon.svg') }}" alt="" class="ml-1"></span>
                                                        </a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">#50050</td>
                                                <td class="text-center">Game Reaper 2</td>
                                                <td class="text-center">07 Apr 2023</td>
                                                <td class="text-center">3 Item</td>
                                                <td class="text-center">$2500.75</td>
                                                <td class="text-center"><span class="order-status pending-order"><img src="{{ asset('front-end/assets/image/pending-icon.svg') }}" alt="" class="mr-2"> Pending</span></td>
                                                <td class="text-center">
                                                    <span class="view-order-block"><a href="#" class="action-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><span class="view-order-title">View <img src="{{ asset('front-end/assets/image/eye-icon.svg') }}" alt="" class="ml-1"></span>
                                                        </a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">#50050</td>
                                                <td class="text-center">Game Reaper</td>
                                                <td class="text-center">07 Apr 2023</td>
                                                <td class="text-center">3 Item</td>
                                                <td class="text-center">$2500.75</td>
                                                <td class="text-center"><span class="order-status success-order"><img src="{{ asset('front-end/assets/image/complete-icon.svg') }}" alt="" class="mr-2"> Complete</span></td>
                                                <td class="text-center">
                                                    <span class="view-order-block"><a href="#" class="action-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><span class="view-order-title">View <img src="{{ asset('front-end/assets/image/eye-icon.svg') }}" alt="" class="ml-1"></span>
                                                        </a></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection