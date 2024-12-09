{{-- @dump($data_indikator->toArray()) --}}
@extends('layouts.main')
@section('title', 'Riwayat Kinerja')
@push('css')
    <style>
        .card-header-custom {
            background-color: #4CAF50;
            /* Hijau untuk progress */
            color: white;
            font-weight: bold;
            text-align: center;
        }

        .table td,
        .table th {
            word-wrap: break-word;
            white-space: normal;
            max-width: 150px;
            text-align: left;
            vertical-align: top;
            line-height: 1.4;
        }

        #table_pengisian_kinerja_auditor td {
            width: 250px;
            white-space: normal;
            word-wrap: break-word;
            line-height: 1.4 !important;
            text-align: left;
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

        #riwayat td {
            width: 250px;
            white-space: normal;
            word-wrap: break-word;
            line-height: 1.4;
            text-align: left;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title fw-semibold">Riwayat Progress Capaian Kinerja
                            @if (isset($data_indikator['tipe_data']) && $data_indikator['tipe_data'] === 'unit_kerja')
                                Unit {{ $nama_unit }}
                            @elseif (isset($data_indikator['tipe_data']) && $data_indikator['tipe_data'] === 'departemen_kerja')
                                {{ $nama_unit }}
                            @else
                                {{ $nama_unit }}
                            @endif

                        </h4>

                        <div class="ms-2">
                            <form id="exportForm" action="{{ route('riwayat_audite.export') }}" method="GET">
                                <input type="hidden" name="jadwal_ami_id" value="{{ $jadwalAmiId }}">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="ti ti-download"></i> Export Riwayat Audite
                                </button>
                            </form>
                        </div>

                        {{-- Tooltip Custom dengan Tippy.js --}}
                        <div id="tooltip-info" class="ms-2" style="cursor: pointer;">
                            <i class="ti ti-info-circle fs-5 text-primary"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <div class="col-lg-12">
                                <select id="jadwal_ami_id" name="jadwal_ami_id" class="form-select text-black"
                                    style="border-radius: 12px;color: black">
                                    <option value="">Pilih Periode AMI</option>
                                    @foreach ($jadwalPeriode as $jadwal)
                                        <option value="{{ $jadwal->jadwal_ami_id }}"
                                            {{ $jadwalAmiId == $jadwal->jadwal_ami_id ? 'selected' : '' }}>
                                            {{ $jadwal->nama_periode_ami }} :
                                            {{ \Carbon\Carbon::parse($jadwal->tanggal_pembukaan_ami)->translatedFormat('d M') }}
                                            -
                                            {{ \Carbon\Carbon::parse($jadwal->tanggal_penutupan_ami)->translatedFormat('d M') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end " style="position: absolute; top: 72px;right: 40px; z-index: 1050;">
                    @if (session('success'))
                        <div class="alert alert-primary  col-lg-8" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger  col-lg-8" role="alert">
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
                {{-- End Header --}}

                {{-- Barchart --}}
                <div class="horizontal-bar-chart-container"
                    style="height: 70px; width: 100%; max-width: 100%; margin: auto;">
                    <canvas id="performanceChart"></canvas>
                </div>

                {{-- Table Content --}}
                <div class="table-responsive mt-1   ">
                    <table class="table table-bordered" id="riwayat">
                        <thead style="">
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Indikator</th>
                                <th>Target</th>
                                <th>Capaian</th>
                                <th>Status Capaian</th>
                                <th>Analisis Keberhasilan</th>
                                <th>Usulan Target Tahun Depan</th>
                                <th>Strategi Pencapaian</th>
                                <th>Sarpras yang Dibutuhkan</th>
                                <th>Faktor Pendukung</th>
                                <th>Faktor Penghambat</th>
                                <th>Akar Masalah</th>
                                <th>Tindak Lanjut</th>
                                <th>Data Dukung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$data_indikator)
                                <tr>
                                    <td colspan="15" class="" style="font-size: 16px; font-weight: 400; color: red">
                                        Silahkan Pilih Jadwal periode Pengisian Terlebih Dahulu.</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @else
                                <?php $nomer = 1; ?>
                                @foreach ($data_indikator->indikator_ikuk as $data)
                                    @php
                                        $transaksi = $data->transaksiDataIkuk->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $nomer++ }}</td>
                                        <td>{{ $data['kode_ikuk'] }}</td>
                                        <td>{{ $data['isi_indikator_kinerja_unit_kerja'] }}</td>
                                        <td>{{ $data['target_ikuk'] }}</td>
                                        <td>{{ $transaksi['realisasi_ikuk'] ?? '' }} </td>

                                        {{-- Hasil Audit --}}
                                        <td data-label="Status Audit">
                                            @if ($transaksi['realisasi_ikuk'] > $data['target_ikuk'])
                                                <span style="color: blue">Melampaui</span>
                                            @elseif ($transaksi['realisasi_ikuk'] == $data['target_ikuk'])
                                                <span style="color: blue">Memenuhi</span>
                                            @elseif ($transaksi['realisasi_ikuk'] < $data['target_ikuk'])
                                                <span style="color: red">Belum Memenuhi</span>
                                            @endif
                                        </td>
                                        <!-- Analisis Keberhasilan -->
                                        <td data-label="Analisis Keberhasilan"
                                            style="background-color: {{ empty($transaksi['analisis_usulan_keberhasilan']) ? '#d3d3d3' : '' }}">
                                            {{ $transaksi['analisis_usulan_keberhasilan'] ?? '' }}
                                        </td>

                                        <!-- Usulan Target Tahun Depan -->
                                        <td data-label="Usulan Target Tahun Depan"
                                            style="background-color: {{ empty($transaksi['usulan_target_tahun_depan']) ? '#d3d3d3' : '' }}">
                                            {{ $transaksi['usulan_target_tahun_depan'] ?? '' }}
                                        </td>

                                        <!-- Strategi Pencapaian -->
                                        <td data-label="Strategi Pencapaian"
                                            style="background-color: {{ empty($transaksi['strategi_pencapaian']) ? '#d3d3d3' : '' }}">
                                            {{ $transaksi['strategi_pencapaian'] ?? '' }}
                                        </td>

                                        <!-- Sarpras Yang Dibutuhkan -->
                                        <td data-label="Sarpras Yang Dibutuhkan"
                                            style="background-color: {{ empty($transaksi['sarpras_yang_dibutuhkan']) ? '#d3d3d3' : '' }}">
                                            {{ $transaksi['sarpras_yang_dibutuhkan'] ?? '' }}
                                        </td>

                                        <!-- Faktor Pendukung -->
                                        <td data-label="Faktor Pendukung"
                                            style="background-color: {{ empty($transaksi['faktor_pendukung']) ? '#d3d3d3' : '' }}">
                                            {{ $transaksi['faktor_pendukung'] ?? '' }}
                                        </td>

                                        <!-- Faktor Penghambat -->
                                        <td data-label="Faktor Penghambat"
                                            style="background-color: {{ empty($transaksi['faktor_penghambat']) ? '#d3d3d3' : '' }}">
                                            {{ $transaksi['faktor_penghambat'] ?? '' }}
                                        </td>

                                        <!-- Akar Masalah -->
                                        <td data-label="Akar Masalah"
                                            style="background-color: {{ empty($transaksi['akar_masalah']) ? '#d3d3d3' : '' }}">
                                            {{ $transaksi['akar_masalah'] ?? '' }}
                                        </td>

                                        <!-- Tindak Lanjut -->
                                        <td data-label="Tindak Lanjut"
                                            style="background-color: {{ empty($transaksi['tindak_lanjut']) ? '#d3d3d3' : '' }}">
                                            {{ $transaksi['tindak_lanjut'] ?? '' }}
                                        </td>

                                        <!-- Data Dukung -->
                                        <td data-label="Data Dukung"
                                            style="background-color: {{ empty($transaksi['data_dukung']) ? '#d3d3d3' : '' }}">
                                            {{ $transaksi['data_dukung'] ?? '' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                {{-- END Table Content --}}

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tippy('#tooltip-info', {
                content: `
        <div style="text-align: left;">
            <strong style="font-size: 16px;">Total Indikator Kinerja:</strong> <span>{{ $totalKinerja }}</span><br>
            <strong style="color: #28a745;">Jumlah Melampaui:</strong> <span>{{ $melampauiTarget }}</span><br>
            <strong style="color: #007bff;">Jumlah Memenuhi:</strong> <span>{{ $memenuhi }}</span><br>
            <strong style="color: #dc3545;">Jumlah Belum Memenuhi:</strong> <span>{{ $belumMemenuhi }}</span>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('performanceChart').getContext('2d');
        var performanceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Rekap Capaian'],
                datasets: [{
                        label: 'Belum Memenuhi',
                        data: [{{ $persentaseBelumMemenuhi }}],
                        backgroundColor: 'rgba(255, 43, 43, 1)',
                        count: {{ $belumMemenuhi }} // Jumlah fix data dinamis
                    },
                    {
                        label: 'Memenuhi',
                        data: [{{ $persentaseMemenuhi }}], // Persentase dinamis
                        backgroundColor: 'rgba(44, 42, 255, 0.8)',
                        count: {{ $memenuhi }} // Jumlah fix data dinamis
                    },
                    {
                        label: 'Melampaui',
                        data: [{{ $persentaseMelampaui }}], // Persentase dinamis
                        backgroundColor: 'rgba(45, 255, 42, 1)',
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
                        max: 100
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jadwalSelect = document.getElementById('jadwal_ami_id');

            function updatePage() {
                const jadwalId = jadwalSelect.value;

                if (jadwalId) {
                    window.location.href = `/riwayat_audite?jadwal_ami_id=${jadwalId}`;
                } else {
                    window.location.href = `/riwayat_audite`;
                }
            }

            // Tambahkan event listener hanya untuk dropdown jadwal
            jadwalSelect.addEventListener('change', updatePage);
        });
    </script>

    <script>
        // ------------- Data Audit Mutu Internal ------------
        $('#riwayat').DataTable({
            responsive: true,
            "scrollY": "520px",
            scrollX: true,
            autoWidth: false,
            "pageLength": 50,
            "lengthMenu": [
                [50, 100],
                [50, 100],
            ],
            language: {
                emptyTable: "Data Indikator Kinerja Pada Unit Belum Di Atur"
            }

        });
    </script>
@endpush
