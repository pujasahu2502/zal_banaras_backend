<a class="mobile-toogle toogle-dashboard-btn flex xl-hidden nav-border-right" id="dashboard-toggle" href="javascript:void(0)" title="mobile menu" aria-expanded="false" data-testid="mobile-btn">Dashboard Menu <i data-feather="airplay" class="feather feather-chevron-down ml-2"></i></a>
<div class="col-md-3 mb-3 d-none d-sm-block">
    <div class="sidebar-block">
        <div class="nav flex-column nav-pills text-left" id="v-pills-tab" role="tablist"
            aria-orientation="vertical">
            <ul class="dashboard-left-nav">
                {{-- <li>
                    <a class="nav-link  {{Request::is('dashboard') ? 'active' : '' }}" href='{{route("user.dashboard")}}'>
                        <span class="arrow-icon"><i data-feather="airplay" class="feather mr-2"></i></span> Dashboard
                    </a>
                </li> --}}
                <li>
                    <a class="nav-link {{Request::is('orders') || Request::segment(2) == 'detail' || Request::segment(1) == 'review' ? 'active' : '' }}" href="{{route('orders.index')}}">
                        <span class="arrow-icon"><i data-feather="shopping-cart" class="feather mr-2"></i></span> My Orders
                    </a>
                </li>
                <li>
                    <a class="nav-link {{Request::is('my-profile') ? 'active' : '' }}" href='{{route("dashboard.myprofile")}}'>
                        <span class="arrow-icon"><i data-feather="user" class="feather mr-2"></i></span> My Profile
                    </a>
                </li>
                <li>
                    <a class="nav-link {{Request::segment(1) == 'address' ? 'active' : '' }}" href='{{route("address.index")}}'>
                        <span class="arrow-icon"><i data-feather="map-pin" class="feather mr-2"></i></span> Address
                    </a>
                </li>
                <li>
                    <a class="nav-link {{Request::is('user-change-password') ? 'active' : '' }}" href='{{route("user-change-password.index")}}'>
                        <span class="arrow-icon"><i data-feather="lock" class="feather mr-2"></i></span> Change Password
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="post" id="logout">
                        @csrf
                        <a class="nav-link" href="javaScript:;" onclick="document.getElementById('logout').submit();">
                            <span class="arrow-icon mr-2"><i data-feather="log-out"></i></span> Log Out
                        </a>
                    </form>
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
                    <i data-feather="airplay" class="feather mr-2"></i>
                </span>
                Dashboard
            </a>
        </li>
        <li>
            <a class="nav-link" href="my-order"><span class="arrow-icon">
                    <i data-feather="shopping-cart" class="feather mr-2"></i>
                </span> My Orders
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{route("dashboard.myprofile")}}"><span class="arrow-icon">
                    <i data-feather="user" class="feather mr-2"></i>
                </span> My Profile
            </a>
        </li>
        <li>
            <a class="nav-link " href="{{route("user-change-password.index")}}"><span class="arrow-icon">
                    <i data-feather="lock" class="feather mr-2"></i>
                </span> Change Password
            </a>
        </li>
    </ul>
</div>