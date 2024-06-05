@extends('layouts.main')

@section('row')
    <div>
        <!--  Row 1 -->
        <div class="row">


            <div class="col-lg-8 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Status Pengisian Data</h5>
                        <div class="table-responsive">
                            <table id="table_status" class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">No</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Unit/Kegiatan</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Status Audite</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Status Auditor</h6>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Data Tidak Tersedia</h6>
                                        </td>
                                        {{-- <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1"></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0"></h6>

                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0"></h6>

                                        </td> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card shadow-none border w-100" style="height:340px">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Pengumuman Pelaksanaan AMI</h5>
                        {{-- Content  --}}
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 label"><span style="color: black; font-weight: bold">Tahun</span></div>
                            <div class="col-lg-6 col-md-6"><span style="color: black">: -</span></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 label"><span style="color: black; font-weight: bold">Periode</span></div>
                            <div class="col-lg-6 col-md-6"><span style="color: black">: -</span></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 label"><span style="color: black; font-weight: bold">Tanggal Pembukaan</span></div>
                            <div class="col-lg-6 col-md-6"><span style="color: black">: -</span></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 label"><span style="color: black; font-weight: bold">Tanggal Penutupan</span></div>
                            <div class="col-lg-6 col-md-6"><span style="color: black">: -</span></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 label"><span style="color: black; font-weight: bold">Keterangan</span></div>
                            <div class="col-lg-6 col-md-6"><span style="color: black">: -</span></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 label"><span style="color: black; font-weight: bold">Status</span></div>
                            <div class="col-lg-6 col-md-6"><span style="color: black">: -</span></div>
                        </div>
                        {{-- END - Content  --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
