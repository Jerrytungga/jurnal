<?php
session_start();
// jika sudah login ke mentor maka akan di teruskan ke halaman mentor
if (!isset($_SESSION['role'])) {
} else if ($_SESSION['role'] == "Siswa") {
  header("location:siswa/index.php");
} else if ($_SESSION['role'] == "Mentor") {
  header("location:mentor/index.php");
} else if ($_SESSION['role'] == "Admin") {
  header("location:admin/index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Jurnal PKA</title>
  <!-- Bootstrap core CSS -->
  <link href="assets/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/alert/iziToast.min.css">
  <link href="assets/alert/sweetalert2.min.css" rel="stylesheet">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="assets/style.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin">
    <img style="float:center;width:300px;height:300px;" src="img/logo/Edit Logo PKA-DP.png">
    <h1 class="h3 mb-3 fw-normal">Silahkan Login</h1>
    <label for="username" class="visually-hidden">Username</label>
    <input type="text" id="username" class="form-control" placeholder="Username" autocomplete="off">
    <label for="password" class="visually-hidden">Password</label>
    <input type="password" id="password" class="form-control mt-md-2" placeholder="Password">

    <button class="w-100 btn btn-lg btn-primary btn-login" type="button">Sign in</button>
    <footer class="sticky-footer mt-3">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Jurnal PKA &copy; 2021 by Flats 41</span>
        </div>
      </div>
    </footer>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="assets/alert/sweetalert2.min.js"></script>
  <script type="text/javascript" src="assets/alert/iziToast.min.js"></script>
  <script>
    $(document).ready(function() {

      // Membuat function login_proses
      function login_proses() {
        var username = $("#username").val();
        var password = $("#password").val();


        // Mengecek username di isi atau tidak
        if (username.length == "") {

          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Field Username wajib diisi!'
          });

          // Mengecek password di isi atau tidak
        } else if (password.length == "") {

          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Field Password wajib diisi!'
          });

        } else {
          // Jika semua form terisi maka ajax akan memulai memproses data
          $.ajax({
            url: "aksi.php", //Url untuk mengelolah data
            type: "POST", //Method untuk mengelolah data
            data: {
              // Mengirimkan data ke URL
              "username": username,
              "password": password
            },
            // Jika response nya sukses atau berhasil maka fungsi ini akan berjalan
            success: function(response) {
              // Jika ia sebagai admin 
              if (response == "Mentor") {

                iziToast.success({
                  title: 'Selamat',
                  message: 'Anda berhasil login sebagai mentor, sebentar ya...',
                  position: 'topRight'
                });
                setTimeout(function() {
                  window.location.href = "mentor/profile.php";
                }, 3000);

                // Jika ia sebagai siswa 
              } else if (response == "Siswa") {

                iziToast.success({
                  title: 'Selamat',
                  message: 'Anda berhasil login sebagai Siswa, sebentar ya...',
                  position: 'topRight'
                });
                setTimeout(function() {
                  window.location.href = "siswa/profile.php";
                }, 3000);

                // Jika ia sebagai owner 
              } else if (response == "Admin") {

                iziToast.success({
                  title: 'Selamat',
                  message: 'Anda berhasil login sebagai Administrator, sebentar ya...',
                  position: 'topRight'
                });
                setTimeout(function() {
                  window.location.href = "admin/index.php";
                }, 3000);


              } else if (response == "Tidak Aktif") {
                // Jika response nya error maka fungsi ini yang akan berjalan
                iziToast.warning({
                  title: 'Oops..!',
                  message: 'Maaf Akun Anda Tidak Aktif',
                  position: 'topRight'
                });

              } else {
                // Jika response nya error maka fungsi ini yang akan berjalan
                iziToast.error({
                  title: 'Oops..!',
                  message: 'Username atau Password Anda Salah!',
                  position: 'topRight'
                });

              }


              console.log(response);
            },
            // Jika ajax nya error/bermasalah maka fungsi ini yang akan berjalan
            error: function(response) {

              Swal.fire({
                icon: 'error',
                title: 'Opps!',
                text: 'Terjadi kesalahan pada server!'
              });

              console.log(response);
            }
          });
        }
      }

      // jika button yang class nya btn-login di click maka akan menjalan kan fungsi login_proses
      $(".btn-login").click(function() {
        login_proses();
      });

    });
  </script>
</body>

</html>