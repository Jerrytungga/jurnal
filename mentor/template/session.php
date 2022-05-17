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
  $get_semester = mysqli_query($conn, "SELECT * FROM tb_semester WHERE status='Aktif'");
  $data1 = mysqli_fetch_array($get_semester);
  $data_semester = $_SESSION['smt'] =  $data1['thn_semester'];
  $semester_keterangan = $_SESSION['smt'] =  $data1['keterangan'];
  // echo "else";
}
