<?php
include '../database.php';
// sistem submit/post di bagian jurnal prayer note
if (isset($_POST['prayer_note'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $burden_inward_sense = htmlspecialchars($_POST['burden_inward_sense']);
    $smt = htmlspecialchars($_POST['smt']);
    $praye = mysqli_query($conn, "INSERT INTO `tb_prayer_note`(`nis`, `kategori`, `burden_inward_sense`, `semester`) VALUES ('$nis','$kategori','$burden_inward_sense','$smt')");
    if ($praye) {
        $notifsukses = $_SESSION['sukses'] = 'Berhasil Disimpan';
        echo notice(1);
    } else {
        $notifgagal = $_SESSION['gagal'] = 'Mohon Maaf Pengisian jurnal Hanya Sekali Saja';
        echo notice(0);
    }
}

// sistem edit prayer note
if (isset($_POST['btn_edit_prayernote'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $judul = htmlspecialchars($_POST['judul']);
    $beban = htmlspecialchars($_POST['beban']);
    $date = htmlspecialchars($_POST['date']);
    $smt = htmlspecialchars($_POST['smt']);
    $edit = mysqli_query($conn, "UPDATE `tb_prayer_note` SET `kategori`='$judul',`burden_inward_sense`='$beban',`semester`='$smt' WHERE `tb_prayer_note`.`nis` ='$nis' AND `tb_prayer_note`.`date` ='$date'");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Saved!';
        echo notice(1);
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Gagal!';
        echo notice(0);
    }
}

// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
$jurnal = mysqli_query($conn, "SELECT * FROM tb_prayer_note WHERE nis='$id' ORDER BY date DESC");
$doa = mysqli_fetch_array($jurnal);
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
                            <a href="prayernote.php" type="button" class="btn btn-outline-warning active mt-2">Prayer Note</a>
                            <a href="biblereading.php" type="button" class="btn btn-outline-danger mt-2">Bible Reading</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-warning float-right" data-toggle="modal" data-target="#prayernote">Isi Jurnal</a>
                            <h5 class=" font-weight-bold text-warning">Prayer Note</h5>
                            <p>adalah catatan doa pribadi</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="table-warning">
                                            <th width="10">No</th>
                                            <th>Category</th>
                                            <th>Burden & Inward Sense</th>
                                            <th width="100">Date</th>
                                            <th width="250">Mentor Notes</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        // function categori($doa)
                                        // {
                                        //     global $conn;
                                        //     $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_categori_doa WHERE categori_doa='$doa'"));
                                        //     return $sqly['categori_doa'];
                                        // }


                                        ?>
                                        <?php foreach ($jurnal as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['kategori']; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['burden_inward_sense']; ?>
                                                    </span>
                                                </td>
                                                <td><?= ($row['date']); ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['catatan_mentor']; ?></a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" id="detail" class="btn btn-dark" data-toggle="modal" data-target="#modal_detail" data-nis="<?= $row['nis']; ?>" data-category="<?= $row['kategori']; ?>" data-inward="<?= $row['burden_inward_sense']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['catatan_mentor']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <?php
                                                    $tanggal = date('Y-m-d');
                                                    if ($tanggal == $row['date']) { ?>
                                                        <!-- Edit Prayer Note -->
                                                        <a id="edit_prayer_note" data-toggle="modal" data-target="#prayer_note" data-judul="<?= $row["kategori"]; ?>" data-date="<?= $row["date"]; ?>" data-nis="<?= $row["nis"]; ?>" data-beban="<?= $row["burden_inward_sense"]; ?>">
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
    <?php
    include 'modal/modal_prayer_note.php';
    include 'modal/modal_logout.php';
    include 'template/script.php';
    include 'template/alert.php';
    ?>

    <script>
        $(document).on("click", "#detail", function() {
            let nis = $(this).data('nis');
            let category = $(this).data('category');
            let inward = $(this).data('inward');
            let mentor = $(this).data('mentor');
            let date = $(this).data('date');
            $(" #modal-detail #nis").val(nis);
            $(" #modal-detail #category").text(category);
            $(" #modal-detail #inward").val(inward);
            $(" #modal-detail #mentor").val(mentor);
            $(" #modal-detail #date").text(date);

        });

        $('document').ready(function() {
            $('textarea').each(function() {
                $(this).val($(this).val().trim());
            });
        });

        $(document).on("click", "#edit_prayer_note", function() {

            let nis = $(this).data('nis');
            let judul = $(this).data('judul');
            let beban = $(this).data('beban');
            let date = $(this).data('date');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #judul").val(judul);
            $(" #modal-edit #beban").val(beban);
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