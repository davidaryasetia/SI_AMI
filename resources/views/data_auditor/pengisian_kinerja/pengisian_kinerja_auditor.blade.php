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
                        <h5 style="color: black; margin-bottom: 12px">Sistem Informasi Audit Mutu Internal</h5>
                        <p style="color: black">Pengisian evaluasi unit : {{ $nama_unit }}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <span>Progres evaluasi: 60% (2 dari 3)</span>
                    </div>
                    <div class="col-lg-2">
                        <select id="unit_id" class="form-select text-black" style="border-radius: 12px;">
                            <option value="">Pilih Unit Kerja</option>
                            @foreach (session('auditor') as $auditor)
                                <option value="{{ $auditor['units']['unit_id'] }}"
                                    {{ request('unit_id') == $auditor['units']['unit_id'] ? 'selected' : '' }}>
                                    {{ $auditor['units']['nama_unit'] }}</option>
                            @endforeach
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
                                <th>Satuan</th>
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
                            <?php $nomer = 1; ?>
                            @foreach ($data_ami as $data)
                                <tr>
                                    <td>{{ $nomer++ }}</td>
                                    <td>{{ $data['kode_ikuk'] }}</td>
                                    <td>{{ $data['isi_indikator_kinerja_unit_kerja'] }}</td>
                                    <td>{{ $data['satuan_ikuk'] }}</td>
                                    <td>{{ $data['target_ikuk'] }}</td>
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
                                    <td></td>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const unitSelect = document.getElementById('unit_id');

            unitSelect.addEventListener('change', function() {
                const unitId = unitSelect.value;

                if (unitId) {
                    window.location.href = `/data_indikator_auditor?unit_id=${unitId}`;
                } else {
                    window.location.href = `/data_indikator_auditor`;
                }
            })
        })
    </script>
@endpush
