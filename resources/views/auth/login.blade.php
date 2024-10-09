<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/short-logo.png') }}" />
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #003b54;
            /* Latar belakang biru */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            /* Latar putih dengan sedikit transparansi */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 900px;
            width: 100%;
        }

        .form-group label {
            font-weight: bold;
            color: #003b54;
        }

        .divider {
            border-left: 2px solid #000000;
            height: 100%;
            margin: 0 30px;
        }

        h3,
        p {
            color: #003b54;
        }

        .vertical-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        /* UI Minimalis */
        .form-login h5 {
            color: #003b54;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #004f6e;
            border: none;
            padding: 10px 30px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #003d57;
        }

        input.form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        /* Style untuk gambar */
        .login-image {
            width: 300px;
            height: auto; 
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                /* Susun kolom di layar kecil */
                padding: 20px;
            }

            .divider {
                display: none;
                /* Hilangkan divider pada layar kecil */
            }

            .vertical-center {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="row w-100">
            <!-- Left Side: Image -->
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <div class="image-container">
                    <img src="{{ asset('assets/img/PENS.jpg') }}" class="login-image" alt="Login">
                </div>
            </div>
            
            <div class="divider d-none d-md-block" style="border: 1px solid black; height: 400px"></div>

            <!-- Right Side: Single Login Form -->
            <div class="col-md-7">
                <h3>Selamat datang di Sistem Informasi Audit Mutu Internal.</h3>
                <p>Silahkan melakukan login.</p>

                <!-- Single Login Form -->
                <div id="form-login" class="form-login">
                    <h5>Login</h5>
                    <form action="/home" method="">
                        <div class="form-group">
                            <label for="user">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan Email.....">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan Password....">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
