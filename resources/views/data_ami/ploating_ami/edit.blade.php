{{-- @dd($data_unit->audite->) --}}


@extends('layouts.main')
@section('title', 'Ploting AMI')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-start align-items-center mb-4">
                        <a href="/ploting_ami" class="d-flex align-items-center">
                            <i class="ti ti-arrow-left me-3" style="font-size: 20px; color: black"></i>
                        </a>
                        <span class="fw-semibold me-3" style="font-size: 16px; color: black">Ploting Data Unit Kerja</span>
                    </div>

                    {{-- Content --}}
                    <form action="{{ route('ploting_ami.update', $data_unit->unit_id) }}" method="POST"
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
                                    {{ $data_unit->tipe_data == 'departemen_kerja' ? 'selected' : '' }}>Departement Kerja
                                </option>
                            </select>

                            {{-- Hidden field to retain the selected value --}}
                            <input type="hidden" name="tipe_data" value="{{ $data_unit->tipe_data }}">

                            @error('tipe_data')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Form for Unit Kerja --}}
                        <div class="unit-field"
                            style="display: {{ $data_unit->tipe_data == 'unit_kerja' ? 'block' : 'none' }};">

                            <div class="row">
                                <div class="mb-4 col-lg-6">
                                    <label for="nama_unit" class="form-label">Nama Unit</label>
                                    <input type="text" class="form-control @error('nama_unit') is-invalid @enderror"
                                        id="nama_unit" name="nama_unit" value="{{ $data_unit->nama_unit }}" disabled>
                                    <input type="hidden" value="{{ $data_unit->nama_unit }}">
                                    @error('nama_unit')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Dropdowns for audite, auditor1, and auditor2 --}}
                                <div class="mb-4 col-lg-6">
                                    {{-- Audite --}}
                                    <label for="audite" class="form-label">Audite</label>
                                    <select class="form-select" name="audite">
                                        @foreach ($audite_users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ isset($data_unit->audite[0]) && $data_unit->audite[0]->user_id == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->nama }}
                                            </option>
                                        @endforeach
                                        {{-- Jika user_id null, tambahkan opsi default --}}
                                        @if (!isset($data_unit->audite[0]->user_id) || is_null($data_unit->audite[0]->user_id))
                                            <option value="" selected>User Audite Belum Di Set</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-lg-6">
                                    <label for="auditor1" class="form-label">Auditor 1</label>
                                    <select name="auditor1_unit" id="auditor1" class="form-select"
                                        style="{{ isset($data_unit->auditor->auditor1) ? '' : 'border-color: red; color: black;' }}">
                                        <option value=""
                                            {{ !isset($data_unit->auditor->auditor1) ? 'selected' : '' }}>
                                            Auditor 1 Belum Di Set
                                        </option>
                                        @foreach ($auditor_users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ isset($data_unit->auditor->auditor1) && $data_unit->auditor->auditor1->user_id == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4 col-lg-6">
                                    <label for="auditor2_unit" class="form-label">Auditor 2</label>
                                    <select name="auditor2_unit" id="auditor2" class="form-select"
                                        style="{{ isset($data_unit->auditor->auditor2) ? '' : 'border-color: red;' }}">
                                        <option value="" style="color: red;"
                                            {{ !isset($data_unit->auditor->auditor2) ? 'selected' : '' }}>
                                            Auditor 2 Belum Di Set
                                        </option>
                                        @foreach ($auditor_users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ isset($data_unit->auditor->auditor2) && $data_unit->auditor->auditor2->user_id == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        {{-- Form for Departement Kerja --}}
                        <div class="department-field"
                            style="display: {{ $data_unit->tipe_data == 'departemen_kerja' ? 'block' : 'none' }};">

                            <div class="d-flex justify-content-between">
                                <div class="mb-4 col-lg-5">
                                    <label for="nama_unit_dept" class="form-label">Nama Unit Departement</label>
                                    <input type="text" class="form-control @error('nama_unit_dept') is-invalid @enderror"
                                        id="nama_unit_dept" name="nama_unit_dept" value="{{ $data_unit->nama_unit }}"
                                        required disabled>
                                    <input type="hidden" value="{{ $data_unit->nama_unit }}">
                                    @error('nama_unit_dept')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4 col-lg-6">
                                    {{-- Audite --}}
                                    <label for="audite" class="form-label">Kepala Departement</label>
                                    <select class="form-select" name="kadep"
                                        style="{{ isset($data_unit->audite[0]) ? '' : 'border-color:red; color:black' }}">
                                        @foreach ($audite_users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ isset($data_unit->audite[0]) && $data_unit->audite[0]->user_id == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->nama }}
                                            </option>
                                        @endforeach
                                        {{-- Jika user_id null, tambahkan opsi default --}}
                                        @if (!isset($data_unit->audite[0]->user_id) || is_null($data_unit->audite[0]->user_id))
                                            <option value="" selected>User Audite Belum Di Set</option>
                                        @endif
                                    </select>
                                </div>

                            </div>


                            <div class="department-fields">
                                @if ($data_unit->units_cabang->isNotEmpty())
                                    @foreach ($data_unit->units_cabang as $key => $unitCabang)
                                        <div
                                            class="mb-4 d-flex align-items-center justify-content-between department-template">
                                            <div class="col-lg-5">
                                                <label for="nama_unit_cabang" class="form-label">Nama Prodi</label>
                                                <input type="text"
                                                    class="form-control @error('nama_unit_cabang') is-invalid @enderror"
                                                    name="nama_unit_cabang[]" value="{{ $unitCabang->nama_unit_cabang }}"
                                                    placeholder="Masukkan Nama Prodi..." disabled>
                                                <input type="hidden" value="{{ $unitCabang->nama_unit_cabang }}">
                                                @error('nama_unit_cabang')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="audite_cabang_{{ $key }}"
                                                    class="form-label">Audite</label>
                                                <select name="audite_cabang[{{ $unitCabang->unit_cabang_id }}]"
                                                    id="audite_cabang_{{ $key }}" class="form-select"
                                                    style="{{ isset($unitCabang->audites[0]->user_id) ? '' : 'border-color: red; color: black;' }}">
                                                    <option value=""
                                                        {{ !isset($unitCabang->audites[0]->user_id) ? 'selected' : '' }}>
                                                        Audite Belum Di Set
                                                    </option>
                                                    @foreach ($audite_users as $user)
                                                        <option value="{{ $user->user_id }}"
                                                            {{ isset($unitCabang->audites[0]->user_id) && $unitCabang->audites[0]->user_id == $user->user_id ? 'selected' : '' }}>
                                                            {{ $user->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                @endif
                            </div>


                            <div class="d-flex justify-content-between">
                                <!-- Auditor 1 -->
                                <div class="mb-4 col-lg-5">
                                    <label for="auditor1" class="form-label">Auditor 1</label>
                                    <select name="auditor1_departemen" id="auditor1" class="form-select"
                                        style="{{ isset($data_unit->auditor->auditor1) ? '' : 'border-color: red; color: black;' }}">
                                        <option value="" style="color: black;"
                                            {{ !isset($data_unit->auditor->auditor1) ? 'selected' : '' }}>
                                            Auditor 1 Belum Di Set
                                        </option>
                                        @foreach ($auditor_users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ isset($data_unit->auditor->auditor1) && $data_unit->auditor->auditor1->user_id == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Auditor 2 -->
                                <div class="mb-4 col-lg-6">
                                    <label for="auditor2" class="form-label">Auditor 2</label>
                                    <select name="auditor2_departemen" id="auditor2" class="form-select"
                                        style="{{ isset($data_unit->auditor->auditor2) ? '' : 'border-color: red; color: black; font-color:red;' }}">
                                        <option value="" style="color: red;"
                                            {{ !isset($data_unit->auditor->auditor2) ? 'selected' : '' }}>
                                            Auditor 2 Belum Di Set
                                        </option>
                                        @foreach ($auditor_users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ isset($data_unit->auditor->auditor2) && $data_unit->auditor->auditor2->user_id == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->nama }} (NIP: {{ $user->nip }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </form>
                    {{-- END-Content --}}
                </div>
            </div>
        </div>
    </div>

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

            addBranchBtn.addEventListener('click', function() {
                const clone = departmentTemplate.cloneNode(true);
                const inputs = clone.querySelectorAll('input');
                inputs.forEach(function(input) {
                    input.value = '';
                });
                document.querySelector('.department-fields').appendChild(clone);
            });
        });
    </script>
@endsection
