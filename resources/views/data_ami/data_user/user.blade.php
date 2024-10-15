@extends('layouts.main')

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center mb-2">
                        <div>
                            <span class="card-title fw-semibold me-3">Daftar User</span>
                        </div>
                        <div>
                            <a href="data_user/create" type="button" class="btn btn-primary"><i class="ti ti-plus"></i>Tambah
                                User</a>
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
                    <table id="daftar_user" class="table table-hover table-bordered text-nowrap mb-0 align-middle">

                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0 text-center" style="width: 10px">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Nama User</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Email</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Admin</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Audite</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-center">Auditor</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Edit</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Delete</h6>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($data_user as $dataUser): ?>
                            <tr>
                                <td class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0"> {{ $no++ }} </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1"> {{ $dataUser->nama }} </h6>
                                </td>

                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1"> {{ $dataUser->email }} </h6>
                                </td>

                                {{-- Status Admin --}}
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1 text-center">
                                        @if ($dataUser->status_admin == 1)
                                            Ya
                                        @else
                                            -
                                        @endif
                                    </h6>
                                </td>

                                {{-- Audite --}}
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1 text-center">
                                        @if ($dataUser->audite !== null)
                                            Ya
                                        @else
                                            -
                                        @endif
                                    </h6>
                                </td>

                                {{-- Auditor --}}
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1 text-center">
                                        @if (
                                            (!empty($dataUser->auditor1) && count($dataUser->auditor1) > 0) ||
                                                (!empty($dataUser->auditor2) && count($dataUser->auditor2) > 0))
                                            Ya
                                        @else
                                            -
                                        @endif
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal text-center"><a href="{{ route('data_user.edit', $dataUser->user_id) }}"><i class="ti ti-pencil"></i></a>
                                    </p>
                                </td>
                                <td class="border-bottom-0">
                                    <form action="{{ route('data_user.destroy', $dataUser->user_id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data User : {{ $dataUser->nama }}  ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
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
            $('#daftar_user').DataTable({
                responsive: true,
                "scrollY": "480px",
                "pageLength": 20, // Set initial page length to 5
                "lengthMenu": [
                    [20, 30, 40, 50, 100],
                    [20, 30, 40, 50, 100],
                ],
                columns: [{
                        width: '6px'
                    },
                    null,
                    null,
                    {
                        width: '10px'
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
                    {
                        width: '4px'
                    },
                ]
            });
        </script>
        </script>
    @endpush
@endsection
