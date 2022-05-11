<?php
include '../../database.php';
session_start();
include '../template/Session.php';
date_default_timezone_set('Asia/Jakarta');
$id = $_GET['id'];
$idp = $_GET['idp'];
$keterampilan = $_GET['keterampilan'];
$kehadiran = $_GET['kehadiran'];
$jurnal = $_GET['jurnal'];
$pengamatan = $_GET['pengamatan'];
$kebersihan = $_GET['kebersihan'];
$kelas_visi = $_GET['kelas_visi'];
$kelas_hayat = $_GET['kelas_hayat'];
$kelas_karakter = $_GET['kelas_karakter'];
$konstitusi = $_GET['konstitusi'];
if ($id) {
  mysqli_query($conn, "DELETE FROM `tb_pengembangan_diri` WHERE `id_pembelajaran`='$id'");
  header('location: ../tb_pengembangan_diri.php');
} elseif ($idp) {
  mysqli_query($conn, "DELETE FROM `tb_penetapan_tujuan_belajar` WHERE `id_penempatan_tujuab_belajar`='$idp'");
  header('location: ../tb_penetapan_tujuan_belajar.php');
} elseif ($keterampilan) {
  mysqli_query($conn, "DELETE FROM `tb_keterampilan` WHERE `id_keterampilan`='$keterampilan'");
  header('location: ../tb_keterampilan.php');
} elseif ($kehadiran) {
  mysqli_query($conn, "DELETE FROM `tb_kehadiran_kelas` WHERE `id_kehadiran_kelas`='$kehadiran'");
  header('location: ../tb_kehadiran_kelas.php');
} elseif ($jurnal) {
  mysqli_query($conn, "DELETE FROM `tb_jurnal` WHERE `id_jurnal`='$jurnal'");
  header('location: ../tb_jurnal.php');
} elseif ($pengamatan) {
  mysqli_query($conn, "DELETE FROM `tb_pengamatan_mentor` WHERE `id_pengamatan_mentor`='$pengamatan'");
  header('location: ../tb_pengamatan_mentor.php');
} elseif ($kebersihan) {
  mysqli_query($conn, "DELETE FROM `tb_kebersihan_kerapian` WHERE `id_kebersihan_kerapian`='$kebersihan'");
  header('location: ../tb_Kebersihan_Kerapian.php');
} elseif ($kelas_visi) {
  mysqli_query($conn, "DELETE FROM `tb_visi` WHERE `id_kelas_visi`='$kelas_visi'");
  header('location: ../tb_kelas_visi.php');
} elseif ($kelas_hayat) {
  mysqli_query($conn, "DELETE FROM `tb_hayat` WHERE `id_kelas_hayat`='$kelas_hayat'");
  header('location: ../tb_kelas_hayat.php');
} elseif ($kelas_karakter) {
  mysqli_query($conn, "DELETE FROM `tb_karakter` WHERE `id_kelas_karakter`='$kelas_karakter'");
  header('location: ../tb_kelas_karakter.php');
} elseif ($konstitusi) {
  mysqli_query($conn, "DELETE FROM `tb_kelas_konstitusi` WHERE `id_konstitusi`='$konstitusi'");
  header('location: ../tb_kelas_konstitusi.php');
}
