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

        .pie-chart-container {
            height: 500px;
            /* Sesuaikan tinggi sesuai kebutuhan */
        }
    </style>
@endpush

@section('row')
    <div class="container-fluid">
        <div class="row mb-4 d-flex flex-row align-items-center mb-4 justify-content-between">
            <div class="col-lg-8">
                <h5 class="fw-bold text-dark">Hai, {{ Auth::user()->nama }}! Selamat datang di Dashboard Audite pada
                    <strong>Unit
                        @if (session()->has('audite.unit.nama_unit'))
                            {{ session('audite.unit.nama_unit') }}
                        @endif
                    </strong>
                </h5>
                <div class="col-lg-6">
                    @if ($current_periode && $current_periode->status == 'Sedang Berjalan')
                        <div class="alert alert-custom mt-3" role="alert">
                            <strong>Kegiatan AMI Sedang Berlangsung</strong>
                        </div>
                    @elseif ($current_periode && $current_periode->status == 'Sedang Berjalan')
                        <div class="alert alert-custom-danger mt-3" role="alert">
                            <strong>Kegiatan AMI Telah Ditutup</strong>
                        </div>
                    @else
                        <div class="alert alert-custom-danger mt-3" role="alert">
                            <strong>Kegiatan AMI Telah Ditutup</strong>
                        </div>
                    @endif

                </div>
            </div>

            <div class="col-lg-4">
                @if (session('succes'))
                    <div class="alert alert-primary" style="role-alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" style="role-alert">
                        {{ session('error') }}
                    </div>
                @endif
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
                            @if (!empty($current_periode->tanggal_pembukaan_ami) && $current_periode !== null)
                                <li class="list-group-item">Tahun:
                                    <strong>{{ \Carbon\Carbon::parse($current_periode->tanggal_pembukaan_ami)->translatedFormat('Y') }}</strong>
                                </li>

                                <li class="list-group-item">Periode:
                                    <strong>{{ \Carbon\Carbon::parse($current_periode->tanggal_pembukaan_ami)->translatedFormat('d M') }}
                                        -
                                        {{ \Carbon\Carbon::parse($current_periode->tanggal_penutupan_ami)->translatedFormat('d M') }}</strong>
                                </li>
                                <li class="list-group-item">Keterangan:
                                    <strong>{{ $current_periode->nama_periode_ami }}</strong>
                                </li>

                                @if ($current_periode->status == 'Sedang Berjalan')
                                    <li class="list-group-item">Status :
                                        <span class="badge ms-2"
                                            style=" background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; font-weight: bold">{{ $current_periode->status }}</span>
                                    </li>
                                @else
                                    <li class="list-group-item"> Status :
                                        <span class="badge ms-2"
                                            style=" background-color: #ff0000; color: #ffffff; border-color: #dd8d8d; font-weight: bold">{{ $current_periode->status }}</span>
                                    </li>
                                @endif
                            @else
                                <li class="list-group-item">Tahun:
                                    <strong><span style="color: red">Belum di Set</span></strong>
                                </li>
                                <li class="list-group-item">Periode:
                                    <strong style="color: red">Belum di Set</strong>
                                </li>
                                <li class="list-group-item">Keterangan:
                                    <strong style="color: red">Belum di Set</strong>
                                </li>
                                <li class="list-group-item">Status :
                                    <span class="badge ms-2"
                                        style=" background-color: #ff0000; color: #ffffff; border-color: #dd8d8d; font-weight: bold">Tutup</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- Tambahan Grafik Rekap Capaian -->
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0 text-black text-center">Rekap Capaian Unit</h5>
                    </div>
                    <div class="card-body">
                        <div class="horizontal-bar-chart-container"
                            style="height: 100px; width: 100%; max-width: 1200px; margin: auto;">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('performanceChart').getContext('2d');
            var performanceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Rekap Capaian'], // Hanya satu label untuk strip tunggal
                    datasets: [{
                            label: 'Belum Mencapai Target',
                            data: [30], // Contoh data
                            backgroundColor: 'rgba(255, 43, 43, 1)',
                        },
                        {
                            label: 'Mencapai Target',
                            data: [40], // Contoh data
                            backgroundColor: 'rgba(44, 42, 255, 0.8)',
                        },
                        {
                            label: 'Melebihi Target',
                            data: [30], // Contoh data
                            backgroundColor: 'rgba(45, 255, 42, 1)',
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y', // Membuat grafik horizontal
                    scales: {
                        x: {
                            stacked: true,
                            beginAtZero: true,
                            max: 100 // Menyesuaikan skala ke 100% untuk persentase
                        },
                        y: {
                            stacked: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
