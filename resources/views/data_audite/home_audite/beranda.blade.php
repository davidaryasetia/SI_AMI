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
    </style>
@endpush

@section('row')
    <div class="container-fluid">
        <div class="row mb-4 d-flex">
            <div class="col-12">
                <h5 class="fw-normal text-dark">Hai, {{ Auth::user()->nama }}! Selamat datang di Dashboard Audite pada <strong>Unit
                    P4MP</strong></h5>
                <div class="col-lg-3">
                    <div class="alert alert-custom mt-3" role="alert">
                        <strong>Kegiatan AMI Sedang Berlangsung</strong>
                    </div>
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
                                        <th>Progres Approval</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Contoh Data -->
                                    <tr>
                                        <td>1</td>
                                        <td>Selvia</td>
                                        <td>Ketua Auditor</td>
                                        <td>100%</td>
                                        <td><span class="badge" style=" background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; font-weight: bold">Selesai</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Nana Ramadijanti 2</td>
                                        <td>Anggota Auditor</td>
                                        <td>50%</td>
                                        <td><span class="badge bg-warning text-dark" style="font-weight: bold">Dalam Proses</span></td>
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
                            <li class="list-group-item">Tahun: <strong>2024</strong></li>
                            <li class="list-group-item">Periode: <strong>1 Januari - 10 Januari</strong></li>
                            <li class="list-group-item">Unit: <strong>P4MP</strong></li>
                            <li class="list-group-item">Status: <span class="badge ms-2" style=" background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; font-weight: bold">Sedang Berjalan</span></li>
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
