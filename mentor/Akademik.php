<?php
include '../database.php';
if (isset($_POST['inputnilai'])) {
    $nilaitpa = $_POST['tpa'];
    $nilaitps = $_POST['tps'];
    $materi = $_POST['materi'];
    $data_siswa = htmlspecialchars($_POST['nis']);
    $data_efata = htmlspecialchars($_POST['efata']);
    $semester = htmlspecialchars($_POST['semester']);
    $max_id = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_akademik`) As id FROM `tb_akademik`"));
    $id_max = $max_id['id'] + 1;
    if ($semester == 'NULL' || $materi == 'NULL') {
        // echo "<script>alert('Semester belum di isi!');</script>";
        $notifgagaledit = $_SESSION['gagal'] = 'Semester belum di isi!';
    } else {
        $inputnilai = mysqli_query($conn, "INSERT INTO `tb_akademik`(`id_akademik`, `nilai_tpa`, `nilai_tps`,`efata_mentor`, `semester`, `nis`,`materi`) VALUES ('$id_max','$nilaitpa','$nilaitps','$data_efata','$semester','$data_siswa','$materi')");
        if ($inputnilai) {
            $notifinput = $_SESSION['sukses'] = 'Nilai Berhasil Di Masukan!';
        } else {
            $notifgagaledit = $_SESSION['gagal'] = 'Nilai Gagal Di Masukan!';
        }
    }
}
session_start();
include 'template/session.php';
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
$nilai_akademik = mysqli_query($conn, "SELECT * FROM tb_akademik WHERE nis='$nis' ORDER BY date DESC");
$data_akademik = mysqli_fetch_array($nilai_akademik);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Akademik (Persiapan SBMPTN)</title>
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
                        <div class="h3 mb-mb-2 text-uppercase"> Akademik (Persiapan SBMPTN)
                            <?= $siswa2['name']; ?>
                        </div>
                    </div>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#akademik">
                                Masukan Nilai
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info text-light">
                                            <th width="10">No</th>
                                            <th>Nilai TPA</th>
                                            <th>Nilai TPS</th>
                                            <th>Materi</th>
                                            <th>Semester</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($nilai_akademik as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['nilai_tpa'] ?></td>
                                                <td><?= $row['nilai_tps'] ?></td>
                                                <td><?= $row['materi'] ?></td>
                                                <td><?= $row['semester'] ?></td>
                                                <td><?= $row['date'] ?></td>
                                                <td><a href="proses_delete.php?id_akademik=<?= $row['id_akademik'] ?>&&nis=<?= $nis ?>" type="button" class="btn btn-danger">Hapus</a></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="akademik" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai Akademik</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" value="<?= $nis ?>" name="nis">
                                            <input type="hidden" value="<?= $id ?>" name="efata">
                                            <select name="materi" id="materi" class="form-control">
                                                <option seleted>Pilih Materi</option>
                                                <option value="Tryout">Tryout</option>
                                                <option value="UTBK">UTBK</option>
                                            </select>

                                            <div class="mt-2">
                                                <label for="tpa">Nilai TPA</label>
                                                <input type="number" class="form-control" name="tpa" required>
                                            </div>
                                            <div class="mt-2">
                                                <label for="Komunikasi">Nilai TPS</label>
                                                <input type="number" class="form-control" name="tps" required>
                                            </div>
                                            <div class="mt-2">
                                                <label for="semester">Semester :</label>
                                                <select class="form-control" name="semester" id="semester" required>
                                                    <option value="NULL">Pilih Semester</option>
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
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" name="inputnilai" class="btn btn-primary">Simpan</button>
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