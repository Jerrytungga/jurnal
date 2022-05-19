<?php
include '../database.php';
// sistem submit/post di bagian jurnal revival note
if (isset($_POST['revival_note'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $verse = htmlspecialchars($_POST['verse1']);
    $blessing = htmlspecialchars($_POST['blessing1']);
    $smt = htmlspecialchars($_POST['smt']);
    $revival = mysqli_query($conn, "INSERT INTO `tb_revival_note`(`nis`, `verse`, `blessing`, `semester`) VALUES ('$nis','$verse','$blessing','$smt')");
    if ($revival) {
        $notifsukses = $_SESSION['sukses'] = 'Berhasil Disimpan';
        echo notice(1);
    } else {
        $notifgagal = $_SESSION['gagal'] = 'Mohon Maaf Pengisian jurnal Hanya Sekali Saja';
        echo notice(0);
    }
}
// sistem edit revival note
if (isset($_POST['btn_editrevivalnote'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $verse = htmlspecialchars($_POST['verse']);
    $blessing = htmlspecialchars($_POST['blessings']);
    $date = htmlspecialchars($_POST['date']);
    $smt = htmlspecialchars($_POST['smt']);
    $edit = mysqli_query($conn, "UPDATE `tb_revival_note` SET `nis`='$nis',`verse`='$verse',`blessing`='$blessing',`semester`='$smt' WHERE `tb_revival_note`.`nis` ='$nis' AND `tb_revival_note`.`date`='$date'");
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

                <?php
                include 'template/topbar_menu.php';
                ?>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">

                        <div class="group">
                            <h1 class="h3 mb-mb-4 text-uppercase embed-responsive">Harian</h1>
                            <p class=" mt embed-responsive">ini adalah jurnal yang harus diisi setiap hari, 7 hari/minggu, <span class="text-danger font-weight-bold">pengisian harus singkat dan jelas !</span></p>
                            <!-- <a href="Daily.php" type="button" class="btn btn-outline-primary mt-2">Pesonal Goal</a> -->
                            <a href="revivalnote.php" type="button" class="btn btn-primary active mt-2">Penyegaran Pagi</a>
                            <a href="prayernote.php" type="button" class="btn btn-outline-primary mt-2">Catatan Doa</a>
                            <a href="biblereading.php" type="button" class="btn btn-outline-primary mt-2">Pembacaan Alkitab</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#Revivalnote">Isi Jurnal</a>
                            <h5 class=" font-weight-bold text-dark ">Penyegaran Pagi</h5>
                            <p>adalah catatan saat teduh </p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-primary text-light">
                                            <th width="10">No</th>
                                            <th>Ayat Alkitab</th>
                                            <th>Berkat</th>
                                            <th width="100">Tanggal</th>
                                            <th width="250">Catatan Mentor</th>
                                            <th>Aksi</th>
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

            <?php
            include 'template/footer.php';
            ?>

            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <?php
    include 'modal/modal_revival_note.php';
    include 'modal/modal_logout.php';
    include 'template/script.php';
    include 'template/alert.php';
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