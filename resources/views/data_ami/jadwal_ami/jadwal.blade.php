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
                            <div class="me-2">
                                <a href="{{route('jadwal_ami.create')}}" id="tambahIkukBtn" type="button" class="btn btn-primary" disabled><i
                                        class="ti ti-plus me-1"></i>Buat Jadwal</a>
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
                    <div class="row">
                        <!-- Kalender Jadwal Pengisian AMI -->
                        <div class="col-lg-7">
                            <div id="calendar" class="calendar-container mb-4">
                                <!-- FullCalendar akan diinisialisasi di sini -->
                            </div>
                        </div>

                        <!-- Informasi Jadwal -->
                        <div class="col-lg-5">
                            <div class="card jadwal-pelaksanaan-card">
                                <div class="card-body">
                                    <h5 class="card-title">Jadwal Pelaksanaan AMI</h5>
                                    <ul class="jadwal-list">
                                        <li><span>Tahun:</span> -</li>
                                        <li><span>Periode:</span> -</li>
                                        <li><span>Tanggal Pembukaan:</span> -</li>
                                        <li><span>Tanggal Penutupan:</span> -</li>
                                        <li><span>Keterangan:</span> -</li>
                                        <li><span>Status:</span> <span class="status-label">Belum Di Buka</span></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
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
                events: [{
                        title: 'Jadwal Pembukaan AMI',
                        start: '2024-02-05',
                        end: '2024-02-07'
                    },
                    {
                        title: 'Jadwal Penutupan AMI',
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
