@extends('layouts.main')

@section('title', 'Tambah Data Indikator')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <a href="{{ url()->previous() }}" class="d-flex align-items-center"><i
                                        class="ti ti-arrow-left me-3" style="font-size: 20px; color: black"></i>
                                </a>
                            </div>
                            <div>
                                <span class="card-title fw-semibold me-3">Tambah Data - Indikator Kinerja Unit :
                                    {{ $data['nama_unit'] }} </span>
                            </div>
                            <div class="" style="">
                                <button type="button" class="btn rounded-pill btn-primary" id="addData">
                                    <span class="tf-icons bx bx-plus"></span><i class="ti ti-plus me-1"></i>Tambah Data
                                </button>
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
                    {{-- Content --}}

                    <form action="{{ route('data_indikator.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control @error('nama_unit') is-invalid @enderror" id="unit_id"
                            name="unit_id" aria-describedby="emailHelp" value="{{ $data['unit_id'] }}"
                            placeholder="Masukkan Nama Unit........" required>


                        <div class="ikuk-fields">
                            <div class="ikuk-template">
                                <div class="row">
                                    <div class="mb-4 col-lg-2">
                                        <label for="unit" class="form-label">Kode IKUK</label>
                                        <textarea type="text" name="kode_ikuk[]" id="kode_ikuk" class="form-control @error('kode_ikuk') is-invalid @enderror"
                                            required placeholder="Masukkan Kode IKUK...."></textarea>
                                        @error('kode_ikuk')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4 col-lg-6">
                                        <label for="unit" class="form-label">Indikator Kinerja Unit Kerja</label>
                                        <textarea type="text" class="form-control @error('isi_indikator_kinerja_unit_kerja') is-invalid @enderror"
                                            id="isi_indikator_kinerja_unit_kerja" name="isi_indikator_kinerja_unit_kerja[]" aria-describedby="emailHelp"
                                            placeholder="Masukkan Isi Indiktaor Kinerja Unit Kerja....." required autofocus></textarea>
                                        @error('isi_indikator_kinerja_unit_kerja')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4 col-lg-2">
                                        <label for="unit" class="form-label">Satuan</label>
                                        <textarea type="text" class="form-control @error('satuan_ikuk') is-invalid @enderror" id="satuan_ikuk"
                                            name="satuan_ikuk[]" aria-describedby="emailHelp" placeholder="Masukan Satuan..." required autofocus></textarea>
                                        @error('satuan')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4 col-lg-2">
                                        <label for="unit" class="form-label">Target</label>
                                        <textarea type="text" class="form-control @error('target_ikuk') is-invalid @enderror" id="target_ikuk"
                                            name="target_ikuk[]" aria-describedby="emailHelp" placeholder="Masukkan Target IKUK....." required></textarea>
                                        @error('target_ikuk')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Unit</button>
                    </form>
                    {{-- END-Content --}}
                </div>
            </div>
        </div>
    </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('addData').addEventListener('click', function() {
                var indikatorTemplate = document.querySelector('.ikuk-template').cloneNode(true);

                var inputs = indikatorTemplate.querySelectorAll('textarea, input');
                inputs.forEach(function(input) {
                    input.value = '';
                });
                
                var indikatorFields = document.querySelector('.ikuk-fields');
                indikatorFields.appendChild(indikatorTemplate);
            });

        });
    </script>
@endsection
