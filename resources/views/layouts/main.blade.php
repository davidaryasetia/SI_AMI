<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>P4MP - {{$title}} </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/short-logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table.dataTable tbody td {
            /* height: 10px; */
            /* Atur tinggi sel sesuai keinginan Anda */
            line-height: 10px;
            /* Vertically center text if needed */
        }

        .alert-container {
            position: fixed;
            top: 90px;
            right: 54px;
            width: 320px;
            z-index: 9999;
        }

        .alert {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('partials.sidebar')
        <!-- Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">

            <!-- Header Start -->
            @include('partials.navbar')
            <!-- Header END -->

            <div id="main" class="container-fluid">
                @yield('row')
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}', 'Berhasil');
        @elseif (session()->has('error'))
            toastr.error('{{ session('error') }}', 'Gagal');
        @endif
    </script>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script>
        //    ----------- Home ------------------------------
        $('#table_status').DataTable({
            responsive: true,

            columns: [{
                    width: '4px'
                },
                {
                    width: '32px'
                },
                {
                    width: '12px'
                },
                {
                    width: '12px'
                },
            ]
        });


        // ------------- Data Audit Mutu Internal ------------
        $('#table_unit').DataTable({
            responsive: true,
            "scrollY": "500px",
            "pageLength": 10, // Set initial page length to 5
            "lengthMenu": [
                [10, 15, 20, 30, 40, 50, 100],
                [10, 15, 20, 30, 40, 50, 100],
            ],
            columns: [{
                    width: '4px'
                },
                {
                    width: '32px'
                },
                {
                    width: '12px'
                },
                {
                    width: '12px'
                },
                {
                    width: '12px'
                },
                {
                    width: '4px'
                },
                {
                    width: '4px'
                },

            ]
        });
        $('#table_audite').DataTable({
            responsive: true,
            "scrollY": "500px",
            "pageLength": 10, // Set initial page length to 5
            "lengthMenu": [
                [10, 15, 20, 30, 40, 50, 100],
                [10, 15, 20, 30, 40, 50, 100],
            ],
            columns: [{
                    width: '4px'
                },
                {
                    width: '32px'
                },
                {
                    width: '12px'
                },
                {
                    width: '4px'
                },
                {
                    width: '4px'
                },

            ]
        });
        $('#table_auditor').DataTable({
            responsive: true,
            "scrollY": "500px",
            "pageLength": 10, // Set initial page length to 5
            "lengthMenu": [
                [10, 15, 20, 30, 40, 50, 100],
                [10, 15, 20, 30, 40, 50, 100],
            ],
            columns: [{
                    width: '4px'
                },
                {
                    width: '32px'
                },
                {
                    width: '12px'
                },
                {
                    width: '12px'
                },
                {
                    width: '4px'
                },
                {
                    width: '4px'
                },

            ]
        });
        $('#table_indikator').DataTable({
            responsive: true,
            "scrollY": "500px",
            "pageLength": 10, // Set initial page length to 5
            "lengthMenu": [
                [10, 15, 20, 30, 40, 50, 100],
                [10, 15, 20, 30, 40, 50, 100],
            ],
            columns: [{
                    width: '6px'
                },
                {
                    width: '6px'
                },
                null,
                {
                    width: '10px'
                },
                {
                    width: '10px'
                },
                {
                    width: '10px'
                },
                {
                    width: '10px'
                },
                {
                    width: '10px'
                },
            ]
        });


        // ---------------- Auth Section ---------------------
        $('#daftar_user').DataTable({
            responsive: true,
            "scrollY": "500px",
            "pageLength": 10, // Set initial page length to 5
            "lengthMenu": [
                [10, 15, 20, 30, 40, 50, 100],
                [10, 15, 20, 30, 40, 50, 100],
            ],
            columns: [{
                    width: '6px'
                },
                null,
                null,
                {
                    width: '10px'
                },
                {
                    width: '4px'
                },
                {
                    width: '4px'
                },
                {
                    width: '4px'
                },
            ]
        });
    </script>

</body>

</html>
