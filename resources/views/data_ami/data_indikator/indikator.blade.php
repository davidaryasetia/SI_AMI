@extends('layouts.main')
@section('title', 'Data Indikator AMI')
@push('css')
    <style>
        table#table_indikator tbody td{
            padding: 0px 8px;
        }
        table#table_indikator tbody td th{
            margin: 0;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center mb-2">
                        <div>
                            <span class="card-title fw-semibold me-2">Indikator Kinerja Unit Kerja</span>
                        </div>
                        <div class="me-2">
                            <a href="#" id="tambahIkukBtn" type="button" class="btn btn-primary" disabled><i
                                    class="ti ti-plus me-1"></i>Tambah IKUK</a>
                        </div>

                        <!-- Tombol Trigger Modal -->
                        <div class="me-2">
                            <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#importDataModal">
                                <i class="ti ti-upload me-1"></i>Import Data
                            </a>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="importDataModal" tabindex="-1" aria-labelledby="importDataModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="importDataModalLabel">Import Data Indikator Kinerja
                                            Unit Kerja</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('import.dataIndikator') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="excel_file" class="form-label">Pilih File Data Indikator
                                                    Kinerja Unit</label>
                                                <input type="file" name="excel_file" id="excel_file" class="form-control"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <span>Detail Aturan File :</span>
                                                <ul style="list-style-type: decimal; padding-left: 20px;">
                                                    <li>Conth sample File : </li>
                                                    <li>Data Harus Berupa .xls</li>
                                                    <li>Field Kolom Data:
                                                        <ol class="data-list"
                                                            style="list-style-type: disc; padding-left: 20px;">
                                                            <li>Kode Column [Text]</li>
                                                            <li>Indikator Kinerja Unit Kerja [Text]</li>
                                                            <li>Satuan [text]</li>
                                                            <li>Target [Integer]</li>
                                                            <li>Unit [Text]</li>
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
                        <!-- Modal -->

                        <div class="d-flex justify-content-start">
                            <form action="{{ route('data_indikator.index') }}" method="GET" class="col-lg-8"
                                id="unitForm">
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <div class="">
                                            <select id="unit_id" name="unit_id" class="form-select">
                                                <option value="">Pilih Unit....</option>
                                                <option value="">Semual Unit</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit['unit_id'] }}"
                                                        {{ $unit['unit_id'] == $unit_id ? 'selected' : '' }}>
                                                        {{ $unit['nama_unit'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="alert-container">
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
                    <script>
                        document.addEventListener('DOMContentLoaded', (event) => {
                            const unitSelect = document.getElementById('unit_id');
                            const tambahIkukBtn = document.getElementById('tambahIkukBtn');

                            if (!unitSelect.value) {
                                tambahIkukBtn.disabled = true;
                            } else {
                                tambahIkukBtn.disabled = false;
                                tambahIkukBtn.href = `/data_indikator/unit/create/${unitSelect.value}`;
                            }

                            unitSelect.addEventListener('change', (event) => {
                                if (event.target.value) {
                                    tambahIkukBtn.disabled = false;
                                    tambahIkukBtn.href = `/data_indikator/unit/create/${event.target.value}`;
                                } else {
                                    tambahIkukBtn.disabled = true;
                                    tambahIkukBtn.onclick = null;
                                    tambahIkukBtn.href = "#";
                                }

                                unitForm.submit();
                                console.log('Unit changed to: ', event.target.value);
                            });
                        });
                    </script>
                </div>

                <div class="table-responsive">
                    <table id="table_indikator" class="table table-hover table-bordered text-nowrap mb-0 align-middle"
                        style="width:100%">
                        <thead class="text-dark fs-4 table-light">
                            <tr>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Kode</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Indikator Kinerja Unit Kerja</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Satuan</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Target</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Unit</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Edit</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Hapus</h6>
                                </th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($data_ami as $dataAmi): ?>
                            <tr>
                                <td class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0"> {{ $no++ }} </h6>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0"> {{ $dataAmi->kode_ikuk }} </h6>
                                </td>

                                <td class="border-bottom-0"
                                    style="width: 40%; white-space: pre-line; word-wrap: break-word; text-align: left; color: black;">
                                    <div class="">
                                        <h6 class="fw-semibold mb-1"> {{ $dataAmi->isi_indikator_kinerja_unit_kerja }}
                                        </h6>
                                    </div>
                                </td>

                                <td class="border-bottom-0">
                                    <div class="">
                                        <h6 class="fw-semibold mb-1 text-center"> {{ $dataAmi->satuan_ikuk }} </h6>
                                    </div>
                                </td>

                                <td class="border-bottom-0">
                                    <div class="">
                                        <h6 class="fw-semibold mb-1 text-center"> {{ $dataAmi->target_ikuk }} </h6>
                                    </div>
                                </td>

                                <td class="border-bottom-0">
                                    <div class="">
                                        <h6 class="fw-semibold mb-1 text-center"> {{ $dataAmi->nama_unit }} </h6>
                                    </div>
                                </td>

                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal text-center"><a
                                            href="{{ route('data_indikator.edit', $dataAmi->indikator_kinerja_unit_kerja_id) }}"><i
                                                class="ti ti-pencil"></i></a></p>
                                </td>
                                <td class="border-bottom-0">
                                    <form
                                        action="{{ route('data_indikator.destroyWithUnit', ['indikator_id' => $dataAmi->indikator_kinerja_unit_kerja_id, 'unit_id' => $dataAmi->unit_id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data Indikator Unit Kerja : <?php echo $dataAmi->isi_indikator_kinerja_unit_kerja; ?> ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $('#table_indikator').DataTable({
                responsive: true,
                "scrollY": "480px",
                "pageLength": 20, // Set initial page length to 5
                "lengthMenu": [
                    [20, 30, 40, 50, 100],
                    [20, 30, 40, 50, 100],
                ],
                columns: [{
                        width: '6px'
                    },
                    {
                        width: '6px'
                    },
                    null,
                    {
                        width: '10px'
                    },
                    {
                        width: '10px'
                    },
                    {
                        width: '10px'
                    },
                    {
                        width: '10px'
                    },
                    {
                        width: '10px'
                    },
                ]
            });
        </script>
    @endpush
@endsection
