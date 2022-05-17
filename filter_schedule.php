<?php
include 'database.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
error_reporting(E_ALL ^ E_NOTICE);
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H-i-s');
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
  <title>Jadwal Mingguan</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
  <style>
    .card_1 {
      width: 98%;
      margin-left: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
    }



    .card_2 {
      width: 98%;
      margin-left: 10px;
      margin-top: 10px;
      margin-bottom: 20px;

    }

    .select_ {
      float: right;
      margin-right: 20px;

    }

    th {
      position: sticky;
      top: 10px;
      background-color: #007BFF;
      color: #fff;
      padding: 12px 20px;
      text-align: center;
      text-transform: capitalize;
      font-family: 'PT Sans', sans-serif;


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

    strong {
      color: red;
    }

    /* tr:nth-child(even) {
      background-color: #dddddd;
    } */
  </style>
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
  <?php

  // $cek = mysqli_num_rows($jadwal);
  function kegiatan_1($kegiatan)
  {
    global $conn;
    $sqly3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$kegiatan'"));
    return $sqly3['items'];
  } // akhir function data kegiatan

  if (isset($_POST['angkatan'])) {
    $angkatan = $_POST['angkatan'];
    $week = $_POST['week'];
    $tamplkan_data = mysqli_query($conn, "SELECT * FROM schedule where batch='$angkatan' || week='$week' ORDER BY date DESC");
    $list = mysqli_fetch_array($tamplkan_data);
  }

  ?>

  <div class="card_2 shadow  ">
    <div class="card-header  bg-dark text-light">
      <judul>Jadwal Mingguan</judul>
    </div>
    <div class="card-body">

      <form action="" method="POST" id="form_id">

        <div class="form-inline">
          <select class="form-control" name="angkatan" id="angkatan" aria-label="Default select example" onChange="document.getElementById('form_id').submit();">
            <option selected>Pilih Angkatan</option>
            <?php
            $sql_angkatan = mysqli_query($conn, "SELECT * FROM tb_angkatan ") or die(mysqli_error($conn));
            while ($data_angkatan = mysqli_fetch_array($sql_angkatan)) {
              echo '<option value="' . $data_angkatan['angkatan'] . '">' . $data_angkatan['angkatan'] . '</option>';
            }

            ?>
          </select>

          <select class="form-control m-2" name="week" id="angkatan" aria-label="Default select example" onChange="document.getElementById('form_id').submit();">
            <option selected>Pilih Minggu</option>
            <?php
            $sql_week = mysqli_query($conn, "SELECT * FROM schedule where batch='$angkatan' GROUP By week") or die(mysqli_error($conn));
            while ($data_week = mysqli_fetch_array($sql_week)) {
              echo '<option value="' . $data_week['week'] . '">' . $data_week['week'] . '</option>';
            }
            ?>
          </select>

          <button type="submit" name="reset" value="reset" class="btn btn-danger ">Reset</button>
        </div>
      </form>

      <div style="height: 500px;overflow: scroll;  ">
        <table class="table mt-3 table-striped">
          <thead class="mt-2">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Angkatan</th>
              <th scope="col">Jadwal</th>
              <th scope="col">Waktu Mulai</th>
              <th scope="col">Waktu Berakhir</th>
              <th scope="col">Minggu</th>
              <th scope="col">Tanggal</th>
            </tr>
          </thead>
          <tbody class="mt-2">
            <?php $i = 1; ?>
            <?php foreach ($tamplkan_data as $row2) : ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $row2["batch"]; ?></td>
                <td><?= Kegiatan_1($row2["id_activity"]); ?></td>
                <td><?= $row2["start_time"]; ?></td>
                <td><?= $row2["end_time"]; ?></td>
                <td><?= $row2["week"]; ?></td>
                <td><?= $row2["date"]; ?></td>
              </tr>
              <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
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