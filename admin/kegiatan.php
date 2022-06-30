<?php
include '../database.php';
session_start();
include 'template/Session.php';
$get_semester = mysqli_query($conn, "SELECT * FROM tb_semester WHERE status='Aktif'");
$data1 = mysqli_fetch_array($get_semester);
$data_semester = $_SESSION['smt'] =  $data1['thn_semester'];

//proses input list kegiatan
if (isset($_POST['btn_tambah_item'])) {
  $item = htmlspecialchars($_POST['item_activity']);
  $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_activity`) As id FROM `activity`"));
  $idbr = $max['id'] + 1;
  $dataactivity = mysqli_query($conn, "INSERT INTO `activity`(`items`,`id_activity`) VALUES ('$item',$idbr)");
  if ($dataactivity) {
    $notifsukses = $_SESSION['sukses'] =  'Data Berhasil Disimpan';
  } else {
    $notifgagal = $_SESSION['gagal'] = 'Data Gagal Disimpan';
  }
}

// proses input nada alarm
if (isset($_POST['addringtones'])) {
  $sumber = $_FILES['filUpload']['tmp_name'];
  $target = '../music/';
  $ringtones = $_FILES['filUpload']['name'];
  $max_id = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_alarm`) As id FROM `ringtones`"));
  $id_max = $max_id['id'] + 1;
  if ($ringtones != '') {
    if (move_uploaded_file($sumber, $target . $ringtones)) {
      $addnadaalarm =  mysqli_query($conn, "INSERT INTO `ringtones`(`id_alarm`, `Ringtones`) VALUES ('$id_max','$ringtones')");
      if ($addnadaalarm) {
        $notifsukses = $_SESSION['sukses'] =  'Data Berhasil Disimpan';
      } else {
        $notifgagal = $_SESSION['gagal'] = 'Data Gagal Disimpan';
      }
    }
  }
}

//edit data list kegiatan
if (isset($_POST['btn_edit_activity'])) {
  $activity = htmlspecialchars($_POST['itemactivity']);
  $kode = htmlspecialchars($_POST['kode']);
  $data_activity = mysqli_query($conn, "UPDATE `activity` SET `items`='$activity',`id_activity`='$kode' WHERE `activity`.`id_activity` = '$kode'");
  if ($data_activity) {
    $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
  } else {
    $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil di Edit!';
  }
}

