@extends('layouts.main')
@section('title', 'Pengisian Kinerja Auditor')
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


        /* Untuk membuat dropdown lebih nyaman di dalam kolom */
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex justify-content-start">
                        <h4 class="card-title fw-semibold">Progress Capaian Data Kinerja Audite: Unit {{ $nama_unit }}
                        </h4>

                        {{-- Tooltip Custom dengan Tippy.js --}}
                        <div id="tooltip-info" class="ms-2" style="cursor: pointer;">
                            <i class="ti ti-info-circle fs-5 text-primary"></i>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <select
                            id="unit_id"
                            class="form-select text-black"
                            style="
                                font-size: 14px; 
                                color: #333; 
                                background-color: #f8f8f8; 
                                border: 1px solid #ddd; 
                                border-radius: 10px; 
                                padding: 8px 8px; 
                                transition: all 0.3s ease;
                            "
                        >
                            <option value="">Pilih Unit Kerja</option>
                            @foreach (session('auditor') as $auditor)
                                <option value="{{ $auditor['units']['unit_id'] }}"
                                    {{ request('unit_id') == $auditor['units']['unit_id'] ? 'selected' : '' }}>
                                    {{ $auditor['units']['nama_unit'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                {{-- End Header --}}

                {{-- Table Content --}}
                <div class="table-responsive">
                    <table class="table table-bordered" id="table_pengisian_kinerja_auditor">
                        <thead>
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
                                            <a href="{{ $transaksi['data_dukung'] ?? '' }}" target="_blank">{{ $transaksi['data_dukung'] ?? '' }}</a>
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
            const unitSelect = document.getElementById('unit_id');

            unitSelect.addEventListener('change', function() {
                const unitId = unitSelect.value;
                
                if (unitId) {
                    window.location.href = `/pengisian_kinerja_auditor?unit_id=${unitId}`;
                } else {
                    window.location.href = `/pengisian_kinerja_auditor`;
                }
            })
        })
    </script>

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




    <script>
        // ------------- Data Audit Mutu Internal ------------
        $('#table_pengisian_kinerja_auditor').DataTable({
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
                emptyTable: "Data Indikator Kinerja Pada Unit {{ $nama_unit }} Belum Di Atur"
            }

        });
    </script>
@endpush
