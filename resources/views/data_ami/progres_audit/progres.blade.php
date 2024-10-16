@extends('layouts.main')
@push('css')
    <style>
        table td,
        table th {
            vertical-align: middle;
            text-align: center;
            padding: 12px;
            /* Atur padding agar jarak lebih nyaman */
        }

        .progress {
            height: 25px;
        }

        .btn-export {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
@endpush

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title fw-semibold">Sistem Informasi Audit Mutu Internal</h4>
                </div>

                {{-- Progress Status --}}
                <div class="mb-4">
                    <h5 class="fw-bold">Progress = 0%</h5>
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                </div>

                {{-- Keterangan Status --}}
                <div class="mb-3">
                    <span class="me-3"><i class="text-danger">✖</i> = Belum</span>
                    <span><i class="text-success">✔</i> = Sudah</span>
                </div>

                {{-- Tabel Progress Audit --}}
                <div class="table-responsive mt-4">
                    <table class="table table-sm table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Unit</th>
                                <th>Auditee</th>
                                <th>Pengisian</th>
                                <th>Auditor 1</th>
                                <th>Auditor 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>P4MP</td>
                                <td>David <i class="text-danger">✖</i></td>
                                <td>80%</td>
                                <td>Hary <i class="text-danger">✖</i></td>
                                <td>Tita <i class="text-success">✔</i></td>
                            </tr>
                            {{-- Tambahkan baris tabel sesuai data --}}
                        </tbody>
                    </table>
                </div>

                {{-- Tombol Export --}}
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-warning">Export</button>
                </div>
            </div>
        </div>
    </div>

    {{-- JS untuk Progress Bar dan Alert --}}
    @push('script')
        <script>
            // Script untuk menutup alert setelah 5 detik
            setTimeout(function() {
                document.querySelectorAll('.alert').forEach(function(alert) {
                    alert.style.display = "none";
                });
            }, 5000);

            // Script contoh update progress bar secara dinamis (bisa dihubungkan ke data backend)
            let progress = 0; // Contoh nilai progres, sesuaikan dari backend
            document.querySelector('.progress-bar').style.width = progress + '%';
            document.querySelector('.progress-bar').textContent = progress + '%';
        </script>
    @endpush
@endsection
