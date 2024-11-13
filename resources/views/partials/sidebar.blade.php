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
                            @if (session('roles'))
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

                <!-------------------------------- Menu for Admin ------------------------------->
                @if (session('active_role') === 'admin')
                    <li class="sidebar-item role-admin">
                        <a class="sidebar-link {{ Request::is('/home') ? 'active' : '' }}" href="/home"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Home</span>
                        </a>
                    </li>
                    <li class="sidebar-item role-admin">
                        <a class="sidebar-link {{ Request::is('data_unit*') ? 'active' : '' }}" href="/data_unit"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Data Unit</span>
                        </a>
                    </li>
                    <li class="sidebar-item role-admin">
                        <a class="sidebar-link {{ Request::is('data_user*') ? 'active' : '' }}" href="/data_user"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-users-group"></i>
                            </span>
                            <span class="hide-menu">Data User</span>
                        </a>
                    </li>
                    <li class="sidebar-item role-admin">
                        <a class="sidebar-link {{ Request::is('ploting_ami*') ? 'active' : '' }}" href="/ploting_ami"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Ploating AMI</span>
                        </a>
                    </li>

                    <li class="sidebar-item role-admin">
                        <a class="sidebar-link {{ Request::is('data_indikator*') ? 'active' : '' }}"
                            href="/data_indikator" aria-expanded="false">
                            <span>
                                <i class="ti ti-table"></i>
                            </span>
                            <span class="hide-menu">Data Indikator</span>
                        </a>
                    </li>
                    <li class="sidebar-item role-admin">
                        <a class="sidebar-link {{ Request::is('periode_audit*') }}" href="/periode_audit"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-calendar-event"></i>
                            </span>
                            <span class="hide-menu">Periode Audit</span>
                        </a>
                    </li>
                    <li class="sidebar-item role-admin">
                        <a class="sidebar-link {{ Request::is('progres_audit*') }}" href="/progres_audit"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-clipboard-data"></i>
                            </span>
                            <span class="hide-menu">Progress Audit</span>
                        </a>
                    </li>
                    <li class="sidebar-item role-admin">
                        <a class="sidebar-link {{ Request::is('rekap_audit*') }}" href="/rekap_audit"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-chart-dots"></i>
                            </span>
                            <span class="hide-menu">Rekap Audit</span>
                        </a>
                    </li>
                @endif



                <!----------------------------------------Menu Audite-------------------------------------------------------->
                @if (session('active_role') === 'audite')
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
                                <i class="ti ti-file-description"></i>
                            </span>
                            <span class="hide-menu">Pengisian Kinerja</span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-item role-audite">
                        <a class="sidebar-link {{ Request::is('rekap_capaian*') ? 'active' : '' }}"
                            href="/rekap_capaian" aria-expanded="false">
                            <span>
                                <i class="ti ti-file-analytics"></i>
                            </span>
                            <span class="hide-menu">Rekap Capaian</span>
                        </a>
                    </li> --}}
                    <li class="sidebar-item role-audite">
                        <a class="sidebar-link {{ Request::is('persetujuan*') ? 'active' : '' }}" href="/persetujuan"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-checkup-list"></i>
                            </span>
                            <span class="hide-menu">Persetujuan</span>
                        </a>
                    </li>
                @endif

                <!-----------------------------------------Menu for Auditor----------------------------->
                @if (session('active_role') === 'auditor')
                    <li class="sidebar-item role-auditor">
                        <a class="sidebar-link {{ Request::is('/home/auditor*') ? 'active' : '' }}"
                            href="/home/auditor " aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Home</span>
                        </a>
                    </li>
                    <li class="sidebar-item role-auditor">
                        <a class="sidebar-link {{ Request::is('pengisian_kinerja_auditor*') ? 'active' : '' }}"
                            href="/pengisian_kinerja_auditor" aria-expanded="false">
                            <span>
                                <i class="ti ti-file-description"></i>
                            </span>
                            <span class="hide-menu">Pengisian Kinerja</span>
                        </a>
                    </li>
                    <li class="sidebar-item role-auditor">
                        <a class="sidebar-link {{ Request::is('rekap_persetujuan_auditor*') ? 'active' : '' }}"
                            href="/rekap_persetujuan_auditor" aria-expanded="false">
                            <span>
                                <i class="ti ti-checkup-list"></i>
                            </span>
                            <span class="hide-menu">Rekap & Persetujuan</span>
                        </a>
                    </li>
                @endif

                {{-- -------------------------------------------------------------------------------------- --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('profile*') ? 'active' : '' }}" href="/profile"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
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
        const roleSelect = document.getElementById('roleSelect');

        roleSelect.addEventListener('change', function() {
            const selectedRole = this.value;

            // Kirim AJAX request ke server untuk mengubah session role
            fetch('{{ route('switch.role') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        role: selectedRole
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Redirect ke halaman sesuai dengan role yang dipilih
                        if (selectedRole === 'admin') {
                            window.location.href = '/home';
                        } else if (selectedRole === 'audite') {
                            window.location.href = '/home/audite';
                        } else if (selectedRole === 'auditor') {
                            window.location.href = '/home/auditor';
                        }
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    };
</script>
