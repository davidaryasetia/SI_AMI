@extends('layouts.main')

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <span class="card-title fw-semibold me-3">Jadwal Pengisian AMI</span>
                            </div>
                            {{-- <div class="me-3">
                                <a href="/indikator_unit_kerja/create" type="button" class="btn btn-primary"><i
                                        class="ti ti-plus me-2"></i>Tambah IKUK</a>
                            </div> --}}
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

                    {{-- Content --}}
                    <div class="row">
                        <div class="col-lg-7">
                            <div id="calendar" class="calendar-container mb-4">
                                <!-- FullCalendar akan diinisialisasi di sini -->
                            </div>
                        </div>

                        <!-- Form Section -->
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <a href="{{ url()->previous() }}" class="d-flex align-items-center"><i
                                            class="ti ti-arrow-left me-3" style="font-size: 20px; color: black"></i>
                                    </a>
                                    <h5>Atur Tanggal Pelaksanaan AMI</h5>
                                </div>
                                <div class="card-body">
                                    <form action="/set-jadwal" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="tahun" class="form-label">Tahun</label>
                                            <input type="text" class="form-control" id="tahun" value="2024"
                                                readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="periode" class="form-label">Periode</label>
                                            <select class="form-select" id="periode" name="periode">
                                                <option selected>Pilih Periode...</option>
                                                <option value="1">Periode 1</option>
                                                <option value="2">Periode 2</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tanggal-pembukaan" class="form-label">Tanggal Pembukaan</label>
                                            <input type="date" class="form-control" id="tanggal-pembukaan"
                                                name="tanggal_pembukaan">
                                        </div>

                                        <div class="mb-3">
                                            <label for="tanggal-penutupan" class="form-label">Tanggal Penutupan</label>
                                            <input type="date" class="form-control" id="tanggal-penutupan"
                                                name="tanggal_penutupan">
                                        </div>

                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan Keterangan..."></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Set Tanggal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End-Content --}}
                    {{-- End-Content --}}
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- FullCalendar JavaScript --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    // Contoh event statis (dapat dimodifikasi sesuai data yang diambil dari database)
                    {
                        title: 'Event Satu',
                        start: '2024-02-05',
                        end: '2024-02-07'
                    },
                    {
                        title: 'Event Dua',
                        start: '2024-02-10'
                    }
                ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                selectable: true,
                select: function(info) {
                    var tanggalPembukaan = document.getElementById('tanggal-pembukaan');
                    tanggalPembukaan.value = info.startStr;
                }
            });

            calendar.render();
        });
    </script>
@endpush
