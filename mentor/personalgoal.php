<?php
include '../database.php';
// sistem update/edit goal seeting
if (isset($_POST['update'])) {
    $efata = htmlspecialchars($_POST['efata']);
    $nis = htmlspecialchars($_POST['nis']);
    $character = htmlspecialchars($_POST['character']);
    $prayer = htmlspecialchars($_POST['prayer']);
    $Neutron = htmlspecialchars($_POST['neutron']);
    $date = htmlspecialchars($_POST['date']);
    $catatan = htmlspecialchars($_POST['catatan']);
    $point1 = htmlspecialchars($_POST['point1']);
    $point2 = htmlspecialchars($_POST['point2']);
    $point3 = htmlspecialchars($_POST['point3']);
    $edit = mysqli_query($conn, "UPDATE `tb_personal_goal` SET `nis`='$nis',`point1`='$point1',`point2`='$point2',`point3`='$point3',`efata`='$efata',`character_virtue`='$character',`prayer`='$prayer',`date`='$date',`neutron`='$Neutron',`Catatan_mentor`='$catatan' WHERE `tb_personal_goal`.`nis` ='$nis' AND `tb_personal_goal`.`date`='$date'");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil Di Edit!';
    }
}

if (isset($_POST['hapus'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $date = htmlspecialchars($_POST['date']);
    $hapus =  mysqli_query($conn, "DELETE FROM `tb_personal_goal`  WHERE `nis` ='$nis' AND `date`='$date'");
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

        $jurnal = mysqli_query($conn, "SELECT * FROM tb_personal_goal WHERE nis='$nis' AND date BETWEEN '$mulai' AND '$selesai' ORDER BY date DESC;");
    } else {

        $nis = $_GET['nis'];
        $jurnal = mysqli_query($conn, "SELECT * FROM tb_personal_goal WHERE nis='$nis' ORDER BY date DESC");
        $goalseeting = mysqli_fetch_array($jurnal);
    }
} else {
    $nis = $_GET['nis'];
    $jurnal = mysqli_query($conn, "SELECT * FROM tb_personal_goal WHERE nis='$nis' ORDER BY date DESC");
    $goalseeting = mysqli_fetch_array($jurnal);
}
if (isset($_POST['reset'])) {
    $nis = $_GET['nis'];
    $jurnal = mysqli_query($conn, "SELECT * FROM tb_personal_goal WHERE nis='$nis' ORDER BY date DESC");
    $goalseeting = mysqli_fetch_array($jurnal);
}

?>

<!-- Html Goal Setting -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jurnal Mingguan</title>
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
                            <h1 class="h3 mb-mb-4 embed-responsive text-uppercase">Jurnal Mingguan <?= $siswa2['name']; ?></h1>
                            <a href="personalgoal.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary active mt-2">Personal Goal</a>
                            <a href="exhibition.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-warning mt-2">Exhibition</a>
                            <a href="homemeeting.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-success mt-2">Home Meeting</a>
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
                                            <th width="250">Kebajikan Karakter</th>
                                            <th width="10" class="bg-warning">Poin</th>
                                            <th width="250">Doa</th>
                                            <th width="10" class="bg-warning">Poin</th>
                                            <th width="250">Bimbel</th>
                                            <th width="10" class="bg-warning">Poin</th>
                                            <th width="100">Tanggal</th>
                                            <th width="250">Catatan Mentor</th>
                                            <th width="100px">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        $total = 0;
                                        ?>
                                        <?php foreach ($jurnal as $row) : ?>

                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['character_virtue']; ?>
                                                    </span>
                                                </td>
                                                <td class="text-center text-lg"><a class="font-weight-bold text-danger font-italic"><?= $row['point1']; ?></a></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['prayer']; ?>
                                                    </span>
                                                </td>
                                                <td class="text-center text-lg"><a class="font-weight-bold text-danger font-italic"><?= $row['point2']; ?></a></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['neutron']; ?>
                                                    </span>
                                                </td>
                                                <td class="text-center text-lg"><a class="font-weight-bold text-danger font-italic"><?= $row['point3']; ?></a></td>
                                                <td><?= $row['date']; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['Catatan_mentor']; ?></a>
                                                    </span>
                                                </td>

                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            Pilihan
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">


                                                            <a type="button" id="detail" class="dropdown-item" data-toggle="modal" data-target="#modal_detail" data-nis="<?= $row['nis']; ?>" data-karakter="<?= $row['character_virtue']; ?>" data-doa="<?= $row['prayer']; ?>" data-bimbel="<?= $row['neutron']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['Catatan_mentor']; ?>" class="dropdown-item">
                                                                Lihat selengkapnya
                                                            </a>

                                                            <!-- Get data personal siswa -->
                                                            <a id="edit_personalgoal" data-toggle="modal" data-target="#personalgoal" data-character="<?= $row["character_virtue"]; ?>" data-point1="<?= $row["point1"]; ?>" data-point2="<?= $row["point2"]; ?>" data-point3="<?= $row["point3"]; ?>" data-date="<?= $row["date"]; ?>" data-nis="<?= $row["nis"]; ?>" data-prayer="<?= $row["prayer"]; ?>" data-neutron="<?= $row["neutron"]; ?>" data-catatan="<?= $row["Catatan_mentor"]; ?>" class="dropdown-item">
                                                                Edit</a>

                                                            <a type="button" id="edit_personalgoal" class="dropdown-item text-danger" data-date="<?= $row["date"]; ?>" data-nis="<?= $row["nis"]; ?>" data-toggle="modal" data-target="#hapus">
                                                                Hapus
                                                            </a>

                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>
                                            <?php
                                            $total = $total + $row['point1'] + $row['point2'] + $row['point3']; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <th class="bg-warning text-right" colspan="9"> Total Poin : </th>
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
    <?php
    include 'modal/modal_logout.php';
    include 'modal/modal_personalgoal.php';
    include 'template/script.php';
    include 'modal/modal_hapus.php';
    include 'template/alert.php';
    ?>

    <script>
        $(document).on("click", "#edit_personalgoal", function() {

            let nis = $(this).data('nis');
            let character = $(this).data('character');
            let prayer = $(this).data('prayer');
            let point1 = $(this).data('point1');
            let point2 = $(this).data('point2');
            let point3 = $(this).data('point3');
            let neutron = $(this).data('neutron');
            let catatan = $(this).data('catatan');
            let date = $(this).data('date');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #point1").val(point1);
            $(" #modal-edit #point2").val(point2);
            $(" #modal-edit #point3").val(point3);
            $(" #modal-edit #character").val(character);
            $(" #modal-edit #prayer").val(prayer);
            $(" #modal-edit #neutron").val(neutron);
            $(" #modal-edit #catatan").val(catatan);
            $(" #modal-edit #date").val(date);
            $(" #modal-hapus #date").val(date);
            $(" #modal-hapus #nis").val(nis);
        });

        $(document).on("click", "#detail", function() {

            let date = $(this).data('date');
            let nis = $(this).data('nis');
            let doa = $(this).data('doa');
            let bimbel = $(this).data('bimbel');
            let karakter = $(this).data('karakter');
            let mentor = $(this).data('mentor');
            $(" #modal-detail #nis").val(nis);
            $(" #modal-detail #karakter").val(karakter);
            $(" #modal-detail #date").val(date);
            $(" #modal-detail #doa").val(doa);
            $(" #modal-detail #bimbel").val(bimbel);
            $(" #modal-detail #mentor").val(mentor);

        });
    </script>


</body>

</html>