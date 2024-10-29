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
                <p class="unit-info">Unit P4MP</p> <!-- Keterangan Unit P4MP -->

                {{-- Table Content --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode Indikator</th>
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
                            <tr>
                                <td data-label="No">1</td>
                                <td data-label="Kode Indikator">IK2.2</td>
                                <td data-label="Target">20</td>
                                <td data-label="Capaian">15</td>
                                <td data-label="Analisis Keberhasilan">Telah mencapai 75% target.</td>
                                <td data-label="Usulan Target Tahun Depan">25</td>
                                <td data-label="Strategi Pencapaian">Meningkatkan kualitas SDM.</td>
                                <td data-label="Sarpras Yang Dibutuhkan">Laboratorium tambahan.</td>
                                <td data-label="Faktor Pendukung">Dukungan manajemen.</td>
                                <td data-label="Faktor Penghambat">Keterbatasan anggaran.</td>
                                <td data-label="Akar Masalah">Kurangnya pendanaan.</td>
                                <td data-label="Tindak Lanjut">Mengajukan tambahan anggaran.</td>
                            </tr>
                            <tr>
                                <td data-label="No">2</td>
                                <td data-label="Kode Indikator">IK2.3</td>
                                <td data-label="Target">5</td>
                                <td data-label="Capaian">4</td>
                                <td data-label="Analisis Keberhasilan">Hampir mencapai target.</td>
                                <td data-label="Usulan Target Tahun Depan">6</td>
                                <td data-label="Strategi Pencapaian">Menambah kegiatan penelitian.</td>
                                <td data-label="Sarpras Yang Dibutuhkan">Peralatan riset terbaru.</td>
                                <td data-label="Faktor Pendukung">Kerjasama dengan pihak eksternal.</td>
                                <td data-label="Faktor Penghambat">Kurangnya waktu pelaksanaan.</td>
                                <td data-label="Akar Masalah">Keterbatasan sumber daya manusia.</td>
                                <td data-label="Tindak Lanjut">Merekrut tenaga ahli tambahan.</td>
                            </tr>
                            <tr>
                                <td data-label="No">3</td>
                                <td data-label="Kode Indikator">IK2.4</td>
                                <td data-label="Target">5</td>
                                <td data-label="Capaian">6</td>
                                <td data-label="Analisis Keberhasilan">Melebihi target.</td>
                                <td data-label="Usulan Target Tahun Depan">7</td>
                                <td data-label="Strategi Pencapaian">Meningkatkan efektivitas kerja.</td>
                                <td data-label="Sarpras Yang Dibutuhkan">Alat monitoring tambahan.</td>
                                <td data-label="Faktor Pendukung">Kerja sama tim yang solid.</td>
                                <td data-label="Faktor Penghambat">Keterbatasan waktu.</td>
                                <td data-label="Akar Masalah">Manajemen waktu yang kurang optimal.</td>
                                <td data-label="Tindak Lanjut">Melakukan pelatihan manajemen waktu.</td>
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
