@extends('layouts.main')
@push('css')
   <style>
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
        <!-- Pengumuman Kegiatan AMI -->
        <div class="row mb-4 d-flex">
            <div class="col-12">
                <h5 class="fw-normal text-dark">Hai, {{ Auth::user()->nama }}! Selamat datang di Dashboard Auditor</h5>
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
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Status Finalisasi Pengisian Audite</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Unit</th>
                                        <th>Audite</th>
                                        <th>Progress Pengisian</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Contoh Data -->
                                    <tr>
                                        <td>1</td>
                                        <td>Ukarni</td>
                                        <td>Selvia</td>
                                        <td>70%</td>
                                        <td><span class="badge" style=" background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; font-weight: bold">Selesai</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>BAAK</td>
                                        <td>Pindarwati</td>
                                        <td>100%</td>
                                        <td><span class="badge bg-warning text-dark">Dalam Proses</span></td>
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
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informasi Jadwal AMI</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Tahun: <strong>2024</strong></li>
                            <li class="list-group-item">Periode: <strong>1 Januari - 10 Januari</strong></li>
                            <li class="list-group-item">Status: <span class="badge text-dark" style=" background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; font-weight: bold">Dalam Proses</span></li>
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
