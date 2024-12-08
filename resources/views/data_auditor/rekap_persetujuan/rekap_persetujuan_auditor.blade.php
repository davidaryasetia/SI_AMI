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
            padding: 10px;
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
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 style="color: black">Sistem Informasi Audit Mutu Internal</h5>
                        <p style="color: black">Pengisian evaluasi unit : <span id="unit-name-display"></span></p>
                    </div>
                </div>
                {{-- End Header --}}

                {{-- Table Content --}}
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Unit</th>
                                <th>Progres Evaluasi</th>
                                <th>Persetujuan Auditor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach (session('auditor') as $auditor)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $auditor['units']['nama_unit'] }}</td>
                                    <td>-</td>
                                    <td><span class="icon-cross"><i class="ti ti-x"></i></span></td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                {{-- END Table Content --}}

                {{-- Approval Content --}}
                <div class="approval-box">
                    <div class="col-lg-2">
                        <select id="unit-select" class="form-select text-black bg-primary"
                            style="border-radius: 12px; color: white">
                            <option class="text-white" value="" style="color: white">Pilih Unit Kerja</option>
                            @foreach (session('auditor') as $auditor)
                                <option class="text-white" value="{{ $auditor['units']['unit_id'] }}"
                                    data-unit-name="{{ $auditor['units']['nama_unit'] }}">
                                    {{ $auditor['units']['nama_unit'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="d-flex flex-column align-items-center">
                        <p class="approval-text mt-3">
                            "Dengan ini saya menyatakan bahwa evaluasi telah selesai dilaksanakan dengan benar dan telah
                            disepakati bersama dengan auditee."
                        </p>
                        <p>{{ Auth::user()->nama }}</p>
                        <p class="approval-date">Surabaya, {{ $date }}</p>
                    </div>

                    <form action="" method="POST">
                        @csrf
                        <div class="approval-signature"
                            style="display: flex; justify-content: center; align-items: center; gap: 8px;">
                            <label for="approvalCheck" style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" id="approvalCheck" name="approvalCheck"
                                    style="width: 20px; height: 20px;">
                                <span>Setuju</span>
                            </label>
                        </div>

                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>

                </div>
                {{-- End Approval Content --}}

            </div>
        </div>
    </div>
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const unitSelect = document.getElementById('unit-select');
                const unitNameDisplay = document.getElementById('unit-name-display'); // Pastikan penamaan ini sesuai

                unitSelect.addEventListener('change', function() {
                    const selectedOption = unitSelect.options[unitSelect.selectedIndex];
                    const unitName = selectedOption.getAttribute('data-unit-name') || '-';

                    // Perbarui teks unit di bagian "Pengisian evaluasi unit"
                    unitNameDisplay.textContent = unitName;
                });
            });
        </script>
    @endpush
@endsection
