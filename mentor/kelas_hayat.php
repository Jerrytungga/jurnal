<?php
include '../database.php';
// sistem edit catatan siswa
if (isset($_POST['input_tb_visi'])) {
    $data_siswa = htmlspecialchars($_POST['nis']);
    $data_efata = htmlspecialchars($_POST['efata']);
    $pdth = htmlspecialchars($_POST['pdth']);
    $hayat = htmlspecialchars($_POST['pengalaman_hayat']);
    $semester = htmlspecialchars($_POST['semester']);
    $max_id = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_kelas_hayat`) As id FROM `tb_poin_kelas_hayat`"));
    $id_max = $max_id['id'] + 1;
    if ($semester == 'NULL') {
        // echo "<script>alert('Semester belum di isi!');</script>";
        $notifgagaledit = $_SESSION['gagal'] = 'Semester belum di isi!';
    } else {
        $input_data_hayat =  mysqli_query($conn, "INSERT INTO `tb_poin_kelas_hayat`(`id_kelas_hayat`,`poin_kelas_pdth`, `poin_kelas_pengalaman_hayat`, `nis_siswa`, `efata_mentor`, `semester`) VALUES ('$id_max','$pdth','$hayat','$data_siswa','$data_efata','$semester')");
        if ($input_data_hayat) {
            $notifinput = $_SESSION['sukses'] = 'Poin Berhasil Di Masukan!';
        } else {
            $notifgagaledit = $_SESSION['gagal'] = 'Poin Gagal Di Masukan!';
        }
    }
}
session_start();
include 'template/session.php';
//menampilkan data siswa dan catatan
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
$poin_kelas_hayat = mysqli_query($conn, "SELECT * FROM tb_poin_kelas_hayat WHERE nis_siswa='$nis' ORDER BY date DESC");
$data_kelas_hayat = mysqli_fetch_array($poin_kelas_hayat);
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
                        <div class="h3 mb-mb-2 text-uppercase">Aspek Pembelajaran Pengetahuan
                            <?= $siswa2['name']; ?>


                        </div>
                    </div>
                    <div class="mb-4">
                        <a href="aspek_pembelajaran_pengetahuan.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary">Kelas Visi</a>
                        <a href="kelas_hayat.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary active">Kelas Hayat</a>
                        <a href="kelas_karakter.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary ">Kelas Karakter</a>
                        <a href="kelas_konsititusi.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary ">Kelas Konsititusi</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kelas_hayat">
                                Masukan Poin
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th>Poin Kelas PDTH</th>
                                            <th>Poin Kelas Pengalaman Hayat</th>
                                            <th>Semester</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($poin_kelas_hayat as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['poin_kelas_pdth'] ?></td>
                                                <td><?= $row['poin_kelas_pengalaman_hayat'] ?></td>
                                                <td><?= $row['semester'] ?></td>
                                                <td><?= $row['date'] ?></td>
                                                <td><a href="proses_delete.php?id_kelas_hayat=<?= $row['id_kelas_hayat'] ?>&&nis=<?= $nis ?>" type="button" class="btn btn-danger">Hapus</a></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="kelas_hayat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Kelas Hayat</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" value="<?= $nis ?>" name="nis">
                                            <input type="hidden" value="<?= $id ?>" name="efata">

                                            <div class="mt-2">
                                                <label for="poin_pdth">Poin Kelas PDTH</label>
                                                <input type="number" class="form-control" name="pdth" required>
                                            </div>
                                            <div class="mt-2">
                                                <label for="poin_pengalaman_hayat">Poin Kelas Pengalaman Hayat</label>
                                                <input type="number" class="form-control" name="pengalaman_hayat" required>
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
                                            <button type="submit" name="input_tb_visi" class="btn btn-primary">Simpan</button>
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