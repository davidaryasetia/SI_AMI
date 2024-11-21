<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/short-logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/customize.css') }}">
    <!-- Tippy.js CSS -->
    <link href="https://unpkg.com/tippy.js@6/dist/tippy.css" rel="stylesheet">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }

        .table-responsive {
            zoom: 0.9;
            overflow-x: auto;
        }

        table {
            table-layout: auto;
            width: 100%;
            word-wrap: break-word;
            font-size: 14px;
        }

        /* Navbar Section */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            border-bottom: 1px solid white;
            background-color: white;
            height: 60px;
            color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar .navbar-brand {
            font-size: 18px;
            font-weight: bold;
        }

        .navbar .navbar-brand small {
            font-size: 12px;
            font-weight: normal;
            line-height: 1;
        }

        .navbar img {
            max-height: 40px;
        }

        #customDropdownMenu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1050;
            background: #ffffff;
            border-radius: 12px;
            transition: all 0.3s ease-in-out;
        }

        /* Tambahkan bayangan */
        #customDropdownMenu::before {
            content: "";
            position: absolute;
            top: -10px;
            right: 20px;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 10px 10px 10px;
            border-color: transparent transparent #ffffff transparent;
            z-index: 1060;
        }

        /* Hover Effect */
        .dropdown-menu .dropdown-item:hover {
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        /* Transisi dropdown */
        .dropdown-menu.show {
            display: block;
        }



        .btn-outline-light {
            border-color: white;
            color: white;
        }

        .btn-outline-light:hover {
            background-color: #004f7f;
            color: white;
        }

        /* End Navbar Section */


        /* Sidebar Section */
        #sidebar {
            position: fixed;
            top: 50px;
            left: 0;
            bottom: 0;
            width: 200px;
            background-color: white;
            border-right: 1px solid #dee2e6;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        #sidebar.collapsed {
            width: 64px;
        }

        .nav-link {
            font-size: 14px;
            color: #333;
            padding: 14px 16px;
            font-weight: 500;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: flex;
            align-items: center;
            margin: 2px 6px;
        }

        #sidebar .nav-link.active {
            background-color: #E1ECF1;
            color: #0B668B !important;
            border-radius: 8px;
            margin: 2px 6px;
        }

        #sidebar .nav-link:hover {
            background-color: #e3f2fd;
            color: #0B668B;
            border-radius: 8px;
            margin: 2px 6px;
        }



        .nav-link i {
            font-size: 18px;
        }

        .nav-link .menu-text {
            margin-left: 10px;
            transition: opacity 0.3s ease;
        }

        #sidebar.collapsed .menu-text {
            opacity: 0;
            display: none;
        }

        #sidebar.collapsed .nav-link:hover::after {
            content: attr(data-title);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background-color: #0B668B;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            white-space: nowrap;
            /* Hindari teks meluas ke baris baru */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, visibility 0.2s ease;
        }

        #sidebar.collapsed .nav-link {
            position: relative;
            /* Agar tooltip bisa diatur relatif terhadap link */
        }

        #sidebar.collapsed .nav-link::after {
            content: attr(data-title);
            position: absolute;
            left: 50px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #333;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease, transform 0.3s ease;
            font-size: 12px;
            z-index: 1000;
        }

        #sidebar.collapsed .nav-link:hover::after {
            opacity: 1;
            transform: translateY(-50%) translateX(5px);
            /* Muncul dengan animasi */
        }


        #sidebar.collapsed .nav-link i {
            justify-content: center;
            font-size: 18px;
            padding: 8px 10px;
            position: relative;
        }

        #sidebar.collapsed .nav-link {
            padding: 8px 10px;
            /* Padding yang lebih kecil saat collapsed */
        }

        #sidebar.collapsed .nav-link::after {
            content: attr(data-title);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background-color: #333;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s, transform 0.3s;
            font-size: 12px;
        }

        #sidebar.collapsed .nav-link:hover::after {
            opacity: 1;
            transform: translateY(-50%) translateX(5px);
        }

        /* End Sidebar Section */

        #content-wrapper {
            margin-top: 50px;
            padding: 32px 20px 10px 220px;
            overflow-y: auto;
            height: calc(100vh - 56px);
            transition: padding-left 0.3s ease;
        }



        #content-wrapper.full {
            padding-left: 90px;
            /* Padding kiri untuk sidebar kecil */
        }


        /* Table Section */
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

        /* List Audite */
        <style>.unit-list {
            padding-left: 0;
            list-style: none;
        }

        .card-title {
            color: black;
        }

        .unit-list li {
            padding: 8px;
            border: 1px solid #b8b6b6;
            margin-bottom: 5px;
            border-radius: 4px;
            font-size: 12;
            color: black;
        }

        .unit-list li:last-child {
            margin-bottom: 0;
        }

        /* Dropdown */
        /* Style untuk dropdown */
        .btn-light.dropdown-toggle {
            background-color: #f8f9fa;
            /* Warna lembut untuk dropdown */
            border: 1px solid #ccc;
            /* Border lembut */
            border-radius: 5px;
            /* Sudut melengkung */
            padding: 5px 15px;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            /* Bayangan dropdown */
            transition: all 0.3s ease;
            /* Efek transisi halus */
        }

        .btn-light.dropdown-toggle:hover {
            background-color: #e9ecef;
            /* Warna hover */
            border-color: #b3b3b3;
        }

        /* Dropdown item */
        /* Style untuk dropdown container */
        .dropdown-enhanced {
            width: auto;
            min-width: 100px;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        /* Hover effect untuk dropdown */
        .dropdown-enhanced:hover {
            background-color: #f1f1f1;
            border-color: #ffffff;
        }

        /* Style saat focus */
        .dropdown-enhanced:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(33, 150, 243, 0.5);
            border-color: #2196f3;
        }

        /* Label peran */
        .dropdown label {
            color: white;
            /* Warna teks label di navbar */
            font-size: 14px;
            font-weight: bold;
        }

        /* Navbar styling */

        .navbar .dropdown {
            margin-right: 10px;
        }

        


        /* Modal Dropdown  */
    </style>
    @stack('css')
</head>

<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebar");
            const contentWrapper = document.getElementById("content-wrapper");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const menuTexts = document.querySelectorAll("#sidebar .menu-text");

            // Memuat status sidebar dari localStorage
            const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
            if (isCollapsed) {
                sidebar.classList.add("collapsed");
                contentWrapper.classList.add("full");
                menuTexts.forEach(text => {
                    text.style.display = "none"; // Sembunyikan teks menu
                });
            } else {
                sidebar.classList.remove("collapsed");
                contentWrapper.classList.remove("full");
                menuTexts.forEach(text => {
                    text.style.display = ""; // Tampilkan teks menu
                });
            }

            // Menambahkan event listener pada toggle button
            sidebarToggle.addEventListener("click", function() {
                const isCurrentlyCollapsed = sidebar.classList.contains("collapsed");
                sidebar.classList.toggle("collapsed");
                contentWrapper.classList.toggle("full");

                if (isCurrentlyCollapsed) {
                    // Tampilkan teks menu
                    menuTexts.forEach(text => {
                        text.style.display = "";
                    });
                } else {
                    // Sembunyikan teks menu
                    menuTexts.forEach(text => {
                        text.style.display = "none";
                    });
                }

                // Menyimpan status ke localStorage
                localStorage.setItem("sidebarCollapsed", !isCurrentlyCollapsed);
            });
        });
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- Tippy.js JS -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>


    {{-- Custom dropdown menu --}}


    @stack('script')
</body>

</html>
