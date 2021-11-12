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
$jurnal = query("SELECT * FROM tb_personal_goal WHERE nis='$nis' ORDER BY date DESC");
// $point = mysqli_fetch_array(mysqli_query($conn, "SELECT character_virtue, count(character_virtue) as point from tb_personal_goal GROUP BY character_virtue"));
// $point1 = mysqli_fetch_array(mysqli_query($conn, "SELECT prayer, count(prayer) as point1 fr"));
// $point2 = mysqli_fetch_array(mysqli_query($conn, "SELECT neutron, count(neutron) as point from tb_personal_goal WHERE nis='$nis' AND neutron!='' GROUP BY neutron;"));
// $total1 = mysqli_fetch_array(mysqli_query($conn, "SELECT count(character_virtue) as total1 from tb_personal_goal WHERE nis='$nis'"));
// $total2 = mysqli_fetch_array(mysqli_query($conn, "SELECT count(prayer) as total2 from tb_personal_goal WHERE nis='$nis'"));
// $total3 = mysqli_fetch_array(mysqli_query($conn, "SELECT count(neutron) as total3 from tb_personal_goal WHERE nis='$nis'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jurnal Weekly </title>
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
                            <a href="personalgoal.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary active mt-2">Personal Goal</a>
                            <a href="exhibition.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-warning mt-2">Exhibition</a>
                            <a href="homemeeting.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-success mt-2">Home Meeting</a>

                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <!-- <div class="card-header py-3">
                            <div class="row mt-4">
                                <div class="col">
                                    <form action="" method="POST" class="form-inline">
                                        <input type="date" name="tanggal_mulai" class="form-control">
                                        <input type="date" name="tanggal_akhir" class="form-control ml-3">
                                        <button type="submit" name="filter_tanggal" class="btn btn-info ml-3">Filter</button>
                                    </form>
                                </div>
                            </div>
                        </div> -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th width="250"> Character Virtue</th>
                                            <th class="bg-warning">Point</th>
                                            <th width="250">Prayer</th>
                                            <th class="bg-warning">Point</th>
                                            <th width="250">Bimbel</th>
                                            <th class="bg-warning">Point</th>
                                            <th width="100">Date</th>
                                            <th width="250">Mentor Notes</th>
                                            <th width="100px">Options</th>

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
                                                    <button type="button" id="detail" class="btn btn-dark btn-inline " data-toggle="modal" data-target="#modal_detail" data-nis="<?= $row['nis']; ?>" data-karakter="<?= $row['character_virtue']; ?>" data-doa="<?= $row['prayer']; ?>" data-neutron="<?= $row['neutron']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['Catatan_mentor']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <!-- Get data personal siswa -->
                                                    <a id="edit_personalgoal" data-toggle="modal" data-target="#personalgoal" data-character="<?= $row["character_virtue"]; ?>" data-point1="<?= $row["point1"]; ?>" data-point2="<?= $row["point2"]; ?>" data-point3="<?= $row["point3"]; ?>" data-date="<?= $row["date"]; ?>" data-nis="<?= $row["nis"]; ?>" data-prayer="<?= $row["prayer"]; ?>" data-neutron="<?= $row["neutron"]; ?>" data-catatan="<?= $row["Catatan_mentor"]; ?>">
                                                        <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button></a>

                                                    <!-- penilaian -->
                                                    <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#penilaian">
                                                        Nilai
                                                    </button> -->

                                                </td>
                                            </tr>
                                            <?php
                                            $total = $total + $row['point1'] + $row['point2'] + $row['point3']; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <th class="bg-warning text-right" colspan="9"> Total Point : </th>
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
                scrollY: 600,
                scrollX: true,
                scrollCollapse: true,
                paging: true,
                lengthMenu: [
                    [7, 10, 25, 50, -1],
                    [7, 10, 25, 50, "All"]
                ],

            });
        });

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
        });

        $(document).on("click", "#detail", function() {
            let nis = $(this).data('nis');
            let karakter = $(this).data('karakter');
            let doa = $(this).data('doa');
            let neutron = $(this).data('neutron');
            let mentor = $(this).data('mentor');
            let date = $(this).data('date');
            $(" #modal-detail #nis").val(nis);
            $(" #modal-detail #karakter").val(karakter);
            $(" #modal-detail #doa").val(doa);
            $(" #modal-detail #neutron").val(neutron);
            $(" #modal-detail #mentor").val(mentor);
            $(" #modal-detail #date").val(date);

        });
    </script>

</body>

</html>