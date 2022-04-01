<?php
include '../database.php';
session_start();
include 'template/session.php';
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-j');
$waktu_sekarang = date('H:i:s');
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Report Presence.xls");
$nis = $_GET['nis'];
$mulai = $_GET['mulai'];
$selesai = $_GET['akhir'];

$sql_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis' AND status='Aktif'");
$data_siswa = mysqli_fetch_array($sql_siswa);
$sql_Presence = mysqli_query($conn, "SELECT * FROM absent WHERE nis='$nis' ");
$data_presensi = mysqli_fetch_array($sql_Presence);


// function data kegiatan
function kegiatan($name_kegiatan)
{
  global $conn;
  $sqly3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$name_kegiatan'"));
  return $sqly3['items'];
} // akhir function data kegiatan 


?>


<!DOCTYPE html>
<html>

<head>
  <title>Jurnal PKA</title>
</head>

<body>
  <style type="text/css">
    body {
      font-family: sans-serif;
    }

    table {
      border-collapse: collapse;
      width: 70%;

    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    th,
    td {
      padding: 10px;
    }

    th {
      background-color: rgb(19, 110, 170);
      color: white;
    }

    tr:hover {
      background-color: #f5f5f5;
    }

    a {
      background: blue;
      color: #fff;
      padding: 8px 10px;
      text-decoration: none;
      border-radius: 2px;
    }

    p {
      font-size: 16pt;
    }

    text {
      text-align: right;
      font-size: 15pt;
      font-weight: bold;
    }
  </style>

  <center>
    <img src="../img/logo/Edit Logo PKA-DP_v1.png" height="200" width="230">
    <p class=" text-dark text-center font-monospace">PELATIHAN PELAYANAN ROHANI “KEBENARAN ALKITAB” <br> Jalan Ngamarto 2, Lawang 65211; Telpon 0341 4301212, Fax 0341 426639 <br>Email address : pka.lawang@gmail.com <br> Keputusan Dirjen Bimas Kristen (Protestan)<br>Kementrian Agama nomor F/Kep/HK 00579/22377/99, Tgl 20-7-1999</p>
    <h3>Report Presence Jurnal PKA <br> <?= $data_siswa['name']; ?><br>[<?= $data_siswa['nis']; ?>]</h3>
  </center>
  <center>

    <table border="2">
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Schedule</th>
        <th>Schedule Time</th>
        <th>Presence Time</th>
        <th>Week</th>
        <th>Status</th>
        <th>Suggestion Mentor</th>
        <th>Date</th>
      </tr>
      <tr>
        <?php $i = 1;
        ?>
        <?php foreach ($sql_Presence as $row) : ?>
          <td><?= $i; ?></td>
          <td><?= $data_siswa['name']; ?></td>
          <td><?= kegiatan($row['schedule_id']); ?></td>
          <td>
            <?php
            // mengambil waktu kegiatanm di tabel kegiatan berdasarkan id kegiatan
            $id_kegiatan = $row["schedule_id"];
            $sqly4 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schedule WHERE id='$id_kegiatan'"));
            $waktu_kegiatan = $sqly4['start_time']
            ?>
            <?= $waktu_kegiatan; ?> WIB
          </td>
          <td><?= $row['absent_time'] ?> WIB</td>
          <td><?= $row['week'] ?></td>
          <td><?= $row['ACC_Mentor'] ?></td>
          <td><?= $row['catatan'] ?></td>
          <td><?= $row['absent_date'] ?></td>

      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
    <tfoot>
      <?php

      $tampil = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' ");
      $array_presensi = mysqli_fetch_array($tampil);
      $mark_V = $array_presensi['mark'] = 'V';
      $mark_O = $array_presensi['mark'] = 'O';
      $mark_X = $array_presensi['mark'] = 'X';
      $mark_I = $array_presensi['mark'] = 'I';
      $mark_S = $array_presensi['mark'] = 'S';

      $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and ACC_Mentor='approve' and mark='$mark_V' ");
      $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

      $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and ACC_Mentor='approve' and mark='$mark_O' ");
      $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

      $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and ACC_Mentor='approve' and mark='$mark_X'");
      $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

      $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and ACC_Mentor='approve' and mark='$mark_I'");
      $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

      $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and ACC_Mentor='approve' and mark='$mark_S'");
      $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

      $total = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];

      ?>
      <tr>
        <td colspan="9" align="right"><text>Total Point Presence : <?= $total; ?></text></td>
      </tr>
    </tfoot>

    </table>

  </center>
</body>

</html>