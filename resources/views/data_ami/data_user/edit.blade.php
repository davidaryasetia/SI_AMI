@extends('layouts.main')

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <a href="/data_user" class="d-flex align-items-center"><i class="ti ti-arrow-left me-3"
                                        style="font-size: 20px; color: black"></i>
                                </a>
                            </div>
                            <div>
                                <span class="card-title fw-semibold me-3">Edit User Pengguna</span>
                            </div>
                        </div>

                        <div>
                            @if (session('success'))
                                <div class="alert alert-primary" style role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger" style role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>

                        <script>
                            setTimeout(function() {
                                document.querySelectorAll('.alert').forEach(function(alert) {
                                    alert.style.display = "none";
                                });
                            }, 5000);
                        </script>
                    </div>
                    {{-- Content --}}

                    <form id="DataUserForm" action="{{ route('data_user.update', $data_user->user_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-4 col-lg-6">
                                <label for="unit" class="form-label">Nama User</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ $data_user->nama }}"
                                    aria-describedby="emailHelp" placeholder="Masukkan Nama User..." required autofocus>
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4 col-lg-6">
                                <label for="unit" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ $data_user->email }}"
                                    aria-describedby="emailHelp" placeholder="Masukkan Email..." required autofocus>
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-4 col-lg-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Masukkan Password..." value="1234"
                                    disabled>
                                <input type="hidden" name="password" value="1234">
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <!-- Tambahkan Checkbox Reset Password -->
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="resetPasswordCheckbox"
                                        name="reset_password">
                                    <label class="form-check-label" for="resetPasswordCheckbox">
                                        Reset Password
                                    </label>
                                </div>
                            </div>
                            <div class="mb-4 col-lg-6">
                                <label for="status" class="form-label">Pilih Peran</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="is_admin" name="roles[]"
                                        value="admin" {{ $data_user->is_admin ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_admin">Admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="is_audite" name="roles[]"
                                        value="audite" {{ $data_user->is_audite ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_audite">Audite</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="is_auditor" name="roles[]"
                                        value="auditor" {{ $data_user->is_auditor ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_auditor">Auditor</label>
                                </div>
                                @error('roles')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Edit User</button>
                    </form>

                    <script>
                        // Script untuk mengaktifkan field password saat checkbox di-check
                        document.getElementById('resetPasswordCheckbox').addEventListener('change', function() {
                            document.getElementById('password').disabled = !this.checked;
                        });
                    </script>

                    {{-- END-Content --}}
                </div>
            </div>
        </div>
    </div>

    @push('script')
    @endpush
@endsection
