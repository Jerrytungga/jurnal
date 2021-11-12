<?php
include '../database.php';
include 'modal/function.php';
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
$jurnal = query("SELECT * FROM tb_exhibition WHERE nis='$nis' ORDER BY date DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jurnal Weekly</title>
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
                            <h1 class="h3 mb-mb-4 embed-responsive text-gray-800">Jurnal Weekly <?= $siswa2['name']; ?></h1>
                            <a href="personalgoal.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary mt-2">Personal Goal</a>
                            <a href="exhibition.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-warning active mt-2">Exhibition</a>
                            <a href="homemeeting.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-success mt-2">Home Meeting</a>

                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th>Verse</th>
                                            <th>Point of Blessing</th>
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
                                                <td><?= $i; ?></td>
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
                                                <td class="text-center"><a class="font-weight-bold text-danger font-italic"><?= $row['point']; ?></a></td>
                                                <td><?= $row['date']; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['catatan_mentor']; ?></a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal view -->
                                                    <button type="button" id="detail" class="btn btn-dark " data-toggle="modal" data-target="#modal_detail" data-nis="<?= $row['nis']; ?>" data-verse="<?= $row['verse']; ?>" data-pointblessings="<?= $row['point_of_blessing']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['catatan_mentor']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <!-- Get data jurnal weekly-->
                                                    <a id="edit_exhibition" data-toggle="modal" data-target="#exhibition" data-verse1="<?= $row["verse"]; ?>" data-date="<?= $row["date"]; ?>" data-point="<?= $row["point"]; ?>" data-nis="<?= $row["nis"]; ?>" data-pointblessing="<?= $row["point_of_blessing"]; ?>" data-catatan3="<?= $row["catatan_mentor"]; ?>">
                                                        <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button></a>

                                                </td>
                                            </tr>
                                            <?php
                                            $total = $total + $row['point']; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <th class="bg-warning text-right" colspan="6"> Total Point : </th>
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
    include 'modal/modal_exhibition.php';
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

        $(document).on("click", "#detail", function() {
            let nis = $(this).data('nis');
            let verse = $(this).data('verse');
            let pointblessings = $(this).data('pointblessings');
            let mentor = $(this).data('mentor');
            let date = $(this).data('date');
            $(" #modal-detail #nis").val(nis);
            $(" #modal-detail #verse").val(verse);
            $(" #modal-detail #pointblessings").val(pointblessings);
            $(" #modal-detail #mentor").val(mentor);
            $(" #modal-detail #date").text(date);

        });

        $(document).on("click", "#edit_exhibition", function() {

            let nis = $(this).data('nis');
            let verse2 = $(this).data('verse1');
            let pointblessing = $(this).data('pointblessing');
            let point = $(this).data('point');
            let catatan2 = $(this).data('catatan3');
            let date = $(this).data('date');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #verse2").val(verse2);
            $(" #modal-edit #pointblessing").val(pointblessing);
            $(" #modal-edit #point").val(point);
            $(" #modal-edit #catatan2").val(catatan2);
            $(" #modal-edit #date").val(date);
        });
    </script>

</body>

</html>