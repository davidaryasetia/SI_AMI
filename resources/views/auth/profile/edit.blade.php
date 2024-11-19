@extends('layouts.main')
@section('title', 'Edit Profile User')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <a href="/profile" class="d-flex align-items-center"><i class="ti ti-arrow-left me-3"
                                        style="font-size: 20px; color: black"></i>
                                </a>
                            </div>
                            <div>
                                <span class="card-title fw-semibold me-3">Edit Profile</span>
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

                    <form action="{{ route('profile.update', $user->user_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="mb-4 col-lg-6">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ old('nama', $user->nama) }}"
                                required>
                        </div>

                        <!-- Email -->
                        <div class="mb-4 col-lg-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email"
                                value="{{ old('email', $user->email) }}" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-4 col-lg-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-4 col-lg-6">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>

                        <!-- Upload Gambar -->
                        <div class="mb-4 col-lg-6">
                            <label for="foto_gambar" class="form-label">Upload Gambar</label>
                            <input type="file" class="form-control" name="foto_gambar">
                            @if ($user->foto_gambar)
                                <img src="{{ Auth::user()->foto_gambar ? Storage::disk('s3')->url(Auth::user()->foto_gambar) : asset('images/user-profile.png') }}" alt="Profile Image"
                                    width="100" class="mt-2">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
