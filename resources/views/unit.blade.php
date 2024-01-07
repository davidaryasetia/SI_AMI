@extends('layouts.main')

@section('container')
<div class="pagetitle">
    <h1>Daftar Unit Kerja</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data Audit</li>
        <li class="breadcrumb-item active">Unit</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="unit">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                  <h5 class="card-title">Unit Kerja</h5>
                  <span class="divider"></span>
                  <a href="{{route('add_unit')}}" class="btn btn-primary btn-sm ms-2"><i class="ri-add-line">Tambah Unit</i></a>
              </div>

              <!-- Table with stripped rows -->
              <table class="table datatable table-hover">
                <thead>
                  <tr>
                    <th>Nomor</th>
                    <th>Nama Unit</th>
                    <th>Auditee</th>
                    <th>Auditor 1</th>
                    <th>Auditor 2</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($units as $unit)
                  <tr>
                    <td>{{$unit->unit_id}}</td>
                    <td>{{$unit->nama_unit}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <form onsubmit="return confirm('Apakah anda yakin ingin menghapus data?');" action="" method="POST">
                          <a href="{{route('edit'), $unit->id}}" class="btn btn-sm btn-primary"><i class="ri-pencil-line"></i>Edit</a>
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger"><i class="ri-delete-bin-2-line"></i>Hapus</button>
                      </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                      <td>Data Tidak Tersedia</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
              {{$units->links()}}
            </div>
          </div>

        </div>
      </div>
    </section>
@endsection


