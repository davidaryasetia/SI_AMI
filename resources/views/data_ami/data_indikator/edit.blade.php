@extends('layouts.main')
@section('title', 'Edit Data Indikator')
@push('css')
    <style>
        .tippy-box[data-theme~='custom'] {
            background-color: whitesmoke
        }

        textarea.small-text{
            color: black;
            font-size: 12px;
        }

        select.small-text{
            color: black;
            font-size: 12px;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <a href="{{ url()->previous() }}" class="d-flex align-items-center">
                                    <i class="ti ti-arrow-left me-3" style="font-size: 20px; color: black"></i>
                                </a>
                            </div>
                            <div>
                                <span class="card-title fw-semibold me-3">Edit Data - Indikator Kinerja Unit :
                                    {{ $data->nama_unit }} </span>
                            </div>
                            <div id="tooltip-info" class="ms-1 align-items-center" style="cursor: pointer;">
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

                    <form action="/data_indikator/{{ $data['indikator_kinerja_unit_kerja_id'] }}" method="POST"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" class="form-control small-text  @error('nama_unit') is-invalid @enderror"
                            id="unit_id" name="unit_id" aria-describedby="emailHelp" value="{{ $data['unit_id'] }}"
                            placeholder="Masukkan Nama Unit........" required>
                        <div class="row">
                            <div class="mb-4 col-lg-1">
                                <label for="unit" class="form-label">Kode IKUK</label>
                                <textarea type="text" name="kode_ikuk" id="kode_ikuk"
                                    class="form-control small-text @error('kode_ikuk') is-invalid @enderror" required
                                    placeholder="Masukkan Kode IKUK...."> {{ $data->kode_ikuk }} </textarea>
                                @error('kode_ikuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4 col-lg-5">
                                <label for="unit" class="form-label">Indikator Kinerja Unit Kerja</label>
                                <textarea type="text" class="form-control small-text @error('isi_indikator_kinerja_unit_kerja') is-invalid @enderror"
                                    id="isi_indikator_kinerja_unit_kerja" name="isi_indikator_kinerja_unit_kerja" aria-describedby="emailHelp"
                                    placeholder="Masukkan Isi Indiktaor Kinerja Unit Kerja....." required autofocus> {{ $data->isi_indikator_kinerja_unit_kerja }} </textarea>
                                @error('isi_indikator_kinerja_unit_kerja')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4 col-lg-2">
                                <label for="unit" class="form-label">Satuan</label>
                                <textarea type="text" class="form-control small-text @error('satuan_ikuk') is-invalid @enderror" id="satuan_ikuk"
                                    name="satuan_ikuk" aria-describedby="emailHelp" placeholder="Masukan Satuan..." required autofocus> {{ $data->satuan_ikuk }} </textarea>
                                @error('satuan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4 col-lg-1">
                                <label for="unit" class="form-label">Target 1</label>
                                <textarea type="text" class="form-control small-text @error('target1') is-invalid @enderror" id="target1"
                                    name="target1" aria-describedby="emailHelp" placeholder="Target 1" required> {{ $data->target1 }} </textarea>
                                @error('target1')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4 col-lg-1">
                                <label for="unit" class="form-label">Target 2</label>
                                <textarea type="text" class="form-control small-text @error('target2') is-invalid @enderror" id="target2"
                                    name="target2" aria-describedby="emailHelp" placeholder="Masukkan Target IKUK" required> {{ $data->target2 }} </textarea>
                                @error('target2')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4 col-lg-1">
                                <label for="unit" class="form-label">Link</label>
                                <textarea type="text" class="form-control small-text @error('link') is-invalid @enderror" id="link"
                                    name="link" aria-describedby="emailHelp" placeholder="Masukkan Target IKUK....."> {{ $data->link }} </textarea>
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
                                    <option value="0" {{ $data->tipe == 0 ? 'selected' : '' }}>O</option>
                                    <option value="1"{{ $data->tipe == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $data->tipe == 2 ? 'selected' : '' }}>2</option>
                                </select>
                                @error('tipe')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Data Indikator</button>
                    </form>
                    {{-- END-Content --}}
                </div>
            </div>
        </div>
    </div>
    @push('script')
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
    @endpush
@endsection
