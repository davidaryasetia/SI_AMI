@extends('layouts.main_audite')
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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title fw-semibold">Progress Pengisian Kinerja Audite</h4>
                </div>

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
                                <td data-label="Analisis Keberhasilan">...</td>
                                <td data-label="Usulan Target Tahun Depan">...</td>
                                <td data-label="Strategi Pencapaian">...</td>
                                <td data-label="Sarpras Yang Dibutuhkan">...</td>
                                <td data-label="Faktor Pendukung">...</td>
                                <td data-label="Faktor Penghambat">...</td>
                                <td data-label="Akar Masalah">...</td>
                                <td data-label="Tindak Lanjut">...</td>
                            </tr>
                            <!-- Add more rows as needed -->
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
