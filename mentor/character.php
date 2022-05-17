<?php
include '../database.php';
// proses input nilai
if (isset($_POST['btnpenilaian'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $benar = htmlspecialchars($_POST['benar']);
    $tepat = htmlspecialchars($_POST['tepat']);
    $ketat = htmlspecialchars($_POST['ketat']);
    $notes = htmlspecialchars($_POST['catatan']);
    $smt = htmlspecialchars($_POST['smt']);
    $input = mysqli_query($conn, "INSERT INTO `tb_character`(`nis`, `efata`, `benar`, `tepat`, `ketat`, `catatan`,`semester`) VALUES ('$nis','$efata','$benar','$tepat','$ketat','$notes','$smt') ");
    if ($input) {
        $notifinput = $_SESSION['sukses'] = 'Data Berhasil Di Masukan!';
    } else {
        $notifgagalinput = $_SESSION['gagal'] = 'Data Gagal Di Masukan!';
    }
}
// proses edit inputan nilai
if (isset($_POST['editcharacter'])) {
    $no_efata = htmlspecialchars($_POST['efata']);
    $nis = htmlspecialchars($_POST['nis']);
    $date = htmlspecialchars($_POST['date']);
    $benar = htmlspecialchars($_POST['benar']);
    $tepat = htmlspecialchars($_POST['tepat']);
    $ketat = htmlspecialchars($_POST['ketat']);
    $notes = htmlspecialchars($_POST['catatan']);
    $smt = htmlspecialchars($_POST['smt']);
    $edit = mysqli_query($conn, "UPDATE `tb_character` SET `nis`='$nis',`efata`='$no_efata',`benar`='$benar',`tepat`='$tepat',`ketat`='$ketat',`catatan`='$notes',`semester`='$smt' WHERE `tb_character`.`nis`='$nis' AND `tb_character`.`date`='$date'");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil Di Edit!';
    }
}

if (isset($_POST['hapus'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $date = htmlspecialchars($_POST['date']);
    $hapus =  mysqli_query($conn, "DELETE FROM `tb_character`  WHERE `nis` ='$nis' AND `date`='$date'");
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
// flter tanggal
if (isset($_POST['filter_tanggal'])) {
    $mulai = $_POST['tanggal_mulai'];
    $selesai = $_POST['tanggal_akhir'];
    $nis = $_GET['nis'];

    if ($mulai != null || $selesai != null) {

        $penilaian = mysqli_query($conn, "SELECT * FROM tb_character WHERE nis='$nis' AND date BETWEEN '$mulai' AND '$selesai' ORDER BY date DESC;");
    } else {

        $nis = $_GET['nis'];
        $penilaian = mysqli_query($conn, "SELECT * FROM tb_character WHERE nis='$nis' ORDER BY date DESC");
        $nilai = mysqli_fetch_array($penilaian);
    }
} else {
    $nis = $_GET['nis'];
    $penilaian = mysqli_query($conn, "SELECT * FROM tb_character WHERE nis='$nis' ORDER BY date DESC");
    $nilai = mysqli_fetch_array($penilaian);
}
if (isset($_POST['reset'])) {
    $nis = $_GET['nis'];
    $penilaian = mysqli_query($conn, "SELECT * FROM tb_character WHERE nis='$nis' ORDER BY date DESC");
    $nilai = mysqli_fetch_array($penilaian);
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
    <title>Penilaian</title>
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
                    <?php
                    include 'template/menu_living_character_virtues.php'
                    ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <h6 class=" font-weight-bold text-warning">Karakter</h6>
                            <a href="" class="btn btn-warning mt-2" data-toggle="modal" data-target="#CHARACTER">Masukan Penilaian</a>
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
                                            <th width="50">Benar</th>
                                            <th width="50">Tepat</th>
                                            <th width="50">Ketat</th>
                                            <th width="100">Tanggal</th>
                                            <th width="250">Catatan Mentor</th>
                                            <th width="200">Aksi</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1;
                                        $total = 0;
                                        ?>
                                        <?php foreach ($penilaian as $row) : ?>
                                            <tr>
                                                <td> <?= $i; ?></td>
                                                <td><?= $row['benar']; ?></td>
                                                <td><?= $row['tepat']; ?></td>
                                                <td><?= $row['ketat']; ?></td>
                                                <td><?= $row['date']; ?></td>
                                                <td><a class="font-weight-bold text-primary font-italic"><?= $row['catatan']; ?></a></td>
                                                <td>

                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle " data-toggle="dropdown" aria-expanded="false">
                                                            Pilihan
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <!-- Button trigger modal -->
                                                            <a id="editpenilaian" type="button" data-toggle="modal" data-target="#edit" data-bnr="<?= $row['benar']; ?>" data-date="<?= $row['date']; ?>" data-tpt="<?= $row['tepat']; ?>" data-ketat="<?= $row['ketat']; ?>" data-nis="<?= $row['nis']; ?>" data-efata="<?= $row['efata']; ?>" data-cttn="<?= $row['catatan']; ?>" class="dropdown-item">
                                                                Edit
                                                            </a>
                                                            <a type="button" id="editpenilaian" class="dropdown-item text-danger" data-date="<?= $row["date"]; ?>" data-nis="<?= $row["nis"]; ?>" data-toggle="modal" data-target="#hapus">
                                                                Hapus
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <?php
                                            $total = $total + $row['benar'] + $row['tepat'] + $row['ketat']; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <th class="bg-warning text-right" colspan="6"> Total Poin : </th>
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
    include 'template/script.php';
    include 'modal/modal_penilaiancharacter.php';
    include 'template/alert.php';
    include 'modal/modal_hapus.php';
    ?>
    <script>
        $(document).on("click", "#editpenilaian", function() {
            let nis = $(this).data('nis');
            let efata = $(this).data('efata');
            let benar = $(this).data('bnr');
            let ketat = $(this).data('ketat');
            let tepat = $(this).data('tpt');
            let catatan = $(this).data('cttn');
            let date = $(this).data('date');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #efata").val(efata);
            $(" #modal-edit #benar").val(benar);
            $(" #modal-edit #ketat").val(ketat);
            $(" #modal-edit #tepat").val(tepat);
            $(" #modal-edit #date").val(date);
            $(" #modal-edit #catatan").val(catatan);
            $(" #modal-hapus #date").val(date);
            $(" #modal-hapus #nis").val(nis);

        });
    </script>

</body>

</html>