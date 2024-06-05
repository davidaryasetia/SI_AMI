@extends('layouts.main')

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <a href="/unit_kerja" class="d-flex align-items-center"><i class="ti ti-arrow-left me-3"
                                        style="font-size: 20px; color: black"></i>
                                </a>
                            </div>
                            <div>
                                <span class="card-title fw-semibold me-3">Edit Unit Kerja</span>
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

                    <form action="/unit_kerja/{{ $unit['nama_unit'] }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="mb-4 col-lg-6">
                                <label for="unit" class="form-label">Nama Unit</label>
                                <input type="text" class="form-control @error('nama_unit') is-invalid @enderror"
                                    id="nama_unit" name="nama_unit" aria-describedby="emailHelp"
                                    placeholder="Masukkan Nama Unit........" required autofocus
                                    value="{{ $unit['nama_unit'] }}">
                                @error('nama_unit')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4 col-lg-6">
                                <label for="unit" class="form-label">Audite</label>
                                <input type="text" class="form-control @error('nama_unit') is-invalid @enderror"
                                    id="nama_unit" name="nama_unit" aria-describedby="emailHelp"
                                    placeholder="Masukkan Nama Unit........" required autofocus
                                    value="{{ $data_unit->audite }}" disabled>
                              
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-4 col-lg-6">
                                <label for="unit" class="form-label">Auditor 1</label>
                                <input type="text" class="form-control @error('nama_unit') is-invalid @enderror"
                                    id="nama_unit" name="nama_unit" aria-describedby="emailHelp"
                                    placeholder="Masukkan Nama Unit........" required autofocus
                                    value="{{ $data_unit->auditor1 }}" disabled>
                               
                            </div>
                            <div class="mb-4 col-lg-6">
                                <label for="unit" class="form-label">Auditor 2</label>
                                <input type="text" class="form-control @error('nama_unit') is-invalid @enderror"
                                    id="nama_unit" name="nama_unit" aria-describedby="emailHelp"
                                    placeholder="Masukkan Nama Unit........" required autofocus
                                    value="{{ $data_unit->auditor2 }}" disabled>
                              
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Data Unit Kerja</button>
                    </form>
                    {{-- END-Content --}}
                </div>
            </div>
        </div>
    </div>
@endsection
