@extends('layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Beranda</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Beranda</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        @yield('container')
    </section>
@endsection
