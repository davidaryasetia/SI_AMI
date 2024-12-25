@extends('layouts.main')
@section('title', 'Rekap Persetujuan Auditor')
@push('css')
    <style>
        .header-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .sub-header {
            font-size: 1.1rem;
            color: gray;
            text-align: center;
            margin-bottom: 20px;
        }

        .table-responsive {
            margin-top: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: middle;
        }

        .table th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        .dropdown-unit {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .dropdown-unit:hover {
            background-color: #45a049;
        }

        .approval-box {
            border: 2px solid #0066cc;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
            background-color: #f5faff;
            color: #333;
            font-size: 1rem;
        }

        .approval-text {
            font-style: italic;
            color: #333;
            line-height: 1.5;
        }

        .approval-date {
            font-weight: bold;
            margin-top: 15px;
        }

        .approval-signature {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
            font-weight: bold;
            margin-top: 15px;
        }

        .approval-signature img {
            width: 20px;
            height: 20px;
        }

        /* Icon Check and Cross */
        .icon-check {
            color: green;
            font-size: 1.5rem;
        }

        .icon-cross {
            color: red;
            font-size: 1.5rem;
        }

        . .btn[disabled] {
            background-color: grey;
            border-color: grey;
            color: white;
            cursor: not-allowed;
            /* Pointer berubah menjadi tanda larangan */
        }

        /* Tombol aktif */
        .btn.btn-success {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .btn.btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
@endpush

@section('content')
    {{-- @dump($dataTransaksi->toArray()) --}}
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 style="color: black">Rekap Evaluasi Audit dan Persetujuan Unit</h5>
                    </div>
                </div>

                <div class="d-flex justify-content-end col-lg-8"
                    style="position: absolute; top: 72px;right: 40px; z-index: 1050;">
                    @if (session('success'))
                        <div class="alert alert-primary  col-lg-8" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger  col-lg-8" role="alert">
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
                {{-- End Header --}}

                {{-- Table Content --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="persetujuanAuditor">
                        <thead class="table-light">
                            <tr>
                                <th class="border-bottom-0 text-center">
                                    <h6 class= "fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Unit</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Status Auditor</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Progres Evaluasi Auditor</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Persetujuan Auditor</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($dataTransaksi as $data)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $data['nama_unit'] }}</td>
                                    <td>
                                        @if ($data['is_ketua_auditor'] == true && $data['is_anggota_auditor'] == false)
                                            Ketua Auditor
                                        @elseif ($data['is_ketua_auditor'] == false && $data['is_anggota_auditor'] == true)
                                            Anggota Auditor
                                        @else
                                            <span style="color: red">Data Belum Di Set!!!</span>
                                        @endif
                                    </td>
                                    <td>{{ $data['persentasePengisianAuditor'] }}%</td>
                                    <td>
                                        @if ($data['is_ketua_auditor'] == true && $data['is_anggota_auditor'] == false)
                                            @if ($data['statusFinalisasiAuditor1'] == false)
                                                <span class=""><i class="ti ti-circle"
                                                        style="color: red; font-weight: bold; font-size: 18px"></i></span>
                                            @elseif ($data['statusFinalisasiAuditor1'] == true)
                                                <span class="" style=""><i class="ti ti-check text-success"
                                                        style="font-weight: bold; font-size: 18px"></i></span>
                                            @endif
                                        @endif

                                        @if ($data['is_ketua_auditor'] == false && $data['is_anggota_auditor'] == true)
                                            @if ($data['statusFinalisasiAuditor2'] == false)
                                                <span class=""><i class="ti ti-circle"
                                                        style="color: red; font-weight: bold; font-size: 18px"></i></span>
                                            @elseif ($data['statusFinalisasiAuditor2'] == true)
                                                <span class=""><i class="ti ti-check text-success"
                                                        style="font-weight: bold; font-size: 18px"></i></span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                {{-- END Table Content --}}
                {{-- @dump($dataTransaksi->toArray()) --}}
                {{-- Approval Content --}}
                <div class="approval-box">
                    <div class="col-lg-2">
                        <select id="unit-select" class="form-select text-white bg-primary"
                            style="border-radius: 12px; color: white">
                            <option class="text-white" value="" style="color: white">Pilih Unit Kerja</option>
                            @foreach ($dataTransaksi as $data)
                                {{-- @dump($data) --}}
                                <option class="text-white" value="{{ $data['unit_id'] }}"
                                    data-unit-name="{{ $data['nama_unit'] }}"
                                    data-is-ketua-auditor={{ $data['is_ketua_auditor'] ? 'true' : 'false' }}
                                    data-is-anggota-auditor={{ $data['is_anggota_auditor'] ? 'true' : 'false' }}
                                    data-status-finalisasi-auditor1="{{ $data['statusFinalisasiAuditor1'] ? true : false }}"
                                    data-status-finalisasi-auditor2="{{ $data['statusFinalisasiAuditor2 '] ? true : false }}"
                                    data-tanggal-finalisasi="{{ $data['tanggalFinalisasi'] }}">
                                    {{ $data['nama_unit'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <p class="approval-text mt-3">
                            "Dengan ini saya menyatakan bahwa evaluasi terhadap unit <span id="unit-name-placeholder"
                                style="font-weight: bold;"></span> telah selesai dilaksanakan dengan benar dan telah
                            disepakati bersama dengan auditee."
                        </p>
                        <p class="">Surabaya, <span class="approval-date"></span></p>
                        <p class="approval-role mb-2" id="auditor-role" style="font-weight: bold"><span></span></p>
                        <p>{{ Auth::user()->nama }}</p>
                    </div>

                    <form id="approval-form" action="{{ route('rekap_persetujuan_auditor.finalisasi') }}" method="POST">
                        @csrf
                        <input type="hidden" id="selected-unit-id" name="unit_id">
                        <div class="approval-signature"
                            style="display: flex; justify-content: center; align-items: center; gap: 8px;">
                            <label for="approvalCheck" style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" id="approvalCheck" name="approvalCheck"
                                    style="width: 20px; height: 20px;">
                                <span>Setuju</span>
                            </label>
                        </div>

                        <div class="mt-3 text-center">
                            <button type="submit" id="submit-button" class="btn btn-success" disabled>Submit</button>
                        </div>

                    </form>
                </div>
                {{-- End Approval Content --}}

            </div>
        </div>
    </div>
    @push('script')
        <script>
            $('#persetujuanAuditor').DataTable({
                responsive: true,
                scrollX: true,
                autoWidth: false,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100],
                    [50, 100],
                ],

                columns: [{
                        width: '10px'
                    },
                    {
                        width: '32px'
                    },
                    {
                        width: '12px'
                    },
                    {
                        width: '12px'
                    },
                    {
                        width: '12px'
                    },
                ]
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const unitSelect = document.getElementById("unit-select");
                const unitNamePlaceholder = document.getElementById("unit-name-placeholder");
                const approvalCheck = document.getElementById("approvalCheck");
                const approvalDate = document.querySelector(".approval-date");
                const auditorRole = document.getElementById("auditor-role");
                const submitButton = document.getElementById("submit-button");
                const hiddenUnitIdInput = document.getElementById("selected-unit-id");

                // Fungsi untuk memvalidasi apakah unit kerja sudah dipilih
                function validateSelection() {
                    const selectedOption = unitSelect.options[unitSelect.selectedIndex];
                    const unitSelected = unitSelect.value != ""; // Cek jika unit dipilih
                    const isKetuaAuditor = selectedOption.getAttribute("data-is-ketua-auditor") == 'true';
                    const isAnggotaAuditor = selectedOption.getAttribute("data-is-anggota-auditor") == 'true';
                    const statusFinalisasiAuditor1 = selectedOption.getAttribute('data-status-finalisasi-auditor1') ==
                        true;
                    const statusFinalisasiAuditor2 = selectedOption.getAttribute('data-status-finalisasi-auditor2') ==
                        true;

                    if (!unitSelected) {
                        approvalCheck.disabled = true;
                        submitButton.disabled = true;
                    } else if (isKetuaAuditor && statusFinalisasiAuditor1) {
                        approvalCheck.disabled = true;
                        submitButton.disabled = true;
                    } else if (isAnggotaAuditor && statusFinalisasiAuditor2) {
                        approvalCheck.disabled = true;
                        submitButton.disabled = true;
                    } else {
                        approvalCheck.disabled = !unitSelect;
                        submitButton.disabled = !unitSelect || !approvalCheck.checked;
                    }
                }

                // Event listener untuk dropdown
                unitSelect.addEventListener("change", function() {
                    const selectedOption = unitSelect.options[unitSelect.selectedIndex];
                    const unitName = selectedOption.getAttribute("data-unit-name");
                    const isKetuaAuditor = selectedOption.getAttribute("data-is-ketua-auditor") == 'true';
                    const isAnggotaAuditor = selectedOption.getAttribute("data-is-anggota-auditor") == 'true';
                    const tanggalFinalisasi = selectedOption.getAttribute("data-tanggal-finalisasi");

                    unitNamePlaceholder.textContent = unitName || "____";

                    if (tanggalFinalisasi) {
                        approvalDate.textContent = `${tanggalFinalisasi}`;
                    } else {
                        approvalDate.textContent = "Tanggal tidak tersedia";
                    }

                    if (isKetuaAuditor) {
                        auditorRole.textContent = "Ketua Auditor";
                    } else if (isAnggotaAuditor) {
                        auditorRole.textContent = "Anggota Auditor";
                    } else {
                        auditorRole.textContent = "Tidak Terdaftar sebagai Auditor";
                    }

                    hiddenUnitIdInput.value = selectedOption.value || "";
                    validateSelection(); // Validasi ulang setelah dropdown diubah
                });

                // Event listener untuk checkbox
                approvalCheck.addEventListener("change", function() {
                    validateSelection(); // Validasi ulang setelah checkbox berubah
                });

                // Validasi awal saat halaman dimuat
                validateSelection();
            });
        </script>
    @endpush
@endsection
