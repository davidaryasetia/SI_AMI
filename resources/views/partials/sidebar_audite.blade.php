<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/home" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/long-logo.png') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="" style="margin-top: 32px   ">
            <ul id="sidebarnav">

                <!-- Dropdown Select Role -->
                <li class="sidebar-item" style="margin-bottom: 24px">
                    <div class="dropdown">
                        <label for="roleSelect" style="margin-bottom: 8px">Role:</label>
                        <select id="roleSelect" class="form-select">
                            @if (session('roles')) {{-- Mengecek apakah roles ada di session --}}
                                @foreach (session('roles') as $role)
                                    <option value="{{ $role }}"
                                        {{ session('active_role') == $role ? 'selected' : '' }}>
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </li>


                <!----------------------------------------Menu Audite-------------------------------------------------------->
                <li class="sidebar-item role-audite">
                    <a class="sidebar-link {{ Request::is('/home/audite*') ? 'active' : '' }}" href="/home/audite"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Home</span>
                    </a>
                </li>
                <li class="sidebar-item role-audite">
                    <a class="sidebar-link {{ Request::is('pengisian_kinerja*') ? 'active' : '' }}"
                        href="/pengisian_kinerja" aria-expanded="false">
                        <span>
                            <i class="ti ti-file"></i>
                        </span>
                        <span class="hide-menu">Pengisian Kinerja</span>
                    </a>
                </li>
                <li class="sidebar-item role-audite">
                    <a class="sidebar-link {{ Request::is('rekap_capaian*') ? 'active' : '' }}"
                        href="/rekap_capaian" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-analytics"></i>
                        </span>
                        <span class="hide-menu">Rekap Capaian</span>
                    </a>
                </li>
                <li class="sidebar-item role-audite">
                    <a class="sidebar-link {{ Request::is('persetujuan*') ? 'active' : '' }}"
                        href="/persetujuan" aria-expanded="false">
                        <span>
                            <i class="ti ti-checkup-list"></i>
                        </span>
                        <span class="hide-menu">Persetujuan</span>
                    </a>
                </li>
                <li class="sidebar-item role-audite">
                    <a class="sidebar-link {{ Request::is('profile_audite*') ? 'active' : '' }}"
                        href="/profile_audite" aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Profile Audite</span>
                    </a>
                </li>

                {{-- -------------------------------------------------------------------------------------- --}}
                
                <li class="sidebar-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                    <a class="sidebar-link" href="#" aria-expanded="false"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span>
                            <i class="ti ti-logout"></i>
                        </span>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- End Sidebar navigation-->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->

<!-- Script to dynamically change menu based on role -->
<script>
    window.onload = function() {
        roleSelect.addEventListener('change', function() {
            const selectedRole = this.value;

            // Hide all role-based menus
            document.querySelectorAll('.role-admin, .role-audite, .role-auditor').forEach(item => {
                item.style.display = 'none';
            });

            // Show selected role's menus and redirect
            if (selectedRole === 'admin') {
                document.querySelectorAll('.role-admin').forEach(item => {
                    item.style.display = 'block';
                });
                window.location.href = '/home';
            } else if (selectedRole === 'audite') {
                document.querySelectorAll('.role-audite').forEach(item => {
                    item.style.display = 'block';
                });
                window.location.href = '/home/audite';
            } else if (selectedRole === 'auditor') {
                document.querySelectorAll('.role-auditor').forEach(item => {
                    item.style.display = 'block';
                });
                window.location.href = '/home/auditor';
            }
        });
    };
</script>
