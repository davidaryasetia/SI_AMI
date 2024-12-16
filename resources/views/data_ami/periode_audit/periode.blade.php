@extends('layouts.main')

@section('title', 'Periode Audit')
@push('css')
    <style>
        table td,
        table th {
            vertical-align: middle;
        }

        .btn-sm {
            padding: 4px 10px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-control {
                width: 100%;
            }

            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <a href="/periode_audit" class="{{ isset($edit_periode) ? '' : 'd-none' }}">
                            <i class="ti ti-arrow-left me-3" style="font-size: 20px; color: black"></i>
                        </a>
                        <h4 class="card-title fw-semibold">
                            {{ isset($edit_periode) ? 'Edit Jadwal Pengisian AMI' : 'Buat Jadwal Pengisian AMI' }}
                        </h4>
                    </div>

                    <div>
                        @if (session('success'))
                            <div class="alert alert-primary" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <script>
                            setTimeout(function() {
                                document.querySelectorAll('.alert').forEach(function(alert) {
                                    alert.style.display = "none";
                                });
                            }, 5000);
                        </script>
                    </div>
                </div>

                {{-- Form Input Periode --}}
                <form
                    action="{{ isset($edit_periode) ? route('periode_audit.update', $edit_periode->jadwal_ami_id) : route('periode_audit.store') }}"
                    method="POST" class="col-lg-6">
                    @csrf
                    @if (isset($edit_periode))
                        @method('PUT')
                    @endif


                    <div class="form-group mb-3">
                        <label for="namaPeriode" class="form-label">Nama Periode AMI</label>
                        <input type="text" class="form-control" name="nama_periode_ami" id="namaPeriode"
                            placeholder="Nama Periode AMI"
                            value="{{ old('nama_periode_ami', $edit_periode->nama_periode_ami ?? '') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_pembukaan_ami" class="form-label">Mulai</label>
                        <input type="date" class="form-control" name="tanggal_pembukaan_ami" id="tanggal_pembukaan_ami"
                            value="{{ old('tanggal_pembukaan_ami', $edit_periode->tanggal_pembukaan_ami ?? '') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_penutupan_ami" class="form-label">Selesai</label>
                        <input type="date" class="form-control" name="tanggal_penutupan_ami" id="tanggal_penutupan_ami"
                            value="{{ old('tanggal_penutupan_ami', $edit_periode->tanggal_penutupan_ami ?? '') }}" required>
                    </div>
                    <div class="d-grid col-lg-4 gap-2 mt-4">
                        <button type="submit"
                            class="btn btn-primary">{{ isset($edit_periode) ? 'Update Periode' : 'Tambah Periode' }}</button>
                    </div>
                </form>

                {{-- Tabel Periode AMI --}}
                <div class="table-responsive mt-4">
                    <h4 class="card-title fw-semibold mb-4">Riwayat Jadwal Pengisian</h4>
                    <table class="table table-hover table-bordered" id="periode_pelaksanaan">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Periode AMI</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Status</th>
                                <th>Tutup</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $nomor = 1; @endphp
                            @foreach ($data_periode as $periode)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $periode->nama_periode_ami }}</td>
                                    <td>{{ \Carbon\Carbon::parse($periode->tanggal_pembukaan_ami)->translatedFormat('d M Y') }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($periode->tanggal_penutupan_ami)->translatedFormat('d M Y') }}
                                    </td>
                                    <td>
                                        @if ($periode->status == 'Sedang Berjalan')
                                            <span class="badge ms-2"
                                                style="background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; font-weight: bold">{{ $periode->status }}</span>
                                        @else
                                            <span class="badge ms-2"
                                                style="background-color: #ff0000; color: #ffffff; border-color: #dd8d8d; font-weight: bold">{{ $periode->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm" style="background-color: rgb(251, 94, 94); color: white"
                                            data-bs-toggle="modal"
                                            data-bs-target="#closeModal{{ $periode->jadwal_ami_id }}">
                                            <i class="ti ti-logout"></i>
                                        </button>

                                        <!-- Modal Konfirmasi Tutup Periode -->
                                        <div class="modal fade" id="closeModal{{ $periode->jadwal_ami_id }}" tabindex="-1"
                                            aria-labelledby="closeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="closeModalLabel">Konfirmasi Tutup
                                                            Periode</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="line-height: normal">Untuk menutup periode pelaksanaan AMI ini, harap masukkan nama
                                                            periode:</p>
                                                        <strong>{{ $periode->nama_periode_ami }}</strong>
                                                        <input type="text" class="form-control mt-2 confirm-name-input"
                                                            placeholder="Masukkan nama periode untuk konfirmasi"
                                                            data-expected="{{ $periode->nama_periode_ami }}">
                                                            <div
                                                            style="background-color: #fff3cd; color: #856404; padding: 15px; border: 1px solid #ffeeba; border-radius: 5px; margin-top: 15px; line-height: normal">
                                                            <strong>Perhatian:</strong> Menutup periode ini akan menghentikan semua aktivitas terkait jadwal periode ini.
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form
                                                            action="{{ route('periode_audit.close', $periode->jadwal_ami_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-danger close-button"
                                                                style="display: none;">Tutup</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>


                                    <td><a href="{{ route('periode_audit.index', ['id' => $periode->jadwal_ami_id]) }}"
                                            class="btn btn-sm" style="background-color: rgb(255, 255, 6); color: black"><i
                                                class="ti ti-pencil"></i></a></td>
                                    <td>
                                        <button class="btn btn-sm" style="background-color: rgb(255, 0, 0); color: white"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $periode->jadwal_ami_id }}">
                                            <i class="ti ti-x"></i>
                                        </button>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal fade" id="deleteModal{{ $periode->jadwal_ami_id }}"
                                            tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="line-height: normal">Untuk menghapus periode pelaksanaan
                                                            AMI ini, harap masukkan nama
                                                            periode:</p>
                                                        <strong
                                                            style="display: block">{{ $periode->nama_periode_ami }}</strong>
                                                        <input type="text" class="form-control mt-2 confirm-name-input"
                                                            placeholder="Masukkan nama periode untuk konfirmasi"
                                                            data-expected="{{ $periode->nama_periode_ami }}">
                                                        <div
                                                            style="background-color: #fff3cd; color: #856404; padding: 15px; border: 1px solid #ffeeba; border-radius: 5px; margin-top: 15px; line-height: normal">
                                                            <strong>Perhatian :</strong> Menghapus Periode AMI ini akan
                                                            menghapus seluruh riwayat pelaksanaan AMI pada periode tanggal
                                                            tersebut.
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form
                                                            action="{{ route('periode_audit.destroy', $periode->jadwal_ami_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <!-- Tambahkan kelas `delete-button` untuk dikontrol melalui JavaScript -->
                                                            <button type="submit" class="btn btn-danger delete-button"
                                                                style="display: none;">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <script>
                                    document.addEventListener('input', function(event) {
                                        // Cek apakah input yang diubah adalah input konfirmasi
                                        if (event.target.classList.contains('confirm-name-input')) {
                                            // Ambil nilai yang diharapkan dari atribut data-expected
                                            const expectedName = event.target.getAttribute('data-expected').trim();
                                            // Ambil tombol hapus terkait
                                            const deleteButton = event.target.closest('.modal').querySelector('.delete-button');

                                            console.log("Expected Name:", expectedName); // Debugging
                                            console.log("Input Value:", event.target.value.trim()); // Debugging

                                            // Aktifkan (tampilkan) atau nonaktifkan (sembunyikan) tombol hapus berdasarkan kesesuaian input
                                            if (event.target.value.trim() === expectedName) {
                                                deleteButton.style.display = 'inline-block'; // Tampilkan tombol
                                                console.log("Button 'Hapus' ditampilkan"); // Debugging
                                            } else {
                                                deleteButton.style.display = 'none'; // Sembunyikan tombol
                                                console.log("Button 'Hapus' disembunyikan"); // Debugging
                                            }
                                        }
                                    });
                                </script>
                                <script>
                                    document.addEventListener('input', function(event) {
                                        // Cek apakah input adalah input konfirmasi nama
                                        if (event.target.classList.contains('confirm-name-input')) {
                                            const expectedName = event.target.getAttribute('data-expected').trim();
                                            const closeButton = event.target.closest('.modal').querySelector('.close-button');

                                            // Aktifkan tombol jika nama sesuai
                                            if (event.target.value.trim() === expectedName) {
                                                closeButton.style.display = 'inline-block';
                                            } else {
                                                closeButton.style.display = 'none';
                                            }
                                        }
                                    });
                                </script>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            // ------------- Data Audit Mutu Internal ------------
            $('#periode_pelaksanaan').DataTable({
                responsive: true,
                "scrollY": "500px",
                scrollX: true,
                autoWidth: false,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100],
                    [50, 100],
                ],
            });
        </script>
    @endpush

@endsection
