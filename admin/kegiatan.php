<?php
include '../database.php';
session_start();
include 'template/Session.php';


//input data activity
if (isset($_POST['btn_tambah_item'])) {
  $item = htmlspecialchars($_POST['item_activity']);
  $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_activity`) As id FROM `activity`"));
  $idbr = $max['id'] + 1;
  $dataactivity = mysqli_query($conn, "INSERT INTO `activity`(`items`,`id_activity`) VALUES ('$item',$idbr)");
  if ($dataactivity) {
    $notif = $_SESSION['sukses'] = 'Items Activity Berhasil Disimpan';
  } else {
    $notifgagal = $_SESSION['gagal'] = 'Items Activity Gagal Disimpan';
  }
}

if (isset($_POST['addringtones'])) {
  $sumber = $_FILES['filUpload']['tmp_name'];
  $target = '../music/';
  $ringtones = $_FILES['filUpload']['name'];
  $max_id = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_alarm`) As id FROM `ringtones`"));
  $id_max = $max_id['id'] + 1;
  if ($ringtones != '') {
    if (move_uploaded_file($sumber, $target . $ringtones)) {
      $addnadaalarm =  mysqli_query($conn, "INSERT INTO `ringtones`(`id_alarm`, `Ringtones`) VALUES ('$id_max','$ringtones')");
    }
  }
}

//edit data activity
if (isset($_POST['btn_edit_activity'])) {
  $activity = htmlspecialchars($_POST['itemactivity']);
  $kode = htmlspecialchars($_POST['kode']);
  $data_activity = mysqli_query($conn, "UPDATE `activity` SET `items`='$activity',`id_activity`='$kode' WHERE `activity`.`id_activity` = '$kode'");
  if ($data_activity) {
    echo "<script>alert('Items Berhasil di Edit!');</script>";
  } else {
    echo "<script>alert('items gagal di Edit!');</script>";
  }
}

if (isset($_POST['hapus'])) {
  $idschedule = htmlspecialchars($_POST['id']);
  $scheduledata = htmlspecialchars($_POST['aktivitas']);
  $hapus =  mysqli_query($conn, "DELETE FROM `schedule`  WHERE `id` ='$idschedule' AND `id_activity`='$scheduledata'");
}

if (isset($_POST['offallschedule'])) {
  $angkatansiswa1 = htmlspecialchars($_POST['angkatan']);
  $statusangkatan = htmlspecialchars($_POST['status']);
  $updateangkatan = mysqli_query($conn, "UPDATE `schedule` SET status='$statusangkatan' WHERE batch='$angkatansiswa1'");
}


//insert schedule
if (isset($_POST['insert_shedule'])) {
  $angkatansiswa = htmlspecialchars($_POST['angkatan']);
  $mm = htmlspecialchars($_POST['week']);
  $item_activity = htmlspecialchars($_POST['item_schedule']);
  $pesan = htmlspecialchars($_POST['info']);
  $date = htmlspecialchars($_POST['date']);
  $start_Waktu = htmlspecialchars($_POST['start_time']);
  $end_waktu = htmlspecialchars($_POST['end_time']);
  $waktu_absent = htmlspecialchars($_POST['absent_time']);
  $status = htmlspecialchars($_POST['status']);
  $timer = htmlspecialchars($_POST['txtAbsentTimer']);
  $alrm_nada = htmlspecialchars($_POST['alarm_nada']);
  $input_schedule = mysqli_query($conn, "INSERT INTO `schedule`(`batch`, `week`, `id_activity`, `info`,`date`, `start_time`, `end_time`,`absent_time`,   `status`,  `timer`,`nada_alarm`) VALUES ('$angkatansiswa','$mm','$item_activity','$pesan','$date','$start_Waktu','$end_waktu','$waktu_absent','$status', '$timer', '$alrm_nada')");
  if ($input_schedule) {
    echo "<script>alert('Schedule Berhasil di tambahkan!');</script>";
  } else {
    echo "<script>alert('Schedule gagal di tambahkan!');</script>";
  }
}

