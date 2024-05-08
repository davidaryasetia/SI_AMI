@extends('layouts.main')

@section('container')
    <div class="pagetitle">

        {{-- <h1>Data User Pengguna</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data Audit</li>
        <li class="breadcrumb-item active">Data User</li>
      </ol>
    </nav>
  </div><!-- End Page Title --> --}}

        <section class="section dashboard">
            <div class="row ">
                <div class="col-12">
                    <div class="recent-sales overflow-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center ml-0">
                                    <a href="/data_audit/data_user_pengguna/" type="" class="ms-2"><i
                                            class="ri-arrow-left-line" style="font-size: 26px; color: #012970"></i></a>
                                    <h5 class="card-title ms-3">Tambah Data User Pengguna</h5>
                                </div>
                                <div class="col-lg-12">
                                    <form action="/data_audit/data_user_pengguna/" method="post"
                                        enctype="multipart/form-data" class="row g-3">
                                        @csrf
                                        <div class="col-md-6">
                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text"
                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Nama Lengkap"
                                                required autofocus>
                                            @error('nama_lengkap')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nip" class="form-label">NIP</label>
                                            <input type="string" class="form-control @error('nip') is-invalid @enderror"
                                                name="nip" id="nip" placeholder="Masukkan NIP" required>
                                            @error('nip')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" placeholder="Masukkan Email" required>
                                            @error('email')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                id="password" placeholder="Masukkan Password" required>
                                            @error('password')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="no-telepon" class="form-label">No Telepon</label>
                                            <input type="string"
                                                class="form-control @error('no_telepon') is-invalid @enderror"
                                                name="no_telepon" id="no_telepon" placeholder="Masukkan Nomor Telepon"
                                                required>
                                            @error('no_telepon')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="unit_id" class="form-label">Pilih Unit PIC User</label>
                                            <select id="unit_id" name="unit_id" class="form-select" required>
                                                <option selected>Pilih Unit</option>
                                                @foreach ($units as $unit)
                                                    @if (old('unit_id') == $unit->unit_id)
                                                        <option value="{{ $unit->unit_id }} selected">{{ $unit->nama_unit }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $unit->unit_id }}">{{ $unit->nama_unit }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset class="row mt-4">
                                                <legend class="col-form-label col-sm-6 pt-0">Status Admin ? </legend>
                                                <div class="form-check col-sm-3">
                                                    <input class="form-check-input" type="radio" name="gridRadios"
                                                        id="gridRadios1" value="option1" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Ya
                                                    </label>
                                                </div>
                                                <div class="form-check col-sm-3">
                                                    <input class="form-check-input" type="radio" name="gridRadios"
                                                        id="gridRadios2" value="option2">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Tidak
                                                    </label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <hr>
                                        <div class="col-md-6">
                                            <fieldset class="row mt-4">
                                                <legend class="col-form-label col-sm-6 pt-0">Status Auditee ? </legend>
                                                <div class="form-check col-sm-3">
                                                    <input class="form-check-input" type="radio" name="gridRadios"
                                                        id="gridRadios1" value="option1" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Ya
                                                    </label>
                                                </div>
                                                <div class="form-check col-sm-3">
                                                    <input class="form-check-input" type="radio" name="gridRadios"
                                                        id="gridRadios2" value="option2">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Tidak
                                                    </label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <hr>
                                        <div class="col-md-6">
                                            <fieldset class="row mt-4">
                                                <legend class="col-form-label col-sm-6 pt-0">Status Auditor ? </legend>
                                                <div class="form-check col-sm-3">
                                                    <input class="form-check-input" type="radio" name="gridRadios"
                                                        id="gridRadios1" value="option1" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Ya
                                                    </label>
                                                </div>
                                                <div class="form-check col-sm-3">
                                                    <input class="form-check-input" type="radio" name="gridRadios"
                                                        id="gridRadios2" value="option2">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Tidak
                                                    </label>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label">Pilih Unit Yang Diaudit</label>
                                            <select id="unit_id_diaudit" name="unit_id_diaudit" class="form-select">
                                                <option selected>Pilih Unit Yang Diaudit Auditor</option>
                                                @foreach ($units as $unit)
                                                    @if (old('unit_id_diaudit') == $unit->unit_id)
                                                        <option value="{{ $unit->unit_id }} selected">
                                                            {{ $unit->nama_unit }}</option>
                                                    @else
                                                        <option value="{{ $unit->unit_id }}">{{ $unit->nama_unit }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary"><i class="ri-check-fill">
                                                    Submit</i></button>
                                            <a href="/data_audit/data_user_pengguna/" type=""
                                                class="btn btn-danger ms-2"><i class="ri-close-fill"> Cancel</i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
