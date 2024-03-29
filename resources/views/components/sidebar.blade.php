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

                @if (auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
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
                @endif

                @if (auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin' || auth()->user()->role == 'staff')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Management</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('language*') ? 'active' : '' }}" href="{{ route('language.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-language"></i>
                            </span>
                            <span class="hide-menu">Language</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('region') ? 'active' : '' }}" href="{{ route('region.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-plane-tilt"></i>
                            </span>
                            <span class="hide-menu">Region</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('category*') ? 'active' : '' }}" href="{{ route('category.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-brand-superhuman"></i>
                            </span>
                            <span class="hide-menu">Category</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('regioncategory*') ? 'active' : '' }}" href="{{ route('regioncategory.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-beach"></i>
                            </span>
                            <span class="hide-menu">Region Category</span>
                        </a>
                    </li>

                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Destination</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('facility*') ? 'active' : '' }}" href="{{ route('facility.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-kayak"></i>
                            </span>
                            <span class="hide-menu">Facility</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('touristsite') ? 'active' : '' }}" href="{{ route('touristsite.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-mountain"></i>
                            </span>
                            <span class="hide-menu">Tourist Site</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('touristsitefacility*') ? 'active' : '' }}" href="{{ route('touristsitefacility.index') }}" aria-expanded="false">
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
                        <a class="sidebar-link {{ Route::is('ticketcategory*') ? 'active' : '' }}" href="{{ route('ticketcategory.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Ticket Category</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('ticket') ? 'active' : '' }}" href="{{ route('ticket.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-ticket"></i>
                            </span>
                            <span class="hide-menu">Ticket</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('coupon*') ? 'active' : '' }}" href="{{ route('coupon.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-discount-2"></i>
                            </span>
                            <span class="hide-menu">Coupon</span>
                        </a>
                    </li>
                @endif

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Checkout</span>
                </li>
                @if (auth()->user()->role != 'tourguide')
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('transaction*') ? 'active' : '' }}" href="{{ route('transaction.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-credit-card-pay"></i>
                            </span>
                            <span class="hide-menu">Transaction</span>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('report*') ? 'active' : '' }}" href="{{ route('report') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-report-analytics"></i>
                        </span>
                        <span class="hide-menu">Report</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>