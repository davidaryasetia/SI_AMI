@extends('layouts.main')
@push('css')
    <style>
        textarea::placeholder {
            font-size: 12px;
        }

        textarea.small-text{
            font-size: 12px;
            color: black;
        }

        select.small-text{
            font-size: 12px;
            color: black;
        }

        .tippy-box[data-theme~='custom'] {
            background-color: whitesmoke
        }
    </style>
@endpush

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
                            <div id="tooltip-info" class="ms-3 align-items-center" style="cursor: pointer;">
                                <i class="ti ti-info-circle fs-5 text-primary"></i>
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
                                    <div class="mb-4 col-lg-1">
                                        <label for="unit" class="form-label">Kode IKUK</label>
                                        <textarea type="text" name="kode_ikuk[]" id="kode_ikuk" class="form-control small-text @error('kode_ikuk') is-invalid @enderror"
                                            required placeholder="Kode IKUK..."></textarea>
                                        @error('kode_ikuk')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4 col-lg-4">
                                        <label for="unit" class="form-label">Indikator Kinerja Unit Kerja</label>
                                        <textarea type="text" class="form-control small-text @error('isi_indikator_kinerja_unit_kerja') is-invalid @enderror"
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
                                        <textarea type="text" class="form-control small-text @error('satuan_ikuk') is-invalid @enderror" id="satuan_ikuk"
                                            name="satuan_ikuk[]" aria-describedby="emailHelp" placeholder="Satuan" required autofocus></textarea>
                                        @error('satuan')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4 col-lg-1">
                                        <label for="unit" class="form-label">Target 1</label>
                                        <textarea type="text" class="form-control small-text @error('target1') is-invalid @enderror" id="target1" name="target1[]"
                                            aria-describedby="emailHelp" placeholder="Target 1"></textarea>
                                        @error('satuan')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4 col-lg-1">
                                        <label for="unit" class="form-label">Target 2</label>
                                        <textarea type="text" class="form-control small-text @error('target2') is-invalid @enderror" id="target2" name="target2[]"
                                            aria-describedby="emailHelp" placeholder="Target 2"></textarea>
                                        @error('target2')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4 col-lg-2">
                                        <label for="unit" class="form-label">Link</label>
                                        <textarea type="text" class="form-control small-text @error('link') is-invalid @enderror" id="link" name="link[]"
                                            aria-describedby="emailHelp" placeholder="Link" required autofocus></textarea>
                                        @error('link')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4 col-lg-1">
                                        <label for="unit" class="form-label">Pilih Tipe</label>
                                        <select name="tipe" id="tipe"
                                            class="form-select small-text @error('tipe') is-invalid @enderror" required>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                        @error('tipe')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <hr>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tippy('#tooltip-info', {
                content: `
            <div style="text-align: left;">
                <p style="font-size:16px; color:black; font-weight:600">Jenis Tipe Perhitungan Indikator Kinerja : </p>
                <ol type=1 style="color:black; ">
                    <li>Tipe 0 : jika realisasi >= target yang diterapkan berarti status realisasi melampaui (Capaian yang lebih besar dari target lebih baik)</li>    
                    <hr>
                    <li>Tipe 1 : jika realisasi <= target yang diterapkan berarti status realiasasi melampaui (Capaian yang lebih kecil dari target akan berstatus lebih baik)</li> 
                    <hr>
                    <li>Tipe 2 (range) : jika realisasi masuk di dalam range pada target 1 dan target 2 yang diterapkan maka, memenuhi, jika di luar range tidak memenuhi</li>
                </ol>
            </div>
        `,
                allowHTML: true,
                theme: 'custom',
                placement: 'bottom',
                interactive: true,
                maxWidth: '300px'
            });
        });
    </script>
@endsection
