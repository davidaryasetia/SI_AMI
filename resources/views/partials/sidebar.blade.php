<div id="sidebar" class="d-flex flex-column">
    <div class="text-center" style="height: 60px;">
        <!-- Div kosong untuk menggantikan gambar -->
    </div>
    <ul class="nav flex-column">

        {{-- ------------------------- Admin------------------------------------------- --}}
        @if (session('active_role') === 'admin')
            <li class="nav-item role-admin">
                <a class="nav-link d-flex align-items-center {{ request()->is('home') ? 'active' : '' }}" href="/home"
                    data-title="Home">
                    <i class="ti ti-layout-dashboard me-2"></i>
                    <span class="menu-text">Home</span>
                </a>
            </li>
            <li class="nav-item role-admin">
                <a class="nav-link d-flex align-items-center {{ request()->is('periode_audit') ? 'active' : '' }}"
                    href="/periode_audit" data-title="Periode Audit">
                    <i class="ti ti-calendar-event me-2"></i>
                    <span class="menu-text">Periode Audit</span>
                </a>
            </li>
            <li class="nav-item role-admin">
                <a class="nav-link d-flex align-items-center {{ Request::is('data_unit*') ? 'active' : '' }}"
                    href="/data_unit">
                    <i class="ti ti-database me-2"></i>
                    <span class="menu-text">Data Unit</span>
                </a>
            </li>
            <li class="nav-item role-admin">
                <a class="nav-link d-flex align-items-center {{ Request::is('data_user*') ? 'active' : '' }}"
                    href="/data_user">
                    <i class="ti ti-user me-2"></i>
                    <span class="menu-text">Data User</span>
                </a>
            </li>
            <li class="nav-item role-admin">
                <a class="nav-link d-flex align-items-center {{ Request::is('data_indikator*') ? 'active' : '' }}"
                    href="/data_indikator">
                    <i class="ti ti-table me-2"></i>
                    <span class="menu-text">Data Indikator</span>
                </a>
            </li>
            <li class="nav-item role-admin">
                <a class="nav-link d-flex align-items-center  {{ Request::is('ploting_ami*') ? 'active' : '' }}"
                    href="/ploting_ami">
                    <i class="ti ti-clipboard me-2"></i>
                    <span class="menu-text">Ploating AMI</span>
                </a>
            </li>
            <li class="nav-item role-admin">
                <a class="nav-link d-flex align-items-center {{ Request::is('progres_audit*') ? 'active' : '' }} "
                    href="/progres_audit">
                    <i class="ti ti-clipboard-data me-2"></i>
                    <span class="menu-text">Progress Audit</span>
                </a>
            </li>
            <li class="nav-item role-admin">
                <a class="nav-link d-flex align-items-center  {{ Request::is('rekap_audit*') ? 'active' : '' }}"
                    href="/rekap_audit">
                    <i class="ti ti-chart-dots me-2"></i>
                    <span class="menu-text">Rekap Audit</span>
                </a>
            </li>
        @endif
        {{-- ------------------------- End Admin---------------------------------------------------------- --}}


        {{-- ------------------------- Audite------------------------------------------------------------- --}}
        @if (session('active_role') === 'audite')
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ url()->current() === url('/home/audite') ? 'active' : '' }}"
                    href="/home/audite" data-title="Home">
                    <i class="ti ti-layout-dashboard me-2"></i>
                    <span class="menu-text">Home</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ Request::is('pengisian_kinerja*') ? 'active' : '' }}"
                    href="/pengisian_kinerja" data-title="Home">
                    <i class="ti ti-file-description me-2"></i>
                    <span class="menu-text">Pengisian Kinerja</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ Request::is('persetujuan*') ? 'active' : '' }}"
                    href="/persetujuan" data-title="Home">
                    <i class="ti ti-file-description me-2"></i>
                    <span class="menu-text">Persetujuan</span>
                </a>
            </li>
        @endif
        {{-- ------------------------- End Audite-------------------------------------------------------------- --}}

        {{-- ------------------------- Auditor------------------------------------------------------------- --}}
        @if (session('active_role') === 'auditor')
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ url()->current() === url('/home/auditor') ? 'active' : '' }}"
                    href="/home/auditor" data-title="Home">
                    <i class="ti ti-layout-dashboard me-2"></i>
                    <span class="menu-text">Home</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ Request::is('pengisian_kinerja_auditor*') ? 'active' : '' }}"
                    href="/pengisian_kinerja_auditor" data-title="Home">
                    <i class="ti ti-file-description me-2"></i>
                    <span class="menu-text">Pengisian Kinerja Auditor</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ Request::is('rekap_persetujuan_auditor*') ? 'active' : '' }}"
                    href="/rekap_persetujuan_auditor" data-title="Home">
                    <i class="ti ti-file-description me-2"></i>
                    <span class="menu-text">Rekap & Persetujuan</span>
                </a>
            </li>
        @endif
        {{-- ------------------------- End Audite-------------------------------------------------------------- --}}




        {{-- ---------------------------- Root Menu ---------------------- --}}
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center {{ Request::is('profile*') ? 'active' : '' }}"
                href="/profile">
                <i class="ti ti-user me-2"></i>
                <span class="menu-text">Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
            <a class="nav-link d-flex " href="#" aria-expanded="false"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ti ti-logout me-2"></i>
                <span class="hide-menu">Logout</span>
            </a>
        </li>
    </ul>
</div>

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
