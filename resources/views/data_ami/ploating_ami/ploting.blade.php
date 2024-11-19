@extends('layouts.main')
@section('title', 'Ploating AMI')
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

@section('content')
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
                        <!-- Tombol Trigger Modal -->
                        <div class="ms-2">
                            <button type="button" class="btn btn-primary" id="cekBebanButton" data-bs-toggle="modal"
                                data-bs-target="#cekBebanModal">
                                <i class="ti ti-weight me-2"></i> Cek Beban
                            </button>
                        </div>

                        <!-- Modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="cekBebanModal" tabindex="-1" aria-labelledby="cekBebanModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="cekBebanModalLabel"
                                            style="color: white; font-weight: 600"><i class="ti ti-weight me-2"></i>Cek
                                            Beban User Auditor</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="bebanContent">
                                            <table class="table table-striped table-hover">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th scope="col">Nama Auditor</th>
                                                        <th scope="col" class="text-center">Beban Auditor 1</th>
                                                        <th scope="col" class="text-center">Beban Auditor 2</th>
                                                        <th scope="col" class="text-center">Total Beban</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="bebanTableBody">
                                                    <!-- Data akan dimuat secara dinamis dengan JavaScript -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.getElementById('cekBebanButton').addEventListener('click', function() {
                                const bebanTableBody = document.getElementById('bebanTableBody');
                                bebanTableBody.innerHTML = `
        <tr>
            <td colspan="4" class="text-center">Memuat data...</td>
        </tr>
    `;

                                fetch('{{ route('ploting_ami.cek_beban') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error(`HTTP error! Status: ${response.status}`);
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        if (data.length > 0) {
                                            bebanTableBody.innerHTML = '';
                                            data.forEach(auditor => {
                                                const auditor1Units = auditor.auditor1Units.join(', ');
                                                const auditor2Units = auditor.auditor2Units.join(', ');

                                                bebanTableBody.innerHTML += `
                    <tr>
                        <td>${auditor.nama}</td>
                        <td class="text-center">
                            ${auditor.jumlahAuditor1}
                            <span 
                                class="ms-2 btn btn-sm btn-light" 
                                tabindex="0" 
                                data-bs-toggle="popover" 
                                data-bs-trigger="hover focus" 
                                data-bs-content="${auditor1Units}">
                                <i class="ti ti-info-circle"></i>
                            </span>
                        </td>
                        <td class="text-center">
                            ${auditor.jumlahAuditor2}
                            <span 
                                class="ms-2 btn btn-sm btn-light" 
                                tabindex="0" 
                                data-bs-toggle="popover" 
                                data-bs-trigger="hover focus" 
                                data-bs-content="${auditor2Units}">
                                <i class="ti ti-info-circle"></i>
                            </span>
                        </td>
                        <td class="text-center"><strong>${auditor.total}</strong></td>
                    </tr>
                `;
                                            });

                                            // Inisialisasi popover
                                            const popoverTriggerList = [].slice.call(document.querySelectorAll(
                                                '[data-bs-toggle="popover"]'));
                                            popoverTriggerList.forEach(function(popoverTriggerEl) {
                                                new bootstrap.Popover(popoverTriggerEl);
                                            });
                                        } else {
                                            bebanTableBody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center text-muted">Tidak ada data auditor.</td>
                </tr>
            `;
                                        }
                                    })
                                    .catch(error => {
                                        bebanTableBody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center text-danger">Gagal memuat data: ${error.message}</td>
            </tr>
        `;
                                    });
                            });
                        </script>

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

            // Logic Cek beban
        </script>
    @endpush
@endsection
