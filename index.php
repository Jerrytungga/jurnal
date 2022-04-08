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
$list20 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `schedule` where status='Aktif' and date='$hari_ini' and   absent_time < '$waktu_sekarang' and timer > '$waktu_sekarang' || end_time > '$waktu_sekarang'"));
$id_kegiatan = $list20['id'];
$week = $list20['week'];
$batch = $list20['batch'];
$id_kegiatan1 = $list20['id_activity'];
$info = $list20['info'];
$waktu = $list20['start_time'];
$jam_akhir = $list20['end_time'];
$waktuabsent = $list20['absent_time'];
$timer = $list20['timer'];
$alarm = $list20['nada_alarm'];
$agreement = 'Waiting';

if ($waktuabsent < $waktu_sekarang && $jam_akhir > $waktu_sekarang && $jam_akhir > $waktu_sekarang) {
  if ($waktuabsent < $waktu_sekarang && $timer > $waktu_sekarang &&  $waktu > $waktu_sekarang) {
    $hasil = 'V'; ?>
    <audio src="music/<?= $alarm; ?>" autoplay="autoplay" hidden="hidden"></audio>
    <?php } else if ($timer < $waktu_sekarang && $waktu > $waktu_sekarang) {
    $hasil = 'O';
  } else {
    $hasil = 'X';
  }

  if (isset($_POST['nis'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $mentor = mysqli_fetch_array(mysqli_query($conn, "SELECT mentor FROM `siswa` WHERE nis='$nis'"));
    $mentor = $mentor['mentor'];

    $sql_cekdata_nis = mysqli_num_rows(mysqli_query($conn, "SELECT nis FROM `siswa` WHERE nis='$nis'"));
    if ($sql_cekdata_nis > 0) {

      $sql_schedule5 = mysqli_fetch_array(mysqli_query($conn, "SELECT absent_time FROM `absent` WHERE nis='$nis'"));
      $timeabsent = $sql_schedule5['absent_time'];
      $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_absent`) As id FROM `absent` WHERE absent_date=date(now()) AND schedule_id='$id_kegiatan'"));
      $idbr = $max['id'] + 1;
      $sql_schedule3 = mysqli_fetch_array(mysqli_query($conn, "SELECT id_activity FROM `schedule` WHERE id='$id_kegiatan'"));
      $activity = $sql_schedule3['id_activity'];

      $hapus =  mysqli_query($conn, "INSERT INTO `absent`(`nis`,`absent_date`,`absent_time`,`schedule_id`,`week`, `batch`,`id_activity`,`semester`,`info_schedule`,`mark`,`id_absent`,`mentor`,`ACC_Mentor`) VALUES ('$nis','$hari_ini','$waktu_sekarang', '$id_kegiatan', ' $week', '$batch','$id_kegiatan1','$data_semester','$info','$hasil','$idbr','$mentor','$agreement')");
      if ($hapus) {
        $notifsukses = $_SESSION['sukses'] = 'Berhasil Disimpan';
        // header('location: contoh.php');
    ?>
        <audio src="music/beep.mp3" autoplay="autoplay" hidden="hidden"></audio>
      <?php  } else {
        $cekdata = $_SESSION['cek_data'] = '<p class="text-danger"><strong>Presence can only be 1 time!</strong></p>'; ?>
        <audio src="music/late_2.mp3" autoplay="autoplay" hidden="hidden"></audio>
  <?php    }
    }
  }
} else {
  // $notifgagal = $_SESSION['gagal'] = 'Belum Saatnya Melakukan Presensi';
  ?>
  <!-- <audio src="music/<?= $alarm; ?>" autoplay="autoplay" hidden="hidden"></audio> -->
<?php }





$jadwal = mysqli_query($conn, "SELECT * FROM schedule WHERE status='Aktif' and  date='$hari_ini' and end_time > '$waktu_sekarang'   ORDER BY start_time ASC");
$list = mysqli_fetch_array($jadwal);
$cek = mysqli_num_rows($jadwal);

// $cek_data_absent = mysqli_query($conn, "SELECT nis FROM `absent` WHERE nis='$nis'");
// $cek_absent = mysqli_fetch_array($cek_data_absent);
// $_data = mysqli_num_rows($cek_data_absent);
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

<body style="background-color: #EDEDF5; ">
  <?php
  include 'navbar_buttom.php';
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

  <div class="container-fluid m-md-5 m-2 ">
    <div class="form-row mx-auto">

      <div class="card shadow mr-3 p-3 mt-2 col-md-3">
        <div class="card-header text-light bg-primary">
          <center>
            <h4>
              Memindai
            </h4>
          </center>
        </div>
        <div class="card-body">
          <br>
          <br>
          <br>
          <center>
            <canvas style=" border-radius: 5px; width:280px;height:200px;"></canvas>
            <br>
            <br>
            <p>Silahkan Pilih Sumber kamera</p>
            <select></select>
          </center>
        </div>
      </div>


      <!-- script tampilan absensi -->
      <div class="card shadow mr-3 p-3  mt-2 col-md-5">
        <div class="card-header text-light bg-primary">
          <center>
            <h4>
              Presensi Harian
            </h4>
          </center>
        </div>

        <div class="card-body">
          <table>

            <tr>
              <th width="150">&nbsp;&nbsp;&nbsp;&nbsp;No</th>
              <th width="220">Nama</th>
              <th width="120"><span class="badge badge-pill badge-success">V</span></th>
              <th width="110"><span class="badge badge-pill badge-warning">O</span></th>
              <th width="110"><span class="badge badge-pill badge-danger">X</span></th>
              <th width="100"><span class="badge badge-pill badge-primary">I</span></th>
              <th width="100"><span class="badge badge-pill badge-dark">S</span></th>
              <th width="100">POIN</th>
            </tr>

          </table>
          <?php
          function activity_name($nama_activity)
          {
            global $conn;
            $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nama_activity'"));
            return $sqly['name'];
          }

          $tampilan_presensi = mysqli_query($conn, "SELECT * FROM absent   group by nis order by absent_time DESC");

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
                      <th width="55"><?= $j; ?></th>
                      <td width="300"><a href="view.php?nis=<?= $data["nis"]; ?>" type="button" class="btn"><?= activity_name($data["nis"]); ?></a></td>
                      <td width="125"><?= $arraytampil_mark_V['total']; ?></td>
                      <td width="110"><?= $arraytampil_mark_O['total']; ?></td>
                      <td width="110"><?= $arraytampil_mark_X['total']; ?></td>
                      <td width="100"><?= $arraytampil_mark_I['total']; ?></td>
                      <td width="90"><?= $arraytampil_mark_S['total']; ?></td>
                      <td width="30">
                        <?php
                        if (
                          $total_point == -1 || $total_point == -2 || $total_point == -3 || $total_point == -4  ||
                          $total_point == -5 || $total_point == -6 || $total_point == -7 || $total_point == -8  ||
                          $total_point == -9 || $total_point == -10 || $total_point == -11 || $total_point == -12  ||
                          $total_point == -13 || $total_point == -14 || $total_point == -15 || $total_point == -16  ||
                          $total_point == -17 || $total_point == -18 || $total_point == -19 || $total_point == -20  ||
                          $total_point == -21 || $total_point == -22 || $total_point == -23 || $total_point == -24  ||
                          $total_point == -25 || $total_point == -26 || $total_point == -27 || $total_point == -28  ||
                          $total_point == -29 || $total_point == -30 || $total_point == -31 || $total_point == -32  ||
                          $total_point == -33 || $total_point == -34 || $total_point == -35 || $total_point == -36  ||
                          $total_point == -37 || $total_point == -38 || $total_point == -39 || $total_point == -40
                        ) { ?>
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
      <div class="card shadow mr-3 p-3 mt-2 col-md-3">
        <!-- <div class="card-header"> -->
        <table class="table bg-primary text-light">

          <tr>
            <th width="170">&nbsp;&nbsp;No</th>
            <th width="290">Jadwal Harian</th>
            <th width="120">Waktu Mulai</th>
          </tr>

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


  <!-- Configure a few settings and attach camera -->


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
  include 'modal.php';
  ?>
</body>

</html>