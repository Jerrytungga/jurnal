<?php

include '../database.php';

// sistem ganti password
if (isset($_POST['edit_profile'])) {
    $efata = htmlspecialchars($_POST['efata']);
    $password = htmlspecialchars($_POST['password']);
    $addtotable = mysqli_query($conn, "UPDATE `mentor` SET `efata`='$efata',`password`='$password' WHERE `mentor`.`efata`='$efata'");
    if ($addtotable) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Password Tidak Berhasil Di Ganti!';
    }
}
// // cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Profil Saya</title>
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
                        <h1 class="h3 mb-mb-4  embed-responsive text-gray-800">Profil Saya</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Content Column -->
                        <div class="card mb-4 shadow-lg  bg-body rounded m-3" style="max-width: 700px;">
                            <div class="card" style="width: 18rem;">
                                <img src="../img/fotomentor/<?= $data['image']; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title">Nama : <?= $data['name']; ?></h6>
                                    <h6 class="card-title">Username : <?= $data['username']; ?></h6>
                                    <h6 class="card-title">Password : <?= $data['password']; ?></h6>
                                    <a id="edit_mentor" data-toggle="modal" data-target="#edit" data-efata="<?= $data['efata']; ?>" data-password="<?= $data["password"]; ?>">
                                        <button class="btn btn-info btn-warning">Ganti Password</button></a>

                                </div>
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
    //modal logot
    include 'modal/modal_logout.php';
    //modal edit profile
    include 'modal/modal_edit_profile.php';
    include 'template/alert.php';
    ?>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <?php
    include 'template/alert.php';
    ?>
    <script>
        $(document).on("click", "#edit_mentor", function() {
            let efata = $(this).data('efata');
            let password = $(this).data('password');
            $(" #modal-edit #password").val(password);
            $(" #modal-edit #efata").val(efata);

        });
    </script>
</body>

</html>