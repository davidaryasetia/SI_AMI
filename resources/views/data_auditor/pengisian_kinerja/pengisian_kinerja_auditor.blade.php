@extends('layouts.main')

@push('css')
    <style>
        .card-header-custom {
            background-color: #4CAF50;
            /* Hijau untuk progress */
            color: white;
            font-weight: bold;
            text-align: center;
        }


        /* Untuk membuat dropdown lebih nyaman di dalam kolom */
    </style>
@endpush

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5>Sistem Informasi Audit Mutu Internal</h5>
                        <p>Pengisian evaluasi unit P4MP.</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <span>Progres evaluasi: 60% (2 dari 3)</span>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-select text-black" style="border-radius: 12px;">
                            <option selected>Unit Prodi TI</option>
                            <option value="ukarni">Ukarni</option>
                            <option value="p3m">P3M</option>
                            <option value="baak">BAAK</option>
                        </select>
                    </div>
                </div>
                {{-- End Header --}}

                {{-- Table Content --}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Indikator</th>
                                <th>Target</th>
                                <th>Capaian</th>
                                <th style="padding: 10px 64px;">Status Capaian</th>
                                <th>Analisis Keberhasilan</th>
                                <th>Usulan Target Tahun Depan</th>
                                <th>Strategi Pencapaian</th>
                                <th>Sarpras yang Dibutuhkan</th>
                                <th>Faktor Pendukung</th>
                                <th>Faktor Penghambat</th>
                                <th>Akar Masalah</th>
                                <th>Tindak Lanjut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>IK2.2</td>
                                <td>Jumlah Dosen</td>
                                <td>20</td>
                                <td></td>
                                <td>
                                    <select class="form-select w-100" style="border-radius: 12px;">
                                        <option selected>Pilih Status</option>
                                        <option value="tercapai">Tercapai</option>
                                        <option value="belum">Belum Tercapai</option>
                                        <option value="proses">Dalam Proses</option>
                                    </select>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

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
