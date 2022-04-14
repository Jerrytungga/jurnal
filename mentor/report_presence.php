<?php
include '../database.php';
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include 'template/session.php';
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-j');
$waktu_sekarang = date('H:i:s');


if (isset($_POST['cari'])) {
  $nis = $_POST['nis'];
  $week = $_POST['week'];
  $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' and week='$week' and ACC_Mentor='approved' and  mentor='$id'  order by absent_time DESC");
} else {

  $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' and ACC_Mentor='approved' and  mentor='$id'  order by absent_time DESC");
  $array_absent = mysqli_fetch_array($Sqli_absent);
}

$cek = mysqli_num_rows($Sqli_absent);

// if (reset) {
//   $nis = $_POST['nis'];
//   $week = $_POST['week'];
//   $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' and week='$week' and ACC_Mentor='approved' and  mentor='$id'  order by absent_time DESC");
// }












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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
  <style>
    .select_ {
      float: right;
      margin-right: 10px;
      margin-bottom: 10px;
    }

    .data {
      margin-top: 90px;

    }


    .card_presence {
      width: 30px;
      height: 125px;
      margin-left: 20px;
      margin-bottom: 30px;

    }
  </style>
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
          <div class="select_ form-inline ">
            <form action="" method="POST">
              <b class="font-weight-normal">Week :</b>&nbsp;&nbsp;
              <?php
              if (isset($_POST['week'])) {
                $week = $_POST['week']; ?>
                <select id="" class="form-control col-10" name="week" onChange="document.getElementById('form_id').submit();">
                  <option selected>Select Week</option>
                  <option value="1" <?php if ($week == "1") { ?> selected <?php } ?>>01</option>
                  <option value="2" <?php if ($week == "2") { ?> selected <?php } ?>>02</option>
                  <option value="3" <?php if ($week == "3") { ?> selected <?php } ?>>03</option>
                  <option value="4" <?php if ($week == "4") { ?> selected <?php } ?>>04</option>
                  <option value="5" <?php if ($week == "5") { ?> selected <?php } ?>>05</option>
                  <option value="6" <?php if ($week == "6") { ?> selected <?php } ?>>06</option>
                  <option value="7" <?php if ($week == "7") { ?> selected <?php } ?>>07</option>
                  <option value="8" <?php if ($week == "8") { ?> selected <?php } ?>>08</option>
                  <option value="9" <?php if ($week == "9") { ?> selected <?php } ?>>09</option>
                  <option value="10" <?php if ($week == "10") { ?> selected <?php } ?>>10</option>
                  <option value="11" <?php if ($week == "11") { ?> selected <?php } ?>>11</option>
                  <option value="12" <?php if ($week == "12") { ?> selected <?php } ?>>12</option>
                  <option value="13" <?php if ($week == "13") { ?> selected <?php } ?>>13</option>
                  <option value="14" <?php if ($week == "14") { ?> selected <?php } ?>>14</option>
                  <option value="15" <?php if ($week == "15") { ?> selected <?php } ?>>15</option>
                  <option value="16" <?php if ($week == "16") { ?> selected <?php } ?>>16</option>
                  <option value="17" <?php if ($week == "17") { ?> selected <?php } ?>>17</option>
                  <option value="18" <?php if ($week == "18") { ?> selected <?php } ?>>18</option>
                  <option value="19" <?php if ($week == "19") { ?> selected <?php } ?>>19</option>
                  <option value="20" <?php if ($week == "20") { ?> selected <?php } ?>>20</option>
                  <option value="21" <?php if ($week == "21") { ?> selected <?php } ?>>21</option>
                  <option value="22" <?php if ($week == "22") { ?> selected <?php } ?>>22</option>
                  <option value="23" <?php if ($week == "23") { ?> selected <?php } ?>>23</option>
                  <option value="24" <?php if ($week == "24") { ?> selected <?php } ?>>24</option>
                  <option value="25" <?php if ($week == "25") { ?> selected <?php } ?>>25</option>
                  <option value="26" <?php if ($week == "26") { ?> selected <?php } ?>>26</option>
                  <option value="27" <?php if ($week == "27") { ?> selected <?php } ?>>27</option>
                  <option value="28" <?php if ($week == "28") { ?> selected <?php } ?>>28</option>
                  <option value="29" <?php if ($week == "29") { ?> selected <?php } ?>>29</option>
                  <option value="30" <?php if ($week == "30") { ?> selected <?php } ?>>30</option>
                  <option value="31" <?php if ($week == "31") { ?> selected <?php } ?>>31</option>
                  <option value="32" <?php if ($week == "32") { ?> selected <?php } ?>>32</option>
                  <option value="33" <?php if ($week == "33") { ?> selected <?php } ?>>33</option>
                  <option value="34" <?php if ($week == "34") { ?> selected <?php } ?>>34</option>
                  <option value="35" <?php if ($week == "35") { ?> selected <?php } ?>>35</option>
                  <option value="36" <?php if ($week == "36") { ?> selected <?php } ?>>36</option>
                  <option value="37" <?php if ($week == "37") { ?> selected <?php } ?>>37</option>
                  <option value="38" <?php if ($week == "38") { ?> selected <?php } ?>>38</option>
                  <option value="39" <?php if ($week == "39") { ?> selected <?php } ?>>39</option>
                  <option value="40" <?php if ($week == "40") { ?> selected <?php } ?>>40</option>
                  <option value="41" <?php if ($week == "41") { ?> selected <?php } ?>>41</option>
                  <option value="42" <?php if ($week == "42") { ?> selected <?php } ?>>42</option>
                  <option value="43" <?php if ($week == "43") { ?> selected <?php } ?>>43</option>
                  <option value="44" <?php if ($week == "44") { ?> selected <?php } ?>>44</option>
                  <option value="45" <?php if ($week == "45") { ?> selected <?php } ?>>45</option>
                  <option value="46" <?php if ($week == "46") { ?> selected <?php } ?>>46</option>
                  <option value="47" <?php if ($week == "47") { ?> selected <?php } ?>>47</option>
                  <option value="48" <?php if ($week == "48") { ?> selected <?php } ?>>48</option>
                  <option value="49" <?php if ($week == "49") { ?> selected <?php } ?>>49</option>
                  <option value="50" <?php if ($week == "50") { ?> selected <?php } ?>>50</option>
                  <option value="51" <?php if ($week == "51") { ?> selected <?php } ?>>51</option>
                  <option value="52" <?php if ($week == "52") { ?> selected <?php } ?>>52</option>

                </select>
              <?php
              } else {
              ?>
                <select id="" class="form-control col-10" name="week" onChange="document.getElementById('form_id').submit();">
                  <option selected>Select Week</option>
                  <option value="1">01</option>
                  <option value="2">02</option>
                  <option value="3">03</option>
                  <option value="4">04</option>
                  <option value="5">05</option>
                  <option value="6">06</option>
                  <option value="7">07</option>
                  <option value="8">08</option>
                  <option value="9">09</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                  <option value="43">43</option>
                  <option value="44">44</option>
                  <option value="45">45</option>
                  <option value="46">46</option>
                  <option value="47">47</option>
                  <option value="48">48</option>
                  <option value="49">49</option>
                  <option value="50">50</option>
                  <option value="51">51</option>
                  <option value="52">52</option>
                </select>
              <?php } ?>
              <select class="form-control" required name="nis" aria-label="Default select example">
                <?php
                if (isset($_POST['nis'])) {
                  $daftarsiswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa where status='Aktif' and mentor='$id' and nis='" . $_POST['nis'] . "'"));
                ?>

                  <option value="<?= $daftarsiswa['nis']; ?>"><?= $daftarsiswa['name']; ?></option>
                <?php } else {
                  echo "<option selected>Select student</option>";
                }
                $daftarsiswa = mysqli_query($conn, "SELECT * FROM siswa where status='Aktif' and mentor='$id'");
                while ($data1 = mysqli_fetch_array($daftarsiswa)) { ?>
                  <option value="<?= $data1['nis']; ?>"><?= $data1['name']; ?></option>

                <?php }
                ?>
              </select>
              <button type="submit" name="cari" class="btn btn-info ml-2">View</button>
              <a href="report_presence.php" class="btn btn-danger ml-3">Reset</a>
            </form>
          </div>
          <!-- DataTales Example -->
          <?php
          if ($cek > 0) {

            $Sqli_target = mysqli_fetch_array(mysqli_query($conn, "SELECT target as total_target FROM tb_target_presensi where semester='$data_semester' and week='$week'"));
          ?>


            <div class="card shadow data ">
              <div class="card-header py-3 form-inline">
                <a href="./excel.php?nis=<?= $nis; ?>&week=<?= $week; ?>&target=<?= $Sqli_target['total_target']; ?> " target=" blank" type="button" class="btn btn-success ">Download Report</a>
                <button type="button" class="btn btn-primary ml-3">
                  Target <span class="badge bg-danger"> <?= $Sqli_target['total_target']; ?> Points</span>
                </button>
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
                      if (isset($_POST['cari'])) {
                        $nis = $_POST['nis'];
                        $week = $_POST['week'];
                        $tampil = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' and week='$week' and ACC_Mentor='approved' and  mentor='$id'  order by absent_time DESC");
                        // $tampil = mysqli_query($conn, "SELECT * FROM absent where week='$week'  nis='$nis'  AND absent_date='$hari_ini' ");
                        $array_presensi = mysqli_fetch_array($tampil);
                        $mark_V = $array_presensi['mark'] = 'V';
                        $mark_O = $array_presensi['mark'] = 'O';
                        $mark_X = $array_presensi['mark'] = 'X';
                        $mark_I = $array_presensi['mark'] = 'I';
                        $mark_S = $array_presensi['mark'] = 'S';

                        $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where  semester='$data_semester' and nis='$nis' and week='$week' and ACC_Mentor='approved' and mark='$mark_V' ");
                        $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                        $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where semester='$data_semester' and nis='$nis' and week='$week' and ACC_Mentor='approved' and mark='$mark_O' ");
                        $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                        $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where semester='$data_semester' and nis='$nis' and week='$week' and ACC_Mentor='approved' and mark='$mark_X'");
                        $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                        $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where semester='$data_semester' and  nis='$nis' and week='$week' and ACC_Mentor='approved' and mark='$mark_I'");
                        $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                        $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where semester='$data_semester' and  nis='$nis' and week='$week' and ACC_Mentor='approved' and mark='$mark_S'");
                        $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                        $total = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];
                      }
                      ?>
                      <th class="bg-warning text-right" colspan="7"> Total Point : </th>
                      <th class="text-center"><?= $total; ?></th>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <?php
            if ($Sqli_target['total_target'] > $total) { ?>
              <!-- alert jika poin siswa kurang dari target -->
              <script>
                Swal.fire({
                  icon: 'info',
                  title: '<strong>Announcement!</strong>',
                  text: 'Student points less than the target!'
                })
              </script>
              <audio src="../music/error.wav" autoplay="autoplay" hidden="hidden"></audio>
            <?php  }
            ?>


          <?php      } else { ?>
            <script>
              Swal.fire({
                icon: 'info',
                title: '<strong>Announcement!</strong>',
                text: 'Please select the student and week to view the report!'
              })
            </script>
            <audio src="../music/error.wav" autoplay="autoplay" hidden="hidden"></audio>
          <?php      }
          ?>



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