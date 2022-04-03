<?php
include 'database.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-j');
$waktu_sekarang = date('H-i-s');
$nis = $_GET['nis'];
$id = $_GET['id'];
$siswa = mysqli_query($conn, "SELECT name FROM siswa where nis='$nis'");
$s = mysqli_fetch_array($siswa);
$s['name'];




// $absent = mysqli_query($conn, "SELECT shedule_id FROM absent where nis='$nis'");
// $data_absent = mysqli_fetch_array($absent);
// $id_kegiatan = $data_absent['shedule_id'];



if (isset($_POST['kirim_gambar'])) {
  $img = $_POST['image'];
  $folderPath = "img/verifikasi/";
  $image_parts = explode(";base64,", $img);
  $image_type_aux = explode("image/", $image_parts[0]);
  $image_type = $image_type_aux[1];
  $image_base64 = base64_decode($image_parts[1]);
  $fileName = $s['name'] . '_' . $hari_ini . '_'  . $waktu_sekarang . '.png';
  $file = $folderPath . $fileName;
  // file_put_contents($file, $image_base64);

  if (file_put_contents($file, $image_base64)) {
    $updatejadwal = mysqli_query($conn, "UPDATE `absent` SET `gambar_verifikasi`='$file' WHERE nis='$nis' and schedule_id='$id'");

    if ($updatejadwal) {

      header('location: index.php');
    }
  }
}






?>


<!DOCTYPE html>
<html>

<head>
  <title>Verifikasi Langka Ke 2</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">


  <style type="text/css">
    #results {
      padding: 10px;
      /* border: 1px solid; */
      background: #fff;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-light bg-dark">
    <a class="navbar-brand text-light">Verifikasi Langkah Ke 2</a>
  </nav>
  <div class="card shadow m-2">
    <div class="card-header  bg-primary text-light">
      <h2>
        <center>
          <?php
          echo date('d F Y');
          ?>
        </center>
      </h2>
    </div>
    <div class="card-body">
      <h1 style=" text-align:center; font-size: 120px; font-family: arial;" id="jam"></h1>
    </div>
  </div>

  <form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid">
      <div class="form-row">
        <div class="card shadow m-3 col-md-3">
          <div class="card-header text-light bg-primary">
            <center>
              <h4>
                Camera
              </h4>
            </center>
          </div>
          <div class="card-body">
            <center>
              <div id="my_camera"></div>
              <br />
              <input type="submit" name="kirim_gambar" value="Take Snapshot" onClick="take_snapshot()">
              <input type="hidden" name="image" class="image-tag">
            </center>
          </div>
        </div>
  </form>






  </div>
  </div>




  <!-- Configure a few settings and attach camera -->
  <script language="JavaScript">
    Webcam.set({
      width: 300,
      height: 300,
      image_format: 'jpeg',
      jpeg_quality: 90
    });

    Webcam.attach('#my_camera');

    function take_snapshot() {
      Webcam.snap(function(data_uri) {
        $(".image-tag").val(data_uri);
        document.getElementById();
      });
    }
  </script>
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

</body>

</html>