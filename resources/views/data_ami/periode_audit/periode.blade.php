@extends('layouts.main')
@push('css')
    <style>
        table td,
        table th {
            vertical-align: middle;
            /* Align center vertically */
            /* Align center horizontally */
        }

        .btn-sm {
            padding: 4px 10px;
            /* Adjust button padding for consistency */
        }
    </style>
@endpush
@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="d-flex align-items-center mb-4">
                    <h4 class="card-title fw-semibold">Pengaturan Periode Audit</h4>
                    {{-- <a href="{{route('periode_audit.create')}}" id="tambahIkukBtn" class="btn btn-primary ms-3">
                        <i class="ti ti-plus me-1"></i> Tambah Periode
                    </a> --}}
                </div>

                {{-- Form Input Periode --}}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="namaPeriode" class="form-label">Nama Periode AMI</label>
                            <input type="text" class="form-control" id="namaPeriode" placeholder="Nama Periode AMI">
                        </div>
                        <div class="form-group mb-3">
                            <label for="mulai" class="form-label">Mulai</label>
                            <input type="date" class="form-control" id="mulai">
                        </div>
                        <div class="form-group mb-3">
                            <label for="selesai" class="form-label">Selesai</label>
                            <input type="date" class="form-control" id="selesai">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-select" id="tahun">
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <!-- Tambahkan tahun sesuai kebutuhan -->
                            </select>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button type="button" class="btn btn-primary">Tambah Periode</button>
                        </div>
                    </div>
                </div>


                {{-- Tabel Periode AMI --}}
                <div class="table-responsive mt-4">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr class="">
                                <th>No.</th>
                                <th>Nama Periode AMI</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Tahun 2024</td>
                                <td>1 Jan 2024</td>
                                <td>10 Jan 2024</td>
                                <td><a href="#" class="btn btn-sm btn-warning">V</a></td>
                                <td><a href="#" class="btn btn-sm btn-danger">X</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Tahun 2023</td>
                                <td>10 Nov 2023</td>
                                <td>1 Des 2023</td>
                                <td><a href="#" class="btn btn-sm btn-warning">V</a></td>
                                <td><a href="#" class="btn btn-sm btn-danger">X</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- FullCalendar JavaScript --}}
@push('scripts')
@endpush
