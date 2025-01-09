@extends('layouts.main')

@section('title', 'Data Unit')
@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-3">
                            <span class="card-title fw-semibold">Daftar Unit Kerja</span>
                        </div>
                        <div class="me-2">
                            <a href="data_unit/create" type="button" class="btn btn-primary btn-sm"><i
                                    class="ti ti-plus me-1"></i>Tambah Unit | Departement</a>
                        </div>
                        <div class="me-2">
                            <a href="{{ route('data_unit.editAll') }}" type="button" class="btn btn-primary btn-sm"><i
                                    class="ti ti-pencil me-1"></i>Edit Semua Unit</a>
                        </div>
                        <!-- Tombol Trigger Modal -->
                        <div class="me-2">
                            <a href="#" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
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
                                        <h5 class="modal-title" id="importDataModalLabel" style="font-weight: 600">Import Data Unit Kerja
                                        </h5>
                                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('import.dataUnit') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="excel_file" class="form-label" style="font-weight: 500">Pilih File Unit Kerja</label>
                                                <input type="file" name="file" id="file" class="form-control"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <span>Detail Aturan File :</span>
                                                <ul style="list-style-type: decimal; padding-left: 20px;">
                                                    <li>Format file harus dalam bentuk .xls atau .xlsx.</li>
                                                    <li>Template yang digunakan harus sesuai dengan format yang telah ditentukan.</li>
                                                    <li>Data yang akan diunggah akan diidentifikasi berdasarkan kolom yang tersedia dalam file Excel. Pastikan semua data valid sebelum diunggah.</li>
                                                    <li>Format data dapat diunggah pada link berikut : <br>
                                                    <a href="https://docs.google.com/spreadsheets/d/1mgBvsLyJxnyHRmjJ6PE1vqMj7BhhxGJ6/edit?usp=sharing&ouid=106902234954089943700&rtpof=true&sd=true" target="_blank">Data Dukung</a>
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
                            <!-- Form Unit -->
                            <form action="{{ route('data_unit.index') }}" method="GET" class="col-lg-12" id="unitForm">
                                <div class="d-flex align-items-center">
                                    <!-- Dropdown Unit Type -->
                                    <div class="me-2">
                                        <select id="unit_type" name="unit_type" class="form-select form-select-sm">
                                            <option value="all" {{ request('unit_type') == 'all' ? 'selected' : '' }}>
                                                Filter Unit / Departement....
                                            </option>
                                            <option value="unit_kerja"
                                                {{ request('unit_type') == 'unit_kerja' ? 'selected' : '' }}>
                                                Unit Kerja
                                            </option>
                                            <option value="departemen_kerja"
                                                {{ request('unit_type') == 'departemen_kerja' ? 'selected' : '' }}>
                                                Departement Kerja
                                            </option>
                                        </select>
                                    </div>
                                    <!-- Hidden Field for Jadwal -->
                                    <input type="hidden" id="jadwal_ami_id_hidden" name="jadwal_ami_id"
                                        value="{{ request('jadwal_ami_id') }}">
                                </div>
                            </form>
                        </div>



                    </div>

                    <div class="d-flex justify-content-end"
                        style="position: absolute; top: 72px;right: 40px; z-index: 1050;">
                        @if (session('success'))
                            <div class="alert alert-primary  col-lg-12" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger  col-lg-12" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    <script>
                        setTimeout(function() {
                            document.querySelectorAll('.alert').forEach(function(alert) {
                                alert.style.display = "none";
                            });
                        }, 3000);
                    </script>

                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <div class="col-lg-12">
                                <select id="jadwal_ami_id" name="jadwal_ami_id" class="form-select text-black"
                                    style="border-radius: 12px;color: black">
                                    <option value="">Pilih Periode AMI</option>
                                    @foreach ($jadwalPeriode as $jadwal)
                                        <option value="{{ $jadwal->jadwal_ami_id }}"
                                            {{ $jadwal_ami_id == $jadwal->jadwal_ami_id ? 'selected' : '' }}>
                                            {{ $jadwal->nama_periode_ami }} :
                                            {{ \Carbon\Carbon::parse($jadwal->tanggal_pembukaan_ami)->translatedFormat('d M') }}
                                            -
                                            {{ \Carbon\Carbon::parse($jadwal->tanggal_penutupan_ami)->translatedFormat('d M') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="table_unit" class="table table-hover table-bordered text-nowrap mb-0 align-middle">

                        <thead class="text-dark fs-4 table-light">
                            <tr>
                                <th class="border-bottom-0 text-center" style="width: 10px">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Unit Kerja</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Edit</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Delete</h6>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($data_unit as $unit): ?>
                            <tr>
                                <td class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0"> {{ $no++ }} </h6>
                                </td>
                                <td class="border-bottom-0 ">
                                    <h6 class="fw-semibold mb-2"> {{ $unit->nama_unit }} </h6>
                                    <ul class="unit-list fw-medium">
                                        @php $nomor = 1; @endphp
                                        @foreach ($unit->units_cabang as $unitCabang)
                                            <li class="mb-2">
                                                {{ $nomor++ }}. {{ $unitCabang->nama_unit_cabang }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>


                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal text-center"><a
                                            href="{{ route('data_unit.edit', $unit->unit_id) }}"><i
                                                class="ti ti-pencil"></i></a></p>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <form action="{{ route('data_unit.destroy', $unit->unit_id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data Unit : {{ $unit->nama_unit }} ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- JS --}}
    @push('script')
        <script>
            // Submit Form on Unit Type Change
            document.getElementById('unit_type').addEventListener('change', function() {
                document.getElementById('unitForm').submit();
            });

            // Update Hidden Jadwal ID and Submit on Change
            document.addEventListener('DOMContentLoaded', function() {
                const jadwalSelect = document.getElementById('jadwal_ami_id'); // Jadwal Dropdown
                const hiddenJadwalInput = document.getElementById('jadwal_ami_id_hidden');

                if (jadwalSelect) {
                    jadwalSelect.addEventListener('change', function() {
                        hiddenJadwalInput.value = jadwalSelect.value;
                        document.getElementById('unitForm').submit();
                    });
                }
            });
        </script>
        <script>
            // ------------- Data Audit Mutu Internal ------------
            $('#table_unit').DataTable({
                responsive: true,
                "scrollY": "640px",
                scrollX: true,
                autoWidth: false,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100],
                    [50, 100],
                ],
                "columnDefs": [{
                    targets: 0, // Target kolom "No"
                    width: '2%' // Sesuaikan persentase lebar kolom
                }],
                columns: [{
                        width: '2%' // Sesuaikan dengan kebutuhan (kolom No)
                    },
                    {
                        width: '50%' // Sesuaikan dengan kebutuhan (kolom Unit Kerja)
                    },
                    {
                        width: '15%' // Sesuaikan dengan kebutuhan (kolom Edit)
                    },
                    {
                        width: '15%' // Sesuaikan dengan kebutuhan (kolom Delete)
                    },
                ]
            });
        </script>
    @endpush
@endsection
