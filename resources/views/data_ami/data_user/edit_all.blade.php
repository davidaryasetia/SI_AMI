@extends('layouts.main')
@section('title', 'Edit Semua User')
@section('content')
    <div class="container-fluid">

        <form action="{{ route('data_user.updateAll') }}" method="POST">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center mb-4">
                    <div>
                        <a href="/data_user" class="d-flex align-items-center"><i class="ti ti-arrow-left me-3"
                                style="font-size: 20px; color: black"></i></a>
                    </div>
                    <div>
                        <span class="card-title fw-semibold me-3">Edit User Pengguna</span>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="ti ti-send me-2"></i>Simpan Semua</button>
                    </div>
                </div>
                <!-- Search and Filter -->
                <div class="d-flex align-items-center gap-2">
                    <input type="text" id="searchInput" class="form-control w-50" placeholder="Cari user...">
                    <div class="d-flex ms-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input role-filter" type="checkbox" id="filterAdmin" value="is_admin">
                            <label class="form-check-label" for="filterAdmin">Admin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input role-filter" type="checkbox" id="filterAudite" value="is_audite">
                            <label class="form-check-label" for="filterAudite">Audite</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input role-filter" type="checkbox" id="filterAuditor"
                                value="is_auditor">
                            <label class="form-check-label" for="filterAuditor">Auditor</label>
                        </div>
                    </div>
                </div>
            </div>
            @csrf
            @method('PUT')
            <div class="row" id="userList">
                @foreach ($users as $index => $user)
                    <div class="mb-4 col-lg-12 user-card" data-name="{{ strtolower($user->nama) }}"
                        data-email="{{ strtolower($user->email) }}"
                        data-roles="{{ json_encode([
                            'is_admin' => $user->is_admin,
                            'is_audite' => $user->is_audite,
                            'is_auditor' => $user->is_auditor,
                        ]) }}">
                        <div class="row border p-3 rounded">
                            <input type="hidden" name="users[{{ $index }}][id]" value="{{ $user->user_id }}">

                            <!-- Nama -->
                            <div class="col-lg-3">
                                <label for="nama_{{ $index }}" class="form-label">Nama</label>
                                <input type="text" name="users[{{ $index }}][nama]" class="form-control"
                                    value="{{ old('users.' . $index . '.nama', $user->nama) }}" required>
                            </div>

                            <!-- Email -->
                            <div class="col-lg-3">
                                <label for="email_{{ $index }}" class="form-label">Email</label>
                                <input type="email" name="users[{{ $index }}][email]" class="form-control"
                                    value="{{ old('users.' . $index . '.email', $user->email) }}" required>
                            </div>

                            <!-- Password -->
                            <div class="col-lg-3">
                                <label for="password_{{ $index }}" class="form-label">Password</label>
                                <input type="text" id="password_{{ $index }}" class="form-control"
                                    name="users[{{ $index }}][password]" value="1234" disabled>
                                <div class="form-check mt-2">
                                    <input class="form-check-input reset-password-checkbox" type="checkbox"
                                        id="resetPasswordCheckbox_{{ $index }}" data-index="{{ $index }}"
                                        name="users[{{ $index }}][reset_password]">
                                    <label class="form-check-label" for="resetPasswordCheckbox_{{ $index }}">
                                        Reset Password (Default: 1234)
                                    </label>
                                </div>
                            </div>

                            <!-- Peran -->
                            <div class="col-lg-3">
                                <label for="roles_{{ $index }}" class="form-label">Peran</label>
                                <br>
                                <div class="d-flex flex-row">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="users[{{ $index }}][is_admin]" value="1"
                                            {{ $user->is_admin ? 'checked' : '' }}>
                                        <label>Admin</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="users[{{ $index }}][is_audite]" value="1"
                                            {{ $user->is_audite ? 'checked' : '' }}>
                                        <label>Audite</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="users[{{ $index }}][is_auditor]" value="1"
                                            {{ $user->is_auditor ? 'checked' : '' }}>
                                        <label>Auditor</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Simpan Semua</button>
        </form>
    </div>
@endsection

@push('script')
    <script>
        document.getElementById('searchInput').addEventListener('input', filterUsers);
        document.querySelectorAll('.role-filter').forEach(function(checkbox) {
            checkbox.addEventListener('change', filterUsers);
        });

        function filterUsers() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const selectedRoles = Array.from(document.querySelectorAll('.role-filter:checked'))
                .map(checkbox => checkbox.value);

            const userCards = document.querySelectorAll('.user-card');

            userCards.forEach(function(card) {
                const name = card.getAttribute('data-name');
                const email = card.getAttribute('data-email');
                const roles = JSON.parse(card.getAttribute('data-roles'));

                const matchesNameOrEmail = name.includes(query) || email.includes(query);
                const matchesRole = selectedRoles.length === 0 || selectedRoles.some(role => roles[role]);

                if (matchesNameOrEmail && matchesRole) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
@endpush
