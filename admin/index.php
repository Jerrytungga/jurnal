<?php
include '../database.php';
session_start();
include 'template/Session.php';
error_reporting(E_ALL ^ E_NOTICE);
// bar cart siswa
$angkatan  = mysqli_query($conn, "SELECT angkatan FROM siswa order by nis asc");
$name      = mysqli_query($conn, "SELECT name FROM siswa order by nis asc");
// menghitung jumlah siswa aktif
$get1 = mysqli_query($conn, "SELECT * FROM siswa WHERE status='Aktif' ");
$count1 = mysqli_num_rows($get1);
// menghitung total siswa
$get2 = mysqli_query($conn, "SELECT * FROM siswa ");
$count2 = mysqli_num_rows($get2);
// menghitung jumlah mentor
$get3 = mysqli_query($conn, "SELECT * FROM mentor WHERE status='Aktif'");
$count3 = mysqli_num_rows($get3);
// menghitung jumlah mentor
$get4 = mysqli_query($conn, "SELECT * FROM mentor");
$count4 = mysqli_num_rows($get4);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jurnal PKA</title>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Student Active</div>
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
                        <div class="col-xl-3 col-md-6 mb-4">
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
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Mentor Active</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count3; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <!-- Total Mentor -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Mentor</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count4; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Bar Chart -->
                        <div class="card shadow  w-100 m-lg-2">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary mb-2">Progress Journal</h6>
                                <div class="select_ form-inline ">
                                    <form action="" method="POST">
                                        <select class="form-control mb-2" name="semester" id="semester">
                                            <option selected>Select Semester</option>
                                            <?php
                                            $sql_semester = mysqli_query($conn, "SELECT * FROM tb_semester");
                                            while ($data_semester = mysqli_fetch_array($sql_semester)) {
                                                echo '<option value="' . $data_semester['thn_semester'] . '">' . $data_semester['keterangan'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <select class="form-control mb-2" required name="nis" aria-label="Default select example">
                                            <?php
                                            if (isset($_POST['nis'])) {
                                                $daftarsiswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa where status='Aktif' and nis='" . $_POST['nis'] . "'"));
                                            ?>

                                                <option value="<?= $daftarsiswa['nis']; ?>"><?= $daftarsiswa['name']; ?></option>
                                            <?php } else {
                                                echo "<option selected>Select student</option>";
                                            }
                                            $daftarsiswa = mysqli_query($conn, "SELECT * FROM siswa where status='Aktif' ");
                                            while ($data1 = mysqli_fetch_array($daftarsiswa)) { ?>
                                                <option value="<?= $data1['nis']; ?>"><?= $data1['name']; ?></option>

                                            <?php }
                                            ?>
                                        </select>
                                        <button type="submit" name="cari" class="btn btn-info ml-1 mb-2">View</button>
                                        <a href="index.php" class="btn btn-danger ml-1 mb-2">Reset</a>
                                    </form>



                                </div>





                                <?php
                                if (isset($_POST['cari'])) {
                                    $nis = $_POST['nis'];
                                    $semester = $_POST['semester'];
                                    $semester2 = mysqli_query($conn, "SELECT * FROM tb_semester where thn_semester='$semester'");
                                    $data_semester = mysqli_fetch_array($semester2);
                                    $siswa  = mysqli_query($conn, "SELECT * FROM `siswa` where nis='$nis'");
                                    while ($data = mysqli_fetch_array($siswa)) {
                                        $nama = $data['name'];
                                        $nis2 = $data['nis'];
                                        $revival_note = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+SUM(point2) as revivalnote FROM `tb_revival_note` where nis='$nis2' and semester='$semester'"));

                                        $tampilan_presensi21 = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(presensi) as totalpresensi FROM tb_presensi where nis='$nis2' and semester='$semester' group by nis"));

                                        $prayer_note = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+SUM(point) as prayernote FROM `tb_prayer_note` where nis='$nis2' and semester='$semester'"));

                                        $bible_reading = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+SUM(point)+sum(point2) as biblereading FROM `tb_bible_reading` where nis='$nis2' and semester='$semester'"));

                                        $exhibition = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point) as exhibition FROM `tb_exhibition` where nis='$nis2' and semester='$semester'"));

                                        $personalgoal = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+sum(point2)+sum(point3) as personalgoal FROM `tb_personal_goal` where nis='$nis2' and semester='$semester'"));

                                        $homemeeting = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point) as homemeeting FROM `tb_home_meeting` where nis='$nis2' and semester='$semester'"));

                                        $blessings = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(point1)+sum(point2)+sum(point3)+sum(point4)+sum(point5)+sum(point6)+sum(point7)+sum(point8) as blessings FROM `tb_blessings` where nis='$nis2' and semester='$semester'"));

                                        $virtuechracter = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(perhatian_berbagi)+sum(salam_sapa)+sum(bersyukur_berterimakasih)+sum(hormat_taat)as vituecharacter FROM `tb_vrtues_caharacter` where nis='$nis2' and semester='$semester'"));

                                        $virtue = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(sikapramahsopan)+sum(sikapberkordinasi)+sum(sikaptolongmenolong)+sum(sikapseedo) as virtue FROM `tb_virtues` where nis='$nis2' and semester='$semester'"));

                                        $character = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(benar)+sum(tepat)+sum(ketat) as totalcharacter FROM `tb_character` where nis='$nis2' and semester='$semester'"));

                                        $living_buku = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as buku FROM tb_living_buku where nis='$nis2' and semester='$semester'"));

                                        $living_pakaianlipat = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as pakaianlipat FROM tb_living_pakaianlipat where nis='$nis2' and semester='$semester'"));

                                        $living_pakaiangantung = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bentuk`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as pakaiangantung FROM tb_living_pakaiangantung where nis='$nis2' and semester='$semester'"));

                                        $living_celana = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as celana FROM tb_living_celanalipat  where nis='$nis2' and semester='$semester'"));

                                        $living_logistik = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as logistik FROM tb_living_logistik where nis='$nis2' and semester='$semester'"));

                                        $living_pakaiandalam = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as pakaiandalam FROM tb_living_pakaiandalam where nis='$nis2' and semester='$semester'"));

                                        $ranjang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_ranjang WHERE nis='$nis' and semester='$semester' ");
                                        $livingranjang = mysqli_fetch_array($ranjang);
                                        $bantal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_bantal WHERE nis='$nis' and semester='$semester'");
                                        $livingbantal = mysqli_fetch_array($bantal);
                                        $seprei = mysqli_query($conn, "SELECT SUM(`rapi`)+SUM(`raib`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_seprei WHERE nis='$nis' and semester='$semester'");
                                        $livingseprei = mysqli_fetch_array($seprei);
                                        $selimut = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_selimut WHERE nis='$nis' and semester='$semester'");
                                        $livingselimut = mysqli_fetch_array($selimut);

                                        // total living rak sepatu
                                        $raksepatu = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_sepatu WHERE nis='$nis' and semester='$semester'");
                                        $livingraksepatu = mysqli_fetch_array($raksepatu);
                                        $sepatusidang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_sidang WHERE nis='$nis' and semester='$semester'");
                                        $livingsepatusidang = mysqli_fetch_array($sepatusidang);
                                        $sepatu_or = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_or WHERE nis='$nis' and semester='$semester'");
                                        $livingsepatu_or = mysqli_fetch_array($sepatu_or);
                                        $sandal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sendal WHERE nis='$nis' and semester='$semester'");
                                        $livingsandal = mysqli_fetch_array($sandal);
                                        $rakhanduk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_handuk WHERE nis='$nis' and semester='$semester'");
                                        $livingrakhanduk = mysqli_fetch_array($rakhanduk);
                                        $handuk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_handuk WHERE nis='$nis' and semester='$semester'");
                                        $livinghanduk = mysqli_fetch_array($handuk);




                                        $totallivingraksepatu = $livingraksepatu['jumlah'] + $livingsepatusidang['jumlah'] + $livingsepatu_or['jumlah'] + $livingsandal['jumlah'] + $livingrakhanduk['jumlah'] + $livinghanduk['jumlah'];

                                        $totallivingranjang = $livingranjang['jumlah'] + $livingbantal['jumlah'] + $livingseprei['jumlah'] + $livingselimut['jumlah'];

                                        $totallivinglemari = $living_buku['buku'] + $living_pakaianlipat['pakaianlipat'] + $living_pakaiangantung['pakaiangantung'] + $living_celana['celana'] + $living_logistik['logistik'] + $living_pakaiandalam['pakaiandalam'];

                                        $virtue_character = $virtuechracter['vituecharacter'] + $virtue['virtue'] + $character['totalcharacter'];

                                        $totaljurnal = $revival_note['revivalnote'] + $prayer_note['prayernote'] + $bible_reading['biblereading'] + $exhibition['exhibition'] + $personalgoal['personalgoal'] + $homemeeting['homemeeting'] + $blessings['blessings'] + $totallivingraksepatu + $totallivingranjang + $totallivinglemari + $virtue_character;





                                        $tampilan_presensi = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' group by nis order by absent_time DESC");
                                        while ($array_presensi = mysqli_fetch_array($tampilan_presensi)) {
                                            $nis = $array_presensi['nis'];
                                            $mark_V = $array_presensi['mark'] = 'V';
                                            $mark_O = $array_presensi['mark'] = 'O';
                                            $mark_X = $array_presensi['mark'] = 'X';
                                            $mark_I = $array_presensi['mark'] = 'I';
                                            $mark_S = $array_presensi['mark'] = 'S';


                                            $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_V' ");
                                            $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                                            $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_O'");
                                            $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                                            $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_X' ");
                                            $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                                            $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_I' ");
                                            $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                                            $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_S' ");
                                            $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                                            $tampil3 = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' group by nis ");
                                            $arraytampil3 = mysqli_fetch_array($tampil3);

                                            $total_point = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'] +
                                                $tampilan_presensi21['totalpresensi'];
                                        }
                                        $pointpresensi = $total_point;
                                        if ($pointpresensi == NULL) {
                                            $pointpresensi = $tampilan_presensi21['totalpresensi'];
                                        } else {
                                            $pointpresensi = $total_point +
                                                $tampilan_presensi21['totalpresensi'];
                                        }
                                    }
                                } else {
                                    echo 'Tidak Ada Data';
                                }

                                ?>



                            </div>
                            <div class="card-body">
                                <div id="chart"></div>
                            </div>

                        </div>


                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <?php
                include './template/footer.php';
                ?>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php
    include 'models/m_logout.php';
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
    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-bar-demo.js"></script>
    <!-- Page level plugins -->
    <!-- <script src="js/Chart.js"></script> -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <!-- contoh bar chart -->
    <script type="text/javascript">
        // Create the chart
        Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jurnal PKA  Semester  <?= $data_semester['keterangan']; ?>'
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
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} Poin</b> of total<br/>'
            },

            series: [{
                    name: "<?= $nama ?>",
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
                            "Total Points",
                            <?= $totaljurnal; ?>

                        ]

                    ]
                },

            ]

        });
    </script>

</body>

</html>