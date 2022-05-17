<?php
include '../database.php';
session_start();
include 'template/session.php';
//menampilkan data siswa dan jurnal

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Report Semester</title>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        include 'template/sidebar_menu.php';
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php
                include 'template/topbar_menu.php';
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <form action="./report_final.php">
                        <div class="container-fluid">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-mb-4 text-gray-800">Silahkan pilih siswa dan semester</h1>
                            </div>
                            <select class="form-control col-2 m-2" required name="filter" id="filter" aria-label="Default select example">
                                <option value="">Pilih semester</option>
                                <?php

                                $semester = mysqli_query($conn, "SELECT * FROM tb_semester ");
                                while ($thn = mysqli_fetch_array($semester)) {
                                    echo '<option value="' . $thn['thn_semester'] . '">' . $thn['keterangan'] . '</option>';
                                }
                                ?>
                                <!-- <input type="text" name="nis" required placeholder="Masukan Nis Siswa" class="form-control col-2 m-2"> -->
                            </select>
                            <select class="form-control col-2 m-2" required name="nis" id="nis" aria-label="Default select example">
                                <option value="">Pilih siswa</option>
                                <?php

                                $daftarsiswa = mysqli_query($conn, "SELECT * FROM siswa where status='Aktif' and mentor='$id' ");
                                while ($data1 = mysqli_fetch_array($daftarsiswa)) {
                                    echo '<option value="' . $data1['nis'] . '">' . $data1['name'] . '</option>';
                                }
                                ?>
                                <!-- <input type="text" name="nis" required placeholder="Masukan Nis Siswa" class="form-control col-2 m-2"> -->
                            </select>
                            <button class="btn btn-info mt-2 m-2" type="submit">Tampilkan</button>

                        </div>
                    </form>

                </div>

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


    <!-- Logout Modal-->
    <?php
    include 'modal/modal_logout.php';
    include 'template/script.php';
    ?>

</body>

</html>