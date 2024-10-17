@extends('layouts.main_audite')
@push('css')
    <style>
        table td,
        table th {
            vertical-align: middle;
            text-align: center;
            padding: 12px;
        }

        .progress {
            height: 25px;
        }

        .btn-export {
            padding: 10px 20px;
            font-size: 16px;
        }

        /* Responsive Table */
        @media (max-width: 768px) {
            table thead {
                display: none;
            }

            table tr {
                display: block;
                margin-bottom: 10px;
            }

            table td {
                display: block;
                text-align: right;
                font-size: 14px;
                border-bottom: 1px solid #ddd;
            }

            table td::before {
                content: attr(data-label);
                float: left;
                text-transform: capitalize;
                font-weight: bold;
            }
        }
    </style>
@endpush

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title fw-semibold">Persetujuan</h4>
                </div>
                {{-- Content --}}


                {{-- END  Content --}}
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- Add necessary scripts here --}}
@endpush
