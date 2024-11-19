@extends('layouts.main')

@section('title', 'Edit Unit')
@push('css')
@endpush
@section('content')

    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-start align-items-center mb-4">
                        <a href="/data_unit" class="d-flex align-items-center">
                            <i class="ti ti-arrow-left me-3" style="font-size: 20px; color: black"></i>
                        </a>
                        <span class="fw-semibold me-3" style="font-size: 16px; color: black">Edit Unit Kerja</span>
                    </div>

                    {{-- Content --}}
                    <form action="{{ route('data_unit.update', $data_unit->unit_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 col-lg-12">
                            <label for="type" class="form-label">Tipe Unit</label>
                            <select class="form-select @error('tipe_data') is-invalid @enderror" id="tipe_data"
                                name="tipe_data" disabled>
                                <option value="unit_kerja" {{ $data_unit->tipe_data == 'unit_kerja' ? 'selected' : '' }}>
                                    Unit Kerja</option>
                                <option value="departement_kerja"
                                    {{ $data_unit->tipe_data == 'departemen_kerja' ? 'selected' : '' }}>
                                    Departement Kerja</option>
                            </select>

                            {{-- Hidden field to retain the selected value --}}
                            <input type="hidden" name="tipe_data" value="{{ $data_unit->tipe_data }}">

                            @error('tipe_data')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- Form Unit Kerja --}}
                        <div class="unit-field"
                            style="display: {{ $data_unit->tipe_data == 'unit_kerja' ? '    block' : 'none' }};">
                            <div class="mb-4 col-lg-4">
                                <label for="nama_unit" class="form-label">Nama Unit</label>
                                <input type="text" class="form-control @error('nama_unit') is-invalid @enderror"
                                    id="nama_unit" name="nama_unit" value="{{ $data_unit->nama_unit }}" required>
                                @error('nama_unit')
                                    <div class="alert alert-danger mt-2">{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Form Departement Kerja --}}
                        <div class="department-field"
                            style="display: {{ $data_unit->tipe_data == 'departemen_kerja' ? 'block' : 'none' }};">

                            {{-- Content Here --}}
                            <div class="d-flex align-items-center">
                                <div class="mb-4 col-lg-9">
                                    <label for="nama_unit_dept" class="form-label">Nama Unit Departement</label>
                                    <input type="text" class="form-control @error('nama_unit_dept') is-invalid @enderror"
                                        id="nama_unit_dept" name="nama_unit_dept" value="{{ $data_unit->nama_unit }}"
                                        required>
                                    @error('nama_unit_dept')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="ms-3 mt-4">
                                    <button type="button" class="btn btn-secondary mb-4" id="addBranch">Tambah Unit
                                        Cabang</button>
                                </div>
                            </div>
                            {{-- End Content Here --}}

                            <div class="department-fields">
                                @if ($data_unit->units_cabang->isNotEmpty())
                                    @foreach ($data_unit->units_cabang as $key => $unitCabang)
                                        <div class="mb-4 col-lg-4 department-template">
                                            <label for="nama_unit_cabang" class="form-label">Nama Prodi</label>
                                            <input type="text"
                                                class="form-control @error('nama_unit_cabang') is-invalid @enderror"
                                                name="nama_unit_cabang[]" value="{{ $unitCabang->nama_unit_cabang }}"
                                                placeholder="Masukkan Nama Prodi...">
                                            @error('nama_unit_cabang')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror

                                            {{-- Tombol Hapus --}}
                                            <button type="button" class="btn btn-danger mt-1"
                                                onclick="this.parentElement.remove()">Hapus Prodi</button>

                                            {{-- Hidden field untuk ID unit cabang yang ada --}}
                                            <input type="hidden" name="unit_cabang_id[]"
                                                value="{{ $unitCabang->unit_cabang_id }}">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="mb-4 col-lg-4 department-template">
                                        <label for="nama_unit_cabang" class="form-label">Nama Prodi</label>
                                        <input type="text"
                                            class="form-control @error('nama_unit_cabang') is-invalid @enderror"
                                            placeholder="Masukkan Nama Prodi...." name="nama_unit_cabang[]">
                                        @error('nama_unit_cabang')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                            </div>


                        </div>


                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </form>
                    {{-- END-Content --}}
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const typeSelect = document.getElementById('tipe_data');
                const unitField = document.querySelector('.unit-field');
                const departmentField = document.querySelector('.department-field');
                const addBranchBtn = document.getElementById('addBranch');
                const departmentTemplate = document.querySelector('.department-template');

                function toggleFields() {
                    if (typeSelect.value === 'departement_kerja') {
                        unitField.style.display = 'none';
                        departmentField.style.display = 'block';
                    } else {
                        unitField.style.display = 'block';
                        departmentField.style.display = 'none';
                    }
                }

                // Toggle fields on page load
                toggleFields();

                // Listen for changes on the select box
                typeSelect.addEventListener('change', toggleFields);

                // Fungsi untuk menambahkan prodi baru
                addBranchBtn.addEventListener('click', function() {
                    const clone = departmentTemplate.cloneNode(true);
                    const inputs = clone.querySelectorAll('input');
                    inputs.forEach(function(input) {
                        input.value = '';
                    });

                    // Hapus semua tombol "Hapus Prodi" yang ada sebelum menambah elemen baru
                    const deleteButton = clone.querySelector('.btn-danger');
                    if (!deleteButton) {
                        const newDeleteButton = document.createElement('button');
                        newDeleteButton.type = 'button';
                        newDeleteButton.classList.add('btn', 'btn-danger', 'mb-4');
                        newDeleteButton.innerText = 'Hapus Prodi';
                        newDeleteButton.addEventListener('click', function() {
                            clone.remove();
                        });
                        clone.appendChild(newDeleteButton);
                    }

                    document.querySelector('.department-fields').appendChild(clone);
                });
            });
        </script>
    @endpush
@endsection
