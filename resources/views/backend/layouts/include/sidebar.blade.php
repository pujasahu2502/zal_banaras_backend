<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <a href="{{ route('admin-home') }}"><img src="{{ asset('assets/img/new-logo.png') }}" height="auto" width="auto"></a>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-home') }}">
                <i class="c-sidebar-nav-icon" data-feather="airplay"></i>
                <span style="margin-left:10px">Dashboard</span>
            </a>
        </li>

        {{-- <li class="nav-group" aria-expanded="false"><a class="nav-link nav-group-toggle" href="#">
            <i class="c-sidebar-nav-icon" data-feather="users"></i> <span style="margin-left:10px">Test Menu</span></a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link active" href="base/accordion.html"><span class="nav-icon"></span> Accordion</a></li>
                <li class="nav-item"><a class="nav-link" href="base/breadcrumb.html"><span class="nav-icon"></span> Breadcrumb</a></li>
                <li class="nav-item"><a class="nav-link" href="base/cards.html"><span class="nav-icon"></span> Cards</a></li>
                <li class="nav-item"><a class="nav-link" href="base/carousel.html"><span class="nav-icon"></span> Carousel</a></li>
            </ul>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ route('order.index') }}">
                <i class="c-sidebar-nav-icon" data-feather="book-open"></i>
                <span style="margin-left:10px">Order</span>
            </a>
        </li>

        <li class="nav-group" aria-expanded="false"><a class="nav-link nav-group-toggle" href="#">
            <i class="c-sidebar-nav-icon" data-feather="bar-chart-2"></i> <span style="margin-left:10px">Report Management</span></a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'customer-report') ? 'active' : '' }}" href="{{ route('customer.report') }}">
                    <i class="c-sidebar-nav-icon" data-feather="bar-chart"></i> <span style="margin-left:10px">Customer Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'order-report') ? 'active' : '' }}" href="{{ route('order.report') }}">
                    <i class="c-sidebar-nav-icon" data-feather="pie-chart"></i> <span style="margin-left:10px">Order Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'analytics') ? 'active' : '' }}" href="{{ route('analytics') }}">
                    <i class="c-sidebar-nav-icon" data-feather="bar-chart-2"></i> <span style="margin-left:10px">Analytics</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-group" aria-expanded="false"><a class="nav-link nav-group-toggle" href="#">
            <i class="c-sidebar-nav-icon" data-feather="user"></i> <span style="margin-left:10px">User Management</span></a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'customer') ? 'active' : '' }}" href="{{ route('customer.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="users"></i> <span style="margin-left:10px">Customer</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'dealer') ? 'active' : '' }}" href="{{ route('dealer.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="user-check"></i> <span style="margin-left:10px">Dealer</span>
                    </a>
                </li>
            </ul>
        </li>
        
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.index') }}">
                <i class="c-sidebar-nav-icon" data-feather="users"></i>
                <span style="margin-left:10px">Customer</span>
            </a>
        </li> --}}

        <li class="nav-group {{ (Request::segment(2) == 'variant') || (Request::segment(2) == 'product') ? 'show' : '' }}" aria-expanded="{{ (Request::segment(2) == 'variant') || (Request::segment(2) == 'product') ? 'false' : '' }}"><a class="nav-link nav-group-toggle" href="#">
            <i class="c-sidebar-nav-icon" data-feather="grid"></i> <span style="margin-left:10px">Product Management</span></a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'product') ? 'active' : '' }}" href="{{ route('product.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="shopping-cart"></i> <span style="margin-left:10px">Product</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'category') ? 'active' : '' }}" href="{{ route('category.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="briefcase"></i> <span style="margin-left:10px">Category</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'attribute') ? 'active' : '' }} {{ (Request::segment(2) == 'variant') ? 'active' : '' }}" href="{{ route('attribute.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="shopping-bag"></i> <span style="margin-left:10px">Attribute</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'review') ? 'active' : '' }}" href="{{ route('review.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="star"></i> <span style="margin-left:10px">Review</span>
                    </a>
                </li>
            </ul>
        </li>
        
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="c-sidebar-nav-icon" data-feather="briefcase"></i>
                <span style="margin-left:10px">Category</span>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Request::segment(2) == 'variant') ? 'active' : '' }}" href="{{ route('attribute.index') }}">
                <i class="c-sidebar-nav-icon" data-feather="shopping-bag"></i>
                <span style="margin-left:10px">Attribute</span>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Request::segment(2) == 'product') ? 'active' : '' }}" href="{{ route('product.index') }}">
                <i class="c-sidebar-nav-icon" data-feather="shopping-cart"></i>
                <span style="margin-left:10px">Product</span>
            </a>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ route('coupon.index') }}">
                <i class="c-sidebar-nav-icon" data-feather="gift"></i>
                <span style="margin-left:10px">Coupon</span>
            </a>
        </li>

        {{-- <li class="nav-group" aria-expanded="false"><a class="nav-link nav-group-toggle" href="#">
            <i class="c-sidebar-nav-icon" data-feather="gift"></i> <span style="margin-left:10px">Tax, Shipping & Coupon</span></a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'tax') ? 'active' : '' }}" href="{{ route('tax.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="percent"></i> <span style="margin-left:10px">Tax</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'shipping') ? 'active' : '' }}" href="{{ route('shipping.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="truck"></i> <span style="margin-left:10px">Shipping</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'coupon') ? 'active' : '' }}" href="{{ route('coupon.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="gift"></i> <span style="margin-left:10px">Coupon</span>
                    </a>
                </li>
            </ul>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ route('tax.index') }}">
                <i class="c-sidebar-nav-icon" data-feather="percent"></i>
                <span style="margin-left:10px">Tax</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('shipping.index') }}">
                <i class="c-sidebar-nav-icon" data-feather="truck"></i>
                <span style="margin-left:10px">Shipping</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('review.index') }}">
                <i class="c-sidebar-nav-icon" data-feather="star"></i>
                <span style="margin-left:10px">Review</span>
            </a>
        </li> --}}

        <li class="nav-group" aria-expanded="false"><a class="nav-link nav-group-toggle" href="#">
            <i class="c-sidebar-nav-icon" data-feather="edit-3"></i> <span style="margin-left:10px">Content Management</span></a>
            <ul class="nav-group-items">
                {{-- <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'blogs') ? 'active' : '' }}" href="{{ route('product-info.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="book"></i> <span style="margin-left:10px">Product Info</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'blogs') ? 'active' : '' }}" href="{{ route('blogs.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="edit"></i> <span style="margin-left:10px">Blog</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'page') ? 'active' : '' }}" href="{{ route('page.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="book"></i> <span style="margin-left:10px">Page</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ (Request::segment(2) == 'faq') ? 'active' : '' }}" href="{{ route('faq.index') }}">
                    <i class="c-sidebar-nav-icon" data-feather="help-circle"></i> <span style="margin-left:10px">FAQ</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('blogs.index') }}">
                <i class="c-sidebar-nav-icon" data-feather="edit-3"></i>
                <span style="margin-left:10px">Blog</span>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('pages') }}">
                <i class="c-sidebar-nav-icon" data-feather="book"></i>
                <span style="margin-left:10px">Page</span>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('faq.index') }}">
                <i class="c-sidebar-nav-icon" data-feather="help-circle"></i>
                <span style="margin-left:10px">FAQ</span>
            </a>
        </li> --}}
        
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('dealer.index') }}">
                <i class="c-sidebar-nav-icon" data-feather="user-check"></i>
                <span style="margin-left:10px">Dealer</span>
            </a>
        </li> --}}
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('testimonial.index') }}">
                <i class="c-sidebar-nav-icon fe-icon" data-feather="message-circle"></i>
                <span style="margin-left:10px">Testimonial</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('conatct.subscriber') }}">
                <i class="c-sidebar-nav-icon fe-icon" data-feather="shield"></i>
                <span style="margin-left:10px">Newslatter</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('contact-us.index') }}">
                <i class="c-sidebar-nav-icon fe-icon" data-feather="phone"></i>
                <span style="margin-left:10px">Contact Us</span>
            </a>
        </li>

    </ul>
</div>