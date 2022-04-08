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
$data_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$nis'");
$query_absent = mysqli_fetch_array($data_absent);
$s['name'];

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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=Sedgwick+Ave&display=swap" rel="stylesheet" />
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['2022', 'Target Point', 'Point'],
        <?php
        $query = "SELECT * FROM absent WHERE nis='$nis' group by week";
        $res = mysqli_query($conn, $query);
        while ($data = mysqli_fetch_array($res)) {
          $V = $data['mark'] = 'V';
          $O = $data['mark'] = 'O';
          $X = $data['mark'] = 'X';
          $I = $data['mark'] = 'I';
          $S = $data['mark'] = 'S';


          $id = $data['id_activity'];

          $id_kagiatan = mysqli_query($conn, "select target from activity where id_activity='$id'");
          $kegiatan = mysqli_fetch_array($id_kagiatan);

          $tampil_mark_V = mysqli_query($conn, "select nis, week, mark, COUNT(mark) as total from absent where nis='$nis' and mark='$V' group by week");
          $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

          $tampil_mark_O = mysqli_query($conn, "select nis, week, mark, COUNT(mark) as total from absent where nis='$nis' and mark='$O' group by week");
          $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

          $tampil_mark_X = mysqli_query($conn, "select nis, week, mark, COUNT(mark) as total from absent where nis='$nis' and mark='$X' group by week");
          $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

          $tampil_mark_I = mysqli_query($conn, "select nis, week, mark, COUNT(mark) as total from absent where nis='$nis' and mark='$I' group by week");
          $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

          $tampil_mark_S = mysqli_query($conn, "select nis, week, mark, COUNT(mark) as total from absent where nis='$nis' and mark='$S' group by week");
          $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);





          $XX = $arraytampil_mark_V['total']  + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];
          $year = $data['week'];
          $target = $kegiatan['target'];






        ?>['Week <?php echo $year; ?>', <?php echo $target; ?>, <?php echo $XX; ?>],
        <?php
        }
        ?>
      ]);

      var options = {
        chart: {
          title: 'Progres Data Presensi <?= $s['name']; ?>',
          subtitle: 'Semester 2022'
        },
        bars: 'vertical' // Required for Material Bar Charts.
      };

      var chart = new google.charts.Bar(document.getElementById('barchart_material'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>

  <style>
    .mobile {
      width: 400px;
      margin-bottom: 40px;
      margin-left: -15px;
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
      width: 100%;
      margin-bottom: 10px;
      margin: 10px;


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




    .card_data {

      width: 65%;
      height: 50vh;
      margin: 2px 2px 2px 2px;
      margin-right: -20px;
      margin-left: 15px;
      overflow: scroll;



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

    .table-2 {
      margin-left: 35px;
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
  <title>Hello, world!</title>
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


  <div class="container-fluid m-md-5 m-1 ">
    <div class="form-row ">
      <center>

        <div class="mobile shadow ">
          <div class=" bg-primary text-light card-header">
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
      </center>

      <!-- tabel schedule -->
      <div class="card_data shadow col-4">
        <!-- <div class="card-header"> -->
        <table border="1">

          <tr>
            <th>No</th>
            <th>Today'Schedule</th>
            <th>Start Time</th>
            <th>Absent Time</th>
            <th>Mark</th>
            <th>Status</th>
          </tr>
          <?php $i = 1; ?>
          <?php foreach ($data_absent as $row) :
          ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= activity($row['id_activity']); ?></td>
              <td>
                <?php
                // mengambil waktu kegiatanm di tabel kegiatan berdasarkan id kegiatan
                $id_kegiatan = $row["schedule_id"];
                $sqly4 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schedule WHERE id='$id_kegiatan'"));
                $waktu_kegiatan = $sqly4['start_time'];
                $timer = $sqly4['timer'];
                $end_time = $sqly4['end_time'];
                $absent_time1 = $sqly4['absent_time'];
                ?>
                <?= $waktu_kegiatan; ?>
              </td>
              <td>

                <?= $row['absent_time']; ?>
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
      <!-- tabel schedule -->
      <div class="card table-2 shadow col-4  ">
        <div class=" bg-primary text-light card-header">
          Profile
        </div>
        <div class="card-body">
          <div id="barchart_material" style="width: 400px; height: 500px;"></div>
        </div>
      </div>


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