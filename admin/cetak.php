<?php
include '../database.php';
// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/Session.php';


$siswa = mysqli_query($conn, "SELECT * FROM siswa a JOIN tb_angkatan b ON a.angkatan= b.angkatan WHERE status='Aktif' ORDER BY a.date DESC;");

?>
<!DOCTYPE html>
<html>

<head>

  <style>
    a {
      font-weight: bold;
      font-size: 15pt;
      text-align: right;
      color: red;

    }

    img {
      width: 10%;
      text-align: center;
      padding: auto;

    }

    text {
      font-size: 15pt;
    }


    p {
      font-size: 18pt;
    }




    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      margin: 20px 20px 20px 20px;
      border: 0px solid #000;
      padding: auto;
      width: 97%;
    }

    /* #margin {
      margin: 5px 5px 5px 5px;
      border: 0px solid #000;
    } */

    #customers td,
    #customers th {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }

    #customers tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    #customers tr:hover {
      background-color: #ddd;
    }

    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: center;
      /* background-color: #E5890A; */
      color: white;
    }
  </style>
</head>

<body>

  <center>
    <img src="../img/logo/Edit Logo PKA-DP.png">
  </center>
  <div class=" border-primary">
    <table id="customers">
      <tr>

        <th bgcolor="#000957" colspan="15">
          <text>
            Report Weekly
            <?php
            $tanggal = date('d M Y');
            echo $tanggal;
            ?>
          </text>
        </th>

      </tr>
      <tr>
        <th bgcolor="#6998AB" width="10">No</th>
        <th bgcolor="#6998AB" width="400">Name</th>
        <th bgcolor="#6998AB" width="90">Presensi</th>
        <th bgcolor="#6998AB" width="150">Jurnal Daily</th>
        <th bgcolor="#6998AB" width="200">Jurnal Weekly</th>
        <th bgcolor="#6998AB" width="200">Jurnal Monthly</th>
        <th bgcolor="#6998AB" width="150">Virtue</th>
        <th bgcolor="#6998AB" width="300">Living Lemari</th>
        <th bgcolor="#6998AB" width="360">Living Rak Sepatu dan Handuk</th>
        <th bgcolor="#6998AB" width="150">Living Ranjang</th>
        <th bgcolor="#6998AB" width="150">Total</th>
        <th bgcolor="#6998AB" width="100">Status</th>
        <th bgcolor="#6998AB" width="100">Keterangan</th>
        <th bgcolor="#6998AB" width="370">Date</th>
        <th bgcolor="#6998AB" width="800">Sanksi</th>
      </tr>
      <tr>
        <?php $i = 1;
        ?>
        <?php
        date_default_timezone_set('Asia/Jakarta'); // Set timezone
        //variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"
        while ($murid = mysqli_fetch_array($siswa)) {

          $tgl = $murid['tgl'];
          $nis = $murid['nis'];
          $nama = $murid['name'];
          $dari = $tgl; // tanggal mulai
          $sampai = date('Y-m-d'); // tanggal akhir


          // $s = 1;

          $dari = $_POST['tanggal_mulai'];
          $sampai = $_POST['tanggal_akhir'];

          while (strtotime($dari) <= strtotime($sampai)) {

            // echo $s . "-" . $i . "=";
            $alkitab = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point`) as jumlah FROM tb_bible_reading WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            // doa
            $doa = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point`) as jumlah FROM tb_prayer_note WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            // penyegaran pagi
            $pp = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`) as jumlah FROM tb_revival_note WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");


            // personal goal
            $goalsetting = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point3`) as jumlah FROM tb_personal_goal WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            // exhibition
            $exhibition = mysqli_query($conn, "SELECT SUM(`point`) as jumlah FROM tb_exhibition WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            // home metting
            $homemetting = mysqli_query($conn, "SELECT SUM(`point`) as jumlah FROM tb_home_meeting WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            // Blessings
            $Blessings = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point3`)+SUM(`point4`)+SUM(`point5`)+SUM(`point6`)+SUM(`point7`)+SUM(`point8`) as jumlah FROM tb_blessings WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            // virtue dan character
            $vc = mysqli_query($conn, "SELECT SUM(`perhatian_berbagi`)+SUM(`salam_sapa`)+SUM(`bersyukur_berterimakasih`)+SUM(`hormat_taat`) as jumlah FROM tb_vrtues_caharacter WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            // virtue
            $virtue = mysqli_query($conn, "SELECT SUM(`sikapramahsopan`)+SUM(`sikapberkordinasi`)+SUM(`sikaptolongmenolong`)+SUM(`sikapseedo`) as jumlah FROM tb_virtues WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            // character
            $character = mysqli_query($conn, "SELECT SUM(`benar`)+SUM(`tepat`)+SUM(`ketat`) as jumlah FROM tb_character WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            // living lemari 
            $buku = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_buku WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            $pakaianlipat = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_pakaianlipat WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            $pakaiangantung = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bentuk`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as jumlah FROM tb_living_pakaiangantung WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            $celana = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_celanalipat WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            $logistik = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as jumlah FROM tb_living_logistik WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");


            $pakaiandalam = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_pakaiandalam WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            // living rak sepatu dan handuk
            $raksepatu = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_sepatu WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            $sepatusidang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_sidang WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            $sepatu_or = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_or WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            $sandal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sendal WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            $rakhanduk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_handuk WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            $handuk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_handuk WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            // living ranjang
            $ranjang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_ranjang WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            $bantal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_bantal WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            $seprei = mysqli_query($conn, "SELECT SUM(`rapi`)+SUM(`raib`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_seprei WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

            $selimut = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_selimut WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");


            $presensia = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");


            $dari = date("Y-m-d", strtotime("+7 day", strtotime($dari))); //looping tambah 7 date

        ?>
            <?php foreach ($presensia as $row) :
              $hari = $dari;
              $presensi = mysqli_fetch_array($presensia);
              $prayernote = mysqli_fetch_array($doa);
              $biblereading = mysqli_fetch_array($alkitab);
              $revivalnote = mysqli_fetch_array($pp);
              $personalgoal = mysqli_fetch_array($goalsetting);
              $pameran = mysqli_fetch_array($exhibition);
              // living character dan virtues
              $persekutuan = mysqli_fetch_array($homemetting);
              $blessings = mysqli_fetch_array($Blessings);
              $sikap = mysqli_fetch_array($vc);
              $virtues = mysqli_fetch_array($virtue);
              $karakter = mysqli_fetch_array($character);
              // living lemari
              $living_buku = mysqli_fetch_array($buku);
              $living_pakaianlipat = mysqli_fetch_array($pakaianlipat);
              $living_pakaiangantung = mysqli_fetch_array($pakaiangantung);
              $living_celana = mysqli_fetch_array($celana);
              $living_logistik = mysqli_fetch_array($logistik);

              $living_pakaiandalam = mysqli_fetch_array($pakaiandalam);
              // living rak sepatu dan handuk
              $living_raksepatu = mysqli_fetch_array($raksepatu);
              $living_sepatusidang = mysqli_fetch_array($sepatusidang);
              $living_sepatuor = mysqli_fetch_array($sepatu_or);
              $living_sandal = mysqli_fetch_array($sandal);
              $living_rakhanduk = mysqli_fetch_array($rakhanduk);
              $living_handuk = mysqli_fetch_array($handuk);
              // living ranjang
              $living_ranjang = mysqli_fetch_array($ranjang);
              $living_bantal = mysqli_fetch_array($bantal);
              $living_seprei = mysqli_fetch_array($seprei);
              $living_selimut = mysqli_fetch_array($selimut);


              // $presensiWeekly = mysqli_fetch_array($presensi);


              $total_living_ranjang = $living_ranjang['jumlah'] + $living_bantal['jumlah'] + $living_seprei['jumlah'] + $living_selimut['jumlah'];
              $totalpresensi = $row['presensi'];
              $total_livingraksepatudanhanduk = $living_raksepatu['jumlah'] + $living_sepatusidang['jumlah'] + $living_sepatuor['jumlah'] + $living_sandal['jumlah'] + $living_rakhanduk['jumlah'] + $living_handuk['jumlah'];
              $total_livinglemari = $living_buku['jumlah'] + $living_pakaianlipat['jumlah'] + $living_pakaiangantung['jumlah']  + $living_celana['jumlah'] + $living_logistik['jumlah'] + $living_pakaiandalam['jumlah'];
              $totalpeniliansikap = $sikap['jumlah'] + $virtues['jumlah'] + $karakter['jumlah'];
              $total_2 = $blessings['jumlah'];
              $total_1 = $personalgoal['jumlah'] + $pameran['jumlah'] + $persekutuan['jumlah'];
              $total = $biblereading['jumlah'] + $prayernote['jumlah'] + $revivalnote['jumlah'];

              $totalsemua = $total + $total_1 + $total_2 + $totalpeniliansikap + $total_livinglemari + $total_livingraksepatudanhanduk + $totalpresensi + $total_living_ranjang
            ?>
      <tr>
        <td><?= $i; ?></td>
        <td>
          <?= $nama; ?>
        </td>
        <td><?= $row['presensi']; ?></td>
        <td><?= $total; ?></td>
        <td><?= $total_1; ?></td>
        <td><?= $total_2; ?></td>
        <td><?= $totalpeniliansikap; ?></td>
        <td><?= $total_livinglemari; ?></td>
        <td><?= $total_livingraksepatudanhanduk; ?></td>

        <td><?= $total_living_ranjang; ?></td>
        <td><?= $totalsemua; ?></td>
        <td>

          <?= $row['status']; ?>

        </td>
        <td>Week <?= $row['week']; ?></td>
        <td><?= $row['date']; ?></td>
        <td>
          <a class="font-weight-bold text-danger font-italic"><?= $row['grace']; ?> <?= $row['punisment']; ?> </a>
        </td>

      </tr>

      <?php $i++; ?>
<?php endforeach;
            // $s++;
          }
          // $u++;
        } ?>
</tr>
    </table>
  </div>
  <script>
    window.print()
  </script>


</body>

</html>