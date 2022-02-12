<?php
include '../database.php';
session_start();
// sistem submit/post di bagian jurnal exhibition
if (isset($_POST['exhibition'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $verse = htmlspecialchars($_POST['verse_exhibition']);
    $category = htmlspecialchars($_POST['category']);
    $blessing = htmlspecialchars($_POST['blessing_exhibition']);
    $exhibition = mysqli_query($conn, "INSERT INTO `tb_exhibition`(`nis`,`category`, `verse`, `point_of_blessing`, `catatan_mentor`) VALUES ('$nis','$category','$verse','$blessing',NULL)");
    if ($exhibition) {
        $notifsukses = $_SESSION['sukses'] = 'Berhasil Disimpan';
        echo notice(1);
    } else {
        $notifgagal = $_SESSION['gagal'] = 'Mohon Maaf Pengisian jurnal Hanya Sekali Saja';
        echo notice(0);
    }
}
if (isset($_POST['btn_editexhibition'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $category = htmlspecialchars($_POST['category']);
    $verse = htmlspecialchars($_POST['verse']);
    $pointblessings = htmlspecialchars($_POST['pointblessings']);
    $date = htmlspecialchars($_POST['date']);
    $edit = mysqli_query($conn, "UPDATE `tb_exhibition` SET `nis`='$nis',`category`='$category',`verse`='$verse',`point_of_blessing`='$pointblessings' WHERE `tb_exhibition`.`nis`='$nis' AND `tb_exhibition`.`date`='$date'");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Saved!';
        echo notice(1);
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Gagal!';
        echo notice(0);
    }
}
// cek apakah yang mengakses halaman ini sudah login
include 'template/session.php';
$jurnal = mysqli_query($conn, "SELECT * FROM tb_exhibition WHERE nis='$id' ORDER BY date DESC");
$exhibition = mysqli_fetch_array($jurnal);
?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'template/head.php'
?>

<body id=" page-top">
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

                <!-- Topbar Navbar -->
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
                            <a href="Weekly.php" type="button" class="btn btn-outline-primary active mt-2">Exhibition</a>
                            <a href="personalgoal.php" type="button" class="btn btn-outline-warning mt-2">Personal Goal</a>
                            <a href="homemeeting.php" type="button" class="btn btn-outline-success mt-2">Home Meeting</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#Exhibition">Isi Jurnal</a>
                            <h5 class=" font-weight-bold text-primary">Exhibition</h5>
                            <p>adalah catatan materi yang akan disampaikan dalam kelas pameran</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="table-primary">
                                            <th width="10">No</th>
                                            <th>Category</th>
                                            <th>Verse</th>
                                            <th>Point of Blessing</th>
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
                                                <td><?= $row['category']; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['verse']; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['point_of_blessing']; ?>
                                                    </span>
                                                </td>
                                                <td><?= $row['date']; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['catatan_mentor']; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal view -->
                                                    <button type="button" id="detail" class="btn btn-dark " data-toggle="modal" data-target="#modal_detail" data-nis="<?= $row['nis']; ?>" data-category="<?= $row['category']; ?>" data-verse="<?= $row['verse']; ?>" data-pointblessings="<?= $row['point_of_blessing']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['catatan_mentor']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>


                                                    <?php
                                                    $tanggal = date('Y-m-d');
                                                    if ($tanggal <= $row['date']) { ?>
                                                        <!-- Edit Prayer Note -->
                                                        <button type="button" id="edit" class="btn btn-warning " data-toggle="modal" data-target="#edit_exhibition" data-nis="<?= $row['nis']; ?>" data-verse="<?= $row['verse']; ?>" data-pointblessings="<?= $row['point_of_blessing']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['catatan_mentor']; ?>" data-ctg="<?= $row['category']; ?>">
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
    <!-- End of Page Wrapper -->
    <?php
    include 'modal/modal_exhibition.php';
    include 'modal/modal_logout.php';
    include 'template/script.php';
    include 'template/alert.php';
    ?>
    <script>
        $(document).on("click", "#detail", function() {
            let nis = $(this).data('nis');
            let category = $(this).data('category');
            let verse = $(this).data('verse');
            let pointblessings = $(this).data('pointblessings');
            let mentor = $(this).data('mentor');
            let date = $(this).data('date');
            $(" #modal-detail #nis").val(nis);
            $(" #modal-detail #category").text(category);
            $(" #modal-detail #verse").val(verse);
            $(" #modal-detail #pointblessings").val(pointblessings);
            $(" #modal-detail #mentor").val(mentor);
            $(" #modal-detail #date").text(date);

        });

        $(document).on("click", "#edit", function() {
            let nis = $(this).data('nis');
            let verse = $(this).data('verse');
            let pointblessings = $(this).data('pointblessings');
            let mentor = $(this).data('mentor');
            let category = $(this).data('ctg');
            let date = $(this).data('date');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #verse").val(verse);
            $(" #modal-edit #category").val(category);
            $(" #modal-edit #pointblessings").val(pointblessings);
            $(" #modal-edit #mentor").val(mentor);
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