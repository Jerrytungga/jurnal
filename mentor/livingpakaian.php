<?php
include '../../database.php';
session_start();
// // cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['role'] !== "Mentor") {
    echo "<script type='text/javascript'>
    alert('Anda harus login terlebih dahulu!');
    window.location = '../../index.php'
</script>";
} else {
    $id = $_SESSION['id_mentor'];
    $get_data = mysqli_query($conn, "SELECT * FROM mentor WHERE efata='$id'");
    $data = mysqli_fetch_array($get_data);
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
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-bible"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Jurnal PKA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface Mentor
            </div>

            <!-- Nav Item - Profile -->
            <li class="nav-item">
                <a class="nav-link" href="../profile.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>My Profile</span></a>
            </li>

            <!-- Nav Item - Siswa -->
            <li class="nav-item active">
                <a class="nav-link" href="../siswa.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Siswa</span></a>
            </li>


            <!-- Nav Item - final report -->
            <li class="nav-item">
                <a class="nav-link" href="../reportweekly.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Report Weekly</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Log Out -->
            <li class="nav-item">
                <a class="nav-link" href="../../logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
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
                    <h6 class="font-weight-bold text-danger">Anda Login Sebagai <?php echo $_SESSION['role']; ?></h6>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-3 d-none d-lg-inline text-gray-600 small"><?php echo $data['name']; ?> </span>
                                <img class="img-profile rounded-circle" src="../../img/foto_siswa/<?php echo $data['image']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="../../logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">

                        <div class="group">
                            <h1 class="h3 mb-mb-4  embed-responsive text-gray-800">LIVING LEMARI</h1>
                            <a href="livinglemari.php" type="button" class="btn btn-outline-primary mt-2">Buku</a>
                            <a href="livingpakaian.php" type="button" class="btn btn-outline-success active mt-2">Pakaian Lipat</a>
                            <a href="livingpakaiangantung.php" type="button" class="btn btn-outline-warning mt-2">Pakaian Gantung</a>
                            <a href="livingcelana.php" type="button" class="btn btn-outline-danger mt-2">Celana Lipat & Dll</a>
                            <a href="livinglogistik.php" type="button" class="btn btn-outline-primary mt-2">Logistik & Make Up</a>
                            <a href="livingdalaman.php" type="button" class="btn btn-outline-success mt-2">Pakaian Dalam</a>
                            <a href="livinglocker.php" type="button" class="btn btn-outline-warning mt-2">Locker</a>

                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-success" data-toggle="modal" data-target="#bajulipat">Input</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="10">No</th>
                                            <th>Posisi</th>
                                            <th>Tinggi/ Rendah</th>
                                            <th>Rapi</th>
                                            <th>Bersih</th>
                                            <th>Raib</th>
                                            <th>Date</th>
                                            <th>Option</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>


                                            <td>

                                                <button type="button" class="btn btn-success form-group">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger form-group">
                                                    Delete
                                                </button>
                                            </td>

                                        </tr>

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
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Jurnal PKA &copy; 2021 by Flats 41</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->



    <!-- Modal pakaian lipat-->
    <div class="modal fade" id="bajulipat" tabindex="-1" aria-labelledby="bajulipat" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="bajulipat">Baju Lipat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>


                <!-- bungkus untuk form inputan -->
                <form action="post" method="POST">
                    <div class="modal-body">
                        <h5 class="text-reset">Posisi</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <hr>
                        <h5 class="text-reset">Tinggi/ Rendah</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <hr>
                        <h5 class="text-reset">Rapi</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <hr>
                        <h5 class="text-reset">Bersih</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <hr>
                        <h5 class="text-reset">Raib</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>





    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>

</body>

</html>