<?php
include '../database.php';
// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
$week = $_GET['week'];
$report = mysqli_query($conn, "SELECT * FROM tb_reportweekly WHERE keterangan='$week' ORDER BY date DESC");
$weekl = mysqli_fetch_array($report);

if ($week == "%") {
  $report = mysqli_query($conn, "SELECT * FROM tb_reportweekly ORDER BY date DESC");
  $weekl = mysqli_fetch_array($report);
}
?>
<!DOCTYPE html>
<html>

<head>

  <style>
    h1 {
      font-weight: bold;
      font-size: 20pt;
      text-align: center;
      color: #191A19;
    }

    a {
      font-weight: bold;
      font-size: 17pt;
      text-align: right;
      color: red;

    }


    p {
      font-size: 18pt;
      padding: auto;
      margin: 30px;

    }

    #img {
      width: 128px;
      height: 128px;
      padding: auto;
      margin: 30px;
    }

    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 97%;
      padding: auto;
      margin: 20px;
    }

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
      background-color: #E5890A;
      color: white;
    }
  </style>
</head>

<body>

  <img align="right" id="img" src="../img/logo/Edit Logo PKA-DP.png">
  <h1>Report Weekly</h1>
  <p>Name : <?= $data['name']; ?></p>
  <p>Efata : <?= $data['efata']; ?></p>


  <div class=" border-primary">
    <table id="customers">
      <tr>
        <th width="10">No</th>
        <th width="250">Nama Siswa</th>
        <th width="90">Presensi</th>
        <th width="150">Jurnal Daily</th>
        <th width="200">Jurnal Weekly</th>
        <th width="200">Jurnal Monthly</th>
        <th width="150">Virtue</th>
        <th width="300">Living Lemari</th>
        <th width="360">Living Rak Sepatu dan Handuk</th>
        <th width="150">Living Ranjang</th>
        <th width="150">Total</th>
        <th width="100">Status</th>
        <th width="100">Keterangan</th>
        <th width="370">Date</th>
        <th width="470">Sanksi</th>
      </tr>
      <?php $i = 1; ?>
      <?php foreach ($report as $row) : ?>
        <tr>
          <td><?= $i; ?></td>
          <td><?= $row['name']; ?></td>
          <td><?= $row['presensi']; ?></td>
          <td><?= $row['jurnal_daily']; ?></td>
          <td><?= $row['jurnal_weekly']; ?></td>
          <td><?= $row['jurnal_monthly']; ?></td>
          <td><?= $row['virtue']; ?></td>
          <td><?= $row['living_buku']; ?></td>
          <td><?= $row['living_sepatu_handuk']; ?></td>
          <td><?= $row['living_ranjang']; ?></td>
          <td><?= $row['total']; ?></td>
          <td><?= $row['status']; ?></td>
          <td><?= $row['keterangan']; ?></td>
          <td><?= $row['date']; ?></td>
          <td> <a class="font-weight-bold text-danger font-italic"><?= $row['sanksi']; ?> <?= $row['punisment']; ?></a>
          </td>
        </tr>
        <?php $i++; ?>
      <?php endforeach; ?>
    </table>

  </div>
  <script>
    window.print()
  </script>


</body>

</html>