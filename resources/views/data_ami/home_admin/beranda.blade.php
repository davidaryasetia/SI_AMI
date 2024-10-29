    @extends('layouts.main')

    @section('row')
        <div>
            <!--  Row 1 -->
            <div class="row">
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold">Status Pengisian Data Audit Mutu Internal</h5>
                            <div class="table-responsive">
                                <table id="table_status"
                                    class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4 table-light">
                                        <tr>
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
                                        @foreach ($data_unit as $status)
                                            <tr>
                                                <td colspan="1" class="border-bottom-0">
                                                    <div class="mb-3">
                                                        <h6 class="fw-semibold mb-0">{{ $status->nama_unit }}</h6>
                                                    </div>
                                                    <ul class="unit-list fw-medium">
                                                        @php $nomor = 1; @endphp
                                                        @foreach ($status->units_cabang as $unitCabang)
                                                            <li class="mb-2">
                                                                {{ $nomor++ }}) {{ $unitCabang->nama_unit_cabang }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td colspan="1" class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Data Tidak Tersedia</h6>
                                                </td>
                                                <td colspan="1" class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Data Tidak Tersedia</h6>
                                                </td>
                                            </tr>
                                            {{-- <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1"></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"></h6>

                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"></h6>

                                            </td> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Informasi Jadwal -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header text-white">
                            <h5 class="card-title mb-0">Informasi Jadwal AMI</h5>
                        </div>
                        <div class="card-body" style="padding: 16px">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Tahun: <strong>2024</strong></li>
                                <li class="list-group-item">Periode: <strong>1 Januari - 10 Januari</strong></li>
                                <li class="list-group-item">Keterangan: <strong>Pembukaan AMI</strong></li>
                                <li class="list-group-item">Status: <span class="badge bg-info text-white ms-2">Dalam
                                        Proses</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('script')
            <script>
                // Sembunyikan welcome message
                setTimeout(function() {
                document.getElementById('welcomeMessage').style.display = 'none';
            }, 5000);

                $('#table_status').DataTable({
                    responsive: true,
                    "scrollY": "480px",
                    "pageLenght": 20,
                    "lengthMenu": [
                        [20, 40, 50, 100],
                        [20, 40, 50, 100],
                    ],
                    columns: [{
                            width: '32px'
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
        @endpush
    @endsection
