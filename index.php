<?php
include 'database.php';

session_start();
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-j');
$waktu_sekarang = date('H:i:s');

// data semester
$get_semester = mysqli_query($conn, "SELECT * FROM tb_semester WHERE status='Aktif'");
$data1 = mysqli_fetch_array($get_semester);
$data_semester = $_SESSION['smt'] =  $data1['thn_semester'];

// sql data siswa
$sql_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nis AND status='Aktif'");
$data_siswa = mysqli_fetch_array($sql_siswa);
$nis = $_SESSION['nis'] =  $data_siswa['nis'];



// mengambil data schedule/jadwal
$sql_schedule = mysqli_query($conn, "SELECT * FROM schedule where status='Aktif'");
$list20 = mysqli_fetch_array($sql_schedule);
$id_kegiatan = $_SESSION['id_schedule'] =  $list20['id'];
$week = $_SESSION['minggu'] =  $list20['week'];
$angkatansiswa = $_SESSION['angkatan'] =  $list20['batch'];
$nama_kegiatan = $_SESSION['schedule'] =  $list20['id_activity'];
$info = $_SESSION['info'] =  $list20['info'];
$waktu = $_SESSION['waktu'] =  $list20['start_time'];
$waktuabsent = $_SESSION['absen'] =  $list20['absent_time'];
$status = $_SESSION['status'] =  $list20['status'];
$jam_akhir = $_SESSION['waktu_akhir'] =  $list20['end_time'];

// jika waktu presensi > waktu kegiatan maka statusnya terlambat
if ($waktuabsent > $waktu) {
  $hasil = 'v';
  // v adalah Hadir dengan waktu yang ditentukan
} else {
  $hasil = 'S';
  // T adalah terlambat, siswa tetap hadir dengan status terlambat karena melebihi waktu yang ditentukan
}
// $waktu == $waktu_sekarang &&
// && $waktuabsent == $waktu_sekarang
// jika waktu sama dengan waktu sekarang dan status aktif maka di ijinkan untuk presensi
if ($status == 'Aktif' && $waktuabsent < $waktu_sekarang && $jam_akhir > $waktu_sekarang) {
  if (isset($_POST['nis'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $mentor = mysqli_fetch_array(mysqli_query($conn, "SELECT mentor FROM `siswa` WHERE nis='$nis'"));
    $mentor = $mentor['mentor'];
    $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_absent`) As id FROM `absent` WHERE absent_date=date(now()) AND schedule_id='$id_kegiatan'"));
    $idbr = $max['id'] + 1;
    $hapus =  mysqli_query($conn, "INSERT INTO `absent`(`nis`,`absent_date`,`absent_time`,`schedule_id`,`week`, `batch`,`id_activity`,`semester`,`info_schedule`,`mark`,`id_absent`,`mentor`) VALUES ('$nis','$hari_ini','$waktu_sekarang', '$id_kegiatan', ' $week', '$angkatansiswa','$nama_kegiatan','$data_semester','$info','$hasil',' $idbr','$mentor')");
    if ($hapus) {
      $notifsukses = $_SESSION['sukses'] = 'Berhasil Disimpan';
    } else {
      echo "<script>alert('Presensi Gagal!');</script>";
    }
  }
} else {
  $notifgagal = $_SESSION['gagal'] = 'Belum Saatnya Melakukan Presensi';
  // peringatan pesan jika presensinya belum aktif atau belum saatnya presensi
}




$jadwal = mysqli_query($conn, "SELECT * FROM schedule WHERE status='Aktif' and  date='$hari_ini'  ORDER BY start_time ASC");
$list = mysqli_fetch_array($jadwal);
$cek = mysqli_num_rows($jadwal);
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
  <title>Presensi PKA</title>
</head>

<body>
  <nav class="navbar navbar-light bg-dark">
    <a class="navbar-brand text-light">Presensi PKA</a>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tombolaksi">
      See Attendance (Lihat Presensi)
    </button>
    <a href="./login.php" class="btn btn-success text-light my-2 my-sm-0">Login Ke Jurnal</a>
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
  <div class="container-fluid">
    <!-- .............................................
..................................................
.................................................. -->
    <div class="form-row">
      <div class="card shadow m-5 col-md-3">
        <div class="card-header text-light bg-primary">
          <center>
            <h4>
              Scanner
            </h4>
          </center>
        </div>


        <div class="card-body">
          <center>
            <canvas></canvas>
            <p>Silahkan Pilih Sumber kamera</p>
            <select></select>
          </center>
        </div>
      </div>
      <div class="card shadow m-3 col-md-7">
        <!-- <div class="card-header"> -->
        <table class="table bg-primary text-light">
          <thead>
            <tr>
              <th width="70">&nbsp;&nbsp;No</th>
              <th width="290">Today'Schedule</th>
              <th width="120">Start Time</th>
            </tr>
          </thead>
        </table>
        <!-- </div> -->
        <div class="card-body" style="height: 400px;overflow: scroll;">
          <table class="table table-striped">
            <?php
            if ($cek == 0) {
              echo "<center><h6 style='color:red;'>Schedule Not Found</h6></center>";
            } else { ?>
              <tbody>
                <?php function activity($activity)
                {
                  global $conn;
                  $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$activity'"));
                  return $sqly['items'];
                }
                ?>
                <?php $i = 1; ?>
                <?php foreach ($jadwal as $row) :
                ?>
                  <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= activity($row["id_activity"]); ?></td>
                    <td><?= $row["start_time"]; ?></td>

                    <!-- <td>
                    
                    <button type="button" id="<?= $row["id"]; ?>" class="btn btn-primary" data-toggle="modal" data-target="#m2">
                      Launch demo modal
                    </button>
                  </td> -->
                  </tr>
                  <?php $i++; ?>
                <?php endforeach;
                ?>
              </tbody>
            <?php }
            ?>
          </table>

        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="m2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?= $_GET["id"]; ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow m-2">
    <div class="card-header   text-danger">
      <h2>
        <center>
          <p>Pengumuman</p>
        </center>
      </h2>
    </div>
    <div class="card-body">

    </div>
  </div>


  <!-- ...............................................
....................................................
....................................................
 -->







  <?php
  include 'm_lihatpresensi.php';
  ?>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script type="text/javascript" src="scanner/js/jquery.js"></script>
  <script type="text/javascript" src="scanner/js/qrcodelib.js"></script>
  <script type="text/javascript" src="scanner/js/webcodecamjquery.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
  <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>



  <script type="text/javascript">
    var arg = {
      resultFunction: function(result) {

        var redirect = '';
        $.redirectPost(redirect, {
          nis: result.code
        });
      }
    };

    var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
    decoder.buildSelectMenu("select");
    decoder.play();
    /*  Without visible select menu
        decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
    */
    $('select').on('change', function() {
      decoder.stop().play();
    });

    $.extend({
      redirectPost: function(location, args) {
        var form = '';
        $.each(args, function(key, value) {
          form += '<input type="hidden" name="' + key + '" value="' + value + '">';
        });
        $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo('body').submit();
      }
    });
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
  <?php
  include 'alert.php';
  ?>

</body>

</html>



<!-- ......................................................
...........................................................
...........................................................
 -->