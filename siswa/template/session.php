<?php
// // cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['role'])) {
  echo "<script type='text/javascript'>
  alert('Anda harus login terlebih dahulu!');
  window.location = '../index.php'
</script>";
  //echo "tanpa role";
} else if ($_SESSION['role'] == "Mentor") {
  header("location:../mentor/profile.php");
} else if ($_SESSION['role'] == "Admin") {
  header("location:../admin/index.php");
} else {
  $id = $_SESSION['id_Siswa'];
  $get_data = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$id'");
  $data = mysqli_fetch_array($get_data);
  // echo "else";
}
