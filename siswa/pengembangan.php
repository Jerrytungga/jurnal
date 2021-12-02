<?php
include '../database.php';
// cek apakah yang mengakses halaman ini sudah login
session_start();
// // cek apakah yang mengakses halaman ini sudah login
include 'template/session.php';
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
                    <!-- 404 Error Text -->
                    <div class="text-center">
                        <div class="error mx-auto" data-text="13008">13008</div> <br>
                        <p class="lead text-gray-800 mb-5">Mohon Maaf Saat ini Halaman Reportweekly Sedang Mengalami Proses Migrasi Ke Sistem Semi Otomatis <br>
                            Proses Migrasi Akan Memakan Waktu 2x24 Jam.</p>
                        <h4 class="text-gray-500 mb-0 mt-2">Fokus dan Tetaplah Mengerjakan Jurnal dengan Baik...</h4> <br><br>
                        <h2 class="font-weight-bolder text-danger text-xxl-center">Roma 12:11 TB </h2>
                        <h4><em>Janganlah hendaknya kerajinanmu kendor</em></h4>


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