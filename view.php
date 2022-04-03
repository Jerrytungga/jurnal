<?php
include 'database.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-j');
$waktu_sekarang = date('H-i-s');
$nis = $_GET['nis'];
// $id = $_GET['id'];
$siswa = mysqli_query($conn, "SELECT * FROM siswa where nis='$nis'");
$s = mysqli_fetch_array($siswa);
$s['name'];


?>




<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <?php
  include 'navbar_buttom.php';
  ?>
  <?php
  include 'modal.php';
  ?>

  <div class="card shadow m-3">
    <div class="card-header  bg-primary text-light">
      <h3>
        <center>
          <?php
          echo date('d F Y');
          ?>
        </center>
      </h3>
    </div>
    <div class="card-body">
      <h1 style=" text-align:center; font-size: 50pt; font-family: arial;" id="jam"></h1>
    </div>
  </div>




  <div class="card shadow m-3" style=" width: 22rem; ">
    <div class="card-header">
      Profile
    </div>
    <div class="card-body">
      <img src="img/fotosiswa/<?= $s['image']; ?>" class="card-img-top h-85 w-85" alt="...">
      <h5 class="card-title mt-3">Name : <?= $s['name']; ?></h5>
      <h5 class="card-title">Batch&nbsp; : <?= $s['angkatan']; ?></h5>
      <center>
        <img src="img/logo/Edit Logo PKA-DP_v1.png" class="card-img-top h-25 w-25" alt="...">
        <p class="card-text">Peserta Pelatihan Kebenaran Alkitab</p>

      </center>

    </div>
  </div>













  <script type="text/javascript">
    window.onload = function() {
      jam();
    }

    function jam() {
      var e = document.getElementById('jam'),
        d = new Date(),
        h, m, s;
      h = d.getHours();
      m = set(d.getMinutes());
      s = set(d.getSeconds());

      e.innerHTML = h + ':' + m + ':' + s;

      setTimeout('jam()', 1000);
    }

    function set(e) {
      e = e < 10 ? '0' + e : e;
      return e;
    }
  </script>


  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>