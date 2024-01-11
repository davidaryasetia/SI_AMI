@extends('layouts.main')

@section('container')
<div class="pagetitle">
    <div class="d-flex justify-content-between">
        <div>
            <h1>Daftar Unit Kerja</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Data Audit</li>
                    <li class="breadcrumb-item active">Unit</li>
                </ol>
            </nav>
        </div>
        <div>
            @if(session()->has('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <p>{{session('success')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif()
        </div>
    </div><!-- End Page Title -->
</div>

  <section class="unit">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                  <h5 class="card-title">Unit Kerja</h5>
                  <span class="divider"></span>
                  <a href="/data_audit/unit_kerja/create" class="btn btn-primary btn-sm ms-2"><i class="ri-add-line">Tambah Unit</i></a>
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
                    <td>{{$loop->iteration}}</td>
                    <td>{{$unit->nama_unit}}</td>
                    <td>{{$unit->kode}}</td>
                    <td></td>
                    <td></td>
                    <td>
                        <div style="display: inline-block">
                            <a href="{{route('unit_kerja.edit', $unit->nama_unit)}}" class="btn btn-sm btn-primary"><i class="ri-pencil-line"></i> Edit</a>
                        </div>
                        <div style="display: inline-block">
                        <form action="{{route('unit_kerja.destroy', $unit->unit_id)}}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Unit?')" class="btn btn-sm btn-danger"><i class="ri-delete-bin-2-line"></i> Hapus</button>
                        </form>
                        </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                      <td colspan="6">Data Unit Tidak Tersedia</td>
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


