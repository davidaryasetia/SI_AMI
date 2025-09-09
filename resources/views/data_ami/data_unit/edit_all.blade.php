@extends('layouts.main')
@section('title', 'Edit Semua Unit Kerja & Departemen')
@push('css')
    <style>
        .tippy-box[data-theme~='custom'] {
            background-color: whitesmoke;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <form action="{{ route('data_unit.updateAll') }}" method="POST">
            <div class="d-flex justify-content-start align-items-center mb-4">
                <a href="/data_unit" class="d-flex align-items-center">
                    <i class="ti ti-arrow-left me-3" style="font-size: 20px; color: black"></i></a>
                <span class="fw-semibold me-3" style="font-size: 16px; color: black">Edit Unit Kerja</span>
                <div>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="ti ti-send me-2"></i>Update Semua
                        Data</button>
                </div>
                <div id="tooltip-info" class="ms-3 d-flex align-items-center" style="cursor: pointer;">
                    <i class="ti ti-info-circle fs-5 text-primary"></i>
                </div>
            </div>

            @csrf
            @method('PUT')
            <div class="table-responsive">
                <table id="table_edit_all" class="table table-hover text-nowrap mb-0 table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Unit</th>
                            <th>Tipe Data</th>
                            <th>Unit/Prodi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_units as $index => $unit)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <input type="hidden" name="data_units[{{ $index }}][id]"
                                        value="{{ $unit->unit_id }}">
                                    <input type="text" name="data_units[{{ $index }}][nama_unit]"
                                        value="{{ $unit->nama_unit }}" class="form-control" required>
                                </td>
                                <td>
                                    <select name="data_units[{{ $index }}][tipe_data]" class="form-select tipe-data"
                                        data-index="{{ $index }}" disabled>
                                        <option value="unit_kerja" {{ $unit->tipe_data == 'unit_kerja' ? 'selected' : '' }}>
                                            Unit Kerja</option>
                                        <option value="departemen_kerja"
                                            {{ $unit->tipe_data == 'departemen_kerja' ? 'selected' : '' }}>Departemen Kerja
                                        </option>
                                    </select>
                                    <input type="hidden" name="data_units[{{ $index }}][tipe_data]"
                                        value="{{ $unit->tipe_data }}">
                                </td>
                                <td>
                                    <div class="unit-prodi-container" data-index="{{ $index }}">
                                        @if ($unit->tipe_data == 'departemen_kerja')
                                            @foreach ($unit->units_cabang as $key => $unitCabang)
                                                <div class="d-flex mb-2">
                                                    <input type="hidden"
                                                        name="data_units[{{ $index }}][units_cabang][{{ $key }}][id]"
                                                        value="{{ $unitCabang->unit_cabang_id }}">
                                                    <input type="text"
                                                        name="data_units[{{ $index }}][units_cabang][{{ $key }}][nama_unit_cabang]"
                                                        value="{{ $unitCabang->nama_unit_cabang }}" class="form-control"
                                                        placeholder="Nama Prodi">
                                                    <button type="button" class="btn btn-danger ms-2"
                                                        onclick="this.parentElement.remove()">Hapus</button>
                                                </div>
                                            @endforeach
                                            <button type="button" class="btn btn-secondary add-prodi"
                                                data-index="{{ $index }}">Tambah Prodi</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">Update Semua Data</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Toggle "Tambah Cabang" or "Prodi" buttons
            document.querySelectorAll('.tipe-data').forEach(select => {
                select.addEventListener('change', () => {
                    const index = select.dataset.index;
                    const container = document.querySelector(
                        `.unit-prodi-container[data-index="${index}"]`);
                    container.innerHTML = ''; // Reset container content

                    if (select.value === 'departemen_kerja') {
                        const addButton = document.createElement('button');
                        addButton.type = 'button';
                        addButton.classList.add('btn', 'btn-secondary', 'add-prodi', 'mb-2');
                        addButton.innerText = 'Tambah Prodi';
                        addButton.dataset.index = index;

                        // Event to add new prodi
                        addButton.addEventListener('click', () => {
                            const newField = document.createElement('div');
                            newField.classList.add('d-flex', 'mb-2');
                            newField.innerHTML = `
                            <input type="text" name="data_units[${index}][units_cabang][][nama_unit_cabang]" class="form-control" placeholder="Nama Prodi">
                            <button type="button" class="btn btn-danger ms-2" onclick="this.parentElement.remove()">Hapus</button>
                        `;
                            container.appendChild(newField);
                        });

                        container.appendChild(addButton);
                    }
                });
            });

            // Handle existing "Tambah Prodi" buttons
            document.querySelectorAll('.add-prodi').forEach(button => {
                button.addEventListener('click', () => {
                    const index = button.dataset.index;
                    const container = button.parentElement;
                    const newField = document.createElement('div');
                    newField.classList.add('d-flex', 'mb-2');
                    newField.innerHTML = `
                    <input type="text" name="data_units[${index}][units_cabang][][nama_unit_cabang]" class="form-control" placeholder="Nama Prodi">
                    <button type="button" class="btn btn-danger ms-2" onclick="this.parentElement.remove()">Hapus</button>
                `;
                    container.insertBefore(newField, button);
                });
            });
        });
    </script>

    @push('script')
        <script>
            // ------------- Data Audit Mutu Internal ------------
            $('#table_edit_all').DataTable({
                responsive: true,
                "scrollY": "700px",
                scrollX: true,
                autoWidth: false,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100],
                    [50, 100],
                ],
                "columnDefs": [{
                    targets: 0, // Target kolom "No"
                    width: '2%' // Sesuaikan persentase lebar kolom
                }],
                columns: [{
                        width: '2%' // Sesuaikan dengan kebutuhan (kolom No)
                    },
                    {
                        width: '35%' // Sesuaikan dengan kebutuhan (kolom Unit Kerja)
                    },
                    {
                        width: '10%' // Sesuaikan dengan kebutuhan (kolom Edit)
                    },
                    {
                        width: '20%' // Sesuaikan dengan kebutuhan (kolom Delete)
                    },
                ]
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                tippy('#tooltip-info', {
                    content: `
                <div style="text-align: left; color:black">
                    <ul>
                    <li style="font-size: 14px; color: black; font-weight: 600">Total Unit Kerja dan Departemen : {{ $total_units }}</li>
                    <li style="font-size: 14px; color: black; font-weight: 600">Total Unit Kerja : {{ $total_unit_kerja }}</li>
                    <li style="font-size: 14px; color: black; font-weight: 600">Total Departemen Kerja : {{ $total_departemen_kerja }}</li>
                    </ul>
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
