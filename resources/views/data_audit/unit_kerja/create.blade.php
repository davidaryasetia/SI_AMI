@extends('layouts.main')

@section('container')

<div class="pagetitle">
    {{-- <h1>Unit</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Unit</li>
      </ol>
    </nav>
  </div> --}}

  <section class="section dashboard">
    <div class="row ">
      <div class="col-12">
          <div class="recent-sales overflow-auto">
              <div class="card">
                  <div class="card-body">
                      <div class="d-flex align-items-center">
                          <a href="/data_audit/unit_kerja/" type="" class="ms-2"><i class="ri-arrow-left-line" style="font-size: 26px; color: #012970"></i></a>
                          <h5 class="card-title ms-3">Tambah Data Unit</h5>
                      </div>
                      <div class="col-lg-6">
                          <form action="/data_audit/unit_kerja/" method="post" enctype="multipart/form-data" class="row g-3">
                              @csrf
                              <div class="col-12">
                                  <label for="unit" class="form-label">Nama Unit</label>
                                  <input type="text" class="form-control @error('nama_unit') is-invalid @enderror" name="nama_unit" id="nama_unit" placeholder="Masukkan Nama Unit" required autofocus>
                                  @error('nama_unit')
                                  <div class="alert alert-danger mt-2">
                                      {{$message}}
                                  </div>
                                  @enderror
                              </div>
                              <div class="">
                                  <button type="submit" class="btn btn-primary">Submit</button>
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
