<?php
include '../database.php';
//sistem input penilaian virtues
if (isset($_POST['btn_submit_virtues'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $sikapramahsopan = htmlspecialchars($_POST['sikapramahsopan']);
    $sikapberkordinasi = htmlspecialchars($_POST['sikapberkordinasi']);
    $sikaptolongmenolong = htmlspecialchars($_POST['sikaptolongmenolong']);
    $sikapseedo = htmlspecialchars($_POST['sikapseedo']);
    $catatan = htmlspecialchars($_POST['catatan']);
    $input = mysqli_query($conn, "INSERT INTO `tb_virtues`(`nis`, `efata`, `sikapramahsopan`, `sikapberkordinasi`, `sikaptolongmenolong`, `sikapseedo`,`catatan`) VALUES ('$nis','$efata','$sikapramahsopan','$sikapberkordinasi','$sikaptolongmenolong','$sikapseedo','$catatan')");
    if ($input) {
        $notifinput = $_SESSION['sukses'] = 'Data entered successfully!';
    } else {
        $notifgagalinput = $_SESSION['gagal'] = 'Data not entered successfully!';
    }
}
//sistem edit penilaian virtues
if (isset($_POST['btn_virtue'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $sikapramahsopan = htmlspecialchars($_POST['sikapramahsopan']);
    $sikapberkordinasi = htmlspecialchars($_POST['sikapberkordinasi']);
    $sikaptolongmenolong = htmlspecialchars($_POST['sikaptolongmenolong']);
    $sikapseedo = htmlspecialchars($_POST['sikapseedo']);
    $catatan = htmlspecialchars($_POST['catatan']);
    $edit = mysqli_query($conn, "UPDATE `tb_virtues` SET `sikapramahsopan`='$sikapramahsopan',`sikapberkordinasi`='$sikapberkordinasi',`sikaptolongmenolong`='$sikaptolongmenolong',`sikapseedo`='$sikapseedo',`catatan`='$catatan' WHERE  `tb_virtues`.`nis`='$nis'");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Saved!';
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Sorry, the data was not edited successfully!';
    }
}

session_start();
include 'template/session.php';
//menampilkan data siswa
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
// flter tanggal 
if (isset($_POST['filter_tanggal'])) {
    $mulai = $_POST['tanggal_mulai'];
    $selesai = $_POST['tanggal_akhir'];
    $nis = $_GET['nis'];

    if ($mulai != null || $selesai != null) {

        $penilaian = mysqli_query($conn, "SELECT * FROM tb_virtues WHERE nis='$nis' AND date BETWEEN '$mulai' AND '$selesai' ORDER BY date DESC;");
    } else {

        $nis = $_GET['nis'];
        $penilaian = mysqli_query($conn, "SELECT * FROM tb_virtues WHERE nis='$nis' ORDER BY date DESC");
        $nilai = mysqli_fetch_array($penilaian);
    }
} else {
    $nis = $_GET['nis'];
    $penilaian = mysqli_query($conn, "SELECT * FROM tb_virtues WHERE nis='$nis' ORDER BY date DESC");
    $nilai = mysqli_fetch_array($penilaian);
}
if (isset($_POST['reset'])) {
    $nis = $_GET['nis'];
    $penilaian = mysqli_query($conn, "SELECT * FROM tb_virtues WHERE nis='$nis' ORDER BY date DESC");
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
                    <?php
                    include 'template/menu_living_character_virtues.php'
                    ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <h6 class=" font-weight-bold text-success">Virtues</h6>
                            <a href="" class="btn btn-success mt-2" data-toggle="modal" data-target="#virtues">Input</a>
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
                                            <th width="50">Ramah & Sopan</th>
                                            <th width="50">Berkordinasi</th>
                                            <th width="50">Tolong Menolong</th>
                                            <th width="50">See & Do</th>
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
                                                <td><?= $row['sikapramahsopan']; ?></td>
                                                <td><?= $row['sikapberkordinasi']; ?></td>
                                                <td><?= $row['sikaptolongmenolong']; ?></td>
                                                <td><?= $row['sikapseedo']; ?></td>
                                                <td><?= $row['date']; ?></td>
                                                <td><a class="font-weight-bold text-primary font-italic"><?= $row['catatan']; ?></a></td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a id="editpenilaian" type="button" data-toggle="modal" data-target="#edit" data-sikapramahsopan="<?= $row['sikapramahsopan']; ?>" data-sikapberkordinasi="<?= $row['sikapberkordinasi']; ?>" data-sikaptolongmenolong="<?= $row['sikaptolongmenolong']; ?>" data-sikapseedo="<?= $row['sikapseedo']; ?>" data-nis="<?= $row['nis']; ?>" data-efata="<?= $row['efata']; ?>" data-cttn="<?= $row['catatan']; ?>">
                                                        <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button>
                                                    </a>
                                                </td>

                                            </tr>
                                            <?php
                                            $total = $total + $row['sikapramahsopan'] + $row['sikapberkordinasi'] + $row['sikaptolongmenolong'] + $row['sikapseedo']; ?>
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
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <?php
    include 'modal/modal_logout.php';
    include 'modal/modal_virtues.php';
    include 'template/script.php';
    include 'template/alert.php';
    ?>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                scrollY: 800,
                scrollX: true,
                scrollCollapse: true,
                paging: true
            });
        });

        $(document).on("click", "#editpenilaian", function() {
            let nis = $(this).data('nis');
            let efata = $(this).data('efata');
            let sikapramahsopan = $(this).data('sikapramahsopan');
            let sikapberkordinasi = $(this).data('sikapberkordinasi');
            let sikaptolongmenolong = $(this).data('sikaptolongmenolong');
            let sikapseedo = $(this).data('sikapseedo');
            let catatan = $(this).data('cttn');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #efata").val(efata);
            $(" #modal-edit #sikapramahsopan").val(sikapramahsopan);
            $(" #modal-edit #sikapberkordinasi").val(sikapberkordinasi);
            $(" #modal-edit #sikaptolongmenolong").val(sikaptolongmenolong);
            $(" #modal-edit #sikapseedo").val(sikapseedo);
            $(" #modal-edit #catatan").val(catatan);

        });
    </script>


</body>

</html>