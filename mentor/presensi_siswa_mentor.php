<?php
include '../database.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('Y-m-d');
$waktu_sekarang = date('H:i:s');
include 'template/session.php';

if (isset($_POST['save_pesan'])) {
    $id_jadwal = htmlspecialchars($_POST['id_absent1']);
    $Pesan_Mentor = htmlspecialchars($_POST['pesan_mentor']);

    $sqli_Catatan = mysqli_query($conn, "UPDATE `presensi` SET `catatan`='$Pesan_Mentor' where id_presensi='$id_jadwal'");
}
if (isset($_POST['insert_Edit_presence'])) {
    $id_1 = htmlspecialchars($_POST['id1']);
    $Schedule = htmlspecialchars($_POST['item_schedule1']);
    $mark_1 = htmlspecialchars($_POST['mark1']);
    $Acc_1 = htmlspecialchars($_POST['agreement1']);
    $catatan_1 = htmlspecialchars($_POST['catatan1']);
    $sqli_absent2 = mysqli_query($conn, "UPDATE `presensi` SET `mark`='$mark_1',`schedule_id`='$Schedule',`ACC_Mentor`='$Acc_1',`catatan`='$catatan_1' WHERE `id_presensi`='$id_1'");
    if ($sqli_absent2) {
        $_SESSION['alert_edit_absent_berhasil'] = 'changed successfully';
    } else {
        $_SESSION['alert_edit_absent_gagal'] = 'changed ';
        # code...
    }
}



