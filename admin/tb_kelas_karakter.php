<?php
include '../database.php';
session_start();
include 'template/Session.php';
date_default_timezone_set('Asia/Jakarta');

$waktu_sekarang = date('H:i:s');
if (isset($_POST['insert'])) {
  $t_kelas_karakter = $_POST['target_kelas_karakter'];
  $t_karakter_tokoh = $_POST['target_kelas_tokoh_karakter'];
  $t_evaluasi_karakter = $_POST['target_kelas_evaluasi_karakter'];
  $sms = $_POST['semester'];
  $bobot = 3 * 4;
  $max_id = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_kelas_karakter`) As id FROM `tb_karakter`"));
  $id_max = $max_id['id'] + 1;
  if ($sms == 'NULL') {
    $notifgagal = $_SESSION['gagal'] = 'Semester belum di isi!';
  } else {
    $sqli_ = mysqli_query($conn, "INSERT INTO `tb_karakter`(`id_kelas_karakter`, `target_kelas_karakter`, `target_karakter_tokoh`, `target_evaluasi_karakter`, `semester`, `bobot`) VALUES ('$id_max','$t_kelas_karakter','$t_karakter_tokoh','$t_evaluasi_karakter','$sms','$bobot')");
    if ($sqli_) {
      $notifsukses = $_SESSION['sukses'] =  'Data Berhasil Disimpan';
    } else {
      $notifgagal = $_SESSION['gagal'] = 'Data Gagal Disimpan';
    }
  }
}
$sqli_karakter = mysqli_query($conn, "SELECT * FROM `tb_karakter` order by date DESC ");
$karakter = mysqli_fetch_array($sqli_karakter);
function semester($semester)
{
  global $conn;
  $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_semester where thn_semester='$semester'"));
  return $sqly['keterangan'];
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
              <h1 class="h3 mb-mb-4 text-uppercase embed-responsive">Kelas Karakter</h1>
            </div>
          </div>
          <!-- DataTales Example -->

          <div class="card shadow mb-4 ">
            <div class="card-header py-3">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Penetapan">
                Tambah Target
              </button>
            </div>
            <div class="card-body">
              <div class="table-responsive overflow-hidden">
                <table class="table table-bordered table-hover mydatatable" id="dataTable" width="100%">
                  <thead class=" text-md-center bg-dark text-light">
                    <tr>
                      <th width="10">No</th>
                      <th>Target Kelas Karakter (benar,ketat dan tepat)</th>
                      <th>Target Kelas Karakter (tokoh)</th>
                      <th>Target Kelas Evaluasi Karakter</th>
                      <th>Semester</th>
                      <th>Bobot</th>
                      <th>Tanggal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody class=" text-md-center">
                    <?php $i = 1; ?>
                    <?php foreach ($sqli_karakter  as $row) : ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row['target_kelas_karakter'] ?></td>
                        <td><?= $row['target_karakter_tokoh'] ?></td>
                        <td><?= $row['target_evaluasi_karakter'] ?></td>
                        <td><?= semester($row['semester']); ?></td>
                        <td><?= $row['bobot'] ?></td>
                        <td><?= $row['date'] ?></td>
                        <td>
                          <?php
                          $hari_ini = date('Y-m-d');
                          if ($hari_ini == $row['date']) { ?>
                            <a href="models/proses_delete.php?kelas_karakter=<?= $row['id_kelas_karakter'] ?>" type="button" class="btn btn-danger">Delete</a>
                          <?php    }
                          ?>

                        </td>


                      </tr>
                      <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Tambah materi pembelajaran -->
            <div class="modal fade" id="Penetapan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kelas Karakter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="" method="POST">
                    <div class="modal-body">
                      <div>
                        <label for="Target Karakter">Target Kelas Karakter (benar,ketat dan tepat)</label>
                        <input type="number" name="target_kelas_karakter" class="form-control mb-1" required>
                      </div>
                      <div>
                        <label for="Target karakter Tokoh">Target Kelas Karakter (tokoh)</label>
                        <input type="number" name="target_kelas_tokoh_karakter" class="form-control mb-1" required>
                      </div>
                      <div>
                        <label for="Target karakter evaluasi">Target Kelas Evaluasi Karakter</label>
                        <input type="number" name="target_kelas_evaluasi_karakter" class="form-control mb-1" required>
                      </div>

                      <!-- <div class="mt-2">
                        <label for="Target">Bobot</label>
                        <input type="number" class="form-control" name="bobot" required>
                      </div> -->
                      <div class="form-group mt-2">
                        <label for="semester">Semester :</label>
                        <select class="form-control" name="semester" id="semester" required>
                          <option value="NULL">Pilih Semester</option>
                          <?php
                          $sql_semester = mysqli_query($conn, "SELECT * FROM tb_semester");
                          while ($data_semester = mysqli_fetch_array($sql_semester)) {
                            echo '<option value="' . $data_semester['thn_semester'] . '">' . $data_semester['keterangan'] . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" name="insert" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
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