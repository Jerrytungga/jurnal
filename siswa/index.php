<?php
include '../database.php';
// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
$get1 = mysqli_query($conn, "SELECT * FROM siswa WHERE status='Aktif' ");
$count1 = mysqli_num_rows($get1);
// menghitung total siswa
$get2 = mysqli_query($conn, "SELECT * FROM siswa ");
$count2 = mysqli_num_rows($get2);
// menghitung jumlah mentor
$get3 = mysqli_query($conn, "SELECT * FROM mentor WHERE status='Aktif'");
$count3 = mysqli_num_rows($get3);
// menghitung jumlah mentor
$get4 = mysqli_query($conn, "SELECT * FROM mentor");
$count4 = mysqli_num_rows($get4);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jurnal PKA</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- sidebar -->
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
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

                        </div>


                        <!-- Content Row -->
                        <div class="row">

                            <!-- Siswa aktif -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Siswa Aktif</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count1; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Siswa -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Total Siswa</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count2; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Mentor Aktif -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Mentor Aktif</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count3; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <!-- Total Mentor -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Total Mentor</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count4; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Bar Chart -->
                            <div class="card shadow  w-100 m-lg-2">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Pencapaian Jurnal</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="barchart" width="-90" height="-100"></canvas>
                                </div>

                            </div>


                        </div>


                        <!-- Content Row -->

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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
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

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-bar-demo.js"></script>



    <!-- contoh bar chart -->

    <script type="text/javascript">
        var ctx = document.getElementById("barchart").getContext("2d");
        var data = {
            labels: [<?php while ($p = mysqli_fetch_array($name)) {
                            echo '"' . $p['name'] . '",';
                        } ?>],
            datasets: [{
                label: "Presentase Jurnal",
                data: [<?php while ($p = mysqli_fetch_array($angkatan)) {
                            echo  '"' . $p['angkatan'] .  '",';
                        } ?>],
                backgroundColor: [
                    '#29B0D0',
                    '#2A516E',
                    '#F07124',
                    '#CBE0E3',
                    '#EFF400',
                    '#916BBF',
                    '#345B63',
                    '#51050F',
                    '#79B4B7',
                    '#93B5C6',
                    '#FFADAD',
                    '#F7D59C',
                    '#B5CDA3',
                    '#C8C2BC',
                    '#A7BBC7',
                    '#B8B5FF',
                    '#7868E6',
                    '#FFF76A'
                ]
            }]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                legend: {
                    display: false
                },
                barValueSpacing: 10,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 10,
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)",
                        }
                    }]
                }
            }
        });
    </script>

</body>

</html>