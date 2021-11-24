<?php
include '../database.php';
// sistem submit/post di bagian jurnal revival note
if (isset($_POST['revival_note'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $verse = htmlspecialchars($_POST['verse1']);
    $blessing = htmlspecialchars($_POST['blessing1']);
    $revival = mysqli_query($conn, "INSERT INTO `tb_revival_note`(`nis`, `verse`, `blessing`, `catatan_mentor`) VALUES ('$nis','$verse','$blessing',NULL)");
    if ($revival) {
        echo '<script>alert("Terima kasih telah mengisi jurnal hari ini.")</script>';
    } else {
        echo '<script>alert("Mohon Maaf Pengisian jurnal Hanya Sekali Saja")</script>';
    }
}
// sistem edit revival note
if (isset($_POST['btn_editrevivalnote'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $verse = htmlspecialchars($_POST['verse']);
    $blessing = htmlspecialchars($_POST['blessings']);
    $date = htmlspecialchars($_POST['date']);
    mysqli_query($conn, "UPDATE `tb_revival_note` SET `nis`='$nis',`verse`='$verse',`blessing`='$blessing' WHERE `tb_revival_note`.`nis` ='$nis' AND `tb_revival_note`.`date`='$date'");
}
// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
// query menampilkan data revival note siswa
$revival_note = mysqli_query($conn, "SELECT * FROM tb_revival_note WHERE nis='$id' ORDER BY date DESC");
$revivalnote = mysqli_fetch_array($revival_note);
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <?php
                    include 'template/topbar_menu.php';
                    ?>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">

                        <div class="group">
                            <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Daily</h1>
                            <p class=" mt embed-responsive">ini adalah jurnal yang harus diisi setiap hari, 7 hari/minggu, <span class="text-danger font-weight-bold">pengisian harus singkat dan jelas !</span></p>
                            <!-- <a href="Daily.php" type="button" class="btn btn-outline-primary mt-2">Pesonal Goal</a> -->
                            <a href="revivalnote.php" type="button" class="btn btn-success active mt-2">Revival Note</a>
                            <a href="prayernote.php" type="button" class="btn btn-outline-warning mt-2">Prayer Note</a>
                            <a href="biblereading.php" type="button" class="btn btn-outline-danger mt-2">Bible Reading</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#Revivalnote">Isi Jurnal</a>
                            <h5 class=" font-weight-bold text-success">Revival Note</h5>
                            <p>adalah catatan saat teduh (penyegaran pagi)</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="table-secondary">
                                            <th width="10">No</th>
                                            <th>Verse</th>
                                            <th>Blessing</th>
                                            <th width="100">Date</th>
                                            <th width="250">Mentor Notes</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($revival_note as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['verse']; ?>
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['blessing']; ?>
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['date']; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['catatan_mentor']; ?></a>
                                                    </span>
                                                </td>

                                                <td>
                                                    <!-- Button view detail revival note -->
                                                    <button type="button" id="detail" class="btn btn-dark" data-toggle="modal" data-target="#modal_detail" data-nis="<?= $row['nis']; ?>" data-verse="<?= $row['verse']; ?>" data-blessings="<?= $row['blessing']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['catatan_mentor']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <!-- edit revival note -->
                                                    <?php
                                                    $tanggal = date('Y-m-d');
                                                    if ($tanggal == $row['date']) { ?>

                                                        <button type="button" id="edit" class="btn btn-warning" data-toggle="modal" data-target="#revival_note" data-nis="<?= $row['nis']; ?>" data-verse="<?= $row['verse']; ?>" data-blessings="<?= $row['blessing']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['catatan_mentor']; ?>">
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
    <?php
    include 'modal/modal_revival_note.php';
    include 'modal/modal_logout.php';
    include 'template/script.php';
    ?>

    <script>
        $(document).on("click", "#detail", function() {
            let nis = $(this).data('nis');
            let verse = $(this).data('verse');
            let blessings = $(this).data('blessings');
            let mentor = $(this).data('mentor');
            let date = $(this).data('date');
            $(" #modal-detail #nis").val(nis);
            $(" #modal-detail #verse").val(verse);
            $(" #modal-detail #blessings").val(blessings);
            $(" #modal-detail #mentor").val(mentor);
            $(" #modal-detail #date").text(date);

        });

        $('document').ready(function() {
            $('textarea').each(function() {
                $(this).val($(this).val().trim());
            });
        });

        $(document).on("click", "#edit", function() {

            let nis = $(this).data('nis');
            let verse = $(this).data('verse');
            let blessings = $(this).data('blessings');
            let mentor = $(this).data('catatan');
            let date = $(this).data('date');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #verse").val(verse);
            $(" #modal-edit #blessings").val(blessings);
            $(" #modal-edit #mentor").val(mentor);
            $(" #modal-edit #date").val(date);

        });
    </script>

</body>

</html>