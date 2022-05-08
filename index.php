<?php
include 'database.php';
$page = $_SERVER['PHP_SELF'];
$sec = "40";
session_start();
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H:i:s');
// ambil data semester
$get_semester = mysqli_query($conn, "SELECT * FROM tb_semester WHERE status='Aktif'");
$data1 = mysqli_fetch_array($get_semester);
$data_semester = $_SESSION['smt'] =  $data1['thn_semester'];

// ambil jam sekarang dan nama hari
$time = date('H');
$nama_hari = date('l');

// update otomatis hasil presensi siswa
$ambil_jadwal = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `schedule` WHERE status='Aktif' and date='$hari_ini'"));
$tanggal = $ambil_jadwal['date'];
$akt1 = $ambil_jadwal['batch'] = '1';
$akt45 = $ambil_jadwal['batch'] = '45';
$status = 'Waiting';

if ($hari_ini  == $tanggal && $time == 21) {
  mysqli_query($conn, "UPDATE `presensi` SET `ACC_Mentor`='approved' WHERE `ACC_Mentor`='$status' ");
}

// input target otomatis
// angkatan 1
$ambil_total_jadwal_akt1 = mysqli_fetch_array(mysqli_query($conn, "SELECT Max(week) as totalweek1, COUNT(batch) as batch FROM `schedule` WHERE date='$hari_ini' AND batch='$akt1'"));
$batch1 = $ambil_total_jadwal_akt1['batch'];
$minggumax1 = $ambil_total_jadwal_akt1['totalweek1'];

// angkatan 45
$ambil_total_jadwal_akt45 = mysqli_fetch_array(mysqli_query($conn, "SELECT Max(week) as totalweek45, COUNT(batch) as batch FROM `schedule` WHERE date='$hari_ini' AND batch='$akt45'"));
$batch45 = $ambil_total_jadwal_akt45['batch'];
$minggumax45 = $ambil_total_jadwal_akt45['totalweek45'];

// cek jadwal apakah ada
// $cek_jadwal_ =  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `schedule` where status='Aktif' and  date='$hari_ini' "));
// if ($cek_jadwal_ > 0) {
// eksekusi
if ($hari_ini  && $time == 21) {
  $max_idtarget = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_tabel_presence`) As id FROM `tb_target_presensi`"));
  $id_maxtarget = $max_idtarget['id'] + 1;
  mysqli_query($conn, "INSERT INTO `tb_target_presensi`(`id_tabel_presence`, `target`, `Day`,`semester`,`week`,`batch`) VALUES ('$id_maxtarget ','$batch1','$nama_hari','$data_semester ','$minggumax1','$akt1') ");
};

if ($hari_ini  && $time == 21) {
  $max_idtarget = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_tabel_presence`) As id FROM `tb_target_presensi`"));
  $id_maxtarget = $max_idtarget['id'] + 1;
  mysqli_query($conn, "INSERT INTO `tb_target_presensi`(`id_tabel_presence`, `target`, `Day`,`semester`,`week`,`batch`) VALUES ('$id_maxtarget ','$batch45','$nama_hari','$data_semester ','$minggumax45','$akt45') ");
};
// akhir input target otomatis


// set alarm
$alert_alarm = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `schedule` WHERE status='Aktif' and  `date`='$hari_ini' and `presensi_time`  < '$waktu_sekarang' and  `timer` > '$waktu_sekarang' "));
$alarm = $alert_alarm['nada_alarm'];
if ($alert_alarm['presensi_time'] < $waktu_sekarang && $alert_alarm['timer'] > $waktu_sekarang) { ?>
  <audio src="music/<?= $alarm; ?>" autoplay="autoplay" hidden="hidden"></audio>
<?php }

// ambil data angkatan siswa berdasarkan nis yang di scan qrcode
$nis2 = $_POST['nis'];
$sql_siswa = mysqli_query($conn, "SELECT angkatan FROM `siswa` WHERE nis='$nis2'");
$data_angkatan = mysqli_fetch_array($sql_siswa);
$angkatan = $data_angkatan['angkatan'];

// mengambil data schedule/jadwal berdasarkan angkatan siswa
$sqli_jadwal = mysqli_query($conn, "SELECT * FROM `schedule` where status='Aktif' and `batch`='$angkatan' and  date='$hari_ini'  and   `presensi_time` < '$waktu_sekarang' and  `end_time` > '$waktu_sekarang'");
$list20 = mysqli_fetch_array($sqli_jadwal);
$id_kegiatan = $list20['id'];
$week = $list20['week'];
$batch = $list20['batch'];
$id_kegiatan1 = $list20['id_activity'];
$info = $list20['info'];
$waktu = $list20['start_time'];
$jam_akhir = $list20['end_time'];
$waktuabsent = $list20['presensi_time'];
$timer = $list20['timer'];
$agreement = 'Waiting';


