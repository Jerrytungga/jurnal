<?php

include '../database.php';
session_start();
include 'template/session.php';
$nis = $_GET['nis'];
$fil = $_GET['semester'];

error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['simpan'])) {
    $catatan_laporan_semester = $_POST['catatan'];
    $max_id = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_catatan`) As id FROM `tb_catatan_lp_semester`"));
    $id_max = $max_id['id'] + 1;
    $query = mysqli_query($conn, "INSERT INTO `tb_catatan_lp_semester`(`id_catatan`, `catatan`, `nis_siswa`, `efata_mentor`,`semester`) VALUES ('$id_max','$catatan_laporan_semester','$nis','$id','$fil')");
}
if (isset($_POST['edit'])) {
    $editcatatan_laporan_semester = $_POST['editcatatan'];
    $query = mysqli_query($conn, "UPDATE `tb_catatan_lp_semester` SET `catatan`='$editcatatan_laporan_semester' WHERE `nis_siswa`='$nis' and `semester`='$fil' and `efata_mentor`='$id'");
}
$siswa = mysqli_query($conn, "SELECT * FROM siswa  WHERE nis='$nis' ");
$s = mysqli_fetch_array($siswa);
$semes = mysqli_query($conn, "SELECT * FROM tb_semester where thn_semester='$fil' ");
$s2 = mysqli_fetch_array($semes);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Laporan Semester <?= $s['name']; ?></title>

    <style>
        .catatan_Mentor {

            font-size: 12pt;
            text-align: justify;


        }

        .keterangan_Catatan {
            text-align: left;
            font-size: 14pt;
            font-weight: bold;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table {
            width: 70%;
        }

        .tb2 {
            background-color: #ffff;
            border: none;
            margin-top: -20px;

        }

        th {
            background-color: #DDDDDD;
        }

        .name_nis {
            margin-bottom: 2px;
            font-size: 12pt;
        }

        .angkatan_periode {
            margin-bottom: 2px;
            font-size: 12pt;
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .page {
            margin: auto;
            text-align: center;
            font-family: "Calibri", Courier, monospace;
            width: 1200px;
            font-size: 14px;
        }

        #print table {
            border-collapse: collapse;
            width: 100%;
            margin: 10px;
        }

        .Yayasan {
            font-size: 35pt;
            margin-top: -40px;
        }

        .ket_yayasan {
            font-size: 12pt;
            margin-top: -20pt;
        }
    </style>
</head>

<body>
    <div class="page ">
        <center>
            <img style="float:center;width:300px;height:300px;" src="../img/logo/Edit Logo PKA-DP.png">
            <h1 class="Yayasan">Yayasan Kebenaran Alkitab</h1>
            <p class="ket_yayasan">PELATIHAN PELAYANAN ROHANI “KEBENARAN ALKITAB” <br> Jalan Ngamarto 2, Lawang 65211; Telpon 0341 4301212, Fax 0341 426639 <br>Email address : pka.lawang@gmail.com <br> Keputusan Dirjen Bimas Kristen (Protestan)<br>Kementrian Agama nomor F/Kep/HK 00579/22377/99, Tgl 20-7-1999</p>
            <h2>LAPORAN SEMESTER PERKEMBANGAN BELAJAR SISWA PKA LAWANG</h2>
            <p>
            <table class="tb2">
                <thead>
                    <tr>

                        <td class="tb2">
                            <h6 class="name_nis">Nama : <?= $s['name']; ?><br>
                                Nis : <?= $s['nis']; ?></h6>
                        </td>
                        <td class="tb2">
                            <h6 class="angkatan_periode">Angkatan : <?= $s['angkatan']; ?><br>
                                Periode : <?= $s2['keterangan']; ?></h6>
                        </td>
                    </tr>

                    </tr>
                </thead>
            </table>
            <!-- <p align="center"> -->
            <table>
                <thead>
                    <center>
                        <tr class="border-dark text-center">
                            <th class="border-dark" rowspan="2" colspan="2" width="200">ASPEK PEMBELAJARAN</th>
                            <th class="border-dark" rowspan="2" width="210">FOKUS/MATERI PEMBELAJARAN</th>
                            <th class="border-dark" rowspan="2" width="100">Target</th>
                            <th class="border-dark" rowspan="2" width=" 130">Pencapaian Akhir</th>
                            <th class="border-dark" colspan="2" class=" text-center border-dark">Nilai Akhir</th>
                            <th class="border-dark" width=" 130" rowspan="2">Bobot</th>
                            <th class="border-dark" rowspan="2" width="270">Deskripsi Pelaksanaan</th>
                            <th class="border-dark" rowspan="2" width="250">Ket.</th>

                        </tr>
                        <tr>

                            <th class=" text-center" width="60">%</th>
                            <th width="100">Huruf</th>
                        </tr>
                    </center>
                </thead>
                <tbody>
                    <!-- Awal script pembelajaran ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                    <tr>
                        <?php
                        $fokus_pembelajaran = mysqli_query($conn, "SELECT * FROM `tb_pengembangan_diri` WHERE semester='$fil'");
                        $cek_data = mysqli_num_rows($fokus_pembelajaran);
                        $baris = $cek_data + 1;
                        ?>
                        <td rowspan="<?= $baris ?>" colspan="2">
                            Pengembangan Diri (Kerohanian)
                        </td>
                    </tr>

                    <?php
                    while ($data_pembelajaran = mysqli_fetch_array($fokus_pembelajaran)) {
                        $namapembelajaran
                            = $data_pembelajaran['nama_pembelajaran'];
                        $target_pembelajaran
                            = $data_pembelajaran['target'];
                        $catatan = $data_pembelajaran['catatan'];
                        if ($catatan == 'tb_bible_reading') {
                            $jurnalHarian = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point`) as jumlah FROM tb_bible_reading WHERE nis='$nis' AND semester='$fil'  ");
                        } else if ($catatan == 'tb_revival_note') {
                            $jurnalHarian = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`) as jumlah FROM `" . $catatan . "` WHERE nis='$nis' AND semester='$fil' ");
                        } else {
                            $jurnalHarian = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point`) as jumlah FROM `" . $catatan . "` WHERE nis='$nis' AND semester='$fil' ");
                        }
                        $revivalnote = mysqli_fetch_array($jurnalHarian);
                        $persenjurnalHarian = $revivalnote['jumlah'] / $target_pembelajaran * 100;
                        $bulatkannilaijurnalharian = round($persenjurnalHarian);
                        if ($revivalnote['jumlah'] == NULL) {
                            $revivalnote['jumlah'] = 0;
                        }
                        if ($bulatkannilaijurnalharian >= 100) {
                            $deskripsi_jurnalharian = 'Mencapai Target';
                            $revivalnote['jumlah'] = $target_pembelajaran;
                            $bobotjurnalharian = '4';
                            $keterangan_jurnalharian = 'A';
                            $bulatkannilaijurnalharian = $target_pembelajaran;
                        } else if ($bulatkannilaijurnalharian >= 90) {
                            $deskripsi_jurnalharian = 'Mencapai Target';
                            $bobotjurnalharian = '4';
                            $keterangan_jurnalharian = 'A';
                            // $deskripsi = 'Tidak Mencapai Target';
                        } elseif ($bulatkannilaijurnalharian >= 80) {
                            $deskripsi_jurnalharian = 'Mencapai Target';
                            $bobotjurnalharian = '3';
                            $keterangan_jurnalharian = 'B';
                        } elseif ($bulatkannilaijurnalharian >= 75) {
                            $deskripsi_jurnalharian = 'Kurang Mencapai Target';
                            $bobotjurnalharian = '2';
                            $keterangan_jurnalharian = 'C';
                        } elseif ($bulatkannilaijurnalharian >= 50) {
                            $deskripsi_jurnalharian = 'Tidak Mencapai Target';
                            $bobotjurnalharian = '1';
                            $keterangan_jurnalharian = 'D';
                        }
                        if ($bulatkannilaijurnalharian == 0) {
                            $keterangan_jurnalharian = 'E';
                            $bobotjurnalharian = '0';
                            $deskripsi_jurnalharian = 'Tidak Mencapai Target';
                        }
                        $jumlah_pengembangan_diri[] = $bobotjurnalharian;
                        $total_pengembangan_diri = array_sum($jumlah_pengembangan_diri);

                    ?>

                        <tr>
                            <td class="center"><?= $namapembelajaran; ?></td>
                            <!-- target -->
                            <td class="center"><?= $target_pembelajaran; ?></td>
                            <!-- nilai akhir -->
                            <td class="center"><?= $revivalnote['jumlah']; ?></td>
                            <!-- persen -->
                            <td class="center"><?= $bulatkannilaijurnalharian ?></td>
                            <td class="center"><?= $keterangan_jurnalharian ?></td>
                            <td class="center"><?= $bobotjurnalharian ?> </td>
                            <td class="center"><?= $deskripsi_jurnalharian ?></td>
                            <!-- keterangan -->
                            <td class="center"></td>
                        </tr>
                    <?php        }

                    ?>


                    <tr>
                        <?php
                        $penetapan_tujuan_belajar = mysqli_query($conn, "SELECT * FROM `tb_penetapan_tujuan_belajar` WHERE  semester='$fil'");
                        $cek_data_tujuan = mysqli_num_rows($penetapan_tujuan_belajar);
                        $baris1 = $cek_data_tujuan + 1;
                        ?>
                        <td rowspan="<?= $baris1 ?>" colspan="2">
                            Penetapan Tujuan Belajar
                        </td>
                    </tr>

                    <?php
                    while ($data_tujuan_belajar = mysqli_fetch_array($penetapan_tujuan_belajar)) {
                        $namatujuan_belajar
                            = $data_tujuan_belajar['nama_materi_pembelajaran'];
                        $target_tujuan_belajar
                            = $data_tujuan_belajar['target'];
                        $catatan
                            = $data_tujuan_belajar['catatan'];


                        if ($catatan == 'Kerohanian') {
                            $jurnalpsg = mysqli_query($conn, "SELECT SUM(`point2`) as jumlah FROM tb_personal_goal WHERE nis='$nis' AND semester='$fil' ");
                        } else if ($catatan == 'Pendidikan') {
                            $jurnalpsg  = mysqli_query($conn, "SELECT SUM(`point3`) as jumlah FROM `tb_personal_goal` WHERE nis='$nis' AND semester='$fil' ");
                        } else {
                            $jurnalpsg  = mysqli_query($conn, "SELECT SUM(`point1`) as jumlah FROM `tb_personal_goal` WHERE nis='$nis' AND semester='$fil'  ");
                        }


                        $kerohanian = mysqli_fetch_array($jurnalpsg);
                        $persenpsg = $kerohanian['jumlah'] / $target_tujuan_belajar * 100;
                        $bulatkanpsg = round($persenpsg);
                        if ($kerohanian['jumlah'] == NULL) {
                            $kerohanian['jumlah'] = 0;
                        }
                        if ($bulatkanpsg >= 100) {
                            $kerohanian['jumlah']  = $target_tujuan_belajar;
                            $bulatkanpsg = 100;
                            $deskripsipsg = 'Mencapai Target';
                            $bobotpsg = '4';
                            $keteranganpsg = 'A';
                        } else if ($bulatkanpsg >= 90) {
                            $deskripsipsg = 'Mencapai Target';
                            $bobotpsg = '4';
                            $keteranganpsg = 'A';
                            // $deskripsipsg = 'Tidak Mencapai Target';
                        } elseif ($bulatkanpsg >= 80) {
                            $deskripsipsg = 'Mencapai Target';
                            $bobotpsg = '3';
                            $keteranganpsg = 'B';
                        } elseif ($bulatkanpsg >= 75) {
                            $deskripsipsg = 'Kurang Mencapai Target';
                            $bobotpsg = '2';
                            $keteranganpsg = 'C';
                        } elseif ($bulatkanpsg >= 50) {
                            $deskripsipsg = 'Tidak Mencapai Target';
                            $bobotpsg = '1';
                            $keteranganpsg = 'D';
                        }
                        if ($bulatkanpsg == 0) {
                            $keteranganpsg = 'E';
                            $bobotpsg = '0';
                            $deskripsipsg = 'Tidak Mencapai Target';
                        }
                        $jumlah_bobot_kerohanian[] = $bobotpsg;
                        $total_kerohanian = array_sum($jumlah_bobot_kerohanian);
                    ?>
                        <tr>
                            <td class="center"><?= $namatujuan_belajar ?></td>
                            <!-- target -->
                            <td class="center"><?= $target_tujuan_belajar ?></td>
                            <!-- nilai akhir -->
                            <td class="center"><?= $kerohanian['jumlah']; ?></td>
                            <!-- persen -->
                            <td class="center"><?= $bulatkanpsg ?></td>
                            <td class="center"><?= $keteranganpsg ?></td>
                            <td class="center"><?= $bobotpsg ?></td>
                            <td class="center"><?= $deskripsipsg ?></td>
                            <!-- keterangan -->
                            <td class="center"></td>
                        </tr>
                    <?php        }
                    ?>

                    <!-- Akhir Script Tujuan belajar ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <?php
                    $poin_kelas_visi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_poin_kelas_visi` WHERE semester='$fil' and nis_siswa='$nis'"));
                    $poin_kelas_visi['poin_kelas_pelatihan'];
                    $poin_kelas_visi['poin_kelas_penyegaran_pagi'];
                    $poin_kelas_visi['poin_kelas_alkitab'];
                    $poin_kelas_visi['poin_kelas_pendidikan'];
                    $poin_kelas_visi['poin_kelas_karakter'];
                    $kelas_visi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_visi` WHERE semester='$fil'"));
                    $kelas_visi['target_pelatihan'];
                    $kelas_visi['target_penyegaran_pagi'];
                    $kelas_visi['target_alkitab'];
                    $kelas_visi['target_karakter'];
                    $kelas_visi['target_pendidikan'];
                    $kelas_visi['bobot'];

                    $Hasil_persen = $poin_kelas_visi['poin_kelas_pelatihan'] / $kelas_visi['target_pelatihan'] * 100;
                    $bulatkan_nilai = round($Hasil_persen);
                    if ($bulatkan_nilai >= 100) {
                        $bulatkan_nilai = 100;
                        $huruf = 'A';
                        $bobot_kalas_visi = '4';
                        $poin_kelas_visi['poin_kelas_pelatihan'] = $kelas_visi['target_pelatihan'];
                        $deskripsi0 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai >= 90) {
                        $huruf = 'A';
                        $bobot_kalas_visi = '4';
                        $deskripsi0 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai >= 80) {
                        $huruf = 'B';
                        $bobot_kalas_visi = '3';
                        $deskripsi0 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai >= 75) {
                        $huruf = 'C';
                        $bobot_kalas_visi = '2';
                        $deskripsi0 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai >= 50) {
                        $huruf = 'D';
                        $bobot_kalas_visi = '1';
                        $deskripsi0 = 'Tidak Mencapai Target';
                    }

                    if ($bulatkan_nilai == 0) {
                        $huruf = 'E';
                        $bobot_kalas_visi = '0';
                        $deskripsi0 = 'Tidak Mencapai Target';
                    }
                    $jumlah_Kelas_pelatihan[] = $bobot_kalas_visi;
                    $total_pelatihan = array_sum($jumlah_Kelas_pelatihan);

                    $Hasil_persen1 = $poin_kelas_visi['poin_kelas_penyegaran_pagi'] / $kelas_visi['target_penyegaran_pagi'] * 100;
                    $bulatkan_nilai1 = round($Hasil_persen1);
                    if ($bulatkan_nilai1 > 100) {
                        $bulatkan_nilai1 = 100;
                        $huruf1 = 'A';
                        $poin_kelas_visi['poin_kelas_penyegaran_pagi'] = $kelas_visi['target_penyegaran_pagi'];
                        $bobot_kalas_visi1 = '4';
                        $deskripsi1 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai1 >= 90) {
                        $huruf1 = 'A';
                        $bobot_kalas_visi1 = '4';
                        $deskripsi1 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai1 >= 80) {
                        $huruf1 = 'B';
                        $bobot_kalas_visi1 = '3';
                        $deskripsi1 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai1 >= 75) {
                        $huruf1 = 'C';
                        $bobot_kalas_visi1 = '2';
                        $deskripsi1 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai1 >= 50) {
                        $huruf1 = 'D';
                        $bobot_kalas_visi1 = '1';
                        $deskripsi1 = 'Tidak Mencapai Target';
                    }

                    if ($bulatkan_nilai1 == 0) {
                        $huruf1 = 'E';
                        $bobot_kalas_visi1 = '0';
                        $deskripsi1 = 'Tidak Mencapai Target';
                    }



                    $jumlah_Kelas_pp[] = $bobot_kalas_visi1;
                    $total_pp = array_sum($jumlah_Kelas_pp);



                    $Hasil_persen2 = $poin_kelas_visi['poin_kelas_alkitab'] / $kelas_visi['target_alkitab'] * 100;
                    $bulatkan_nilai2 = round($Hasil_persen2);
                    if ($bulatkan_nilai2 > 100) {
                        $bulatkan_nilai2 = 100;
                        $huruf2 = 'A';
                        $poin_kelas_visi['poin_kelas_alkitab'] = $kelas_visi['target_alkitab'];
                        $bobot_kalas_visi2 = '4';
                        $deskripsi2 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai2 >= 90) {
                        $huruf2 = 'A';
                        $bobot_kalas_visi2 = '4';
                        $deskripsi2 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai2 >= 80) {
                        $huruf2 = 'B';
                        $bobot_kalas_visi2 = '3';
                        $deskripsi2 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai2 >= 75) {
                        $huruf2 = 'C';
                        $bobot_kalas_visi2 = '2';
                        $deskripsi2 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai2 >= 50) {
                        $huruf2 = 'D';
                        $bobot_kalas_visi2 = '1';
                        $deskripsi2 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai2 == 0) {
                        $huruf2 = 'E';
                        $bobot_kalas_visi2 = '0';
                        $deskripsi2 = 'Tidak Mencapai Target';
                    }


                    $jumlah_Kelas_alkitab[] = $bobot_kalas_visi2;
                    $total_alkitab = array_sum($jumlah_Kelas_alkitab);


                    $Hasil_persen3 = $poin_kelas_visi['poin_kelas_karakter'] / $kelas_visi['target_karakter'] * 100;
                    $bulatkan_nilai3 = round($Hasil_persen3);
                    if ($bulatkan_nilai3 > 100) {
                        $bulatkan_nilai3 = 100;
                        $huruf3 = 'A';
                        $poin_kelas_visi['poin_kelas_karakter'] = $kelas_visi['target_karakter'];
                        $bobot_kalas_visi3 = '4';
                        $deskripsi3 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai3 >= 90) {
                        $huruf3 = 'A';
                        $bobot_kalas_visi3 = '4';
                        $deskripsi3 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai3 >= 80) {
                        $huruf3 = 'B';
                        $bobot_kalas_visi3 = '3';
                        $deskripsi3 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai3 >= 75) {
                        $huruf3 = 'C';
                        $bobot_kalas_visi3 = '2';
                        $deskripsi3 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai3 >= 50) {
                        $huruf3 = 'D';
                        $bobot_kalas_visi3 = '1';
                        $deskripsi3 = 'Tidak Mencapai Target';
                    }

                    if ($bulatkan_nilai3 == 0) {
                        $huruf3 = 'E';
                        $bobot_kalas_visi3 = '0';
                        $deskripsi3 = 'Tidak Mencapai Target';
                    }

                    $jumlah_class_karakter[] = $bobot_kalas_visi3;
                    $total_karakter = array_sum($jumlah_class_karakter);


                    $Hasil_persen4 = $poin_kelas_visi['poin_kelas_pendidikan'] / $kelas_visi['target_pendidikan'] * 100;
                    $bulatkan_nilai4 = round($Hasil_persen4);
                    if ($bulatkan_nilai4 > 100) {
                        $bulatkan_nilai4 = 100;
                        $huruf4 = 'A';
                        $poin_kelas_visi['poin_kelas_pendidikan'] = $kelas_visi['target_pendidikan'];
                        $bobot_kalas_visi4 = '4';
                        $deskripsi4 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai4 >= 90) {
                        $huruf4 = 'A';
                        $bobot_kalas_visi4 = '4';
                        $deskripsi4 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai4 >= 80) {
                        $huruf4 = 'B';
                        $bobot_kalas_visi4 = '3';
                        $deskripsi4 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai4 >= 75) {
                        $huruf4 = 'C';
                        $bobot_kalas_visi4 = '2';
                        $deskripsi4 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai4 >= 50) {
                        $huruf4 = 'D';
                        $bobot_kalas_visi4 = '1';
                        $deskripsi4 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai4 == 0) {
                        $huruf4 = 'E';
                        $bobot_kalas_visi4 = '0';
                        $deskripsi4 = 'Tidak Mencapai Target';
                    }

                    $jumlah_Kelas_pendidikan[] = $bobot_kalas_visi4;
                    $total_pendidikan = array_sum($jumlah_Kelas_pendidikan);

                    ?>


                    <tr>
                        <th class="center" rowspan="11">
                            Pengetahuan
                        </th>
                        <td class="center" rowspan="5">KELAS VISI</td>
                        <!-- target -->
                        <td class="center">Pelatihan</td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $kelas_visi['target_pelatihan']; ?></td>
                        <!-- persen -->
                        <td class="center"><?= $poin_kelas_visi['poin_kelas_pelatihan']; ?></td>
                        <td class="center"><?= $bulatkan_nilai ?></td>
                        <td class="center"><?= $huruf ?></td>
                        <td class="center"><?= $bobot_kalas_visi ?></td>
                        <td class="center"><?= $deskripsi0 ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>
                    <tr>
                        <td class="center">Penyegaran Pagi</td>
                        <!-- target -->
                        <td class="center"><?= $kelas_visi['target_penyegaran_pagi']; ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $poin_kelas_visi['poin_kelas_penyegaran_pagi']; ?></td>
                        <!-- persen -->
                        <td class="center"><?= $bulatkan_nilai1 ?></td>
                        <td class="center"><?= $huruf1 ?></td>
                        <td class="center"><?= $bobot_kalas_visi1 ?></td>
                        <td class="center"><?= $deskripsi1 ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>
                    <tr>
                        <td class="center">Alkitab</td>
                        <!-- target -->
                        <td class="center"><?= $kelas_visi['target_alkitab']; ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $poin_kelas_visi['poin_kelas_alkitab']; ?></td>
                        <!-- persen -->
                        <td class="center"><?= $bulatkan_nilai2 ?></td>
                        <td class="center"><?= $huruf2 ?></td>
                        <td class="center"><?= $bobot_kalas_visi2 ?></td>
                        <td class="center"><?= $deskripsi2 ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>

                    <tr>
                        <td class="center">karakter</td>
                        <!-- target -->
                        <td class="center"><?= $kelas_visi['target_karakter']; ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $poin_kelas_visi['poin_kelas_karakter']; ?></td>
                        <!-- persen -->
                        <td class="center"><?= $bulatkan_nilai3 ?></td>
                        <td class="center"><?= $huruf3 ?></td>
                        <td class="center"><?= $bobot_kalas_visi3 ?></td>
                        <td class="center"><?= $deskripsi3 ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>

                    <tr>
                        <td class="center">Pendidikan</td>
                        <!-- target -->
                        <td class="center"><?= $kelas_visi['target_pendidikan']; ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $poin_kelas_visi['poin_kelas_pendidikan']; ?></td>
                        <!-- persen -->
                        <td class="center"><?= $bulatkan_nilai4 ?></td>
                        <td class="center"><?= $huruf4 ?></td>
                        <td class="center"><?= $bobot_kalas_visi4 ?></td>
                        <td class="center"><?= $deskripsi4 ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>

                    <?php
                    $kelas_hayat = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_hayat` WHERE semester='$fil'"));

                    $kelas_hayat['target_kelas_pdth'];
                    $kelas_hayat['target_kelas_pengalaman_hayat'];
                    $kelas_hayat['bobot'];

                    $ambil_poin_kelas_hayat = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_poin_kelas_hayat` WHERE semester='$fil' and nis_siswa='$nis'"));

                    $ambil_poin_kelas_hayat['poin_kelas_pdth'];
                    $ambil_poin_kelas_hayat['poin_kelas_pengalaman_hayat'];

                    $Hasil_persen5 = $ambil_poin_kelas_hayat['poin_kelas_pdth'] / $kelas_hayat['target_kelas_pdth'] * 100;
                    $bulatkan_nilai5 = round($Hasil_persen5);
                    if ($bulatkan_nilai5 >= 100) {
                        $bulatkan_nilai5 = 100;
                        $huruf5 = 'A';
                        $ambil_poin_kelas_hayat['poin_kelas_pdth'] = $kelas_hayat['target_kelas_pdth'];
                        $bobot_kalas_hayat = '4';
                        $deskripsi5 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai5 >= 90) {
                        $huruf5 = 'A';
                        $bobot_kalas_hayat = '4';
                        $deskripsi5 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai5 >= 80) {
                        $huruf5 = 'B';
                        $bobot_kalas_hayat = '3';
                        $deskripsi5 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai5 >= 75) {
                        $huruf5 = 'C';
                        $bobot_kalas_hayat = '2';
                        $deskripsi5 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai5 >= 50) {
                        $huruf5 = 'D';
                        $bobot_kalas_hayat = '1';
                        $deskripsi5 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai5 == 0) {
                        $huruf5 = 'E';
                        $bobot_kalas_hayat = '0';
                        $deskripsi5 = 'Tidak Mencapai Target';
                    }

                    $jumlah_Kelas_pdth[] =  $bobot_kalas_hayat;
                    $total_pdth = array_sum($jumlah_Kelas_pdth);


                    $Hasil_persen6 = $ambil_poin_kelas_hayat['poin_kelas_pengalaman_hayat'] / $kelas_hayat['target_kelas_pengalaman_hayat'] * 100;
                    $bulatkan_nilai6 = round($Hasil_persen6);
                    if ($bulatkan_nilai6 >= 100) {
                        $bulatkan_nilai6 = 100;
                        $huruf6 = 'A';
                        $ambil_poin_kelas_hayat['poin_kelas_pengalaman_hayat'] = $kelas_hayat['target_kelas_pengalaman_hayat'];
                        $bobot_kalas_hayat6 = '4';
                        $deskripsi6 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai6 >= 90) {
                        $huruf6 = 'A';
                        $bobot_kalas_hayat6 = '4';
                        $deskripsi6 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai6 >= 80) {
                        $huruf6 = 'B';
                        $bobot_kalas_hayat6 = '3';
                        $deskripsi6 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai6 >= 75) {
                        $huruf6 = 'C';
                        $bobot_kalas_hayat6 = '2';
                        $deskripsi6 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai6 >= 50) {
                        $huruf6 = 'D';
                        $bobot_kalas_hayat6 = '1';
                        $deskripsi6 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai6 == 0) {
                        $huruf6 = 'E';
                        $bobot_kalas_hayat6 = '0';
                        $deskripsi6 = 'Tidak Mencapai Target';
                    }


                    $jumlah_Kelas_pengalaman_pdth[] =  $bobot_kalas_hayat6;
                    $total_pengalaman_pdth = array_sum($jumlah_Kelas_pengalaman_pdth);
                    // $total_kelas_hayat = $total_pdth + $total_pengalaman_pdth;


                    ?>
                    <tr>
                        <td class="center" rowspan="2">Kelas Hayat</td>
                        <!-- target -->
                        <td class="center">PDTH</td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $kelas_hayat['target_kelas_pdth']; ?></td>
                        <td class="center"><?= $ambil_poin_kelas_hayat['poin_kelas_pdth']; ?></td>
                        <!-- persen -->
                        <td class="center"><?= $bulatkan_nilai5 ?></td>
                        <td class="center"><?= $huruf5 ?></td>
                        <td class="center"><?= $bobot_kalas_hayat ?></td>
                        <td class="center"><?= $deskripsi5 ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>

                    <tr>

                        <td class="center">Pengalaman Hayat</td>
                        <!-- target -->
                        <td class="center"><?= $kelas_hayat['target_kelas_pengalaman_hayat']; ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $ambil_poin_kelas_hayat['poin_kelas_pengalaman_hayat']; ?></td>
                        <!-- persen -->
                        <td class="center"><?= $bulatkan_nilai6 ?></td>
                        <td class="center"><?= $huruf6 ?></td>
                        <td class="center"><?= $bobot_kalas_hayat6 ?></td>
                        <td class="center"><?= $deskripsi6 ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>

                    <?php
                    $t_kelas_karakter = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_karakter` WHERE semester='$fil'"));
                    $t_kelas_karakter['target_kelas_karakter'];
                    $t_kelas_karakter['target_karakter_tokoh'];
                    $t_kelas_karakter['target_evaluasi_karakter'];
                    $t_kelas_karakter['bobot'];
                    ?>

                    <?php
                    $ambil_poin_kelas_karakter = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_poin_kelas_karakter WHERE nis_siswa='$nis' and semester='$fil'"));
                    $ambil_poin_kelas_karakter['poin_kelas_karakter'];
                    $ambil_poin_kelas_karakter['poin_kelas_karakter_tokoh'];
                    $ambil_poin_kelas_karakter['poin_evaluasi_karakter'];

                    $Hasil_persen7 = $ambil_poin_kelas_karakter['poin_kelas_karakter'] /
                        $t_kelas_karakter['target_kelas_karakter'] * 100;
                    $bulatkan_nilai7 = round($Hasil_persen7);
                    if ($bulatkan_nilai7 >= 100) {
                        $bulatkan_nilai7 = 100;
                        $huruf7 = 'A';
                        $ambil_poin_kelas_karakter['poin_kelas_karakter'] = $t_kelas_karakter['target_kelas_karakter'];
                        $bobot_kelas_karakter = '4';
                        $deskripsi7 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai7 >= 90) {
                        $huruf7 = 'A';
                        $bobot_kelas_karakter = '4';
                        $deskripsi7 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai7 >= 80) {
                        $huruf7 = 'B';
                        $bobot_kelas_karakter = '3';
                        $deskripsi7 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai7 >= 75) {
                        $huruf7 = 'C';
                        $bobot_kelas_karakter = '2';
                        $deskripsi7 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai7 >= 50) {
                        $huruf7 = 'D';
                        $bobot_kelas_karakter = '1';
                        $deskripsi7 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai7 == 0) {
                        $huruf7 = 'E';
                        $bobot_kelas_karakter = '0';
                        $deskripsi7 = 'Tidak Mencapai Target';
                    }
                    $jumlah_Kelas_karakter[] =  $bobot_kelas_karakter;
                    $total_kelas_karakter = array_sum($jumlah_Kelas_karakter);



                    $Hasil_persen8 = $ambil_poin_kelas_karakter['poin_kelas_karakter_tokoh'] /
                        $t_kelas_karakter['target_karakter_tokoh'] * 100;
                    $bulatkan_nilai8 = round($Hasil_persen8);
                    if ($bulatkan_nilai8 >= 100) {
                        $bulatkan_nilai8 = 100;
                        $huruf8 = 'A';
                        $ambil_poin_kelas_karakter['poin_kelas_karakter_tokoh'] = $t_kelas_karakter['target_karakter_tokoh'];
                        $bobot_kalas_karakter_tokoh = '4';
                        $deskripsi8 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai8 >= 90) {
                        $huruf8 = 'A';
                        $bobot_kalas_karakter_tokoh = '4';
                        $deskripsi8 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai8 >= 80) {
                        $huruf8 = 'B';
                        $bobot_kalas_karakter_tokoh = '3';
                        $deskripsi8 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai8 >= 75) {
                        $huruf8 = 'C';
                        $bobot_kalas_karakter_tokoh = '2';
                        $deskripsi8 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai8 >= 50) {
                        $huruf8 = 'D';
                        $bobot_kalas_karakter_tokoh = '1';
                        $deskripsi8 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai8 == 0) {
                        $huruf8 = 'E';
                        $bobot_kalas_karakter_tokoh = '0';
                        $deskripsi8 = 'Tidak Mencapai Target';
                    }

                    $jumlah_Kelas_karakter1[] =  $bobot_kalas_karakter_tokoh;
                    $total_kelas_tokohkarakter = array_sum($jumlah_Kelas_karakter1);

                    $Hasil_persen9 = $ambil_poin_kelas_karakter['poin_evaluasi_karakter'] /
                        $t_kelas_karakter['target_evaluasi_karakter'] * 100;
                    $bulatkan_nilai9 = round($Hasil_persen9);
                    if ($bulatkan_nilai9 >= 100) {
                        $bulatkan_nilai9 = 100;
                        $huruf9 = 'A';
                        $ambil_poin_kelas_karakter['poin_evaluasi_karakter'] = $t_kelas_karakter['target_evaluasi_karakter'];
                        $bobot_kalas_karakter_evaluasi = '4';
                        $deskripsi9 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai9 >= 90) {
                        $huruf9 = 'A';
                        $bobot_kalas_karakter_evaluasi = '4';
                        $deskripsi9 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai9 >= 80) {
                        $huruf9 = 'B';
                        $bobot_kalas_karakter_evaluasi = '3';
                        $deskripsi9 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai9 >= 75) {
                        $huruf9 = 'C';
                        $bobot_kalas_karakter_evaluasi = '2';
                        $deskripsi9 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai9 >= 50) {
                        $huruf9 = 'D';
                        $bobot_kalas_karakter_evaluasi = '1';
                        $deskripsi9 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai9 == 0) {
                        $huruf9 = 'E';
                        $bobot_kalas_karakter_evaluasi = '0';
                        $deskripsi9 = 'Tidak Mencapai Target';
                    }
                    $jumlah_Kelas_karakter2[] =  $bobot_kalas_karakter_evaluasi;
                    $total_kelas_evaluasikarakter = array_sum($jumlah_Kelas_karakter2);

                    ?>

                    <tr>
                        <th rowspan="3" class="center">
                            Kelas Karakter
                        </th>
                        <td class="center">Karakter (benar,ketat dan tepat) </td>
                        <!-- target -->
                        <td class="center"><?= $t_kelas_karakter['target_kelas_karakter']; ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $ambil_poin_kelas_karakter['poin_kelas_karakter']; ?></td>
                        <!-- persen -->
                        <td class="center"><?= $bulatkan_nilai7 ?></td>
                        <td class="center"><?= $huruf7 ?></td>
                        <td class="center"><?= $bobot_kelas_karakter ?></td>
                        <td class="center"><?= $deskripsi7 ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>

                    <tr>

                        <td class="center">Karakter (tokoh)</td>
                        <!-- target -->
                        <td class="center"><?= $t_kelas_karakter['target_karakter_tokoh']; ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $ambil_poin_kelas_karakter['poin_kelas_karakter_tokoh']; ?></td>
                        <!-- persen -->
                        <td class="center"><?= $bulatkan_nilai8 ?></td>
                        <td class="center"><?= $huruf8 ?></td>
                        <td class="center"><?= $bobot_kalas_karakter_tokoh ?></td>
                        <td class="center"><?= $deskripsi8 ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>
                    <tr>

                        <td>Evaluasi Karakter</td>
                        <!-- target -->
                        <td class="center"><?= $t_kelas_karakter['target_evaluasi_karakter']; ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $ambil_poin_kelas_karakter['poin_evaluasi_karakter']; ?></td>
                        <!-- persen -->
                        <td class="center"><?= $bulatkan_nilai9 ?></td>
                        <td class="center"><?= $huruf9 ?></td>
                        <td class="center"><?= $bobot_kalas_karakter_evaluasi ?></td>
                        <td class="center"><?= $deskripsi9 ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>


                    <?php
                    $kelas_konsititusi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_kelas_konstitusi` WHERE semester='$fil'"));
                    $kelas_konsititusi['target_kelas_alkitab'];
                    $kelas_konsititusi['bobot'];
                    $ambil_poin_kelas_konsititusi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_poin_kelas_konsititusi WHERE nis_siswa='$nis' and semester='$fil'"));
                    $ambil_poin_kelas_konsititusi['poin_alkitab'];

                    $Hasil_persen10 = $ambil_poin_kelas_konsititusi['poin_alkitab'] / $kelas_konsititusi['target_kelas_alkitab'] * 100;

                    $bulatkan_nilai10 = round($Hasil_persen10);

                    if ($bulatkan_nilai10 >= 100) {
                        $bulatkan_nilai10 = 100;
                        $huruf10 = 'A';
                        $ambil_poin_kelas_konsititusi['poin_alkitab'] = $kelas_konsititusi['target_kelas_alkitab'];
                        $bobot_poin_kelas_alkitab = '4';
                        $deskripsi10 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai10 >= 90) {
                        $huruf10 = 'A';
                        $bobot_poin_kelas_alkitab = '4';
                        $deskripsi10 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai10 >= 80) {
                        $huruf10 = 'B';
                        $bobot_poin_kelas_alkitab = '3';
                        $deskripsi10 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai10 >= 75) {
                        $huruf10 = 'C';
                        $bobot_poin_kelas_alkitab = '2';
                        $deskripsi10 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai10 >= 50) {
                        $huruf10 = 'D';
                        $bobot_poin_kelas_alkitab = '1';
                        $deskripsi10 = 'Tidak Mencapai Target';
                    }

                    if ($bulatkan_nilai10 ==  0) {
                        $huruf10 = 'E';
                        $bobot_poin_kelas_alkitab = '0';
                        $deskripsi10 = 'Tidak Mencapai Target';
                    }
                    $jumlah_konsititusi[] =  $bobot_poin_kelas_alkitab;
                    $total_kelas_konsititusi = array_sum($jumlah_konsititusi);

                    ?>

                    <tr>
                        <td>
                            Kelas Konsititusi
                        </td>
                        <td>alkitab</td>
                        <!-- target -->
                        <td class="center"><?= $kelas_konsititusi['target_kelas_alkitab']; ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $ambil_poin_kelas_konsititusi['poin_alkitab'] ?></td>
                        <!-- persen -->
                        <td class="center"><?= $bulatkan_nilai10 ?></td>
                        <td class="center"><?= $huruf10 ?></td>
                        <td class="center"><?= $bobot_poin_kelas_alkitab ?></td>
                        <td class="center"><?= $deskripsi10  ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>





                    <?php
                    $keterampilan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_keterampilan` WHERE semester='$fil'"));
                    $t_komunikasi = $keterampilan['target_komunikasi'];
                    $t_gitar = $keterampilan['target_gitar'];
                    $t_Entrepreunership = $keterampilan['target_entrepreunership'];
                    $bobot_keterampilan = $keterampilan['bobot'];


                    $ambil_poin_keterampilan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_kelas_keterampilan` WHERE nis_siswa='$nis' And semester='$fil'"));
                    $ambil_poin_keterampilan['poin_kelas_entrepreunership'];
                    $ambil_poin_keterampilan['poin_kelas_komunikasi'];
                    $ambil_poin_keterampilan['poin_kelas_gitar'];

                    $Hasil_persen11 =
                        $ambil_poin_keterampilan['poin_kelas_entrepreunership'] /
                        $t_Entrepreunership * 100;

                    $bulatkan_nilai11 = round($Hasil_persen11);
                    if ($bulatkan_nilai11 >= 100) {
                        $bulatkan_nilai11 = 100;
                        $huruf11 = 'A';
                        $ambil_poin_keterampilan['poin_kelas_entrepreunership'] = $t_Entrepreunership;
                        $bobot_poin_kelas_unership = '4';
                        $deskripsi11 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai11 >= 90) {
                        $huruf11 = 'A';
                        $bobot_poin_kelas_unership = '4';
                        $deskripsi11 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai11 >= 80) {
                        $huruf11 = 'B';
                        $bobot_poin_kelas_unership = '3';
                        $deskripsi11 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai11 >= 75) {
                        $huruf11 = 'C';
                        $bobot_poin_kelas_unership = '2';
                        $deskripsi11 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai11 >= 50) {
                        $huruf11 = 'D';
                        $bobot_poin_kelas_unership = '1';
                        $deskripsi11 = 'Tidak Mencapai Target';
                    }

                    if ($bulatkan_nilai11 == 0) {
                        $huruf11 = 'E';
                        $bobot_poin_kelas_unership = '0';
                        $deskripsi11 = 'Tidak Mencapai Target';
                    }


                    $jumlah_unership[] =  $bobot_poin_kelas_unership;
                    $total_kelas_entrepreunership = array_sum($jumlah_unership);


                    $Hasil_persen12 =
                        $ambil_poin_keterampilan['poin_kelas_komunikasi'] /
                        $t_komunikasi  * 100;

                    $bulatkan_nilai12 = round($Hasil_persen12);
                    if ($bulatkan_nilai12 >= 100) {
                        $bulatkan_nilai12 = 100;
                        $huruf12 = 'A';
                        $ambil_poin_keterampilan['poin_kelas_komunikasi'] = $t_komunikasi;
                        $bobot_poin_kelas_komunikasi = '4';
                        $deskripsi12 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai12 >= 90) {
                        $huruf12 = 'A';
                        $bobot_poin_kelas_komunikasi = '4';
                        $deskripsi12 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai12 >= 80) {
                        $huruf12 = 'B';
                        $bobot_poin_kelas_komunikasi = '3';
                        $deskripsi12 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai12 >= 75) {
                        $huruf12 = 'C';
                        $bobot_poin_kelas_komunikasi = '2';
                        $deskripsi12 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai12 >= 50) {
                        $huruf12 = 'D';
                        $bobot_poin_kelas_komunikasi = '1';
                        $deskripsi12 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai12 == 0) {
                        $huruf12 = 'E';
                        $bobot_poin_kelas_komunikasi = '0';
                        $deskripsi12 = 'Tidak Mencapai Target';
                    }


                    $jumlah_komunikasi[] =  $bobot_poin_kelas_komunikasi;
                    $total_kelas_komunikasi = array_sum($jumlah_komunikasi);


                    $Hasil_persen13 = $ambil_poin_keterampilan['poin_kelas_gitar'] /  $t_gitar  * 100;
                    $bulatkan_nilai13 = round($Hasil_persen13);

                    if ($bulatkan_nilai13 >= 100) {
                        $bulatkan_nilai13 = 100;
                        $huruf13 = 'A';
                        $ambil_poin_keterampilan['poin_kelas_gitar'] = $t_gitar;
                        $bobot_poin_kelas_gitar = '4';
                        $deskripsi13 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai13 >= 90) {
                        $huruf13 = 'A';
                        $bobot_poin_kelas_gitar = '4';
                        $deskripsi13 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai13 >= 80) {
                        $huruf13 = 'B';
                        $bobot_poin_kelas_gitar = '3';
                        $deskripsi13 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai13 >= 75) {
                        $huruf13 = 'C';
                        $bobot_poin_kelas_gitar = '2';
                        $deskripsi13 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai13 >= 50) {
                        $huruf13 = 'D';
                        $bobot_poin_kelas_gitar = '1';
                        $deskripsi13 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai13 == 0) {
                        $huruf13 = 'E';
                        $bobot_poin_kelas_gitar = '0';
                        $deskripsi13 = 'Tidak Mencapai Target';
                    }

                    $jumlah_gitar[] =  $bobot_poin_kelas_gitar;
                    $total_kelas_gitar = array_sum($jumlah_gitar);




                    ?>

                    <tr>
                        <td rowspan="3" colspan="2">
                            Keterampilan
                        </td>
                        <td>Entrepreunership</td>
                        <!-- target -->
                        <td class="center"><?= $t_Entrepreunership ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $ambil_poin_keterampilan['poin_kelas_entrepreunership']; ?></td>
                        <!-- persen -->

                        <td class="center"><?= $bulatkan_nilai11 ?></td>
                        <td class="center"><?= $huruf11 ?></td>
                        <td class="center"><?= $bobot_poin_kelas_unership ?></td>
                        <td class="center"><?= $deskripsi11  ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>

                    <tr>

                        <td>Komunikasi</td>
                        <!-- target -->
                        <td class="center"><?= $t_komunikasi ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $ambil_poin_keterampilan['poin_kelas_komunikasi']; ?></td>
                        <!-- persen -->

                        <td class="center"><?= $bulatkan_nilai12 ?></td>
                        <td class="center"><?= $huruf12 ?></td>
                        <td class="center"><?= $bobot_poin_kelas_komunikasi ?></td>
                        <td class="center"><?= $deskripsi12  ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>

                    <tr>
                        <td>Gitar</td>
                        <!-- target -->
                        <td class="center"><?= $t_gitar ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $ambil_poin_keterampilan['poin_kelas_gitar']; ?></td>
                        <!-- persen -->

                        <td class="center"><?= $bulatkan_nilai13 ?></td>
                        <td class="center"><?= $huruf13 ?></td>
                        <td class="center"><?= $bobot_poin_kelas_gitar ?></td>
                        <td class="center"><?= $deskripsi13  ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>

                    <tr>
                        <?php
                        $kehadiran_kelas = mysqli_query($conn, "SELECT * FROM `tb_kehadiran_kelas` WHERE semester='$fil'");
                        $cek_data_kehadiran = mysqli_num_rows($kehadiran_kelas);
                        $baris = $cek_data_kehadiran + 1;
                        ?>
                        <td rowspan="<?= $baris ?>" colspan="2">
                            Kehadiran Kelas*
                        </td>
                    </tr>
                    <?php
                    while ($data_kehadiran_siswa = mysqli_fetch_array($kehadiran_kelas)) {

                        $target_kehadiran
                            = $data_kehadiran_siswa['target'];
                        $catatan
                            = $data_tujuan_belajar['catatan'];

                        $presensi = mysqli_query($conn, "SELECT SUM(`presensi`) as jumlah FROM tb_presensi WHERE nis='$nis' AND semester='$fil' ");

                        $kehadiran = mysqli_fetch_array($presensi);
                        $persen = $kehadiran['jumlah'] / $target_kehadiran * 100;
                        $bulatkan = round($persen);
                        if ($kehadiran['jumlah'] == NULL) {
                            $kehadiran['jumlah'] = 0;
                        }

                        if ($bulatkan >= 100) {
                            $deskripsi = 'Mencapai Target';
                            $bulatkan = 100;
                            $kehadiran['jumlah'] = $target_kehadiran;
                            $bobot_ = '4';
                        } else if ($bulatkan >= 90) {
                            $deskripsi = 'Mencapai Target';
                            $bobot_ = '4';
                            $keterangan_ = 'A';
                            // $deskripsi = 'Tidak Mencapai Target';
                        } elseif ($bulatkan >= 80) {
                            $deskripsi = 'Mencapai Target';
                            $bobot_ = '3';
                            $keterangan_ = 'B';
                        } elseif ($bulatkan >= 75) {
                            $deskripsi = 'Kurang Mencapai Target';
                            $bobot_ = '2';
                            $keterangan_ = 'C';
                        } elseif ($bulatkan >= 50) {
                            $deskripsi = 'Tidak Mencapai Target';
                            $bobot_ = '1';
                            $keterangan_ = 'D';
                        }
                        if ($bulatkan == 0) {
                            $deskripsi = 'Tidak Mencapai Target';
                            $bobot_ = '0';
                            $keterangan_ = 'E';
                        }
                        $jumlah_presensi[] = $bobot_;
                        $total_presensi = array_sum($jumlah_presensi);
                    ?>
                        <tr class="border-dark text-center">

                            <!-- target -->
                            <td>Kehadiran</td>
                            <!-- nilai akhir -->
                            <td class="center"><?= $target_kehadiran ?></td>
                            <!-- persen -->
                            <td class="center"><?= $kehadiran['jumlah']; ?></td>
                            <td class="center"><?= $bulatkan ?></td>
                            <td class="center"><?= $keterangan_ ?></td>
                            <td class="center"><?= $bobot_  ?></td>
                            <!-- keterangan -->
                            <td class="center"><?= $deskripsi ?></td>
                            <td class="center"></td>
                        </tr>


                    <?php
                    }
                    ?>

                    <tr>
                        <?php
                        $tb_jurnal = mysqli_query($conn, "SELECT * FROM `tb_jurnal` WHERE semester='$fil'");
                        $cek_data_jurnal = mysqli_num_rows($tb_jurnal);
                        $baris = $cek_data_jurnal + 1;
                        ?>
                        <?php
                        if ($cek_data_jurnal > 0) { ?>
                            <th class="border-dark" rowspan="<?= $baris ?>" colspan="2">
                                Jurnal
                            </th>
                        <?php }
                        ?>
                    </tr>
                    <?php
                    while ($data_jurnal = mysqli_fetch_array($tb_jurnal)) {
                        $keteranganjurnal = $data_jurnal['nama_jurnal'];
                        $target_jurnal = $data_jurnal['target'];
                        $catatanbl = $data_jurnal['catatan'];
                        if ($catatanbl == 'tb_blessings') {
                            $jurnalbl = mysqli_query($conn, "SELECT SUM(`point7`) as jumlah FROM `" . $catatanbl . "` WHERE nis='$nis' AND semester='$fil' ");
                        } else {
                            $jurnalbl = mysqli_query($conn, "SELECT SUM(`point`) as jumlah FROM `" . $catatanbl . "` WHERE nis='$nis' AND semester='$fil'  ");
                        }
                        $konseling = mysqli_fetch_array($jurnalbl);
                        $persen_jurnalbl = $konseling['jumlah'] / $target_jurnal * 100;
                        $bulatkanbl = round($persen_jurnalbl);

                        if ($bulatkanbl >= 100) {
                            $konseling['jumlah'] = $target_jurnal;
                            $huruf_bl = 'A';
                            $bulatkanbl = 100;
                            $botobl = '4';
                            $deskripsibl = 'Mencapai Target';
                        } elseif ($bulatkanbl >= 90) {
                            $deskripsibl = 'Mencapai Target';
                            $huruf_bl = 'A';
                            $botobl = '4';
                        } elseif ($bulatkanbl >= 80) {
                            $deskripsibl = 'Mencapai Target';
                            $huruf_bl = 'B';
                            $botobl = '3';
                        } elseif ($bulatkanbl >= 75) {
                            $deskripsibl = 'Kurang Mencapai Target';
                            $huruf_bl = 'C';
                            $botobl = '2';
                        } elseif ($bulatkanbl >= 60) {
                            $deskripsibl = 'Kurang Mencapai Target';
                            $huruf_bl = 'D';
                            $botobl = '1';
                        } elseif ($bulatkanbl >= 50 || $bulatkanbl < 50) {
                            $deskripsibl = 'Tidak Mencapai Target';
                            $huruf_bl = 'E';
                            $botobl = '0';
                        }

                        $jumlah_jurnal[] = $botobl;
                        $total_jurnal = array_sum($jumlah_jurnal);
                    ?>

                        <tr>
                            <td><?= $keteranganjurnal ?></td>
                            <!-- target -->
                            <td class="center"><?= $target_jurnal ?></td>
                            <!-- nilai akhir -->
                            <td class="center"><?= $konseling['jumlah']; ?></td>
                            <!-- persen -->

                            <td class="center"><?= $bulatkanbl ?></td>
                            <td class="center"><?= $huruf_bl ?></td>
                            <td class="center"><?= $botobl ?></td>
                            <td class="center"><?= $deskripsibl ?></td>
                            <!-- keterangan -->
                            <td class="center"></td>
                        </tr>

                    <?php
                    }
                    ?>




                    <tr>
                        <?php
                        $pengamatan_M = mysqli_query($conn, "SELECT * FROM `tb_pengamatan_mentor` WHERE semester='$fil'");
                        $cek_pengamatan = mysqli_num_rows($pengamatan_M);
                        $baris = $cek_pengamatan + 1;
                        ?>
                        <?php
                        if ($cek_pengamatan > 0) { ?>
                            <th class="border-dark" rowspan="<?= $baris ?>" colspan="2">
                                Kebajikan dan Karakter <br>(Pengamatan Mentor)
                            </th>
                        <?php     }

                        ?>
                    </tr>

                    <?php
                    while ($datapengamatan = mysqli_fetch_array($pengamatan_M)) {
                        $keterangan_pengamatan
                            = $datapengamatan['nama_pengamatan_mentor'];
                        $target_pengamatan
                            = $datapengamatan['target'];

                        $catatan
                            = $datapengamatan['catatan'];

                        if ($catatan == 'Perhatian_berbagi') {
                            $jurnal_pengamatan = mysqli_query($conn, "SELECT SUM(`perhatian_berbagi`) as jumlah FROM `tb_vrtues_caharacter` WHERE nis='$nis' and semester='$fil' ");
                        } else if ($catatan == 'salam_sapa') {
                            $jurnal_pengamatan  = mysqli_query($conn, "SELECT SUM(`salam_sapa`) as jumlah FROM `tb_vrtues_caharacter`  WHERE nis='$nis' and semester='$fil' ");
                        } elseif ($catatan == 'bersyukur_berterimakasih') {
                            $jurnal_pengamatan = mysqli_query($conn, "SELECT SUM(`bersyukur_berterimakasih`) as jumlah FROM `tb_vrtues_caharacter`  WHERE nis='$nis' and semester='$fil' ");
                        } elseif ($catatan == 'hormat_taat') {
                            $jurnal_pengamatan = mysqli_query($conn, "SELECT SUM(`hormat_taat`) as jumlah FROM `tb_vrtues_caharacter` WHERE nis='$nis' and semester='$fil'");
                        } elseif ($catatan == 'sikapramahsopan') {
                            $jurnal_pengamatan  = mysqli_query($conn, "SELECT SUM(`sikapramahsopan`) as jumlah FROM tb_virtues WHERE nis='$nis'  and semester='$fil'");
                        } elseif ($catatan == 'sikapberkordinasi') {
                            $jurnal_pengamatan = mysqli_query($conn, "SELECT SUM(`sikapberkordinasi`) as jumlah FROM tb_virtues WHERE nis='$nis' and semester='$fil'");
                        } elseif ($catatan == 'sikaptolongmenolong') {
                            $jurnal_pengamatan = mysqli_query($conn, "SELECT SUM(`sikaptolongmenolong`) as jumlah FROM tb_virtues WHERE nis='$nis' and semester='$fil' ");
                        } elseif ($catatan == 'sikapseedo') {
                            $jurnal_pengamatan = mysqli_query($conn, "SELECT SUM(`sikapseedo`) as jumlah FROM tb_virtues WHERE nis='$nis'  and semester='$fil'");
                        } elseif ($catatan == 'benar') {
                            $jurnal_pengamatan = mysqli_query($conn, "SELECT SUM(`benar`) as jumlah FROM tb_character WHERE nis='$nis' and semester='$fil'");
                        } elseif ($catatan == 'tepat') {
                            $jurnal_pengamatan = mysqli_query($conn, "SELECT SUM(`tepat`) as jumlah FROM tb_character WHERE nis='$nis' and semester='$fil'");
                        } elseif ($catatan == 'ketat') {
                            $jurnal_pengamatan = mysqli_query($conn, "SELECT SUM(`ketat`) as jumlah FROM tb_character WHERE nis='$nis' and semester='$fil'");
                        }
                        $sikapberbagi = mysqli_fetch_array($jurnal_pengamatan);
                        $_pengamatan = $sikapberbagi['jumlah'] / $target_pengamatan * 100;
                        $bulatkan_pengamatan = round($_pengamatan);
                        if ($bulatkan_pengamatan >= 100) {
                            $sikapberbagi['jumlah'] = $target_pengamatan;
                            $huruf_pengamatan = 'A';
                            $bobot_pengamatan = '4';
                            $ket_pengamatan = 'Sangat Baik';
                            $bulatkan_pengamatan = 100;
                        } elseif ($bulatkan_pengamatan >= 90) {
                            $huruf_pengamatan = 'A';
                            $bobot_pengamatan = '4';
                            $ket_pengamatan = 'Sangat Baik';
                        } elseif ($bulatkan_pengamatan >= 80) {
                            $huruf_pengamatan = 'B';
                            $bobot_pengamatan = '3';
                            $ket_pengamatan = 'Cukup Baik';
                        } elseif ($bulatkan_pengamatan >= 75) {
                            $huruf_pengamatan = 'C';
                            $bobot_pengamatan = '2';
                            $ket_pengamatan = 'Kurang Baik';
                        } elseif ($bulatkan_pengamatan >= 60) {
                            $huruf_pengamatan = 'D';
                            $bobot_pengamatan = '1';
                            $ket_pengamatan = 'Tidak Baik';
                        } elseif ($bulatkan_pengamatan >= 50 || $bulatkan_pengamatan < 50) {
                            $huruf_pengamatan = 'E';
                            $bobot_pengamatan = '0';
                            $ket_pengamatan = 'Tidak Baik';
                        }
                        $jumlah_sikapberbagi[] = $bobot_pengamatan;
                        $total_sikapberbagi = array_sum($jumlah_sikapberbagi);
                    ?>

                        <tr>
                            <td><?= $keterangan_pengamatan ?></td>
                            <!-- target -->
                            <td class="center"><?= $target_pengamatan ?></td>
                            <td class="center"><?= $sikapberbagi['jumlah']; ?></td>
                            <td class="center"><?= $bulatkan_pengamatan ?></td>
                            <td class="center"><?= $huruf_pengamatan ?></td>
                            <td class="center"><?= $bobot_pengamatan ?></td>
                            <td class="center"><?= $ket_pengamatan ?></td>
                            <td class="center"></td>
                        </tr>
                    <?php
                    }
                    ?>












                    <tr>
                        <?php
                        $kebersihan_kerapian = mysqli_query($conn, "SELECT * FROM `tb_kebersihan_kerapian` WHERE semester='$fil'");
                        $cek_kebersihan_kerapian = mysqli_num_rows($kebersihan_kerapian);
                        $baris = $cek_kebersihan_kerapian + 1;
                        ?>
                        <td rowspan="<?= $baris ?>" colspan="2">
                            Kebersihan dan Kerapian
                        </td>
                    </tr>
                    <?php
                    while ($data_kebersihan = mysqli_fetch_array($kebersihan_kerapian)) {
                        $nama_kebersihan = $data_kebersihan['nama_kebersihan_kerapian'];
                        $target_kebersihan = $data_kebersihan['target'];
                        $catatan = $data_kebersihan['catatan'];
                        if ($catatan == 'Lemari') {
                            // Living Lemari
                            $buku = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_buku WHERE nis='$nis' and semester='$fil'");
                            $livingbuku = mysqli_fetch_array($buku);
                            $pakaianlipat = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_pakaianlipat WHERE nis='$nis' and semester='$fil'");
                            $livingpakaianlipat = mysqli_fetch_array($pakaianlipat);
                            $pakaiangantung = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bentuk`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as jumlah FROM tb_living_pakaiangantung WHERE nis='$nis' and semester='$fil'");
                            $livingpakaiangantung = mysqli_fetch_array($pakaiangantung);
                            $celana = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_celanalipat WHERE nis='$nis'  and semester='$fil'");
                            $livingcelana = mysqli_fetch_array($celana);
                            $logistik = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as jumlah FROM tb_living_logistik WHERE nis='$nis' and semester='$fil'");
                            $livinglogistik = mysqli_fetch_array($logistik);
                            $pakaiandalam = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_pakaiandalam WHERE nis='$nis' and semester='$fil'");
                            $livingpakaiandalam = mysqli_fetch_array($pakaiandalam);
                            $totalliving = $livingbuku['jumlah'] + $livingpakaianlipat['jumlah'] + $livingpakaiangantung['jumlah'] + $livingcelana['jumlah'] + $livinglogistik['jumlah'] + $livingpakaiandalam['jumlah'];
                        } elseif ($catatan == 'Ranjang') {
                            // total living Ranjang
                            $ranjang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_ranjang WHERE nis='$nis'  and semester='$fil'");
                            $livingranjang = mysqli_fetch_array($ranjang);
                            $bantal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_bantal WHERE nis='$nis' and semester='$fil'");
                            $livingbantal = mysqli_fetch_array($bantal);
                            $seprei = mysqli_query($conn, "SELECT SUM(`rapi`)+SUM(`raib`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_seprei WHERE nis='$nis' and semester='$fil'");
                            $livingseprei = mysqli_fetch_array($seprei);
                            $selimut = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_selimut WHERE nis='$nis' and semester='$fil'");
                            $livingselimut = mysqli_fetch_array($selimut);
                            $totalliving = $livingranjang['jumlah'] + $livingbantal['jumlah'] + $livingseprei['jumlah'] + $livingselimut['jumlah'];
                        } elseif ($catatan == 'Rak_sepatu') {
                            // total living rak sepatu
                            $raksepatu = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_sepatu WHERE nis='$nis' and semester='$fil'");
                            $livingraksepatu = mysqli_fetch_array($raksepatu);
                            $sepatusidang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_sidang WHERE nis='$nis' and semester='$fil'");
                            $livingsepatusidang = mysqli_fetch_array($sepatusidang);
                            $sepatu_or = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_or WHERE nis='$nis' and semester='$fil'");
                            $livingsepatu_or = mysqli_fetch_array($sepatu_or);
                            $sandal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sendal WHERE nis='$nis' and semester='$fil'");
                            $livingsandal = mysqli_fetch_array($sandal);
                            $rakhanduk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_handuk WHERE nis='$nis' and semester='$fil'");
                            $livingrakhanduk = mysqli_fetch_array($rakhanduk);
                            $handuk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_handuk WHERE nis='$nis' and semester='$fil'");
                            $livinghanduk = mysqli_fetch_array($handuk);
                            $totalliving = $livingraksepatu['jumlah'] + $livingsepatusidang['jumlah'] + $livingsepatu_or['jumlah'] + $livingsandal['jumlah'] + $livingrakhanduk['jumlah'] + $livinghanduk['jumlah'];
                        }
                        $persen_living = $totalliving / $target_kebersihan * 100;
                        $bulatkan_living = round($persen_living);
                        if ($bulatkan_living >= 100) {
                            $bulatkan_living = 100;
                            $totalliving = $target_kebersihan;
                            $huruf_living = 'A';
                            $keterangan_living = 'Sangat Baik';
                            $bobot_living = '4';
                        } elseif ($bulatkan_living >= 90) {
                            $huruf_living = 'A';
                            $keterangan_living = 'Sangat Baik';
                            $bobot_living = '4';
                        } elseif ($bulatkan_living >= 80) {
                            $huruf_living = 'B';
                            $keterangan_living = 'Cukup Baik';
                            $bobot_living = '3';
                        } elseif ($bulatkan_living >= 75) {
                            $huruf_living = 'C';
                            $keterangan_living = 'Kurang Baik';
                            $bobot_living = '2';
                        } elseif ($bulatkan_living >= 60) {
                            $huruf_living = 'D';
                            $keterangan_living = 'Cukup Baik';
                            $bobot_living = '1';
                        } elseif ($bulatkan_living >= 50 || $bulatkan_living < 50) {
                            $huruf_living = 'E';
                            $keterangan_living = 'Kurang Baik';
                            $bobot_living = '0';
                        }
                        $jumlah_totalliving[] = $bobot_living;
                        $total_totalliving = array_sum($jumlah_totalliving);
                    ?>

                        <tr>
                            <td><?= $nama_kebersihan ?></td>
                            <!-- target -->
                            <td class="center"><?= $target_kebersihan ?></td>
                            <!-- nilai akhir -->
                            <td class="center"><?= $totalliving  ?></td>
                            <!-- persen -->
                            <td class="center"><?= $bulatkan_living ?></td>
                            <td class="center"><?= $huruf_living ?></td>
                            <td class="center"><?= $bobot_living ?></td>
                            <td class="center"><?= $keterangan_living ?></td>
                            <!-- keterangan -->
                            <td class="center"></td>
                        </tr>

                    <?php  } ?>





                    <?php
                    $ambil_bobot_pengembangan_diri = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_pengembangan_diri` WHERE semester='$fil'"));
                    $ambil_bobot_penetapan_tujuan_belajar = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_penetapan_tujuan_belajar` WHERE semester='$fil'"));
                    $ambil_bobot_keterampilan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_keterampilan` WHERE semester='$fil'"));
                    $ambil_bobot_Kehadiran = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_kehadiran_kelas` WHERE semester='$fil'"));
                    $ambil_bobot_Jurnal = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_jurnal` WHERE semester='$fil'"));
                    $ambil_bobot_pengamatan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_pengamatan_mentor` WHERE semester='$fil'"));
                    $ambil_bobot_kebersihan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_kebersihan_kerapian` WHERE semester='$fil'"));
                    $ambil_bobot_kelas_visi = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_visi` WHERE semester='$fil'"));
                    $ambil_bobot_kelas_hayat = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_hayat` WHERE semester='$fil'"));
                    $ambil_bobot_kelas_karakter = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_karakter` WHERE semester='$fil'"));
                    $ambil_bobot_kelas_konstitusi = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_kelas_konstitusi` WHERE semester='$fil'"));





                    $Total_bobot = $ambil_bobot_pengembangan_diri['Total'] + $ambil_bobot_penetapan_tujuan_belajar['Total'] + $ambil_bobot_Kehadiran['Total'] + $ambil_bobot_Jurnal['Total'] + $ambil_bobot_pengamatan['Total'] + $ambil_bobot_kebersihan['Total'] + $ambil_bobot_keterampilan['Total'] + $ambil_bobot_kelas_visi['Total'] + $ambil_bobot_kelas_hayat['Total'] + $ambil_bobot_kelas_karakter['Total'] + $ambil_bobot_kelas_konstitusi['Total'];


                    $bobot_pencapaian = $total_totalliving + $total_sikapberbagi + $total_jurnal +
                        $total_presensi + $total_kelas_gitar + $total_kelas_komunikasi +  $total_kelas_entrepreunership + $total_kelas_konsititusi + $total_kelas_evaluasikarakter + $total_kelas_tokohkarakter + $total_kelas_karakter + $total_pengalaman_pdth + $total_pdth + $total_pendidikan + $total_karakter +
                        $total_alkitab + $total_pp + $total_pelatihan + $total_kerohanian + $total_pengembangan_diri;

                    $persentase = $bobot_pencapaian
                        / $Total_bobot * 100;
                    $bulatkan_persentase = round($persentase);

                    if ($persentase >= 100) {
                        $deskripsi_akhir = 'A';
                        $bulatkan_persentase = 100;
                    } else if ($persentase >= 90) {
                        $deskripsi_akhir = 'A';
                    } elseif ($persentase >= 80) {
                        $deskripsi_akhir = 'B';
                    } elseif ($persentase >= 75) {
                        $deskripsi_akhir = 'C';
                    } elseif ($persentase >= 50) {
                        $deskripsi_akhir = 'D';
                    } elseif ($persentase < 50) {
                        $deskripsi_akhir = 'E';
                    }
                    ?>

                    <tr>
                        <th rowspan="2" colspan="6">
                            Bobot (<?= $Total_bobot ?>)
                        </th>
                        <th>Huruf</th>
                        <th rowspan="2"><?= $bobot_pencapaian ?></th>
                        <th>Persentase</th>
                        <td rowspan="2"></td>

                    </tr>
                    <tr>
                        <th><?= $deskripsi_akhir ?></th>
                        <th><?= $bulatkan_persentase ?>%</th>
                    </tr>

                    <tr>
                        <td rowspan="3">
                            Akademik<br>(Persiapan SBMPTN)
                        </td>
                        <td class="center">MATERI</td>
                        <td class="center">TPA</td>
                        <td class="center">TPS</td>
                        <td class="center">Total</td>
                        <td class="center">Rata-rata</td>
                        <td colspan="4" rowspan="3">
                            <a>
                                Keterangan:<br>
                            </a>
                            PDTH: Pelajaran Dasar Tentang Hayat <br>
                            *Pengisian Jurnal<br>
                            ** Partisipasi
                        </td>

                    </tr>
                    <?php
                    $ambilnilai_akademik_utbk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_akademik` WHERE nis='$nis' and semester='$fil' and  efata_mentor='$id' and materi='UTBK'"));
                    $ambilnilai_akademik_Tryout = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_akademik` WHERE nis='$nis' and semester='$fil' and  efata_mentor='$id' and materi='Tryout'"));
                    $total_nilai_Tryout  = $ambilnilai_akademik_Tryout['nilai_tpa'] + $ambilnilai_akademik_Tryout['nilai_tps'];
                    $rata_rata_Tryout = $total_nilai_Tryout / 2;
                    $total_nilai_utbk  = $ambilnilai_akademik_utbk['nilai_tpa'] + $ambilnilai_akademik_utbk['nilai_tps'];
                    $rata_rata_utbk = $total_nilai_utbk / 2;
                    if ($total_nilai_utbk == 0 && $rata_rata_utbk == 0) {
                        $total_nilai_utbk = '';
                        $rata_rata_utbk = '';
                    }
                    if ($total_nilai_Tryout == 0 && $rata_rata_Tryout == 0) {
                        $total_nilai_Tryout = '';
                        $rata_rata_Tryout = '';
                    }
                    ?>
                    <tr>
                        <td>Tryout</td>
                        <td class="center"><?= $ambilnilai_akademik_Tryout['nilai_tpa'] ?></td>
                        <td class="center"><?= $ambilnilai_akademik_Tryout['nilai_tps'] ?></td>
                        <td class="center"><?= $total_nilai_Tryout ?></td>
                        <td class="center"><?= $rata_rata_Tryout ?></td>
                    </tr>
                    <tr>
                        <td>UTBK</td>
                        <td class="center"><?= $ambilnilai_akademik_utbk['nilai_tpa'] ?></td>
                        <td class="center"><?= $ambilnilai_akademik_utbk['nilai_tps'] ?></td>
                        <td class="center"><?= $total_nilai_utbk ?></td>
                        <td class="center"><?= $rata_rata_utbk  ?></td>
                    </tr>
                    <?php
                    $tampilkan_catatan = mysqli_query($conn, "SELECT * FROM `tb_catatan_lp_semester` WHERE efata_mentor='$id' and nis_siswa='$nis' and semester='$fil'");
                    $data_catatan = mysqli_fetch_array($tampilkan_catatan);
                    $cekdata = mysqli_num_rows($tampilkan_catatan);
                    ?>
                    <tr>
                        <td colspan="10" class="keterangan_Catatan">
                            Catatan:

                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class="catatan_Mentor">
                            <?= $data_catatan['catatan']; ?>
                        </td>

                        <td colspan="2">
                            <center>
                                Mentor
                                <br><br><br><br>

                                <br><br><br><br><?= $data['name']; ?>
                            </center>
                        </td>
                    </tr>
                </tbody>






            </table>

        </center>




    </div>
</body>

</html>
<?php
echo
"<script>
window.print();
</script>";
?>