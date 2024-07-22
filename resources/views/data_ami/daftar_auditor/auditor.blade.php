@extends('layouts.main')

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <span class="card-title fw-semibold me-3">Daftar Auditor</span>
                            </div>
                            <div class="me-2">
                                <a href="unit_kerja/create" type="button" class="btn btn-primary"><i
                                        class="ti ti-plus me-1"></i>Tambah List Auditor</a>
                            </div>

                            <!-- Tombol Trigger Modal -->
                            <div class="me-2">
                                <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#importDataModal">
                                    <i class="ti ti-upload me-2"></i>Import Data
                                </a>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="importDataModal" tabindex="-1"
                                aria-labelledby="importDataModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="importDataModalLabel">Import Data Indikator Kinerja
                                                Unit Kerja</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('import.data') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="excel_file" class="form-label">Pilih File Data Indikator
                                                        Kinerja Unit</label>
                                                    <input type="file" name="excel_file" id="excel_file"
                                                        class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <span>Detail Aturan File :</span>
                                                    <ul style="list-style-type: disc; padding-left: 20px;">
                                                        <li>Data Harus Berupa .xls atau .xlsx</li>
                                                        <li>Field Kolom Data:
                                                            <ol disc; padding-left: 20px;">
                                                                <li>Kode [string]</li>
                                                                <li>Indikator Kinerja Unit Kerja [text]</li>
                                                                <li>Satuan [string]</li>
                                                                <li>Target [Integer]</li>
                                                                <li>Unit [String]</li>
                                                            </ol>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="ti ti-upload me-2"></i>Upload File
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div>
                            @if (session('success'))
                                <div class="alert alert-primary" style role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger" style role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>

                        <script>
                            setTimeout(function() {
                                document.querySelectorAll('.alert').forEach(function(alert) {
                                    alert.style.display = "none";
                                });
                            }, 5000);
                        </script>
                    </div>

                    <div class="table-responsive">
                        <table id="table_auditor" class="table table-hover table-bordered text-nowrap mb-0 align-middle">

                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0 text-center" style="width: 10px">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-center">Unit Kerja</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-center">Auditor 1</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-center">Auditor 2</h6>
                                    </th>

                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Edit</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Delete</h6>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($daftar_auditor as $auditor): ?>
                                <tr>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0"> {{ $no++ }} </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="mb-2">
                                            <h6 class="fw-semibold mb-1"> {{ $auditor->units->nama_unit }} </h6>
                                        </div>

                                       <ul class="unit-list" style="color: black">
                                        <?php $nomer=1;?>
                                        @foreach($auditor->units->units_cabang as $unitCabang)
                                        <li class="mb-2">
                                            {{$nomer++}}<span>.)</span>  {{$unitCabang->nama_unit_cabang}}
                                        </li>
                                        @endforeach
                                       </ul>
                                    </td>

                                    <td class="border-bottom-0">
                                        <div class="">
                                            <h6 class="fw-semibold mb-1">
                                                @if (isset($auditor->users_auditor1) && $auditor->users_auditor1 && isset($auditor->users_auditor1->nama))
                                                    {{ $auditor->users_auditor1->nama }}
                                                @else
                                                    <span style="color: red">
                                                        User Auditor 1 Belum Di Set !!!
                                                    </span>
                                                @endif

                                            </h6>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="">
                                            <h6 class="fw-semibold mb-1">
                                                @if (isset($auditor->users_auditor2) && $auditor->users_auditor2 && isset($auditor->users_auditor2->nama))
                                                {{ $auditor->users_auditor2->nama }}
                                            @else
                                                <span style="color: red">
                                                    User Auditor 2 Belum Di Set !!!
                                                </span>
                                            @endif

                                            </h6>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-center"><a href=""><i
                                                    class="ti ti-pencil"></i></a></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <form action="" method="POST"
                                            onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data Unit : ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
