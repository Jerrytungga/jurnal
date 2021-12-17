<?php
include '../database.php';
// sistem ganti password siswa
if (isset($_POST['edit_profile'])) {
  $nis = htmlspecialchars($_POST['nis']);
  $password = htmlspecialchars($_POST['password']);
  $addtotable = mysqli_query($conn, "UPDATE `siswa` SET `password`='$password' WHERE `siswa`.`nis` = '$nis'");
  header('location:profile.php');
}
// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>My Profile</title>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <?php
    include 'template/sidebar_menu.php';
    ?>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->

        <?php
        include 'template/topbar_menu.php';
        ?>

        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
          </div>
          <div class="row">
            <!-- Content Column -->
            <div class="card mb-4 shadow-lg p-3 bg-body rounded" style="max-width: 700px;">
              <div class="card" style="width: 18rem;">
                <img src="../img/fotosiswa/<?= $data['image']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <h6 class="card-title">Name : <?= $data['name']; ?></h6>
                  <h6 class="card-title">Username : <?= $data['username']; ?></h6>
                  <h6 class="card-title">Password : <?= $data['password']; ?></h6>
                  <a id="edit_siswa" data-toggle="modal" data-target="#edit" data-foto="<?= $data["image"]; ?>" data-nis="<?= $data["nis"]; ?>" data-nama="<?= $data["name"]; ?>" data-username="<?= $data["username"]; ?>" data-password="<?= $data["password"]; ?>">
                    <button class="btn btn-info btn-warning">Ganti Password</button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <?php
        include 'template/footer.php';
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
  include 'modal/modal_profile.php';
  include 'modal/modal_logout.php';
  ?>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script>
    $(document).on("click", "#edit_siswa", function() {
      let image = $(this).data('foto');
      let nis = $(this).data('nis');
      let name = $(this).data('nama');
      let username = $(this).data('username');
      let password = $(this).data('password');
      $(" #modal-edit #nis").val(nis);
      $(" #modal-edit #name").val(name);
      $(" #modal-edit #username").val(username);
      $(" #modal-edit #password").val(password);
      $(" #modal-edit #image").attr("src", "../img/fotosiswa/" + image);
    });
  </script>
  <script>
    $(document).ready(function() {
      var living = document.getElementById('living');
      var waktu = new Date();
      var hari = waktu.getDay();
      var bulan = waktu.getMonth();


      if (hari == 7) {
        living.style.display = 'blok';
      } else {
        living.style.display = 'none';
      }
    });
  </script>
</body>


</html>