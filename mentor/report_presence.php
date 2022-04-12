<?php
include '../database.php';
session_start();
include 'template/session.php';
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-j');
$waktu_sekarang = date('H:i:s');


if (isset($_POST['nis'])) {
  $nis = $_POST['nis'];
} else {
  $nis = '';
}



if (isset($_POST['filter_tanggal'])) {
  $mulai = $_POST['tanggal_mulai'];
  $selesai = $_POST['tanggal_akhir'];
  $nis = $_POST['nis'];


  if ($mulai != null || $selesai != null || $nis != null) {
    $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' and ACC_Mentor='approved' and absent_date BETWEEN '$mulai' AND '$selesai'  and mentor='$id'  order by absent_time DESC");
  } else {

    $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$nis'and ACC_Mentor='approved' and absent_date BETWEEN '$mulai' AND '$selesai'  and mentor='$id'  order by absent_time DESC");
    $array_absent = mysqli_fetch_array($Sqli_absent);
  }
} else {
  $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' and ACC_Mentor='approved' and  mentor='$id'  order by absent_time DESC");
  $array_absent = mysqli_fetch_array($Sqli_absent);
}
if (isset($_POST['reset'])) {
  $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' and ACC_Mentor='approved' and  mentor='$id'  order by absent_time DESC");
  $array_absent = mysqli_fetch_array($Sqli_absent);
}

$Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' and ACC_Mentor='approved' and  mentor='$id'  order by absent_time DESC");
$array_absent = mysqli_fetch_array($Sqli_absent);










//function data siswa
function nama_siswa($name_siswa)
{
  global $conn;
  $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$name_siswa'"));
  return $sqly['name'];
} //akhir functioan data siswa


