<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>P4MP - Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href={{asset ("assets/img/pjm.jpg")}} rel="icon">
  <link href={{asset ("assets/img/pjm.jpg")}} rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href={{asset ("assets/vendor/bootstrap/css/bootstrap.min.css")}} rel="stylesheet">
  <link href={{asset ("assets/vendor/bootstrap-icons/bootstrap-icons.css")}} rel="stylesheet">
  <link href={{asset ("assets/vendor/boxicons/css/boxicons.min.css")}} rel="stylesheet">
  <link href={{asset ("assets/vendor/quill/quill.snow.css")}} rel="stylesheet">
  <link href={{asset ("assets/vendor/quill/quill.bubble.css")}} rel="stylesheet">
  <link href={{asset ("assets/vendor/remixicon/remixicon.css")}} rel="stylesheet">
  <link href={{asset ("assets/vendor/simple-datatables/style.css")}} rel="stylesheet">
  <link href={{asset ("assets/css/style.css")}} rel="stylesheet">
</head>

<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">



              <div class="card mb-3">

                <div class="card-body">
                <div class="d-flex justify-content-center pt-4">
                    <img class="" src={{asset ("assets/img/pjm.jpeg")}} alt="">
                </div>
                  <div class="pt-2 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login ke Akun Anda</h5>
                    <p class="text-cen
                    {{-- ter small">Masukkan Email & Password Untuk Login</p> --}}
                  </div>

                  <form action="" method="post" class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="email" class="email">Email</label>
                      <div class="input-group has-validation">
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                      @error('password')
                      <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                        <a class="btn btn-primary w-100" type="submit" href="{{ url('/') }}" role="button">Login</a>

                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src={{asset ("assets/vendor/apexcharts/apexcharts.min.js")}}></script>
  <script src={{asset ("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}></script>
  <script src={{asset ("assets/vendor/chart.js/chart.umd.js")}}></script>
  <script src={{asset ("assets/vendor/echarts/echarts.min.js")}}></script>
  <script src={{asset ("assets/vendor/quill/quill.min.js")}}></script>
  <script src={{asset ("assets/vendor/simple-datatables/simple-datatables.js")}}></script>
  <script src={{asset ("assets/vendor/tinymce/tinymce.min.js")}}></script>
  <script src={{asset ("assets/vendor/php-email-form/validate.js")}}></script>

  <!-- Template Main JS File -->
  <script src={{asset ("assets/js/main.js")}}></script>

</body>

</html>
