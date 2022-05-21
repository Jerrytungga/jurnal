<?php
include '../database.php';
session_start();
include 'template/Session.php';


//input data jurusan
if (isset($_POST['btn_tambah_jurusan'])) {
  $jurusan = htmlspecialchars($_POST['jurusan']);
  $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id`) As id FROM `tb_jurusan`"));
  $idbr = $max['id'] + 1;
  $datajurusan = mysqli_query($conn, "INSERT INTO `tb_jurusan`(`jurusan`,`id`) VALUES ('$jurusan',$idbr)");
  if ($datajurusan) {
    $notifsukses = $_SESSION['sukses'] =  'Data Berhasil Disimpan';
  } else {
    $notifgagal = $_SESSION['gagal'] = 'Data Gagal Disimpan';
  }
}


//edit data jurusan
if (isset($_POST['btn_edit_jurusan'])) {
  $jurusan = htmlspecialchars($_POST['jurusan']);
  $kode = htmlspecialchars($_POST['kode']);
  $datajurusan = mysqli_query($conn, "UPDATE `tb_jurusan` SET `jurusan`='$jurusan',`id`='$kode' WHERE `tb_jurusan`.`id` = '$kode'");
  if ($datajurusan) {
    $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
  } else {
    $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil di Edit!';
  }
}

$jurusan = mysqli_query($conn, "SELECT * FROM tb_jurusan ORDER BY id DESC");
$j = mysqli_fetch_array($jurusan);
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
              <h1 class="h3 mb-mb-4 text-uppercase embed-responsive">Kategori Jurusan</h1>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4 ">
            <div class="card-header py-3">
              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#jurusan"><i class="fas fa-plus-square"></i> Tambah Kategori Jurusan</a>
            </div>
            <div class="card-body">
              <div class="table-responsive overflow-hidden">
                <table class="table table-bordered mydatatable" id="dataTable" width="100%">
                  <thead class=" text-md-center bg-dark text-light">
                    <tr>
                      <th width="10">No</th>
                      <th>Kategori Jurusan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody class=" text-md-center">
                    <?php $i = 1; ?>
                    <?php foreach ($jurusan as $row) : ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row["jurusan"]; ?></td>
                        <td width="50">
                          <!-- Get data jurusan -->
                          <a id="edit_jurusan" data-toggle="modal" data-target="#edit" data-jurusan="<?= $row["jurusan"]; ?>" data-kode="<?= $row["id"]; ?>">
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
  include 'models/m_jurusan.php';
  include 'template/script.php';
  include 'template/alert.php';
  ?>
  <!-- Bootstrap core JavaScript-->

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

    // Swal.fire(
    //   'Good job!',
    //   '',
    //   'success'
    // )


    $(document).on("click", "#edit_jurusan", function() {
      let jurusan = $(this).data('jurusan');
      let kode = $(this).data('kode');
      $(" #modal-edit #jurusan").val(jurusan);
      $(" #modal-edit #kode").val(kode);

    });
  </script>




</body>

</html>