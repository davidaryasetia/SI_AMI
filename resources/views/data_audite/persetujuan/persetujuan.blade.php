{{-- @dump($audite) --}}
{{-- @dump($auditor1) --}}
{{-- @dump($auditor2) --}}

@extends('layouts.main')
@section('title', 'Form Persetujuan')
@push('css')
    <style>
        .approval-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        .approval-box {
            width: 100%;
            max-width: 800px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }

        .approval-text {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 30px;
            color: #333;
        }

        .approval-signature {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 20px;
        }

        .signature-section {
            text-align: center;
        }

        .signature-icon {
            font-size: 40px;
            color: #f03e3e;
            /* Warna lebih kalem */
        }

        .signature-approved {
            font-size: 40px;
            color: #38c172;
            /* Warna hijau lebih soft */
        }

        .signature-text {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
            color: #333;
        }

        .signature-details {
            font-size: 14px;
            color: #555;
        }

        .form-section {
            margin-top: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .disabled-btn {
            background-color: #d6d6d6;
            /* Warna abu-abu */
            color: #999;
            /* Warna teks abu-abu */
            border: 1px solid #ccc;
            cursor: not-allowed;
            /* Cursor tidak aktif */
            pointer-events: none;
            /* Mencegah interaksi */
        }

        @media (max-width: 768px) {
            .approval-box {
                width: 90%;
            }

            .approval-signature {
                flex-direction: column;
            }

            .signature-section {
                margin-bottom: 20px;
            }
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid approval-container">
        <div class="d-flex justify-content-end " style="position: absolute; top: 72px;right: 40px; z-index: 1050;">
            @if (session('success'))
                <div class="alert alert-primary  col-lg-10" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger  col-lg-10" role="alert">
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
        <div class="approval-box">
            <div class="mb-4">
                <h4 class="card-title fw-semibold mb-1">Persetujuan Evaluasi Kinerja Unit
                    {{ session('audite.unit.nama_unit') }}</h4>
            </div>
            <div class="mb-4">
                <img src="{{ asset('assets/images/logos/short-logo.png') }}" alt="" width="164px">
            </div>
            <p class="approval-text">
                “Dengan ini saya menyatakan bahwa data yang telah dimasukkan adalah benar.
                Proses evaluasi oleh auditor telah dijalankan dan saya menyetujui hasil evaluasi.”
            </p>

            <div class="approval-signature">
                {{-- Signature Audite --}}
                <div class="signature-section">
                    @if ($audite['status_finalisasi'] == true)
                        <div class="signature-approved">✔️</div>
                        <div class="signature-text">Sudah Finalisasi</div>
                    @else
                        <div class="signature-icon">⭕</div>
                        <div class="signature-text">Proses</div>
                    @endif
                    <div class="signature-details">
                        Surabaya, {{ $date }} <br>
                        Unit {{ $audite['nama_unit'] }},
                        {{ $audite['nama'] }}
                    </div>
                </div>

                {{-- Signature Ketua Auditor --}}
                <div class="signature-section">
                    @if ($auditor1['status_finalisasi'] == true)
                        <div class="signature-approved">✔️</div>
                        <div class="signature-text">Sudah Finalisasi</div>
                    @else
                        <div class="signature-icon">⭕</div>
                        <div class="signature-text">Proses</div>
                    @endif
                    <div class="signature-details">
                        Surabaya, {{ $date }} <br>
                        Ketua Auditor,
                        {{ $auditor1['nama'] ?? 'Auditor 1 Belum di Set' }}
                    </div>
                </div>

                {{-- Signature Anggota Auditor --}}
                <div class="signature-section">
                    @if ($auditor2['status_finalisasi'] == true)
                        <div class="signature-approved">✔️</div>
                        <div class="signature-text">Sudah Finalisasi</div>
                    @else
                        <div class="signature-icon">⭕</div>
                        <div class="signature-text">Proses</div>
                    @endif
                    <div class="signature-details">
                        Surabaya, {{ $date }} <br>
                        Anggota Auditor,
                        {{ $auditor2['nama'] ?? 'Auditor 2 Belum di Atur' }}
                    </div>
                </div>
            </div>


            {{-- Form Section --}}
            <div class="form-section">
                <form action="{{ route('finalisasi_audite.finalisasi') }}" method="POST" id="finalisasiForm">
                    @csrf
                    <div class="form-group">
                        <button type="submit" class="btn-submit {{ $audite['status_finalisasi'] ? 'disabled-btn' : '' }}"
                            id="btnSubmit" @if ($audite['status_finalisasi']) disabled @endif>
                            Kirim Persetujuan
                        </button>
                    </div>
                </form>
            </div>



        </div>
    </div>

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('finalisasiForm');
                const btnSubmit = document.getElementById('btnSubmit');

                btnSubmit.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah submit form langsung
                    const confirmation = confirm(
                        "Apakah Anda Yakin Akan Melakukan Konfirmasi Finalisasi Pengisian Data Audite Ini? Data yang sudah dikonfirmasi tidak akan bisa di edit."
                    );
                    if (confirmation) {
                        form.submit(); // Submit form jika konfirmasi diterima
                    }
                });
            });
        </script>
    @endpush
@endsection
