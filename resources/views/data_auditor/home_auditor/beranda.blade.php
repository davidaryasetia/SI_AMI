@extends('layouts.main')
@push('css')
    <style>
        .alert-custom {
            background-color: #d1ecf1;
            color: #0c5460;
            border-color: #bee5eb;
            padding: 15px;
            border-radius: 8px;
        }

        .alert-custom-danger {
            background-color: #ff1c1c;
            color: #ffffff;
            border-color: #dd8d8d;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
@endpush

@section('row')
    <div class="container-fluid">
        <!-- Pengumuman Kegiatan AMI -->
        <div class="row mb-4 d-flex">
            <div class="col-12">
                <h5 class="fw-bold text-dark">Hai, {{ Auth::user()->nama }}! Selamat datang di Dashboard Auditor</h5>
                <div class="col-lg-3">
                    @if ($current_periode && $current_periode->status == 'Sedang Berjalan')
                        <div class="alert alert-custom mt-3" role="alert">
                            <strong>Kegiatan AMI Sedang Berlangsung</strong>
                        </div>
                    @elseif ($current_periode && $current_periode->status == 'Tutup')
                        <div class="alert alert-custom-danger mt-3" role="alert">
                            <strong>Kegiatan AMI Telah Ditutup</strong>
                        </div>
                    @else
                        <div class="alert alert-custom-danger mt-3" role="alert">
                            <strong>Kegiatan AMI Telah Ditutup</strong>
                        </div>
                    @endif

                </div>
            </div>
        </div>


        <!-- Konten Utama -->
        <div class="row">
            <!-- Tabel Data Audite -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Status Finalisasi Pengisian Audite</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Unit</th>
                                        <th>Status Auditor</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomer = 1; ?>
                                    @foreach (session('auditor') as $auditor)
                                        <tr>
                                            <td>{{ $nomer++ }}</td>
                                            <td>{{ $auditor['units']['nama_unit'] }}</td>
                                            <td>
                                                @if ($auditor['units']['status_auditor'] == 'auditor_1')
                                                    Ketua Auditor
                                                @else
                                                    Anggota Auditor
                                                @endif
                                            </td>
                                            <td><span class="badge bg-warning text-dark" style="font-weight: bold">Dalam
                                                    Proses</span></td>
                                        </tr>
                                    @endforeach

                                    <!-- Tambahkan data sesuai kebutuhan -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Jadwal AMI -->
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informasi Jadwal AMI</h5>
                    </div>
                    <div class="card-body">
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
                                    <li class="list-group-item">Status :
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
        <!-- Script tambahan jika diperlukan -->
    @endpush
@endsection
