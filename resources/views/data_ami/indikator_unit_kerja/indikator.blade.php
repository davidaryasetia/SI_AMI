@extends('layouts.main')

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <span class="card-title fw-semibold me-3">Indikator Kinerja Unit Kerja</span>
                            </div>
                            <div class="me-3">
                                <a href="/indikator_unit_kerja/create" type="button" class="btn btn-primary"><i
                                        class="ti ti-plus me-2"></i>Tambah IKUK</a>
                            </div>

                            <div class="d-flex justify-content-start">
                                <form action="" method="GET">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <div class="">
                                                <select id="unit_id" name="unit_id" class="form-select">
                                                    <option value="">Pilih Unit......</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit['unit_id'] }}"
                                                            >
                                                            {{ $unit['nama_unit'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                       

                                        <div>
                                            <button type="submit" class="btn btn-outline-info">Filter</button>
                                        </div>
                                    </div>
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
                        <table id="table_indikator" class="table table-hover table-bordered text-nowrap mb-0 align-middle"
                            style="width:100%">

                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0">Kode</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-center">Indikator Kinerja Unit Kerja</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-center">Satuan</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-center">Target</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-center">Edit</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-center">Hapus</h6>
                                    </th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0"> </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="p-3">
                                            <h6 class="fw-semibold mb-1 text-center"> </h6>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="p-3">
                                            <h6 class="fw-semibold mb-1 text-center"> </h6>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="p-3">
                                            <h6 class="fw-semibold mb-1 text-center"> </h6>
                                        </div>
                                    </td>

                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-center"><a href=""><i
                                                    class="ti ti-pencil"></i></a></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <form action="" method="POST"
                                            onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data Unit :  ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
