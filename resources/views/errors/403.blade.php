<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #023047;
            /* Latar belakang biru tua */
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background-color: #ffffff;
            /* Warna kotak kecil putih */
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 48px;
            color: #ffb703;
            /* Warna header kontras (kuning) */
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #023047;
            /* Warna teks utama */
        }

        .logout-button {
            background-color: #fb8500;
            /* Warna tombol oranye */
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: inline-block;
            text-decoration: none;
        }

        .logout-button:hover {
            background-color: #ffb703;
            /* Hover tombol (kuning) */
            transform: translateY(-3px);
        }

        .logout-button:active {
            background-color: #e07a00;
            transform: translateY(1px);
        }

        img {
            max-width: 200px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 36px;
            }

            p {
                font-size: 16px;
            }

            .logout-button {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container" style="max-width: 720px; line-height: 1.5">
        <img src="{{ asset('assets/img/PENS.jpg') }}" alt="Access Denied Illustration">
        <h1>403 - Access Denied</h1>
        <p>Anda tidak memiliki hak akses untuk mengakses halaman ini. Silakan hubungi Admin PJM untuk informasi lebih lanjut.</p>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" class="logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
    </div>

</body>

</html>
