@extends('layouts.main')

@section('title', 'Pengisian Kinerja')
@push('css')
    <style>
        table td,
        table th {
            vertical-align: middle;
            text-align: center;
            padding: 12px;
        }

        .progress {
            height: 25px;
        }

        .btn-export {
            padding: 10px 20px;
            font-size: 16px;
        }

        /* Styling untuk bagian header dan unit */
        .content-header {
            text-align: left;
            margin-bottom: 20px;
        }

        .unit-info {
            font-size: 14px;
            font-weight: normal;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .ikuk-btn {
            display: inline-block;
            margin: 2px;
            padding: 4px 4px;
            font-size: 12px;
            width: auto;
            text-align: center;
            font-weight: 600;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            cursor: pointer;
            border-color: transparent;
        }

        .ikuk-btn[data-status="audite"] {
            background-color: green;
        }

        .ikuk-btn[data-status="auditor"] {
            background-color: #ccc;
        }

        .ikuk-btn[data-status="default"] {
            background-color: #007bff;
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

        .text-wrap {
            white-space: normal;
            word-wrap: break-word;
            word-break: break-word;
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

        #table_pengisian_kinerja td {
            width: 250px;
            white-space: normal;
            word-wrap: break-word;
            line-height: 1.4;
            text-align: left;
            color: black;
        }

        /* Responsive Table */
        @media (max-width: 768px) {
            table thead {
                display: none;
            }

            table tr {
                display: block;
                margin-bottom: 10px;
            }

            .table {
                font-size: 12px;
                /* Ukuran font lebih kecil */
            }



            table td::before {
                content: attr(data-label);
                float: left;
                text-transform: capitalize;
                font-weight: bold;
            }


        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="d-flex justify-content-start align-items-center mb-2 content-header position-relative">
                    <h4 class="card-title fw-semibold">
                        Progress Pengisian Kinerja Audite - Unit
                        @if (session()->has('audite.nama_unit'))
                            {{ session('audite.nama_unit') }}
                        @endif
                    </h4>

                    {{-- Tooltip Custom dengan Tippy.js --}}
                    <div id="tooltip-info" class="ms-2" style="cursor: pointer;">
                        <i class="ti ti-info-circle fs-5 text-primary"></i>
                    </div>
                </div>

                {{-- Error --}}
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
                    }, 3000);
                </script>

                {{-- Button untuk setiap kode IKUK --}}

                <div class="d-flex flex-wrap" style="margin-bottom: 8px">
                    @foreach ($data_indikator['indikator_ikuk'] as $dataIndikator)
                        @php
                            $transaksi = $dataIndikator->transaksiDataIkuk->first();
                            $isHidden =
                                $transaksi['status_finalisasi_audite'] || $transaksi['status_finalisasi_auditor1'];
                        @endphp
                        @if (!$isHidden)
                        <button
                        id="modal {{ $dataIndikator['kode_ikuk'] }}"
                         class="ikuk-btn btn-sm {{ $transaksi && $transaksi['status_pengisian_audite'] ? 'btn-success' : '' }}"
                            data-bs-target="#modal{{ $dataIndikator['kode_ikuk'] }}"
                            data-bs-toggle="modal"
                            data-status="{{ $transaksi['status_pengisian_auditor'] ? 'auditor' : ($transaksi['status_pengisian_audite'] ? 'audite' : 'default') }}"
                            {{ $transaksi && $transaksi['status_pengisian_auditor'] ? 'disabled' : '' }}>
                            {{ $dataIndikator['kode_ikuk'] }}
                        </button>
                        @endif
                    @endforeach
                </div>


                {{-- Modal untuk setiap IKUK --}}
                @foreach ($data_indikator['indikator_ikuk'] as $dataIndikator)
                    @php
                        $transaksi = $dataIndikator->transaksiDataIkuk->first();
                    @endphp
                    <div class="modal fade" id="modal{{ $dataIndikator['kode_ikuk'] }}" tabindex="-1"
                        aria-labelledby="modalLabel{{ $dataIndikator['kode_ikuk'] }}" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                            <!-- Modal Konten -->
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title text-white" style="color: white; font-weight: bold"
                                        id="modalLabel{{ $dataIndikator['kode_ikuk'] }}">Detail Kode
                                        IKUK: {{ $dataIndikator['kode_ikuk'] }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <!-- Form utama untuk update -->
                                <form id="updateForm{{ $dataIndikator['kode_ikuk'] }}" method="POST"
                                    action="{{ route('pengisian_kinerja.update', $transaksi['transaksi_data_ikuk_id']) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body" style="max-height: 480px; overflow-y: auto">
                                        <input type="hidden" name="transaksi_data_ikuk_id"
                                            value="{{ $transaksi['transaksi_data_ikuk_id'] }}">
                                        <input type="hidden" name="target_ikuk"
                                            value="{{ $dataIndikator['target_ikuk'] }}">
                                        <div class="mb-3">
                                            <h6 class="text-primary"><strong>Indikator</strong></h6>
                                            <p>{{ $dataIndikator['isi_indikator_kinerja_unit_kerja'] }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6 class="text-primary"><strong>Target</strong></h6>
                                            <p id="target{{ $dataIndikator['kode_ikuk'] }}">
                                                {{ $dataIndikator['target_ikuk'] }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6 class="text-primary"><strong>Capaian</strong></h6>
                                            <input type="number" name="realisasi_ikuk" class="form-control capaian-input"
                                                placeholder="Masukkan Jumlah Capaian"
                                                id="capaian{{ $dataIndikator['kode_ikuk'] }}"
                                                data-target="{{ $dataIndikator['target_ikuk'] }}"
                                                value="{{ $transaksi->realisasi_ikuk ?? '' }}" required>
                                        </div>


                                        <div class="form-a" id="formA{{ $dataIndikator['kode_ikuk'] }}"
                                            style="display: none;">
                                            <input type="hidden" name="transaksi_data_ikuk_id"
                                                value="{{ $transaksi['transaksi_data_ikuk_id'] }}">

                                            <div class="mb-3">
                                                <label>Analisis Usulan Keberhasilan</label>
                                                <input type="text" class="form-control"
                                                    name="analisis_usulan_keberhasilan"
                                                    value="{{ $transaksi['analisis_usulan_keberhasilan'] ?? '' }}"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Usulan Target Tahun Depan</label>
                                                <input type="text" class="form-control" name="usulan_target_tahun_depan"
                                                    value="{{ $transaksi['usulan_target_tahun_depan'] ?? '' }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Strategi Pencapaian</label>
                                                <input type="text" class="form-control" name="strategi_pencapaian"
                                                    value="{{ $transaksi['strategi_pencapaian'] ?? '' }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Sarpras Yang Dibutuhkan</label>
                                                <input type="text" class="form-control" name="sarpras_yang_dibutuhkan"
                                                    value="{{ $transaksi['sarpras_yang_dibutuhkan'] ?? '' }}" required>
                                            </div>
                                            <hr>
                                            <div class="mb-3">
                                                <label>Link Data Dukung</label>
                                                <input type="text" class="form-control" name="data_dukung"
                                                    value="{{ $transaksi['data_dukung'] ?? '' }}" required>
                                            </div>
                                        </div>

                                        <!-- Form B: Ditampilkan jika capaian < target -->
                                        <div class="form-b" id="formB{{ $dataIndikator['kode_ikuk'] }}"
                                            style="display: none;">
                                            <div class="mb-3">
                                                <label>Faktor Pendukung</label>
                                                <input type="text" class="form-control" name="faktor_pendukung"
                                                    value="{{ $transaksi['faktor_pendukung'] ?? '' }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Faktor Penghambat</label>
                                                <input type="text" class="form-control" name="faktor_penghambat"
                                                    value="{{ $transaksi['faktor_penghambat'] ?? '' }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Akar Masalah</label>
                                                <input type="text" class="form-control" name="akar_masalah"
                                                    value="{{ $transaksi['akar_masalah'] ?? '' }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Tindak Lanjut</label>
                                                <input type="text" class="form-control" name="tindak_lanjut"
                                                    value="{{ $transaksi['tindak_lanjut'] ?? '' }}" required>
                                            </div>
                                            <hr>
                                            <div class="mb-3">
                                                <label>Link Data Dukung</label>
                                                <input type="text" class="form-control" name="data_dukung"
                                                    value="{{ $transaksi['data_dukung'] ?? '' }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary save-button">Save</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Dapatkan semua input capaian
                        const capaianInputs = document.querySelectorAll('.capaian-input');

                        capaianInputs.forEach(input => {
                            // Tambahkan listener untuk input manual
                            input.addEventListener('input', handleInputChange);

                            // Jika input sudah memiliki value, panggil handleInputChange secara manual
                            if (input.value) {
                                handleInputChange.call(input); // Panggil handler dengan konteks input
                            }
                        });

                        // Fungsi untuk menangani perubahan nilai capaian
                        function handleInputChange() {
                            const target = parseFloat(this.getAttribute('data-target'));
                            const capaian = parseFloat(this.value);

                            // Ambil form A dan form B berdasarkan ID input
                            const formA = document.getElementById('formA' + this.id.replace('capaian', ''));
                            const formB = document.getElementById('formB' + this.id.replace('capaian', ''));

                            // Reset tampilan form
                            formA.style.display = 'none';
                            formB.style.display = 'none';

                            // Tampilkan form sesuai kondisi capaian dan target
                            if (!isNaN(capaian)) {
                                if (capaian >= target) {
                                    formA.style.display = 'block';
                                    formB.style.display = 'none';
                                } else {
                                    formA.style.display = 'none';
                                    formB.style.display = 'block';
                                }
                            }
                        }

                        // Tambahkan listener untuk submit hanya pada form yang tampil
                        const saveButtons = document.querySelectorAll('.save-button');

                        saveButtons.forEach(button => {
                            button.addEventListener('click', function(event) {
                                const form = button.closest('form');
                                const formA = form.querySelector('.form-a');
                                const formB = form.querySelector('.form-b');

                                // Cek form mana yang aktif, jika tidak aktif hapus input dari form
                                if (formA.style.display === 'none') {
                                    formA.querySelectorAll('input').forEach(input => {
                                        input.disabled = true;
                                    });
                                } else {
                                    formB.querySelectorAll('input').forEach(input => {
                                        input.disabled = true;
                                    });
                                }
                            });
                        });
                    });
                </script>


                {{-- Table Content --}}
                <div class="table-responsive">
                    <table id="table_pengisian_kinerja" class="table table-bordered ">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 2px;!important">No</th>
                                <th>Kode</th>
                                <th>Indikator</th>
                                <th>Target</th>
                                <th>Capaian</th>
                                <th>Hasil Audit</th>
                                <th>Analisis Keberhasilan</th>
                                <th>Usulan Target Tahun Depan</th>
                                <th>Strategi Pencapaian</th>
                                <th>Sarpras Yang Dibutuhkan</th>
                                <th>Faktor Pendukung</th>
                                <th>Faktor Penghambat</th>
                                <th>Akar Masalah</th>
                                <th>Tindak Lanjut</th>
                                <th>Data Dukung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data_indikator->indikator_ikuk as $dataIndikator)
                                @php
                                    $transaksi = $dataIndikator->transaksiDataIkuk->first();
                                @endphp

                                <tr>
                                    <td data-label="No">{{ $no++ }}</td>

                                    @if (
                                        $transaksi['status_pengisian_auditor'] ||
                                            $transaksi['status_finalisasi_audite'] ||
                                            $transaksi['status_finalisasi_auditor1']
                                    )
                                        <td>
                                            <span class="text-black">{{ $dataIndikator['kode_ikuk'] }}</span>
                                        </td>
                                    @else
                                        <td data-label="Kode Indikator">
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#modal{{ $dataIndikator['kode_ikuk'] }}"
                                                class="text-primary fw-bold">
                                                {{ $dataIndikator['kode_ikuk'] }}
                                            </a>
                                        </td>
                                    @endif


                                    {{-- Indikator --}}
                                    <td data-label="Indikator">
                                        {{ $dataIndikator['isi_indikator_kinerja_unit_kerja'] }}
                                    </td>
                                    <td data-label="Target">{{ $dataIndikator['target_ikuk'] }}</td>


                                    <!-- Capaian -->
                                    <td data-label="Realisasi Ikuk" style="">
                                        {{ $transaksi['realisasi_ikuk'] ?? '-' }}
                                    </td>

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
                                            <span style="color: red">NULL</span>
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
                        </tbody>

                    </table>
                </div>

                {{-- END Table Content --}}
            </div>
        </div>
    </div>

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                tippy('#tooltip-info', {
                    content: `
                <div style="text-align: left;">
                    <strong style="font-size: 16px;">Total Indikator Kinerja:</strong> <span>{{ $totalKinerja }}</span><br>
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
            // ------------- Data Audit Mutu Internal ------------
            $('#table_pengisian_kinerja').DataTable({
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
@endsection
