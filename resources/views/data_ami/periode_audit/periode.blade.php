@extends('layouts.main')
@push('css')
    <style>
        table td,
        table th {
            vertical-align: middle;
        }

        .btn-sm {
            padding: 4px 10px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-control {
                width: 100%;
            }

            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
@endpush

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title fw-semibold">Pengaturan Periode Audit</h4>


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

                {{-- Form Input Periode --}}
                <form action="{{ route('periode_audit.store') }}" method="POST" class="col-lg-6">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="namaPeriode" class="form-label">Nama Periode AMI</label>
                        <input type="text" class="form-control" name="nama_periode_ami" id="namaPeriode"
                            placeholder="Nama Periode AMI" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_pembukaan_ami" class="form-label">Mulai</label>
                        <input type="date" class="form-control" name="tanggal_pembukaan_ami" id="tanggal_pembukaan_ami"
                            required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_penutupan_ami" class="form-label">Selesai</label>
                        <input type="date" class="form-control" name="tanggal_penutupan_ami" id="tanggal_penutupan_ami"
                            required>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Tambah Periode</button>
                    </div>
                </form>


                {{-- Tabel Periode AMI --}}
                <div class="table-responsive mt-4">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Periode AMI</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $nomor = 1; @endphp
                            @foreach ($data_periode as $periode)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $periode->nama_periode_ami }}</td>
                                    <td>{{ \Carbon\Carbon::parse($periode->tanggal_pembukaan_ami)->translatedFormat('d M Y') }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($periode->tanggal_penutupan_ami)->translatedFormat('d M Y') }}
                                    </td>

                                    <td><a href="#" class="btn btn-sm btn-warning">V</a></td>
                                    <td><a href="#" class="btn btn-sm btn-danger">X</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- JavaScript untuk keperluan tambahan jika ada --}}
@endpush
