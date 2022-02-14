<?php
include '../database.php';
session_start();
$nis = $_GET['nis'];
$fil = $_GET['filter'];
$siswa = mysqli_query($conn, "SELECT * FROM siswa  WHERE nis='$nis' ");
$s = mysqli_fetch_array($siswa);
$semes = mysqli_query($conn, "SELECT * FROM tb_semester where thn_semester='$fil' ");
$s2 = mysqli_fetch_array($semes);
$jurnal = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point`) as jumlah FROM tb_prayer_note WHERE nis='$nis' AND semester='$fil' ");
$revivalnote = mysqli_fetch_array($jurnal);
$alkitab = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point`) as jumlah FROM tb_bible_reading WHERE nis='$nis' AND semester='$fil' ");
$pembacaanalkitab = mysqli_fetch_array($alkitab);
$doa = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point`) as jumlah FROM tb_prayer_note WHERE nis='$nis' AND semester='$fil' ");
$bebandoa = mysqli_fetch_array($doa);
$presensi = mysqli_query($conn, "SELECT SUM(`presensi`) as jumlah FROM tb_presensi WHERE nis='$nis' AND semester='$fil' ");
$kehadiran = mysqli_fetch_array($presensi);
$homemeeting = mysqli_query($conn, "SELECT SUM(`point`) as jumlah FROM tb_home_meeting WHERE nis='$nis' AND semester='$fil'  ");
$catatanberkat = mysqli_fetch_array($homemeeting);
$ask = mysqli_query($conn, "SELECT SUM(`point7`) as jumlah FROM tb_blessings WHERE nis='$nis' AND semester='$fil' ");
$konseling = mysqli_fetch_array($ask);


// personal goals
$prayer = mysqli_query($conn, "SELECT SUM(`point2`) as jumlah FROM tb_personal_goal WHERE nis='$nis' AND semester='$fil' ");
$kerohanian = mysqli_fetch_array($prayer);
$neutron = mysqli_query($conn, "SELECT SUM(`point3`) as jumlah FROM tb_personal_goal WHERE nis='$nis' ");
$pendidikan = mysqli_fetch_array($neutron);
$karakter = mysqli_query($conn, "SELECT SUM(`point1`) as jumlah FROM tb_personal_goal WHERE nis='$nis'  ");
$karakter1 = mysqli_fetch_array($karakter);


// character
$benar = mysqli_query($conn, "SELECT SUM(`benar`) as jumlah FROM tb_character WHERE nis='$nis' ");
$sikapbenar = mysqli_fetch_array($benar);
$tepat = mysqli_query($conn, "SELECT SUM(`tepat`) as jumlah FROM tb_character WHERE nis='$nis' ");
$sikaptepat = mysqli_fetch_array($tepat);
$ketat = mysqli_query($conn, "SELECT SUM(`ketat`) as jumlah FROM tb_character WHERE nis='$nis'  ");
$sikapketat = mysqli_fetch_array($ketat);

// Virtues
$sedo = mysqli_query($conn, "SELECT SUM(`sikapseedo`) as jumlah FROM tb_virtues WHERE nis='$nis'  ");
$sikapsedo = mysqli_fetch_array($sedo);
$tolongmenolong = mysqli_query($conn, "SELECT SUM(`sikaptolongmenolong`) as jumlah FROM tb_virtues WHERE nis='$nis'  ");
$sikaptolongmenolong = mysqli_fetch_array($tolongmenolong);
$berkordinasi = mysqli_query($conn, "SELECT SUM(`sikapberkordinasi`) as jumlah FROM tb_virtues WHERE nis='$nis' ");
$sikapberkordinasi = mysqli_fetch_array($berkordinasi);
$ramahsopan = mysqli_query($conn, "SELECT SUM(`sikapramahsopan`) as jumlah FROM tb_virtues WHERE nis='$nis'  ");
$sikapramahsopan = mysqli_fetch_array($ramahsopan);

// virtue dan character
$hormattaat = mysqli_query($conn, "SELECT SUM(`hormat_taat`) as jumlah FROM tb_vrtues_caharacter WHERE nis='$nis' ");
$sikaphormattaat = mysqli_fetch_array($hormattaat);
$bersyukurberterimakasih = mysqli_query($conn, "SELECT SUM(`bersyukur_berterimakasih`) as jumlah FROM tb_vrtues_caharacter WHERE nis='$nis' ");
$sikapbersyukurberterimakasih = mysqli_fetch_array($bersyukurberterimakasih);
$salamsapa = mysqli_query($conn, "SELECT SUM(`salam_sapa`) as jumlah FROM tb_vrtues_caharacter WHERE nis='$nis'  ");
$sikapsalamsapa = mysqli_fetch_array($salamsapa);
$berbagi = mysqli_query($conn, "SELECT SUM(`perhatian_berbagi`) as jumlah FROM tb_vrtues_caharacter WHERE nis='$nis'  ");
$sikapberbagi = mysqli_fetch_array($berbagi);

// total living lemari
$buku = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_buku WHERE nis='$nis' ");
$livingbuku = mysqli_fetch_array($buku);
$pakaianlipat = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_pakaianlipat WHERE nis='$nis' ");
$livingpakaianlipat = mysqli_fetch_array($pakaianlipat);
$pakaiangantung = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bentuk`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as jumlah FROM tb_living_pakaiangantung WHERE nis='$nis' ");
$livingpakaiangantung = mysqli_fetch_array($pakaiangantung);
$celana = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_celanalipat WHERE nis='$nis'  ");
$livingcelana = mysqli_fetch_array($celana);
$logistik = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as jumlah FROM tb_living_logistik WHERE nis='$nis' ");
$livinglogistik = mysqli_fetch_array($logistik);
$pakaiandalam = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_pakaiandalam WHERE nis='$nis' ");
$livingpakaiandalam = mysqli_fetch_array($pakaiandalam);
$totallivinglemari = $livingbuku['jumlah'] + $livingpakaianlipat['jumlah'] + $livingpakaiangantung['jumlah'] + $livingcelana['jumlah'] + $livinglogistik['jumlah'] + $livingpakaiandalam['jumlah'];

