<?php
include '../database.php';
// sistem penilaian my virtues & character
if (isset($_POST['btn_myvirtues'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $berbagi = htmlspecialchars($_POST['berbagi']);
    $salam = htmlspecialchars($_POST['salam']);
    $berterimakasih = htmlspecialchars($_POST['berterimakasih']);
    $hormat = htmlspecialchars($_POST['hormat']);
    $catatan = htmlspecialchars($_POST['catatan']);
    mysqli_query($conn, "INSERT INTO `tb_vrtues_caharacter`(`nis`, `perhatian_berbagi`, `salam_sapa`, `bersyukur_berterimakasih`, `hormat_taat`, `efata`, `catatan`) VALUES ('$nis','$berbagi','$salam','$berterimakasih','$hormat','$efata','$catatan')");
}
// sistem edit penilaian my virtues & character
if (isset($_POST['btn_virtue_character'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $berbagi = htmlspecialchars($_POST['berbagi']);
    $salam = htmlspecialchars($_POST['salam']);
    $ucapan = htmlspecialchars($_POST['ucapan']);
    $hormat = htmlspecialchars($_POST['hormat']);
    $catatan = htmlspecialchars($_POST['catatan']);
    mysqli_query($conn, "UPDATE `tb_vrtues_caharacter` SET `perhatian_berbagi`='$berbagi',`salam_sapa`='$salam',`bersyukur_berterimakasih`='$ucapan',`hormat_taat`='$hormat',`catatan`='$catatan' WHERE `tb_vrtues_caharacter`.`nis`='$nis'");
}


session_start();
// // cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['role'])) {
    echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu!');window.location='../../index.php'</script>";
} else if ($_SESSION['role'] == "Siswa") {
    header("location:../siswa/index.php");
} else if ($_SESSION['role'] == "Admin") {
    header("location:../admin/index.php");
} else {
    $id = $_SESSION['id_Mentor'];
    $get_data = mysqli_query($conn, "SELECT * FROM mentor WHERE efata='$id'");
    $data = mysqli_fetch_array($get_data);
}
//menampilkan data siswa dan jurnal
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];

if (isset($_POST['filter_tanggal'])) {
    $mulai = $_POST['tanggal_mulai'];
    $selesai = $_POST['tanggal_akhir'];
    $nis = $_GET['nis'];

    if ($mulai != null || $selesai != null) {

        $penilaian = mysqli_query($conn, "SELECT * FROM tb_vrtues_caharacter WHERE nis='$nis' AND date BETWEEN '$mulai' AND '$selesai' ORDER BY date DESC;");
    } else {

        $nis = $_GET['nis'];
        $penilaian = mysqli_query($conn, "SELECT * FROM tb_vrtues_caharacter WHERE nis='$nis' ORDER BY date DESC");
        $nilai = mysqli_fetch_array($penilaian);
    }
} else {
    $nis = $_GET['nis'];
    $penilaian = mysqli_query($conn, "SELECT * FROM tb_vrtues_caharacter WHERE nis='$nis' ORDER BY date DESC");
    $nilai = mysqli_fetch_array($penilaian);
}
if (isset($_POST['reset'])) {
    $nis = $_GET['nis'];
    $penilaian = mysqli_query($conn, "SELECT * FROM tb_vrtues_caharacter WHERE nis='$nis' ORDER BY date DESC");
    $nilai = mysqli_fetch_array($penilaian);
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
                        <div class="group">
                            <h1 class="h3 mb-mb-4 embed-responsive text-gray-800">My Virtues & Character <?= $siswa2['name']; ?></h1>
                            <a href="virtues & Character.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary active mt-2">My Virtues & Character</a>
                            <a href="virtues.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-success mt-2">Virtues</a>
                            <a href="character.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-warning  mt-2">Character</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-primary text-right mt-2" data-toggle="modal" data-target="#virtuesdancharacter">Input</a>
                            <div class="row mt-2">
                                <div class="col">
                                    <form action="" method="POST" class="form-inline">
                                        <?php
                                        if (isset($_POST['filter_tanggal'])) {
                                            $mulai = $_POST['tanggal_mulai'];
                                            $selesai = $_POST['tanggal_akhir'];
                                        ?>
                                            <input type="date" name="tanggal_mulai" value="<?= $mulai ?>" class="form-control">
                                            <input type="date" name="tanggal_akhir" value="<?= $selesai ?>" class="form-control ml-3">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="date" name="tanggal_mulai" class="form-control">
                                            <input type="date" name="tanggal_akhir" class="form-control ml-3">
                                        <?php } ?>
                                        <button type="submit" name="filter_tanggal" class="btn btn-info ml-3">Filter</button>
                                        <button type="submit" name="reset" value="reset" class="btn btn-danger ml-3">Reset</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th width="50">Perhatian & berbagi</th>
                                            <th width="50">Tegor sapa / Salam</th>
                                            <th width="50">Bersyukur / Berterima kasih</th>
                                            <th width="50">Hormat & Taat</th>
                                            <th width="100">Date</th>
                                            <th width="250">Mentor Notes</th>
                                            <th width="200">Options</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1;
                                        $total = 0;
                                        ?>
                                        <?php foreach ($penilaian as $row) : ?>
                                            <tr>
                                                <td> <?= $i; ?></td>
                                                <td><?= $row['perhatian_berbagi']; ?></td>
                                                <td><?= $row['salam_sapa']; ?></td>
                                                <td><?= $row['bersyukur_berterimakasih']; ?></td>
                                                <td><?= $row['hormat_taat']; ?></td>
                                                <td><?= $row['date']; ?></td>
                                                <td><a class="font-weight-bold text-primary font-italic"><?= $row['catatan']; ?></a></td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a id="editpenilaian" type="button" data-toggle="modal" data-target="#edit" data-berbagi="<?= $row['perhatian_berbagi']; ?>" data-salam="<?= $row['salam_sapa']; ?>" data-ucapan="<?= $row['bersyukur_berterimakasih']; ?>" data-hormat="<?= $row['hormat_taat']; ?>" data-nis="<?= $row['nis']; ?>" data-efata="<?= $row['efata']; ?>" data-cttn="<?= $row['catatan']; ?>">
                                                        <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button>
                                                    </a>
                                                </td>

                                            </tr>
                                            <?php
                                            $total = $total + $row['perhatian_berbagi'] + $row['salam_sapa'] + $row['bersyukur_berterimakasih'] + $row['hormat_taat']; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>

                                    </tbody>
                                    <tfoot>
                                        <th class="bg-warning text-right" colspan="7"> Total Point : </th>
                                        <th class="text-center"><?= $total; ?></th>
                                    </tfoot>
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
    include 'modal/modal_virtues_character.php';
    ?>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                scrollY: 400,
                scrollX: true,
                scrollCollapse: true,
                paging: true
            });
        });

        $(document).on("click", "#editpenilaian", function() {
            let nis = $(this).data('nis');
            let efata = $(this).data('efata');
            let berbagi = $(this).data('berbagi');
            let salam = $(this).data('salam');
            let ucapan = $(this).data('ucapan');
            let hormat = $(this).data('hormat');
            let catatan = $(this).data('cttn');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #efata").val(efata);
            $(" #modal-edit #berbagi").val(berbagi);
            $(" #modal-edit #salam").val(salam);
            $(" #modal-edit #ucapan").val(ucapan);
            $(" #modal-edit #hormat").val(hormat);
            $(" #modal-edit #catatan").val(catatan);

        });
    </script>

</body>

</html>