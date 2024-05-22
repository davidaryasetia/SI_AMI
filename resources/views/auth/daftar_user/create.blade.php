@extends('layouts.main')

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <a href="/daftar_user" class="d-flex align-items-center"><i class="ti ti-arrow-left me-3"
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

                    <form action="{{ route('unit_kerja.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4 col-lg-6">
                            <label for="unit" class="form-label">Nama Unit</label>
                            <input type="text" class="form-control @error('nama_unit') is-invalid @enderror" id="nama_unit" name="nama_unit"
                                aria-describedby="emailHelp" placeholder="Masukkan Nama Unit........" required autofocus>
                            @error('nama_unit')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Unit</button>
                    </form>
                    {{-- END-Content --}}
                </div>
            </div>
        </div>
    </div>
@endsection
