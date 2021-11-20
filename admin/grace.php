<?php
include '../database.php';

//input data jurusan
if (isset($_POST['btn_tambah_grace'])) {
  $grace = htmlspecialchars($_POST['grace']);
  $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id`) As id FROM `tb_grace`"));
  $idbr = $max['id'] + 1;
  $datagrace = mysqli_query($conn, "INSERT INTO `tb_grace`(`grace`,`id`) VALUES ('$grace',$idbr)");
  if ($datagrace) {
    echo "<script>alert('Grace Berhasil ditambahkan!');</script>";
  } else {
    echo "<script>alert('Grace gagal ditambahkan');</script>";
  }
}

//edit data jurusan
if (isset($_POST['btn_edit_grace'])) {
  $grace = htmlspecialchars($_POST['ctg']);
  $kode = htmlspecialchars($_POST['kode']);
  $data_grace = mysqli_query($conn, "UPDATE `tb_grace` SET `grace`='$grace',`id`='$kode' WHERE `tb_grace`.`id` = '$kode'");
  if ($data_grace) {
    echo "<script>alert('Grace Berhasil di Edit!');</script>";
  } else {
    echo "<script>alert('Grace gagal di Edit!');</script>";
  }
}

$grace = mysqli_query($conn, "SELECT * FROM tb_grace ORDER BY id DESC");
$p = mysqli_fetch_array($grace);
session_start();
include 'template/Session.php';
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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="group">
              <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Categori Grace</h1>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4 ">
            <div class="card-header py-3">
              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#punishment"><i class="fas fa-plus-square"></i></a>
            </div>
            <div class="card-body">
              <div class="table-responsive overflow-hidden">
                <table class="table table-bordered mydatatable" id="dataTable" width="100%">
                  <thead class=" text-md-center">
                    <tr>
                      <th width="10">No</th>
                      <th>Grace</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody class=" text-md-center">
                    <?php $i = 1; ?>
                    <?php foreach ($grace as $row) : ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row["grace"]; ?></td>
                        <td width="50">
                          <!-- Get data Punishment -->
                          <a id="edit_grace" data-toggle="modal" data-target="#edit" data-ctg="<?= $row["grace"]; ?>" data-kode="<?= $row["id"]; ?>">
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
  include 'models/m_logout.php';
  include 'models/m_grace.php';
  ?>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- script dataTable jurusan -->
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable({
        scrollY: 500,
        scrollX: true,
        scrollCollapse: true,
        paging: true
      });
    });


    $(document).on("click", "#edit_grace", function() {
      let kode = $(this).data('kode');
      let ctg = $(this).data('ctg');
      $(" #modal-edit #ctg").val(ctg);
      $(" #modal-edit #kode").val(kode);

    });
  </script>
</body>

</html>