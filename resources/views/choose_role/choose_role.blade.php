<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Pilih Role Anda</title>
    <style>
        body {
            background-color: #e6f0ff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
            margin: 0;
        }

        .role-selection-container {
            text-align: center;
            max-width: 600px;
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .role-title {
            font-weight: bold;
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 8px;
        }

        .role-description {
            color: #666;
            font-size: 1rem;
            margin-bottom: 30px;
        }

        .role-options {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 15px;
        }

        .role-card {
            cursor: pointer;
            background-color: #f9f9f9;
            padding: 20px;
            width: 148px;
            height: 130px;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 2px solid transparent;
        }

        .role-card:hover,
        .role-card.active {
            transform: translateY(-6px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            border-color: #0d6efd;
            background-color: #e0ebff;
        }

        .icon {
            font-size: 2.5rem;
            color: #0d6efd;
        }

        .role-name {
            margin-top: 10px;
            font-size: 1rem;
            font-weight: 500;
            color: #333;
        }

        @media (max-width: 768px) {
            .role-card {
                width: 80px;
                height: 110px;
            }

            .role-options {
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="role-selection-container">
        <div class="role-title">Silahkan Pilih Role Anda</div>
        <div class="role-description">Silahkan Pilih Role Yang telah Ditugaskan Ke Akun Anda !!</div>

        <div class="role-options">
            @foreach ($roles as $role)
                <form action="{{ route('select.role') }}" method="POST" id="roleForm{{ $role }}">
                    @csrf
                    <input type="hidden" name="role" value="{{ $role }}">
                    <div class="role-card" onclick="selectRole('roleForm{{ $role }}')" id="card-{{ $role }}">
                        <div class="icon">
                            @if ($role == 'admin')
                                <i class="bi bi-person-badge-fill"></i>
                            @elseif ($role == 'auditor')
                                <i class="bi bi-person-check-fill"></i>
                            @elseif ($role == 'audite')
                                <i class="bi bi-person-fill"></i>
                            @endif
                        </div>
                        <div class="role-name">{{ ucfirst($role) }}</div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>

    <script>
        function selectRole(formId) {
            document.getElementById(formId).submit();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
