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

        .table-responsive {
            zoom: 0.7;
            overflow-x: auto;
        }

        #riwayat td {
            white-space: normal;
            word-wrap: break-word;
            line-height: 1.4;
            text-align: left;
            color: black;
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
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">

                {{-- Header --}}
                <div class="d-flex align-items-center mb-2 justify-content-between">
                    <div class="d-flex align-items-start">

                        <div class="d-flex flex-column">
                            <h4 class="card-title fw-semibold mb-1">Riwayat Capaian Kinerja
                            </h4>
                            @if (isset($data_indikator['tipe_data']) && $data_indikator['tipe_data'] === 'unit_kerja')
                                <span style="color: black; font-weight: 400;">{{ $nama_unit }}</span>
                            @elseif (isset($data_indikator['tipe_data']) && $data_indikator['tipe_data'] === 'departemen_kerja')
                                <span style="color: black; font-weight: 400">{{ $nama_unit }}</span>
                            @else
                                <span style="color: black; font-weight: 400">{{ $nama_unit }}</span>
                            @endif
                        </div>


                        <div class="d-flex ms-1">
                            <div class="d-flex justify-content-end ms-3">
                                <!-- Form Export -->
                                <form id="exportForm" action="{{ route('riwayat.export') }}" method="GET">
                                    <input type="hidden" name="jadwal_ami_id" value="{{ $selectedJadwalAmiId }}">
                                    <input type="hidden" name="unit_id" value="{{ $selectedUnitId }}">
                                    <button type="submit" id="exportButton" class="btn btn-sm btn-primary">
                                        <i class="ti ti-download"></i> Unduh Rekap Unit
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="d-flex">
                            {{-- Button to Open Modal --}}
                            <button type="button" class="btn btn-sm btn-info ms-3" data-bs-toggle="modal"
                                data-bs-target="#chartModal"><i class="ti ti-chart-area-line"></i>
                                Lihat Grafik
                            </button>

                        </div>


                        {{-- Tooltip Custom dengan Tippy.js --}}
                        <div id="tooltip-info" class="ms-3 me-3" style="cursor: pointer;">
                            <i class="ti ti-info-circle fs-5 text-primary"></i>
                        </div>
                        <!-- Tambahkan divider vertikal -->
                        <div style="border-left: 1px solid #bbbbbb; height: 20px;" class="">
                        </div>
                        <div id="keterangan_data" class="ms-2 d-flex align-items-center keterangan_data">
                            <span>Aturan :</span>
                            <i class="ti ti-info-circle fs-5 text-primary ms-2"></i>
                        </div>
                    </div>


                    <div class="d-flex align-items-start justify-content-end">
                        <div class="col-lg-4 me-3">
                            <select id="unit_id" name="unit_id" class="form-select text-black"
                                style="border-radius: 12px;color: black">
                                <option value="">Pilih Unit Kerja</option>
                                <option value="all" {{ $selectedUnitId == 'all' ? 'selected' : '' }}>Export Semua Unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->unit_id }}"
                                        {{ $selectedUnitId == $unit->unit_id ? 'selected' : '' }}>
                                        {{ $unit->nama_unit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-5">
                            <select id="jadwal_ami_id" name="jadwal_ami_id" class="form-select text-black"
                                style="border-radius: 12px;color: black">
                                <option value="">Pilih Periode AMI</option>
                                @foreach ($jadwalPeriode as $jadwal)
                                    <option value="{{ $jadwal->jadwal_ami_id }}"
                                        {{ $selectedJadwalAmiId == $jadwal->jadwal_ami_id ? 'selected' : '' }}>
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
                {{-- End Header --}}

                {{-- Modal Bar Chart --}}
                <div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="chartModalLabel">Grafik Progress Capaian</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="horizontal-bar-chart-container"
                                    style="height: 120px; width: 100%; max-width: 100%; margin: auto;">
                                    <canvas id="performanceChart"></canvas>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-end" style="position: absolute; top: 72px;right: 40px; z-index: 1050;">
                    @if (session('success'))
                        <div class="alert alert-primary  col-lg-12" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger  col-lg-12" role="alert">
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


                {{-- Table Content --}}
                <div class="table-responsive">
                    <table class="table table-bordered" style="color: black" id="riwayat">
                        <thead style="">
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Indikator</th>
                                <th>Satuan</th>
                                <th>Target1</th>
                                <th>Target2</th>
                                <th>Link</th>
                                <th>Tipe</th>
                                <th>Realisasi</th>
                                <th>Hasil Audit</th>
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
                                    <td colspan="19" class="" style="font-size: 16px; font-weight: 400; color: red">
                                        Silakan pilih unit kerja terlebih
                                        dahulu.</td>
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
                                        <td>{{ $data['satuan_ikuk'] }}</td>
                                        <td>{{ $data['target1'] }}</td>
                                        <td>{{ $data['target2'] }}</td>
                                        <td><a href="{{ $data['link'] }}">Link Data Dukung</a></td>
                                        <td>{{ $data['tipe'] }}</td>
                                        <td>{{ $transaksi['realisasi_ikuk'] ?? 'Belum Mengisi' }} </td>

                                        {{-- Hasil Audit --}}
                                        <td data-label="Status Audit">
                                            @if ($transaksi['hasil_audit'] == 'Melampaui')
                                                <span class="badge"
                                                    style="background-color: blue; color: white; font-weight: 600">Melampaui</span>
                                            @elseif ($transaksi['hasil_audit'] == 'Memenuhi')
                                                <span class="badge"
                                                    style="background-color: green;color: white; font-weight: 600">Memenuhi</span>
                                            @elseif ($transaksi['hasil_audit'] == 'Belum Memenuhi')
                                                <span class="badge"
                                                    style="background-color: red;color: white; font-weight: 600">Belum
                                                    Memenuhi</span>
                                            @else
                                                <span style="color: red">Belum Megisi</span>
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
                                            <a href="{{ $transaksi['data_dukung'] ?? '' }}"
                                                target="_blank">{{ $transaksi['data_dukung'] ?? '' }}</a>
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
            <strong style="color: blue;">Jumlah Melampaui:</strong> <span>{{ $melampauiTarget }}</span><br>
            <strong style="color: green;">Jumlah Memenuhi:</strong> <span>{{ $memenuhi }}</span><br>
            <strong style="color: red;">Jumlah Belum Memenuhi:</strong> <span>{{ $belumMemenuhi }}</span><br>
            <strong style="color: black;">Jumlah Belum Mengisi:</strong> <span>{{ $belumMengisi }}</span>
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
        document.addEventListener('DOMContentLoaded', function() {
            const keteranganElements = document.querySelectorAll('.keterangan_data');

            keteranganElements.forEach((element) => {
                tippy(element, {
                    content: `
                <div style="text-align: left;">
                    <p style="font-size:16px; color:black; font-weight:600">
                        Aturan Perhitungan Capaian Hasil Audit Indikator Berdasarkan Tipe:
                    </p>
                    <ol type="1" style="color:black;">
                        <li>Tipe 0 : jika realisasi >= target yang diterapkan berarti status realisasi melampaui 
                            (Capaian yang lebih besar dari target lebih baik)
                        </li>    
                        <hr>
                        <li>Tipe 1 : jika realisasi <= target yang diterapkan berarti status realisasi melampaui 
                            (Capaian yang lebih kecil dari target akan berstatus lebih baik)
                        </li> 
                        <hr>
                        <li>Tipe 2 (range) : jika realisasi masuk di dalam range pada target 1 dan target 2 yang 
                            diterapkan maka, memenuhi, jika di luar range tidak memenuhi
                        </li>
                    </ol>
                </div>
            `,
                    allowHTML: true,
                    theme: 'custom',
                    placement: 'bottom',
                    interactive: true,
                    maxWidth: '300px'
                });
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
            const unitSelect = document.getElementById('unit_id');
            const jadwalSelect = document.getElementById('jadwal_ami_id');

            function updatePage() {
                const unitId = unitSelect.value;
                const jadwalId = jadwalSelect.value;

                if (jadwalId) {
                    // Reset unit dropdown setiap kali jadwal berubah
                    unitSelect.innerHTML = '<option value="">Pilih Unit Kerja</option>';

                    // Redirect halaman dengan parameter jadwal
                    if (unitId) {
                        window.location.href = `/riwayat?unit_id=${unitId}&jadwal_ami_id=${jadwalId}`;
                    } else {
                        window.location.href = `/riwayat?jadwal_ami_id=${jadwalId}`;
                    }
                } else if (unitId) {
                    window.location.href = `/riwayat?unit_id=${unitId}`;
                } else {
                    window.location.href = `/riwayat`;
                }
            }

            // Tambahkan event listener untuk kedua dropdown
            unitSelect.addEventListener('change', updatePage);
            jadwalSelect.addEventListener('change', function() {
                // Reset dropdown unit saat jadwal berubah
                unitSelect.innerHTML = '<option value="">Pilih Unit Kerja</option>';

                // Panggil updatePage untuk handle perubahan URL
                updatePage();
            });
        });
    </script>


    <script>
        // ------------- Data Audit Mutu Internal ------------
        $('#riwayat').DataTable({
            responsive: true,
            "scrollY": "680px",
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
