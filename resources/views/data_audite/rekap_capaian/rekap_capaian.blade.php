@extends('layouts.main')
@push('css')
    <style>
        .card-title {
            font-size: 24px;
            font-weight: bold;
        }

        .content-header {
            text-align: left;
            margin-bottom: 20px;
        }

        .pie-chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 400px;
        }

        .chart-label {
            font-size: 16px;
            text-align: center;
            margin-top: 10px;
        }

        .chart-description {
            font-size: 14px;
            text-align: left;
            margin-top: 20px;
            padding: 0 20px;
        }

        @media (max-width: 768px) {
            .content-header {
                text-align: center;
            }

            .pie-chart-container {
                height: 250px;
            }

            .chart-label {
                font-size: 14px;
            }

            .chart-description {
                text-align: center;
            }
        }
    </style>
@endpush

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="content-header">
                    <h4 class="card-title fw-semibold">Rekap Capaian</h4>
                    <p style="font-weight: bold">Unit
                        @if (session()->has('audite.unit.nama_unit'))
                            {{ session('audite.unit.nama_unit') }}
                        @endif
                    </p>
                </div>
                {{-- Content --}}
                <div class="pie-chart-container">
                    {{-- Here you can add the pie chart, e.g., using a canvas for a JavaScript chart library --}}
                    <canvas id="performanceChart"></canvas>
                </div>
                <div class="chart-label">
                    <span>Mencapai target, Melebihi target, Belum mencapai target</span>
                </div>
                {{-- Keterangan Deskripsi --}}
                <div class="chart-description">
                    <p>
                        Grafik di atas menunjukkan distribusi kinerja dari Unit P4MP berdasarkan pencapaian target.
                        Sebesar 30% dari unit telah berhasil mencapai target yang ditentukan, sementara 40% melebihi target,
                        dan sisanya sebesar 30% belum mencapai target yang telah ditetapkan.
                        Hasil ini menggambarkan bahwa sebagian besar unit mampu memenuhi atau melebihi target,
                        namun masih ada beberapa unit yang perlu ditingkatkan kinerjanya.
                    </p>
                </div>
                {{-- END Content --}}
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- You can add your chart-related scripts here, for example using Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('performanceChart').getContext('2d');
        var performanceChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Belum Mencapai Target', 'Mencapai Target', 'Melebihi'],
                datasets: [{
                    label: 'Rekap Capaian',
                    data: [30, 40, 30], // Example data
                    backgroundColor: [
                        'rgba(255, 43, 43, 1)',
                        'rgba(44, 42, 255, 0.8)',
                        'rgba(45, 255, 42, 1)',
                    ],
                    borderColor: [
                        'rgba(212, 0, 0, 1)',
                        'rgba(1, 0, 171, 0.8)',
                        'rgba(2, 181, 0, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
@endpush
