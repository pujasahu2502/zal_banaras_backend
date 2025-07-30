<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg"><use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use></svg>
        </button>
        <a class="header-brand d-md-none" href="#">
            <img src="{{ asset('assets/img/new-logo.png') }}" width="100px" height="auto" alt="CoreUI Logo">
        </a>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md">
                        <span>{{Auth::user()->first_name ?? ''}}</span>
                        <img class="avatar-img" src="{{ asset('backend/admin-logo.png') }}" alt="user@email.com" style="margin-right: 8px;">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-1">
                    <a class="dropdown-item" href="{{ route('home') }}" data-url="{{ route('home') }}" id="go-to-website">
                        <i class="c-sidebar-nav-icon" data-feather="globe"></i>
                        <span style="margin-left:10px">Go To Website</span>
                    </a>
                    <a class="dropdown-item" href="javaScript:;" data-url="{{ route('profile.index') }}" id="admin-profile-setting">
                        <i class="c-sidebar-nav-icon" data-feather="user"></i>
                        <span style="margin-left:10px">Profile</span>
                    </a>
                    <a class="dropdown-item" href="javaScript:;" data-url="{{ route('setting.index') }}" id="admin-setting">
                        <i class="c-sidebar-nav-icon" data-feather="settings"></i>
                        <span style="margin-left:10px">Website Settings</span>
                    </a>
                    <a class="dropdown-item" href="javaScript:;" data-url="{{ route('change-password.index') }}" id="change-password">
                        <i class="c-sidebar-nav-icon" data-feather="lock"></i>
                        <span style="margin-left:10px">Change Password</span>
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                        <i class="c-sidebar-nav-icon" data-feather="log-out"></i>
                        <span style="margin-left:10px">Logout</span>
                    </a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </div>
            </li>
        </ul>
    </div>
    <div class="header-divider"></div>
    @include('backend.layouts.include.breadcrum')
</header>