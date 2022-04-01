<?php
include 'database.php';
$page = $_SERVER['PHP_SELF'];
$sec = "50";
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
$list20 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `schedule` where status='Aktif' and date='$hari_ini' and start_time < '$waktu_sekarang' and end_time > '$waktu_sekarang' ||  absent_time > '$waktu_sekarang' and timer > '$waktu_sekarang'"));
$id_kegiatan = $list20['id'];
$week = $list20['week'];
$batch = $list20['batch'];
$id_kegiatan1 = $list20['id_activity'];
$info = $list20['info'];
$waktu = $list20['start_time'];
$jam_akhir = $list20['end_time'];
$waktuabsent = $list20['absent_time'];
$timer = $list20['timer'];
$agreement = 'Waiting';





if ($waktu < $waktu_sekarang && $jam_akhir > $waktu_sekarang) {

  if ($waktuabsent > $waktu_sekarang) {
    $hasil = 'V';
  } else if ($waktuabsent < $waktu_sekarang && $timer > $waktu_sekarang) {
    $hasil = 'O';
  } else {
    $hasil = 'X';
  }

  if (isset($_POST['nis'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $mentor = mysqli_fetch_array(mysqli_query($conn, "SELECT mentor FROM `siswa` WHERE nis='$nis'"));
    $mentor = $mentor['mentor'];
    $CekPresensi = mysqli_fetch_array(mysqli_query($conn, "SELECT nis FROM `absent` WHERE nis='$nis'"));
    $CekPresensi = $CekPresensi['nis'];
    $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_absent`) As id FROM `absent` WHERE absent_date=date(now()) AND schedule_id='$id_kegiatan'"));
    $idbr = $max['id'] + 1;
    $hapus =  mysqli_query($conn, "INSERT INTO `absent`(`nis`,`absent_date`,`absent_time`,`schedule_id`,`week`, `batch`,`id_activity`,`semester`,`info_schedule`,`mark`,`id_absent`,`mentor`,`ACC_Mentor`) VALUES ('$nis','$hari_ini','$waktu_sekarang', '$id_kegiatan', ' $week', '$batch','$id_kegiatan1','$data_semester','$info','$hasil','$idbr','$mentor','$agreement')");
    if ($hapus) {
      $notifsukses = $_SESSION['sukses'] = 'Berhasil Disimpan';
    } else {
      // $duakalipresensi = $_SESSION['gagal'] = '<p class="text-danger"><strong>Announcement!</strong></p>';
      $notifgagal = $_SESSION['gagal'] = 'Belum Saatnya Melakukan Presensi';
    }
  }
} else {
  $notifgagal = $_SESSION['gagal'] = 'Belum Saatnya Melakukan Presensi';
  //   // peringatan pesan jika presensinya belum aktif atau belum saatnya presensi
}



$jadwal = mysqli_query($conn, "SELECT * FROM schedule WHERE status='Aktif' and  date='$hari_ini' and end_time > '$waktu_sekarang'   ORDER BY start_time ASC");
$list = mysqli_fetch_array($jadwal);
$cek = mysqli_num_rows($jadwal);
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="refresh" content="<?= $sec ?>;URL='<?= $page ?>'">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
  <title>Presensi PKA</title>
</head>

<body>
  <nav class="navbar navbar-light bg-dark">
    <a class="navbar-brand text-light">Presensi PKA</a>
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
      <div class="card shadow m-3 col-md-3">
        <div class="card-header text-light bg-primary">
          <center>
            <h4>
              Scanner
            </h4>
          </center>
        </div>


        <div class="card-body">
          <br>
          <br>
          <br>
          <center>
            <canvas></canvas>
            <br>
            <br>
            <br>
            <br>
            <p>Silahkan Pilih Sumber kamera</p>
            <select></select>
          </center>
        </div>
      </div>


      <!-- script tampilan absensi -->
      <div class="card shadow m-3 col-md-5">
        <div class="card-header text-light bg-primary">
          <center>
            <h4>
              Daily Attendance (Presensi Harian)
            </h4>
          </center>
        </div>

        <div class="card-body">
          <table class="table  text-dark">
            <thead>
              <tr>
                <th width="150">&nbsp;&nbsp;No</th>
                <th width="270">Name</th>
                <th width="130"><span class="badge badge-pill badge-success">V</span></th>
                <th width="100"><span class="badge badge-pill badge-warning">O</span></th>
                <th width="100"><span class="badge badge-pill badge-danger">X</span></th>
                <th width="100"><span class="badge badge-pill badge-primary">I</span></th>
                <th width="100"><span class="badge badge-pill badge-dark">S</span></th>
                <th width="100">POINT</th>
              </tr>
            </thead>
          </table>
          <?php
          function activity_name($nama_activity)
          {
            global $conn;
            $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nama_activity'"));
            return $sqly['name'];
          }

          $tampilan_presensi = mysqli_query($conn, "SELECT * FROM absent where absent_date='$hari_ini'  group by nis order by absent_time DESC");

          ?>
          <div class="modal-body " style="height: 400px;overflow: scroll;">
            <table class=" table table-striped">
              <tbody>
                <?php $j = 1; ?>
                <?php
                while ($array_presensi = mysqli_fetch_array($tampilan_presensi)) {
                  $nis = $array_presensi['nis'];
                  $mark_V = $array_presensi['mark'] = 'V';
                  $mark_O = $array_presensi['mark'] = 'O';
                  $mark_X = $array_presensi['mark'] = 'X';
                  $mark_I = $array_presensi['mark'] = 'I';
                  $mark_S = $array_presensi['mark'] = 'S';


                  $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_V' AND absent_date='$hari_ini' ");
                  $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                  $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_O'AND absent_date='$hari_ini' ");
                  $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                  $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_X' AND absent_date='$hari_ini'");
                  $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                  $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_I' AND absent_date='$hari_ini'");
                  $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                  $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_S' AND absent_date='$hari_ini'");
                  $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                  $tampil3 = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' group by nis ");
                  $arraytampil3 = mysqli_fetch_array($tampil3);

                  $total_point = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];
                ?>

                  <?php foreach ($tampil3  as $data) :
                  ?>
                    <tr>
                      <th width="75"><?= $j; ?></th>
                      <td width="300"><a href="" type="button" class="btn"><?= activity_name($data["nis"]); ?></a></td>
                      <td width="125"><?= $arraytampil_mark_V['total']; ?></td>
                      <td width="110"><?= $arraytampil_mark_O['total']; ?></td>
                      <td width="110"><?= $arraytampil_mark_X['total']; ?></td>
                      <td width="100"><?= $arraytampil_mark_I['total']; ?></td>
                      <td width="90"><?= $arraytampil_mark_S['total']; ?></td>
                      <td width="30">
                        <?php
                        if ($total_point == -1) { ?>
                          <!-- jika absent nya mines maka warna merah hasilnya -->
                          <span class="badge badge-pill badge-danger"><?= $total_point; ?></span>
                        <?php } else { ?>
                          <!-- jika absent nya bukam mines maka warna biru laut hasilnya -->
                          <span class="badge badge-pill badge-info"><?= $total_point; ?></span>
                        <?php   }
                        ?>
                      </td>
                    </tr>
                    <?php $j++; ?>
                <?php endforeach;
                }
                ?>

              </tbody>
            </table>

          </div>
        </div>
      </div>
      <!-- akhir script tampilan absent -->


      <!-- tabel schedule -->
      <div class="card shadow m-3 col-md-3">
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
    </div>
  </div>
  <!-- akhir tabel schedule -->

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