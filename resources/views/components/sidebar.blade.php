<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between justify-content-lg-center">
            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img mt-4">
                <img src="{{ asset('assets/images/brand/brand-logo.svg') }}" class="img-fluid" width="56" alt="Brand Logo">
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">User</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('admin*') ? 'active' : '' }}" href="{{ route('admin') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-cog"></i>
                        </span>
                        <span class="hide-menu">Admin</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('staff*') ? 'active' : '' }}" href="{{ route('staff') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-bolt"></i>
                        </span>
                        <span class="hide-menu">Staff</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('tourguide*') ? 'active' : '' }}" href="{{ route('tourguide') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-shield"></i>
                        </span>
                        <span class="hide-menu">Tour Guide</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('customer*') ? 'active' : '' }}" href="{{ route('customer') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Customer</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Management</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('region') ? 'active' : '' }}" href="{{ route('region') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-flag"></i>
                        </span>
                        <span class="hide-menu">Region</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('category*') ? 'active' : '' }}" href="{{ route('category') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-brand-superhuman"></i>
                        </span>
                        <span class="hide-menu">Category</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('region_category*') ? 'active' : '' }}" href="{{ route('region_category') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-flag-pin"></i>
                        </span>
                        <span class="hide-menu">Region Category</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Destination</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('facility*') ? 'active' : '' }}" href="{{ route('facility') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-kayak"></i>
                        </span>
                        <span class="hide-menu">Facility</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('toursite') ? 'active' : '' }}" href="{{ route('toursite') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-mountain"></i>
                        </span>
                        <span class="hide-menu">Tourist Site</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('toursitefacility*') ? 'active' : '' }}" href="{{ route('toursitefacility') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-map-discount"></i>
                        </span>
                        <span class="hide-menu">Tourist Site Facility</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Preparation</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('ticketcategory*') ? 'active' : '' }}" href="{{ route('ticketcategory') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Ticket Category</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('ticket') ? 'active' : '' }}" href="{{ route('ticket') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-ticket"></i>
                        </span>
                        <span class="hide-menu">Ticket</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('coupon*') ? 'active' : '' }}" href="{{ route('coupon') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-discount-2"></i>
                        </span>
                        <span class="hide-menu">Coupon</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>