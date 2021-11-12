<?php
include '../database.php';
include 'modal/function.php';
// cek apakah yang mengakses halaman ini sudah login
session_start();
// // cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['role'])) {
    echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu!');
    window.location='../index.php'</script>";
    //echo "tanpa role";
} else if ($_SESSION['role'] == "Mentor") {
    header("location:../mentor/index.php");
} else if ($_SESSION['role'] == "Admin") {
    header("location:../admin/index.php");
} else {
    $id = $_SESSION['id_Siswa'];
    $get_data = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$id'");
    $data = mysqli_fetch_array($get_data);
    // echo "else";
}
$report = query("SELECT * FROM tb_reportweekly WHERE nis='$id' ORDER BY date DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Report Jurnal</title>
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

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
                                <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Jurnal Report</h1>
                                <!-- <a href="" class="btn btn-primary mt-2" type="button"><i class="fas fa-download fa-sm text-white-50"></i> Download Report</a> -->
                            </div>
                        </div>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3">
                                <h6 class=" font-weight-bold text-primary">Report Weekly</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="text-center">
                                            <tr class="table-secondary">
                                                <th width="10">No</th>
                                                <th>Name</th>
                                                <th>Presensi</th>
                                                <th>Jurnal Daily</th>
                                                <th>Jurnal Weekly</th>
                                                <th>Jurnal Monthly</th>
                                                <th>Virtue</th>
                                                <th>Living Lemari Buku</th>
                                                <th>Living Rak Sepatu dan Handuk</th>
                                                <th>Living Ranjang</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th width="200">Date</th>

                                            </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            <?php $i = 1; ?>
                                            <?php foreach ($report as $row) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $row['name']; ?></td>
                                                    <td><?= $row['presensi']; ?></td>
                                                    <td><?= $row['jurnal_daily']; ?></td>
                                                    <td><?= $row['jurnal_weekly']; ?></td>
                                                    <td><?= $row['jurnal_monthly']; ?></td>
                                                    <td><?= $row['virtue']; ?></td>
                                                    <td><?= $row['living_buku']; ?></td>
                                                    <td><?= $row['living_sepatu_handuk']; ?></td>
                                                    <td><?= $row['living_ranjang']; ?></td>
                                                    <td><?= $row['total']; ?></td>
                                                    <td><?= $row['status']; ?></td>
                                                    <td><?= $row['keterangan']; ?></td>
                                                    <td><?= $row['date']; ?></td>

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

    <!-- Modal Log Out -->
    <?php
    include 'modal/modal_logout.php';
    ?>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
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
    </script>

</body>

</html>