// total living ranjang
$ranjang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_ranjang WHERE nis='$nis'  ");
$livingranjang = mysqli_fetch_array($ranjang);
$bantal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_bantal WHERE nis='$nis' ");
$livingbantal = mysqli_fetch_array($bantal);
$seprei = mysqli_query($conn, "SELECT SUM(`rapi`)+SUM(`raib`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_seprei WHERE nis='$nis' ");
$livingseprei = mysqli_fetch_array($seprei);
$selimut = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_selimut WHERE nis='$nis' ");
$livingselimut = mysqli_fetch_array($selimut);
$totallivingranjang = $livingranjang['jumlah'] + $livingbantal['jumlah'] + $livingseprei['jumlah'] + $livingselimut['jumlah'];

// total living rak sepatu
$raksepatu = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_sepatu WHERE nis='$nis' ");
$livingraksepatu = mysqli_fetch_array($raksepatu);
$sepatusidang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_sidang WHERE nis='$nis' ");
$livingsepatusidang = mysqli_fetch_array($sepatusidang);
$sepatu_or = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_or WHERE nis='$nis' ");
$livingsepatu_or = mysqli_fetch_array($sepatu_or);
$sandal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sendal WHERE nis='$nis' ");
$livingsandal = mysqli_fetch_array($sandal);
$rakhanduk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_handuk WHERE nis='$nis' ");
$livingrakhanduk = mysqli_fetch_array($rakhanduk);
$handuk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_handuk WHERE nis='$nis' ");
$livinghanduk = mysqli_fetch_array($handuk);
$totallivingraksepatu = $livingraksepatu['jumlah'] + $livingsepatusidang['jumlah'] + $livingsepatu_or['jumlah'] + $livingsandal['jumlah'] + $livingrakhanduk['jumlah'] + $livinghanduk['jumlah'];
include 'template/Session.php';
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

                    <!-- isi konten -->
                    <h1 class="text-dark text-center font-weight-bold">Yayasan Kebenaran Alkitab</h1>
                    <p class=" text-dark text-center font-monospace">PELATIHAN PELAYANAN ROHANI “KEBENARAN ALKITAB” <br> Jalan Ngamarto 2, Lawang 65211; Telpon 0341 4301212, Fax 0341 426639 <br>Email address : pka.lawang@gmail.com <br> Keputusan Dirjen Bimas Kristen (Protestan)<br>Kementrian Agama nomor F/Kep/HK 00579/22377/99, Tgl 20-7-1999</p>
                    <h5 class="text-dark text-center font-weight-bold">LAPORAN SEMESTER PERKEMBANGAN BELAJAR SISWA PKA LAWANG</h5>
                    <p>
                        <center>
                            <table style="width: 70%">
                                <tbody>
                                    <tr>

                                        <th class="text-left">
                                            <h6>Nama : <?= $s['name']; ?> </h6>
                                            <h6>Nis : <?= $s['nis']; ?></h6>
                                        </th>
                                        <th class="text-right">
                                            <h6>Angkatan : <?= $s['angkatan']; ?></h6>
                                            <h6>Periode : <?= $s2['keterangan']; ?></h6>
                                        </th>
                                    </tr>

                                    </tr>
                                </tbody>
                            </table>
                            <!-- <p align="center"> -->
                            <table class="table table-sm table-bordered " style="width: 70%" cellspacing="0">
                                <thead class=" table-secondary border-dark">
                                    <tr class="border-dark text-center">
                                        <th class="border-dark" rowspan="2" colspan="2" width="200">ASPEK PEMBELAJARAN</th>
                                        <th class="border-dark" rowspan="2" width="210">FOKUS/MATERI PEMBELAJARAN</th>
                                        <th class="border-dark" rowspan="2" width="10">Target</th>
                                        <th class="border-dark" colspan="3" class=" text-center border-dark">Pencapaian Akhir</th>
                                        <th class="border-dark" rowspan="2">Bobot</th>
                                        <th class="border-dark" rowspan="2" width="270">Deskripsi Pelaksanaan</th>
                                        <th class="border-dark" rowspan="2" width="250">Ket.</th>

                                    </tr>
                                    <tr class=" text-center">
                                        <th class="border-dark" width="130">Nilai Akhir</th>
                                        <th class="border-dark" class=" text-center" width="10">%</th>
                                        <th class="border-dark" width="130">Huruf</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-dark text-center">
                                        <th rowspan="3" colspan="2" class="border-dark">
                                            Pengembangan Diri (Kerohanian)
                                        </th>
                                        <td class="border-dark">Penyegaran Pagi<br>(saat teduh)</td>
                                        <!-- target -->
                                        <td class="border-dark">126</td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $revivalnote['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="border-dark">Membaca Alkitab</td>
                                        <!-- target -->
                                        <td class="border-dark">266</td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $pembacaanalkitab['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="border-dark">Doa</td>
                                        <!-- target -->
                                        <td class="border-dark">133</td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $bebandoa['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>



                                    <tr class="text-center">
                                        <th class="border-dark" rowspan="3" colspan="2">
                                            Penetapan Tujuan Belajar
                                        </th>
                                        <td class="border-dark">Kerohanian</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $kerohanian['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="border-dark">Pendidikan</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $pendidikan['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="border-dark">Karakter</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"> <?= $karakter1['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>


                                    <tr class="text-center">
                                        <th class="border-dark" rowspan="11">
                                            Pengetahuan
                                        </th>
                                        <td class="border-dark" rowspan="5">KELAS VISI</td>
                                        <!-- target -->
                                        <td class="border-dark">Pelatihan</td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="border-dark">Penyegaran Pagi</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="border-dark">Alkitab</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">karakter</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">Pendidikan</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark" rowspan="2">Kelas Hayat</td>
                                        <!-- target -->
                                        <td class="border-dark">PDTH</td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">

                                        <td class="border-dark">Pengalaman Hayat</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>



                                    <tr class="text-center">
                                        <th rowspan="3" class="border-dark">
                                            Kelas Karakter
                                        </th>
                                        <td class="border-dark">Karakter (benar,ketat dan tepat) </td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">

                                        <td class="border-dark">Karakter (tokoh)</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>
                                    <tr class="text-center">

                                        <td class="border-dark">Evaluasi Karakter</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>


                                    <tr class="text-center">
                                        <th class="border-dark">
                                            Kelas Konsititusi
                                        </th>
                                        <td class="border-dark">alkitab</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>






                                    <tr class="text-center">
                                        <th rowspan="3" colspan="2" class="border-dark">
                                            Keterampilan
                                        </th>
                                        <td class="border-dark">Entrepreunership</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->

                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">

                                        <td class="border-dark">Komunikasi</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->

                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">Gitar</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"></td>
                                        <!-- persen -->

                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="border-dark text-center">
                                        <th colspan="2" class="border-dark">
                                            Kehadiran Kelas*
                                        </th>

                                        <!-- target -->
                                        <td class="border-dark">Kehadiran</td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark">828</td>
                                        <!-- persen -->
                                        <td class="border-dark"><?= $kehadiran['jumlah']; ?></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <th rowspan="2" colspan="2" class="border-dark">
                                            Jurnal
                                        </th>
                                        <td class="border-dark">Konseling</td>
                                        <!-- target -->
                                        <td class="border-dark">9</td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $konseling['jumlah']; ?></td>
                                        <!-- persen -->

                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">

                                        <td class="border-dark">Catatan Berkat</td>
                                        <!-- target -->
                                        <td class="border-dark">19</td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $catatanberkat['jumlah']; ?></td>
                                        <!-- persen -->

                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>



                                    <tr class="text-center">
                                        <th colspan="2" rowspan="11" class="border-dark">
                                            Kebajikan dan Karakter <br>(Pengamatan Mentor)
                                        </th>
                                        <td class="border-dark">Perhatian & Berbagi</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $sikapberbagi['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">Tegur - Sapa - Salam</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"> <?= $sikapsalamsapa['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">Bersyukur dan Berterima Kasih</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"><?= $sikapbersyukurberterimakasih['jumlah']; ?></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">Hormat & Taat</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $sikaphormattaat['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">Ramah & Sopan</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $sikapramahsopan['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">Berkordinasi</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $sikapberkordinasi['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark">Baik</td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">Tolong Menolong</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $sikaptolongmenolong['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">See & Do</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $sikapsedo['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">Benar</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $sikapbenar['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">Tepat</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $sikaptepat['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>

                                    <tr class="text-center">
                                        <td class="border-dark">Ketat</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $sikapketat['jumlah']; ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>














                                    <tr class="text-center">
                                        <th rowspan="3" colspan="2" class="border-dark">
                                            Kebersihan dan Kerapian
                                        </th>
                                        <td class="border-dark">Lemari</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $totallivinglemari ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <!-- keterangan -->
                                        <td class="border-dark"></td>
                                    </tr>


                                    <tr class="text-center">
                                        <td class="border-dark">Ranjang</td>
                                        <!-- target -->
                                        <td class="border-dark"></td>
                                        <!-- nilai akhir -->
                                        <td class="border-dark"><?= $totallivingranjang ?></td>
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
                                        <td class="border-dark"><?= $totallivingraksepatu ?></td>
                                        <!-- persen -->
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
                                        <td class="border-dark"></td>
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
                                        <td colspan="4" rowspan="3" class="border-dark">
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
                                        <th colspan="10" class="border-dark">
                                            Catatan:
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="8" class="border-dark">

                                        </th>
                                        <td class="border-dark text-center" colspan="2">
                                            Mentor
                                            <br><br><br><br><br><br><br><br> Adi Pamungkas
                                        </td>
                                    </tr>
                                </tbody>













































































                            </table>

                        </center>






                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <?php
                include 'template/footer.php';
                ?>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
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
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>


</body>

</html>