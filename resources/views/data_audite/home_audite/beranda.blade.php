@extends('layouts.main')

@section('row')
    <div class="container-fluid">
        <!-- Pengumuman Kegiatan AMI -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success text-center" role="alert">
                    <h5 class="fw-bold mb-3">Kegiatan AMI yang Sedang Berlangsung</h5>
                    <p class="mb-1">AMI <strong>Tahun 2024</strong></p>
                    <p class="mb-1">Mulai: <strong>1 Januari 2025</strong></p>
                    <p class="mb-1">Selesai: <strong>11 Januari 2025</strong></p>
                    <p class="mb-0">Progres Pengisian Kinerja: <strong>0%</strong></p>
                </div>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="row">
            <!-- Tabel Data Audite -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Data Audite</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Audite</th>
                                        <th>Progres Kinerja</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Contoh Data -->
                                    <tr>
                                        <td>1</td>
                                        <td>Audite 1</td>
                                        <td>70%</td>
                                        <td><span class="badge bg-success">Selesai</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Audite 2</td>
                                        <td>50%</td>
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
                            <li class="list-group-item">Status: <span class="badge bg-info text-dark">Dalam Proses</span></li>
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
