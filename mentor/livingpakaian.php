<?php
include '../database.php';
// proses input penilaian Pakaian Lipat
if (isset($_POST['btn_input'])) {
    $sumber = $_FILES['image']['tmp_name'];
    $target = '../img/penilaian/';
    $nama_gambar = $_FILES['image']['name'];
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $pss = htmlspecialchars($_POST['posisi']);
    $rp = htmlspecialchars($_POST['rapi']);
    $br = htmlspecialchars($_POST['bersih']);
    $rb = htmlspecialchars($_POST['raib']);
    $notes = htmlspecialchars($_POST['catatan']);
    if ($nama_gambar != '') {
        if (move_uploaded_file($sumber, $target . $nama_gambar)) {
            mysqli_query($conn, "INSERT INTO `tb_living_pakaianlipat`(`nis`, `posisi`, `rapi`, `bersih`, `raib`, `image`, `catatan`, `efata`) VALUES ('$nis','$pss','$rp','$br','$rb','$nama_gambar','$notes','$efata')");
        }
    } else {
        mysqli_query($conn, "INSERT INTO `tb_living_pakaianlipat`(`nis`, `posisi`, `rapi`, `bersih`, `raib`, `catatan`, `efata`) VALUES ('$nis','$pss','$rp','$br','$rb','$notes','$efata')");
    }
}

// proses update penilaian pakaian lipat
if (isset($_POST['btn_update'])) {
    $sumber = $_FILES['foto']['tmp_name'];
    $target = '../img/penilaian/';
    $nama_gambar = $_FILES['foto']['name'];
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $pss = htmlspecialchars($_POST['posisi']);
    $rp = htmlspecialchars($_POST['rapi']);
    $br = htmlspecialchars($_POST['bersih']);
    $rb = htmlspecialchars($_POST['raib']);
    $date = htmlspecialchars($_POST['date']);
    $notes = htmlspecialchars($_POST['catatan']);
    if ($nama_gambar != '') {
        if (move_uploaded_file($sumber, $target . $nama_gambar)) {
            mysqli_query($conn, "UPDATE `tb_living_pakaianlipat` SET `nis`='$nis',`posisi`='$pss',`rapi`='$rp',`bersih`='$br',`raib`='$rb',`image`='$nama_gambar',`catatan`='$notes',`date`='$date' WHERE `tb_living_pakaianlipat`.`nis`='$nis' AND `tb_living_pakaianlipat`.`date`='$date'");
        }
    } else {
        mysqli_query($conn, "UPDATE `tb_living_pakaianlipat` SET `nis`='$nis',`posisi`='$pss',`rapi`='$rp',`bersih`='$br',`raib`='$rb',`catatan`='$notes',`date`='$date' WHERE `tb_living_pakaianlipat`.`nis`='$nis' AND `tb_living_pakaianlipat`.`date`='$date'");
    }
}
session_start();
include 'template/session.php';
//menampilkan data siswa
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
if (isset($_POST['filter_tanggal'])) {
    $mulai = $_POST['tanggal_mulai'];
    $selesai = $_POST['tanggal_akhir'];
    $nis = $_GET['nis'];

    if ($mulai != null || $selesai != null) {

        $penilaian = mysqli_query($conn, "SELECT * FROM tb_living_pakaianlipat WHERE nis='$nis' AND date BETWEEN '$mulai' AND '$selesai' ORDER BY date DESC;");
    } else {

        $nis = $_GET['nis'];
        $penilaian = mysqli_query($conn, "SELECT * FROM tb_living_pakaianlipat WHERE nis='$nis' ORDER BY date DESC");
        $nilai = mysqli_fetch_array($penilaian);
    }
} else {
    $nis = $_GET['nis'];
    $penilaian = mysqli_query($conn, "SELECT * FROM tb_living_pakaianlipat WHERE nis='$nis' ORDER BY date DESC");
    $nilai = mysqli_fetch_array($penilaian);
}
if (isset($_POST['reset'])) {
    $nis = $_GET['nis'];
    $penilaian = mysqli_query($conn, "SELECT * FROM tb_living_pakaianlipat WHERE nis='$nis' ORDER BY date DESC");
    $nilai = mysqli_fetch_array($penilaian);
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
include 'template/head.php';
?>

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
                        <?php
                        include 'template/menu_livinglemari.php';
                        ?>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-success" data-toggle="modal" data-target="#pakaianlipat">Input</a>
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
                                            <th>Posisi</th>
                                            <th>Rapi</th>
                                            <th>Bersih</th>
                                            <th>Raib</th>
                                            <th>Foto</th>
                                            <th>Date</th>
                                            <th>Mentor Notes</th>
                                            <th>Option</th>


                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1;
                                        $total = 0;
                                        ?>
                                        <?php foreach ($penilaian as $row) : ?>
                                            <tr>
                                                <td> <?= $i; ?></td>
                                                <td><?= $row['posisi']; ?></td>
                                                <td><?= $row['rapi']; ?></td>
                                                <td><?= $row['bersih']; ?></td>
                                                <td><?= $row['raib']; ?></td>
                                                <td>
                                                    <?php
                                                    $gambar = $row["image"];
                                                    if ($gambar) { ?>

                                                        <button type="button" class="btn  btn-lg" data-toggle="modal" data-target="#myModal">
                                                            <img src="../img/penilaian/<?= $row["image"]; ?>" class="img-responsive" width="90" height="90">
                                                        </button>

                                                    <?php }

                                                    ?>
                                                </td>
                                                <td><?= $row['date']; ?></td>
                                                <td><a class="font-weight-bold text-primary font-italic"><?= $row['catatan']; ?></a></td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a id="editpenilaian" type="button" data-toggle="modal" data-target="#edit" data-posisi="<?= $row['posisi']; ?>" data-rapi="<?= $row['rapi']; ?>" data-nis="<?= $row['nis']; ?>" data-efata="<?= $row['efata']; ?>" data-cttn="<?= $row['catatan']; ?>" data-bersih="<?= $row['bersih']; ?>" data-raib="<?= $row['raib']; ?>" data-foto="<?= $row['image']; ?>" data-date="<?= $row['date']; ?>">
                                                        <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button>
                                                    </a>
                                                </td>

                                            </tr>
                                            <?php
                                            $total = $total + $row['posisi'] + $row['rapi'] + $row['bersih'] + $row['raib']; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <th class="bg-warning text-right" colspan="8"> Total Point : </th>
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
    include 'modal/modal_living_pakaianlipat.php';
    include 'modal/modal_foto.php';
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
                scrollY: 800,
                scrollX: true,
                scrollCollapse: true,
                paging: true
            });
        });

        $(document).on("click", "#editpenilaian", function() {

            let nis = $(this).data('nis');
            let efata = $(this).data('efata');
            let posisi = $(this).data('posisi');
            let rapi = $(this).data('rapi');
            let bersih = $(this).data('bersih');
            let raib = $(this).data('raib');
            let foto = $(this).data('foto');
            let date = $(this).data('date');
            let catatan = $(this).data('cttn');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #efata").val(efata);
            $(" #modal-edit #posisi").val(posisi);
            $(" #modal-edit #rapi").val(rapi);
            $(" #modal-edit #bersih").val(bersih);
            $(" #modal-edit #date").val(date);
            $(" #modal-edit #raib").val(raib);
            $(" #modal-edit #catatan").val(catatan);
            $(" #modal-edit #foto").attr("src", "../img/penilaian/" + foto);

        });
    </script>
</body>

</html>