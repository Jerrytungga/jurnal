<?php
include '../database.php';

// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
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



if (isset($_POST['filter_tanggal'])) {
    $mulai = $_POST['tanggal_mulai'];
    $selesai = $_POST['tanggal_akhir'];


    if ($mulai != null || $selesai != null) {
        $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$id' and ACC_Mentor='approve' and absent_date BETWEEN '$mulai' AND '$selesai'   order by absent_time DESC");
    } else {

        $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$id'and ACC_Mentor='approve' and absent_date BETWEEN '$mulai' AND '$selesai'   order by absent_time DESC");
        $array_absent = mysqli_fetch_array($Sqli_absent);
    }
} else {
    $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$id' and ACC_Mentor='approve' order by absent_time DESC");
    $array_absent = mysqli_fetch_array($Sqli_absent);
}
if (isset($_POST['reset'])) {
    $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$id'  order by absent_time DESC");
    $array_absent = mysqli_fetch_array($Sqli_absent);
}




// $absent_siswa = mysqli_query($conn, "SELECT * FROM `absent` WHERE `nis`='$id' and ACC_Mentor='approve'");
// $data_absent = mysqli_fetch_array($absent_siswa);

?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'template/head.php'
?>

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



                <!-- Topbar Navbar -->
                <?php
                include 'template/topbar_menu.php';
                ?>


                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-mb-4 text-gray-800">Presence</h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-5 ">
                        <div class="card-header py-3">
                            <div class="form-inline">

                                <form action="" method="POST">
                                    <?php
                                    if (isset($_POST['filter_tanggal'])) {
                                        $mulai = $_POST['tanggal_mulai'];
                                        $selesai = $_POST['tanggal_akhir'];
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

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="table-primary">
                                            <th width="10">No</th>
                                            <th>Presence Picture</th>
                                            <th>Schedule</th>
                                            <th>Schedule Time</th>
                                            <th>Presence Time</th>
                                            <th>Week</th>
                                            <th>Mark</th>
                                            <th>Agreement</th>
                                            <th>Suggestion Mentor</th>
                                            <th>Absent Date</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($Sqli_absent as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td> <img src="../img/verifikasi/<?= $row["gambar_verifikasi"]; ?>" width="90"></td>
                                                <td><?= kegiatan($row['schedule_id']); ?></td>
                                                <td>
                                                    <?php
                                                    // mengambil waktu kegiatanm di tabel kegiatan berdasarkan id kegiatan
                                                    $id_kegiatan = $row["schedule_id"];
                                                    $sqly4 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schedule WHERE id='$id_kegiatan'"));
                                                    $waktu_kegiatan = $sqly4['start_time']
                                                    ?>
                                                    <?= $waktu_kegiatan; ?>
                                                </td>
                                                <td><?= $row['absent_time']; ?></td>
                                                <td><?= $row['week']; ?></td>
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
                                                <td><?= $row['catatan']; ?></td>
                                                <td><?= $row['absent_date']; ?></td>

                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>

                                    </tbody>
                                    <tfoot>

                                        <?php

                                        $tampil = mysqli_query($conn, "SELECT * FROM absent where nis='$id' ");
                                        $array_presensi = mysqli_fetch_array($tampil);
                                        $mark_V = $array_presensi['mark'] = 'V';
                                        $mark_O = $array_presensi['mark'] = 'O';
                                        $mark_X = $array_presensi['mark'] = 'X';
                                        $mark_I = $array_presensi['mark'] = 'I';
                                        $mark_S = $array_presensi['mark'] = 'S';

                                        $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approve' and mark='$mark_V' ");
                                        $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                                        $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approve' and mark='$mark_O' ");
                                        $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                                        $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approve' and mark='$mark_X'");
                                        $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                                        $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approve' and mark='$mark_I'");
                                        $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                                        $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approve' and mark='$mark_S'");
                                        $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                                        $total = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];

                                        ?>
                                        <th class="bg-warning text-right" colspan="9"> Total Point : </th>
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
            include 'template/footer.php';
            ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Modal Log Out -->
    <?php
    include 'modal/modal_notes.php';
    include 'modal/modal_logout.php';
    include 'template/script.php';
    include 'template/alert.php';
    ?>
    <script>
        // edit catatan
        $(document).on("click", "#edit_catatan", function() {
            let judul = $(this).data('judul');
            let deskripsi = $(this).data('deskripsi');
            let id = $(this).data('id');
            let date = $(this).data('date');
            $(" #modal-edit #judul").val(judul);
            $(" #modal-edit #deskripsi").val(deskripsi);
            $(" #modal-edit #id").val(id);
            $(" #modal-hapus #id").val(id);
            $(" #modal-hapus #date").val(date);

        });
    </script>
</body>

</html>

<?php
function notice($type)
{
    if ($type == 1) {
        return "<audio autoplay><source src='" . '../music/success.wav' . "'></audio>";
    } elseif ($type == 0) {
        return "<audio autoplay><source src='" . '../music/error.wav' . "'></audio>";
    }
}

?>