// var_dump($alert_alarm['absent_time']);
// mengecek jadwal jika tidak ada maka ada peringatan tidak ada pesan
$jadwal1 = mysqli_query($conn, "SELECT * FROM schedule WHERE status='Aktif' and  date='$hari_ini' and end_time > '$waktu_sekarang'   ORDER BY start_time ASC");
$cek_presensi = mysqli_fetch_array($jadwal1);
$cek = mysqli_num_rows($jadwal1);


if ($angkatan == $batch) {
  // memasukan data jadwal kegiatan berdasarkan data angkatan dan waktu dan hari
  if ($waktuabsent < $waktu_sekarang && $jam_akhir > $waktu_sekarang) {
    if ($waktuabsent < $waktu_sekarang && $timer > $waktu_sekarang) {
      $hasil = 'V';
    } else if ($timer < $waktu_sekarang && $waktu > $waktu_sekarang) {
      $hasil = 'O';
    } else {
      $hasil = 'X';
    }

    if (isset($_POST['nis'])) {
      $nis = htmlspecialchars($_POST['nis']);
      $mentor = mysqli_fetch_array(mysqli_query($conn, "SELECT mentor FROM `siswa` WHERE nis='$nis'"));
      $mentor = $mentor['mentor'];
      $sql_cekdata_nis = mysqli_num_rows(mysqli_query($conn, "SELECT nis, angkatan FROM `siswa` WHERE nis='$nis' and angkatan='$batch'"));
      if ($sql_cekdata_nis > 0) {
        $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_presensi`) As id FROM `presensi` WHERE presensi_date=date(now()) AND schedule_id='$id_kegiatan'"));
        $idbr = $max['id'] + 1;
        $inputpresensi =  mysqli_query($conn, "INSERT INTO `presensi` (`nis`,`presensi_date`,`presensi_time`,`schedule_id`,`week`, `batch`,`id_activity`,`semester`,`info_schedule`,`mark`,`id_presensi`,`mentor`,`ACC_Mentor`) VALUES ('$nis','$hari_ini','$waktu_sekarang', '$id_kegiatan', ' $week', '$batch','$id_kegiatan1','$data_semester','$info','$hasil','$idbr','$mentor','$agreement')");
        if ($inputpresensi) {
          $percobaan = $_SESSION['camera'] = '<div id="my_camera"></div>';
          echo notice(2);
        } else {
          $cekdata = $_SESSION['cek_data'] = '<p class="text-danger"><strong>Presence can only be 1 time!</strong></p>';
          echo notice(3);
        }
      }
    }
  }
} else if ($cek == 0) {
  $Announcement = $_SESSION['Announcement'] = 'No Schedule';
  echo notice(0);
} else if ($cek_presensi['presensi_time'] > $waktu_sekarang) {
  $Announcement = $_SESSION['Announcement'] = 'Its Not Time To Presence!';
  echo notice(0);
} else {

  $Announcement = $_SESSION['Announcement'] = 'Not Your Class Schedule!';
  echo notice(0);
}

$jadwal = mysqli_query($conn, "SELECT * FROM schedule WHERE status='Aktif' and  date='$hari_ini' and end_time > '$waktu_sekarang'   ORDER BY start_time ASC");
$list = mysqli_fetch_array($jadwal);
// $cek = mysqli_num_rows($jadwal);

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="<?= $sec ?>;URL='<?= $page ?>'">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>

  <title>Presensi PKA</title>
  <style>
    canvas {
      height: 250px;
      width: 100%;
      border-radius: 10px;
      margin-right: 10px;
    }

    .formscaner {
      height: 450px;
    }

    /* .formdailypresence {
      height: 450px;
    } */

    /* .today {
      height: 450px;
    } */

    body {
      height: 800px;
      width: 100%;
      background-color: #F9F9F9;

    }

    @media screen and (max-width: 575px) {

      canvas {
        height: 170px;
        width: 250px;
        border-radius: 10px;

      }
    }
  </style>

</head>

<body>
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
      <div class="card formscaner shadow mr-3 p-3 mt-2 col-md-3">
        <div class="card-header text-light bg-primary">
          <center>
            <h4>
              Scanner
            </h4>
          </center>
        </div>
        <div class="card-body">
          <br>
          <center>
            <canvas></canvas>
            <br>
            <br>
            <!-- <p>Silahkan Pilih Sumber kamera</p>
            <select></select> -->
          </center>
        </div>
      </div>
      <!-- <audio src="music/BellStasiun.mp3" autoplay="autoplay" hidden="hidden"></audio> -->


      <!-- script tampilan absensi -->
      <div class="card shadow formdailypresence mr-3 p-3  mt-2 col-md-5">
        <div class="card-header text-light bg-primary">
          <center>
            <h4>
              Daily Presence
            </h4>
          </center>
        </div>
        <div class="card-body">
          <table>
            <tr>
              <th width="150">&nbsp;&nbsp;&nbsp;&nbsp;No</th>
              <th width="220">Name</th>
              <th width="120"><span class="badge badge-pill badge-success">V</span></th>
              <th width="110"><span class="badge badge-pill badge-warning">O</span></th>
              <th width="110"><span class="badge badge-pill badge-danger">X</span></th>
              <th width="100"><span class="badge badge-pill badge-primary">I</span></th>
              <th width="100"><span class="badge badge-pill badge-dark">S</span></th>
              <th width="100">Point</th>
            </tr>
          </table>
          <?php
          function activity_name($nama_activity)
          {
            global $conn;
            $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nama_activity'"));
            return $sqly['name'];
          }
          $tampilan_presensi = mysqli_query($conn, "SELECT * FROM presensi where presensi_date='$hari_ini' group by nis order by presensi_time DESC");
          ?>
          <div class="modal-body " style="height: 300px;overflow: scroll;">
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


                  $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$nis' and mark='$mark_V' AND presensi_date='$hari_ini' ");
                  $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                  $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$nis' and mark='$mark_O'AND presensi_date='$hari_ini' ");
                  $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                  $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$nis' and mark='$mark_X' AND presensi_date='$hari_ini'");
                  $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                  $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$nis' and mark='$mark_I' AND presensi_date='$hari_ini'");
                  $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                  $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$nis' and mark='$mark_S' AND presensi_date='$hari_ini'");
                  $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                  $tampil3 = mysqli_query($conn, "SELECT * FROM presensi where nis='$nis' group by nis ");
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
      <div class="card today shadow mr-3 p-3 mt-2 col-md-3">
        <table class="table bg-primary text-light">

          <tr>
            <th width="170">&nbsp;&nbsp;No</th>
            <th width="290">Today's Schedule</th>
            <th width="120">Start Time</th>
          </tr>

        </table>
        <div class="card-body" style="height: 300px;overflow: scroll;">
          <table class="table table-striped">
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
                  <!-- menampilkan pesan jika pesan dijadwal ada -->
                  <td><?= activity($row["id_activity"]); ?>
                    <?php
                    if ($row["info"] != NULL) { ?>
                      <br>
                      <div class="alert alert-success mt-2" role="alert">
                        <h6 class="alert-heading">Message!</h6>
                        <p><?= $row["info"]; ?></p>
                      </div>
                    <?php    }
                    ?>

                  </td>
                  <td><?= $row["start_time"]; ?></td>
                </tr>
                <?php $i++; ?>
              <?php endforeach;
              ?>
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>



  <!-- Custom scripts for all pages-->
  <script type="text/javascript" src="scanner/js/jquery.js"></script>
  <script type="text/javascript" src="scanner/js/qrcodelib.js"></script>
  <script type="text/javascript" src="scanner/js/webcodecamjquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>





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

<!-- script awal menampilakan webcam di modal -->
<?php
if (isset($percobaan)) { ?>
  <style>
    .sembunyikantombol {
      display: none;
    }
  </style>
  <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-light">
          <h5 class="modal-title" id="staticBackdropLabel">Verification Presence</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <script>
          $(document).ready(function() {
            var button = document.getElementById('ambil');
            var detik = 5;

            function hitung() {
              setTimeout(hitung, 1000);
              $('#tampilkan').html(detik);
              detik--;
              if (detik < 0) {
                button.click();
                detik--;
              }
            }
            hitung();
          });
        </script>

        <form action="verifikasi.php?nis=<?= $_POST['nis']; ?>&id=<?= $idbr; ?>" method="POST" enctype="multipart/form-data">
          <div class="card-body">
            <center>
              <?php echo $percobaan; ?>
              <br />
              <h2 id='tampilkan' class="text-danger"></h2>
              <input type="submit" class="sembunyikantombol" name="kirim_gambar" id="ambil" value="Take Snapshot" onClick="take_snapshot()">
              <input type="hidden" name="image" class="image-tag">
            </center>
          </div>
        </form>
        <script language="JavaScript">
          Webcam.set({
            width: 350,
            height: 300,
            image_format: 'png',
            jpeg_quality: 90


          });
          Webcam.attach('#my_camera');

          function take_snapshot() {

            Webcam.snap(function(data_uri) {
              $(".image-tag").val(data_uri);
              document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });
          }
        </script>
      </div>
    </div>
  </div>
<?php }
?>
<script>
  $('#myModal').modal('show')
</script>
<!-- script akhir menampilkan webcam di modal -->

<?php


function notice($type)
{
  if ($type == 1) {
    return "<audio autoplay><source src='" . 'music/error.wav' . "'></audio>";
  } elseif ($type == 0) {
    return "<audio autoplay><source src='" . 'music/error.wav' . "'></audio>";
  } elseif ($type == 2) {
    return "<audio autoplay><source src='" . 'music/beep.mp3' . "'></audio>";
  } elseif ($type == 3) {
    return "<audio autoplay><source src='" . 'music/late_2.mp3' . "'></audio>";
  }
}

?>