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
    <div class="d-flex justify-content-center">
        <p style="text-align: center; font-weight: bold">JADWAL AUDIT MUTU INTERNAL - PERIODE
            AMI {{ \Carbon\Carbon::parse($periode->tanggal_pembukaan_ami)->translatedFormat('Y') }}</p>

        <p style="text-align: center; font-weight: bold">POLITEKNIK ELEKTRONIKA NEGERI SURABAYA</p>
    </div>



    <p style="color: black; font-weight: bold; padding-top: 24px">Periode Pelaksanaan AMI : <span
            style="font-weight: 300;">
            {{ \Carbon\Carbon::parse($periode->tanggal_pembukaan_ami)->translatedFormat('d M Y') }} sd
            {{ \Carbon\Carbon::parse($periode->tanggal_penutupan_ami)->translatedFormat('d M Y') }}</span></p>
    <div class="responsive-table mt-1">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Unit Kerja</th>
                    <th>Audite</th>
                    <th>Auditor 1</th>
                    <th>Auditor 2</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_ploting as $index => $ploting)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="highlight mb-1">{{ $ploting->nama_unit }}</div>
                            @if ($ploting->units_cabang->count())
                                <ul class="unit-list mt-2">
                                    @foreach ($ploting->units_cabang as $unitCabang)
                                        <li>{{ $unitCabang->nama_unit_cabang }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>
                            @php
                                $kadepAudite = $ploting->audite->firstWhere('unit_cabang_id', null);
                            @endphp
                            @if ($kadepAudite && $kadepAudite->user_audite)
                                <div>{{ $kadepAudite->user_audite->nama }}</div>
                            @else
                                <span class="text-danger mb-1">Audite Belum di Set!</span>
                            @endif
                            @if ($ploting->units_cabang->count())
                                <ul class="unit-list mt-2">
                                    @foreach ($ploting->units_cabang as $unitCabang)
                                        <li>
                                            @if ($unitCabang->audites->first() && $unitCabang->audites->first()->user_audite)
                                                {{ $unitCabang->audites->first()->user_audite->nama }}
                                            @else
                                                <span class="text-danger">Audite Belum di Set!</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>
                            @if ($ploting->auditor && $ploting->auditor->auditor1)
                                {{ $ploting->auditor->auditor1->nama }}
                            @else
                                <span class="text-danger">Auditor 1 Belum Di set!</span>
                            @endif
                        </td>
                        <td>
                            @if ($ploting->auditor && $ploting->auditor->auditor2)
                                {{ $ploting->auditor->auditor2->nama }}
                            @else
                                <span class="text-danger">Auditor 2 Belum Di set!</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Tambahkan elemen ini setelah tabel plotting -->
    <div style="page-break-before: always;">
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
