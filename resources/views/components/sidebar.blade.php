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
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
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
                    <a class="sidebar-link" href="{{ route('reseller') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Reseller</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Management</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('category') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-list-details"></i>
                        </span>
                        <span class="hide-menu">Category</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('product') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-cheese"></i>
                        </span>
                        <span class="hide-menu">Product</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Other</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="ti ti-award"></i>
                        </span>
                        <span class="hide-menu">Reward</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="ti ti-receipt-refund"></i>
                        </span>
                        <span class="hide-menu">Redeem Reward</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Checkout</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="ti ti-shopping-cart"></i>
                        </span>
                        <span class="hide-menu">Transaction</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
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