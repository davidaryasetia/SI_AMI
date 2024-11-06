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

                    <div class="d-flex align-items-center">
                        <a href="/periode_audit" class=" {{ isset($edit_periode) ? '' : 'd-none' }}">
                            <i class="ti ti-arrow-left me-3" style="font-size: 20px; color: black"></i>
                        </a>
                        <h4 class="card-title fw-semibold">
                            {{ isset($edit_periode) ? 'Edit Jadwal Pengisian AMI' : 'Buat Jadwal Pengisian AMI' }}</h4>
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

                {{-- Form Input Periode --}}
                <form
                    action="{{ isset($edit_periode) ? route('periode_audit.update', $edit_periode->jadwal_ami_id) : route('periode_audit.store') }}"
                    method="POST" class="col-lg-6">
                    @csrf
                    @if (isset($edit_periode))
                        @method('PUT')
                    @endif

                    <div class="form-group mb-3">
                        <label for="namaPeriode" class="form-label">Nama Periode AMI</label>
                        <input type="text" class="form-control" name="nama_periode_ami" id="namaPeriode"
                            placeholder="Nama Periode AMI"
                            value="{{ old('nama_periode_ami', $edit_periode->nama_periode_ami ?? '') }}" required>

                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_pembukaan_ami" class="form-label">Mulai</label>
                        <input type="date" class="form-control" name="tanggal_pembukaan_ami" id="tanggal_pembukaan_ami"
                            value="{{ old('tanggal_pembukaan_ami', $edit_periode->tanggal_pembukaan_ami ?? '') }}" required>

                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_penutupan_ami" class="form-label">Selesai</label>
                        <input type="date" class="form-control" name="tanggal_penutupan_ami" id="tanggal_penutupan_ami"
                            value="{{ old('tanggal_penutupan_ami', $edit_periode->tanggal_penutupan_ami ?? '') }}" required>

                    </div>
                    <div class="d-grid col-lg-4 gap-2 mt-4">
                        <button type="submit"
                            class="btn btn-primary">{{ isset($edit_periode) ? 'Update Periode' : 'Tambah Periode' }}</button>
                    </div>
                </form>


                {{-- Tabel Periode AMI --}}
                <div class="table-responsive mt-4">
                    <h4 class="card-title fw-semibold mb-4">Riwayat Jadwal Pengisian</h4>
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Periode AMI</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Status</th>
                                <th>Tutup</th>
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
                                    <td>
                                        @if ($periode->status == 'Sedang Berjalan')
                                            <span class="badge ms-2"
                                                style="background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; font-weight: bold">{{ $periode->status }}</span>
                                        @else
                                            <span class="badge ms-2"
                                                style="background-color: #ff0000; color: #ffffff; border-color: #dd8d8d; font-weight: bold">{{ $periode->status }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <form action="{{ route('periode_audit.close', $periode->jadwal_ami_id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah anda yakin ingin menutup periode pelaksanaan ini ?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm"
                                                style="background-color: rgb(251, 94, 94); color: white"><i
                                                    class="ti ti-logout"></i></button>
                                        </form>
                                    </td>
                                    <td><a href="{{ route('periode_audit.index', ['id' => $periode->jadwal_ami_id]) }}"
                                            class="btn btn-sm" style="background-color: rgb(255, 255, 6); color: black"><i
                                                class="ti ti-pencil"></i></a></td>
                                    <td>
                                        <form action="{{ route('periode_audit.destroy', $periode->jadwal_ami_id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus jadwal pada periode ini ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm"
                                                style="background-color: rgb(255, 0, 0); color: white">
                                                <i class="ti ti-x"></i>
                                            </button>
                                        </form>
                                    </td>
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
