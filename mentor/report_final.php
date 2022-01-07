<?php
include '../database.php';
session_start();
include 'template/session.php';
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"))
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Siswa</title>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
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
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="card mb-4 shadow-lg p-3 bg-body rounded" style="max-width: 100%;">

                        <!-- isi konten -->

                        <h1 class="text-dark text-center font-weight-bold">Yayasan Kebenaran Alkitab</h1>
                        <p class=" text-dark text-center font-monospace">PELATIHAN PELAYANAN ROHANI “KEBENARAN ALKITAB” <br> Jalan Ngamarto 2, Lawang 65211; Telpon 0341 4301212, Fax 0341 426639 <br>Email address : pka.lawang@gmail.com <br> Keputusan Dirjen Bimas Kristen (Protestan)<br>Kementrian Agama nomor F/Kep/HK 00579/22377/99, Tgl 20-7-1999</p>
                        <h5 class="text-dark text-center mb-3 font-weight-bold">LAPORAN SEMESTER PERKEMBANGAN BELAJAR SISWA PKA LAWANG</h5>
                        <p class="text-dark text-center mb-2 font-weight-bold"><?= $siswa2['name']; ?></p>
                        <h6 class="text-dark text-center mb-3 font-weight-bold">[<?= $siswa2['nis']; ?>] [<?= $siswa2['angkatan']; ?>]</h6>

                        <center>
                            <table class="table table-sm table-bordered" style="width: 70%" cellspacing="0">
                                <thead class=" table-secondary border-dark">
                                    <tr class="border-dark text-center">

                                        <th class="border-dark" rowspan="2" width="200">ASPEK PEMBELAJARAN</th>
                                        <th class="border-dark" rowspan="2" width="210">FOKUS/MATERI PEMBELAJARAN</th>
                                        <th class="border-dark" rowspan="2" width="10">Target</th>
                                        <th class="border-dark" colspan="3" class=" text-center border-dark">Pencapaian Akhir</th>
                                        <th class="border-dark" rowspan="2" width="10">Bobot</th>
                                        <th class=" border-dark" rowspan="2" width="150">Deskripsi Pelaksanaan</th>
                                        <th class="border-dark" rowspan="2" width="250">Ket.</th>

                                    </tr>
                                    <tr class=" text-center">
                                        <th class="border-dark" width="10">Nilai Akhir</th>
                                        <th class="border-dark" class=" text-center" width="10">%</th>
                                        <th class="border-dark" width="10">Huruf</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    ?>
                                    <?php
                                    date_default_timezone_set('Asia/Jakarta'); // Set timezone
                                    //variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"
                                    $dari = "2021-11-15"; // tanggal mulai
                                    $sampai = date('Y-m-d'); // tanggal akhir

                                    while (strtotime($dari) <= strtotime($sampai)) {
                                        // echo "$dari<br/>";

                                        // pembacaan alkitab
                                        $alkitab = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point`) as jumlah FROM tb_bible_reading WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+182 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // doa
                                        $doa = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point`) as jumlah FROM tb_prayer_note WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+182 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // penyegaran pagi
                                        $pp = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`) as jumlah FROM tb_revival_note WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+182 day", strtotime($dari))) . "' ORDER BY date DESC");


                                        // // personal goal
                                        // $goalsetting = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point3`) as jumlah FROM tb_personal_goal WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // // exhibition
                                        // $exhibition = mysqli_query($conn, "SELECT SUM(`point`) as jumlah FROM tb_exhibition WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // // home metting
                                        // $homemetting = mysqli_query($conn, "SELECT SUM(`point`) as jumlah FROM tb_home_meeting WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // // Blessings
                                        // $Blessings = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point3`)+SUM(`point4`)+SUM(`point5`)+SUM(`point6`)+SUM(`point7`)+SUM(`point8`) as jumlah FROM tb_blessings WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // // virtue dan character
                                        // $vc = mysqli_query($conn, "SELECT SUM(`perhatian_berbagi`)+SUM(`salam_sapa`)+SUM(`bersyukur_berterimakasih`)+SUM(`hormat_taat`) as jumlah FROM tb_vrtues_caharacter WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // // virtue
                                        // $virtue = mysqli_query($conn, "SELECT SUM(`sikapramahsopan`)+SUM(`sikapberkordinasi`)+SUM(`sikaptolongmenolong`)+SUM(`sikapseedo`) as jumlah FROM tb_virtues WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // // character
                                        // $character = mysqli_query($conn, "SELECT SUM(`benar`)+SUM(`tepat`)+SUM(`ketat`) as jumlah FROM tb_character WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");


                                        // // living lemari 
                                        // $buku = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_buku WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $pakaianlipat = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_pakaianlipat WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $pakaiangantung = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bentuk`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as jumlah FROM tb_living_pakaiangantung WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $celana = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_celanalipat WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $logistik = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as jumlah FROM tb_living_logistik WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $pakaiandalam = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_pakaiandalam WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // // living rak sepatu dan handuk
                                        // $raksepatu = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_sepatu WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $sepatusidang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_sidang WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $sepatu_or = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_or WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $sandal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sendal WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $rakhanduk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_handuk WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $handuk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_handuk WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // // living ranjang
                                        // $ranjang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_ranjang WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $bantal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_bantal WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $seprei = mysqli_query($conn, "SELECT SUM(`rapi`)+SUM(`raib`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_seprei WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                        // $selimut = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_selimut WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");


                                        // // Presensi
                                        $presensi = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE nis='$nis' ORDER BY date DESC");


                                        $dari = date("Y-m-d", strtotime("+180 day", strtotime($dari))); //looping tambah 7 date

                                    ?>

                                        <?php
                                        $hari = $dari;
                                        $revivalnote = mysqli_fetch_array($pp);
                                        $biblereading = mysqli_fetch_array($alkitab);
                                        $prayernote = mysqli_fetch_array($doa);
                                        ?>

                                        <tr class="border-dark text-center">
                                            <th rowspan="3" class="border-dark">
                                                Pengembangan Diri (Kerohanian)
                                            </th>
                                            <td class="border-dark">Penyegaran Pagi<br>(saat teduh)</td>
                                            <!-- target -->
                                            <td class="border-dark">133</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"><?= $revivalnote['jumlah']; ?></td>
                                            <!-- persen -->
                                            <td class="border-dark">98</td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="border-dark">Membaca Alkitab</td>
                                            <!-- target -->
                                            <td class="border-dark">266</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"><?= $biblereading['jumlah']; ?></td>
                                            <!-- persen -->
                                            <td class="border-dark">89</td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">3</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="border-dark">Doa</td>
                                            <!-- target -->
                                            <td class="border-dark">133</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"><?= $prayernote['jumlah']; ?></td>
                                            <!-- persen -->
                                            <td class="border-dark">99</td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>



                                        <tr class="text-center">
                                            <th class="border-dark" rowspan="3">
                                                Penetapan Tujuan Belajar
                                            </th>
                                            <td class="border-dark">Kerohanian</td>
                                            <!-- target -->
                                            <td class="border-dark">38</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark">38</td>
                                            <!-- persen -->
                                            <td class="border-dark">100</td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="border-dark">Pendidikan</td>
                                            <!-- target -->
                                            <td class="border-dark">24</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark">24</td>
                                            <!-- persen -->
                                            <td class="border-dark">100</td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="border-dark">Karakter</td>
                                            <!-- target -->
                                            <td class="border-dark">38</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark">38</td>
                                            <!-- persen -->
                                            <td class="border-dark">100</td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>


                                        <tr class="text-center">
                                            <th class="border-dark" rowspan="6">
                                                Pengetahuan dan Keterampilan
                                            </th>
                                            <td class="border-dark">PDTH</td>
                                            <!-- target -->
                                            <td class="border-dark">100</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark">85</td>
                                            <!-- persen -->
                                            <td class="border-dark">85</td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">3</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="border-dark">KARAKTER</td>
                                            <!-- target -->
                                            <td class="border-dark">100</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark">85</td>
                                            <!-- persen -->
                                            <td class="border-dark">85</td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">3</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="border-dark">Alkitab</td>
                                            <!-- target -->
                                            <td class="border-dark">100</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark">85</td>
                                            <!-- persen -->
                                            <td class="border-dark">85</td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">3</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">Gitar</td>
                                            <!-- target -->
                                            <td class="border-dark">100</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark">85</td>
                                            <!-- persen -->
                                            <td class="border-dark">85</td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">3</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">Media Komunikasi</td>
                                            <!-- target -->
                                            <td class="border-dark">100</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark">95</td>
                                            <!-- persen -->
                                            <td class="border-dark">95</td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">Pameran**</td>
                                            <!-- target -->
                                            <td class="border-dark">19</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark">18</td>
                                            <!-- persen -->
                                            <td class="border-dark">95</td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <th class="border-dark">
                                                Kehadiran Kelas
                                            </th>
                                            <td class="border-dark">Kehadiran</td>
                                            <!-- target -->
                                            <td class="border-dark">1886</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark">1852</td>
                                            <!-- persen -->
                                            <td class="border-dark">98</td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>



                                        <tr class="text-center">
                                            <th rowspan="2" class="border-dark">
                                                JURNAL
                                            </th>
                                            <td class="border-dark">Home Meeting</td>
                                            <!-- target -->
                                            <td class="border-dark">19</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark">19</td>
                                            <!-- persen -->
                                            <td class="border-dark">100</td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">

                                            <td class="border-dark">Catatan Berkat</td>
                                            <!-- target -->
                                            <td class="border-dark">19</td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark">18</td>
                                            <!-- persen -->
                                            <td class="border-dark">95</td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Mencapai Target</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>


                                        <tr class="text-center">
                                            <th rowspan="11" class="border-dark">
                                                Kebajikan dan Karakter <br>(Pengamatan Mentor)
                                            </th>
                                            <td class="border-dark">Perhatian & Berbagi</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">3</td>
                                            <td class="border-dark">Sangat Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">

                                            <td class="border-dark">Tegur - Sapa - Salam</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">3</td>
                                            <td class="border-dark">Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">Bersyukur dan Berterima Kasih</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Sangat Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">Hormat & Taat</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">3</td>
                                            <td class="border-dark">Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">Ramah & Sopan</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Sangat Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">Berkordinasi</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark"></td>
                                            <td class="border-dark"></td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Sangat Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">Tolong Menolong</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Sangat Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">See & Do</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Sangat Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">Benar</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">3</td>
                                            <td class="border-dark">Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">Tepat</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">3</td>
                                            <td class="border-dark">Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">Ketat</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">B</td>
                                            <td class="border-dark">3</td>
                                            <td class="border-dark">Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <th rowspan="3" class="border-dark">
                                                Kebersihan dan Kerapian
                                            </th>
                                            <td class="border-dark">Lemari</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Sangat Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>


                                        <tr class="text-center">
                                            <td class="border-dark">Ranjang</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Sangat Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="border-dark">Rak Sepatu</td>
                                            <!-- target -->
                                            <td class="border-dark"></td>
                                            <!-- nilai akhir -->
                                            <td class="border-dark"></td>
                                            <!-- persen -->
                                            <td class="border-dark"></td>
                                            <td class="border-dark">A</td>
                                            <td class="border-dark">4</td>
                                            <td class="border-dark">Sangat Baik</td>
                                            <!-- keterangan -->
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr class="text-center">
                                            <th rowspan="2" colspan="5" class="table-secondary border-dark mb-md-3">
                                                Bobot (116)
                                            </th>
                                            <th class="border-dark">Huruf</th>
                                            <th rowspan="2" class=" table-secondary border-dark">105</th>
                                            <th class=" border-dark b table-secondary">Persentase</th>
                                            <th rowspan="2" class=" border-dark"></th>
                                        </tr>
                                        <tr class="text-center">
                                            <th class="border-dark">A</th>
                                            <th class=" border-dark table-secondary">90.52%</th>
                                        </tr>

                                        <tr>
                                            <th rowspan="3" class="border-dark text-center">
                                                Akademik<br>(Persiapan SBMPTN)
                                            </th>
                                            <th class="border-dark text-center">MATERI</th>
                                            <th class="border-dark text-center">TPA</th>
                                            <th class="border-dark text-center">TPS</th>
                                            <th class="border-dark text-center">Total</th>
                                            <th class="border-dark text-center">Rata-rata</th>
                                            <td colspan="3" rowspan="3" class="border-dark">
                                                <a class="font-weight-bold">
                                                    Keterangan:<br>
                                                </a>
                                                PDTH: Pelajaran Dasar Tentang Hayat <br>
                                                *Pengisian Jurnal<br>
                                                ** Partisipasi
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="border-dark">Tryout</td>
                                            <td class="border-dark"></td>
                                            <td class="border-dark"></td>
                                            <td class="border-dark"></td>
                                            <td class="border-dark"></td>
                                        </tr>
                                        <tr>
                                            <td class="border-dark">UTBK</td>
                                            <td class="border-dark"></td>
                                            <td class="border-dark"></td>
                                            <td class="border-dark"></td>
                                            <td class="border-dark"></td>
                                        </tr>

                                        <tr>
                                            <th colspan="9" class="border-dark">
                                                Catatan:
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="8" class="border-dark">

                                            </th>
                                            <td class="border-dark text-center">
                                                Mentor
                                                <br><br><br><br><br><br><br><br> Adi Pamungkas
                                            </td>
                                        </tr>
                                </tbody>
                                <?php $i++; ?>
                            <?php
                                    } ?>













































































                            </table>

                        </center>



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
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <?php
    include 'modal/modal_logout.php';
    include 'template/script.php';
    ?>



</body>

</html>