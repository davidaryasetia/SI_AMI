@extends('layouts.main')
@section('title', 'Progress Edit')
@push('css')
    <style>
        table th {
            vertical-align: middle;
            text-align: center;
            padding: 12px;
        }

        .progress {
            height: 25px;
        }

        .btn-export {
            padding: 10px 20px;
            font-size: 16px;
        }

        #table_progres td {
            white-space: normal;
            word-wrap: break-word;
            line-height: 1.4;
            text-align: left;
            color: black;
        }

        .progress-bar:hover::after {
            content: attr(title);
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: #333;
            color: #fff;
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 5px;
            white-space: nowrap;
            z-index: 10;
        }

        .text-success {
            font-size: 18px;
            padding-left: 4px;
        }

        .text-danger {
            font-size: 16px;
            padding-left: 4px;
            color: red !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title fw-semibold">Progress Pengisian Audit Mutu Internal</h4>

                        <div class="d-flex ms-1">
                            <div class="d-flex justify-content-end ms-3">
                                <!-- Form Export -->
                                <form id="exportForm" action="{{ route('progres_audit.export') }}" method="GET">
                                    <input type="hidden" name="jadwal_ami_id" value="{{ $jadwal_ami_id }}">
                                    <button type="submit" id="exportButton" class="btn btn-sm btn-primary">
                                        <i class="ti ti-download"></i> Unduh Progress Audit
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


                {{-- Progress Status --}}
                <div class="mb-4">
                    <h5 class="fw-bold">Persentase Pengisian Keseluruhan Audite = {{ $rataPersentasePengisian }}%</h5>
                    <div class="progress" style="height: 25px; position: relative;"
                        title="{{ $rataPersentasePengisian }}%">
                        <div class="progress-bar bg-warning" role="progressbar"
                            style="width: {{ $rataPersentasePengisian }}%" aria-valuenow="{{ $rataPersentasePengisian }}"
                            aria-valuemin="0" aria-valuemax="100">
                            {{ $rataPersentasePengisian > 5 ? $rataPersentasePengisian . '%' : '' }}
                        </div>
                    </div>
                </div>


                {{-- Keterangan Status --}}
                <div class="">
                    <span class="me-3"><i class="text-danger">✖</i> = Belum</span>
                    <span><i class="text-success">✔</i> = Sudah</span>
                </div>

                {{-- Tabel Progress Audit --}}
                <div class="table-responsive mt-2">
                    <table class="table table-sm table-hover table-bordered" id="table_progres">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Finalisasi Auditee</th>
                                <th class="text-center">Persentase Pengisian Audite</th>
                                <th class="text-center">Verifikasi Auditor 1</th>
                                <th class="text-center">Verifikasi Auditor 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($dataPengisian->isEmpty())
                                <tr>
                                    <td colspan="6" style="font-size: 16px; color: red">
                                        Silahkan Pilih Periode Pelaksanaan AMI
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @else
                                @foreach ($dataPengisian as $index => $data)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data['nama_unit'] }}</td>
                                        <td>
                                            {!! $data['audite'] ? $data['audite'] : '<span class="text-danger">User Audite Belum di set!</span>' !!}
                                            {!! $data['status_finalisasi_audite']
                                                ? '<span class="text-success">✔</span>'
                                                : '<span class="text-danger">✖</span>' !!}
                                        </td>
                                        <td>{{ $data['persentase_audite'] }}%</td>
                                        <td>
                                            {!! $data['auditor1'] ? $data['auditor1'] : '<span class="text-danger">Auditor 1 Belum di set!</span>' !!}
                                            {!! $data['status_finalisasi_auditor1']
                                                ? '<span class="text-success">✔</span>'
                                                : '<span class="text-danger">✖</span>' !!}
                                        </td>
                                        <td>
                                            {!! $data['auditor2'] ? $data['auditor2'] : '<span class="text-danger">Auditor 2 Belum di set!</span>' !!}
                                            {!! $data['status_finalisasi_auditor2']
                                                ? '<span class="text-success">✔</span>'
                                                : '<span class="text-danger">✖</span>' !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

    {{-- JS untuk Progress Bar dan Alert --}}
    @push('script')
        <script>
            // Script contoh update progress bar secara dinamis (bisa dihubungkan ke data backend)
            let progress = {{ $rataPersentasePengisian }}; // Contoh nilai progres, sesuaikan dari backend
            document.querySelector('.progress-bar').style.width = progress + '%';
            document.querySelector('.progress-bar').textContent = progress + '%';
        </script>

        <script>
            // ------------- Data Audit Mutu Internal ------------
            $('#table_progres').DataTable({
                responsive: true,
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
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const jadwalSelect = document.getElementById('jadwal_ami_id');

                function updateProgressPage() {
                    const jadwalId = jadwalSelect.value;

                    if (jadwalId) {
                        window.location.href = `/progres_audit?jadwal_ami_id=${jadwalId}`;
                    } else {
                        window.location.href = `/progres_audit`;
                    }
                }

                // Tambahkan event listener hanya untuk dropdown jadwal
                jadwalSelect.addEventListener('change', updateProgressPage);
            });
        </script>
    @endpush
@endsection
