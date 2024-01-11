@extends('layouts.main')

@section('container')

<div class="pagetitle">
    <h1>Data User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data Audit</li>
        <li class="breadcrumb-item active">Data User</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="Data User Pengguna">
 <div class="row">
    <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="card-title">Data User Pengguna</h5>
                <span class="divider"></span>
                <a href="/data_audit/data_user_pengguna/create" class="btn btn-primary btn-sm ms-2"><i class="ri-add-line">Tambah Data User Pengguna</i></a>
            </div>

            <!-- Table with stripped rows -->
            <table class="table datatable table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>NIP</th>
                  <th>Email</th>
                  <th>PIC</th>
                  <th>Status Admin</th>
                  <th>Status Audite</th>
                  <th>Status Auditor</th>
                  <th>Unit Diaudit</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($users as $user)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$user->nama_lengkap}}</td>
                  <td>{{$user->nip}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->unit_id}}</td>
                  <td>{{$user->status_admin}}</td>
                  <td>{{$user->status_audite}}</td>
                  <td>{{$user->status_auditor}}</td>
                  <td>{{$user->unit_id_diaudit}}</td>
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
                    <td colspan="10">Data User Tidak Tersedia</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  {{-- content here --}}
    </div>
  </section>

@endsection
