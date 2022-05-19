<?php
include '../database.php';

// sistem submit/post di bagian jurnal homemeeting
if (isset($_POST['home_meeting'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $getandlern = htmlspecialchars($_POST['getandlern']);
    $smt = htmlspecialchars($_POST['smt']);
    $homemeeting = mysqli_query($conn, "INSERT INTO `tb_home_meeting`(`nis`, `what_i_get_and_lern`, `semester`) VALUES ('$nis','$getandlern','$smt')");
    if ($homemeeting) {
        $notifsukses = $_SESSION['sukses'] = 'Berhasil Disimpan';
        echo notice(1);
    } else {
        $notifgagal = $_SESSION['gagal'] = 'Mohon Maaf Pengisian jurnal Hanya Sekali Saja';
        echo notice(0);
    }
}
// proses Edit home meeting
if (isset($_POST['btn_update_hommeeting'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $learn = htmlspecialchars($_POST['learn']);
    $date = htmlspecialchars($_POST['date']);
    $smt = htmlspecialchars($_POST['smt']);
    $edit = mysqli_query($conn, "UPDATE `tb_home_meeting` SET `nis`='$nis',`what_i_get_and_lern`='$learn', `semester`='$smt' WHERE `tb_home_meeting`.`nis`='$nis' AND `tb_home_meeting`.`date`='$date' ");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
        echo notice(1);
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil Di Edit!';
        echo notice(0);
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
                            <h1 class="h3 mb-mb-4 text-uppercase embed-responsive">Mingguan</h1>
                            <p class=" mt embed-responsive">Setiap item dapat diisi >1x dalam seminggu sesuai permintaan minimalnya. <span class="text-danger font-weight-bold">pengisian harus singkat dan jelas !</span></p>
                            <a href="Weekly.php" type="button" class="btn btn-outline-primary mt-2">Pameran</a>
                            <a href="personalgoal.php" type="button" class="btn btn-outline-primary mt-2 ">Tujuan Pribadi</a>
                            <a href="homemeeting.php" type="button" class="btn btn-primary active mt-2">Persekutuan Mentor</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#homemeeting">Isi Jurnal</a>
                            <h5 class=" font-weight-bold text-dark">Persekutuan Mentor</h5>
                            <p>adalah catatan berkat-berkat yang didapat sewaktu bersekutu atau konseling dengan mentor atau pelatih. Diisi minimal 1x/minggu</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-primary text-light">
                                            <th width="10">No</th>
                                            <th>Apa yang saya dapatkan dan pelajari</th>
                                            <th width="100">Tanggal</th>
                                            <th width="250">Catatan Mentor</th>
                                            <th>Aksi</th>
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