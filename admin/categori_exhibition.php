<?php
include '../database.php';
if (isset($_POST['btn_tbh_categori'])) {
  $categori = htmlspecialchars($_POST['categori']);
  $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id`) As id FROM `tb_categori_exhibition`"));
  $idbr = $max['id'] + 1;
  $categoripameran = mysqli_query($conn, "INSERT INTO `tb_categori_exhibition`(`category`, `id`) VALUES ('$categori',$idbr)");
  if ($categoripameran) {
    $notifsukses = $_SESSION['sukses'] =  'Data Berhasil Disimpan';
  } else {
    $notifgagal = $_SESSION['gagal'] = 'Data Gagal Disimpan';
  }
}

if (isset($_POST['btn_edit_categori'])) {
  $categori = htmlspecialchars($_POST['categori']);
  $kode = htmlspecialchars($_POST['kode']);
  $editpameran = mysqli_query($conn, "UPDATE `tb_categori_exhibition` SET `category`=' $categori' WHERE `tb_categori_exhibition`.`id`='$kode'");
  if ($editpameran) {
    $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
  } else {
    $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil di Edit!';
  }
}

$categori_exhibition = mysqli_query($conn, "SELECT * FROM tb_categori_exhibition ORDER BY id DESC");
$exhibition = mysqli_fetch_array($categori_exhibition);
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
              <h1 class="h3 mb-mb-4 text-uppercase">Kategori Pameran</h1>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4 ">
            <div class="card-header py-3">
              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#category_exhibition"><i class="fas fa-plus-square"></i> Tambah Kategori Pameran</a>
            </div>
            <div class="card-body">
              <div class="table-responsive overflow-hidden">
                <table class="table table-bordered mydatatable" id="dataTable" width="100%">
                  <thead class=" text-md-center bg-dark text-light">
                    <tr>
                      <th width="10">No</th>
                      <th>Kategori Pameran</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody class=" text-md-center">
                    <?php $i = 1; ?>
                    <?php foreach ($categori_exhibition as $row) : ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row["category"]; ?></td>
                        <td width="50">
                          <!-- Get data categori doa -->
                          <a id="edit_categori" data-toggle="modal" data-target="#edit" data-ctg="<?= $row["category"]; ?>" data-kode="<?= $row["id"]; ?>">
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
  include 'models/m_categori_exhibition.php';
  include 'template/script.php';
  include 'template/alert.php';
  ?>

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


    $(document).on("click", "#edit_categori", function() {
      let categori = $(this).data('ctg');
      let kode = $(this).data('kode');
      $(" #modal-edit #categori").val(categori);
      $(" #modal-edit #kode").val(kode);

    });
  </script>
</body>

</html>