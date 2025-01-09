@extends('layouts.main')
@push('css')
    <style>
        ul {
            padding-left: 20px;
            list-style-type: none;
        }

        ul li {
            padding: 5px 0;
        }

        .font-weight-bold {
            font-size: 14px;
        }

        .mt-1 {
            margin-top: 5px;
        }

        .ml-3 {
            margin-left: 15px;
        }
    </style>
@endpush
@section('title', 'Edit Semua Data Unit')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('ploting.update_all') }}" method="POST">
            @csrf
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="/data_user" class="d-flex align-items-center"><i class="ti ti-arrow-left me-3"
                                    style="font-size: 20px; color: black"></i></a>
                        </div>
                        <div>
                            <span class="card-title fw-semibold me-3">Edit User</span>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="ti ti-send me-2"></i>Simpan
                                Data</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="table_ploting" class="table table-bordered table-hover text-nowrap align-middle" style="width: 100%">
                    <thead class="">
                        <tr style="color: black">
                            <th>No</th>
                            <th>Nama Unit</th>
                            <th>Tipe Unit</th>
                            <th>Audite</th>
                            <th>Auditor 1</th>
                            <th>Auditor 2</th>
                        </tr>
                    </thead>
                    <tbody style="color: black">
                        @foreach ($data_units as $index => $unit)
                            <tr style="color: black">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <!-- Untuk Departemen Kerja -->
                                    @if ($unit->tipe_data == 'departemen_kerja' && $unit->units_cabang->isNotEmpty())
                                        <b>{{ $unit->nama_unit }}</b> <!-- Nama unit sebagai teks statis -->
                                        <ul class="mb-0 mt-4 ml-3">
                                            @foreach ($unit->units_cabang as $unitCabang)
                                                <li class="mt-2">
                                                    <span
                                                        class="d-block font-weight-bold">{{ $unitCabang->nama_unit_cabang }}</span>
                                                    <select
                                                        name="units[{{ $unit->unit_id }}][audite_cabang][{{ $unitCabang->unit_cabang_id }}]"
                                                        class="form-control mt-2"
                                                        style="{{ !$unitCabang->audites->pluck('user_id')->isNotEmpty() ? 'border-color: red; color: inherit;' : '' }}">
                                                        <option value=""
                                                            {{ !$unitCabang->audites->pluck('user_id')->isNotEmpty() ? 'selected style=color:red;' : '' }}>
                                                            {{ !$unitCabang->audites->pluck('user_id')->isNotEmpty() ? 'Audite Prodi Belum Di Set!' : 'Pilih Audite Prodi' }}
                                                        </option>
                                                        @foreach ($audite_users as $user)
                                                            <option value="{{ $user->user_id }}"
                                                                {{ $unitCabang->audites->pluck('user_id')->contains($user->user_id) ? 'selected' : '' }}>
                                                                {{ $user->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <!-- Untuk Unit Kerja -->
                                        <b>{{ $unit->nama_unit }}</b> <!-- Nama unit sebagai teks statis -->
                                    @endif
                                </td>

                                <td>{{ ucfirst(str_replace('_', ' ', $unit->tipe_data)) }}</td>
                                <td>
                                    <select name="units[{{ $unit->unit_id }}][audite]" class="form-control">
                                        <option value="">Pilih Audite</option>

                                        @php
                                            // Cari audite dengan unit_cabang_id null
                                            $kadepAudite = $unit->audite->firstWhere('unit_cabang_id', null);
                                        @endphp

                                        @foreach ($audite_users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ isset($kadepAudite) && $kadepAudite->user_id == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->nama }}
                                            </option>
                                        @endforeach

                                        {{-- Tambahkan opsi default jika tidak ada audite --}}
                                        @if (!isset($kadepAudite->user_id) || is_null($kadepAudite->user_id))
                                            <option value="" selected>Audite Belum Di Set</option>
                                        @endif
                                    </select>
                                </td>

                                <td>
                                    <select name="units[{{ $unit->unit_id }}][auditor1]" class="form-control"
                                        style="{{ !$unit->auditor || !$unit->auditor->auditor1 ? 'border-color: red; color: red;' : '' }}">
                                        <option value=""
                                            {{ !$unit->auditor || !$unit->auditor->auditor1 ? 'selected' : '' }}>
                                            {{ !$unit->auditor || !$unit->auditor->auditor1 ? 'Auditor 1 Belum Di Set!' : '' }}
                                        </option>
                                        @foreach ($auditor_users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ $unit->auditor && $unit->auditor->auditor_1 == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="units[{{ $unit->unit_id }}][auditor2]" class="form-control"
                                        style="{{ !$unit->auditor || !$unit->auditor->auditor2 ? 'border-color: red; color: red;' : '' }}">
                                        <option value=""
                                            {{ !$unit->auditor || !$unit->auditor->auditor2 ? 'selected' : '' }}>
                                            {{ !$unit->auditor || !$unit->auditor->auditor2 ? 'Auditor 2 Belum Di Set!' : '' }}
                                        </option>
                                        @foreach ($auditor_users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ $unit->auditor && $unit->auditor->auditor_2 == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan Data</button>
        </form>
    </div>

    @push('script')
        <script>
            $('#table_ploting').DataTable({
                responsive: true,
                scrollY: "640px",
                scrollX: true,
                autoWidth: false,
                pageLength: 50,
                lengthMenu: [
                    [50, 100],
                    [50, 100],
                ],
            });
        </script>
    @endpush
@endsection
