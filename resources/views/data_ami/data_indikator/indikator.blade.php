@extends('layouts.main')
@section('title', 'Data Indikator AMI')
@push('css')
    <style>
        table#table_indikator tbody td {
            padding: 0px 8px;
        }

        table#table_indikator tbody td th {
            margin: 0;
        }

        .tippy-box[data-theme~='custom'] {
            background-color: whitesmoke
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
                            <a href="#" id="tambahIkukBtn" type="button" class="btn btn-secondary btn-sm"
                                style="pointer-events: none;">
                                <i class="ti ti-plus me-1"></i>Tambah IKUK
                            </a>
                        </div>


                        <div class="me-2">
                            <a id="editAllBtn" class="btn btn-secondary btn-sm" style="pointer-events: none;" disabled>
                                <i class="ti ti-pencil"></i> Edit Semua Indikator
                            </a>
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
                                                    <li>Format File: File harus dalam format .xls atau .xlsx.</li>
                                                    <li>Kolom Wajib: File harus memiliki kolom berikut dengan header yang
                                                        sesuai:
                                                        <ol style="list-style-type: disc">
                                                            <li>Kode: Harus diisi (Text).</li>
                                                            <li>Indikator Kinerja Unit Kerja (IKUK): Harus diisi (Text).
                                                            </li>
                                                            <li>Satuan: Harus diisi (Text).</li>
                                                        </ol>
                                                    </li>
                                                    <li>
                                                        Kolom Opsional: Kolom berikut bersifat opsional dan boleh kosong:
                                                        <ol style="list-style-type: disc">
                                                            <li>Target 1: Boleh diisi dengan angka (Integer) atau dibiarkan
                                                                kosong.</li>
                                                            <li>Target 2: Boleh diisi dengan angka (Integer) atau dibiarkan
                                                                kosong.</li>
                                                            <li>Link: Boleh diisi dengan URL (Text) atau dibiarkan kosong.
                                                            </li>
                                                            <li>Tipe: Boleh diisi dengan angka (Integer) atau dibiarkan
                                                                kosong</li>
                                                        </ol>
                                                    </li>
                                                    <li>
                                                        Penamaan Sheet Unit :
                                                        <ol style="list-style-type: disc">
                                                            <li>Setiap sheet di dalam file mewakili nama unit.</li>
                                                            <li>Nama unit (nama sheet) harus sesuai dengan data unit yang
                                                                telah didefinisikan dalam sistem.</li>
                                                            <li>Jika nama unit belum terdaftar, proses upload akan
                                                                dihentikan, dan pesan kesalahan akan diberikan yang berisi
                                                                daftar unit yang belum terdaftar.</li>
                                                        </ol>
                                                    </li>
                                                    <li>
                                                        Contoh Sample File Data Berikut <br>
                                                        <a href="https://docs.google.com/spreadsheets/d/1ZQvpfo_gGl1NufO822JpLtdwA8E3ThBR/edit?usp=sharing&ouid=106902234954089943700&rtpof=true&sd=true" target="_blank">Sample Data</a>
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

                        <div class="d-flex justify-content-start align-items-center">
                            <form action="{{ route('data_indikator.index') }}" method="GET" class="col-lg-8"
                                id="unitForm">
                                <!-- Hidden Input untuk Jadwal AMI ID -->
                                <input type="hidden" id="jadwal_ami_id_hidden" name="jadwal_ami_id"
                                    value="{{ $jadwal_ami_id }}">

                                <!-- Dropdown Unit -->
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <select id="unit_id" name="unit_id" class="form-select form-select-sm">
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
                            </form>
                            <div id="tooltip-info" class="ms-1 align-items-center" style="cursor: pointer;">
                                <i class="ti ti-info-circle fs-5 text-primary"></i>
                            </div>

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
                                    <h6 class="fw-semibold mb-0 text-center">Target 1</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Target 2</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Link</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Tipe</h6>
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
                                        <h6 class="fw-semibold mb-1 text-center">{{ $dataAmi->target1 }}</h6>
                                    </div>
                                </td>

                                <td class="border-bottom-0">
                                    <div class="">
                                        <h6 class="fw-semibold mb-1 text-center">{{ $dataAmi->target2 }}</h6>
                                    </div>
                                </td>

                                <td class="border-bottom-0">
                                    <div class="">
                                        <h6 class="fw-semibold mb-1 text-center"><a href="{{ $dataAmi->link }}"
                                                target="_blank">{{ $dataAmi->link }}</a></h6>
                                    </div>
                                </td>

                                <td class="border-bottom-0">
                                    <div class="">
                                        <h6 class="fw-semibold mb-1 text-center">{{ $dataAmi->tipe }}</h6>
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
            document.addEventListener('DOMContentLoaded', (event) => {
                const unitSelect = document.getElementById('unit_id'); // Dropdown unit
                const tambahIkukBtn = document.getElementById('tambahIkukBtn'); // Tombol Tambah IKUK
                const unitForm = document.getElementById('unitForm'); // Form unit

                // Fungsi untuk memperbarui status tombol Tambah IKUK
                const updateButtonStatus = () => {
                    if (!unitSelect.value) {
                        // Jika unit belum dipilih
                        tambahIkukBtn.disabled = true;
                        tambahIkukBtn.classList.add('btn-secondary');
                        tambahIkukBtn.classList.remove('btn-primary');
                        tambahIkukBtn.style.pointerEvents = 'none';
                        tambahIkukBtn.href = "#";
                    } else {
                        // Jika unit dipilih
                        tambahIkukBtn.disabled = false;
                        tambahIkukBtn.classList.add('btn-primary');
                        tambahIkukBtn.classList.remove('btn-secondary');
                        tambahIkukBtn.style.pointerEvents = 'auto';
                        tambahIkukBtn.href = `/data_indikator/unit/create/${unitSelect.value}`;
                    }
                };

                updateButtonStatus();
                unitSelect.addEventListener('change', (event) => {
                    updateButtonStatus();
                    unitForm.submit();
                    console.log('Unit changed to: ', event.target.value);
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const unitSelect = document.getElementById('unit_id');
                const editAllBtn = document.getElementById('editAllBtn');

                const updateButtonStatus = () => {
                    if (!unitSelect.value) {
                        editAllBtn.disabled = true;
                        editAllBtn.classList.add('btn-secondary');
                        editAllBtn.classList.remove('btn-primary');
                        editAllBtn.style.pointerEvents = 'none';
                    } else {
                        editAllBtn.disabled = false;
                        editAllBtn.classList.add('btn-primary');
                        editAllBtn.classList.remove('btn-secondary');
                        editAllBtn.style.pointerEvents = 'auto';
                        editAllBtn.href = `/data_indikator/unit/${unitSelect.value}/edit_all`;
                    }
                };

                updateButtonStatus();
                unitSelect.addEventListener('change', updateButtonStatus);
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                tippy('#tooltip-info', {
                    content: `
                    <div style="text-align: left;">
                        <p style="font-size:16px; color:black; font-weight:600">Aturan Perhitungan Capaian Hasil Audit Indikator Berdasarkan Tipe: </p>
                        <ol type=1 style="color:black; ">
                            <li>Tipe 0 : jika realisasi >= target yang diterapkan berarti status realisasi melampaui (Capaian yang lebih besar dari target lebih baik)</li>    
                            <hr>
                            <li>Tipe 1 : jika realisasi <= target yang diterapkan berarti status realiasasi melampaui (Capaian yang lebih kecil dari target akan berstatus lebih baik)</li> 
                            <hr>
                            <li>Tipe 2 (range) : jika realisasi masuk di dalam range pada target 1 dan target 2 yang diterapkan maka, memenuhi, jika di luar range tidak memenuhi</li>
                        </ol>
                    </div>
                `,
                    allowHTML: true,
                    theme: 'custom',
                    placement: 'bottom',
                    interactive: true,
                    maxWidth: '300px'
                });
            });
        </script>
        <!-- Script untuk Submit Form -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const unitSelect = document.getElementById('unit_id');
                const jadwalAmiHidden = document.getElementById('jadwal_ami_id_hidden');

                // Submit form ketika unit dipilih
                unitSelect.addEventListener('change', function() {
                    document.getElementById('unitForm').submit();
                });

                // Update hidden field jadwal_ami_id ketika periode dipilih
                const jadwalSelect = document.getElementById('jadwal_ami_id');
                if (jadwalSelect) {
                    jadwalSelect.addEventListener('change', function() {
                        jadwalAmiHidden.value = this.value;
                        document.getElementById('unitForm').submit();
                    });
                }
            });
        </script>
        <script>
            $('#table_indikator').DataTable({
                responsive: true,
                "scrollY": "640px",
                scrollX: true,
                autoWidth: false,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100],
                    [50, 100],
                ],
            });
        </script>
    @endpush
@endsection
