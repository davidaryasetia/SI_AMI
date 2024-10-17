@extends('layouts.main_audite')
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
            color: #f03e3e; /* Warna lebih kalem */
        }

        .signature-approved {
            font-size: 40px;
            color: #38c172; /* Warna hijau lebih soft */
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

@section('row')
    <div class="container-fluid approval-container">
        <div class="approval-box">
            <h4 class="card-title fw-semibold">Persetujuan Evaluasi Kinerja Unit</h4>
            <p class="approval-text">
                “Dengan ini saya menyatakan bahwa data yang telah dimasukkan adalah benar. 
                Proses evaluasi oleh auditor telah dijalankan dan saya menyetujui hasil evaluasi.”
            </p>
            
            <div class="approval-signature">
                {{-- Signature 1 --}}
                <div class="signature-section">
                    <div class="signature-icon">⭕</div>
                    <div class="signature-text">Setuju</div>
                    <div class="signature-details">
                        Surabaya, 11 Januari 2025 <br>
                        P4MP, David
                    </div>
                </div>
                
                {{-- Signature 2 --}}
                <div class="signature-section">
                    <div class="signature-icon">⭕</div>
                    <div class="signature-text">Setuju</div>
                    <div class="signature-details">
                        Surabaya, 11 Januari 2025 <br>
                        Ketua Auditor, Hary
                    </div>
                </div>
                
                {{-- Signature 3 --}}
                <div class="signature-section">
                    <div class="signature-approved">✅</div>
                    <div class="signature-text">Setuju</div>
                    <div class="signature-details">
                        Surabaya, 11 Januari 2025 <br>
                        Anggota Auditor, Tita
                    </div>
                </div>
            </div>

            {{-- Form Section --}}
            <div class="form-section">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Komentar (Opsional):</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Tambahkan komentar jika perlu"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn-submit">Kirim Persetujuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
