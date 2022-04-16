<?php
include 'database.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H-i-s');
$nis = $_GET['nis'];
$id = $_GET['id'];
$siswa = mysqli_query($conn, "SELECT name FROM siswa where nis='$nis'");
$s = mysqli_fetch_array($siswa);
$s['name'];

if (isset($_POST['kirim_gambar'])) {
  $img = $_POST['image'];
  $folderPath = "img/verifikasi/";
  $image_parts = explode("base64,", $img);
  $image_type_aux = explode("image/", $image_parts[0]);
  $image_type = $image_type_aux[1];
  $image_base64 = base64_decode($image_parts[1]);
  $fileName = $waktu_sekarang . '_' . $s['name'] . '_' . $hari_ini . '.png';
  $file = $folderPath . $fileName;
  // file_put_contents($file, $image_base64);

  if (file_put_contents($file, $image_base64)) {
    $updatejadwal = mysqli_query($conn, "UPDATE `absent` SET `image`='$fileName' WHERE nis='$nis' and schedule_id='$id'");

    if ($updatejadwal) {

      header('location: index.php');
    }
  }
}
