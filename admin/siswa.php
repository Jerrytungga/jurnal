<?php
include '../database.php';
include 'models/function.php';
$siswa = query("SELECT * FROM siswa ORDER BY date DESC");
session_start();
// // cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['role'])) {
  echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu!');window.location='../index.php'</script>";
} else if ($_SESSION['role'] == "Siswa") {
  header("location:../siswa/index.php");
} else if ($_SESSION['role'] == "Mentor") {
  header("location:../mentor/index.php");
} else {
  $id = $_SESSION['id_Admin'];
  $get_data = mysqli_query($conn, "SELECT * FROM admin WHERE id='$id'");
  $data = mysqli_fetch_array($get_data);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Jurnal PKA</title>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <?php
    include './template/sidebar_menu.php';
    ?>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <?php
        include './template/topbar_menu.php';
        ?>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="group">
              <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Data Siswa</h1>
              <div class="alert alert-warning">
                Admin hanya menetapkan 1x di bagian Nis siswa selain nis admin bebas untuk mengedit.
              </div>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4 ">
            <div class="card-header py-3">
              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#siswa"><i class="fas fa-user-plus"></i></a>
            </div>
            <div class="card-body">
              <div class="table-responsive overflow-hidden">
                <table class="table table-bordered mydatatable" id="dataTable" width="100%">
                  <thead class=" text-md-center">
                    <tr>
                      <th>No</th>
                      <th width="90">Foto</th>
                      <th>Nis Siswa</th>
                      <th witdh="50">Nama Siswa</th>
                      <th>Angkatan</th>
                      <th>Gender</th>
                      <th>Jurusan</th>
                      <th>Bimbel</th>
                      <th>Mentor</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Status</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody class=" text-md-center">
                    <?php $i = 1;
                    // function mentor($mentor)
                    // {
                    //   global $conn;
                    //   $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mentor WHERE efata='$mentor'"));
                    //   return $sqly['name'];
                    // }
                    // function jurusan($jurusan)
                    // {
                    //   global $conn;
                    //   $sqly2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_jurusan WHERE id='$jurusan'"));
                    //   return $sqly2['jurusan'];
                    // }
                    // function angkatan($angkatan)
                    // {
                    //   global $conn;
                    //   $sqly3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_angkatan WHERE id='$angkatan'"));
                    //   return $sqly3['angkatan'];
                    // }
                    ?>
                    <?php foreach ($siswa as $row) : ?>

                      <tr>
                        <td><?= $i; ?></td>
                        <td>
                          <img src="../img/foto_siswa/<?= $row["image"]; ?>" width="90">
                        </td>
                        <td><?= $row["nis"]; ?></td>
                        <td witdh="50"><?= $row["name"]; ?></td>
                        <td><?= $row["angkatan"]; ?></td>
                        <td><?= $row["gender"]; ?></td>
                        <td><?= $row["jurusan"]; ?></td>
                        <td><?= $row["bimbel"]; ?></td>
                        <td><?= $row["mentor"]; ?></td>
                        <td><?= $row["username"]; ?></td>
                        <td><?= $row["password"]; ?></td>
                        <td><?= $row["status"]; ?></td>
                        <td width="50">
                          <!-- Get data Siswa -->
                          <a id="edit_siswa" data-toggle="modal" data-target="#edit" data-foto="<?= $row["image"]; ?>" data-nis="<?= $row["nis"]; ?>" data-nama="<?= $row["name"]; ?>" data-angkatan="<?= $row["angkatan"]; ?>" data-gender="<?= $row["gender"]; ?>" data-jurusan="<?= $row["jurusan"]; ?>" data-bimbel="<?= $row["bimbel"]; ?>" data-mentor="<?= $row["mentor"]; ?>" data-username="<?= $row["username"]; ?>" data-password="<?= $row["password"]; ?>" data-status="<?= $row["status"]; ?>">
                            <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button></a>
                        </td>
                      </tr>
                      <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <?php
        include './template/footer.php';
        ?>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <?php
  include 'models/m_logout.php';
  include 'models/m_siswa.php';
  ?>
  <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- script dataTable mentor -->
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable({
        scrollY: 500,
        scrollX: true,
        scrollCollapse: true,
        paging: true
      });
    });

    //js untuk edit siswa
    $(document).on("click", "#edit_siswa", function() {
      let image = $(this).data('foto');
      let nis = $(this).data('nis');
      let name = $(this).data('nama');
      let angkatan = $(this).data('angkatan');
      let gender = $(this).data('gender');
      let jurusan = $(this).data('jurusan');
      let bimbel = $(this).data('bimbel');
      let mentor = $(this).data('mentor');
      let username = $(this).data('username');
      let password = $(this).data('password');
      let status = $(this).data('status');
      $(" #modal-edit #nis").val(nis);
      $(" #modal-edit #name").val(name);
      $(" #modal-edit #angkatan").val(angkatan);
      $(" #modal-edit #gender").val(gender);
      $(" #modal-edit #jurusan").val(jurusan);
      $(" #modal-edit #bimbel").val(bimbel);
      $(" #modal-edit #mentor").val(mentor);
      $(" #modal-edit #username").val(username);
      $(" #modal-edit #password").val(password);
      $(" #modal-edit #status").val(status);
      $(" #modal-edit #image").attr("src", "../img/foto_siswa/" + image);
    });
  </script>
</body>

</html>