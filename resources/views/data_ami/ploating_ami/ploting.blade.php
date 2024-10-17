@extends('layouts.main')
@push('css')
    <style>
        .unit-list {
            list-style-type: decimal;
            /* Menggunakan angka numerik */
            list-style-position: inside;
            /* Menempatkan angka di dalam kotak */
        }

        .unit-list li {
            border: 1px solid #ddd;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
    </style>
@endpush

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center mb-2">
                        <div>
                            <span class="card-title fw-semibold me-3">Ploating AMI</span>
                        </div>
                        <div>
                            <form action="{{ route('ploting_ami.reset') }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin mereset semua data ploting? Data Audite dan Auditor akan dihapus.')">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-refresh-alert me-2"></i> Reset Ploting
                                </button>
                            </form>
                        </div>

                    </div>

                    <div>
                        @if (session('success'))
                            <div class="alert alert-primary" style role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" style role="alert">
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
                </div>

                <div class="table-responsive">
                    <table id="table_audite" class="table table-hover table-bordered text-nowrap mb-0 align-middle">

                        <thead class="text-dark fs-4 table-light">
                            <tr>
                                <th class="border-bottom-0 text-center" style="width: 10px">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Unit Kerja</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Audite</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Auditor 1</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Auditor 2</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Edit</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($data_ploting as $ploting): ?>
                            <tr>
                                <td class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0"> {{ $no++ }} </h6>
                                </td>

                                <!-- Tampilkan Nama Unit dan Unit Cabang -->
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-4"> {{ $ploting->nama_unit }} </h6>
                                    <ol class="unit-list fw-medium" style="list-style-position: inside; padding-left: 0;">
                                        <!-- Gaya CSS untuk daftar numerik -->
                                        @foreach ($ploting->units_cabang as $unitCabang)
                                            <li class="mb-2"
                                                style="border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                                {{ $unitCabang->nama_unit_cabang }}
                                            </li>
                                        @endforeach
                                    </ol>
                                </td>

                                <!-- Tampilkan Audite -->
                                <td class="border-bottom-0">
                                    <div class="mb-4">
                                        <h6 class="fw-semibold mb-1">
                                            @if (!empty($ploting->audite) && isset($ploting->audite[0]['user_audite']['nama']))
                                                {{ $ploting->audite[0]['user_audite']['nama'] }} <br>
                                            @else
                                                <span style="color: red">User Audite Belum di set!</span>
                                            @endif

                                        </h6>
                                    </div>

                                    <ol class="unit-list fw-medium" style="list-style-position: inside; padding-left: 0;">
                                        <!-- Gaya CSS untuk daftar numerik -->
                                        @foreach ($ploting->units_cabang as $auditeUnit)
                                            <li class="mb-2"
                                                style="border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                                @if (!empty($auditeUnit->audites) && isset($auditeUnit->audites[0]['user_audite']))
                                                    {{ $auditeUnit->audites[0]['user_audite']['nama'] }}
                                                @else
                                                    <span style="color: red">Audite Belum di Set !</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ol>
                                </td>


                                <!-- Tampilkan Auditor 1 -->
                                <td class="border-bottom-0">
                                    @if ($ploting->auditor && $ploting->auditor->auditor1)
                                        <h6 class="fw-semibold">
                                            {{ $ploting->auditor->auditor1->nama }} <br>
                                        </h6>
                                    @else
                                        <span style="color: red">Auditor 1 Belum Di set !</span>
                                    @endif
                                </td>

                                <!-- Tampilkan Auditor 2 -->
                                <td class="border-bottom-0">
                                    @if ($ploting->auditor && $ploting->auditor->auditor2)
                                        <h6 class="fw-semibold">
                                            {{ $ploting->auditor->auditor2->nama }} <br>
                                        </h6>
                                    @else
                                        <span style="color: red">Auditor 2 Belum Di set !</span>
                                    @endif
                                </td>

                                <!-- Edit Button -->
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal text-center"><a
                                            href="{{ route('ploting_ami.edit', $ploting->unit_id) }}"><i
                                                class="ti ti-pencil"></i></a></p>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
    @push('script')
        <script>
            $('#table_audite').DataTable({
                responsive: true,
                "scrollY": "480px",
                "pageLength": 20, // Set initial page length to 5
                "lengthMenu": [
                    [20, 30, 40, 50, 100],
                    [20, 30, 40, 50, 100],
                ],
                columns: [{
                        width: '4px'
                    },
                    {
                        width: '20px'
                    },
                    {
                        width: '12px'
                    },
                    {
                        width: '4px'
                    },
                    {
                        width: '4px'
                    },
                    {
                        width: '4px'
                    },
                ]
            });
        </script>
    @endpush
@endsection
