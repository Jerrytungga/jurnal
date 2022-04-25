<?php
include '../database.php';
session_start();
include 'template/Session.php';

$sqli_pembelajaran = mysqli_query($conn, "SELECT * FROM `tb_pembelajaran` ");
$pembelajaran = mysqli_fetch_array($sqli_pembelajaran);

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
              <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Pengembangan Diri (Kerohanian)</h1>
            </div>
          </div>
          <!-- DataTales Example -->

          <div class="card shadow mb-4 ">
            <div class="card-header py-3">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pembelajaran">
                Tambah Materi Pembelajaran
              </button>
            </div>
            <div class="card-body">
              <div class="table-responsive overflow-hidden">
                <table class="table table-bordered table-hover mydatatable" id="dataTable" width="100%">
                  <thead class=" text-md-center">
                    <tr>
                      <th width="10">Kode</th>
                      <th>Meteri Pembelajaran</th>
                      <th>Target</th>
                      <th>Bobot</th>
                      <th>Semester</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody class=" text-md-center">
                    <?php foreach ($sqli_pembelajaran  as $row) : ?>
                      <tr>
                        <td><?= $row['kd_pembelajaran'] ?></td>
                        <td><?= $row['materi_pembelajaran'] ?></td>
                        <td><?= $row['target'] ?></td>
                        <td><?= $row['bobot'] ?></td>
                        <td><?= $row['semester'] ?></td>
                        <td><?= $row['status'] ?></td>


                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>






            <!-- Tambah materi pembelajaran -->
            <div class="modal fade" id="pembelajaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>

    <!-- script dataTable jurusan -->
    <script>
      $(document).ready(function() {
        $('#dataTable').DataTable({
          scrollY: 800,
          scrollX: true,
          scrollCollapse: true,
          paging: true
        });
      });

      $(document).ready(function() {
        $('#tableschedule').DataTable({
          scrollY: 500,
          scrollX: true,
          scrollCollapse: true,
          paging: true
        });
      });
    </script>


    </script>

</body>

</html>