// function data kegiatan
function kegiatan($name_kegiatan)
{
  global $conn;
  $sqly3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$name_kegiatan'"));
  return $sqly3['items'];
} // akhir function data kegiatan 




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Presence Siswa</title>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
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
              <h1 class="h3 mb-mb-4 embed-responsive text-gray-800">Presence Siswa</h1>
              <a href="presensi_siswa_mentor.php" type="button" class="btn mt-2 btn-outline-success ">Presence</a>
              <a href="report_presence.php" type="button" class="btn mt-2 btn-outline-danger active">Report</a>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4 ">
            <div class="card-header py-3">
              <div class="form-inline">

                <form action="" method="POST">

                  <select class="form-control" required name="nis" aria-label="Default select example">
                    <?php
                    if (isset($_POST['nis'])) {
                      $daftarsiswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa where status='Aktif' and mentor='$id' and nis='" . $_POST['nis'] . "'"));
                    ?>

                      <option value="<?= $daftarsiswa['nis']; ?>"><?= $daftarsiswa['name']; ?></option>
                    <?php } else {
                      echo "<option selected>Pilih Siswa</option>";
                    }
                    $daftarsiswa = mysqli_query($conn, "SELECT * FROM siswa where status='Aktif' and mentor='$id'");
                    while ($data1 = mysqli_fetch_array($daftarsiswa)) { ?>
                      <option value="<?= $data1['nis']; ?>"><?= $data1['name']; ?></option>

                    <?php }
                    ?>

                  </select>
                  <?php
                  if (isset($_POST['filter_tanggal'])) {
                    $mulai = $_POST['tanggal_mulai'];
                    $selesai = $_POST['tanggal_akhir'];
                    $nis = $_POST['nis'];
                  ?>
                    <input type="date" name="tanggal_mulai" value="<?= $mulai ?>" class="form-control ml-3">
                    <input type="date" name="tanggal_akhir" value="<?= $selesai ?>" class="form-control ml-3">
                  <?php
                  } else {
                  ?>
                    <input type="date" name="tanggal_mulai" class="form-control ml-3">
                    <input type="date" name="tanggal_akhir" class="form-control ml-3">
                  <?php } ?>
                  <button type="submit" name="filter_tanggal" class="btn btn-info ml-3">Filter</button>
                  <button type="submit" name="reset" value="reset" class="btn btn-danger ml-3">Reset</button>
                </form>
                <a href="./excel.php?nis=<?= $nis; ?>&mulai=<?= $mulai; ?>&akhir=<?= $selesai; ?>" target="_blank" type="button" class="btn btn-success ml-3">Download Report</a>
              </div>







            </div>
            <div class="card-body">
              <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead class="text-md-center">
                    <tr class="bg-info">
                      <th width="10">No</th>
                      <th>Name Siswa</th>
                      <th>Schedule</th>
                      <th>Schedule Time</th>
                      <th>Presence Time</th>
                      <th>Status</th>
                      <th>Mentor Suggestion</th>
                      <th>Presence date</th>
                    </tr>
                  </thead>

                  <tbody class="text-md-center">
                    <?php $i = 1; ?>

                    <?php foreach ($Sqli_absent as $row) :
                    ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= nama_siswa($row["nis"]); ?></td>
                        <td><?= kegiatan($row["id_activity"]); ?></td>
                        <td>
                          <?php
                          // mengambil waktu kegiatanm di tabel kegiatan berdasarkan id kegiatan
                          $id_kegiatan = $row["schedule_id"];
                          $sqly4 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schedule WHERE id='$id_kegiatan'"));
                          $waktu_kegiatan = $sqly4['start_time']
                          ?>
                          <?= $waktu_kegiatan; ?>

                        </td>
                        <td><?= $row["absent_time"]; ?></td>
                        <td>
                          <?php
                          if ($row['mark'] == 'V') { ?>
                            <span class="badge badge-pill badge-primary"><?= $row['mark']; ?></span>
                          <?php  } else if ($row['mark'] == 'O') { ?>
                            <span class="badge badge-pill badge-warning"><?= $row['mark']; ?></span>
                          <?php   } else if ($row['mark'] == 'X') { ?>
                            <span class="badge badge-pill badge-danger"><?= $row['mark']; ?></span>
                          <?php  } else if ($row['mark'] == 'I') { ?>
                            <span class="badge badge-pill badge-info"><?= $row['mark']; ?></span>
                          <?php   }
                          ?>
                        </td>
                        <td><?= $row["catatan"]; ?></td>
                        <td><?= $row["absent_date"]; ?></td>
                      </tr>

                      <?php $i++; ?>
                    <?php endforeach;
                    ?>
                  </tbody>
                  <tfoot>

                    <?php

                    $tampil = mysqli_query($conn, "SELECT * FROM absent where nis='$nis'  AND absent_date='$hari_ini' ");
                    $array_presensi = mysqli_fetch_array($tampil);
                    $mark_V = $array_presensi['mark'] = 'V';
                    $mark_O = $array_presensi['mark'] = 'O';
                    $mark_X = $array_presensi['mark'] = 'X';
                    $mark_I = $array_presensi['mark'] = 'I';
                    $mark_S = $array_presensi['mark'] = 'S';

                    $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and ACC_Mentor='approved' and mark='$mark_V' ");
                    $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                    $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and ACC_Mentor='approved' and mark='$mark_O' ");
                    $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                    $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and ACC_Mentor='approved' and mark='$mark_X'");
                    $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                    $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and ACC_Mentor='approved' and mark='$mark_I'");
                    $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                    $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and ACC_Mentor='approved' and mark='$mark_S'");
                    $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                    $total = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];

                    ?>
                    <th class="bg-warning text-right" colspan="7"> Total Point : </th>
                    <th class="text-center"><?= $total; ?></th>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php
      include 'template/footer_menu.php';
      ?>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <?php
  include 'modal/modal_logout.php';
  include 'modal/modal_presence.php';
  include 'template/script.php';
  include 'template/alert.php';
  ?>

  <script>
    $(document).on("click", "#PSN", function() {
      var id_absent1 = $(this).data('id_absent1');
      var pesan_mentor = $(this).data('pesan_mentor');
      $(" #modal-pesan_mentor #id_absent1").val(id_absent1);
      $(" #modal-pesan_mentor #pesan_mentor").val(pesan_mentor);
    });
    $(document).on("click", "#edit_schedule", function() {
      var nis1 = $(this).data('nis1');
      var item_schedule1 = $(this).data('item_schedule1');
      var mark1 = $(this).data('mark1');
      var date1 = $(this).data('date1');
      var time1 = $(this).data('time1');
      var agreement1 = $(this).data('agreement1');
      var catatan1 = $(this).data('catatan1');
      var id1 = $(this).data('id1');
      $(" #modal-edit_shedule #id1").val(id1);
      $(" #modal-edit_shedule #nis1").val(nis1);
      $(" #modal-edit_shedule #item_schedule1").val(item_schedule1);
      $(" #modal-edit_shedule #mark1").val(mark1);
      $(" #modal-edit_shedule #date1").val(date1);
      $(" #modal-edit_shedule #time1").val(time1);
      $(" #modal-edit_shedule #agreement1").val(agreement1);
      $(" #modal-edit_shedule #catatan1").val(catatan1);
    });
  </script>


</body>

</html>