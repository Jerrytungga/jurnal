<?php
include '../database.php';

// input dat6a report weekly
if (isset($_POST['input'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $name = htmlspecialchars($_POST['name']);
    $presensi = htmlspecialchars($_POST['presensi']);
    $jurnaldaily = htmlspecialchars($_POST['jurnaldaily']);
    $jurnalweekly = htmlspecialchars($_POST['jurnalweekly']);
    $jurnalMonthly = htmlspecialchars($_POST['jurnalMonthly']);
    $virtue = htmlspecialchars($_POST['virtue']);
    $lemari = htmlspecialchars($_POST['lemari']);
    $sepatu = htmlspecialchars($_POST['sepatu']);
    $ranjang = htmlspecialchars($_POST['ranjang']);
    $total = htmlspecialchars($_POST['total']);
    $status = htmlspecialchars($_POST['status']);
    $Keterangan = htmlspecialchars($_POST['Keterangan']);
    $grace = htmlspecialchars($_POST['grace']);
    $punisment = htmlspecialchars($_POST['punisment']);
    $input = mysqli_query($conn, "INSERT INTO `tb_reportweekly`(`nis`, `name`, `presensi`, `jurnal_daily`, `jurnal_weekly`, `jurnal_monthly`, `virtue`, `living_buku`, `living_sepatu_handuk`, `living_ranjang`, `total`, `status`, `keterangan`, `efata`, `sanksi`,`punisment`) VALUES ('$nis','$name','$presensi','$jurnaldaily','$jurnalweekly','$jurnalMonthly','$virtue','$lemari','$sepatu','$ranjang','$total','$status','$Keterangan','$efata','$grace','$punisment')");
    if ($input) {
        $notifinput = $_SESSION['sukses'] = 'Data entered successfully!';
    } else {
        $notifgagalinput = $_SESSION['gagal'] = 'Data not entered successfully!';
    }
}
// input dat6a report weekly
if (isset($_POST['edit'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $name = htmlspecialchars($_POST['name']);
    $absensi = htmlspecialchars($_POST['absen']);
    $jurnaldaily = htmlspecialchars($_POST['jurnaldaily']);
    $jurnalweekly = htmlspecialchars($_POST['jurnalweekly']);
    $jurnalMonthly = htmlspecialchars($_POST['jurnalbulanan']);
    $virtue = htmlspecialchars($_POST['virtue']);
    $lemari = htmlspecialchars($_POST['livingbuku']);
    $sepatu = htmlspecialchars($_POST['livingsepatu']);
    $ranjang = htmlspecialchars($_POST['livingranjang']);
    $total = htmlspecialchars($_POST['total']);
    $status = htmlspecialchars($_POST['status']);
    $Keterangan = htmlspecialchars($_POST['keterangan']);
    $grace = htmlspecialchars($_POST['sanksi']);
    $Punishment = htmlspecialchars($_POST['Punishment']);
    $date = htmlspecialchars($_POST['date']);
    $edit =  mysqli_query($conn, "UPDATE `tb_reportweekly` SET `nis`='$nis',`name`='$name',`presensi`='$absensi',`jurnal_daily`='$jurnaldaily',`jurnal_weekly`='$jurnalweekly',`jurnal_monthly`='$jurnalMonthly',`virtue`='$virtue',`living_buku`='$lemari',`living_sepatu_handuk`='$sepatu',`living_ranjang`='$ranjang',`total`='$total',`status`='$status',`keterangan`='$Keterangan',`date`='$date',`efata`='$efata',`sanksi`='$grace',`punisment`='$Punishment' WHERE `tb_reportweekly`.`efata`='$efata' AND `tb_reportweekly`.`date`='$date' AND `tb_reportweekly`.`nis`='$nis' ");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Saved!';
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil Di Edit!';
    }
}
$nis = $_GET['nis'];


session_start();
include 'template/session.php';
//menampilkan data siswa dan jurnal
$siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC");
$data = mysqli_fetch_array($siswa);
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
                        <h1 class="h3 mb-mb-4 text-gray-800">Jurnal Report <?= $data['name']; ?></h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-info  float-left" data-toggle="modal" data-target="#report">Isi Report</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th width="200">Name</th>
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
                                            <th width="200">Option</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php
                                        date_default_timezone_set('Asia/Jakarta'); // Set timezone
                                        //variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"
                                        $dari = "2021-11-14"; // tanggal mulai
                                        $sampai = date('Y-m-d'); // tanggal akhir

                                        while (strtotime($dari) <= strtotime($sampai)) {
                                            // echo "$dari<br/>";

                                            // pembacaan alkitab
                                            $alkitab = mysqli_query($conn, "SELECT SUM(point1)+SUM(point2)+SUM(point) as jumlah FROM tb_bible_reading WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+7 day", strtotime($dari))) . "' ORDER BY date DESC");

                                            // doa
                                            $doa = mysqli_query($conn, "SELECT SUM(point1)+SUM(point) as jumlah FROM tb_prayer_note WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+7 day", strtotime($dari))) . "' ORDER BY date DESC");

                                            // penyegaran pagi
                                            $pp = mysqli_query($conn, "SELECT SUM(point1)+SUM(point2) as jumlah FROM tb_revival_note WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+7 day", strtotime($dari))) . "' ORDER BY date DESC");


                                            // personal goal
                                            $goalsetting = mysqli_query($conn, "SELECT SUM(point1)+SUM(point2)+SUM(point3) as jumlah FROM tb_personal_goal WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+7 day", strtotime($dari))) . "' ORDER BY date DESC");

                                            // exhibition
                                            $exhibition = mysqli_query($conn, "SELECT SUM(point) as jumlah FROM tb_exhibition WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+7 day", strtotime($dari))) . "' ORDER BY date DESC");

                                            // home metting
                                            $homemetting = mysqli_query($conn, "SELECT SUM(point) as jumlah FROM tb_home_meeting WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+7 day", strtotime($dari))) . "' ORDER BY date DESC");

                                            // Blessings
                                            $Blessings = mysqli_query($conn, "SELECT SUM(point1)+SUM(point2)+SUM(point3)+SUM(point4)+SUM(point5)+SUM(point6)+SUM(point7)+SUM(point8) as jumlah FROM tb_blessings WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+7 day", strtotime($dari))) . "' ORDER BY date DESC");

                                            // virtue dan character
                                            $vc = mysqli_query($conn, "SELECT SUM(perhatian_berbagi)+SUM(salam_sapa)+SUM(bersyukur_berterimakasih)+SUM(hormat_taat) as jumlah FROM tb_vrtues_caharacter WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+7 day", strtotime($dari))) . "' ORDER BY date DESC");

                                            // virtue
                                            $virtue = mysqli_query($conn, "SELECT SUM(sikapramahsopan)+SUM(sikapberkordinasi)+SUM(sikaptolongmenolong)+SUM(sikapseedo) as jumlah FROM tb_virtues WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+7 day", strtotime($dari))) . "' ORDER BY date DESC");

                                            // character
                                            $character = mysqli_query($conn, "SELECT SUM(benar)+SUM(tepat)+SUM(ketat) as jumlah FROM tb_character WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+7 day", strtotime($dari))) . "' ORDER BY date DESC");



                                            $dari = date("Y-m-d", strtotime("+7 day", strtotime($dari))); //looping tambah 7 date

                                        ?>
                                            <?php foreach ($siswa as $row) :
                                                $hari = $dari;
                                                $prayernote = mysqli_fetch_array($doa);
                                                $biblereading = mysqli_fetch_array($alkitab);
                                                $revivalnote = mysqli_fetch_array($pp);
                                                $personalgoal = mysqli_fetch_array($goalsetting);
                                                $pameran = mysqli_fetch_array($exhibition);
                                                $persekutuan = mysqli_fetch_array($homemetting);
                                                $blessings = mysqli_fetch_array($Blessings);
                                                $sikap = mysqli_fetch_array($vc);
                                                $virtues = mysqli_fetch_array($virtue);
                                                $karakter = mysqli_fetch_array($character);







                                                $totalpeniliansikap = $sikap['jumlah'] + $virtues['jumlah'] + $karakter['jumlah'];
                                                $total_2 = $blessings['jumlah'];
                                                $total_1 = $personalgoal['jumlah'] + $pameran['jumlah'] + $persekutuan['jumlah'];
                                                $total = $biblereading['jumlah'] + $prayernote['jumlah'] + $revivalnote['jumlah'];

                                                $totalsemua = $total + $total_1 + $total_2 + $totalpeniliansikap
                                            ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $row['name']; ?></td>
                                                    <td></td>
                                                    <td><?= $total; ?></td>
                                                    <td><?= $total_1; ?></td>
                                                    <td><?= $total_2; ?></td>
                                                    <td><?= $totalpeniliansikap; ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?= $totalsemua; ?></td>
                                                    <td></td>
                                                    <td>Week <?= $i; ?></td>
                                                    <td><?= $dari; ?></td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        <!-- <a id="edit_penilaian" data-toggle="modal" data-target="#editreport" data-absen="<?= $row['presensi']; ?>" data-jurnaldaily="<?= $row['jurnal_daily']; ?>" data-jurnalweekly="<?= $row['jurnal_weekly']; ?>" data-jurnalbulanan="<?= $row['jurnal_monthly']; ?>" data-virtue="<?= $row['virtue']; ?>" data-livingbuku="<?= $row['living_buku']; ?>" data-livingsepatu="<?= $row['living_sepatu_handuk']; ?>" data-livingranjang="<?= $row['living_ranjang']; ?>" data-total="<?= $row['total']; ?>" data-status="<?= $row['status']; ?>" data-keterangan="<?= $row['keterangan']; ?>" data-sanksi="<?= $row['sanksi']; ?>" data-ps="<?= $row['punisment']; ?>" data-date="<?= $row['date']; ?>" data-Punishment="<?= $row['sanksi']; ?>">
                                                            <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button></a> -->
                                                    </td>

                                                </tr>

                                                <?php $i++; ?>
                                        <?php endforeach;
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

    <!-- Modal -->
    <div class="modal fade" id="report" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Report Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">

                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                        <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">

                        <div class="form-group">
                            <label for="text">Name :</label>
                            <input type="text" class="form-control" id="name" readonly name="name" value="<?= $siswa2['name']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="text">Presensi :</label>
                            <input type="text" class="form-control" id="presensi" name="presensi">
                        </div>

                        <div class="form-group">
                            <label for="text">Jurnal Daily :</label>
                            <input type="text" class="form-control" id="jurnaldaily" name="jurnaldaily">
                        </div>

                        <div class="form-group">
                            <label for="text">Jurnal Weekly :</label>
                            <input type="text" class="form-control" id="jurnalweekly" name="jurnalweekly">
                        </div>

                        <div class="form-group">
                            <label for="text">Jurnal Monthly :</label>
                            <input type="text" class="form-control" id="jurnalMonthly" name="jurnalMonthly">
                        </div>

                        <div class="form-group">
                            <label for="text">Virtue :</label>
                            <input type="text" class="form-control" id="virtue" name="virtue">
                        </div>

                        <div class="form-group">
                            <label for="text">Living Lemari :</label>
                            <input type="text" class="form-control" id="lemari" name="lemari">
                        </div>

                        <div class="form-group">
                            <label for="text">Living Lemari Rak Sepatu & Handuk :</label>
                            <input type="text" class="form-control" id="sepatu" name="sepatu">
                        </div>

                        <div class="form-group">
                            <label for="text">Living Ranjang :</label>
                            <input type="text" class="form-control" id="renjang" name="ranjang">
                        </div>

                        <div class="form-group">
                            <label for="text">Total :</label>
                            <input type="text" class="form-control" id="total" name="total">
                        </div>


                        <div class="form-group">
                            <label for="text">Status :</label>
                            <select class="form-control" name="status" id="status" aria-label="Default select example" required>
                                <option value="Complate">Complate</option>
                                <option value="Punishment">Punishment</option>
                                <option value="Grace">Grace</option>
                                <option value="Reward">Reward</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="text">Keterangan :</label>
                            <select type="text" class="form-control" id="Keterangan" name="Keterangan">
                                <option value="">Select</option>
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
                        </div>
                        <div class="form-group">
                            <h7 class="text-reset">Grace :</h7>
                            <select class="form-control" name="grace" id="grace">
                                <option value="">Select</option>
                                <?php
                                $grace = mysqli_query($conn, "SELECT * FROM tb_grace");
                                while ($datagrace = mysqli_fetch_array($grace)) {
                                    echo '<option value="' . $datagrace['grace'] . '">' . $datagrace['grace'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <h7 class="text-reset">Punishment :</h7>
                            <select class="form-control" name="punisment" id="punisment">
                                <option value="">Select</option>
                                <?php
                                $Punishment = mysqli_query($conn, "SELECT * FROM tb_punishment");
                                while ($dataPunishment = mysqli_fetch_array($Punishment)) {
                                    echo '<option value="' . $dataPunishment['Punishment'] . '">' . $dataPunishment['Punishment'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="input">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>











    <!--edit Modal -->
    <div class="modal fade" id="editreport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Report Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">

                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                        <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                        <input type="hidden" class="form-control" id="date" name="date">

                        <div class="form-group">
                            <label for="text">Name :</label>
                            <input type="text" class="form-control" id="name" readonly name="name" value="<?= $siswa2['name']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="text">Presensi :</label>
                            <input type="text" class="form-control" id="absen" name="absen">
                        </div>

                        <div class="form-group">
                            <label for="text">Jurnal Daily :</label>
                            <input type="text" class="form-control" id="jurnaldaily" name="jurnaldaily">
                        </div>

                        <div class="form-group">
                            <label for="text">Jurnal Weekly :</label>
                            <input type="text" class="form-control" id="jurnalweekly" name="jurnalweekly">
                        </div>

                        <div class="form-group">
                            <label for="text">Jurnal Monthly :</label>
                            <input type="text" class="form-control" id="jurnalbulanan" name="jurnalbulanan">
                        </div>

                        <div class="form-group">
                            <label for="text">Virtue :</label>
                            <input type="text" class="form-control" id="virtue" name="virtue">
                        </div>

                        <div class="form-group">
                            <label for="text">Living Lemari :</label>
                            <input type="text" class="form-control" id="livingbuku" name="livingbuku">
                        </div>

                        <div class="form-group">
                            <label for="text">Living Lemari Rak Sepatu & Handuk :</label>
                            <input type="text" class="form-control" id="livingsepatu" name="livingsepatu">
                        </div>

                        <div class="form-group">
                            <label for="text">Living Ranjang :</label>
                            <input type="text" class="form-control" id="livingranjang" name="livingranjang">
                        </div>

                        <div class="form-group">
                            <label for="text">Total :</label>
                            <input type="text" class="form-control" id="total" name="total">
                        </div>


                        <div class="form-group">
                            <label for="text">Status :</label>
                            <select class="form-control" name="status" id="status" aria-label="Default select example" required>
                                <option value="Complate">Complate</option>
                                <option value="Punishment">Punishment</option>
                                <option value="Grace">Grace</option>
                                <option value="Reward">Reward</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="text">Keterangan :</label>
                            <select type="text" class="form-control" id="keterangan" name="keterangan">
                                <option value="">Select</option>
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
                        </div>
                        <div class="form-group">
                            <h7 class="text-reset">Grace :</h7>
                            <select class="form-control" id="sanksi" name="sanksi" id="sanksi">
                                <option value="">Select</option>
                                <?php
                                $grace = mysqli_query($conn, "SELECT * FROM tb_grace");
                                while ($datagrace = mysqli_fetch_array($grace)) {
                                    echo '<option value="' . $datagrace['grace'] . '">' . $datagrace['grace'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <h7 class="text-reset">Punishment :</h7>
                            <select class="form-control" name="Punishment" id="Punishment">
                                <option value="">Select</option>
                                <?php
                                $Punishment = mysqli_query($conn, "SELECT * FROM tb_punishment");
                                while ($dataPunishment = mysqli_fetch_array($Punishment)) {
                                    echo '<option value="' . $dataPunishment['Punishment'] . '">' . $dataPunishment['Punishment'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="edit" name="edit">Save</button>
                    </div>
                </form>
            </div>
        </div>
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

        $(document).on("click", "#edit_penilaian", function() {
            let absen = $(this).data('absen');
            let jurnaldaily = $(this).data('jurnaldaily');
            let jurnalweekly = $(this).data('jurnalweekly');
            let jurnalbulanan = $(this).data('jurnalbulanan');
            let virtue = $(this).data('virtue');
            let livingbuku = $(this).data('livingbuku');
            let livingsepatu = $(this).data('livingsepatu');
            let livingranjang = $(this).data('livingsepatu');
            let total = $(this).data('total');
            let status = $(this).data('status');
            let keterangan = $(this).data('keterangan');
            let sanksi = $(this).data('sanksi');
            let date = $(this).data('date');
            let ps = $(this).data('ps');


            $(" #modal-edit #absen").val(absen);
            $(" #modal-edit #jurnaldaily").val(jurnaldaily);
            $(" #modal-edit #jurnalweekly").val(jurnalweekly);
            $(" #modal-edit #jurnalbulanan").val(jurnalbulanan);
            $(" #modal-edit #virtue").val(virtue);
            $(" #modal-edit #livingbuku").val(livingbuku);
            $(" #modal-edit #livingsepatu").val(livingsepatu);
            $(" #modal-edit #livingranjang").val(livingranjang);
            $(" #modal-edit #total").val(total);
            $(" #modal-edit #status").val(status);
            $(" #modal-edit #keterangan").val(keterangan);
            $(" #modal-edit #sanksi").val(sanksi);
            $(" #modal-edit #date").val(date);
            $(" #modal-edit #ps").val(ps);

        });
    </script>
</body>

</html>