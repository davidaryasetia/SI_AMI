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
                            <table id="table_status" class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
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
            <div class="col-lg-4">
                <div class="card jadwal-pelaksanaan-card">
                    <div class="card-body">
                        <h5 class="card-title">Jadwal Pelaksanaan AMI</h5>
                        <ul class="jadwal-list">
                            <li><span>Tahun:</span> -</li>
                            <li><span>Periode:</span> -</li>
                            <li><span>Tanggal Pembukaan:</span> -</li>
                            <li><span>Tanggal Penutupan:</span> -</li>
                            <li><span>Keterangan:</span> -</li>
                            <li><span>Status:</span> <span class="status-label">Belum Di Buka</span></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @push('script')
        <script>
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
