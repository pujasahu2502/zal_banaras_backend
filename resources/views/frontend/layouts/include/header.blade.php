<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-6">
                <div class="left-header-block">
                    <div class="header-content d-flex align-items-center">
                        <img alt="logo" src="{{ asset('front-end/assets/image/flag-usa.png') }}" />
                        <p>Made In USA</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-6">
                @if(isset($setting) && !empty($setting['facebook'] || $setting['linkedin'] || $setting['instagram'] || $setting['twitter']))
                <div class="header-social-block text-right">
                    <ul>
                        @if($setting->facebook != null)
                        <li><a href="{{$setting->facebook ?? '#'}}" target="_blank" data-toggle="tooltip" title="Facebook"><i data-feather="facebook" style="stroke: #fff;"></i></a></li>
                        @endif
                        @if($setting->instagram != null)
                        <li><a href="{{$setting->instagram ?? '#'}}" target="_blank" data-toggle="tooltip" title="Instagram"><i data-feather="instagram"></i></a></li>
                        @endif
                        @if($setting->twitter != null)
                        <li><a href="{{$setting->twitter ?? '#'}}" target="_blank" data-toggle="tooltip" title="Twitter"><i data-feather="twitter" style="fill: #fff;"></i></a></li>
                        @endif
                        @if($setting->linkedin != null)
                        <li><a href="{{$setting->linkedin ?? '#'}}" target="_blank" data-toggle="tooltip" title="Linkedin"><i data-feather="linkedin" style="fill: #fff;"></i></a></li>
                        @endif
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<header class="{{ (Request::is('category-listing-product') == 'category-listing-product' || Request::is('home') == 'home') ? 'home-header' : 'inner-page-header'}}" id="myHeader">
    <div class="container">
        <nav aria-label="primary" class="navbar-root">
            <a class="mobile-toogle xl-hidden nav-border-right" id="toggle" href="javascript:void(0)" title="mobile menu" aria-expanded="false" data-testid="mobile-btn">
                <div class="mobile-menu-btn"></div>
            </a>
            <div class="mobile-toogle-menu " id="menu">
                <ul>
                    <li><a href="{{route('home')}}">Home</a></li>
                    <!-- <li><a href="{{route('frontend.products.index')}}">Products</a></li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-menuitems-link dropdown-toggle" href="javascript:;" role="button" aria-expanded="false">
                            Products <span class="caret"></span>
                        </a>
                        
                        <ul class="dropdown-menu">
                            @php $i =0 @endphp
                            @forelse($categoryData as $categoryKey => $categoryValue)
                            @php $categoryType = ''; @endphp
                            @if($categoryKey == '1')
                            @php $categoryType = 'Scope Mounts and Rings'; @endphp
                            @elseif($categoryKey == '2')
                            @php $categoryType = 'Mounting Accessories'; @endphp
                            @elseif($categoryKey == '3')
                            @php $categoryType = 'DNZ Hats & Apparel'; @endphp
                            @elseif($categoryKey == '4')
                            @php $categoryType = 'Other Useful Products'; @endphp
                            @endif
                            <li class="dropdown-submenu">
                                <a class="mega-menu dropdown-toggle {{ in_array($categoryKey, json_decode(collect($categoryValue)->whereIn("slug",request()->input('category'))->pluck('type')) ) > 0 ? 'active'  : '' }}" tabindex="-1" href="#">{{$categoryType ?? ''}} <span class="caret"><i class="icon-control fa fa-chevron-down"></i></span></a>
                                <ul class="dropdown-menu">
                                    @forelse($categoryValue as $category)
                                    <li><a tabindex="-1" class="{{ request()->input('category')  ?  (in_array($category["slug"], request()->input('category')) > 0 ? "active" : "" ) : " "}}" href="{{route('frontend.products.index',['category[]' => $category->slug ])}}">{{ $category->name ?? '' }}</a></li>
                                    @empty

                                    @endforelse
                                </ul>
                            </li>
                            @empty
                            @endforelse
                        </ul>
                    </li>
                    <li><a href="{{route('why-dnz')}}">PRODUCT INFO?</a></li>
                    <li><a href="{{ route('dealer-locator') }}">Dealer Locator</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-menuitems-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            FAQ's <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu"><a tabindex="-1" class="mega-menu {{Request::is('faqs-info') ? 'active' : '' }} " href="{{ route('faq.info') }}">FAQ's/Info</a></li>
                            <li class="dropdown-submenu"><a tabindex="-1" class="mega-menu {{Request::is('faqs') ? 'active' : '' }} " href="{{ route('faqs.index') }}">DNZ Videos</a></li>
                            <li class="dropdown-submenu"><a tabindex="-1" class="mega-menu {{Request::is('index.php') ? 'active' : '' }}" href="{{asset('DNZ-Products-Scope-Mount-Height-Chart/index.php')}}" target="_blank" class="mega-menu">Scope Height Mount Chart</a></li>
                            {{-- <li class="dropdown-submenu"><a tabindex="-1" class="mega-menu {{Request::is('help-center') ? 'active' : '' }}" href="{{route('help-center')}}" class="mega-menu">Help Center/Video</a></li> --}}
                        {{-- <li><a tabindex="-1" href="#"></a></li> --}}
                        </ul>
                    </li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href=" {{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ asset('catelog/product-catalog-2023.pdf') }}" target="_blank">Catalog</a></li>
                </ul>
            </div>
            <a class="nav-brand-logo cursor-pointer py-2" data-testid="navLogo" href="/">
                <div class="nav-home-logo h-16 relative">
                    <img alt="logo" src="{{ asset('front-end/assets/image/white-logo.png') }}" />
                </div>
            </a>

            <div class="nav-menuitems nav-menuitems-borderleft">
                <a class="nav-menuitems-link hidden xl-inline" href="{{route('home')}}">
                    <span class="nav-menu-items-label">Home</span>
                </a>
                <!-- <a class="nav-menuitems-link hidden xl-inline" href="{{route('frontend.products.index')}}">
                    <span class="nav-menu-items-label">Products</span>
                </a> -->
                <div class="nav-item dropdown">
                    <a class="nav-menuitems-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Products <span class="caret"><i class="icon-control fa fa-chevron-down"></i></span>
                    </a>

                    <ul class="dropdown-menu">
                        <!-- <li><a tabindex="-1" href="#">Scope Mounts and Rings</a></li>
                        <li><a tabindex="-1" href="#">Gun Accessories</a></li>
                        <li><a tabindex="-1" href="#">DNZ Hats & Apparel</a></li>
                        <li class="dropdown-submenu">
                            <a class="mega-menu dropdown-toggle active" tabindex="-1" href="#">Other Useful Products <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="#">Nevel Scope Leveling System</a></li>
                                <li><a tabindex="-1" href="#">DNZ Gap Buddy</a></li>
                                <li><a tabindex="-1" href="#" class="active">DNZ Rapid Height</a></li>
                                <li><a tabindex="-1" href="#">DNZ Pro Scope Mounting Kit</a></li>
                                <li><a tabindex="-1" href="#">Quick Justice</a></li>
                                <li><a tabindex="-1" href="#">Mounting Screws and Studs</a></li>
                                <li><a tabindex="-1" href="#">Ring Inserts</a></li>
                            </ul>
                        </li> -->
                        {{-- {{dd($categoryData)}} --}}
                        @php $i =0 @endphp
                        @forelse($categoryData as $categoryKey => $categoryValue)
                        @php $categoryType = ''; @endphp
                        @if($categoryKey == '1')
                        @php $categoryType = 'Scope Mounts and Rings'; @endphp
                        @elseif($categoryKey == '2')
                        @php $categoryType = 'Mounting Accessories'; @endphp
                        @elseif($categoryKey == '3')
                        @php $categoryType = 'DNZ Hats & Apparel'; @endphp
                        @elseif($categoryKey == '4')
                        @php $categoryType = 'Other Products'; @endphp
                        @endif
                        <li class="dropdown-submenu">
                            <a class="mega-menu dropdown-toggle {{-- in_array($categoryKey, json_decode(collect($categoryValue)->whereIn("slug",request()->input('category'))->pluck('type')) ) > 0 ? 'active'  : '' --}}" tabindex="-1" href="#">{{$categoryType ?? ''}} <span class="caret"><i class="icon-control fa fa-chevron-down"></i></span></a>
                            <ul class="dropdown-menu">
                                @forelse($categoryValue as $category)
                                <li><a tabindex="-1" class="{{ request()->input('category')  ?  (in_array($category["slug"], request()->input('category')) > 0 ? "active" : "" ) : " "}}" href="{{route('frontend.products.index',['category[]' => $category->slug ])}}">{{ $category->name ?? '' }}</a></li>
                                @empty

                                @endforelse
                            </ul>
                        </li>
                        @empty

                        @endforelse
                    </ul>
                </div>
                <a class="nav-menuitems-link hidden xl-inline" href="{{route('why-dnz')}}">
                    <span class="nav-menu-items-label">Product Info</span>
                </a>
                <a class="nav-menuitems-link hidden xl-inline" href="{{ route('dealer-locator') }}">
                    <span class="nav-menu-items-label">Dealer Locator</span>
                </a>
                <!-- <a class="nav-menuitems-link hidden xl-inline" href="{{ route('faqs.index') }}">
                    <span class="nav-menu-items-label">FAQ/Videos</span>
                </a> -->
                <div class="nav-item dropdown">
                    <a class="nav-menuitems-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        FAQ's <span class="caret"><i class="icon-control fa fa-chevron-down"></i></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu"><a tabindex="-1" class="mega-menu {{Request::is('faqs-info') ? 'active' : '' }} " href="{{ route('faq.info') }}">FAQ's/Info</a></li>
                        <li class="dropdown-submenu"><a tabindex="-1" class="mega-menu {{Request::is('faqs') ? 'active' : '' }} " href="{{ route('faqs.index') }}">DNZ Videos</a></li>
                        <li class="dropdown-submenu"><a tabindex="-1" class="mega-menu {{Request::is('index.php') ? 'active' : '' }}" href="{{asset('DNZ-Products-Scope-Mount-Height-Chart/index.php')}}" target="_blank" class="mega-menu">Scope Height Mount Chart</a></li>
                        {{-- <li class="dropdown-submenu"><a tabindex="-1" class="mega-menu {{Request::is('help-center') ? 'active' : '' }}" href="{{route('help-center')}}" class="mega-menu">Help Center/Video</a></li> --}}
                        {{-- <li><a tabindex="-1" href="#"></a></li> --}}
                    </ul>
                </div>
                <a class="nav-menuitems-link hidden xl-inline" href="{{ route('blog') }}">
                    <span class="nav-menu-items-label">Blog</span>
                </a>
                <a class="nav-menuitems-link hidden xl-inline" href="{{ route('contact') }}">
                    <span class="nav-menu-items-label">Contact</span>
                </a>
                <a class="nav-menuitems-link hidden xl-inline" href="{{ asset('catelog/product-catalog-2023.pdf') }}" target="_blank">
                    <span class="nav-menu-items-label">Catalog</span>
                </a>
            </div>
            <div class="right-header-block">
                <div class="searchbar-root searchbar-input">
                    <form action="{{ route('frontend.products.index') }}">
                        <div class="search-box">
                            <input type="text" name="search" class="search-input globle-search" placeholder="Search DNZ Products..." value="{{ Request::get('search') }}">
                            <button class="search-button" type="submit"><i data-feather="search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="searchbar-root searchbar-admin d-flex align-items-center">
                    @if(auth()->guard('web')->check())
                    <div class="dropdown user-dropdown">
                        {{-- <div class="login-user-title text-capitalize">{{auth()->guard('web')->user()->first_name ?? ''}}
                    </div> --}}
                    <div class="user-link iconset dropdown-toggle flex-lg-column" data-toggle="dropdown"><i data-feather="user"></i></div>
                    <div class="dropdown-menu user-menu">
                        @if(auth()->guard('admin')->check())
                            <a class="dropdown-item" href="{{route("admin-home")}}"><i data-feather="user" class="mr-2"></i>Go to Admin Dashboard</a>
                        @else
                            <div class="login-user-title text-capitalize mb-2"><i data-feather="user" class="mr-2"></i> <span>{{auth()->guard('web')->user()->first_name ?? ''}}</span></div>
                        @endif
                        <a class="dropdown-item {{Request::is('orders') ? 'active' : '' }}" href="{{route('orders.index')}}"><i data-feather="shopping-cart" class="mr-2"></i> My Orders</a>
                        <a class="dropdown-item {{Request::is('my-profile') ? 'active' : '' }}" href="{{route('dashboard.myprofile')}}"><i data-feather="user" class="mr-2"></i> My Profile</a>
                        <a class="dropdown-item {{Request::is('address') ? 'active' : '' }}" href="{{route("address.index")}}"><i data-feather="map-pin" class="mr-2"></i> Address</a>
                        <a class="dropdown-item {{Request::is('user-change-password') ? 'active' : '' }}" href="{{url('/user-change-password')}}"><i data-feather="lock" class="mr-2"></i> Change Password</a>
                        {{-- @if(Request::is('dashboard'))
                        <a class="dropdown-item" href="{{ route('home') }}"><i data-feather="globe" class="mr-2"></i> Go to website</a>
                        @elseif( in_array( Request::segment(1), ['home','product']) )
                        <a class="dropdown-item" href="{{ route('user.dashboard') }}"><i data-feather="globe" class="mr-2"></i> Go to dashboard</a>
                        @endif --}}
                        <form action="{{ route('logout') }}" method="post" id="logout">
                            @csrf
                            <a class="dropdown-item" href="javaScript:;" onclick="document.getElementById('logout').submit();"><span class="arrow-icon mr-2"><i data-feather="log-out"></i></span>Log Out</a>
                        </form>
                    </div>
                </div>
                @elseif(auth()->guard('admin')->check())
                <div class="dropdown user-dropdown">
                    <div class="user-link iconset dropdown-toggle flex-lg-column" data-toggle="dropdown"><i data-feather="user"></i></div>
                    <div class="dropdown-menu user-menu">
                        <a class="dropdown-item" href="{{route("admin-home")}}"><i data-feather="user" class="mr-2"></i>Go to Admin Dashboard</a>
                    </div>
                </div>
                @else
                    <div class="user-link iconset flex-lg-column" data-toggle="modal" data-target="#loginModal">
                        <a class="d-flex align-items-center"  data-toggle="tooltip" title="Login"><i data-feather="user"></i></a>
                    </div>
                @endif
                <div class="user-link iconset flex-lg-column">
                    <a href="{{ route('cart.list') }}" class="d-flex align-items-center" data-toggle="tooltip" title="Cart"><i data-feather="shopping-cart"></i>
                        <b class="cart-info">{!! totalQty() == 0 ? '' : '<span class="cart-count">'.totalQty().'</span>' !!}</b></span>
                    </a>
                </div>
            </div>
    </div>

    </nav>
    </div>
</header>