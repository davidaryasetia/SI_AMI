<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Export Data Ploting</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 20px;

        }

        p {
            text-align: left;
            margin-top: -10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .unit-list {
            padding: 0;
            margin-top: 8px;
            list-style: none;
            text-align: left;
        }

        .unit-list li {
            margin-bottom: 5px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fafafa;
            font-size: 11px;
        }

        .text-danger {
            color: red;
            font-weight: bold;
        }

        .highlight {
            font-weight: 600;
            font-size: 10px;
            color: #000;
        }

        .responsive-table {
            overflow-x: auto;
            width: 100%;
        }
    </style>
</head>

<body>

    <!-- Tambahkan elemen ini setelah tabel plotting -->
    <div>
        <p class="" style="color: black; font-weight: bold; padding-top: 32px; text-align: center">List Data Akun
            User:</p>

        <div style="padding: 16px">
            <p>Notes : </p>
            <p style="color: red">Diharap mengganti password setelah melakukan login!!!
            </p>
        </div>
        <div class="responsive-table mt-1">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Default Password</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_user as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->email }}</td>
                            <td>1234</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
