@extends('layouts.main')

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <a href="/unit_kerja" class="d-flex align-items-center"><i class="ti ti-arrow-left me-3"
                                        style="font-size: 20px; color: black"></i></a>
                            </div>
                            <div>
                                <span class="card-title fw-semibold me-3">Tambah Unit Kerja | Departemen</span>
                            </div>
                        </div>
                    </div>

                    <!-- Form Pilihan Tipe Unit Kerja atau Departemen -->
                    <!-- Form Pilihan Tipe Unit Kerja atau Departemen -->
                    <form action="{{ route('unit_kerja.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-12 position-relative">
                                <label for="tipe_data" class="form-label">Pilih Tipe Data Unit Kerja</label>
                                <select class="form-select" id="tipe_data" name="tipe_data">
                                    <option value="unit_kerja">Unit Kerja</option>
                                    <option value="departemen_kerja">Departemen Kerja</option>
                                </select>
                            </div>
                        </div>

                        <!-- Form Unit Kerja -->
                        <div id="unit_kerja_form" class="row">
                            <div class="col-md-9 d-flex flex-column" id="nama_unit_fields">
                                <div class="nama_unit_template mb-6 d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <label for="nama_unit" class="form-label">Nama Unit</label>
                                        <input type="text" class="form-control" id="nama_unit" name="nama_unit_kerja[]"
                                            placeholder="Masukkan Nama Unit...">
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm ms-2 mt-9 remove-btn">X</button>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex align-items-start mt-9">
                                <button type="button" class="btn btn-secondary mt-1" id="addNamaUnit">Tambah Unit</button>
                            </div>
                        </div>

                        <!-- Form Departemen Kerja -->
                        <div id="departemen_kerja_form" style="display: none;">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="nama_departemen" class="form-label">Nama Departemen</label>
                                    <input type="text" class="form-control" id="nama_departemen" name="nama_departemen"
                                        placeholder="Masukkan Nama Departemen...">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-9 d-flex flex-column" id="unit_cabang_fields">
                                    <div class="unit_cabang_template mb-4 d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <label for="nama_unit_cabang" class="form-label">Nama Prodi</label>
                                            <input type="text" class="form-control" name="nama_unit_cabang[]"
                                                placeholder="Masukkan Nama Prodi...">
                                        </div>
                                        <div class="d-flex align-items-start mt-9">
                                            <button type="button" class="btn btn-danger mt-2 btn-sm ms-2 remove-btn">X</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex align-items-start mt-9">
                                    <button type="button" class="btn btn-secondary mt-1" id="addUnitCabang">Tambah Unit
                                        Cabang</button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Tambah Unit</button>
                    </form>

                    <!-- END Content -->
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Menampilkan dan Menyembunyikan Form Berdasarkan Pilihan -->
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var tipeData = document.getElementById('tipe_data');
                var unitKerjaForm = document.getElementById('unit_kerja_form');
                var departemenKerjaForm = document.getElementById('departemen_kerja_form');

                tipeData.addEventListener('change', function() {
                    if (this.value === 'unit_kerja') {
                        unitKerjaForm.style.display = 'block';
                        departemenKerjaForm.style.display = 'none';
                    } else if (this.value === 'departemen_kerja') {
                        unitKerjaForm.style.display = 'none';
                        departemenKerjaForm.style.display = 'block';
                    }
                });

                // Tambahkan unit
                document.getElementById('addNamaUnit').addEventListener('click', function() {
                    var namaUnitTemplate = document.querySelector('.nama_unit_template').cloneNode(true);
                    namaUnitTemplate.querySelector('input').value = '';
                    namaUnitTemplate.querySelector('.remove-btn').addEventListener('click', function() {
                        namaUnitTemplate.remove();
                    });
                    document.getElementById('nama_unit_fields').appendChild(namaUnitTemplate);
                });

                // Tambahkan unit cabang
                document.getElementById('addUnitCabang').addEventListener('click', function() {
                    var unitCabangTemplate = document.querySelector('.unit_cabang_template').cloneNode(true);
                    unitCabangTemplate.querySelector('input').value = '';
                    unitCabangTemplate.querySelector('.remove-btn').addEventListener('click', function() {
                        unitCabangTemplate.remove();
                    });
                    document.getElementById('unit_cabang_fields').appendChild(unitCabangTemplate);
                });

                // Hapus field yang tidak diinginkan
                document.querySelectorAll('.remove-btn').forEach(function(button) {
                    button.addEventListener('click', function() {
                        this.closest('.nama_unit_template, .unit_cabang_template').remove();
                    });
                });
            });
        </script>
    @endpush
@endsection
