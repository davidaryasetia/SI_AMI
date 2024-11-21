<nav class="navbar navbar-expand-lg text-white d-flex justify-content-between pl-4 pr-4"
    style="background-color: #0B668B;">
    <div class="container-fluid">
        <!-- Logo dan Toggle Button -->
        <div class="d-flex align-items-center">

            <a class="navbar-brand d-flex align-items-center text-white ms-2" href="#">
                <img src="{{ asset('assets/images/logos/white-logo.png') }}" alt="Logo P4MP" class="img-fluid"
                    style="max-height: 40px; margin-right: 10px;">
                <div class="d-flex flex-column ms-2">
                    <span style="font-weight: 700; font-size:18px">AMI - PENS</span>
                    <small>Audit Mutu Internal</small>
                </div>

            </a>

            <button id="sidebarToggle" class="btn btn-outline-light ms-1">
                <i class="ti ti-menu-2"></i>
            </button>
        </div>

        <div class="d-flex align-items-center" style="margin-right: 20px">
            <!-- Dropdown Role -->
            <div class="dropdown d-flex align-items-center me-3">
                <label for="roleSelect" class="me-2" style="font-weight: bold; color: white;">Pilih Peran:</label>
                <select id="roleSelect" class="form-select dropdown-enhanced">
                    @if (session('roles'))
                        @foreach (session('roles') as $role)
                            <option value="{{ $role }}" {{ session('active_role') == $role ? 'selected' : '' }}>
                                {{ ucfirst($role) }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>



            <!-- User Profile Dropdown -->
            <div class="dropdown d-flex align-items-center">
                <!-- Profile Picture -->
                <img src="{{ Auth::user()->foto_gambar ? Storage::disk('s3')->url(Auth::user()->foto_gambar) : asset('assets/images/profile/user-profile.png') }}"
                    alt="Profile" class="rounded-circle me-2" style="width: 40px; height: 40px; cursor: pointer;"
                    data-bs-toggle="dropdown">
                <!-- User Name -->
                <span class="text-white fw-bold" style="cursor: pointer;" data-bs-toggle="dropdown">
                    {{ Auth::user()->nama }}
                </span>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 p-3">
                    <li class="text-center">
                        <img src="{{ Auth::user()->foto_gambar ? Storage::disk('s3')->url(Auth::user()->foto_gambar) : asset('assets/images/profile/user-profile.png') }}"
                            alt="Profile" class="rounded-circle mb-2" style="width: 40px; height: 49px">
                        <p class="fw-semibold mb-1">{{ Auth::user()->nama }}</p>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item d-flex align-items-center {{ Request::is('profile*') ? 'active' : '' }}"
                            href="/profile">
                            <i class="ti ti-user me-2"></i> Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                        <a class="dropdown-item text-danger d-flex align-items-center" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti ti-power me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</nav>
