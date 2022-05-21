<?php
include '../database.php';
session_start();
include 'template/Session.php';


//input data jurusan
if (isset($_POST['btn_tambah_target'])) {
  $presensi = htmlspecialchars($_POST['presensi']);
  $jurnal = htmlspecialchars($_POST['jurnal']);
  $sms = htmlspecialchars($_POST['semester']);
  $pemeriksaan = htmlspecialchars($_POST['pemeriksaan']);
  $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_target`) As id FROM `tb_target_jurnal`"));
  $idbr = $max['id'] + 1;
  $datatarget_jurnal = mysqli_query($conn, "INSERT INTO `tb_target_jurnal`(`id_target`, `presensi`, `semester`, `jurnal_pka`, `pemeriksaan`) VALUES ('$idbr','$presensi','$sms','$jurnal','$pemeriksaan')");
  if ($datatarget_jurnal) {
    $notifsukses = $_SESSION['sukses'] =  'Data Berhasil Disimpan';
  } else {
    $notifgagal = $_SESSION['gagal'] = 'Data Gagal Disimpan';
  }
}


//edit data jurusan
if (isset($_POST['btn_edit_target'])) {
  $id_kode = htmlspecialchars($_POST['kode']);
  $presensi1 = htmlspecialchars($_POST['presensi']);
  $jurnal1 = htmlspecialchars($_POST['jurnal']);
  $sms1 = htmlspecialchars($_POST['semester']);
  $pemeriksaan1 = htmlspecialchars($_POST['pemeriksaan']);
  $max1 = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_target`) As id FROM `tb_target_jurnal`"));
  $idbr1 = $max1['id'] + 1;
  $data_edit = mysqli_query($conn, "UPDATE `tb_target_jurnal` SET `id_target`='$idbr1',`presensi`='$presensi1',`semester`='$sms1',`jurnal_pka`='$jurnal1',`pemeriksaan`='$pemeriksaan1' WHERE `id_target`='$id_kode'");
  if ($data_edit) {
    $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
  } else {
    $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil di Edit!';
  }
}

$target_jurnal = mysqli_query($conn, "SELECT * FROM tb_target_jurnal ORDER BY id_target DESC");
$array_jurnal = mysqli_fetch_array($target_jurnal);
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
              <h1 class="h3 mb-mb-4 text-uppercase embed-responsive">Target Jurnal PKA</h1>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-6 ">
            <div class="card-header py-3">
              <a href="" class="btn btn-primary " data-toggle="modal" data-target="#target"><i class="fas fa-plus-square"></i> Tambah Target </a>
            </div>
            <div class="card-body">
              <div class="table-responsive overflow-hidden">
                <table class="table table-bordered mydatatable" id="dataTable" width="100%">
                  <thead class=" text-md-center bg-dark text-light">
                    <tr>
                      <th width="10">No</th>
                      <th>Presensi</th>
                      <th>Jurnal</th>
                      <th>Pemerikasaan</th>
                      <th>Semester</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody class=" text-md-center">
                    <?php $i = 1; ?>
                    <?php foreach ($target_jurnal  as $row) : ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row['presensi']; ?></td>
                        <td><?= $row['jurnal_pka']; ?></td>
                        <td><?= $row['pemeriksaan']; ?></td>
                        <td><?= $row['semester']; ?></td>
                        <td width="50">
                          <!-- Get data jurusan -->
                          <a id="edit_target" data-toggle="modal" data-target="#edit" data-presensi1="<?= $row["presensi"]; ?>" data-kode="<?= $row["id_target"]; ?>" data-jurnal1="<?= $row['jurnal_pka']; ?>" data-semesterjurnal="<?= $row['semester']; ?>" data-pemeriksaan1="<?= $row['pemeriksaan']; ?>">
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
  include 'models/m_target_jurnal_pka.php';
  include 'template/script.php';
  include 'template/alert.php';
  ?>

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


    $(document).on("click", "#edit_target", function() {
      let presensi1 = $(this).data('presensi1');
      let kode = $(this).data('kode');
      let jurnal1 = $(this).data('jurnal1');
      let semesterjurnal = $(this).data('semesterjurnal');
      let pemeriksaan1 = $(this).data('pemeriksaan1');
      $(" #modal-edit #presensi1").val(presensi1);
      $(" #modal-edit #kode").val(kode);
      $(" #modal-edit #jurnal1").val(jurnal1);
      $(" #modal-edit #semesterjurnal").val(semesterjurnal);
      $(" #modal-edit #pemeriksaan1").val(pemeriksaan1);

    });
  </script>

  <?php if (isset($notif)) { ?>
    <script>
      Swal.fire({
        position: 'top-end',
        size: '20px',
        icon: 'success',
        title: '<?php echo $notif; ?>',
        showConfirmButton: false,
        timer: 1500
      })
    </script>

    <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($notif);
  } else if (isset($notifgagal)) { ?>

    <script>
      Swal.fire({
        position: 'top-end',
        size: '20px',
        icon: 'error',
        title: '<?php echo $notifgagal; ?>',
        showConfirmButton: false,
        timer: 1500
      })
    </script>

  <?php session_destroy();
  } ?>


</body>

</html>