if (isset($_POST['insert_presence'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $schedule = htmlspecialchars($_POST['item_schedule']);
    $mark_presence = htmlspecialchars($_POST['mark']);
    $date_presence = htmlspecialchars($_POST['date']);
    $time_presence = htmlspecialchars($_POST['start_time']);
    $Acc_mentor = htmlspecialchars($_POST['agreement']);
    $catatan_mentor = htmlspecialchars($_POST['catatan']);
    $id = $_SESSION['id_Mentor'];

    // mengecek dan mengambil data angkatan yang terdapat di database schedule
    $sql_schedule1 = mysqli_fetch_array(mysqli_query($conn, "SELECT batch FROM `schedule` WHERE id='$schedule'"));
    $angkatan = $sql_schedule1['batch'];

    // mengecek dan mengambil data week yang terdapat di database schedule
    $sql_schedule2 = mysqli_fetch_array(mysqli_query($conn, "SELECT week FROM `schedule` WHERE id='$schedule'"));
    $week = $sql_schedule2['week'];

    // mengecek dan mengambil data id_activity yang terdapat di database schedule
    $sql_schedule3 = mysqli_fetch_array(mysqli_query($conn, "SELECT id_activity FROM `schedule` WHERE id='$schedule'"));
    $activity = $sql_schedule3['id_activity'];

    // mengecek dan mengambil data info schedule yang terdapat di database schedule
    $sql_schedule4 = mysqli_fetch_array(mysqli_query($conn, "SELECT info FROM `schedule` WHERE id='$schedule'"));
    $info = $sql_schedule4['info'];

    // mengecek dan mengambil data absent time yang terdapat di database absent
    $sql_schedule5 = mysqli_fetch_array(mysqli_query($conn, "SELECT presensi_time FROM `presensi` WHERE nis='$nis'"));
    $timeabsent = $sql_schedule5['presensi_time'];

    // mengurutkan id di database absent
    $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_presensi`) As id FROM `presensi` WHERE presensi_date=date(now()) AND schedule_id='$schedule'"));
    $idbr = $max['id'] + 1;

    // mengecek dan mengambil data mentor yang terdapat di database siswa
    $mentor = mysqli_fetch_array(mysqli_query($conn, "SELECT mentor FROM `siswa` WHERE nis='$nis'"));
    $mentor = $mentor['mentor'];

    // mengecek apakah ada data presensi ? jika ada maka muncul peringatan
    $cek_data = mysqli_query($conn, "SELECT * FROM presensi WHERE id_activity = '$activity' AND schedule_id ='$schedule' AND nis ='$nis'") or die($conn->error);
    if (mysqli_num_rows($cek_data) > 0) {

        // alert jika data nya ada
        $cek_data_presensi = $_SESSION['cek_data'] = '<p class="text-danger"><strong>Presence can only be 1 time!</strong></p>';
        // sound notifikasi
        echo notice(0);
    } else {

        // jika data presensi kosong maka di ijinkan untuk menambahkan data presensi
        $sqli_absent = mysqli_query($conn, "INSERT INTO `presensi`(`nis`, `schedule_id`,`mark`, `presensi_date`, `presensi_time`,`ACC_Mentor`, `catatan`, `id_presensi`,`mentor`,`batch`,`week`,`id_activity`,`info_schedule`,`semester`) VALUES ('$nis','$schedule','$mark_presence','$date_presence','$time_presence','$Acc_mentor','$catatan_mentor','$idbr','$mentor','$angkatan','$week','$activity','$info','$data_semester')");

        // alert jika data berhasil di input ke dalam database
        if ($sqli_absent) {
            $insertpresensi = $_SESSION['alert'] = 'Berhasil Disimpan';
            echo notice(1);
        } else {
            $gagalinsertpresensi = $_SESSION['alert_gagal'] = 'gagal Disimpan';
            echo notice(0);
        }
    }
}

// function sound notifikasi
function notice($type)
{
    if ($type == 1) {
        return "<audio autoplay><source src='" . '../music/success.wav' . "'></audio>";
    } elseif ($type == 0) {
        return "<audio autoplay><source src='" . '../music/error.wav' . "'></audio>";
    }
}  //akhir function



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
// and absent_date='$hari_ini'
//query data absent siswa
$Sqli_absent = mysqli_query($conn, "SELECT * FROM presensi where mentor='$id' and presensi_date='$hari_ini'");
$array_absent = mysqli_fetch_array($Sqli_absent);
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
                            <h1 class="h3 mb-mb-4 embed-responsive text-gray-800">Presence Student</h1>

                            <a href="presensi_siswa_mentor.php" type="button" class="btn mt-2 btn-outline-success active">Presence</a>
                            <a href="report_presence.php" type="button" class="btn mt-2 btn-outline-danger">Report</a>

                        </div>
                        <?php
                        if (isset($_SESSION['alert_edit_absent_berhasil'])) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Attendance!</strong> <?php echo $_SESSION['alert_edit_absent_berhasil']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                            unset($_SESSION['alert_edit_absent_berhasil']);
                        } else if (isset($_SESSION['alert_approved'])) { ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Successfully!</strong> <?php echo $_SESSION['alert_approved']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                            unset($_SESSION['alert_approved']);
                        } else if (isset($_SESSION['alert_not_approved'])) { ?>

                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Successfully!</strong> <?php echo $_SESSION['alert_not_approved']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                            unset($_SESSION['alert_not_approved']);
                        }


                        ?>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_presensi_siswa">
                                Add Presence
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-md-center">
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th>Verification step 2</th>
                                            <th>Student's Name</th>
                                            <th>Schedule</th>
                                            <th>Start Time</th>
                                            <th>Absent Time</th>
                                            <th>Presence Time</th>
                                            <th>Week</th>
                                            <th>Status</th>
                                            <th>Agreement</th>
                                            <th>Absent Date</th>
                                            <th>Suggestion</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-md-center">
                                        <?php $i = 1; ?>
                                        <?php foreach ($Sqli_absent as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td>
                                                    <?php
                                                    $gambar = $row["image"];
                                                    if ($gambar) { ?>
                                                        <button type="button" data-gambar="<?= $row["image"]; ?>" class="btn " id="verifikasi" data-toggle="modal" data-target="#gambar">
                                                            <img src="../img/verifikasi/<?= $row["image"]; ?>" width="90">
                                                        </button>

                                                    <?php }

                                                    ?>
                                                </td>
                                                <td><?= nama_siswa($row["nis"]); ?></td>
                                                <td><?= kegiatan($row["id_activity"]); ?></td>
                                                <td>
                                                    <?php
                                                    // mengambil waktu kegiatanm di tabel kegiatan berdasarkan id kegiatan

                                                    $id_kegiatan = $row["schedule_id"];
                                                    $sqly4 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schedule WHERE id='$id_kegiatan'"));
                                                    $waktu_kegiatan = $sqly4['start_time'];
                                                    $waktu_absent = $sqly4['presensi_time'];
                                                    $Waktu_akhir = $sqly4['end_time'];
                                                    $date = $sqly4['date'];

                                                    ?>
                                                    <?= $waktu_kegiatan; ?>
                                                    <?php
                                                    // script jika waktu akhir jadwal sudah lewat maka sistem akan otomatis untuk tidak meng approved presensi siswa
                                                    if ($waktu_sekarang > $Waktu_akhir || $date < $hari_ini) { ?>
                                                        <script>
                                                            window.onload = function() {
                                                                var button = document.getElementById('approved');
                                                                setInterval(function() {
                                                                    button.click();
                                                                }, 1000);
                                                            };
                                                        </script>
                                                    <?php
                                                    }

                                                    ?>
                                                </td>
                                                <td><?= $waktu_absent; ?></td>
                                                <td><?= $row["presensi_time"]; ?></td>
                                                <td><?= $row["week"]; ?></td>
                                                <td>
                                                    <?php
                                                    // jika presensinya terlambat maka warna merah statusnya
                                                    if ($row["mark"] == 'X') { ?>
                                                        <span class="badge badge-pill badge-danger"><?= $row["mark"]; ?></span>
                                                    <?php  } else if ($row["mark"] == 'O') { ?>
                                                        <span class="badge badge-pill badge-warning"><?= $row["mark"]; ?></span>
                                                    <?php   } else { ?>
                                                        <span class="badge badge-pill badge-info"><?= $row["mark"]; ?></span>

                                                    <?php   }
                                                    ?>
                                                </td>
                                                <td>


                                                    <?php
                                                    // jika presensinya terlambat maka warna merah statusnya
                                                    if ($row["ACC_Mentor"] == 'Waiting') { ?>
                                                        <span class="badge badge-pill badge-warning"><?= $row["ACC_Mentor"]; ?></span>
                                                    <?php  } else if ($row["ACC_Mentor"] == 'not approved') { ?>
                                                        <span class="badge badge-pill badge-danger"><?= $row["ACC_Mentor"]; ?></span>
                                                    <?php   } else { ?>
                                                        <span class="badge badge-pill badge-success"><?= $row["ACC_Mentor"]; ?></span>
                                                    <?php  } ?>
                                                </td>
                                                <td><?= $row["presensi_date"]; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['catatan']; ?></a>
                                                    </span>
                                                </td>

                                                <td>
                                                    <!-- <button type="button" class="btn btn-primary m-2" data-id_absent1="<?= $row["id_presensi"]; ?>" data-pesan_mentor="<?= $row['catatan']; ?>" id="PSN" data-toggle="modal" data-target="#cttn_mentor">
                                                        Suggestion
                                                    </button> -->
                                                    <?php
                                                    if ($row["ACC_Mentor"] == 'Waiting') { ?>
                                                        <a id="approved" href="proses_approve.php?id=<?= $row["id_presensi"]; ?>&approved=approved" type="button" class="btn btn-info m-2">Approved</a>
                                                        <a href="proses_approve.php?id=<?= $row["id_presensi"]; ?>&notapproved=not approved" type="button" class="btn btn-danger m-2">Not Approved</a>
                                                    <?php  } else if ($row["ACC_Mentor"] == 'not approved') { ?>
                                                        <a href="proses_approve.php?id=<?= $row["id_presensi"]; ?>&approved=approved" type="button" class="btn btn-info m-2">Approved</a>
                                                    <?php   } else { ?>

                                                        <button type="button" class="btn btn-warning m-2" data-nis1="<?= $row["nis"]; ?>" data-item_schedule1="<?= $row['schedule_id']; ?>" data-mark1="<?= $row['mark']; ?>" data-date1="<?= $row['presensi_date']; ?>" data-catatan1="<?= $row['catatan']; ?>" data-time1="<?= $row['presensi_time']; ?>" data-agreement1="<?= $row['ACC_Mentor']; ?>" data-id1="<?= $row['id_presensi']; ?>" id="edit_schedule" data-toggle="modal" data-target="#Edit_presensi_siswa">
                                                            Edit
                                                        </button>
                                                    <?php   } ?>
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
    include '../modal.php';
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

    <script>
        $(document).on("click", "#verifikasi", function() {
            let gambar = $(this).data('gambar');
            $(" #modal-gambar #gambar").attr("src", "../img/verifikasi/" + gambar);

        });
    </script>



</body>

</html>