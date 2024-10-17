<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #023047; /* Latar belakang biru tua */
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background-color: #ffffff; /* Warna kotak kecil putih */
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 48px;
            color: #ffb703; /* Warna header kontras (kuning) */
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #023047; /* Warna teks utama */
        }

        button {
            background-color: #fb8500; /* Warna tombol oranye */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ffb703; /* Hover tombol (kuning) */
        }

        img {
            max-width: 200px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 36px;
            }
            p {
                font-size: 16px;
            }
            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <img src="{{ asset('assets/img/PENS.jpg') }}" alt="Access Denied Illustration">
        <h1>403 - Access Denied</h1>
        <p>You do not have permission to access this page.</p>
        <button onclick="goBack()">Go Back</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>
</html>
