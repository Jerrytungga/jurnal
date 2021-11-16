<?php
include '../database.php';
// sistem edit bible
if (isset($_POST['btn_bible'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $bible = htmlspecialchars($_POST['bible']);
    $ot = htmlspecialchars($_POST['ot']);
    $nt = htmlspecialchars($_POST['nt']);
    $date = htmlspecialchars($_POST['date']);
    $point_bible = htmlspecialchars($_POST['point']);
    $point_bible1 = htmlspecialchars($_POST['point1']);
    $point_bible2 = htmlspecialchars($_POST['point2']);
    $catatan4 = htmlspecialchars($_POST['catatan4']);
    mysqli_query($conn, "UPDATE `tb_bible_reading` SET `nis`='$nis', `point`='$point_bible',`point1`='$point_bible1',`point2`='$point_bible2',`bible`='$bible',`total_ot`='$ot',`total_nt`='$nt',`catatan_mentor`='$catatan4',`date`='$date' WHERE `tb_bible_reading`.`nis` ='$nis' AND `tb_bible_reading`.`date` ='$date'");
}
session_start();
// // cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['role'])) {
    echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu!');window.location='../../index.php'</script>";
} else if ($_SESSION['role'] == "Siswa") {
    header("location:../siswa/index.php");
} else if ($_SESSION['role'] == "Admin") {
    header("location:../admin/index.php");
} else {
    $id = $_SESSION['id_Mentor'];
    $get_data = mysqli_query($conn, "SELECT * FROM mentor WHERE efata='$id'");
    $data = mysqli_fetch_array($get_data);
}

//menampilkan data siswa dan jurnal
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];

if (isset($_POST['filter_tanggal'])) {
    $mulai = $_POST['tanggal_mulai'];
    $selesai = $_POST['tanggal_akhir'];
    $nis = $_GET['nis'];

    if ($mulai != null || $selesai != null) {

        $jurnal = mysqli_query($conn, "SELECT * FROM tb_bible_reading WHERE nis='$nis' AND date BETWEEN '$mulai' AND  DATE_ADD('$selesai',INTERVAL 1 DAY) ORDER BY date DESC;");
    } else {

        $nis = $_GET['nis'];
        $jurnal = mysqli_query($conn, "SELECT * FROM tb_bible_reading WHERE nis='$nis' ORDER BY date DESC");
        $exhibition = mysqli_fetch_array($jurnal);
    }
} else {
    $nis = $_GET['nis'];
    $jurnal = mysqli_query($conn, "SELECT * FROM tb_bible_reading WHERE nis='$nis' ORDER BY date DESC");
    $exhibition = mysqli_fetch_array($jurnal);
}

if (isset($_POST['reset'])) {
    $nis = $_GET['nis'];
    $jurnal = mysqli_query($conn, "SELECT * FROM tb_bible_reading WHERE nis='$nis' ORDER BY date DESC");
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
    <title>Jurnal Daily</title>
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
                            <h1 class="h3 mb-mb-4 embed-responsive text-gray-800">Jurnal Daily <?= $siswa2['name']; ?></h1>
                            <a href="revivalnote.php?nis=<?= $nis; ?>" type="button" class="btn mt-2 btn-outline-success">Revival Note</a>
                            <a href="prayernote.php?nis=<?= $nis; ?>" type="button" class="btn mt-2 btn-outline-warning">Prayer Note</a>
                            <a href="biblereading.php?nis=<?= $nis; ?>" type="button" class="btn mt-2 btn-outline-danger active">Bible Reading</a>
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
                                        <button type="submit" name="filter_tanggal" class="btn btn-info ml-3">Filter</button>
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
                                            <th>Bible</th>
                                            <th class="bg-warning">Point</th>
                                            <th>Total OT Chapter(s)</th>
                                            <th class="bg-warning">Point</th>
                                            <th>Total NT Chapter(s)</th>
                                            <th class="bg-warning">Point</th>
                                            <th width="100">Date</th>
                                            <th width="250">Mentor Notes</th>
                                            <th width="100">Options</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1;
                                        $total = 0;
                                        ?>
                                        <?php foreach ($jurnal as $row) : ?>
                                            <tr>
                                                <td> <?= $i; ?></td>
                                                <td><?= $row['bible']; ?></td>
                                                <td class="text-center"><a class="font-weight-bold text-danger font-italic"><?= $row['point1']; ?></a></td>
                                                <td><?= $row['total_ot']; ?></td>
                                                <td class="text-center"><a class="font-weight-bold text-danger font-italic"><?= $row['point2']; ?></a></td>
                                                <td><?= $row['total_nt']; ?></td>
                                                <td class="text-center"><a class="font-weight-bold text-danger font-italic"><?= $row['point']; ?></a></td>
                                                <td><?= $row['date']; ?></td>
                                                <td><a class="font-weight-bold text-primary font-italic"><?= $row['catatan_mentor']; ?></a></td>
                                                <td>
                                                    <!-- Get data personal siswa -->
                                                    <a id="edit_bible" data-toggle="modal" data-target="#biblereading" data-bible="<?= $row["bible"]; ?>" data-date="<?= $row["date"]; ?>" data-point="<?= $row["point"]; ?>" data-point1="<?= $row["point1"]; ?>" data-point2="<?= $row["point2"]; ?>" data-nis="<?= $row["nis"]; ?>" data-ot="<?= $row["total_ot"]; ?>" data-catatan="<?= $row["catatan_mentor"]; ?>" data-nt="<?= $row["total_nt"]; ?>">
                                                        <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $total = $total + $row['point'] + $row['point1'] + $row['point2']; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <th class="bg-warning text-right" colspan="7"> Total Point: </th>
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
            include 'template/footer_menu.php'; ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->


    <?php
    include 'modal/modal_logout.php';
    include 'modal/modal_biblereading.php';
    ?>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                scrollY: 400,
                scrollX: true,
                scrollCollapse: true,
                paging: true
            });
        });

        $(document).on("click", "#edit_bible", function() {

            let nis = $(this).data('nis');
            let bible = $(this).data('bible');
            let ot = $(this).data('ot');
            let nt = $(this).data('nt');
            let point = $(this).data('point');
            let point1 = $(this).data('point1');
            let point2 = $(this).data('point2');
            let date = $(this).data('date');
            let catatan4 = $(this).data('catatan');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #bible").val(bible);
            $(" #modal-edit #ot").val(ot);
            $(" #modal-edit #nt").val(nt);
            $(" #modal-edit #point").val(point);
            $(" #modal-edit #point1").val(point1);
            $(" #modal-edit #point2").val(point2);
            $(" #modal-edit #catatan4").val(catatan4);
            $(" #modal-edit #date").val(date);

        });
    </script>

</body>

</html>