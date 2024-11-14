<!--  Header Start -->
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown d-flex align-items-center" style="backgroun">
                    <a class="nav-link d-flex align-items-center" href="javascript:void(0)"
                        id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->foto_gambar ? Storage::disk('s3')->url(Auth::user()->foto_gambar) : asset('assets/images/profile/user-profile.png') }}"
                            alt="Profile" width="35" height="35" class="rounded-circle">
                        <div class="flex-grow-1 ms-2">
                            <span class="fw-semibold d-block" id="navbar-username" style="font-size: 14px">{{ Auth::user()->nama }}</span>
                        </div>
                        <i class="ti ti-chevron-down ms-2" style="font-size: 16px"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">Profile</p>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="btn btn-outline-primary mx-3 mt-2 d-block"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>

        </div>
    </nav>
</header>
<!--  Header End -->
