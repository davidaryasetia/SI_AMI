@extends('layouts.main')
@section('title', 'Home Auditor')
@push('css')
    <style>
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

        .tippy-box[data-theme~='custom'] {
            background-color: #ffffff;
            color: #333;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 10px;
            font-size: 14px;
            line-height: 1.5;
        }

        .tippy-arrow {
            color: #ffffff;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Pengumuman Kegiatan AMI -->
        <div class="row mb-2 d-flex">
            <div class="col-12">
                <h5 class="fw-bold text-dark">Hai, {{ Auth::user()->nama }}! Selamat datang di Dashboard Auditor</h5>
                <div class="col-lg-3">
                    @if ($current_periode && $current_periode->status == 'Sedang Berjalan')
                        <div class="alert alert-custom mt-3" role="alert">
                            <strong>Kegiatan AMI Sedang Berlangsung</strong>
                        </div>
                    @elseif ($current_periode && $current_periode->status == 'Tutup')
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
        </div>


        <!-- Konten Utama -->
        <div class="row">
            <!-- Tabel Data Audite -->
            <div class="col-lg-8 mb-1">
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
                                        <th>Status Auditor</th>
                                        <th>Persentase Pengisian Audite</th>
                                        <th>Status Pengisian Audite</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomer = 1; ?>
                                    @foreach ($dataTransaksi as $data)
                                        <tr>
                                            <td>{{ $nomer++ }}</td>
                                            <td>{{ $data['nama_unit'] }}</td>
                                            <td>
                                                @if ($data['is_ketua_auditor'] == true && $data['is_anggota_auditor'] == false)
                                                    Ketua Auditor
                                                @elseif ($data['is_ketua_auditor'] == false && $data['is_anggota_auditor'] == true)
                                                    Anggota Auditor
                                                @else
                                                    <span style="color: red">Data Belum Di Set !!!</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $data['persentase'] }}%
                                            </td>
                                            <td>
                                                @if ($data['statusFinalisasiAudite'] == true)
                                                    <span class="badge bg-success text-dark" style="font-weight: bold">Sudah
                                                        Finalisasi</span>
                                                @else
                                                    <span class="badge bg-warning text-dark" style="font-weight: bold">Belum
                                                        Finalisasi </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Tambahkan data sesuai kebutuhan -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Jadwal AMI -->
            <div class="col-lg-4 mb-1">
                <div class="card h-90">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informasi Jadwal AMI</h5>
                    </div>
                    <div class="card-body p-2">
                        <ul class="list-group list-group-flush">
                            @if (!empty($current_periode->tanggal_pembukaan_ami) && $current_periode !== null)
                                <li class="list-group-item">Tahun:
                                    <strong>{{ \Carbon\Carbon::parse($current_periode->tanggal_pembukaan_ami)->translatedFormat('Y') }}</strong>
                                </li>

                                <li class="list-group-item">Jumlah Unit Diaudit:
                                    <strong>{{ count(session('auditor')) }}</strong>
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

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-light d-flex align-items-center justify-content-between">
                        <div></div>
                        <h5 class="card-title mb-0 text-black text-center">Rekap Capaian Unit : {{ $nama_unit }} <i
                                class="ti ti-info-circle fs-5 text-primary" id="tooltip-info"></i></h5>

                        <div class="col-lg-2">
                            <select id="unit_id" class="form-select text-black"
                                style="
                            font-size: 14px; 
                            color: #333; 
                            background-color: #ffffff; 
                            border: 1px solid #ddd; 
                            border-radius: 10px; 
                            padding: 8px 8px; 
                            transition: all 0.3s ease;
                        ">
                                <option value="">Pilih Unit Kerja</option>
                                @foreach (session('auditor') as $auditor)
                                    <option value="{{ $auditor['unit_id'] }}"
                                        {{ request('unit_id') == $auditor['unit_id'] ? 'selected' : '' }}>
                                        {{ $auditor['nama_unit'] }}</option>
                                @endforeach
                            </select>
                        </div>
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
            document.addEventListener('DOMContentLoaded', function() {
                const unitSelect = document.getElementById('unit_id');

                unitSelect.addEventListener('change', function() {
                    const unitId = unitSelect.value;

                    if (unitId) {
                        window.location.href = `/home/auditor?unit_id=${unitId}`;
                    } else {
                        window.location.href = `/home/auditor`;
                    }
                })
            })
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                tippy('#tooltip-info', {
                    content: `
            <div style="text-align: left;">
                <strong style="font-size: 16px;">Total Indikator Kinerja:</strong> <span>{{ $totalCapaian }}</span><br>
                <strong style="color: blue;">Jumlah Melampaui:</strong> <span>{{ $melampauiTarget }}</span><br>
                <strong style="color: green;">Jumlah Memenuhi:</strong> <span>{{ $memenuhi }}</span><br>
                <strong style="color: red;">Jumlah Belum Memenuhi:</strong> <span>{{ $belumMemenuhi }}</span>
            </div>
        `,
                    allowHTML: true,
                    theme: 'custom',
                    placement: 'bottom',
                    interactive: true,
                    maxWidth: '300px'
                });
            });
        </script>


        <script>
            var ctx = document.getElementById('performanceChart').getContext('2d');
            var performanceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Rekap Capaian'],
                    datasets: [{
                            label: 'Belum Memenuhi',
                            data: [{{ $persentaseBelumMemenuhi }}],
                            backgroundColor: 'red',
                            count: {{ $belumMemenuhi }} // Jumlah fix data dinamis
                        },
                        {
                            label: 'Memenuhi',
                            data: [{{ $persentaseMemenuhi }}], // Persentase dinamis
                            backgroundColor: 'green',
                            count: {{ $memenuhi }} // Jumlah fix data dinamis
                        },
                        {
                            label: 'Melampaui',
                            data: [{{ $persentaseMelampaui }}], // Persentase dinamis
                            backgroundColor: 'blue',
                            count: {{ $melampauiTarget }} // Jumlah fix data dinamis
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    scales: {
                        x: {
                            stacked: true,
                            beginAtZero: true,
                            max: 100 // Karena persentase, maksimum 100%
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
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    let value = context.raw || 0; // Persentase
                                    let count = context.dataset.count || 0; // Jumlah fix
                                    return `${label}: ${value}% (${count} data)`;
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
