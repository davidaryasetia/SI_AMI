@extends('layouts.main')

@section('title', 'Home Admin')
@push('css')
    <style>
        .table-responsive {
            overflow-x: auto;
            white-space: nowrap;
        }

        table.dataTable {
            width: 100% !important;
        }

        table.dataTable th,
        table.dataTable td {
            white-space: nowrap;
            text-align: center;
            /* Atur posisi teks */
        }

        #table_status td {
            white-space: normal;
            word-wrap: break-word;
            line-height: 1.4;
            text-align: left;
            color: black;
        }
    </style>
@endpush

@section('content')
    <div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-9 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold">Status Pengisian Data Audit Mutu Internal</h5>
                        <div class="table-responsive">
                            <table id="table_status" class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4 table-light">
                                    <tr>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">No</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Unit/Kegiatan</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Status Finalisasi Audite</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Status Verifikasi Auditor 1</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Status Verifikasi Auditor 2</h6>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1; ?>
                                    @foreach ($dataPengisian as $data)
                                        <tr>
                                            <td>{{ $nomor++ }}</td>
                                            <td>{{ $data['nama_unit'] }}</td>
                                            <td class="text-center">
                                                @if ($data['status_finalisasi_audite'] == true)
                                                    <span class="badge bg-success text-dark" style="font-weight: 600">Data
                                                        Difinalisasi</span>
                                                @else
                                                    <span class="badge bg-warning text-dark" style="font-weight: 600">Dalam
                                                        Proses</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($data['status_finalisasi_auditor1'] == true)
                                                    <span class="badge bg-success text-dark" style="font-weight: 600">Data
                                                        Difinalisasi</span>
                                                @else
                                                    <span class="badge bg-warning text-dark" style="font-weight: 600">Dalam
                                                        Proses</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($data['status_finalisasi_auditor2'] == true)
                                                    <span class="badge bg-success text-dark" style="font-weight: 600">Data
                                                        Difinalisasi</span>
                                                @else
                                                    <span class="badge bg-warning text-dark" style="font-weight: 600">Dalam
                                                        Proses</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Informasi Jadwal -->
            <div class="col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header text-white">
                        <h5 class="card-title mb-0">Informasi Jadwal AMI</h5>
                    </div>
                    <div class="card-body" style="padding: 16px">
                        <ul class="list-group list-group-flush">
                            @if (!empty($current_periode->tanggal_pembukaan_ami) && $current_periode !== null)
                                <li class="list-group-item">Tahun:
                                    <strong>{{ \Carbon\Carbon::parse($current_periode->tanggal_pembukaan_ami)->translatedFormat('Y') }}</strong>
                                </li>

                                <li class="list-group-item">Periode:
                                    <strong>{{ \Carbon\Carbon::parse($current_periode->tanggal_pembukaan_ami)->translatedFormat('d M') }}
                                        -
                                        {{ \Carbon\Carbon::parse($current_periode->tanggal_penutupan_ami)->translatedFormat('d M') }}</strong>
                                </li>
                                <li class="list-group-item">Keterangan:
                                    <strong>{{ $current_periode->nama_periode_ami }}</strong>
                                </li>

                                @if ($current_periode->status == 'Sedang Berjalan')
                                    <li class="list-group-item"> Status :
                                        <span class="badge ms-2"
                                            style=" background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; font-weight: bold">{{ $current_periode->status }}</span>
                                    </li>
                                @else
                                    <li class="list-group-item"> Status :
                                        <span class="badge ms-2"
                                            style=" background-color: #ff0000; color: #ffffff; border-color: #dd8d8d; font-weight: bold">{{ $current_periode->status }}</span>
                                    </li>
                                @endif
                            @else
                                <li class="list-group-item">Tahun:
                                    <strong><span style="color: red">Belum di Set</span></strong>
                                </li>
                                <li class="list-group-item">Periode:
                                    <strong style="color: red">Belum di Set</strong>
                                </li>
                                <li class="list-group-item">Keterangan:
                                    <strong style="color: red">Belum di Set</strong>
                                </li>
                                <li class="list-group-item">Status :
                                    <span class="badge ms-2"
                                        style=" background-color: #ff0000; color: #ffffff; border-color: #dd8d8d; font-weight: bold">Tutup</span>
                                </li>
                            @endif
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
                "scrollY": "640px",
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
    @endpush
@endsection
