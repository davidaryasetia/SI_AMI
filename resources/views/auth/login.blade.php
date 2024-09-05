<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

        .btn-custom {
            background-color: #004f6e;
            color: white;
            width: 180px;
            border-radius: 20px;
            margin-bottom: 20px;
            border: none;
            padding: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #003d57;
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
            flex-direction: column;
            justify-content: center;
            height: 100%;
            /* Pastikan tombol berada di tengah vertikal */
            min-height: 400px;
            /* Tambahan untuk memastikan tinggi minimal */
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

            .btn-custom {
                width: 100%;
                /* Tombol full-width di layar kecil */
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="row w-100">
            <!-- Left Side: Buttons -->
            <div class="col-md-4 vertical-center">
                <button class="btn btn-custom" onclick="showForm('admin')">Admin</button>
                <button class="btn btn-custom" onclick="showForm('auditor')">Auditor</button>
                <button class="btn btn-custom" onclick="showForm('auditee')">Auditee</button>
            </div>

            <div class="divider d-none d-md-block" style="border: 1px solid black; height: 400px"></div>

            <!-- Right Side: Login Forms -->
            <div class="col-md-7">
                <h3>Selamat datang di Sistem Informasi Audit Mutu Internal.</h3>
                <p>Silahkan melakukan login.</p>

                <!-- Form Login Admin -->
                <div id="form-admin" class="form-login">
                    <h5>Login Admin</h5>
                    <form action="/login-admin" method="POST">
                        <div class="form-group">
                            <label for="admin-user">User:</label>
                            <input type="text" class="form-control" id="admin-user" name="username">
                        </div>
                        <div class="form-group">
                            <label for="admin-password">Password:</label>
                            <input type="password" class="form-control" id="admin-password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>

                <!-- Form Login Auditor -->
                <div id="form-auditor" class="form-login" style="display:none;">
                    <h5>Login Auditor</h5>
                    <form action="/login-auditor" method="POST">
                        <div class="form-group">
                            <label for="auditor-user">User:</label>
                            <input type="text" class="form-control" id="auditor-user" name="username">
                        </div>
                        <div class="form-group">
                            <label for="auditor-password">Password:</label>
                            <input type="password" class="form-control" id="auditor-password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>

                <!-- Form Login Auditee -->
                <div id="form-auditee" class="form-login" style="display:none;">
                    <h5>Login Auditee</h5>
                    <form action="/login-auditee" method="POST">
                        <div class="form-group">
                            <label for="auditee-user">User:</label>
                            <input type="text" class="form-control" id="auditee-user" name="username">
                        </div>
                        <div class="form-group">
                            <label for="auditee-password">Password:</label>
                            <input type="password" class="form-control" id="auditee-password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showForm(role) {
            // Hide all forms
            document.querySelectorAll('.form-login').forEach(form => {
                form.style.display = 'none';
            });

            // Show the selected form
            document.getElementById(`form-${role}`).style.display = 'block';
        }

        // Default to showing the Admin form
        showForm('admin');
    </script>

</body>

</html>
