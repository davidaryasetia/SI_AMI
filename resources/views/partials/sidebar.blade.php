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
                            <option value="admin">Admin</option>
                            <option value="audite">Audite</option>
                            <option value="auditor">Auditor</option>
                        </select>
                    </div>
                </li>

                <!-- Menu for Admin -->
                <li class="sidebar-item role-admin">
                    <a class="sidebar-link {{ Request::is('/home') ? 'active' : '' }}" href="/home" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Home</span>
                    </a>
                </li>
                <li class="sidebar-item role-admin">
                    <a class="sidebar-link {{ Request::is('unit_kerja*') ? 'active' : '' }}" href="/unit_kerja" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Daftar Unit Kerja</span>
                    </a>
                </li>
                <li class="sidebar-item role-admin">
                    <a class="sidebar-link {{ Request::is('daftar_audite*') ? 'active' : '' }}" href="/daftar_audite" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Data Auditee</span>
                    </a>
                </li>
                <li class="sidebar-item role-admin">
                    <a class="sidebar-link {{ Request::is('daftar_auditor*') ? 'active' : '' }}" href="/daftar_auditor" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Data Auditor</span>
                    </a>
                </li>
                <li class="sidebar-item role-admin">
                    <a class="sidebar-link {{ Request::is('indikator_unit_kerja*') ? 'active' : '' }}" href="/indikator_unit_kerja" aria-expanded="false">
                        <span>
                            <i class="ti ti-table"></i>
                        </span>
                        <span class="hide-menu">Indikator Kinerja</span>
                    </a>
                </li>
                <li class="sidebar-item role-admin">
                    <a class="sidebar-link {{ Request::is('jadwal_ami*') ? 'active' : '' }}" href="/jadwal_ami" aria-expanded="false">
                        <span>
                            <i class="ti ti-calendar-event"></i>
                        </span>
                        <span class="hide-menu">Periode Audit</span>
                    </a>
                </li>

                <!-- Menu Audite -->
                <li class="sidebar-item role-audite" style="display: none;">
                    <a class="sidebar-link {{ Request::is('/home') ? 'active' : '' }}" href="/home" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Home</span>
                    </a>
                </li>
                <li class="sidebar-item role-audite" style="display: none;">
                    <a class="sidebar-link {{ Request::is('rekap_pengisian*') ? 'active' : '' }}" href="/rekap_pengisian" aria-expanded="false">
                        <span>
                            <i class="ti ti-file"></i>
                        </span>
                        <span class="hide-menu">Pengisian Kinerja</span>
                    </a>
                </li>

                <!-- Menu for Auditor -->
                <li class="sidebar-item role-auditor" style="display: none;">
                    <a class="sidebar-link {{ Request::is('/home') ? 'active' : '' }}" href="/home" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Home</span>
                    </a>
                </li>
                <li class="sidebar-item role-auditor" style="display: none;">
                    <a class="sidebar-link {{ Request::is('penilaian_kinerja*') ? 'active' : '' }}" href="/penilaian_kinerja" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-description"></i>
                        </span>
                        <span class="hide-menu">Evaluasi Kinerja Unit</span>
                    </a>
                </li>
                <li class="sidebar-item role-auditor" style="display: none;">
                    <a class="sidebar-link {{ Request::is('penilaian_kinerja*') ? 'active' : '' }}" href="/penilaian_kinerja" aria-expanded="false">
                        <span>
                            <i class="ti ti-checkup-list"></i>
                        </span>
                        <span class="hide-menu">Rekap & Persetujuan</span>
                    </a>
                </li>
                <li class="sidebar-item role-admin">
                    <a class="sidebar-link {{ Request::is('daftar_user*') ? 'active' : '' }}" href="/daftar_user" aria-expanded="false">
                        <span>
                            <i class="ti ti-users-group"></i>
                        </span>
                        <span class="hide-menu">Daftar User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('/profile*') ? 'active' : '' }}" href="/profile" aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('logout*') ? 'active' : '' }}" href="/" aria-expanded="false">
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
    const roleSelect = document.getElementById('roleSelect');

    roleSelect.addEventListener('change', function() {
        const selectedRole = this.value;

        // Hide all role-based menus
        document.querySelectorAll('.role-admin, .role-audite, .role-auditor').forEach(item => {
            item.style.display = 'none';
        });

        // Show selected role's menus
        if (selectedRole === 'admin') {
            document.querySelectorAll('.role-admin').forEach(item => {
                item.style.display = 'block';
            });
        } else if (selectedRole === 'audite') {
            document.querySelectorAll('.role-audite').forEach(item => {
                item.style.display = 'block';
            });
        } else if (selectedRole === 'auditor') {
            document.querySelectorAll('.role-auditor').forEach(item => {
                item.style.display = 'block';
            });
        }
    });

    // Set default role on page load
    window.onload = function () {
        roleSelect.value = 'admin'; // Default role is admin
        roleSelect.dispatchEvent(new Event('change')); // Trigger the change event to show the admin menu
    };
</script>
