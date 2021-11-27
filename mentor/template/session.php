<?php
if (!isset($_SESSION['role'])) {
echo "<script type='text/javascript'>
  alert('Anda harus login terlebih dahulu!');
  window.location = '../index.php'
</script>";
} else if ($_SESSION['role'] == "Siswa") {
header("location:../siswa/index.php");
} else if ($_SESSION['role'] == "Admin") {
header("location:../admin/index.php");
} else {
$id = $_SESSION['id_Mentor'];
$get_data = mysqli_query($conn, "SELECT * FROM mentor WHERE efata='$id'");
$data = mysqli_fetch_array($get_data);
}
