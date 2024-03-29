<?php
include '../database.php';
// sistem edit prayer note
if (isset($_POST['btn_prayernote'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $judul = htmlspecialchars($_POST['judul']);
    $efata = htmlspecialchars($_POST['efata']);
    $beban = htmlspecialchars($_POST['beban']);
    $point = htmlspecialchars($_POST['point']);
    $point1 = htmlspecialchars($_POST['point1']);
    $date = htmlspecialchars($_POST['date']);
    $catatan = htmlspecialchars($_POST['catatan']);
    $edit = mysqli_query($conn, "UPDATE `tb_prayer_note` SET `nis`='$nis',`point`='$point',`efata`='$efata',`point1`='$point1',`kategori`='$judul',`burden_inward_sense`='$beban',`catatan_mentor`='$catatan',`date`='$date' WHERE `tb_prayer_note`.`nis` ='$nis' AND `tb_prayer_note`.`date` ='$date'");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil Di Edit!';
    }
}

if (isset($_POST['hapus'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $date = htmlspecialchars($_POST['date']);
    $hapus =  mysqli_query($conn, "DELETE FROM `tb_prayer_note`  WHERE `nis` ='$nis' AND `date`='$date'");
    if ($hapus) {
        $notifdelete = $_SESSION['sukses'] = 'Data Berhasil Dihapus!';
    } else {
        $notifgagal = $_SESSION['sukses'] = 'Data Gagal Dihapus!';
    }
}

session_start();
include 'template/session.php';
//menampilkan data siswa dan jurnal
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
$semester = mysqli_query($conn, "SELECT * FROM tb_semester WHERE status= '1'") or die(mysqli_error($conn));

if (isset($_POST['filter_tanggal'])) {
    $mulai = $_POST['tanggal_mulai'];
    $selesai = $_POST['tanggal_akhir'];
    $nis = $_GET['nis'];

    if ($mulai != null || $selesai != null) {

        $jurnal = mysqli_query($conn, "SELECT * FROM tb_prayer_note WHERE nis='$nis' AND date BETWEEN '$mulai' AND '$selesai' ORDER BY date DESC;");
    } else {

        $nis = $_GET['nis'];
        $jurnal = mysqli_query($conn, "SELECT * FROM tb_prayer_note WHERE nis='$nis' ORDER BY date DESC");
        $prayernote = mysqli_fetch_array($jurnal);
    }
} else {
    $nis = $_GET['nis'];
    $jurnal = mysqli_query($conn, "SELECT * FROM tb_prayer_note WHERE nis='$nis' ORDER BY date DESC");
    $prayernote = mysqli_fetch_array($jurnal);
}
if (isset($_POST['reset'])) {
    $nis = $_GET['nis'];
    $jurnal = mysqli_query($conn, "SELECT * FROM tb_prayer_note WHERE nis='$nis' ORDER BY date DESC");
    $revivalnote = mysqli_fetch_array($jurnal);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jurnal Harian</title>
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
                            <h1 class="h3 mb-mb-4 embed-responsive text-uppercase">Jurnal Harian <?= $siswa2['name']; ?></h1>
                            <a href="revivalnote.php?nis=<?= $nis; ?>" type="button" class="btn mt-2 btn-outline-success">Revival Note</a>
                            <a href="prayernote.php?nis=<?= $nis; ?>" type="button" class="btn mt-2 btn-outline-warning active">Prayer Note</a>
                            <a href="biblereading.php?nis=<?= $nis; ?>" type="button" class="btn mt-2 btn-outline-danger">Bible Reading</a>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <div class="row mt-2">
                                <div class="col">
                                    <form action="" method="POST" class="form-inline">
                                        <?php
                                        if (isset($_POST['filter_tanggal'])) {
                                            $mulai = $_POST['tanggal_mulai'];
                                            $selesai = $_POST['tanggal_akhir'];
                                        ?>
                                            <input type="date" name="tanggal_mulai" value="<?= $mulai ?>" class="form-control">
                                            <input type="date" name="tanggal_akhir" value="<?= $selesai ?>" class="form-control ml-3">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="date" name="tanggal_mulai" class="form-control">
                                            <input type="date" name="tanggal_akhir" class="form-control ml-3">
                                        <?php } ?>
                                        <button type="submit" name="filter_tanggal" class="btn btn-info ml-3">Tampilkan</button>
                                        <button type="submit" name="reset" value="reset" class="btn btn-danger ml-3">Reset</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th width="250">Kategori</th>
                                            <th width="10" class="bg-warning">Poin</th>
                                            <th>Beban & Perasaan Batin</th>
                                            <th width="10" class="bg-warning">Poin</th>
                                            <th width="100">Tanggal</th>
                                            <th width="250">Catatan Mentor</th>
                                            <th width="150">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        $total = 0;
                                        // function categori($doa)
                                        // {
                                        //     global $conn;
                                        //     $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_categori_doa WHERE id='$doa'"));
                                        //     return $sqly['categori_doa'];
                                        // }
                                        ?>
                                        <?php foreach ($jurnal as $row) :
                                        ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['kategori']; ?></td>
                                                <td class="text-center"><a class="font-weight-bold text-danger font-italic"><?= $row['point1']; ?></a></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['burden_inward_sense']; ?>
                                                    </span>
                                                </td>
                                                <td class="text-center"><a class="font-weight-bold text-danger font-italic"><?= $row['point']; ?></a></td>
                                                <td><?= $row['date']; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['catatan_mentor']; ?></a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            Pilihan
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                            <!-- Button trigger modal -->
                                                            <a type="button" id="detail" class="dropdown-item" data-toggle="modal" data-target="#modal_detail" data-nis="<?= $row['nis']; ?>" data-category="<?= $row['kategori']; ?>" data-inward="<?= $row['burden_inward_sense']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['catatan_mentor']; ?>">
                                                                Lihat selengkapnya
                                                            </a>

                                                            <!-- Get data personal siswa -->
                                                            <a id="edit_prayer_note" data-toggle="modal" data-target="#prayer_note" data-judul="<?= $row["kategori"]; ?>" data-point="<?= $row['point']; ?>" data-point1="<?= $row['point1']; ?>" data-date="<?= $row["date"]; ?>" data-nis="<?= $row["nis"]; ?>" data-beban="<?= $row["burden_inward_sense"]; ?>" data-catatan="<?= $row["catatan_mentor"]; ?>" class="dropdown-item">
                                                                Edit
                                                            </a>

                                                            <a type="button" id="edit_prayer_note" class="dropdown-item text-danger" data-date="<?= $row["date"]; ?>" data-nis="<?= $row["nis"]; ?>" data-toggle="modal" data-target="#hapus">
                                                                Hapus
                                                            </a>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                            <?php
                                            $total = $total + $row['point1'] + $row['point']; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <th class="bg-warning text-right" colspan="7"> Total Point : </th>
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
            include 'template/footer_menu.php';
            ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <?php
    include 'modal/modal_logout.php';
    include 'modal/modal_prayernote.php';
    include 'template/script.php';
    include 'modal/modal_hapus.php';
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
        $(document).on("click", "#edit_prayer_note", function() {

            let nis = $(this).data('nis');
            let judul = $(this).data('judul');
            let beban = $(this).data('beban');
            let catatan = $(this).data('catatan');
            let point = $(this).data('point');
            let point1 = $(this).data('point1');
            let date = $(this).data('date');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #judul").val(judul);
            $(" #modal-edit #beban").val(beban);
            $(" #modal-edit #catatan").val(catatan);
            $(" #modal-edit #date").val(date);
            $(" #modal-edit #point").val(point);
            $(" #modal-edit #point1").val(point1);
            $(" #modal-hapus #nis").val(nis);
            $(" #modal-hapus #date").val(date);

        });
    </script>


</body>

</html>