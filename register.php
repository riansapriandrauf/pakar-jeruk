<?php
require_once 'app/config/koneksi.php';
require_once 'app/config/function.php';
require_once 'app/config/function-allert.php';
require_once 'app/controller/login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Sistem Pakar Diagnosa Penyakit Jeruk
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <style>
        .gambar-bg {
            background-image: url('assets/img/kebun-jeruk1.jpg');
            background-position: top;
            position: relative;
            /* width: 100%; */
            /* height: 100vh; */
            background-size: cover;
        }

        .gambar-bg::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Sesuaikan nilai transparansi sesuai kebutuhan */
            pointer-events: none;
            /* Agar overlay tidak mengganggu interaksi dengan elemen lain */
        }
    </style>
</head>

<body class="">
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg gambar-bg">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
            <p class="text-lead text-white">Pendaftaran Akun Petani Sistem Pakar Diagnosa Penyakit Jeruk</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4 pb-0">
              <img src="./assets/img/lemon.png" class="navbar-brand-img h-100" alt="main_logo" width="35vh">
              <h5>Silahkan isi data dibawah ini</h5>
            </div>
            <div class="card-body">
              <form role="form" method="POST">
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Nama Lengkap" aria-label="Nama Lengkap" name="nama_lengkap" required>
                </div>
                <div class="input-group mb-3">
                  <input type="date" class="form-control" placeholder="Tanggal Lahir" aria-label="Tanggal Lahir" name="tgl_lahir" required>
                  <span class="input-group-text" id="basic-addon2">Tanggal Lahir</span>
                </div>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Alamat" aria-label="Alamat" name="alamat" required>
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="username" required>
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" required>
                </div>
                <div class="form-check form-check-info text-start">
                  <input class="form-check-input" type="checkbox" required id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Apakah anda yakin <a href="javascript:;" class="text-dark font-weight-bolder">data anda sudah benar ?</a>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" name="register" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar Sekarang</button>
                </div>
                <p class="text-sm mt-3 mb-0">Sudah Punya akun? <a href="login" class="text-dark font-weight-bolder">Log in Disini</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  <script src="assets/vendor/sweetallert/js/sweetallert.js"></script>
</body>

</html>