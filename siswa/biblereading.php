<?php
include '../database.php';
// sistem submit/post di bagian jurnal bible reading
if (isset($_POST['bible_reading'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $kitab = htmlspecialchars($_POST['kitab']);
    $OT = htmlspecialchars($_POST['OT']);
    $NT = htmlspecialchars($_POST['NT']);
    $bible = mysqli_query($conn, "INSERT INTO `tb_bible_reading`(`nis`, `bible`, `total_ot`, `total_nt`, `catatan_mentor`) VALUES ('$nis','$kitab','$OT','$NT',NULL)");
    if ($bible) {
        $notifsukses = $_SESSION['sukses'] = 'Berhasil Disimpan';
    } else {
        $notifgagal = $_SESSION['gagal'] = 'Mohon Maaf Pengisian jurnal Hanya Sekali Saja';
    }
}
// sistem edit bible
if (isset($_POST['btn_editbible'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $bible = htmlspecialchars($_POST['bible']);
    $ot = htmlspecialchars($_POST['ot']);
    $nt = htmlspecialchars($_POST['nt']);
    $date = htmlspecialchars($_POST['date']);
    $editbible = mysqli_query($conn, "UPDATE `tb_bible_reading` SET `bible`='$bible',`total_ot`='$ot',`total_nt`='$nt' WHERE `tb_bible_reading`.`nis` ='$nis' AND `tb_bible_reading`.`date` ='$date'");

    if ($editbible) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Saved!';
    } else {
        // echo '<script>alert("Mohon Maaf Pengisian jurnal Hanya Sekali Saja")</script>';
        $notifgagaledit = $_SESSION['gagal'] = 'Gagal!';
    }
}

// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
$jurnal = mysqli_query($conn, "SELECT * FROM tb_bible_reading WHERE nis='$id' ORDER BY date DESC");
$bible = mysqli_fetch_array($jurnal);
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="group">
                            <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Daily</h1>
                            <p class=" mt embed-responsive">ini adalah jurnal yang harus diisi setiap hari, 7 hari/minggu, <span class="text-danger font-weight-bold">pengisian harus singkat dan jelas !</span></p>
                            <!-- <a href="Daily.php" type="button" class="btn btn-outline-primary mt-2">Pesonal Goal</a> -->
                            <a href="revivalnote.php" type="button" class="btn btn-outline-success mt-2">Revival Note</a>
                            <a href="prayernote.php" type="button" class="btn btn-outline-warning mt-2">Prayer Note</a>
                            <a href="biblereading.php" type="button" class="btn btn-outline-danger active mt-2">Bible Reading</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-danger float-right" data-toggle="modal" data-target="#biblereading">Isi Jurnal</a>
                            <h5 class=" font-weight-bold text-danger">Bible Reading</h5>
                            <p>diisi sesuai dengan kitab dan jumlah pasal yang dibaca</p>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="table-danger">
                                            <th width="10">No</th>
                                            <th>Bible</th>
                                            <th>Total OT Chapter(s)</th>
                                            <th>Total NT Chapter(s)</th>
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
                                                <td><?= $row['bible']; ?></td>
                                                <td><?= $row['total_ot']; ?></td>
                                                <td><?= $row['total_nt']; ?></td>
                                                <td><?= $row['date']; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['catatan_mentor']; ?></a>
                                                    </span>
                                                <td>
                                                    <!-- Button trigger modal view -->
                                                    <button type="button" id="detail" class="btn btn-dark " data-toggle="modal" data-target="#modal_detail" data-nis="<?= $row['nis']; ?>" data-bible="<?= $row['bible']; ?>" data-ot="<?= $row['total_ot']; ?>" data-nt="<?= $row['total_nt']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['catatan_mentor']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <?php
                                                    $tanggal = date('Y-m-d');
                                                    if ($tanggal == $row['date']) { ?>

                                                        <a id="edit_bible" data-toggle="modal" data-target="#editbiblereading" data-bible="<?= $row["bible"]; ?>" data-nis="<?= $row["nis"]; ?>" data-date="<?= $row["date"]; ?>" data-ot="<?= $row["total_ot"]; ?>" data-nt="<?= $row["total_nt"]; ?>">
                                                            <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button></a>
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
    <!-- End of Page Wrapper -->
    <!-- modal Log out -->
    <?php
    include 'modal/modal_biblereading.php';
    include 'modal/modal_logout.php';
    include 'template/script.php';
    include 'template/alert.php';
    ?>
    <script>
        $(document).on("click", "#edit_bible", function() {

            let nis = $(this).data('nis');
            let bible = $(this).data('bible');
            let ot = $(this).data('ot');
            let nt = $(this).data('nt');
            let date = $(this).data('date');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #bible").val(bible);
            $(" #modal-edit #ot").val(ot);
            $(" #modal-edit #nt").val(nt);
            $(" #modal-edit #date").val(date);

        });

        $(document).on("click", "#detail", function() {
            let nis = $(this).data('nis');
            let bible = $(this).data('bible');
            let ot = $(this).data('ot');
            let nt = $(this).data('nt');
            let mentor = $(this).data('mentor');
            let date = $(this).data('date');
            $(" #modal-detail #nis").text(nis);
            $(" #modal-detail #bible").text(bible);
            $(" #modal-detail #ot").text(ot);
            $(" #modal-detail #nt").text(nt);
            $(" #modal-detail #mentor").val(mentor);
            $(" #modal-detail #date").text(date);

        });
    </script>
</body>

</html>