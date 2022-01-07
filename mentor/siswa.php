<?php
include '../database.php';
session_start();
include 'template/session.php';
if (isset($_POST['input'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $presensi = htmlspecialchars($_POST['presensi']);
    $nama = htmlspecialchars($_POST['name']);
    $week = htmlspecialchars($_POST['Minggu']);
    $input = mysqli_query($conn, "INSERT INTO `tb_presensi`(`nis`, `name`, `presensi`, `efata`,`week`) VALUES ('$nis','$nama','$presensi','$efata','$week')");
    if ($input) {
        $notifinput = $_SESSION['sukses'] = 'Data entered successfully!';
    } else {
        $notifgagalinput = $_SESSION['gagal'] = 'Data not entered successfully!';
    }
}
$siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND status='Aktif' ORDER BY date DESC");
$s = mysqli_fetch_array($siswa);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Siswa</title>
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
                        <h1 class="h3 mb-mb-4 text-gray-800">Siswa</h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-md-center">
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th>Foto</th>
                                            <th>Nis Siswa</th>
                                            <th>Nama Siswa</th>
                                            <th>Angkatan</th>
                                            <th>Gender</th>
                                            <th>Bimbel</th>
                                            <th>Status</th>
                                            <th>Jurnal</th>
                                            <th>Penilaian</th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-md-center">
                                        <?php $i = 1; ?>
                                        <?php foreach ($siswa as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td>
                                                    <img src="../img/fotosiswa/<?= $row["image"]; ?>" width="90">
                                                </td>
                                                <td><?= $row["nis"]; ?></td>
                                                <td><?= $row["name"]; ?></td>
                                                <td><?= $row["angkatan"]; ?></td>
                                                <td><?= $row["gender"]; ?></td>
                                                <td><?= $row["bimbel"]; ?></td>
                                                <td><?= $row["status"]; ?></td>
                                                <td>

                                                    <a href="revivalnote.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-primary btn-sm  form-group">
                                                        Daily
                                                    </a>
                                                    <a href="personalgoal.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-success btn-sm  form-group">
                                                        Weekly
                                                    </a>
                                                    <a href="blessings.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-warning btn-sm  form-group">
                                                        Monthly
                                                    </a><br>
                                                    <a href="reportweekly.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-warning btn-sm  form-group">
                                                        Report Weekly
                                                    </a>
                                                    <a href="catatan.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-success btn-sm  form-group">
                                                        Dairy Siswa
                                                    </a>
                                                    <a href="report_final.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-danger btn-sm  form-group">
                                                        isi Rapor
                                                    </a>

                                                    <a href="" id="pre" data-name="<?= $row["name"]; ?>" data-nis="<?= $row["nis"]; ?>" type="button" data-toggle="modal" data-target="#report" class="btn btn-dark btn-sm  form-group">
                                                        Presensi
                                                    </a>

                                                </td>

                                                <td>

                                                    <a href="virtues & Character.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-warning btn-sm  form-group">
                                                        VIRTUES & CHARACTER
                                                    </a>
                                                    <a href="livinglemari.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-success btn-sm  form-group">
                                                        LIVING LEMARI
                                                    </a>
                                                    <a href="livingraksepatudanhanduk.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-info btn-sm  form-group">
                                                        RAK SEPATU & HANDUK
                                                    </a>

                                                    <a href="living_ranjang.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-danger btn-sm  form-group">
                                                        RANJANG
                                                    </a>



                                                </td>

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
    include 'modal/modal_absensi.php';
    include 'template/script.php';
    include 'template/alert.php';
    ?>

    <script>
        $(document).on("click", "#pre", function() {
            var nis = $(this).data('nis');
            var name = $(this).data('name');
            $(" #modal-presensi #nis").val(nis);
            $(" #modal-presensi #name").val(name);

        });
    </script>


</body>

</html>