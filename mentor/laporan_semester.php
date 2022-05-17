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
                        <tr>
                            <th rowspan="2" colspan="2" width="3%">ASPEK PEMBELAJARAN</th>
                            <th rowspan="2" width="210">FOKUS/MATERI PEMBELAJARAN</th>
                            <th rowspan="2" width="80">Target</th>
                            <th colspan="3" class=" text-center border-dark">Pencapaian Akhir</th>
                            <th rowspan="2" width="80">Bobot</th>
                            <th rowspan="2" width="270">Deskripsi Pelaksanaan</th>
                            <th rowspan="2" width="200">Ket.</th>
                        </tr>
                        <tr>
                            <th width="130">Nilai Akhir</th>
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
                        $catatan
                            = $data_pembelajaran['catatan'];
                        if ($catatan == 'tb_bible_reading') {
                            $jurnal = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point`) as jumlah FROM tb_bible_reading WHERE nis='$nis' AND semester='$fil'  ");
                        } else if ($catatan == 'tb_revival_note') {

                            $jurnal = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`) as jumlah FROM `" . $catatan . "` WHERE nis='$nis' AND semester='$fil' ");
                        } else {

                            $jurnal = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point`) as jumlah FROM `" . $catatan . "` WHERE nis='$nis' AND semester='$fil' ");
                        }
                        $revivalnote = mysqli_fetch_array($jurnal);
                        $persen = $revivalnote['jumlah'] / $target_pembelajaran * 100;
                        $bulatkan = round($persen);
                        if ($revivalnote['jumlah'] == NULL) {
                            $revivalnote['jumlah'] = 0;
                        }
                        if ($bulatkan > 100) {
                            $bulatkan = 100;
                            $bobot_ = '4';
                        }
                        if ($bulatkan == 100) {
                            $deskripsi = 'Mencapai Target';
                            $bobot_ = '4';
                            $keterangan_ = 'A';
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
                        } elseif ($bulatkan <= 50) {
                            $deskripsi = 'Tidak Mencapai Target';
                            $bobot_ = '1';
                            $keterangan_ = 'D';
                        }
                        if ($bulatkan == 0) {
                            $keterangan_ = 'E';
                            $bobot_ = '0';
                            $deskripsi = 'Tidak Mencapai Target';
                        }
                        $jumlah_pengembangan_diri[] = $bobot_;
                        $total_pengembangan_diri = array_sum($jumlah_pengembangan_diri);
                    ?>
                        <tr>

                            <td><?= $namapembelajaran; ?></td>
                            <!-- target -->
                            <td class="center"><?= $target_pembelajaran; ?></td>
                            <!-- nilai akhir -->
                            <td class="center"><?= $revivalnote['jumlah']; ?></td>
                            <!-- persen -->
                            <td class="center"><?= $bulatkan ?></td>
                            <td class="center"><?= $keterangan_ ?></td>
                            <td class="center"><?= $bobot_ ?> </td>
                            <td class="center"><?= $deskripsi ?></td>
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
                            $jurnal = mysqli_query($conn, "SELECT SUM(`point2`) as jumlah FROM tb_personal_goal WHERE nis='$nis' AND semester='$fil' ");
                        } else if ($catatan == 'Pendidikan') {
                            $jurnal  = mysqli_query($conn, "SELECT SUM(`point3`) as jumlah FROM `tb_personal_goal` WHERE nis='$nis' AND semester='$fil' ");
                        } else {
                            $jurnal  = mysqli_query($conn, "SELECT SUM(`point1`) as jumlah FROM `tb_personal_goal` WHERE nis='$nis' AND semester='$fil'  ");
                        }


                        $kerohanian = mysqli_fetch_array($jurnal);
                        $persen = $kerohanian['jumlah'] / $target_tujuan_belajar * 100;
                        $bulatkan = round($persen);
                        if ($kerohanian['jumlah'] == NULL) {
                            $kerohanian['jumlah'] = 0;
                        }
                        if ($bulatkan > 100) {
                            $bulatkan = 100;
                            $bobot_ = '4';
                        }
                        if ($bulatkan == 100) {
                            $deskripsi = 'Mencapai Target';
                            $bobot_ = '4';
                            $keterangan_ = 'A';
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
                        } elseif ($bulatkan <= 50) {
                            $deskripsi = 'Tidak Mencapai Target';
                            $bobot_ = '1';
                            $keterangan_ = 'D';
                        }
                        if ($bulatkan == 0) {
                            $keterangan_ = 'E';
                            $bobot_ = '0';
                            $deskripsi = 'Tidak Mencapai Target';
                        }
                        $jumlah_bobot_kerohanian[] = $bobot_;
                        $total_kerohanian = array_sum($jumlah_bobot_kerohanian);
                    ?>
                        <tr>
                            <td><?= $namatujuan_belajar ?></td>
                            <!-- target -->
                            <td class="center"><?= $target_tujuan_belajar ?></td>
                            <!-- nilai akhir -->
                            <td class="center"><?= $kerohanian['jumlah']; ?></td>
                            <!-- persen -->
                            <td class="center"><?= $bulatkan ?></td>
                            <td class="center"><?= $keterangan_ ?></td>
                            <td class="center"><?= $bobot_ ?></td>
                            <td class="center"><?= $deskripsi ?></td>
                            <!-- keterangan -->
                            <td class="center"></td>
                        </tr>
                    <?php        }
                    ?>

                    <!-- Akhir Script Tujuan belajar ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <?php
                    $poin_kelas_visi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_poin_kelas_visi` WHERE semester='$fil' and nis_siswa='$nis'"));
                    if ($poin_kelas_visi > 0) {
                        $poin_kelas_visi['poin_kelas_pelatihan'];
                        $poin_kelas_visi['poin_kelas_penyegaran_pagi'];
                        $poin_kelas_visi['poin_kelas_alkitab'];
                        $poin_kelas_visi['poin_kelas_pendidikan'];
                        $poin_kelas_visi['poin_kelas_karakter'];
                    } else {
                        $poin_kelas_visi['poin_kelas_pelatihan'] = 0;
                        $poin_kelas_visi['poin_kelas_penyegaran_pagi'] = 0;
                        $poin_kelas_visi['poin_kelas_alkitab'] = 0;
                        $poin_kelas_visi['poin_kelas_pendidikan'] = 0;
                        $poin_kelas_visi['poin_kelas_karakter'] = 0;
                    }

                    $kelas_visi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_visi` WHERE semester='$fil'"));

                    if ($kelas_visi > 0) {
                        $kelas_visi['target_pelatihan'];
                        $kelas_visi['target_penyegaran_pagi'];
                        $kelas_visi['target_alkitab'];
                        $kelas_visi['target_karakter'];
                        $kelas_visi['target_pendidikan'];
                        $kelas_visi['bobot'];
                    } else {
                        $kelas_visi['target_pelatihan'] = 0;
                        $kelas_visi['target_penyegaran_pagi'] = 0;
                        $kelas_visi['target_alkitab'] = 0;
                        $kelas_visi['target_karakter'] = 0;
                        $kelas_visi['target_pendidikan'] = 0;
                        $kelas_visi['bobot'] = 0;
                    }

                    $Hasil_persen = $poin_kelas_visi['poin_kelas_pelatihan'] / $kelas_visi['target_pelatihan'] * 100;
                    $bulatkan_nilai = round($Hasil_persen);
                    if ($bulatkan_nilai > 100) {
                        $bulatkan_nilai = 100;
                        $huruf = 'A';
                        $bobot_kalas_visi = '4';
                        $deskripsi = 'Mencapai Target';
                    } elseif ($bulatkan_nilai >= 90) {
                        $huruf = 'A';
                        $bobot_kalas_visi = '4';
                        $deskripsi = 'Mencapai Target';
                    } elseif ($bulatkan_nilai >= 80) {
                        $huruf = 'B';
                        $bobot_kalas_visi = '3';
                        $deskripsi = 'Mencapai Target';
                    } elseif ($bulatkan_nilai >= 75) {
                        $huruf = 'C';
                        $bobot_kalas_visi = '2';
                        $deskripsi = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai <= 50) {
                        $huruf = 'D';
                        $bobot_kalas_visi = '1';
                        $deskripsi = 'Tidak Mencapai Target';
                    }
                    if ($bobot_kalas_visi == 0) {
                        $huruf = 'E';
                        $bobot_kalas_visi = '0';
                        $deskripsi = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai == 0) {
                        $huruf = 'E';
                        $bobot_kalas_visi = '0';
                        $deskripsi = 'Tidak Mencapai Target';
                    }
                    $jumlah_Kelas_pelatihan[] = $bobot_kalas_visi;
                    $total_pelatihan = array_sum($jumlah_Kelas_pelatihan);




                    $Hasil_persen1 = $poin_kelas_visi['poin_kelas_penyegaran_pagi'] / $kelas_visi['target_pelatihan'] * 100;
                    $bulatkan_nilai1 = round($Hasil_persen1);
                    if ($bulatkan_nilai1 > 100) {
                        $bulatkan_nilai1 = 100;
                        $huruf1 = 'A';
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
                    } elseif ($bulatkan_nilai1 <= 50) {
                        $huruf1 = 'D';
                        $bobot_kalas_visi1 = '1';
                        $deskripsi1 = 'Tidak Mencapai Target';
                    }
                    if ($bobot_kalas_visi1 == 0) {
                        $huruf1 = 'E';
                        $bobot_kalas_visi1 = '0';
                        $deskripsi1 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai1 == 0) {
                        $huruf1 = 'E';
                        $bobot_kalas_visi1 = '0';
                        $deskripsi1 = 'Tidak Mencapai Target';
                    }

                    $jumlah_Kelas_pp[] = $bobot_kalas_visi1;
                    $total_pp = array_sum($jumlah_Kelas_pp);



                    $Hasil_persen2 = $poin_kelas_visi['poin_kelas_alkitab'] / $kelas_visi['target_pelatihan'] * 100;
                    $bulatkan_nilai2 = round($Hasil_persen2);
                    if ($bulatkan_nilai2 > 100) {
                        $bulatkan_nilai2 = 100;
                        $huruf2 = 'A';
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
                    } elseif ($bulatkan_nilai2 <= 50) {
                        $huruf2 = 'D';
                        $bobot_kalas_visi2 = '1';
                        $deskripsi2 = 'Tidak Mencapai Target';
                    }
                    if ($bobot_kalas_visi2 == 0) {
                        $huruf2 = 'E';
                        $bobot_kalas_visi2 = '0';
                        $deskripsi2 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai2 == 0) {
                        $huruf2 = 'E';
                        $bobot_kalas_visi2 = '0';
                        $deskripsi2 = 'Tidak Mencapai Target';
                    }
                    $jumlah_Kelas_alkitab[] = $bobot_kalas_visi2;
                    $total_alkitab = array_sum($jumlah_Kelas_alkitab);




                    $Hasil_persen3 = $poin_kelas_visi['poin_kelas_karakter'] / $kelas_visi['target_pelatihan'] * 100;
                    $bulatkan_nilai3 = round($Hasil_persen3);
                    if ($bulatkan_nilai3 > 100) {
                        $bulatkan_nilai3 = 100;
                        $huruf3 = 'A';
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
                    } elseif ($bulatkan_nilai3 <= 50) {
                        $huruf3 = 'D';
                        $bobot_kalas_visi3 = '1';
                        $deskripsi3 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai3 == 0) {
                        $huruf3 = 'E';
                        $bobot_kalas_visi3 = '0';
                        $deskripsi3 = 'Tidak Mencapai Target';
                    }
                    if ($bobot_kalas_visi3 == 0) {
                        $huruf3 = 'E';
                        $bobot_kalas_visi3 = '0';
                        $deskripsi3 = 'Tidak Mencapai Target';
                    }
                    $jumlah_Kelas_karakter[] = $bobot_kalas_visi3;
                    $total_karakter = array_sum($jumlah_Kelas_karakter);



                    $Hasil_persen4 = $poin_kelas_visi['poin_kelas_pendidikan'] / $kelas_visi['target_pelatihan'] * 100;
                    $bulatkan_nilai4 = round($Hasil_persen4);
                    if ($bulatkan_nilai4 > 100) {
                        $bulatkan_nilai4 = 100;
                        $huruf4 = 'A';
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
                    } elseif ($bulatkan_nilai4 <= 50) {
                        $huruf4 = 'D';
                        $bobot_kalas_visi4 = '1';
                        $deskripsi4 = 'Tidak Mencapai Target';
                    }

                    if ($bobot_kalas_visi4 == 0) {
                        $huruf4 = 'E';
                        $bobot_kalas_visi4 = '0';
                        $deskripsi4 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai4 == 0) {
                        $huruf4 = 'E';
                        $bobot_kalas_visi4 = '0';
                        $deskripsi4 = 'Tidak Mencapai Target';
                    }
                    $jumlah_Kelas_pendidikan[] = $bobot_kalas_visi4;
                    $total_pendidikan = array_sum($jumlah_Kelas_pendidikan);
                    $total_semua_kelas_visi = $total_pendidikan
                        + $total_karakter
                        + $total_alkitab + $total_pp
                        + $total_pelatihan;

                    ?>


                    <tr>
                        <td rowspan="11">
                            Pengetahuan
                        </td>
                        <td rowspan="5">KELAS VISI</td>
                        <!-- target -->
                        <td>Pelatihan</td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $kelas_visi['target_pelatihan']; ?></td>
                        <!-- persen -->
                        <td class="center"><?= $poin_kelas_visi['poin_kelas_pelatihan']; ?></td>
                        <td class="center"><?= $bulatkan_nilai ?></td>
                        <td class="center"><?= $huruf ?></td>
                        <td class="center"><?= $bobot_kalas_visi ?></td>
                        <td class="center"><?= $deskripsi ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>
                    <tr>
                        <td>Penyegaran Pagi</td>
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
                        <td>Alkitab</td>
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
                        <td>karakter</td>
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
                        <td>Pendidikan</td>
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
                    if ($kelas_hayat > 0) {
                        $kelas_hayat['target_kelas_pdth'];
                        $kelas_hayat['target_kelas_pengalaman_hayat'];
                        $kelas_hayat['bobot'];
                    } else {
                        $kelas_hayat['target_kelas_pdth'] = 0;
                        $kelas_hayat['target_kelas_pengalaman_hayat'] = 0;
                        $kelas_hayat['bobot'] = 0;
                    }

                    $ambil_poin_kelas_hayat = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_poin_kelas_hayat` WHERE semester='$fil' and nis_siswa='$nis'"));
                    if ($ambil_poin_kelas_hayat > 0) {

                        $ambil_poin_kelas_hayat['poin_kelas_pdth'];
                        $ambil_poin_kelas_hayat['poin_kelas_pengalaman_hayat'];
                    } else {
                        $ambil_poin_kelas_hayat['poin_kelas_pdth'] = 0;
                        $ambil_poin_kelas_hayat['poin_kelas_pengalaman_hayat'] = 0;
                    }


                    $Hasil_persen5 = $ambil_poin_kelas_hayat['poin_kelas_pdth'] / $kelas_hayat['target_kelas_pengalaman_hayat'] * 100;
                    $bulatkan_nilai5 = round($Hasil_persen5);
                    if ($bulatkan_nilai5 > 100) {
                        $bulatkan_nilai5 = 100;
                        $huruf5 = 'A';
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
                    } elseif ($bulatkan_nilai5 <= 50) {
                        $huruf5 = 'D';
                        $bobot_kalas_hayat = '1';
                        $deskripsi5 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai5 == 0) {
                        $huruf5 = 'E';
                        $bobot_kalas_hayat = '0';
                        $deskripsi5 = 'Tidak Mencapai Target';
                    }
                    if ($bobot_kalas_hayat == 0) {
                        $huruf5 = 'E';
                        $bobot_kalas_hayat = '0';
                        $deskripsi5 = 'Tidak Mencapai Target';
                    }
                    $jumlah_Kelas_pdth[] =  $bobot_kalas_hayat;
                    $total_pdth = array_sum($jumlah_Kelas_pdth);


                    $Hasil_persen6 = $ambil_poin_kelas_hayat['poin_kelas_pengalaman_hayat'] / $kelas_hayat['target_kelas_pengalaman_hayat'] * 100;
                    $bulatkan_nilai6 = round($Hasil_persen6);
                    if ($bulatkan_nilai6 > 100) {
                        $bulatkan_nilai6 = 100;
                        $huruf6 = 'A';
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
                    } elseif ($bulatkan_nilai6 <= 50) {
                        $huruf6 = 'D';
                        $bobot_kalas_hayat6 = '1';
                        $deskripsi6 = 'Tidak Mencapai Target';
                    }

                    if ($bobot_kalas_hayat6 == 0) {
                        $huruf6 = 'E';
                        $bobot_kalas_hayat6 = '0';
                        $deskripsi6 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai6 == 0) {
                        $huruf6 = 'E';
                        $bobot_kalas_hayat6 = '0';
                        $deskripsi6 = 'Tidak Mencapai Target';
                    }

                    $jumlah_Kelas_pengalaman_pdth[] =  $bobot_kalas_hayat6;
                    $total_pengalaman_pdth = array_sum($jumlah_Kelas_pengalaman_pdth);
                    $total_kelas_hayat = $total_pdth + $total_pengalaman_pdth;



                    ?>
                    <tr>
                        <td rowspan="2">Kelas Hayat</td>
                        <!-- target -->
                        <td>PDTH</td>
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

                        <td>Pengalaman Hayat</td>
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
                    if ($t_kelas_karakter  > 0) {
                        $t_kelas_karakter['target_kelas_karakter'];
                        $t_kelas_karakter['target_karakter_tokoh'];
                        $t_kelas_karakter['target_evaluasi_karakter'];
                        $t_kelas_karakter['bobot'];
                    } else {
                        $t_kelas_karakter['target_kelas_karakter'] = 0;
                        $t_kelas_karakter['target_karakter_tokoh'] = 0;
                        $t_kelas_karakter['target_evaluasi_karakter'] = 0;
                        $t_kelas_karakter['bobot'] = 0;
                    }

                    ?>

                    <?php
                    $ambil_poin_kelas_karakter = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_poin_kelas_karakter WHERE nis_siswa='$nis' and semester='$fil'"));

                    if ($ambil_poin_kelas_karakter > 0) {
                        $ambil_poin_kelas_karakter['poin_kelas_karakter'];
                        $ambil_poin_kelas_karakter['poin_kelas_karakter_tokoh'];
                        $ambil_poin_kelas_karakter['poin_evaluasi_karakter'];
                    } else {
                        $ambil_poin_kelas_karakter['poin_kelas_karakter'] = 0;
                        $ambil_poin_kelas_karakter['poin_kelas_karakter_tokoh'] = 0;
                        $ambil_poin_kelas_karakter['poin_evaluasi_karakter'] = 0;
                    }

                    $Hasil_persen7 = $ambil_poin_kelas_karakter['poin_kelas_karakter'] /
                        $t_kelas_karakter['target_evaluasi_karakter'] * 100;
                    $bulatkan_nilai7 = round($Hasil_persen7);
                    if ($bulatkan_nilai7 >= 100) {
                        $bulatkan_nilai7 = 100;
                        $huruf7 = 'A';
                        $bobot_kalas_karakter7 = '4';
                        $deskripsi7 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai7 >= 90) {
                        $huruf7 = 'A';
                        $bobot_kalas_karakter7 = '4';
                        $deskripsi7 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai7 >= 80) {
                        $huruf7 = 'B';
                        $bobot_kalas_karakter7 = '3';
                        $deskripsi7 = 'Mencapai Target';
                    } elseif ($bulatkan_nilai7 >= 75) {
                        $huruf7 = 'C';
                        $bobot_kalas_karakter7 = '2';
                        $deskripsi7 = 'Tidak Mencapai Target';
                    } elseif ($bulatkan_nilai7 <= 50) {
                        $huruf7 = 'D';
                        $bobot_kalas_karakter7 = '1';
                        $deskripsi7 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai7 == 0) {
                        $huruf7 = 'E';
                        $bobot_kalas_karakter7 = '0';
                        $deskripsi7 = 'Tidak Mencapai Target';
                    }
                    if ($bobot_kalas_karakter7 == 0) {
                        $huruf7 = 'E';
                        $bobot_kalas_karakter7 = '0';
                        $deskripsi7 = 'Tidak Mencapai Target';
                    }

                    $jumlah_Kelas_karakter[] =  $bobot_kalas_karakter7;
                    $total_kelas_karakter = array_sum($jumlah_Kelas_karakter);


                    $Hasil_persen8 = $ambil_poin_kelas_karakter['poin_kelas_karakter_tokoh'] /
                        $t_kelas_karakter['target_evaluasi_karakter'] * 100;
                    $bulatkan_nilai8 = round($Hasil_persen8);
                    if ($bulatkan_nilai8 >= 100) {
                        $bulatkan_nilai8 = 100;
                        $huruf8 = 'A';
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
                    } elseif ($bulatkan_nilai8 <= 50) {
                        $huruf8 = 'D';
                        $bobot_kalas_karakter_tokoh = '1';
                        $deskripsi8 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai8 == 0) {
                        $huruf8 = 'E';
                        $bobot_kalas_karakter_tokoh = '0';
                        $deskripsi8 = 'Tidak Mencapai Target';
                    }
                    if ($bobot_kalas_karakter_tokoh == 0) {
                        $huruf8 = 'E';
                        $bobot_kalas_karakter_tokoh = '0';
                        $deskripsi8 = 'Tidak Mencapai Target';
                    }

                    $jumlah_Kelas_karakter1[] =  $bobot_kalas_karakter_tokoh;
                    $total_kelas_karakter1 = array_sum($jumlah_Kelas_karakter1);

                    $Hasil_persen9 = $ambil_poin_kelas_karakter['poin_evaluasi_karakter'] /
                        $t_kelas_karakter['target_evaluasi_karakter'] * 100;
                    $bulatkan_nilai9 = round($Hasil_persen9);
                    if ($bulatkan_nilai9 >= 100) {
                        $bulatkan_nilai9 = 100;
                        $huruf9 = 'A';
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
                    } elseif ($bulatkan_nilai9 <= 50) {
                        $huruf9 = 'D';
                        $bobot_kalas_karakter_evaluasi = '1';
                        $deskripsi9 = 'Tidak Mencapai Target';
                    }

                    if ($bulatkan_nilai9 == 0) {
                        $huruf9 = 'E';
                        $bobot_kalas_karakter_evaluasi = '0';
                        $deskripsi9 = 'Tidak Mencapai Target';
                    }
                    if ($bobot_kalas_karakter_evaluasi == 0) {
                        $huruf9 = 'E';
                        $bobot_kalas_karakter_evaluasi = '0';
                        $deskripsi9 = 'Tidak Mencapai Target';
                    }

                    $jumlah_Kelas_karakter2[] =  $bobot_kalas_karakter_evaluasi;
                    $total_kelas_karakter2 = array_sum($jumlah_Kelas_karakter2);

                    $total_semua_kelas_karakter =
                        $total_kelas_karakter2 +
                        $total_kelas_karakter1
                        + $total_kelas_karakter
                    ?>


                    <tr>
                        <td rowspan="3">
                            Kelas Karakter
                        </td>
                        <td>Karakter (benar,ketat dan tepat) </td>
                        <!-- target -->
                        <td class="center"><?= $t_kelas_karakter['target_kelas_karakter']; ?></td>
                        <!-- nilai akhir -->
                        <td class="center"><?= $ambil_poin_kelas_karakter['poin_kelas_karakter']; ?></td>
                        <!-- persen -->
                        <td class="center"><?= $bulatkan_nilai7 ?></td>
                        <td class="center"><?= $huruf7 ?></td>
                        <td class="center"><?= $bobot_kalas_karakter7 ?></td>
                        <td class="center"><?= $deskripsi7 ?></td>
                        <!-- keterangan -->
                        <td class="center"></td>
                    </tr>

                    <tr>

                        <td>Karakter (tokoh)</td>
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
                    if ($kelas_konsititusi > 0) {
                        $kelas_konsititusi['target_kelas_alkitab'];
                        $kelas_konsititusi['bobot'];
                    } else {
                        $kelas_konsititusi['target_kelas_alkitab'] = 0;
                        $kelas_konsititusi['bobot'] = 0;
                    }

                    $ambil_poin_kelas_konsititusi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_poin_kelas_konsititusi WHERE nis_siswa='$nis' and semester='$fil'"));
                    if ($ambil_poin_kelas_konsititusi > 0) {
                        $ambil_poin_kelas_konsititusi['poin_alkitab'];
                    } else {
                        $ambil_poin_kelas_konsititusi['poin_alkitab'] = 0;
                    }

                    $Hasil_persen10 = $ambil_poin_kelas_konsititusi['poin_alkitab'] / $kelas_konsititusi['target_kelas_alkitab'] * 100;

                    $bulatkan_nilai10 = round($Hasil_persen10);

                    if ($bulatkan_nilai10 >= 100) {
                        $bulatkan_nilai10 = 100;
                        $huruf10 = 'A';
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
                    } elseif ($bulatkan_nilai10 <= 50) {
                        $huruf10 = 'D';
                        $bobot_poin_kelas_alkitab = '1';
                        $deskripsi10 = 'Tidak Mencapai Target';
                    }

                    if ($bulatkan_nilai10 ==  0) {
                        $huruf10 = 'E';
                        $bobot_poin_kelas_alkitab = '0';
                        $deskripsi10 = 'Tidak Mencapai Target';
                    }
                    if ($bobot_poin_kelas_alkitab ==  0) {
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
                    if ($keterampilan > 0) {
                        $t_komunikasi = $keterampilan['target_komunikasi'];
                        $t_gitar = $keterampilan['target_gitar'];
                        $t_Entrepreunership = $keterampilan['target_entrepreunership'];
                        $bobot_keterampilan = $keterampilan['bobot'];
                    } else {
                        $t_komunikasi = $keterampilan['target_komunikasi'] = 0;
                        $t_gitar = $keterampilan['target_gitar'] = 0;
                        $t_Entrepreunership = $keterampilan['target_entrepreunership'] = 0;
                        $bobot_keterampilan = $keterampilan['bobot'] = 0;
                    }

                    $ambil_poin_keterampilan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tb_kelas_keterampilan` WHERE nis_siswa='$nis' And semester='$fil'"));

                    if ($ambil_poin_keterampilan > 0) {
                        $ambil_poin_keterampilan['poin_kelas_entrepreunership'];
                        $ambil_poin_keterampilan['poin_kelas_komunikasi'];
                        $ambil_poin_keterampilan['poin_kelas_gitar'];
                    } else {

                        $ambil_poin_keterampilan['poin_kelas_entrepreunership'] = 0;
                        $ambil_poin_keterampilan['poin_kelas_komunikasi'] = 0;
                        $ambil_poin_keterampilan['poin_kelas_gitar'] = 0;
                    }


                    $Hasil_persen11 =
                        $ambil_poin_keterampilan['poin_kelas_entrepreunership'] /
                        $t_Entrepreunership * 100;

                    $bulatkan_nilai11 = round($Hasil_persen11);
                    if ($bulatkan_nilai11 >= 100) {
                        $bulatkan_nilai11 = 100;
                        $huruf11 = 'A';
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
                    } elseif ($bulatkan_nilai11 <= 50) {
                        $huruf11 = 'D';
                        $bobot_poin_kelas_unership = '1';
                        $deskripsi11 = 'Tidak Mencapai Target';
                    }

                    if ($bulatkan_nilai11 == 0) {
                        $huruf11 = 'E';
                        $bobot_poin_kelas_unership = '0';
                        $deskripsi11 = 'Tidak Mencapai Target';
                    }
                    if ($bobot_poin_kelas_unership == 0) {
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
                    } elseif ($bulatkan_nilai12 <= 50) {
                        $huruf12 = 'D';
                        $bobot_poin_kelas_komunikasi = '1';
                        $deskripsi12 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai12 == 0) {
                        $huruf12 = 'E';
                        $bobot_poin_kelas_komunikasi = '0';
                        $deskripsi12 = 'Tidak Mencapai Target';
                    }
                    if ($bobot_poin_kelas_komunikasi == 0) {
                        $huruf12 = 'E';
                        $bobot_poin_kelas_komunikasi = '0';
                        $deskripsi12 = 'Tidak Mencapai Target';
                    }

                    $jumlah_komunikasi[] =  $bobot_poin_kelas_komunikasi;
                    $total_kelas_komunikasi = array_sum($jumlah_komunikasi);


                    $Hasil_persen13 =
                        $ambil_poin_keterampilan['poin_kelas_gitar'] /  $t_gitar  * 100;
                    $bulatkan_nilai13 = round($Hasil_persen13);

                    if ($bulatkan_nilai13 >= 100) {
                        $bulatkan_nilai13 = 100;
                        $huruf13 = 'A';
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
                    } elseif ($bulatkan_nilai13 <= 50) {
                        $huruf13 = 'D';
                        $bobot_poin_kelas_gitar = '1';
                        $deskripsi13 = 'Tidak Mencapai Target';
                    }
                    if ($bulatkan_nilai13 == 0) {
                        $huruf13 = 'E';
                        $bobot_poin_kelas_gitar = '0';
                        $deskripsi13 = 'Tidak Mencapai Target';
                    }
                    if ($bobot_poin_kelas_gitar == 0) {
                        $huruf13 = 'E';
                        $bobot_poin_kelas_gitar = '0';
                        $deskripsi13 = 'Tidak Mencapai Target';
                    }

                    $jumlah_gitar[] =  $bobot_poin_kelas_gitar;
                    $total_kelas_gitar = array_sum($jumlah_gitar);

                    $jumlah_total_kelas_keterampilan =
                        $total_kelas_gitar
                        + $total_kelas_komunikasi + $total_kelas_entrepreunership;
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
                        if ($bulatkan > 100) {
                            $bulatkan = 100;
                            $bobot_ = '4';
                        }
                        if ($bulatkan == 100) {
                            $deskripsi = 'Mencapai Target';
                            $bobot_ = '4';
                            $keterangan_ = 'A';
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
                        } elseif ($bulatkan <= 50) {
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
                        <td rowspan="<?= $baris ?>" colspan="2">
                            Jurnal
                        </td>
                    </tr>
                    <?php
                    while ($data_jurnal = mysqli_fetch_array($tb_jurnal)) {
                        $keteranganjurnal
                            = $data_jurnal['nama_jurnal'];
                        $target_jurnal
                            = $data_jurnal['target'];
                        $catatan
                            = $data_jurnal['catatan'];

                        if ($catatan == 'tb_blessings') {
                            $jurnal = mysqli_query($conn, "SELECT SUM(`point7`) as jumlah FROM tb_blessings WHERE nis='$nis' AND semester='$fil' ");
                        } else {

                            $jurnal = mysqli_query($conn, "SELECT SUM(`point`) as jumlah FROM `" . $catatan . "` WHERE nis='$nis' AND semester='$fil'  ");
                        }


                        $konseling = mysqli_fetch_array($jurnal);
                        $persen = $konseling['jumlah'] / $target_jurnal * 100;
                        $bulatkan = round($persen);
                        if ($konseling['jumlah'] == NULL) {
                            $konseling['jumlah'] = 0;
                        }
                        if ($bulatkan > 100) {
                            $bulatkan = 100;
                            $bobot_ = '4';
                        }
                        if ($bulatkan == 100) {
                            $deskripsi = 'Mencapai Target';
                            $bobot_ = '4';
                            $keterangan_ = 'A';
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
                        } elseif ($bulatkan <= 50) {
                            $deskripsi = 'Tidak Mencapai Target';
                            $bobot_ = '1';
                            $keterangan_ = 'D';
                        }
                        if ($bulatkan == 0) {
                            $deskripsi = 'Tidak Mencapai Target';
                            $bobot_ = '0';
                            $keterangan_ = 'E';
                        }
                        if ($bobot_ == 0) {
                            $deskripsi = 'Tidak Mencapai Target';
                            $bobot_ = '0';
                            $keterangan_ = 'E';
                        }

                        $jumlah_jurnal[] = $bobot_;
                        $total_jurnal = array_sum($jumlah_jurnal);
                    ?>

                        <tr>
                            <td><?= $keteranganjurnal ?></td>
                            <!-- target -->
                            <td class="center"><?= $target_jurnal ?></td>
                            <!-- nilai akhir -->
                            <td class="center"><?= $konseling['jumlah']; ?></td>
                            <!-- persen -->

                            <td class="center"><?= $bulatkan ?></td>
                            <td class="center"><?= $keterangan_ ?></td>
                            <td class="center"><?= $bobot_  ?></td>
                            <td class="center"><?= $deskripsi ?></td>
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
                        <td class="border-dark" rowspan="<?= $baris ?>" colspan="2">
                            Kebajikan dan Karakter <br>(Pengamatan Mentor)
                        </td>
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
                            $jurnal = mysqli_query($conn, "SELECT SUM(`perhatian_berbagi`) as jumlah FROM `tb_vrtues_caharacter` WHERE nis='$nis' and semester='$fil' ");
                        } else if ($catatan == 'salam_sapa') {
                            $jurnal  = mysqli_query($conn, "SELECT SUM(`salam_sapa`) as jumlah FROM `tb_vrtues_caharacter`  WHERE nis='$nis' and semester='$fil' ");
                        } elseif ($catatan == 'bersyukur_berterimakasih') {
                            $jurnal = mysqli_query($conn, "SELECT SUM(`bersyukur_berterimakasih`) as jumlah FROM `tb_vrtues_caharacter`  WHERE nis='$nis' and semester='$fil' ");
                        } elseif ($catatan == 'hormat_taat') {
                            $jurnal = mysqli_query($conn, "SELECT SUM(`hormat_taat`) as jumlah FROM `tb_vrtues_caharacter` WHERE nis='$nis' and semester='$fil'");
                        } elseif ($catatan == 'sikapramahsopan') {
                            $jurnal  = mysqli_query($conn, "SELECT SUM(`sikapramahsopan`) as jumlah FROM tb_virtues WHERE nis='$nis'  and semester='$fil'");
                        } elseif ($catatan == 'sikapberkordinasi') {
                            $jurnal = mysqli_query($conn, "SELECT SUM(`sikapberkordinasi`) as jumlah FROM tb_virtues WHERE nis='$nis' and semester='$fil'");
                        } elseif ($catatan == 'sikaptolongmenolong') {
                            $jurnal = mysqli_query($conn, "SELECT SUM(`sikaptolongmenolong`) as jumlah FROM tb_virtues WHERE nis='$nis' and semester='$fil' ");
                        } elseif ($catatan == 'sikapseedo') {
                            $jurnal = mysqli_query($conn, "SELECT SUM(`sikapseedo`) as jumlah FROM tb_virtues WHERE nis='$nis'  and semester='$fil'");
                        } elseif ($catatan == 'benar') {
                            $jurnal = mysqli_query($conn, "SELECT SUM(`benar`) as jumlah FROM tb_character WHERE nis='$nis' and semester='$fil'");
                        } elseif ($catatan == 'tepat') {
                            $jurnal = mysqli_query($conn, "SELECT SUM(`tepat`) as jumlah FROM tb_character WHERE nis='$nis' and semester='$fil'");
                        } elseif ($catatan == 'ketat') {
                            $jurnal = mysqli_query($conn, "SELECT SUM(`ketat`) as jumlah FROM tb_character WHERE nis='$nis' and semester='$fil'");
                        }



                        $sikapberbagi = mysqli_fetch_array($jurnal);

                        $persen = $sikapberbagi['jumlah'] / $target_pengamatan * 100;
                        $bulatkan = round($persen);
                        if ($sikapberbagi['jumlah'] == NULL) {
                            $sikapberbagi['jumlah'] = 0;
                        }

                        if ($bulatkan > 100) {
                            $bulatkan = 100;
                            $bobot_ = '4';
                            $deskripsi = 'Sangat Baik';
                        }
                        if ($bulatkan == 100) {
                            $deskripsi = 'Sangat Baik';
                            $bobot_ = '4';
                            $keterangan_ = 'A';
                        } else if ($bulatkan >= 90) {
                            $deskripsi = 'Sangat Baik';
                            $bobot_ = '4';
                            $keterangan_ = 'A';
                            // $deskripsi = 'Tidak Mencapai Target';
                        } elseif ($bulatkan >= 80) {
                            $deskripsi = 'Baik';
                            $bobot_ = '3';
                            $keterangan_ = 'B';
                        } elseif ($bulatkan >= 75) {
                            $deskripsi = 'Kurang Baik';
                            $bobot_ = '2';
                            $keterangan_ = 'C';
                        } elseif ($bulatkan <= 50) {
                            $deskripsi = 'Kurang Baik';
                            $bobot_ = '1';
                            $keterangan_ = 'D';
                        }
                        if ($bulatkan == 0) {
                            $deskripsi = 'Tidak Baik';
                            $bobot_ = '0';
                            $keterangan_ = 'E';
                        }
                        $jumlah_sikapberbagi[] = $bobot_;
                        $total_sikapberbagi = array_sum($jumlah_sikapberbagi);
                    ?>

                        <tr>
                            <td><?= $keterangan_pengamatan ?></td>
                            <!-- target -->
                            <td class="center"><?= $target_pengamatan ?></td>
                            <!-- nilai akhir -->
                            <td class="center"><?= $sikapberbagi['jumlah']; ?></td>
                            <!-- persen -->
                            <td class="center"><?= $bulatkan ?></td>
                            <td class="center"><?= $keterangan_ ?></td>
                            <td class="center"><?= $bobot_ ?></td>
                            <td class="center"><?= $deskripsi ?></td>
                            <!-- keterangan -->
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
                        $target_kebersihan
                            = $data_kebersihan['target'];

                        $catatan
                            = $data_kebersihan['catatan'];


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

                        $persen = $totalliving / $target_kebersihan * 100;
                        $bulatkan = round($persen);
                        if ($totalliving == NULL) {
                            $totalliving = 0;
                        }
                        if ($bulatkan > 100) {
                            $bulatkan = 100;
                            $bobot_ = '4';
                            $deskripsi = 'Sangat Baik';
                        }
                        if ($bulatkan == 100) {
                            $deskripsi = 'Sangat Baik';
                            $bobot_ = '4';
                            $keterangan_ = 'A';
                        } else if ($bulatkan >= 90) {
                            $deskripsi = 'Sangat Baik';
                            $bobot_ = '4';
                            $keterangan_ = 'A';
                            // $deskripsi = 'Tidak Mencapai Target';
                        } elseif ($bulatkan >= 80) {
                            $deskripsi = 'Baik';
                            $bobot_ = '3';
                            $keterangan_ = 'B';
                        } elseif ($bulatkan >= 75) {
                            $deskripsi = 'Kurang Baik';
                            $bobot_ = '2';
                            $keterangan_ = 'C';
                        } elseif ($bulatkan <= 50) {
                            $deskripsi = 'Kurang Baik';
                            $bobot_ = '1';
                            $keterangan_ = 'D';
                        }

                        if ($bulatkan == 0) {
                            $deskripsi = 'Tidak Baik';
                            $bobot_ = '0';
                            $keterangan_ = 'E';
                        }

                        $jumlah_totalliving[] = $bobot_;
                        $total_totalliving = array_sum($jumlah_totalliving);
                    ?>


                        <tr>
                            <td><?= $nama_kebersihan ?></td>
                            <!-- target -->
                            <td class="center"><?= $target_kebersihan ?></td>
                            <!-- nilai akhir -->
                            <td class="center"><?= $totalliving  ?></td>
                            <!-- persen -->
                            <td class="center"><?= $bulatkan ?></td>
                            <td class="center"><?= $keterangan_ ?></td>
                            <td class="center"><?= $bobot_ ?></td>
                            <td class="center"><?= $deskripsi ?></td>
                            <!-- keterangan -->
                            <td class="center"></td>
                        </tr>

                    <?php  } ?>





                    <?php
                    $ambil_bobot_kebersihan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_kebersihan_kerapian` WHERE semester='$fil'"));
                    $ambil_bobot_pengamatan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_pengamatan_mentor` WHERE semester='$fil'"));
                    $ambil_bobot_Jurnal = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_jurnal` WHERE semester='$fil'"));
                    $ambil_bobot_Kehadiran = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_kehadiran_kelas` WHERE semester='$fil'"));
                    $ambil_bobot_penetapan_tujuan_belajar = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_penetapan_tujuan_belajar` WHERE semester='$fil'"));
                    $ambil_bobot_pengembangan_diri = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(bobot) as Total FROM `tb_pengembangan_diri` WHERE semester='$fil'"));

                    $Total_bobot = $ambil_bobot_pengembangan_diri['Total'] + $ambil_bobot_penetapan_tujuan_belajar['Total'] + $ambil_bobot_Kehadiran['Total'] + $ambil_bobot_Jurnal['Total'] + $ambil_bobot_pengamatan['Total'] + $ambil_bobot_kebersihan['Total'] + $bobot_keterampilan + $kelas_visi['bobot']  + $kelas_hayat['bobot'] +
                        $t_kelas_karakter['bobot']
                        + $kelas_konsititusi['bobot'];

                    $bobot_pencapaian = $total_pengembangan_diri + $total_kerohanian + $total_presensi + $total_jurnal + $total_sikapberbagi + $total_totalliving + $total_semua_kelas_visi + $total_kelas_hayat
                        + $total_semua_kelas_karakter + $total_kelas_konsititusi
                        + $jumlah_total_kelas_keterampilan;

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

                    <tr>
                        <td>Tryout</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>UTBK</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <?php
                        $tampilkan_catatan = mysqli_query($conn, "SELECT * FROM `tb_catatan_lp_semester` WHERE efata_mentor='$id' and nis_siswa='$nis' and semester='$fil'");
                        $data_catatan = mysqli_fetch_array($tampilkan_catatan);
                        $cekdata = mysqli_num_rows($tampilkan_catatan);
                        ?>
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