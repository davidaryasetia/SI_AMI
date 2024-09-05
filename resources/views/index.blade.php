<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-AM</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #003b54;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-section {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px;
            color: #fff;
        }

        .hero-text {
            max-width: 500px;
            text-align: left;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #ff8500;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .hero-description {
            font-size: 1rem;
            margin-bottom: 30px;
        }

        .btn-custom {
            background-color: #ff8500;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Tambahkan bayangan untuk efek depth */
        }

        .btn-custom:hover {
            background-color: #e67e22;
            /* Warna hover sedikit lebih gelap */
        }

        .d-grid.gap-2 {
            gap: 12px;
            /* Jarak antar tombol lebih kecil */
        }


        .image-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .image-container img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
        }

        /* Divider CSS */
        .divider {
            border-left: 2px solid #fff;
            height: 400px;
            margin: 0 30px;
        }

        @media (max-width: 768px) {
            .hero-section {
                flex-direction: column;
            }

            .hero-text {
                text-align: center;
                max-width: 100%;
            }

            .divider {
                display: none;
                /* Hide the divider on small screens */
            }

            .image-container {
                margin-top: 30px;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid hero-section">
        <div class="row w-100 d-flex justify-content-center align-items-center">
            <!-- Left Side (Text and Buttons) -->
            <div class="col-md-5 hero-text">
                <h1 class="hero-title">Halo, Selamat Datang !</h1>
                <h4 class="hero-subtitle">Apa itu SIM-AMI?</h4>
                <p class="hero-description">
                    SIM-AMI adalah sistem audit mutu internal yang diterapkan di lingkungan Politeknik Elektronika
                    Negeri Surabaya, dirancang untuk mendukung pelaksanaan audit mutu internal secara efektif dan
                    efisien.
                </p>
                <div class="d-grid gap-2">
                    <a href="/login" class="btn btn-custom mb-2">Login Admin</a>
                    <a href="/login" class="btn btn-custom mb-2">Login Auditor</a>
                    <a href="/login" class="btn btn-custom mb-2">Login Auditee</a>
                </div>
            </div>

            <!-- Vertical Divider -->
            <div class="divider d-none d-md-block"></div>

            <!-- Right Side (Image) -->
            <div class="col-md-5 d-flex justify-content-center align-items-center">
                <div class="image-container">
                    <img src="{{ asset('assets/img/PENS.jpg') }}" alt="Gedung Perguruan Tinggi">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
