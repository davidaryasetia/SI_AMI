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
                                <span class="card-title fw-semibold me-3">Tambah User Pengguna</span>
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

                    <form id="DataUserForm" action="{{ route('data_user.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-4 col-lg-6">
                                <label for="unit" class="form-label">Nama User</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" aria-describedby="emailHelp"
                                    placeholder="Masukkan Nama User........" required autofocus>
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4 col-lg-6">
                                <label for="unit" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" aria-describedby="emailHelp"
                                    placeholder="Masukkan Email........" required autofocus>
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-4 col-lg-6">
                                <label for="unit" class="form-label">NIP</label>
                                <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
                                    name="nip" aria-describedby="emailHelp" placeholder="Masukkan NIP........" required
                                    autofocus>
                                @error('nip')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4 col-lg-6">
                                <label for="status_admin" class="form-label">Pilih Status Admin</label>
                                <select class="form-select" id="status_admin" name="status_admin">
                                    <option value="">Pilih Status Admin....</option>
                                    <option value=1>Admin</option>
                                    <option value=0>Bukan</option>
                                </select>
                                @error('status_admin')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-4 col-lg-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" aria-describedby="emailHelp"
                                    placeholder="Masukkan Password........" required autofocus>
                                <span id="password_error" style="color: red; display: none">Password Tidak sama</span>
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4 col-lg-6">
                                <label for="unit" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="confirm_password" name="confirm_password" aria-describedby="emailHelp"
                                    placeholder="Masukkan Konfirmasi Password........" required autofocus>
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">Tambah User</button>
                    </form>

                    {{-- END-Content --}}
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            function validatePasswords() {
                var password = document.getElementById('password').value;
                var confirmPassword = document.getElementById('confirm_password').value;
                var passwordError = document.getElementById('password_error');

                if (password !== confirmPassword) {
                    passwordError.style.display = 'block';
                    document.getElementById('password').style.borderColor = 'red';
                    document.getElementById('confirm_password').style.borderColor = 'red';
                } else {
                    passwordError.style.display = 'none';
                    document.getElementById('password').style.borderColor = '';
                    document.getElementById('confirm_password').style.borderColor = '';
                }
            }

            document.getElementById('DataUserForm').addEventListener('submit', function(event) {
                var password = document.getElementById('password').value;
                var confirmPassword = document.getElementById('confirm_password').value;
                var passwordError = document.getElementById('password_error');

                if (password !== confirmPassword) {
                    passwordError.style.display = 'block';
                    document.getElementById('password').style.borderColor = 'red';
                    document.getElementById('confirm_password').style.borderColor = 'red';
                    event.preventDefault();
                } else {
                    passwordError.style.display = 'none';
                    document.getElementById('password').style.borderColor = '';
                    document.getElementById('confirm_password').style.borderColor = '';
                };
            });

            document.getElementById('password').addEventListener('input', validatePasswords);
            document.getElementById('confirm_password').addEventListener('input', validatePasswords);
        </script>
    @endpush
@endsection
