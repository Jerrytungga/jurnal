<?php
include '../database.php';
// cek apakah yang mengakses halaman ini sudah login
session_start();
// // cek apakah yang mengakses halaman ini sudah login
include 'template/session.php';
$report = mysqli_query($conn, "SELECT * FROM tb_reportweekly WHERE nis='$id' ORDER BY date DESC");
$weekl = mysqli_fetch_array($report);
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
                            <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Jurnal Report</h1>
                            <a href="cetak.php" class="btn btn-primary mt-2" type="button"><i class="fas fa-download fa-sm text-white-50"></i> Download Report</a>

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
                                            <th width="200">Name</th>
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
                                            <th width="200">Sanksi</th>
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
                                                <td><?= $row['sanksi']; ?></td>
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
    include 'template/script.php';
    ?>


</body>

</html>