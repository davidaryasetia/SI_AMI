@extends('layouts.main')

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <span class="card-title fw-semibold me-3">Ploating AMI</span>
                            </div>
                            {{-- <div>
                                <a href="daftar_audite/create" type="button" class="btn btn-primary"><i
                                        class="ti ti-plus me-1"></i>Ploating AMI</a>
                            </div> --}}
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

                            <thead class="text-dark fs-4">
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
                                        <div class="mb-3">
                                            <h6 class="fw-semibold mb-1"> {{ $ploting->nama_unit }} </h6>
                                        </div>
                                        <div class="unit-list fw-medium">
                                            @php $nomor = 1; @endphp
                                            @foreach ($ploting->units_cabang as $unitCabang)
                                                <li class="mb-2">
                                                    {{ $nomor }} ) {{ $unitCabang->nama_unit_cabang }}
                                                </li>
                                                @php $nomor++; @endphp
                                            @endforeach
                                        </div>
                                    </td>

                                    <!-- Tampilkan Audite -->
                                    <td class="border-bottom-0">
                                        <div class="">
                                            <h6 class="fw-semibold mb-1">
                                                @if (isset($ploting->audite[0]) && $ploting->audite[0]['unit_cabang_id'] === null)
                                                    {{ $ploting->audite[0]['user_audite']['nama'] }} <br>
                                                    <span style="font-weight: normal;">(NIP:
                                                        {{ $ploting->audite[0]['user_audite']['nip'] }})</span>
                                                @else
                                                    <span style="color: red">User Audite Belum di set!!!</span>
                                                @endif
                                            </h6>
                                        </div>

                                        <div class="unit-list fw-medium">
                                            @php $number = 1; @endphp
                                            @foreach ($ploting->units_cabang as $auditeUnit)
                                                <li class="mb-2">
                                                    {{ $number++ }} )
                                                    @if (!empty($auditeUnit->audites) && isset($auditeUnit->audites[0]['user_audite']))
                                                        {{ $auditeUnit->audites[0]['user_audite']['nama'] }} (NIP :
                                                        {{ $auditeUnit->audites[0]['user_audite']['nip'] }})
                                                    @else
                                                        <span style="color: red">Audite Belum di Set !!!</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </div>

                                    </td>

                                    <!-- Tampilkan Auditor 1 -->
                                    <td class="border-bottom-0">
                                        @if ($ploting->auditor && $ploting->auditor->auditor1)
                                            <h6 class="fw-semibold">
                                                {{ $ploting->auditor->auditor1->nama }} <br>
                                                <span style="font-weight: normal;">(NIP:
                                                    {{ $ploting->auditor->auditor1->nip }})</span>
                                            </h6>
                                        @else
                                            <span style="color: red">Auditor 1 Belum Di set !!!</span>
                                        @endif
                                    </td>

                                    <!-- Tampilkan Auditor 2 -->
                                    <td class="border-bottom-0">
                                        @if ($ploting->auditor && $ploting->auditor->auditor2)
                                            <h6 class="fw-semibold">
                                                {{ $ploting->auditor->auditor2->nama }} <br>
                                                <span style="font-weight: normal;">(NIP:
                                                    {{ $ploting->auditor->auditor2->nip }})</span>
                                            </h6>
                                        @else
                                            <span style="color: red">Auditor 2 Belum Di set !!!</span>
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
    </div>
    @push('script')
        <script>
            $('#table_audite').DataTable({
                responsive: true,
                "scrollY": "500px",
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
