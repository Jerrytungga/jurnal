<?php
include '../database.php';
// sistem edit catatan siswa
if (isset($_POST['input_tb_visi'])) {
    $data_siswa = htmlspecialchars($_POST['nis']);
    $data_efata = htmlspecialchars($_POST['efata']);
    $alkitab = htmlspecialchars($_POST['alkitab']);
    $semester = htmlspecialchars($_POST['semester']);
    $max_id = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_poin_konsititusi`) As id FROM `tb_poin_kelas_konsititusi`"));
    $id_max = $max_id['id'] + 1;
    if ($semester == 'NULL') {
        // echo "<script>alert('Semester belum di isi!');</script>";
        $notifgagaledit = $_SESSION['gagal'] = 'Semester belum di isi!';
    } else {
        $input_data_karakter =  mysqli_query($conn, "INSERT INTO `tb_poin_kelas_konsititusi`(`id_poin_konsititusi`, `poin_alkitab`, `semester`, `nis_siswa`, `efata_mentor`) VALUES ('$id_max','$alkitab','$semester','$data_siswa','$data_efata')");
    }
}
session_start();
include 'template/session.php';
//menampilkan data siswa dan catatan
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
$poin_kelas_konsititusi = mysqli_query($conn, "SELECT * FROM tb_poin_kelas_konsititusi WHERE nis_siswa='$nis' ORDER BY date DESC");
$data_kelas_konsititusi = mysqli_fetch_array($poin_kelas_konsititusi);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Aspek Pembelajaran Pengetahuan</title>
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
                        <div class="h3 mb-mb-2 text-gray-800">Aspek Pembelajaran Pengetahuan
                            <a class="h5">
                                <?= $siswa2['name']; ?>
                            </a>

                        </div>
                    </div>
                    <div class="mb-4">
                        <a href="aspek_pembelajaran_pengetahuan.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary">Kelas Visi</a>
                        <a href="kelas_hayat.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary">Kelas Hayat</a>
                        <a href="kelas_karakter.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary ">Kelas Karakter</a>
                        <a href="kelas_konsititusi.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary active">Kelas Konsititusi</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kelas_konsititusi">
                                input points
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th>Poin Kelas Alkitab</th>
                                            <th>Semester</th>
                                            <th>Date</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($poin_kelas_konsititusi as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['poin_alkitab'] ?></td>
                                                <td><?= $row['semester'] ?></td>
                                                <td><?= $row['date'] ?></td>
                                                <td><a href="proses_delete.php?id_kelas_konsititusi=<?= $row['id_poin_konsititusi'] ?>&&nis=<?= $nis ?>" type="button" class="btn btn-danger">Delete</a></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="kelas_konsititusi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Kelas Konsititusi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" value="<?= $nis ?>" name="nis">
                                            <input type="hidden" value="<?= $id ?>" name="efata">

                                            <div class="mt-2">
                                                <label for="poin_alkitab">Poin Kelas Alkitab</label>
                                                <input type="number" class="form-control" name="alkitab" required>
                                            </div>
                                            <div class="mt-2">
                                                <label for="semester">Semester :</label>
                                                <select class="form-control" name="semester" id="semester" required>
                                                    <option value="NULL">Select</option>
                                                    <?php
                                                    $sql_semester = mysqli_query($conn, "SELECT * FROM tb_semester");
                                                    while ($data_semester = mysqli_fetch_array($sql_semester)) {
                                                        echo '<option value="' . $data_semester['thn_semester'] . '">' . $data_semester['keterangan'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="input_tb_visi" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
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
    include 'modal/modal_logout.php';
    include 'template/script.php';
    include 'template/alert.php';
    ?>

</body>

</html>