// proses input target
if (isset($_POST['addtarget'])) {
  $hari = htmlspecialchars($_POST['Day']);
  $datatarget = htmlspecialchars($_POST['target']);
  $minggu = htmlspecialchars($_POST['week']);
  $angkatan1 = htmlspecialchars($_POST['angkatan1']);
  $max_idtarget = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_tabel_presence`) As id FROM `tb_target_presensi`"));
  $id_maxtarget = $max_idtarget['id'] + 1;
  $tambahdatatarget =  mysqli_query($conn, "INSERT INTO `tb_target_presensi`(`id_tabel_presence`, `target`, `Day`,`semester`,`week`,`batch`) VALUES ('$id_maxtarget ','$datatarget','$hari','$data_semester ','$minggu','$angkatan1') ");
  if ($tambahdatatarget) {
    $notifsukses = $_SESSION['sukses'] =  'Data Berhasil Disimpan';
  } else {
    $notifgagal = $_SESSION['gagal'] = 'Data Gagal Disimpan';
  }
}

// proses edit target
if (isset($_POST['updatetarget'])) {
  $id_target = htmlspecialchars($_POST['id_taget_presensi']);
  $edit_hari = htmlspecialchars($_POST['hari']);
  $edit_target = htmlspecialchars($_POST['target2']);
  $edit_minggu = htmlspecialchars($_POST['week']);
  $angkatan2 = htmlspecialchars($_POST['angkatan2']);
  $eitdatatarget =  mysqli_query($conn, "UPDATE `tb_target_presensi` SET `target`=' $edit_target ',`Day`='$edit_hari',`week`='$edit_minggu',`batch`='$angkatan2' WHERE `id_tabel_presence`='$id_target'");
  if ($eitdatatarget) {
    $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
  } else {
    $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil di Edit!';
  }
}


// proses hapus list kegiatan
if (isset($_POST['hapus'])) {
  $idschedule = htmlspecialchars($_POST['id']);
  $scheduledata = htmlspecialchars($_POST['aktivitas']);
  $hapus =  mysqli_query($conn, "DELETE FROM `schedule`  WHERE `id` ='$idschedule' AND `id_activity`='$scheduledata'");
  if ($hapus) {
    $notifsuksesedit = $_SESSION['sukses'] = 'Berhasil di Hapus!';
  }
}

// proses on-off semua kegiatan
if (isset($_POST['offallschedule'])) {
  $angkatansiswa1 = htmlspecialchars($_POST['angkatan']);
  $statusangkatan = htmlspecialchars($_POST['status']);
  $updateangkatan = mysqli_query($conn, "UPDATE `schedule` SET status='$statusangkatan' WHERE batch='$angkatansiswa1'");
  if ($updateangkatan) {
    $notifsuksesedit = $_SESSION['sukses'] = 'Jadwal Berhasil di Update!';
  }
}


//proses insert schedule
if (isset($_POST['insert_shedule'])) {
  $angkatansiswa = htmlspecialchars($_POST['angkatan']);
  $mm = htmlspecialchars($_POST['week']);
  $item_activity = htmlspecialchars($_POST['item_schedule']);
  $pesan = htmlspecialchars($_POST['info']);
  $date = htmlspecialchars($_POST['date']);
  $start_Waktu = htmlspecialchars($_POST['start_time']);
  $end_waktu = htmlspecialchars($_POST['end_time']);
  $waktu_absent = htmlspecialchars($_POST['presensi_time']);
  $status = htmlspecialchars($_POST['status']);
  $timer = htmlspecialchars($_POST['txtAbsentTimer']);
  $alrm_nada = htmlspecialchars($_POST['alarm_nada']);
  if ($_POST['end_time'] < $_POST['start_time']) {
    $pesan = $_SESSION['gagal'] =  '<p class="text-danger"><strong>PERINGATAN!</strong></p>';
  } else {
    if ($_POST['start_time'] < $_POST['presensi_time']) {
      $pesan_presensi = $_SESSION['gagal'] =  '<p class="text-danger"><strong>PERINGATAN!</strong></p>';
    } else {
      $input_schedule = mysqli_query($conn, "INSERT INTO `schedule`(`batch`, `week`, `id_activity`, `info`,`date`, `start_time`, `end_time`,`presensi_time`,   `status`,  `timer`,`nada_alarm`) VALUES ('$angkatansiswa','$mm','$item_activity','$pesan','$date','$start_Waktu','$end_waktu','$waktu_absent','$status', '$timer', '$alrm_nada')");
      if ($input_schedule) {
        $notifsukses = $_SESSION['sukses'] =  'Data Berhasil Disimpan';
      } else {
        $notifgagal = $_SESSION['gagal'] = 'Data Gagal Disimpan';
      }
    }
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
  $edit_scheduledata = mysqli_query($conn, "UPDATE `schedule` SET `batch`='$edit_angkatan',`week`='$edit_week',`id_activity`='$edit_schedule',`info`='$edit_pesan',`start_time`='$edit_waktu_mulai',`end_time`='$edit_waktu_akhir',`presensi_time`='$edit_waktu_absensi',`status`='$edit_status',`date`='$edit_tanggal',`timer`='$edit_timer_absen',`nada_alarm`='$nama_alarm_edit' WHERE `schedule`.`id`='$id_schedule' ");

  if ($edit_scheduledata) {
    $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
  } else {
    $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil di Edit!';
  }
}

// SELECT schedule.batch, tb_target_presensi.target, tb_target_presensi.date FROM schedule INNER JOIN tb_target_presensi ON schedule.date=tb_target_presensi.date;
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
$activity = mysqli_query($conn, "SELECT * FROM activity ORDER BY id_activity DESC");
$daftar = mysqli_fetch_array($activity);
$jadwal2 = mysqli_query($conn, "SELECT * FROM schedule  ORDER BY id DESC");
$jadwal = mysqli_query($conn, "SELECT * FROM schedule  where date='$hari_ini' ORDER BY id DESC");
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
              <h1 class="h3 mb-mb-4 text-uppercase embed-responsive">Kegiatan Presensi </h1>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4 ">
            <div class="card-header py-3">
              <button class="btn btn-primary" data-toggle="modal" data-target="#activity">Tambah Kegiatan</button>
              <button class="btn btn-success" data-toggle="modal" data-target="#schedule">Buat Jadwal</button>
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#targetpoin">
                Target Poin Presensi
              </button>
            </div>
            <div class="card-body">
              <div class="table-responsive overflow-hidden">
                <table class="table table-bordered mydatatable" id="dataTable" width="100%">
                  <thead class=" text-md-center bg-dark text-light">
                    <tr>
                      <th width="10">No</th>
                      <th>Kegiatan Presensi</th>
                      <th>Aksi</th>
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






    $(document).on("click", "#edit_items", function() {
      let itemactivity = $(this).data('itemactivity');
      let kode = $(this).data('kode');
      let target1 = $(this).data('target1');
      $(" #modal-edit #itemactivity").val(itemactivity);
      $(" #modal-edit #kode").val(kode);
      $(" #modal-edit #target1").val(target1);

      // value edit data target
      let id_taget_presensi = $(this).data('id_taget_presensi');
      let hari = $(this).data('hari');
      let target2 = $(this).data('target2');
      let week = $(this).data('week');
      let angkatan2 = $(this).data('angkatan2');
      $(" #modal-edittarget #id_taget_presensi").val(id_taget_presensi);
      $(" #modal-edittarget #hari").val(hari);
      $(" #modal-edittarget #target2").val(target2);
      $(" #modal-edittarget #week").val(week);
      $(" #modal-edittarget #angkatan2").val(angkatan2);

    });
  </script>


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

  <script>
    $(document).ready(function() {
      $('#example').DataTable({
        scrollY: 600,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        lengthMenu: [
          [-1],
          ["All"]
        ],
        initComplete: function() {
          this.api().columns().every(function() {
            var column = this;
            var select = $('<select><option value=""></option></select>')
              .appendTo($(column.footer()).empty())
              .on('change', function() {
                var val = $.fn.dataTable.util.escapeRegex(
                  $(this).val()
                );

                column
                  .search(val ? '^' + val + '$' : '', true, false)
                  .draw();
              });

            column.data().unique().sort().each(function(d, j) {
              select.append('<option value="' + d + '">' + d + '</option>')
            });
          });
        }
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#example2').DataTable({
        scrollY: 600,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        lengthMenu: [
          [-1],
          ["All"]
        ],
        initComplete: function() {
          this.api().columns().every(function() {
            var column = this;
            var select = $('<select><option value=""></option></select>')
              .appendTo($(column.footer()).empty())
              .on('change', function() {
                var val = $.fn.dataTable.util.escapeRegex(
                  $(this).val()
                );

                column
                  .search(val ? '^' + val + '$' : '', true, false)
                  .draw();
              });

            column.data().unique().sort().each(function(d, j) {
              select.append('<option value="' + d + '">' + d + '</option>')
            });
          });
        }
      });
    });
  </script>


</body>

</html>