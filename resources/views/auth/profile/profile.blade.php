@extends('layouts.main')
@section('title', 'Profile')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="w-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center mb-2">
                        <div>
                            <span class="card-title fw-semibold me-3">Data Profile</span>
                        </div>
                        <div>
                            <a href="{{ route('profile.edit', Auth::user()->user_id) }}" type="button" class="">
                                <i class="ti ti-pencil me-1"></i>Edit
                            </a>
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
                <section class="section profile">
                    <div class="row">
                        <div
                            class="col-xl-4 card shadow-none border d-flex flex-column align-items-center justify-content-center">
                            <div class="pt-4 d-flex flex-column align-items-center">
                                <img src="{{ Auth::user()->foto_gambar ? Storage::disk('s3')->url(Auth::user()->foto_gambar) :  asset('assets/images/profile/user-profile.png')}}" alt="Profile" width="86" class="rounded-circle mb-3">
                                <h4>{{ Auth::user()->nama }}</h4>
                                {{-- <h5>
                                        Unit PJM
                                    </h5> --}}
                            </div>
                        </div>

                        <div class="col-xl-8 ">
                            <div class="card shadow-none border">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">
                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#profile-overview">Profile Details</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-3">
                                        <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                            <div class="row mb-3">
                                                <div class="col-lg-3 col-md-4 label"><span style="color: black">Nama</span>
                                                </div>
                                                <div class="col-lg-9 col-md-8"><span
                                                        style="color: black">{{ Auth::user()->nama }}</span></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-3 col-md-4 label"><span style="color: black">Email</span>
                                                </div>
                                                <div class="col-lg-9 col-md-8"><span
                                                        style="color: black">{{ Auth::user()->email }}</span></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-3 col-md-4 label">
                                                    <span style="color: black">Password</span>
                                                </div>
                                                <div class="col-lg-9 col-md-8">
                                                    <span style="color: black">
                                                        {{ str_repeat('*', strlen(Auth::user()->password)) }}
                                                    </span>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row mb-3">
                                                <div class="col-lg-3 col-md-4 label"><span style="color: black">Status
                                                        Admin</span></div>
                                                <div class="col-lg-9 col-md-8"><span
                                                        style="color: black">{{ Auth::user()->status_admin == 1 ? 'Ya' : '-' }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-3 col-md-4 label"><span style="color: black">Status
                                                        Auditor</span></div>
                                                <div class="col-lg-9 col-md-8"><span
                                                        style="color: black">{{ Auth::user()->isAuditor() ? 'Ya' : '-' }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-3 col-md-4 label"><span style="color: black">Status
                                                        Audite</span></div>
                                                <div class="col-lg-9 col-md-8"><span
                                                        style="color: black">{{ Auth::user()->isAudite() ? 'Ya' : '-' }}</span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                {{-- END-Content --}}
            </div>
        </div>
    </div>
@endsection
