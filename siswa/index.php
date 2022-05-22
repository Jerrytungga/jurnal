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
$presensi = mysqli_query($conn, "SELECT * FROM `tb_presensi` where nis='$id' and semester='$data_semester'");
$presensisum = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(presensi) AS hasil FROM `tb_presensi` where nis='$id' and semester='$data_semester'"));

// date_default_timezone_set('Asia/Jakarta'); // Set timezone
// $dari = "2021-11-15"; // tanggal mulai
// $sampai = date('Y-m-d');
// while (strtotime($dari) <= strtotime($sampai)) {
//     $pp = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`) as jumlah FROM tb_revival_note WHERE nis='$id' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");
//     $presensi = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE nis='$id'  AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");
//     $dari = date("Y-m-d", strtotime("+7 day", strtotime($dari)));
//     foreach ($presensi as $row) :
//         $revivalnote = mysqli_fetch_array($pp);
//         $presensiWeekly = mysqli_fetch_array($presensi);
//         echo  $revivalnote['totalpoin'];
//     endforeach;
// }
// var_dump($revivalnote['totalpoin']);
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
                        <h1 class="h3 mb-0 text-uppercase">Dasbor</h1>

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
                                                Siswa Aktif</div>
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
                                                Total Siswa</div>
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
                                                Mentor Saya</div>
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
                                <h6 class="m-0 font-weight-bold text-dark mb-2">Kemajuan Jurnal</h6>
                                <?php

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
    include 'template/script.php';
    ?>




    <!-- Page level plugins -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!-- contoh bar chart -->
    <!-- <script type="text/javascript">
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
                        "Presensi",
                        <?= $pointpresensi; ?>
                    ],
                    [
                        "Penyegaran Pagi",
                        <?= $revival_note['revivalnote']; ?>

                    ],
                    [
                        "Catatan Doa",
                        <?= $prayer_note['prayernote']; ?>

                    ],
                    [
                        "Pembacaan Alkitab",
                        <?= $bible_reading['biblereading']; ?>

                    ],
                    [
                        "Pameran",
                        <?= $exhibition['exhibition']; ?>

                    ],
                    [
                        "Tujuan Pribadi",
                        <?= $personalgoal['personalgoal']; ?>

                    ],
                    [
                        "Persekutuan Mentor",
                        <?= $homemeeting['homemeeting']; ?>

                    ],
                    [
                        "Berkat",
                        <?= $blessings['blessings']; ?>

                    ],
                    [
                        "Kebajikan & Karakter",
                        <?= $virtue_character; ?>

                    ],
                    [
                        "Penilaian Lemari",
                        <?= $totallivinglemari; ?>

                    ],
                    [
                        "Penilaian Ranjang",
                        <?= $totallivingranjang; ?>

                    ],
                    [
                        "Penilaian Rak Sepatu & Handuk",
                        <?= $totallivingraksepatu; ?>

                    ],
                    [
                        "Total Poin",
                        <?= $totaljurnal + $pointpresensi; ?>

                    ]
                ]
            }],



        });
    </script> -->


    <script>
        Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jurnal PKA'
            },
            // subtitle: {
            //     align: 'left',
            //     text: ''
            // },
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
                        format: '{point.y:1f} Poin'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.1f} Poin </b> of total<br/>'
            },

            series: [{
                name: "<?= $data['name']; ?>",
                colorByPoint: true,
                data: [{

                        name: "Presensi",
                        y: <?= $presensisum['hasil'] ?>,
                        drilldown: "Presensi"

                    },
                    {
                        name: "Penyegaran Pagi",
                        y: <?= $revival_note['revivalnote']; ?>,
                        drilldown: "Penyegaran Pagi"
                    },
                    {
                        name: "Catatan Doa",
                        y: <?= $prayer_note['prayernote']; ?>,
                        drilldown: "Catatan Doa"
                    },
                    {
                        name: "Pembacaan Alkitab",
                        y: <?= $bible_reading['biblereading']; ?>,
                        drilldown: "Pembacaan Alkitab"
                    },
                    {
                        name: "Pameran",
                        y: <?= $exhibition['exhibition']; ?>,
                        drilldown: "Pameran"
                    },
                    {
                        name: "Tujuan Pribadi",
                        y: <?= $personalgoal['personalgoal']; ?>,
                        drilldown: "Tujuan Pribadi"
                    },

                ]
            }],
            drilldown: {
                breadcrumbs: {
                    position: {
                        align: 'right'
                    }
                },
                series: [{


                        name: "<?= $data['name']; ?>",
                        id: "Presensi",

                        data: [
                            <?php
                            while ($data_presensi2 = mysqli_fetch_array($presensi)) {
                                $ambil_data =  $data_presensi2['presensi'];
                                $week =  $data_presensi2['week'];
                                echo "['week" .  $week . "', " . $ambil_data . "],";
                            }
                            ?>

                        ]

                    },
                    {
                        name: "Penyegaran Pagi",
                        id: "Penyegaran Pagi",
                        data: [
                            <?php
                            date_default_timezone_set('Asia/Jakarta'); // Set timezone
                            //variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"
                            $dari = "2021-11-15"; // tanggal mulai
                            $sampai = date('Y-m-d'); // tanggal akhir
                            while (strtotime($dari) <= strtotime($sampai)) {
                                $pp = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`) as jumlah FROM tb_revival_note WHERE nis='$id'  AND semester='$data_semester' and date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");
                                $presensi = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE nis='$id'  AND semester='$data_semester' and date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");
                                $dari = date("Y-m-d", strtotime("+7 day", strtotime($dari))); //looping tambah 7 date
                                $presensiWeekly = mysqli_fetch_array($presensi);
                                foreach ($presensi as $row) :
                                    $revivalnote = mysqli_fetch_array($pp);
                                    echo "['week" . $row['week'] . "', " .
                                        $revivalnote['jumlah'] . "],";
                                endforeach;
                            }
                            ?>
                        ]
                    },
                    {
                        name: "Catatan Doa",
                        id: "Catatan Doa",
                        data: [
                            <?php
                            date_default_timezone_set('Asia/Jakarta'); // Set timezone
                            //variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"
                            $dari = "2021-11-15"; // tanggal mulai
                            $sampai = date('Y-m-d'); // tanggal akhir
                            while (strtotime($dari) <= strtotime($sampai)) {
                                $doa = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point`) as jumlah FROM tb_prayer_note WHERE nis='$id' AND semester='$data_semester' and date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");
                                $presensi = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE nis='$id'  AND semester='$data_semester' and date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");
                                $dari = date("Y-m-d", strtotime("+7 day", strtotime($dari))); //looping tambah 7 date
                                $presensiWeekly = mysqli_fetch_array($presensi);
                                foreach ($presensi as $row) :
                                    $prayernote = mysqli_fetch_array($doa);
                                    echo "['week" . $row['week'] . "', " .
                                        $prayernote['jumlah'] . "],";
                                endforeach;
                            }
                            ?>
                        ]
                    },
                    {
                        name: "Pembacaan Alkitab",
                        id: "Pembacaan Alkitab",
                        data: [
                            <?php
                            date_default_timezone_set('Asia/Jakarta'); // Set timezone
                            //variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"
                            $dari = "2021-11-15"; // tanggal mulai
                            $sampai = date('Y-m-d'); // tanggal akhir
                            while (strtotime($dari) <= strtotime($sampai)) {

                                $alkitab = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point`) as jumlah FROM tb_bible_reading WHERE nis='$id' AND semester='$data_semester' and date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");
                                $presensi = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE nis='$id'  AND semester='$data_semester' and date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");
                                $dari = date("Y-m-d", strtotime("+7 day", strtotime($dari))); //looping tambah 7 date
                                $presensiWeekly = mysqli_fetch_array($presensi);
                                foreach ($presensi as $row) :
                                    $biblereading = mysqli_fetch_array($alkitab);
                                    echo "['week" . $row['week'] . "', " .
                                        $biblereading['jumlah'] . "],";
                                endforeach;
                            }
                            ?>
                        ]
                    },
                    {
                        name: "Pameran",
                        id: "Pameran",
                        data: [
                            <?php
                            date_default_timezone_set('Asia/Jakarta'); // Set timezone
                            //variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"
                            $dari = "2021-11-15"; // tanggal mulai
                            $sampai = date('Y-m-d'); // tanggal akhir
                            while (strtotime($dari) <= strtotime($sampai)) {
                                $kelas_pameran = mysqli_query($conn, "SELECT SUM(`point`) as jumlah FROM tb_exhibition WHERE nis='$id' AND  date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");
                                $presensi = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE nis='$id'  AND semester='$data_semester' and date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");
                                $dari = date("Y-m-d", strtotime("+7 day", strtotime($dari))); //looping tambah 7 date
                                $presensiWeekly = mysqli_fetch_array($presensi);
                                foreach ($presensi as $row) :
                                    $kelasPameran = mysqli_fetch_array($kelas_pameran);
                                    echo "['week" . $row['week'] . "', " .
                                        $kelasPameran['jumlah'] . "],";
                                endforeach;
                            }
                            ?>
                        ]
                    },
                    {
                        name: "Tujuan Pribadi",
                        id: "Tujuan Pribadi",
                        data: [
                            <?php
                            date_default_timezone_set('Asia/Jakarta'); // Set timezone
                            //variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"
                            $dari = "2021-11-15"; // tanggal mulai
                            $sampai = date('Y-m-d'); // tanggal akhir
                            while (strtotime($dari) <= strtotime($sampai)) {
                                $goalsetting_1 = mysqli_query($conn, "SELECT sum(point1)+sum(point2)+sum(point3) as personalgoal FROM `tb_personal_goal` where nis='$id'and semester='$data_semester' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");
                                $presensi = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE nis='$id'  AND semester='$data_semester' and date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");
                                $dari = date("Y-m-d", strtotime("+7 day", strtotime($dari))); //looping tambah 7 date
                                $presensiWeekly = mysqli_fetch_array($presensi);
                                foreach ($presensi as $row) :
                                    $tujuan_pribadi = mysqli_fetch_array($goalsetting_1);
                                    echo "['week" . $row['week'] . "', " .
                                        $tujuan_pribadi['personalgoal'] . "],";
                                endforeach;
                            }
                            ?>
                        ]
                    }


                ]
            }
        });
    </script>
    <?php
    var_dump($ambil_datarv);
    ?>

</body>

</html>