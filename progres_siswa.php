<?php
include 'database.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H-i-s');
// $id = $_GET['id'];


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
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=Sedgwick+Ave&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>

  <style>
    .card_1 {
      width: 98%;
      margin-left: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
    }



    /* .card_2 {
      width: 50%;
      margin-left: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
      border-radius: 10px;

    } */

    .select_ {
      float: right;
      margin-right: 20px;

    }

    #container {
      height: 400px;
    }

    #container2 {
      height: 400px;
    }


    /* tr:nth-child(even) {
      background-color: #dddddd;
    } */
  </style>
  <title>Chart Student</title>
</head>

<body>
  <?php
  include 'navbar_buttom.php';
  ?>
  <?php
  include 'modal.php';
  ?>

  <div class="card_1 shadow">
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

  <div class="row">

    <div class="col-sm-6">
      <div class=" ml-2 shadow">
        <div class="card-header  bg-primary text-light">
          <form action="" method="Post" class="form-inline">
            <h5>Student Progress Details</h5>
            <select name="siswa" id="" class="form-control col-3 ml-3">
              <option selected>Select Student</option>
              <?php
              $siswa = mysqli_query($conn, "SELECT * FROM siswa where status='Aktif'");
              while ($data_siswa = mysqli_fetch_array($siswa)) {  ?>
                <option value="<?= $data_siswa['nis']; ?>"><?= $data_siswa['name']; ?></option>
              <?php
              }
              ?>
            </select>

            <select name="sms" id="" class="form-control col-3 ml-3">
              <option selected>Select Semester</option>
              <?php
              $sqlisemester = mysqli_query($conn, "SELECT * FROM `tb_semester` ");
              while ($data_semester1 = mysqli_fetch_array($sqlisemester)) {  ?>
                <option value="<?= $data_semester1['thn_semester']; ?>"><?= $data_semester1['keterangan']; ?></option>
              <?php
              }
              ?>
            </select>
            <button type="submit" name="cari" class="btn btn-success ml-2">View</button>
          </form>
          <?php
          if (isset($_POST['cari'])) {
            $selectsiswa = $_POST['siswa'];
            $data_semester = $_POST['sms'];
            $sms = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_semester` where thn_semester='$data_semester '"));
            $datasiswa = mysqli_query($conn, "SELECT * FROM siswa where nis='$selectsiswa'");
            while ($siswa = mysqli_fetch_array($datasiswa)) {
              $id = $siswa['nis'];
              $nama_siswa = $siswa['name'];

              $tampilan_presensi21 = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(presensi) as totalpresensi FROM tb_presensi where nis='$id' and semester='$data_semester'  group by nis"));

              $revival_note = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+SUM(point2) as revivalnote FROM `tb_revival_note` where nis='$id' and semester='$data_semester' "));

              $prayer_note = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+SUM(point) as prayernote FROM `tb_prayer_note` where nis='$id' and semester='$data_semester'"));

              $bible_reading = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+SUM(point)+sum(point2) as biblereading FROM `tb_bible_reading` where nis='$id' and semester='$data_semester'"));

              $exhibition = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point) as exhibition FROM `tb_exhibition` where nis='$id' and semester='$data_semester'"));

              $personalgoal = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+sum(point2)+sum(point3) as personalgoal FROM `tb_personal_goal` where nis='$id' and semester='$data_semester'"));

              $homemeeting = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point) as homemeeting FROM `tb_home_meeting` where nis='$id' and semester='$data_semester'"));

              $blessings = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+sum(point2)+sum(point3)+sum(point4)+sum(point5)+sum(point6)+sum(point7)+sum(point8) as blessings FROM `tb_blessings` where nis='$id' and semester='$data_semester'"));

              $virtuechracter = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(perhatian_berbagi)+sum(salam_sapa)+sum(bersyukur_berterimakasih)+sum(hormat_taat)as vituecharacter FROM `tb_vrtues_caharacter` where nis='$id' and semester='$data_semester'"));

              $virtue = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(sikapramahsopan)+sum(sikapberkordinasi)+sum(sikaptolongmenolong)+sum(sikapseedo) as virtue FROM `tb_virtues` where nis='$id' and semester='$data_semester'"));

              $character = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(benar)+sum(tepat)+sum(ketat) as totalcharacter FROM `tb_character` where nis='$id' and semester='$data_semester'"));

              $living_buku = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as buku FROM tb_living_buku where nis='$id' and semester='$data_semester'"));

              $living_pakaianlipat = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as pakaianlipat FROM tb_living_pakaianlipat where nis='$id' and semester='$data_semester'"));

              $living_pakaiangantung = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bentuk`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as pakaiangantung FROM tb_living_pakaiangantung where nis='$id' and semester='$data_semester'"));

              $living_celana = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as celana FROM tb_living_celanalipat  where nis='$id' and semester='$data_semester'"));

              $living_logistik = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as logistik FROM tb_living_logistik where nis='$id' and semester='$data_semester'"));

              $living_pakaiandalam = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as pakaiandalam FROM tb_living_pakaiandalam where nis='$id' and semester='$data_semester'"));

              $ranjang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_ranjang WHERE nis='$id' and semester='$data_semester' ");
              $livingranjang = mysqli_fetch_array($ranjang);
              $bantal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_bantal WHERE nis='$id' and semester='$data_semester'");
              $livingbantal = mysqli_fetch_array($bantal);
              $seprei = mysqli_query($conn, "SELECT SUM(`rapi`)+SUM(`raib`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_seprei WHERE nis='$id' and semester='$data_semester'");
              $livingseprei = mysqli_fetch_array($seprei);
              $selimut = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_selimut WHERE nis='$id' and semester='$data_semester'");
              $livingselimut = mysqli_fetch_array($selimut);

              // total living rak sepatu
              $raksepatu = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_sepatu WHERE nis='$id' and semester='$data_semester'");
              $livingraksepatu = mysqli_fetch_array($raksepatu);
              $sepatusidang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_sidang WHERE nis='$id' and semester='$data_semester'");
              $livingsepatusidang = mysqli_fetch_array($sepatusidang);
              $sepatu_or = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_or WHERE nis='$id' and semester='$data_semester'");
              $livingsepatu_or = mysqli_fetch_array($sepatu_or);
              $sandal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sendal WHERE nis='$id' and semester='$data_semester'");
              $livingsandal = mysqli_fetch_array($sandal);
              $rakhanduk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_handuk WHERE nis='$id' and semester='$data_semester'");
              $livingrakhanduk = mysqli_fetch_array($rakhanduk);
              $handuk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_handuk WHERE nis='$id' and semester='$data_semester'");
              $livinghanduk = mysqli_fetch_array($handuk);

              $totallivingraksepatu = $livingraksepatu['jumlah'] + $livingsepatusidang['jumlah'] + $livingsepatu_or['jumlah'] + $livingsandal['jumlah'] + $livingrakhanduk['jumlah'] + $livinghanduk['jumlah'];

              $totallivingranjang = $livingranjang['jumlah'] + $livingbantal['jumlah'] + $livingseprei['jumlah'] + $livingselimut['jumlah'];

              $totallivinglemari = $living_buku['buku'] + $living_pakaianlipat['pakaianlipat'] + $living_pakaiangantung['pakaiangantung'] + $living_celana['celana'] + $living_logistik['logistik'] + $living_pakaiandalam['pakaiandalam'];

              $virtue_character = $virtuechracter['vituecharacter'] + $virtue['virtue'] + $character['totalcharacter'];

              $totaljurnal = $revival_note['revivalnote'] + $prayer_note['prayernote'] + $bible_reading['biblereading'] + $exhibition['exhibition'] + $personalgoal['personalgoal'] + $homemeeting['homemeeting'] + $blessings['blessings'];

              $total_living = $totallivingraksepatu + $totallivingranjang + $totallivinglemari + $virtue_character;
            }
          }

          // var_dump($nama_siswa);
          ?>
        </div>
        <div class="card-body">
          <div id="container"></div>
        </div>
      </div>
    </div>


    <div class="col-sm-6">
      <div class="mr-4  shadow">
        <div class="card-header h-60  bg-primary text-light">
          <h5>Student Progress Whole</h5>
        </div>
        <div class="card-body">
          <div id="container2"></div>
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
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script type="text/javascript">
    Highcharts.chart('container', {
      chart: {
        type: 'area'
      },
      title: {
        text: ''
      },
      xAxis: {
        categories: ['Revival Note', 'Prayer Note', 'Bible Reading', 'Exhibition', 'Personal Goal', 'Home Meeting', 'Blessings']
      },
      credits: {
        enabled: false
      },
      series: [{
        name: '<?= $nama_siswa; ?>',
        data: [
          <?= $revival_note['revivalnote']; ?>,
          <?= $prayer_note['prayernote']; ?>,
          <?= $bible_reading['biblereading']; ?>,
          <?= $exhibition['exhibition']; ?>,
          <?= $personalgoal['personalgoal']; ?>,
          <?= $homemeeting['homemeeting']; ?>,
          <?= $blessings['blessings']; ?>
        ]
      }]
    });
  </script>












  <script type="text/javascript">
    Highcharts.chart('container2', {
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
      },
      title: {
        text: 'Semester <br><?= $sms['keterangan']; ?>',
        align: 'center',
        verticalAlign: 'middle',
        y: 60
      },
      tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      accessibility: {
        point: {
          valueSuffix: '%'
        }
      },
      plotOptions: {
        pie: {
          dataLabels: {
            enabled: true,
            distance: -50,
            style: {
              fontWeight: 'bold',
              color: 'white'
            }
          },
          startAngle: -90,
          endAngle: 90,
          center: ['50%', '75%'],
          size: '110%'
        }
      },
      series: [{
        type: 'pie',
        name: '<?= $nama_siswa; ?>',
        innerSize: '50%',
        data: [
          ['Presence', <?= $tampilan_presensi21['totalpresensi']; ?>],
          ['Jurnal PKA', <?= $totaljurnal; ?>],
          ['Living', <?= $total_living; ?>],

        ]
      }]
    });
  </script>
</body>

</html>