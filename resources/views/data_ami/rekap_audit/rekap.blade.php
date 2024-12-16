@extends('layouts.main')
@section('title', 'Rekap Audit')
@section('content')
    @push('css')
        <style>
            .table td,
            .table th {
                word-wrap: break-word;
                white-space: normal;
                text-align: left;
                vertical-align: top;
                line-height: 1.4;
            }

            #rekap_per_unit td {
                width: 8px;
                white-space: normal;
                word-wrap: break-word;
                line-height: 1.4 !important;
                text-align: left;
                color: black;
            }

            #detail_rekap_unit td {
                white-space: normal;
                word-wrap: break-word;
                line-height: 1.4 !important;
                text-align: left;
                color: black;
            }

            #rekap_per_indikator td {
                white-space: normal;
                word-wrap: break-word;
                line-height: 1.4 !important;
                text-align: left;
                color: black;
            }

            .status-belum-memenuhi {
                color: red;
                font-weight: bold;
            }

            .status-memenuhi {
                color: blue;
                font-weight: bold;
            }

            .status-melampaui {
                color: green;
                font-weight: bold;
            }


            .tippy-box[data-theme~='custom'] {
                background-color: #ffffff;
                color: #333;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                padding: 10px;
                font-size: 14px;
                line-height: 1.5;
            }

            .tippy-arrow {
                color: #ffffff;
            }
        </style>
    @endpush
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="card-title fw-semibold">Rekap Audit Mutu</h4>
                        </div>
                        <div class="d-flex justify-content-end ms-3">
                            <div class="d-flex justify-content-end">
                                <form id="exportForm" action="{{ route('rekap_audit_unit.export') }}" method="GET">
                                    <input type="hidden" name="jadwal_ami_id" value="{{ $jadwal_ami_id }}">
                                    <button type="submit" id="exportButton" class="btn btn-sm btn-primary">
                                        <i class="ti ti-download"></i> Unduh Rekap Per Unit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
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

                <div class="d-flex justify-content-end" style="position: absolute; top: 72px;right: 40px; z-index: 1050;">
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

                {{-- Nav Tabs for Rekap --}}
                <ul class="nav nav-tabs mb-2" id="rekapTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="rekap-per-unit-tab" data-bs-toggle="tab"
                            data-bs-target="#rekap-per-unit" type="button" role="tab" aria-controls="rekap-per-unit"
                            aria-selected="true">Rekap Per Unit</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rekap-per-indikator-tab" data-bs-toggle="tab"
                            data-bs-target="#rekap-per-indikator" type="button" role="tab"
                            aria-controls="rekap-per-indikator" aria-selected="false">Rekap Per Indikator</button>
                    </li>
                </ul>

                {{-- Tab Content --}}
                <div class="tab-content" id="rekapTabsContent">
                    {{-- Rekap Per Unit --}}
                    <div class="tab-pane fade show active" id="rekap-per-unit" role="tabpanel"
                        aria-labelledby="rekap-per-unit-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="rekap_per_unit">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-bottom-0 text-center" style="padding: 10px;">
                                            <h6 class="fw-semibold mb-0">No</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Unit</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Total Indikator</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Belum Mencapai</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Mecapai Target</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Melebihi Target</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Lihat</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rekapByUnit->isEmpty())
                                        <tr>
                                            <td colspan="7" style="font-size: 16px; color: red">Silahkan Pilih Periode
                                                Pelaksanaan AMI</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @else
                                        <?php $nomer = 1; ?>
                                        @foreach ($rekapByUnit as $data_rekap)
                                            <tr>
                                                <td class="text-center">{{ $nomer++ }}</td>
                                                <td>{{ $data_rekap['nama_unit'] }}</td>
                                                <td>{{ $data_rekap['totalDataIkuk'] }}</td>
                                                <td>{{ $data_rekap['belumMemenuhi'] }}</td>
                                                <td>{{ $data_rekap['memenuhi'] }}</td>
                                                <td>{{ $data_rekap['melampauiTarget'] }}</td>
                                                <td class="text-center"><a href="#" class="" id="tooltip-info"
                                                        data-bs-toggle="modal" data-bs-target="#modalDetail"
                                                        data-unit-id="{{ $data_rekap['unit_id'] }}"
                                                        data-total="{{ $data_rekap['totalDataIkuk'] }}"
                                                        data-belum-memenuhi="{{ $data_rekap['belumMemenuhi'] }}"
                                                        data-memenuhi="{{ $data_rekap['memenuhi'] }}"
                                                        data-melampaui="{{ $data_rekap['melampauiTarget'] }}"
                                                        data-nama-unit="{{ $data_rekap['nama_unit'] }}"
                                                        data-indikator-ikuk='@json($data_rekap['indikator_ikuk'])'>
                                                        <i class="ti ti-eye" style="font-size: 16px; color: blue"></i>
                                                    </a></td>
                                            </tr>
                                        @endforeach

                                        {{-- Tambahkan baris sesuai kebutuhan --}}
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- Modal Rekap Audit Mutu --}}
                    <!-- Modal -->
                    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white" style="color: white; font-weight: bold">
                                    <div class="d-flex align-items-center">
                                        <h5 class="modal-title" id="modalDetailLabel"
                                            style="color: white; font-weight: 500">
                                            Data Detail Indikator Kinerja Unit Kerja
                                        </h5>

                                        {{-- Tooltip Custom dengan Tippy.js --}}
                                        <div id="tooltip-info" class="ms-2 mt-1" style="cursor: pointer;">
                                            <i class="ti ti-info-circle fs-5 text-primary"></i>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p style="font-size: 16px"><strong>Unit:<span id="modalUnitName"></span></strong></p>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="detail_rekap_unit">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 10%; text-align: center;">No</th>
                                                    <th style="width: 10%; text-align: center;">Kode IKUK</th>
                                                    <th style="width: 40%; text-align: center;">Indikator Kinerja</th>
                                                    <th style="width: 15%; text-align: center;">Status</th>
                                                    <th style="width: 10%; text-align: center;">Target</th>
                                                    <th style="width: 10%; text-align: center;">Capaian</th>
                                                </tr>
                                            </thead>
                                            <tbody id="modalTableBody"></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Rekap Per Indikator --}}
                    <div class="tab-pane fade" id="rekap-per-indikator" role="tabpanel"
                        aria-labelledby="rekap-per-indikator-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="rekap_per_indikator">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">No</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Kode Ikuk</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Indikator IKUK</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Target</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Capaian</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Analisis Tindak Lanjut</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($indikatorIkuk->isEmpty())
                                        <td colspan="6" style="font-size: 16px; color: red">Silahkan Pilih Periode
                                            Pelaksanaan AMI</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @else
                                        <?php $nomer = 1; ?>
                                        @foreach ($indikatorIkuk as $index => $indikator)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $indikator->kode_ikuk }}</td>
                                                <td>{{ $indikator->isi_indikator_kinerja_unit_kerja }}</td>
                                                <td>{{ $indikator->target_ikuk }}</td>
                                                <td>{{ $indikator->transaksiDataIkuk->first()->realisasi_ikuk ?? '-' }}
                                                </td>
                                                <td>{{ $indikator->transaksiDataIkuk->first()->tindak_lanjut ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                        {{-- Tambahkan baris sesuai kebutuhan --}}
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                {{-- Tombol Export --}}

            </div>
        </div>
    </div>
@endsection

{{-- FullCalendar JavaScript --}}
@push('script')
    <script>
        // ------------- Data Audit Mutu Internal ------------
        $('#rekap_per_unit').DataTable({
            responsive: true,
            "scrollY": "520px",
            scrollX: true,
            autoWidth: false,
            "pageLength": 50,
            "lengthMenu": [
                [50, 100],
                [50, 100],
            ],
        });
    </script>
    <script>
        // ------------- Data Audit Mutu Internal ------------
        $('#detail_rekap_unit').DataTable({
            responsive: true,
            "pageLength": 50,
            "lengthMenu": [
                [20, 50, 100],
                [20, 50, 100],
            ],
        });

        // ------------- Data Audit Mutu Internal ------------
        $('#rekap_per_indikator').DataTable({
            responsive: true,
            "pageLength": 50,
            "lengthMenu": [
                [50, 100],
                [50, 100],
            ],
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangkap klik pada elemen yang membuka modal
            const detailLinks = document.querySelectorAll('#rekap_per_unit a');

            detailLinks.forEach((link) => {
                link.addEventListener('click', function() {
                    // Ambil data dari atribut data- elemen yang diklik
                    const total = this.getAttribute('data-total');
                    const belumMemenuhi = this.getAttribute('data-belum-memenuhi');
                    const memenuhi = this.getAttribute('data-memenuhi');
                    const melampaui = this.getAttribute('data-melampaui');
                    const namaUnit = this.getAttribute('data-nama-unit');

                    // Update teks dalam modal
                    document.getElementById('modalUnitName').textContent = namaUnit;

                    // Update tooltip konten
                    tippy('#tooltip-info', {
                        content: `
                    <div style="text-align: left;">
                        <strong style="font-size: 16px; color:black;">Total Indikator Kinerja:</strong> <span>${total}</span><br>
                        <strong style="color: #28a745;">Jumlah Melampaui:</strong> <span>${melampaui}</span><br>
                        <strong style="color: #007bff;">Jumlah Memenuhi:</strong> <span>${memenuhi}</span><br>
                        <strong style="color: #dc3545;">Jumlah Belum Memenuhi:</strong> <span>${belumMemenuhi}</span>
                    </div>
                `,
                        allowHTML: true,
                        theme: 'custom',
                        placement: 'bottom',
                        interactive: true,
                        maxWidth: '300px',
                    });
                });
            });
        });
    </script>
    {{-- Script Modal Rekap Per Unit --}}
    <script>
        document.querySelectorAll('a[data-bs-toggle="modal"]').forEach(button => {
            button.addEventListener('click', function() {
                const unitName = this.dataset.namaUnit;
                const indikatorData = JSON.parse(this.dataset.indikatorIkuk);

                document.getElementById('modalUnitName').textContent = unitName;
                const modalTableBody = document.getElementById('modalTableBody');
                modalTableBody.innerHTML = '';

                let no = 1;
                indikatorData.forEach(indikator => {
                    let status = 'Tidak ada Data';
                    let statusClass = '';
                    let capaian = '-';

                    if (indikator.transaksi) {
                        capaian = indikator.transaksi.realisasi_ikuk || '-';
                        if (indikator.transaksi.realisasi_ikuk > indikator.target_ikuk) {
                            status = 'Melampaui';
                            statusClass = 'status-melampaui';
                        } else if (indikator.transaksi.realisasi_ikuk == indikator.target_ikuk) {
                            status = 'Memenuhi'
                            statusClass = 'status-memenuhi';
                        } else {
                            status = 'Belum Memenuhi';
                            statusClass = 'status-belum-memenuhi';
                        }
                    }

                    modalTableBody.innerHTML += `
                        <tr>
                            <td>${no++}</td> 
                            <td>${indikator.kode_ikuk}</td>
                            <td>${indikator.isi_indikator_kinerja_unit_kerja}</td>
                            <td class="${statusClass}">${status}</td>
                            <td>${indikator.target_ikuk}</td>
                            <td>${indikator.transaksi.realisasi_ikuk}</td>
                        </tr>
                    `;
                })
            })
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jadwalSelect = document.getElementById('jadwal_ami_id');

            function updatePage() {
                const jadwalId = jadwalSelect.value;

                if (jadwalId) {
                    window.location.href = `/rekap_audit?jadwal_ami_id=${jadwalId}`;
                } else {
                    window.location.href = `/rekap_audit`;
                }
            }

            // Tambahkan event listener hanya untuk dropdown jadwal
            jadwalSelect.addEventListener('change', updatePage);
        });
    </script>

    {{-- Script button export --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rekapTabs = document.getElementById('rekapTabs');
            const exportForm = document.getElementById('exportForm');
            const exportButton = document.getElementById('exportButton');

            rekapTabs.addEventListener('click', (e) => {
                const selectedTab = e.target.id;

                if (selectedTab === 'rekap-per-unit-tab') {
                    exportForm.action = "{{ route('rekap_audit_unit.export') }}";
                    exportButton.classList.remove('btn-primary');
                    exportButton.classList.add('btn-primary');
                    exportButton.innerHTML = '<i class="ti ti-download"></i> Unduh Rekap Per Unit';
                } else if (selectedTab === 'rekap-per-indikator-tab') {
                    exportForm.action = "{{ route('rekap_audit_indikator.export') }}";
                    exportButton.classList.remove('btn-primary');
                    exportButton.classList.add('btn-primary');
                    exportButton.innerHTML = '<i class="ti ti-download"></i> Unduh Rekap Per Indikator';
                }
            });
        });
    </script>
@endpush
