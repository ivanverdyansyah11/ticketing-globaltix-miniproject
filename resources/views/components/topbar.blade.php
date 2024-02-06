<header class="app-header border-bottom">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="navbar-collapse justify-content-between px-0" id="navbarNav">
            <h4 class="mb-0 fw-semibold">{{ $title }}</h4>
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            <li class="nav-item dropdown">
                <button type="button" class="nav-link nav-icon-hover" id="dropdown-profile" data-bs-toggle="dropdown"
                aria-expanded="false">
                    @if (file_exists(public_path('assets/images/profile/' . auth()->user()->image)))
                        <img src="{{ asset('assets/images/profile/' . $admin->image) }}" alt="Profile Admin" width="35" height="35" class="rounded-circle img-fluid">
                    @else
                        <img src="{{ asset('assets/images/profile/profile-not-found.jpg') }}" alt="Profile Admin" width="35" height="35" class="rounded-circle img-fluid">
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="dropdown-profile">
                <div class="message-body">
                    <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-user fs-6"></i>
                        <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <form class="px-3" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary mt-2 d-block w-100">Logout</button>
                    </form>
                </div>
                </div>
            </li>
            </ul>
        </div>
    </nav>
</header>