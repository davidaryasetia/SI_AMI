@extends('layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Profile User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ asset('assets/img/user.jpeg') }}" alt="Profile" class="rounded-circle">
                        <h2>Hary Oktavianto</h2>
                        <h3>Unit PJM</h3>

                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8">Hary Oktavianto</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">NIP</div>
                                    <div class="col-lg-9 col-md-8">197610012001121001</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Unit</div>
                                    <div class="col-lg-9 col-md-8">PJM</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status Admin</div>
                                    <div class="col-lg-9 col-md-8">Ya</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status Audite</div>
                                    <div class="col-lg-9 col-md-8">Tidak</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status Auditor</div>
                                    <div class="col-lg-9 col-md-8">Ya</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Unit Diaudit : </div>
                                    <div class="col-lg-9 col-md-8">BAAK</div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">(0821)-486-3538 x29071</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">hary@pens.ac.id</div>
                                </div>

                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
