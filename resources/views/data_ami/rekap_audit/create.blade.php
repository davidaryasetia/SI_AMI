=@extends('layouts.main')

@section('row')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mb-2">
                            <div class="me-3">
                                <span class="card-title fw-semibold">Progress Audit</span>
                            </div>
                            <div class="me-2">
                                <a href="data_unit/create" type="button" class="btn btn-primary"><i
                                        class="ti ti-plus me-1"></i>Tambah Unit | Departement</a>
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



                    {{-- End - Content --}}

                </div>
            </div>
        </div>
    </div>
    {{-- JS --}}
    @push('script')
    @endpush
@endsection
