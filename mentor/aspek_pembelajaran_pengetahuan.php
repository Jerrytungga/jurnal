<?php
include '../database.php';
// sistem edit catatan siswa
if (isset($_POST['input_tb_visi'])) {
    $data_siswa = htmlspecialchars($_POST['nis']);
    $data_efata = htmlspecialchars($_POST['efata']);
    $pelatihan = htmlspecialchars($_POST['pelatihan']);
    $penyegaran_pagi = htmlspecialchars($_POST['penyegaran_pagi']);
    $alkitab = htmlspecialchars($_POST['alkitab']);
    $pendidikan = htmlspecialchars($_POST['pendidikan']);
    $karakter = htmlspecialchars($_POST['karakter']);
    $semester = htmlspecialchars($_POST['semester']);
    $max_id = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id_kelas_visi`) As id FROM `tb_poin_kelas_visi`"));
    $id_max = $max_id['id'] + 1;
    if ($semester == 'NULL') {
        // echo "<script>alert('Semester belum di isi!');</script>";
        $notifgagaledit = $_SESSION['gagal'] = 'Semester belum di isi!';
    } else {
        $input_data_visi =  mysqli_query($conn, "INSERT INTO `tb_poin_kelas_visi`(`id_kelas_visi`, `poin_kelas_pelatihan`, `poin_kelas_penyegaran_pagi`, `poin_kelas_alkitab`, `poin_kelas_pendidikan`, `nis_siswa`, `efata_mentor`, `semester`,`poin_kelas_karakter`) VALUES ('$id_max','$pelatihan','$penyegaran_pagi','$alkitab','$pendidikan','$data_siswa','$data_efata','$semester','$karakter')");
    }

    // if ($edit) {
    //     $notifsuksesedit = $_SESSION['sukses'] = 'Saved!';
    // } else {
    //     $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil Di Edit!';
    // }
}
session_start();
include 'template/session.php';
//menampilkan data siswa dan catatan
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
$poin_kelas_visi = mysqli_query($conn, "SELECT * FROM tb_poin_kelas_visi WHERE nis_siswa='$nis' ORDER BY date DESC");
$data_kelas_visi = mysqli_fetch_array($poin_kelas_visi);
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
                        <a href="aspek_pembelajaran_pengetahuan.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary active">Kelas Visi</a>
                        <a href="kelas_hayat.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary">Kelas Hayat</a>
                        <a href="kelas_karakter.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary ">Kelas Karakter</a>
                        <a href="kelas_konsititusi.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary ">Kelas Konsititusi</a>

                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kelas_visi">
                                input points
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th>Poin Pelatihan</th>
                                            <th>Poin Penyegaran Pagi</th>
                                            <th>Poin Alkitab</th>
                                            <th>Poin Pendidikan</th>
                                            <th>Poin Karakter</th>
                                            <th>Semester</th>
                                            <th>Date</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($poin_kelas_visi as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['poin_kelas_pelatihan'] ?></td>
                                                <td><?= $row['poin_kelas_penyegaran_pagi'] ?></td>
                                                <td><?= $row['poin_kelas_alkitab'] ?></td>
                                                <td><?= $row['poin_kelas_pendidikan'] ?></td>
                                                <td><?= $row['poin_kelas_karakter'] ?></td>
                                                <td><?= $row['semester'] ?></td>
                                                <td><?= $row['date'] ?></td>
                                                <td><a href="proses_delete.php?id_kelas_visi=<?= $row['id_kelas_visi'] ?>&&nis=<?= $nis ?>" type="button" class="btn btn-danger">Delete</a></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="kelas_visi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Kelas Visi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" value="<?= $nis ?>" name="nis">
                                        <input type="hidden" value="<?= $id ?>" name="efata">
                                        <div>
                                            <label for="poin_pelatihan">Poin Kelas Pelatihan</label>
                                            <input type="number" class="form-control" name="pelatihan" required>
                                        </div>
                                        <div class="mt-2">
                                            <label for="poin_pp">Poin Kelas Penyegaran Pagi</label>
                                            <input type="number" class="form-control" name="penyegaran_pagi" required>
                                        </div>
                                        <div class="mt-2">
                                            <label for="poin_alkitab">Poin Kelas Alkitab</label>
                                            <input type="number" class="form-control" name="alkitab" required>
                                        </div>
                                        <div class="mt-2">
                                            <label for="poin_pendidikan">Poin Kelas Pendidikan</label>
                                            <input type="number" class="form-control" name="pendidikan" required>
                                        </div>
                                        <div class="mt-2">
                                            <label for="poin_karakter">Poin Kelas Karakter</label>
                                            <input type="number" class="form-control" name="karakter" required>
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