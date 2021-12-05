<?php
include '../database.php';
if (isset($_POST['week'])) {
    $week = $_POST['week'];

    if ($week != null) {

        $presensia = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE keterangan LIKE '$week' ORDER BY date DESC");
    } else {

        $presensia = mysqli_query($conn, "SELECT * FROM tb_presensi ORDER BY date DESC");
        $presensi = mysqli_fetch_array($presensia);
    }
} else {

    $presensia = mysqli_query($conn, "SELECT * FROM tb_presensi ORDER BY date DESC");
    $presensi = mysqli_fetch_array($presensia);
}
session_start();
include 'template/session.php';
//menampilkan data siswa dan jurnal
$siswaa = mysqli_query($conn, "SELECT * FROM siswa a JOIN tb_angkatan b ON a.angkatan= b.angkatan WHERE status='Aktif' ORDER BY a.date DESC;");
$murida = mysqli_fetch_array($siswaa);
$tgl = $murida['tgl'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Report Weekly</title>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        include 'template/sidebar_menu.php';
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php
                include 'template/topbar_menu.php';
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-mb-4 text-gray-800">Jurnal Report</h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <h6 class=" font-weight-bold text-primary">Please Select Week</h6>
                            <form action="" method="POST" id="form_id" class="form-inline">
                                <?php
                                if (isset($_POST['week'])) {
                                    $week = $_POST['week'];

                                ?>
                                    <select type="text" class="form-control col-md-2" id="week" name="week" onChange="document.getElementById('form_id').submit();">
                                        <option value="%">Select All Weeks</option>
                                        <option value="Week 1" <?php if ($week == "Week 1") { ?> Selected <?php } ?>> Week 1 </option>
                                        <option value="Week 2" <?php if ($week == "Week 2") { ?> Selected <?php } ?>>Week 2</option>
                                        <option value="Week 3" <?php if ($week == "Week 3") { ?> Selected <?php } ?>>Week 3 </option>
                                        <option value="week 4" <?php if ($week == "Week 4") { ?> Selected <?php } ?>>Week 4 </option>
                                        <option value="Week 5" <?php if ($week == "Week 5") { ?> Selected <?php } ?>>Week 5 </option>
                                        <option value="Week 6" <?php if ($week == "Week 6") { ?> Selected <?php } ?>>Week 6</option>
                                        <option value="Week 7" <?php if ($week == "Week 7") { ?> Selected <?php } ?>>Week 7</option>
                                        <option value="Week 8" <?php if ($week == "Week 8") { ?> Selected <?php } ?>>Week 8</option>
                                        <option value="Week 9" <?php if ($week == "Week 9") { ?> Selected <?php } ?>>Week 9</option>
                                        <option value="Week 10" <?php if ($week == "Week 10") { ?> Selected <?php } ?>>Week 10</option>
                                        <option value="Week 11" <?php if ($week == "Week 11") { ?> Selected <?php } ?>>Week 11</option>
                                        <option value="Week 12" <?php if ($week == "Week 12") { ?> Selected <?php } ?>>Week 12</option>
                                        <option value="Week 13" <?php if ($week == "Week 13") { ?> Selected <?php } ?>>Week 13</option>
                                        <option value="Week 14" <?php if ($week == "Week 14") { ?> Selected <?php } ?>>Week 14</option>
                                        <option value="Week 15" <?php if ($week == "Week 15") { ?> Selected <?php } ?>>Week 15</option>
                                        <option value="Week 16" <?php if ($week == "Week 16") { ?> Selected <?php } ?>>Week 16</option>
                                        <option value="Week 17" <?php if ($week == "Week 17") { ?> Selected <?php } ?>>Week 17</option>
                                        <option value="Week 18" <?php if ($week == "Week 18") { ?> Selected <?php } ?>>Week 18</option>
                                        <option value="Week 19" <?php if ($week == "Week 19") { ?> Selected <?php } ?>>Week 19</option>
                                        <option value="Week 20" <?php if ($week == "Week 20") { ?> Selected <?php } ?>>Week 20</option>
                                        <option value="Week 21" <?php if ($week == "Week 21") { ?> Selected <?php } ?>>Week 21</option>
                                        <option value="Week 22" <?php if ($week == "Week 22") { ?> Selected <?php } ?>>Week 22</option>
                                        <option value="Week 23" <?php if ($week == "Week 23") { ?> Selected <?php } ?>>Week 23</option>
                                        <option value="Week 24" <?php if ($week == "Week 24") { ?> Selected <?php } ?>>Week 24</option>
                                        <option value="Week 25" <?php if ($week == "Week 25") { ?> Selected <?php } ?>>Week 25</option>
                                        <option value="Week 26" <?php if ($week == "Week 26") { ?> Selected <?php } ?>>Week 26</option>
                                        <option value="Week 27" <?php if ($week == "Week 27") { ?> Selected <?php } ?>>Week 27</option>
                                        <option value="Week 28" <?php if ($week == "Week 28") { ?> Selected <?php } ?>>Week 28</option>
                                        <option value="Week 29" <?php if ($week == "Week 29") { ?> Selected <?php } ?>>Week 29</option>
                                        <option value="Week 30" <?php if ($week == "Week 30") { ?> Selected <?php } ?>>Week 30</option>
                                        <option value="Week 31" <?php if ($week == "Week 31") { ?> Selected <?php } ?>>Week 31</option>
                                        <option value="Week 32" <?php if ($week == "Week 32") { ?> Selected <?php } ?>>Week 32</option>
                                        <option value="Week 33" <?php if ($week == "Week 33") { ?> Selected <?php } ?>>Week 33</option>
                                        <option value="Week 34" <?php if ($week == "Week 34") { ?> Selected <?php } ?>>Week 34</option>
                                        <option value="Week 35" <?php if ($week == "Week 35") { ?> Selected <?php } ?>>Week 35</option>
                                        <option value="Week 36" <?php if ($week == "Week 36") { ?> Selected <?php } ?>>Week 36</option>
                                        <option value="Week 37" <?php if ($week == "Week 37") { ?> Selected <?php } ?>>Week 37</option>
                                        <option value="Week 38" <?php if ($week == "Week 38") { ?> Selected <?php } ?>>Week 38</option>
                                        <option value="Week 39" <?php if ($week == "Week 39") { ?> Selected <?php } ?>>Week 39</option>
                                        <option value="Week 40" <?php if ($week == "Week 40") { ?> Selected <?php } ?>>Week 40</option>
                                        <option value="Week 41" <?php if ($week == "Week 41") { ?> Selected <?php } ?>>Week 41</option>
                                        <option value="Week 42" <?php if ($week == "Week 42") { ?> Selected <?php } ?>>Week 42</option>
                                        <option value="Week 43" <?php if ($week == "Week 43") { ?> Selected <?php } ?>>Week 43</option>
                                        <option value="Week 44" <?php if ($week == "Week 44") { ?> Selected <?php } ?>>Week 44</option>
                                        <option value="Week 45" <?php if ($week == "Week 45") { ?> Selected <?php } ?>>Week 45</option>
                                        <option value="Week 46" <?php if ($week == "Week 46") { ?> Selected <?php } ?>>Week 46</option>
                                        <option value="Week 47" <?php if ($week == "Week 47") { ?> Selected <?php } ?>>Week 47</option>
                                        <option value="Week 48" <?php if ($week == "Week 48") { ?> Selected <?php } ?>>Week 48</option>
                                    </select>
                                <?php
                                } else {
                                ?>
                                    <select type="text" class="form-control col-md-2" id="week" name="week" onChange="document.getElementById('form_id').submit();">
                                        <option value="%">Select All Weeks</option>
                                        <option value="Week 1">Week 1</option>
                                        <option value="Week 2">Week 2</option>
                                        <option value="Week 3">Week 3</option>
                                        <option value="week 4">Week 4</option>
                                        <option value="Week 5">Week 5</option>
                                        <option value="Week 6">Week 6</option>
                                        <option value="Week 7">Week 7</option>
                                        <option value="Week 8">Week 8</option>
                                        <option value="Week 9">Week 9</option>
                                        <option value="Week 10">Week 10</option>
                                        <option value="Week 11">Week 11</option>
                                        <option value="Week 12">Week 12</option>
                                        <option value="Week 13">Week 13</option>
                                        <option value="Week 14">Week 14</option>
                                        <option value="Week 15">Week 15</option>
                                        <option value="Week 16">Week 16</option>
                                        <option value="Week 17">Week 17</option>
                                        <option value="Week 18">Week 18</option>
                                        <option value="Week 19">Week 19</option>
                                        <option value="Week 20">Week 20</option>
                                        <option value="Week 21">Week 21</option>
                                        <option value="Week 22">Week 22</option>
                                        <option value="Week 23">Week 23</option>
                                        <option value="Week 24">Week 24</option>
                                        <option value="Week 25">Week 25</option>
                                        <option value="Week 26">Week 26</option>
                                        <option value="Week 27">Week 27</option>
                                        <option value="Week 28">Week 28</option>
                                        <option value="Week 29">Week 29</option>
                                        <option value="Week 30">Week 30</option>
                                        <option value="Week 31">Week 31</option>
                                        <option value="Week 32">Week 32</option>
                                        <option value="Week 33">Week 33</option>
                                        <option value="Week 34">Week 34</option>
                                        <option value="Week 35">Week 35</option>
                                        <option value="Week 36">Week 36</option>
                                        <option value="Week 37">Week 37</option>
                                        <option value="Week 38">Week 38</option>
                                        <option value="Week 39">Week 39</option>
                                        <option value="Week 40">Week 40</option>
                                        <option value="Week 41">Week 41</option>
                                        <option value="Week 42">Week 42</option>
                                        <option value="Week 43">Week 43</option>
                                        <option value="Week 44">Week 44</option>
                                        <option value="Week 45">Week 45</option>
                                        <option value="Week 46">Week 46</option>
                                        <option value="Week 47">Week 47</option>
                                        <option value="Week 48">Week 48</option>
                                    </select>
                                <?php } ?>

                                <!-- <button type="submit" name="reset" value="Reset" class="btn btn-danger ml-3">Reset</button> -->
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th width="450">Name</th>
                                            <th>Presensi</th>
                                            <th>Jurnal Daily</th>
                                            <th>Jurnal Weekly</th>
                                            <th>Jurnal Monthly</th>
                                            <th>Virtue</th>
                                            <th>Living Lemari</th>
                                            <th>Living Rak Sepatu dan Handuk</th>
                                            <th>Living Ranjang</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th width="200">Date</th>
                                            <th width="400">Sanksi</th>


                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1;
                                        ?>
                                        <?php
                                        date_default_timezone_set('Asia/Jakarta'); // Set timezone
                                        //variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"
                                        while ($murid2 = mysqli_fetch_array($siswaa)) {
                                            $nis = $murid2['nis'];
                                            $siswa = mysqli_query($conn, "SELECT * FROM siswa  WHERE nis='$nis' ORDER BY date DESC");
                                            $murid = mysqli_fetch_array($siswa);

                                            $dari = $tgl; // tanggal mulai
                                            $sampai = date('Y-m-d'); // tanggal akhir
                                            $s = 1;
                                            // }
                                            while (strtotime($dari) <= strtotime($sampai)) {
                                                // while ($murid = mysqli_fetch_array($siswa)) {
                                                //     $nis = $murid['nis'];

                                                // echo "$dari<br/>";
                                                // pembacaan alkitab
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


                                                $presensia = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE nis='$nis'  AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");


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
                                                            <?= $murid['name']; ?>
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
                                                        <td>Week <?= $s; ?></td>
                                                        <td><?= $row['date']; ?></td>
                                                        <td>
                                                            <?= $row['grace']; ?>
                                                            <?= $row['punisment']; ?>
                                                        </td>

                                                    </tr>

                                                    <?php $i++; ?>
                                        <?php endforeach;
                                                $s++;
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php
            include 'template/footer_menu.php';
            ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>





    <!-- Logout Modal-->
    <?php
    include 'modal/modal_logout.php';
    include 'template/script.php';
    include 'template/alert.php';
    ?>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                scrollY: 800,
                scrollX: true,
                scrollCollapse: true,
                paging: true

            });
        });
    </script>
</body>

</html>