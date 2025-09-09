@extends('layouts.main')
@push('css')
    <style>
        .tippy-box[data-theme~='custom'] {
            background-color: whitesmoke;
        }

        textarea.small-text {
            font-size: 12px;
            color: black;
        }

        textarea::placeholder {
            font-size: 10px;
        }

        select.small-text {
            font-size: 12px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">


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

                    {{-- Content --}}
                    <form action="{{ route('data_indikator.updateAllByUnit', $unit->unit_id) }}" method="POST">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items center mb-4">
                                <div>
                                    <a href="{{ url()->previous() }}" class="d-flex align-items-center">
                                        <i class="ti ti-arrow-left me-3" style="font-size: 20px; color: black"></i>
                                    </a>
                                </div>
                                <div>
                                    <span class="card-title fw-semibold me-2">Edit All - Indikator Kinerja Unit :
                                        {{ $unit->nama_unit }} - {{ $total_indikator }} Indikator</span>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                            class="ti ti-send me-2"></i>Simpan Semua</button>
                                </div>
                                <div id="tooltip-info" class="ms-4 d-flex align-items-center" style="cursor: pointer;">
                                    <i class="ti ti-info-circle fs-5 text-primary"></i>
                                </div>

                            </div>

                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <input type="text" id="searchInput" class="form-control col-lg-12"
                                    placeholder="Cari indikator">
                            </div>
                        </div>
                        @csrf
                        @method('PUT')

                        <div id="indikatorContainer">
                            @foreach ($data_indikator as $indikator)
                                <div class="row indikator-item" data-kode="{{ strtolower($indikator->kode_ikuk) }}"
                                    data-indikator="{{ strtolower($indikator->isi_indikator_kinerja_unit_kerja) }}">
                                    <input type="hidden" name="indikator[{{ $loop->index }}][id]"
                                        value="{{ $indikator->indikator_kinerja_unit_kerja_id }}">

                                    <div class="mb-4 col-lg-1">
                                        <label for="kode_ikuk_{{ $loop->index }}" class="form-label">Kode IKUK</label>
                                        <textarea type="text" name="indikator[{{ $loop->index }}][kode_ikuk]" class="form-control small-text" required>{{ $indikator->kode_ikuk }}</textarea>
                                    </div>

                                    <div class="mb-4 col-lg-5">
                                        <label for="isi_indikator_kinerja_unit_kerja_{{ $loop->index }}"
                                            class="form-label">Indikator Kinerja</label>
                                        <textarea name="indikator[{{ $loop->index }}][isi_indikator_kinerja_unit_kerja]" class="form-control small-text"
                                            required>{{ $indikator->isi_indikator_kinerja_unit_kerja }}</textarea>
                                    </div>

                                    <div class="mb-4 col-lg-2">
                                        <label for="satuan_ikuk_{{ $loop->index }}" class="form-label">Satuan</label>
                                        <textarea type="text" name="indikator[{{ $loop->index }}][satuan_ikuk]" class="form-control small-text">{{ $indikator->satuan_ikuk }}</textarea>
                                    </div>

                                    <div class="mb-4 col-lg-1">
                                        <label for="target1_{{ $loop->index }}" class="form-label">Target 1</label>
                                        <textarea type="number" name="indikator[{{ $loop->index }}][target1]" class="form-control small-text"
                                            placeholder="Target 1">{{ $indikator->target1 }}</textarea>
                                    </div>

                                    <div class="mb-4 col-lg-1">
                                        <label for="target_2_{{ $loop->index }}" class="form-label">Target 2</label>
                                        <textarea type="number" name="indikator[{{ $loop->index }}][target2]" class="form-control small-text"
                                            placeholder="Target 2">{{ $indikator->target2 }}</textarea>
                                    </div>

                                    <div class="mb-4 col-lg-1">
                                        <label for="link_{{ $loop->index }}" class="form-label">Link</label>
                                        <textarea type="number" name="indikator[{{ $loop->index }}][link]" class="form-control small-text"
                                            placeholder="Link">{{ $indikator->link }}</textarea>
                                    </div>

                                    <div class="mb-4 col-lg-1">
                                        <label for="tipe_{{ $loop->index }}" class="form-label">Pilih Tipe</label>
                                        <select name="indikator[{{ $loop->index }}][tipe]" class="form-select small-text">
                                            <option value="0" {{ $indikator->tipe == 0 ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ $indikator->tipe == 1 ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ $indikator->tipe == 2 ? 'selected' : '' }}>2 (Range)
                                            </option>
                                        </select>
                                    </div>
                                    <hr>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Semua</button>
                    </form>
                    {{-- End Content --}}
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const indikatorItems = document.querySelectorAll('.indikator-item');

                searchInput.addEventListener('input', function(e) {
                    const keyword = e.target.value.toLowerCase();

                    indikatorItems.forEach(function(item) {
                        const kode = item.getAttribute('data-kode');
                        const indikator = item.getAttribute('data-indikator');

                        if (kode.includes(keyword) || indikator.includes(keyword)) {
                            item.style.display = ''; // Tampilkan item
                        } else {
                            item.style.display = 'none'; // Sembunyikan item
                        }
                    });
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
    @endpush
@endsection
