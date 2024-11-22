@extends('layouts.main')
@section('title', 'Tambah User')

@section('content')
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
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" aria-describedby="emailHelp"
                                    placeholder="Masukkan Password........" value="1234" required autofocus disabled>
                                <input type="hidden" name="password" value="1234">
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4 col-lg-6">
                                <label for="status" class="form-label">Pilih Peran</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="is_admin" name="roles[]"
                                        value="admin">
                                    <label class="form-check-label" for="is_admin">Admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="is_audite" name="roles[]"
                                        value="audite">
                                    <label class="form-check-label" for="is_audite">Audite</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="is_auditor" name="roles[]"
                                        value="auditor">
                                    <label class="form-check-label" for="is_auditor">Auditor</label>
                                </div>
                                @error('roles')
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
    @endpush
@endsection
