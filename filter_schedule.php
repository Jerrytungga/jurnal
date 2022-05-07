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
  <title>Kalender</title>
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

  if (isset($_POST['filter_tanggal'])) {
    $mulai = $_POST['tanggal_mulai'];
    $selesai = $_POST['tanggal_akhir'];

    if (
      $mulai != null || $selesai != null
    ) {

      $tamplkan_data = mysqli_query($conn, "SELECT * FROM schedule WHERE  date BETWEEN '$mulai' AND '$selesai' ORDER BY date DESC;");
      $list = mysqli_fetch_array($tamplkan_data);
    } else {

      $tamplkan_data = mysqli_query($conn, "SELECT * FROM schedule  ORDER BY date DESC;");
      $list = mysqli_fetch_array($tamplkan_data);
    }
  } else {
    $tamplkan_data = mysqli_query($conn, "SELECT * FROM schedule where date='$hari_ini ' ORDER BY date DESC;");
    $list = mysqli_fetch_array($tamplkan_data);
  }



  if (isset($_POST['week'])) {
    $week = $_POST['week'];

    if ($week != null) {

      $tamplkan_data = mysqli_query($conn, "SELECT * FROM schedule where week LIKE '$week'  ORDER BY date DESC");
    } else {

      $tamplkan_data = mysqli_query($conn, "SELECT * FROM schedule  ORDER BY date DESC;");
      $list = mysqli_fetch_array($tamplkan_data);
    }
  }

  $cek = mysqli_num_rows($tamplkan_data);

  ?>




  <div class="card_2 shadow  ">
    <div class="card-header  bg-dark text-light">
      <judul>Weekly Schedule</judul>
    </div>
    <div class="card-body">

      <div class="col">
        <div class="select_ form-inline">
          <form action="" method="POST" id="form_id">
            <b class="font-weight-normal">Week :</b>&nbsp;&nbsp;
            <?php
            if (isset($_POST['week'])) {
              $week = $_POST['week']; ?>
              <select id="" class="form-control col-10" name="week" onChange="document.getElementById('form_id').submit();">
                <option value="%">Select All Weeks</option>
                <option value="1" <?php if ($week == "1") { ?> selected <?php } ?>>01</option>
                <option value="2" <?php if ($week == "2") { ?> selected <?php } ?>>02</option>
                <option value="3" <?php if ($week == "3") { ?> selected <?php } ?>>03</option>
                <option value="4" <?php if ($week == "4") { ?> selected <?php } ?>>04</option>
                <option value="5" <?php if ($week == "5") { ?> selected <?php } ?>>05</option>
                <option value="6" <?php if ($week == "6") { ?> selected <?php } ?>>06</option>
                <option value="7" <?php if ($week == "7") { ?> selected <?php } ?>>07</option>
                <option value="8" <?php if ($week == "8") { ?> selected <?php } ?>>08</option>
                <option value="9" <?php if ($week == "9") { ?> selected <?php } ?>>09</option>
                <option value="10" <?php if ($week == "10") { ?> selected <?php } ?>>10</option>
                <option value="11" <?php if ($week == "11") { ?> selected <?php } ?>>11</option>
                <option value="12" <?php if ($week == "12") { ?> selected <?php } ?>>12</option>
                <option value="13" <?php if ($week == "13") { ?> selected <?php } ?>>13</option>
                <option value="14" <?php if ($week == "14") { ?> selected <?php } ?>>14</option>
                <option value="15" <?php if ($week == "15") { ?> selected <?php } ?>>15</option>
                <option value="16" <?php if ($week == "16") { ?> selected <?php } ?>>16</option>
                <option value="17" <?php if ($week == "17") { ?> selected <?php } ?>>17</option>
                <option value="18" <?php if ($week == "18") { ?> selected <?php } ?>>18</option>
                <option value="19" <?php if ($week == "19") { ?> selected <?php } ?>>19</option>
                <option value="20" <?php if ($week == "20") { ?> selected <?php } ?>>20</option>
                <option value="21" <?php if ($week == "21") { ?> selected <?php } ?>>21</option>
                <option value="22" <?php if ($week == "22") { ?> selected <?php } ?>>22</option>
                <option value="23" <?php if ($week == "23") { ?> selected <?php } ?>>23</option>
                <option value="24" <?php if ($week == "24") { ?> selected <?php } ?>>24</option>
                <option value="25" <?php if ($week == "25") { ?> selected <?php } ?>>25</option>
                <option value="26" <?php if ($week == "26") { ?> selected <?php } ?>>26</option>
                <option value="27" <?php if ($week == "27") { ?> selected <?php } ?>>27</option>
                <option value="28" <?php if ($week == "28") { ?> selected <?php } ?>>28</option>
                <option value="29" <?php if ($week == "29") { ?> selected <?php } ?>>29</option>
                <option value="30" <?php if ($week == "30") { ?> selected <?php } ?>>30</option>
                <option value="31" <?php if ($week == "31") { ?> selected <?php } ?>>31</option>
                <option value="32" <?php if ($week == "32") { ?> selected <?php } ?>>32</option>
                <option value="33" <?php if ($week == "33") { ?> selected <?php } ?>>33</option>
                <option value="34" <?php if ($week == "34") { ?> selected <?php } ?>>34</option>
                <option value="35" <?php if ($week == "35") { ?> selected <?php } ?>>35</option>
                <option value="36" <?php if ($week == "36") { ?> selected <?php } ?>>36</option>
                <option value="37" <?php if ($week == "37") { ?> selected <?php } ?>>37</option>
                <option value="38" <?php if ($week == "38") { ?> selected <?php } ?>>38</option>
                <option value="39" <?php if ($week == "39") { ?> selected <?php } ?>>39</option>
                <option value="40" <?php if ($week == "40") { ?> selected <?php } ?>>40</option>
                <option value="41" <?php if ($week == "41") { ?> selected <?php } ?>>41</option>
                <option value="42" <?php if ($week == "42") { ?> selected <?php } ?>>42</option>
                <option value="43" <?php if ($week == "43") { ?> selected <?php } ?>>43</option>
                <option value="44" <?php if ($week == "44") { ?> selected <?php } ?>>44</option>
                <option value="45" <?php if ($week == "45") { ?> selected <?php } ?>>45</option>
                <option value="46" <?php if ($week == "46") { ?> selected <?php } ?>>46</option>
                <option value="47" <?php if ($week == "47") { ?> selected <?php } ?>>47</option>
                <option value="48" <?php if ($week == "48") { ?> selected <?php } ?>>48</option>
                <option value="49" <?php if ($week == "49") { ?> selected <?php } ?>>49</option>
                <option value="50" <?php if ($week == "50") { ?> selected <?php } ?>>50</option>
                <option value="51" <?php if ($week == "51") { ?> selected <?php } ?>>51</option>
                <option value="52" <?php if ($week == "52") { ?> selected <?php } ?>>52</option>

              </select>
            <?php
            } else {
            ?>
              <select id="" class="form-control col-10" name="week" onChange="document.getElementById('form_id').submit();">
                <option value="%">Select All Weeks</option>
                <option value="1">01</option>
                <option value="2">02</option>
                <option value="3">03</option>
                <option value="4">04</option>
                <option value="5">05</option>
                <option value="6">06</option>
                <option value="7">07</option>
                <option value="8">08</option>
                <option value="9">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
                <option value="32">32</option>
                <option value="33">33</option>
                <option value="34">34</option>
                <option value="35">35</option>
                <option value="36">36</option>
                <option value="37">37</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
                <option value="43">43</option>
                <option value="44">44</option>
                <option value="45">45</option>
                <option value="46">46</option>
                <option value="47">47</option>
                <option value="48">48</option>
                <option value="49">49</option>
                <option value="50">50</option>
                <option value="51">51</option>
                <option value="52">52</option>
              </select>
            <?php } ?>
          </form>
        </div>

        <form action="" method="POST" class="form-inline">


          <?php
          if (isset($_POST['filter_tanggal'])) {
            $mulai = $_POST['tanggal_mulai'];
            $selesai = $_POST['tanggal_akhir'];
          ?>
            <input type="date" name="tanggal_mulai" value="<?= $mulai ?>" class="form-control">
            <input type="date" name="tanggal_akhir" value="<?= $selesai ?>" class="form-control ml-3">
          <?php
          } else {
          ?>
            <input type="date" name="tanggal_mulai" class="form-control">
            <input type="date" name="tanggal_akhir" class="form-control ml-3">
          <?php } ?>
          <button type="submit" name="filter_tanggal" class="btn btn-info ml-3">Search</button>
          <button type="submit" name="reset" value="reset" class="btn btn-danger ml-3">Reset</button>
        </form>
      </div>
      <div style="height: 500px;overflow: scroll;  ">
        <table class="table mt-3 table-striped">
          <?php
          if ($cek == 0) { ?>
            <script>
              Swal.fire(
                '<strong>Announcement!</strong>',
                'Weekly Schedule Not Available',
                'question'
              )
            </script>
            <audio src="music/error.wav" autoplay="autoplay" hidden="hidden"></audio>

          <?php       } else { ?>
            <thead class="mt-2">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Schedule</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th scope="col">Week</th>
                <th scope="col">Date</th>

              </tr>
            </thead>
            <tbody class="mt-2">
              <?php $i = 1; ?>
              <?php foreach ($tamplkan_data as $row2) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= Kegiatan_1($row2["id_activity"]); ?></td>
                  <td><?= $row2["start_time"]; ?></td>
                  <td><?= $row2["end_time"]; ?></td>
                  <td><?= $row2["week"]; ?></td>
                  <td><?= $row2["date"]; ?></td>

                </tr>
                <?php $i++; ?>
            <?php endforeach;
            }
            ?>
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