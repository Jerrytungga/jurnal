<?php
include '../database.php';
session_start();
include 'template/session.php';
$id_kelas_visi = $_GET['id_kelas_visi'];
$nis = $_GET['nis'];
$id_kelas_hayat = $_GET['id_kelas_hayat'];
$id_kelas_karakter = $_GET['id_kelas_karakter'];
$id_kelas_konsititusi = $_GET['id_kelas_konsititusi'];
$id_kelas_keterampilan = $_GET['id_kelas_keterampilan'];
if ($id_kelas_visi) {
  mysqli_query($conn, "DELETE FROM `tb_poin_kelas_visi` WHERE `id_kelas_visi`='$id_kelas_visi'");
  header("location: aspek_pembelajaran_pengetahuan.php?nis=$nis");
} elseif ($id_kelas_hayat) {
  mysqli_query($conn, "DELETE FROM `tb_poin_kelas_hayat` WHERE `id_kelas_hayat`='$id_kelas_hayat'");
  header("location: kelas_hayat.php?nis=$nis");
} elseif ($id_kelas_karakter) {
  mysqli_query($conn, "DELETE FROM `tb_poin_kelas_karakter` WHERE `id_kelas_karakter`='$id_kelas_karakter'");
  header("location: kelas_karakter.php?nis=$nis");
} elseif ($id_kelas_konsititusi) {
  mysqli_query($conn, "DELETE FROM `tb_poin_kelas_konsititusi` WHERE `id_poin_konsititusi`='$id_kelas_konsititusi'");
  header("location: kelas_konsititusi.php?nis=$nis");
} elseif ($id_kelas_keterampilan) {
  mysqli_query($conn, "DELETE FROM `tb_kelas_keterampilan` WHERE `id_keterampilan`='$id_kelas_keterampilan'");
  header("location: kelas_keterampilan.php?nis=$nis");
}
