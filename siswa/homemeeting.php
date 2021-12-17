<?php
include '../database.php';

// sistem submit/post di bagian jurnal homemeeting
if (isset($_POST['home_meeting'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $getandlern = htmlspecialchars($_POST['getandlern']);
    $homemeeting = mysqli_query($conn, "INSERT INTO `tb_home_meeting`(`nis`, `what_i_get_and_lern`, `catatan_mentor`) VALUES ('$nis','$getandlern',NULL)");
    if ($homemeeting) {
        $notifsukses = $_SESSION['sukses'] = 'Berhasil Disimpan';
    } else {
        $notifgagal = $_SESSION['gagal'] = 'Mohon Maaf Pengisian jurnal Hanya Sekali Saja';
    }
}
// proses Edit home meeting
if (isset($_POST['btn_update_hommeeting'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $learn = htmlspecialchars($_POST['learn']);
    $date = htmlspecialchars($_POST['date']);
    $edit = mysqli_query($conn, "UPDATE `tb_home_meeting` SET `nis`='$nis',`what_i_get_and_lern`='$learn' WHERE `tb_home_meeting`.`nis`='$nis' AND `tb_home_meeting`.`date`='$date' ");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Saved!';
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Gagal!';
    }
}
// cek apakah yang mengakses halaman ini sudah login
session_start();
// // cek apakah yang mengakses halaman ini sudah login
include 'template/session.php';
$jurnal = mysqli_query($conn, "SELECT * FROM tb_home_meeting WHERE nis='$id' ORDER BY date DESC");
$home_meeting = mysqli_fetch_array($jurnal);
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
                <!-- Topbar -->

                <?php
                include 'template/topbar_menu.php';
                ?>

                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="group">
                            <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Weekly</h1>
                            <p class=" mt embed-responsive">adalah jurnal mingguan. Setiap item dapat diisi >1x dalam seminggu sesuai permintaan minimalnya. <span class="text-danger font-weight-bold">pengisian harus singkat dan jelas !</span></p>
                            <a href="Weekly.php" type="button" class="btn btn-outline-primary mt-2">Exhibition</a>
                            <a href="personalgoal.php" type="button" class="btn btn-outline-warning mt-2">Personal Goal</a>
                            <a href="homemeeting.php" type="button" class="btn btn-outline-success active mt-2">Home Meeting</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#homemeeting">Isi Jurnal</a>
                            <h5 class=" font-weight-bold text-success">Home Meeting</h5>
                            <p>adalah catatan berkat-berkat yang didapat sewaktu bersekutu atau konseling dengan mentor atau pelatih. Diisi minimal 1x/minggu</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="table-success">
                                            <th width="10">No</th>
                                            <th>What I get and learn</th>
                                            <th width="100">Date</th>
                                            <th width="250">Mentor Notes</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($jurnal as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['what_i_get_and_lern']; ?>
                                                    </span>
                                                </td>
                                                <td><?= $row['date']; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['catatan_mentor']; ?></a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal view -->
                                                    <button type="button" id="detail" class="btn btn-dark " data-toggle="modal" data-target="#modal_detail" data-nis="<?= $row['nis']; ?>" data-learn="<?= $row['what_i_get_and_lern']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['catatan_mentor']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>


                                                    <?php

                                                    $tanggal = date('Y-m-d', strtotime('-3'));
                                                    if ($tanggal <= $row['date']) { ?>
                                                        <button type="button" id="edit" class="btn btn-warning " data-toggle="modal" data-target="#modal_edit" data-nis="<?= $row['nis']; ?>" data-learn="<?= $row['what_i_get_and_lern']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['catatan_mentor']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    <?php }
                                                    ?>

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
            include 'template/footer.php';
            ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- modal Log out -->
    <?php
    include 'modal/modal_homemeeting.php';
    include 'modal/modal_logout.php';
    include 'template/script.php';
    include 'template/alert.php';
    ?>
    <script>
        $(document).on("click", "#detail", function() {
            let nis = $(this).data('nis');
            let learn = $(this).data('learn');
            let mentor = $(this).data('mentor');
            let date = $(this).data('date');
            $(" #modal-detail #nis").val(nis);
            $(" #modal-detail #learn").val(learn);
            $(" #modal-detail #mentor").val(mentor);
            $(" #modal-detail #date").val(date);

        });
        $(document).on("click", "#edit", function() {
            let nis = $(this).data('nis');
            let learn = $(this).data('learn');
            let date = $(this).data('date');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #learn").val(learn);
            $(" #modal-edit #date").val(date);

        });
    </script>

</body>

</html>