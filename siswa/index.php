<?php
include '../database.php';
// cek apakah yang mengakses halaman ini sudah login
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include 'template/session.php';
$get1 = mysqli_query($conn, "SELECT * FROM siswa WHERE status='Aktif' ");
$count1 = mysqli_num_rows($get1);
// menghitung total siswa
$get2 = mysqli_query($conn, "SELECT * FROM siswa ");
$count2 = mysqli_num_rows($get2);
// menghitung jumlah mentor
$siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$id'");
$getmentor = mysqli_fetch_array($siswa);
$mentor = $getmentor['mentor'];
$get_mentor_siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM mentor where efata='$mentor'"));
$get_mentor_siswa['name'];
$get_mentor_siswa['image'];
?>
<!DOCTYPE html>
<html lang="en">

<?php
include 'template/head.php'
?>
<style>
    .gambar {
        height: 70px;
        width: 70px;
        border-radius: 50%;
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- sidebar -->
        <?php
        include 'template/sidebar_menu.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Topbar Navbar -->
                <?php
                include 'template/topbar_menu.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

                    </div>


                    <!-- Content Row -->
                    <div class="row">

                        <!-- Siswa aktif -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Active Student</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count1; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Siswa -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Student</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count2; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Mentor Aktif -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                My Mentor</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $get_mentor_siswa['name']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <img src="../img/fotomentor/<?= $get_mentor_siswa['image']; ?>" class="gambar" alt="...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Bar Chart -->
                        <div class="card shadow  w-100 m-lg-2">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary mb-2">Progress Journal</h6>
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
                                    <button type="submit" name="filter_tanggal" class="btn btn-info ml-3">Filter</button>
                                    <button type="submit" name="reset" value="reset" class="btn btn-danger ml-3">Reset</button>
                                </form>
                                <?php


                                if (isset($_POST['filter_tanggal'])) {
                                    $mulai = $_POST['tanggal_mulai'];
                                    $selesai = $_POST['tanggal_akhir'];

                                    $tampilan_presensi21 = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(presensi) as totalpresensi FROM tb_presensi where nis='$id' and semester='$data_semester'  and date BETWEEN '$mulai' and '$selesai '  group by nis"));

                                    $revival_note = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+SUM(point2) as revivalnote FROM `tb_revival_note` where nis='$id' and semester='$data_semester'  and date BETWEEN '$mulai' and '$selesai '"));

                                    $prayer_note = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+SUM(point) as prayernote FROM `tb_prayer_note` where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $bible_reading = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+SUM(point)+sum(point2) as biblereading FROM `tb_bible_reading` where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $exhibition = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point) as exhibition FROM `tb_exhibition` where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $personalgoal = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+sum(point2)+sum(point3) as personalgoal FROM `tb_personal_goal` where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $homemeeting = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point) as homemeeting FROM `tb_home_meeting` where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $blessings = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+sum(point2)+sum(point3)+sum(point4)+sum(point5)+sum(point6)+sum(point7)+sum(point8) as blessings FROM `tb_blessings` where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $virtuechracter = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(perhatian_berbagi)+sum(salam_sapa)+sum(bersyukur_berterimakasih)+sum(hormat_taat)as vituecharacter FROM `tb_vrtues_caharacter` where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $virtue = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(sikapramahsopan)+sum(sikapberkordinasi)+sum(sikaptolongmenolong)+sum(sikapseedo) as virtue FROM `tb_virtues` where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $character = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(benar)+sum(tepat)+sum(ketat) as totalcharacter FROM `tb_character` where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $living_buku = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as buku FROM tb_living_buku where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $living_pakaianlipat = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as pakaianlipat FROM tb_living_pakaianlipat where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $living_pakaiangantung = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bentuk`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as pakaiangantung FROM tb_living_pakaiangantung where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $living_celana = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as celana FROM tb_living_celanalipat  where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $living_logistik = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as logistik FROM tb_living_logistik where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $living_pakaiandalam = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as pakaiandalam FROM tb_living_pakaiandalam where nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '"));

                                    $ranjang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_ranjang WHERE nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai ' ");
                                    $livingranjang = mysqli_fetch_array($ranjang);
                                    $bantal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_bantal WHERE nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '");
                                    $livingbantal = mysqli_fetch_array($bantal);
                                    $seprei = mysqli_query($conn, "SELECT SUM(`rapi`)+SUM(`raib`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_seprei WHERE nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '");
                                    $livingseprei = mysqli_fetch_array($seprei);
                                    $selimut = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_selimut WHERE nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '");
                                    $livingselimut = mysqli_fetch_array($selimut);

                                    // total living rak sepatu
                                    $raksepatu = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_sepatu WHERE nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '");
                                    $livingraksepatu = mysqli_fetch_array($raksepatu);
                                    $sepatusidang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_sidang WHERE nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '");
                                    $livingsepatusidang = mysqli_fetch_array($sepatusidang);
                                    $sepatu_or = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_or WHERE nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '");
                                    $livingsepatu_or = mysqli_fetch_array($sepatu_or);
                                    $sandal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sendal WHERE nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '");
                                    $livingsandal = mysqli_fetch_array($sandal);
                                    $rakhanduk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_handuk WHERE nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '");
                                    $livingrakhanduk = mysqli_fetch_array($rakhanduk);
                                    $handuk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_handuk WHERE nis='$id' and semester='$data_semester' and date BETWEEN '$mulai' and '$selesai '");
                                    $livinghanduk = mysqli_fetch_array($handuk);

                                    $totallivingraksepatu = $livingraksepatu['jumlah'] + $livingsepatusidang['jumlah'] + $livingsepatu_or['jumlah'] + $livingsandal['jumlah'] + $livingrakhanduk['jumlah'] + $livinghanduk['jumlah'];

                                    $totallivingranjang = $livingranjang['jumlah'] + $livingbantal['jumlah'] + $livingseprei['jumlah'] + $livingselimut['jumlah'];

                                    $totallivinglemari = $living_buku['buku'] + $living_pakaianlipat['pakaianlipat'] + $living_pakaiangantung['pakaiangantung'] + $living_celana['celana'] + $living_logistik['logistik'] + $living_pakaiandalam['pakaiandalam'];

                                    $virtue_character = $virtuechracter['vituecharacter'] + $virtue['virtue'] + $character['totalcharacter'];

                                    $totaljurnal = $revival_note['revivalnote'] + $prayer_note['prayernote'] + $bible_reading['biblereading'] + $exhibition['exhibition'] + $personalgoal['personalgoal'] + $homemeeting['homemeeting'] + $blessings['blessings'] + $totallivingraksepatu + $totallivingranjang + $totallivinglemari + $virtue_character;

                                    $tampilan_presensi = mysqli_query($conn, "SELECT * FROM absent where nis='$id'  and semester='$data_semester' and absent_date BETWEEN '$mulai' and '$selesai ' group by nis order by absent_time DESC");
                                    while ($array_presensi = mysqli_fetch_array($tampilan_presensi)) {
                                        $nis = $array_presensi['nis'];
                                        $mark_V = $array_presensi['mark'] = 'V';
                                        $mark_O = $array_presensi['mark'] = 'O';
                                        $mark_X = $array_presensi['mark'] = 'X';
                                        $mark_I = $array_presensi['mark'] = 'I';
                                        $mark_S = $array_presensi['mark'] = 'S';


                                        $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_V'  and semester='$data_semester' and absent_date BETWEEN '$mulai' and '$selesai '");
                                        $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                                        $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_O'  and semester='$data_semester' and absent_date BETWEEN '$mulai' and '$selesai '");
                                        $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                                        $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_X'  and semester='$data_semester' and absent_date BETWEEN '$mulai' and '$selesai '");
                                        $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                                        $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_I' and semester='$data_semester' and absent_date BETWEEN '$mulai' and '$selesai '");
                                        $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                                        $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_S'  and semester='$data_semester' and absent_date BETWEEN '$mulai' and '$selesai '");
                                        $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                                        $total_point = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];
                                    }

                                    $pointpresensi = $total_point;
                                    if ($pointpresensi == NULL) {
                                        $pointpresensi = $tampilan_presensi21['totalpresensi'];
                                    } else {
                                        $pointpresensi = $total_point +
                                            $tampilan_presensi21['totalpresensi'];
                                    }
                                } else {

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

                                    $totaljurnal = $revival_note['revivalnote'] + $prayer_note['prayernote'] + $bible_reading['biblereading'] + $exhibition['exhibition'] + $personalgoal['personalgoal'] + $homemeeting['homemeeting'] + $blessings['blessings'] + $totallivingraksepatu + $totallivingranjang + $totallivinglemari + $virtue_character;

                                    $tampilan_presensi = mysqli_query($conn, "SELECT * FROM absent where nis='$id'  and semester='$data_semester' group by nis order by absent_time DESC");
                                    while ($array_presensi = mysqli_fetch_array($tampilan_presensi)) {
                                        $nis = $array_presensi['nis'];
                                        $mark_V = $array_presensi['mark'] = 'V';
                                        $mark_O = $array_presensi['mark'] = 'O';
                                        $mark_X = $array_presensi['mark'] = 'X';
                                        $mark_I = $array_presensi['mark'] = 'I';
                                        $mark_S = $array_presensi['mark'] = 'S';


                                        $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_V'  and semester='$data_semester'");
                                        $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                                        $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_O'  and semester='$data_semester'");
                                        $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                                        $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_X'  and semester='$data_semester'");
                                        $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                                        $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_I' and semester='$data_semester'");
                                        $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                                        $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_S'  and semester='$data_semester'");
                                        $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                                        $total_point = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];
                                    }
                                    $pointpresensi = $total_point;
                                    if ($pointpresensi == NULL) {
                                        $pointpresensi = $tampilan_presensi21['totalpresensi'];
                                    } else {
                                        $pointpresensi = $total_point +
                                            $tampilan_presensi21['totalpresensi'];
                                    }
                                }
                                ?>


                            </div>
                            <div class="card-body">
                                <div id="chart"></div>
                            </div>

                        </div>





                    </div>


                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


            <?php
            include 'template/footer.php';
            ?>


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
    include 'modal/modal_logout.php';
    ?>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- <script src="js/Chart.js"></script> -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script>
        $(document).ready(function() {
            var living = document.getElementById('living');
            var waktu = new Date();
            var hari = waktu.getDay();
            var bulan = waktu.getMonth();


            if (hari == 0) {
                living.style.display = 'blok';
            } else {
                living.style.display = 'none';
            }
        });
    </script>
    <!-- contoh bar chart -->
    <script type="text/javascript">
        // Create the chart
        Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jurnal PKA'
            },
            subtitle: {
                text: ''
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total persentase jurnal'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f} Poin'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} Poin </b> of total<br/>'
            },



            series: [{
                    name: "<?= $data['name']; ?>",
                    // id: "Gracio",
                    data: [

                        [
                            "Presence",
                            <?= $pointpresensi; ?>
                        ],
                        [
                            "Revival Note",
                            <?= $revival_note['revivalnote']; ?>

                        ],
                        [
                            "Prayer Note",
                            <?= $prayer_note['prayernote']; ?>

                        ],
                        [
                            "Bible Reading",
                            <?= $bible_reading['biblereading']; ?>

                        ],
                        [
                            "Exhibition",
                            <?= $exhibition['exhibition']; ?>

                        ],
                        [
                            "Personal Goal",
                            <?= $personalgoal['personalgoal']; ?>

                        ],
                        [
                            "Home Metting",
                            <?= $homemeeting['homemeeting']; ?>

                        ],
                        [
                            "Blessings",
                            <?= $blessings['blessings']; ?>

                        ],
                        [
                            "Virtue & Character",
                            <?= $virtue_character; ?>

                        ],
                        [
                            "Living Lemari",
                            <?= $totallivinglemari; ?>

                        ],
                        [
                            "Living Ranjang",
                            <?= $totallivingranjang; ?>

                        ],
                        [
                            "Living Rak Sepatu & Handuk",
                            <?= $totallivingraksepatu; ?>

                        ],
                        [
                            "Total Poin",
                            <?= $totaljurnal + $pointpresensi; ?>

                        ]
                    ]
                },




            ]

        });
    </script>


</body>

</html>