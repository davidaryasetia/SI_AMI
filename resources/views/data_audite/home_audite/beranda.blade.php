@extends('layouts.main')
@push('css')
    <style>
        /* Custom CSS */
        .alert-custom {
            background-color: #d1ecf1;
            color: #0c5460;
            border-color: #bee5eb;
            padding: 15px;
            border-radius: 8px;
        }

        .alert-custom-danger {
            background-color: #ff1c1c;
            color: #ffffff;
            border-color: #dd8d8d;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
@endpush

@section('row')
    <div class="container-fluid">
        <div class="row mb-4 d-flex">
            <div class="col-12">
                <h5 class="fw-normal text-dark">Hai, {{ Auth::user()->nama }}! Selamat datang di Dashboard Audite pada
                    <strong>Unit
                        @if (session()->has('audite.unit.nama_unit'))
                            {{ session('audite.unit.nama_unit') }}
                        @endif
                    </strong>
                </h5>
                <div class="col-lg-3">
                    @if ($current_periode->status == 'Sedang Berjalan')
                        <div class="alert alert-custom mt-3" role="alert">
                            <strong>Kegiatan AMI Sedang Berlangsung</strong>
                        </div>
                    @else
                        <div class="alert alert-custom-danger mt-3" role="alert">
                            <strong>Kegiatan AMI Telah Ditutup</strong>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="row">
            <!-- Tabel Data Audite -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0 text-black">Data Approval Auditor</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Auditor</th>
                                        <th>Status Auditor</th>
                                        <th>Status Approval</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Contoh Data -->
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            @if ($auditor1 == null)
                                                <span style="color: red">Auditor 1 Belum di set</span>
                                            @else
                                                {{ $auditor1 }}
                                            @endif
                                        </td>
                                        <td>Ketua Auditor</td>
                                        <td><span class="badge bg-warning text-dark" style="font-weight: bold">Dalam
                                            Proses</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            @if ($auditor2 == null)
                                                <span style="color: red">Auditor 2 Belum Di Set</span>
                                            @else
                                                {{ $auditor2 }}
                                            @endif
                                            {{ $auditor2 }}
                                        </td>
                                        <td>Anggota Auditor</td>
                                        <td><span class="badge bg-warning text-dark" style="font-weight: bold">Dalam
                                                Proses</span></td>
                                    </tr>
                                    <!-- Tambahkan data sesuai kebutuhan -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Jadwal AMI -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header text-white">
                        <h5 class="card-title mb-0">Informasi Jadwal AMI</h5>
                    </div>
                    <div class="card-body" style="padding: 16px">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Tahun:
                                <strong><strong>{{ \Carbon\Carbon::parse($current_periode->tanggal_pembukaan_ami)->translatedFormat('Y') }}</strong></strong>
                            </li>
                            <li class="list-group-item">Periode:
                                <strong>{{ \Carbon\Carbon::parse($current_periode->tanggal_pembukaan_ami)->translatedFormat('d M') }}
                                    -
                                    {{ \Carbon\Carbon::parse($current_periode->tanggal_penutupan_ami)->translatedFormat('d M') }}</strong>
                            </li>
                            <li class="list-group-item">Unit:
                                <strong>
                                    @if (session()->has('audite.unit.nama_unit'))
                                        {{ session('audite.unit.nama_unit') }}
                                    @endif
                                </strong>
                            </li>
                            <li class="list-group-item">Progress Pengisian:
                                <strong>
                                  -
                                </strong>
                            </li>
                            <li class="list-group-item">Status:
                                @if ($current_periode->status == 'Sedang Berjalan')
                                    <span class="badge ms-2"
                                        style="background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; font-weight: bold">{{ $current_periode->status }}
                                    </span>
                                @else
                                    <span class="badge ms-2"
                                        style="background-color: #ff0000; color: #ffffff; border-color: #dd8d8d; font-weight: bold">{{ $current_periode->status }}
                                    </span>
                                @endif

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <!-- Script tambahan jika diperlukan -->
    @endpush
@endsection
