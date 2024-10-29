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
                                    <option value="{{ $role }}" {{ session('active_role') == $role ? 'selected' : '' }}>
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
    function showRoleMenus(role) {
        // Sembunyikan semua menu role
        document.querySelectorAll('.role-admin, .role-audite, .role-auditor').forEach(item => {
            item.style.display = 'none';
        });

        // Tampilkan menu sesuai dengan role yang dipilih
        if (role === 'admin') {
            document.querySelectorAll('.role-admin').forEach(item => {
                item.style.display = 'block';
            });
        } else if (role === 'audite') {
            document.querySelectorAll('.role-audite').forEach(item => {
                item.style.display = 'block';
            });
        } else if (role === 'auditor') {
            document.querySelectorAll('.role-auditor').forEach(item => {
                item.style.display = 'block';
            });
        }
    }

    window.onload = function() {
        const roleSelect = document.getElementById('roleSelect');
        const currentRole = roleSelect.value;

        // Tampilkan menu sesuai dengan role aktif
        showRoleMenus(currentRole);

        roleSelect.addEventListener('change', function() {
            const selectedRole = this.value;

            // Kirim AJAX request ke server untuk mengubah session role
            fetch('{{ route('switch.role') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ role: selectedRole })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Tampilkan menu sesuai dengan role yang dipilih
                    showRoleMenus(selectedRole);

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