// update data schedule
if (isset($_POST['updateschedule'])) {
  $id_schedule = htmlspecialchars($_POST['idschedule']);
  $edit_angkatan = htmlspecialchars($_POST['angkatan']);
  $edit_week = htmlspecialchars($_POST['week']);
  $edit_schedule = htmlspecialchars($_POST['itemaktivitas']);
  $edit_pesan = htmlspecialchars($_POST['pesan']);
  $edit_tanggal = htmlspecialchars($_POST['tanggal']);
  $edit_waktu_mulai = htmlspecialchars($_POST['waktumulai']);
  $edit_waktu_akhir = htmlspecialchars($_POST['waktuakhir']);
  $edit_waktu_absensi = htmlspecialchars($_POST['waktuabsen']);
  $edit_status = htmlspecialchars($_POST['keterangan']);
  $edit_timer_absen = htmlspecialchars($_POST['timerabsen']);
  $nama_alarm_edit = htmlspecialchars($_POST['nada']);
  $edit_scheduledata = mysqli_query($conn, "UPDATE `schedule` SET `batch`='$edit_angkatan',`week`='$edit_week',`id_activity`='$edit_schedule',`info`='$edit_pesan',`start_time`='$edit_waktu_mulai',`end_time`='$edit_waktu_akhir',`absent_time`='$edit_waktu_absensi',`status`='$edit_status',`date`='$edit_tanggal',`timer`='$edit_timer_absen',`nada_alarm`='$nama_alarm_edit' WHERE `schedule`.`id`='$id_schedule' ");

  if ($edit_scheduledata) {
    echo "<script>alert('Schedule Berhasil di Update!');</script>";
  } else {
    echo "<script>alert('Schedule gagal di Update!');</script>";
  }
}




$activity = mysqli_query($conn, "SELECT * FROM activity ORDER BY id_activity ASC");
$daftar = mysqli_fetch_array($activity);
$jadwal = mysqli_query($conn, "SELECT * FROM schedule ORDER BY id ASC");
$list = mysqli_fetch_array($jadwal);
$sql_angkatan = mysqli_query($conn, "SELECT * FROM tb_angkatan") or die(mysqli_error($conn));
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
              <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Activity List</h1>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4 ">
            <div class="card-header py-3">
              <button class="btn btn-primary" data-toggle="modal" data-target="#activity">Add Items</button>
              <button class="btn btn-success" data-toggle="modal" data-target="#schedule">Today's Schedule</button>
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#targetpoin">
                Target Points
              </button>
            </div>
            <div class="card-body">
              <div class="table-responsive overflow-hidden">
                <table class="table table-bordered mydatatable" id="dataTable" width="100%">
                  <thead class=" text-md-center">
                    <tr>
                      <th width="10">No</th>
                      <th>Name Activity</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody class=" text-md-center">
                    <?php $i = 1; ?>
                    <?php foreach ($activity as $row) : ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row["items"]; ?></td>
                        <td width="50">
                          <!-- Get data items Activity-->
                          <a id="edit_items" data-toggle="modal" data-target="#edit" data-itemactivity="<?= $row["items"]; ?>" data-kode="<?= $row["id_activity"]; ?>" data-target1="<?= $row["target"]; ?>">
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
  include 'models/m_kegiatan.php';
  include 'models/m_schedule.php';
  include 'models/m_target_schedule.php';
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
  <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
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



    $(document).on("click", "#edit_items", function() {
      let itemactivity = $(this).data('itemactivity');
      let kode = $(this).data('kode');
      let target1 = $(this).data('target1');
      $(" #modal-edit #itemactivity").val(itemactivity);
      $(" #modal-edit #kode").val(kode);
      $(" #modal-edit #target1").val(target1);

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

  <script>
    $(document).on("click", "#edit_schedule", function() {
      let angkatan = $(this).data('angkatan');
      let idschedule = $(this).data('idschedule');
      let week = $(this).data('minggu');
      let itemaktivitas = $(this).data('itemaktivitas');
      let pesan = $(this).data('pesan');
      let tanggal = $(this).data('tanggal');
      let waktumulai = $(this).data('waktumulai');
      let waktuakhir = $(this).data('waktuakhir');
      let waktuabsen = $(this).data('waktuabsen');
      let keterangan = $(this).data('keterangan');
      let peserta = $(this).data('peserta');
      let timerabsen = $(this).data('timerabsen');
      let id = $(this).data('id');
      let aktivitas = $(this).data('aktivitas');
      let nada = $(this).data('nada');
      $(" #modal-editschedule #nada").val(nada);
      $(" #modal-editschedule #angkatan").val(angkatan);
      $(" #modal-editschedule #idschedule").val(idschedule);
      $(" #modal-editschedule #minggu").val(week);
      $(" #modal-editschedule #itemaktivitas").val(itemaktivitas);
      $(" #modal-editschedule #pesan").val(pesan);
      $(" #modal-editschedule #tanggal").val(tanggal);
      $(" #modal-editschedule #waktumulai").val(waktumulai);
      $(" #modal-editschedule #waktuakhir").val(waktuakhir);
      $(" #modal-editschedule #waktuabsen").val(waktuabsen);
      $(" #modal-editschedule #keterangan").val(keterangan);
      $(" #modal-editschedule #peserta").val(peserta);
      $(" #modal-editschedule #timerabsen").val(timerabsen);
      $(" #modal-hapus #id").val(id);
      $(" #modal-hapus #aktivitas").val(aktivitas);


    });
  </script>
</body>

</html>