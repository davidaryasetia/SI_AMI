@extends('layouts.main')

@section('container')

<div class="pagetitle">
    <h1>Data Indikator Kinerja</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data Audit</li>
        <li class="breadcrumb-item active">Indikator Kinerja Unit</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="card-title">Data Indikator Kinerja Unit</h5>
                    <span class="divider"></span>
                    {{-- <a href="/data_audit/unit_kerja/create" class="btn btn-primary btn-sm ms-2"><i class="ri-add-line">Tambah Data User Pengguna</i></a> --}}
                    <select class="form-select w-25 bg-light" aria-label="Default select example">
                        <option selected>Pilih Data Indikator Unit</option>
                        @foreach($units as $unit)
                        <option value="{{$unit->id}}">{{$unit->nama_unit}}</option>
                        @endforeach
                      </select>
                </div>

                <!-- Table with stripped rows -->
                <table class="table datatable table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th>Indikator Kinerja Unit (Ikuk)</th>
                      <th>Satuan</th>
                      <th>Target</th>
                      <th>Realisasi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($indikators as $indikator)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$indikator->kode}}</td>
                      <td>{{$indikator->indikator_kinerja_unit_kerja}}</td>
                      <td>{{$indikator->satuan}}</td>
                      <td>{{$indikator->target}}</td>
                      <td></td>
                      <td>
                          <div style="display: inline-block">
                              <a href="" class="btn btn-sm btn-primary"><i class="ri-pencil-line"></i></a>
                          </div>
                          <div style="display: inline-block">
                          <form action="" method="POST">
                                  @method('delete')
                                  @csrf
                                  <button type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Unit?')" class="btn btn-sm btn-danger"><i class="ri-delete-bin-2-line"></i></button>
                          </form>
                          </div>
                      </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">Data Tidak Tersedia</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
                {{$indikators->links()}}
              </div>
            </div>
          </div>
        </div>
        </div>
  </section>

@endsection
