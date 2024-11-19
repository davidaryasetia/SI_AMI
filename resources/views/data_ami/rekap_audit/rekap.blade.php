@extends('layouts.main')
@section('title', 'Rekap Audit')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title fw-semibold">Rekap Audit Mutu</h4>
                </div>

                {{-- Nav Tabs for Rekap --}}
                <ul class="nav nav-tabs mb-4" id="rekapTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="rekap-per-unit-tab" data-bs-toggle="tab"
                            data-bs-target="#rekap-per-unit" type="button" role="tab"
                            aria-controls="rekap-per-unit" aria-selected="true">Rekap Per Unit</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rekap-per-indikator-tab" data-bs-toggle="tab"
                            data-bs-target="#rekap-per-indikator" type="button" role="tab"
                            aria-controls="rekap-per-indikator" aria-selected="false">Rekap Per Indikator</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rekap-akreditasi-tab" data-bs-toggle="tab"
                            data-bs-target="#rekap-akreditasi" type="button" role="tab"
                            aria-controls="rekap-akreditasi" aria-selected="false">Rekap Akreditasi</button>
                    </li>
                </ul>

                {{-- Tab Content --}}
                <div class="tab-content" id="rekapTabsContent">
                    {{-- Rekap Per Unit --}}
                    <div class="tab-pane fade show active" id="rekap-per-unit" role="tabpanel"
                        aria-labelledby="rekap-per-unit-tab">
                        <h5 class="mb-4">Rekap per Unit</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Unit</th>
                                        <th>Total IK</th>
                                        <th>Belum Mencapai</th>
                                        <th>Mencapai Target</th>
                                        <th>Melebihi Target</th>
                                        <th>Lihat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>P4MP</td>
                                        <td>120</td>
                                        <td>20</td>
                                        <td>90</td>
                                        <td>10</td>
                                        <td><a href="#">V</a></td>
                                    </tr>
                                    {{-- Tambahkan baris sesuai kebutuhan --}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Rekap Per Indikator --}}
                    <div class="tab-pane fade" id="rekap-per-indikator" role="tabpanel"
                        aria-labelledby="rekap-per-indikator-tab">
                        <h5 class="mb-4">Rekap per Indikator</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode</th>
                                        <th>Indikator</th>
                                        <th>Target</th>
                                        <th>Unit yang Mencapai Target</th>
                                        <th>Rekomendasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>IK2.2</td>
                                        <td>Jumlah publikasi minimal tiap tahun</td>
                                        <td>5</td>
                                        <td>70%</td>
                                        <td>Belum dapat ditingkatkan</td>
                                    </tr>
                                    {{-- Tambahkan baris sesuai kebutuhan --}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Rekap Akreditasi --}}
                    <div class="tab-pane fade" id="rekap-akreditasi" role="tabpanel"
                        aria-labelledby="rekap-akreditasi-tab">
                        <h5 class="mb-4">Rekap Akreditasi</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kriteria</th>
                                        <th>Kode</th>
                                        <th>Indikator</th>
                                        <th>Target</th>
                                        <th>Capaian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>C2</td>
                                        <td>IKU2.2</td>
                                        <td>Jumlah paper</td>
                                        <td>5</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>C2</td>
                                        <td>IKU3.3</td>
                                        <td>Jumlah paten</td>
                                        <td>5</td>
                                        <td>6</td>
                                    </tr>
                                    {{-- Tambahkan baris sesuai kebutuhan --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Tombol Export --}}
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-warning">Export</button>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- FullCalendar JavaScript --}}
@push('scripts')
    {{-- Script tambahan jika dibutuhkan --}}
@endpush
