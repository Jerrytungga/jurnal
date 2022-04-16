<?php
include '../database.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H:i:s');
include 'template/session.php';
$id = $_GET['id'];
$keterangan = $_GET['approved'];
$keterangan2 = $_GET['notapproved'];

$Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where mentor='$id'");
$array_absent = mysqli_fetch_array($Sqli_absent);

if ($keterangan = $_GET['approved']) {
  $sqli = mysqli_query($conn, "UPDATE `absent` SET `ACC_Mentor`='$keterangan' where id_absent='$id'");
  if ($sqli) {
    $_SESSION['alert_approved'] = 'Approved';
    header('location: presensi_siswa_mentor.php');
  }
} else {
  $sqli1 = mysqli_query($conn, "UPDATE `absent` SET `ACC_Mentor`='$keterangan2' where id_absent='$id'");
  header('location: presensi_siswa_mentor.php');
  if ($sqli1) {
    $_SESSION['alert_not_approved'] = 'Not approved';
    header('location: presensi_siswa_mentor.php');
  }
}
