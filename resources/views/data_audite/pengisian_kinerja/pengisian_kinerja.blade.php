@extends('layouts.main')
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

        /* Responsive Table */
        @media (max-width: 768px) {
            table thead {
                display: none;
            }

            table tr {
                display: block;
                margin-bottom: 10px;
            }

            table td {
                display: block;
                text-align: right;
                font-size: 14px;
                border-bottom: 1px solid #ddd;
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

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4 content-header">
                    <h4 class="card-title fw-semibold">Progress Pengisian Kinerja Audite</h4>
                </div>
                <p class="unit-info" style="font-weight: bold; color: black">Unit
                    @if (session()->has('audite.unit.nama_unit'))
                        {{ session('audite.unit.nama_unit') }}
                    @endif
                </p> <!-- Keterangan Unit P4MP -->

                {{-- Table Content --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Indikator</th>
                                <th>Target</th>
                                <th>Capaian</th>
                                <th>Analisis Keberhasilan</th>
                                <th>Usulan Target Tahun Depan</th>
                                <th>Strategi Pencapaian</th>
                                <th>Sarpras Yang Dibutuhkan</th>
                                <th>Faktor Pendukung</th>
                                <th>Faktor Penghambat</th>
                                <th>Akar Masalah</th>
                                <th>Tindak Lanjut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data_indikator['indikator_ikuk'] as $dataIndikator)
                                <tr>
                                    <td data-label="No">{{ $no++ }}</td>
                                    <td data-label="Kode Indikator">{{ $dataIndikator['kode_ikuk'] }}</td>
                                    <td data-label="Indikator" style="width: 40%; white-space: pre-line; word-wrap: break-word; text-align: left; color: black;">{{ $dataIndikator['isi_indikator_kinerja_unit_kerja'] }}</td>
                                    <td data-label="Target">{{ $dataIndikator['target_ikuk'] }}</td>
                                    <td data-label="Capaian">-</td>
                                    <td data-label="Analisis Keberhasilan">-</td>
                                    <td data-label="Usulan Target Tahun Depan">-</td>
                                    <td data-label="Strategi Pencapaian">-</td>
                                    <td data-label="Sarpras Yang Dibutuhkan">-</td>
                                    <td data-label="Faktor Pendukung">-</td>
                                    <td data-label="Faktor Penghambat">-</td>
                                    <td data-label="Akar Masalah">-</td>
                                    <td data-label="Tindak Lanjut">-</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

                {{-- END Table Content --}}
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- Add necessary scripts here --}}
@endpush
