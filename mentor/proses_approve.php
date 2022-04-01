<?php
include '../database.php';
session_start();
include 'template/session.php';
$id = $_GET['id'];
$keterangan = $_GET['approve'];
$keterangan2 = $_GET['notapproved'];
if ($keterangan = $_GET['approve']) {
  $sqli = mysqli_query($conn, "UPDATE `absent` SET `ACC_Mentor`='$keterangan' where id_absent='$id'");
  if ($sqli) {
    $_SESSION['alert_approve'] = 'Approve';
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
