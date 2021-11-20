<?php
// // cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['role'])) {
  echo "<script type='text/javascript'>
  alert('Anda harus login terlebih dahulu!');
  window.location = '../index.php'
</script>";
} else if ($_SESSION['role'] == "Siswa") {
  header("location:../siswa/profile.php");
} else if ($_SESSION['role'] == "Mentor") {
  header("location:../mentor/profile.php");
} else {
  $id = $_SESSION['id_Admin'];
  $get_data = mysqli_query($conn, "SELECT * FROM admin WHERE id='$id'");
  $data = mysqli_fetch_array($get_data);
}
