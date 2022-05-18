<?php
include 'database.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H-i-s');
$nis = $_GET['nis'];
// $id = $_GET['id'];
$siswa = mysqli_query($conn, "SELECT * FROM siswa where nis='$nis'");
$s = mysqli_fetch_array($siswa);
$s['name'];

if (isset($_POST['week'])) {
  $week = $_POST['week'];
  if ($week != null) {
    $data_absent  = mysqli_query($conn, "SELECT * FROM presensi where nis='$nis' and  week LIKE '$week'  ORDER BY presensi_time DESC");
  } else {
    $data_absent = mysqli_query($conn, "SELECT * FROM presensi where nis='$nis' and week='$week'");
  }
} else {
  $data_absent = mysqli_query($conn, "SELECT * FROM presensi where nis='$nis' and presensi_date='$hari_ini'");
  $query_absent = mysqli_fetch_array($data_absent);
}


function activity($activity)
{
  global $conn;
  $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$activity'"));
  return $sqly['items'];
}


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=Sedgwick+Ave&display=swap" rel="stylesheet" />
  <title>Presensi PKA</title>


  <style>
    .profile {
      width: 300px;
      margin-bottom: 40px;
      margin-left: 60px;
      margin-top: 3px;

    }

    .card-header {
      font-family: 'PT Sans', sans-serif;
    }

    h5 {
      font-size: 1em;
      font-family: 'PT Sans', sans-serif;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      border: none;

    }

    .jam_ {

      margin: 20px;
      margin-top: 20px;
      margin-right: 100px;
      margin-left: 45px;

    }

    .image {
      width: 200px;

    }

    th {
      position: sticky;
      top: 0;
      background-color: #007BFF;
      color: #fff;
      padding: 12px 20px;
      text-align: center;
      text-transform: capitalize;
      font-family: 'PT Sans', sans-serif;

    }




    .tabel_schedule {
      width: 880px;
      margin-left: 25px;
      overflow: scroll;
      height: 420px;
      margin-right: 100px;
    }

    td {
      background-color: #fff;
      color: #000;
      text-align: center;
      border: #fff;
      padding: 15px;
      box-shadow: 2px 2px 10px #dddddd;
      font-family: 'Poppins', sans-serif;

    }



    /* untuk versi mobile */
    @media screen and (max-width: 576px) {
      .mobile {
        width: 320px;
        margin-left: -5px;
        margin-bottom: 10px;

      }



      h5 {
        font-size: 1em;
        font-family: 'PT Sans', sans-serif;
      }

      p {
        font-size: 0.8em;
        font-family: 'PT Sans', sans-serif;
      }

      table {
        width: 100%;
        margin-left: -5px;
        margin-bottom: 10px;
      }

      tr th {
        width: 100%;
        margin-right: 15px;
        margin-bottom: 10px;
        padding: 12px;
      }
    }
  </style>
  <title>View Schedule</title>


</head>

<body>
  <?php
  include 'navbar_buttom.php';
  ?>
  <?php
  include 'modal.php';
  ?>

  <div class="card jam_ shadow">
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


  <div class="row ">
    <center>

      <div class="profile shadow ">
        <div class=" bg-primary text-light card-header">
          Profil Siswa
        </div>
        <div class="card-body">
          <img src="img/fotosiswa/<?= $s['image']; ?>" class="image" alt="...">
          <h5 class="card-title mt-3">Name : <?= $s['name']; ?></h5>
          <h5 class="card-title">Batch&nbsp; : <?= $s['angkatan']; ?></h5>
          <center>
            <img src="img/logo/Edit Logo PKA-DP_v1.png" class="card-img-top h-25 w-25" alt="...">
            <p class="card-text">Peserta Pelatihan Kebenaran Alkitab</p>

          </center>

        </div>
      </div>
    </center>

    <!-- tabel schedule -->
    <div class="tabel_schedule shadow">
      <div class=" bg-primary text-light card-header form-inline">
        Minggu :&nbsp;&nbsp;
        <form action="" method="POST" id="form_id">
          <select id="" class="form-control col-12" name="week" onChange="document.getElementById('form_id').submit();">
            <?php
            if (isset($_POST['week'])) {
              $value_minggu = mysqli_fetch_array(mysqli_query($conn, "SELECT week, nis FROM `presensi` where nis='$nis' and week='" . $_POST['week'] . "'")); ?>
              <option value="<?= $value_minggu['week'] ?>"><?= $value_minggu['week'] ?></option>
            <?php    } else {
              echo  '<option selected>Pilih Minggu</option>';
            }
            $presensi_hasil = mysqli_query($conn, "SELECT week, nis FROM `presensi` where nis='$nis' GROUP by week");
            while ($hasil_data = mysqli_fetch_array($presensi_hasil)) { ?>
              <option value="<?= $hasil_data['week'] ?>"><?= $hasil_data['week'] ?></option>
            <?php    }  ?>
          </select>
          <a href="view.php?nis=<?= $nis ?>" class="btn btn-danger">Reset</a>
        </form>
      </div>
      <!-- <div class="card-header"> -->
      <table border="1">

        <tr>
          <th>No</th>
          <th>Jadwal Hari ini</th>
          <th>Minggu</th>
          <th>Waktu Mulai</th>
          <th>Waktu Presensi</th>
          <th>Tanda</th>
          <th>Status</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($data_absent as $row) :
        ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= activity($row['id_activity']); ?></td>
            <td><?= $row['week'] ?></td>
            <td>
              <?php
              // mengambil waktu kegiatanm di tabel kegiatan berdasarkan id kegiatan
              $id_kegiatan = $row["schedule_id"];
              $sqly4 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schedule WHERE id='$id_kegiatan'"));
              $waktu_kegiatan = $sqly4['start_time'];
              $timer = $sqly4['timer'];
              $end_time = $sqly4['end_time'];
              $absent_time1 = $sqly4['presensi_time'];
              ?>
              <?= $waktu_kegiatan; ?>
            </td>
            <td>
              <?= $row['presensi_time']; ?>
            </td>
            <td>
              <?php
              // jika presensinya terlambat maka warna merah statusnya
              if ($row["mark"] == 'X') { ?>
                <span class="badge badge-pill badge-danger"><?= $row["mark"]; ?></span>
              <?php  } else if ($row["mark"] == 'O') { ?>
                <span class="badge badge-pill badge-warning"><?= $row["mark"]; ?></span>
              <?php   } else { ?>
                <span class="badge badge-pill badge-info"><?= $row["mark"]; ?></span>

              <?php   }
              ?>
            </td>
            <td>
              <?php
              // jika presensinya terlambat maka warna merah statusnya
              if ($row["ACC_Mentor"] == 'Waiting') { ?>
                <span class="badge badge-pill badge-warning"><?= $row["ACC_Mentor"]; ?></span>
              <?php  } else if ($row["ACC_Mentor"] == 'not approved') { ?>
                <span class="badge badge-pill badge-danger"><?= $row["ACC_Mentor"]; ?></span>
              <?php   } else { ?>
                <span class="badge badge-pill badge-success"><?= $row["ACC_Mentor"]; ?></span>
              <?php  } ?>
            </td>
          </tr>
          <?php $i++; ?>
        <?php endforeach;
        ?>

      </table>

    </div>
    <!-- tabel schedule
      <div class="card table-2 shadow ">
        <div class=" bg-primary text-light card-header">
          <center>
            Progres
          </center>
        </div>
        <div class="card-body">

        </div>
      </div> -->




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