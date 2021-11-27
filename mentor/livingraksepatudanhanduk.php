<?php
include '../database.php';
session_start();
include 'template/session.php';

if (isset($_POST['btn_input'])) {
    $sumber = $_FILES['image']['tmp_name'];
    $target = '../img/penilaian/';
    $nama_gambar = $_FILES['image']['name'];
    $nis = htmlspecialchars($_POST['nis']);
    $jrk = htmlspecialchars($_POST['jarak']);
    $pss = htmlspecialchars($_POST['posisi']);
    $rp = htmlspecialchars($_POST['rapi']);
    $br = htmlspecialchars($_POST['bersih']);
    $rb = htmlspecialchars($_POST['raib']);
    $efata = htmlspecialchars($_POST['efata']);
    $notes = htmlspecialchars($_POST['catatan']);
    if ($nama_gambar != '') {
        if (move_uploaded_file($sumber, $target . $nama_gambar)) {
            $input = mysqli_query($conn, "INSERT INTO `tb_living_rak_sepatu`(`nis`, `jarak`, `posisi`, `rapi`, `bersih`, `raib`, `image`, `efata`, `catatan`) VALUES ('$nis','$jrk','$pss','$rp','$br','$rb','$nama_gambar','$efata','$notes')");
            if ($input) {
                echo '<script>alert("Data Berhasil di Masukan!")</script>';
            } else {
                echo '<script>alert("Data Gagal di Masukan!")</script>';
            }
        }
    } else {
        $input = mysqli_query($conn, "INSERT INTO `tb_living_rak_sepatu`(`nis`, `jarak`, `posisi`, `rapi`, `bersih`, `raib`, `efata`, `catatan`) VALUES ('$nis','$jrk','$pss','$rp','$br','$rb','$efata','$notes')");
        if ($input) {
            echo '<script>alert("Data Berhasil di Masukan!")</script>';
        } else {
            echo '<script>alert("Data Gagal di Masukan!")</script>';
        }
    }
}

if (isset($_POST['btn_update'])) {
    $sumber = $_FILES['foto']['tmp_name'];
    $target = '../img/penilaian/';
    $nama_gambar = $_FILES['foto']['name'];
    $nis = htmlspecialchars($_POST['nis']);
    $jrk = htmlspecialchars($_POST['jarak']);
    $pss = htmlspecialchars($_POST['posisi']);
    $rp = htmlspecialchars($_POST['rapi']);
    $br = htmlspecialchars($_POST['bersih']);
    $rb = htmlspecialchars($_POST['raib']);
    $efata = htmlspecialchars($_POST['efata']);
    $notes = htmlspecialchars($_POST['catatan']);
    $date = htmlspecialchars($_POST['date']);
    if ($nama_gambar != '') {
        if (move_uploaded_file($sumber, $target . $nama_gambar)) {
            $input = mysqli_query($conn, "UPDATE `tb_living_rak_sepatu` SET `nis`='$nis',`jarak`='$jrk',`posisi`='$pss',`rapi`='$rp',`bersih`='$br',`raib`='$rb',`image`='$nama_gambar',`date`='$date',`efata`='$efata',`catatan`='$notes' WHERE `tb_living_rak_sepatu`.`nis`='$nis' AND `tb_living_rak_sepatu`.`date`='$date'");
            if ($input) {
                echo '<script>alert("Data Berhasil di Edit!")</script>';
            } else {
                echo '<script>alert("Data Gagal di Edit!")</script>';
            }
        }
    } else {
        $input =  mysqli_query($conn, "UPDATE `tb_living_rak_sepatu` SET `nis`='$nis',`jarak`='$jrk',`posisi`='$pss',`rapi`='$rp',`bersih`='$br',`raib`='$rb',`date`='$date',`efata`='$efata',`catatan`='$notes' WHERE `tb_living_rak_sepatu`.`nis`='$nis' AND `tb_living_rak_sepatu`.`date`='$date'");
        if ($input) {
            echo '<script>alert("Data Berhasil di Edit!")</script>';
        } else {
            echo '<script>alert("Data Gagal di Edit!")</script>';
        }
    }
}


$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
$penilaian = mysqli_query($conn, "SELECT * FROM tb_living_rak_sepatu WHERE nis='$nis' ORDER BY date DESC");
$nilai = mysqli_fetch_array($penilaian);
?>
<!DOCTYPE html>
<html lang="en">

<?php
include 'template/head.php';
?>

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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">

                        <div class="group">
                            <h1 class="h3 mb-mb-4  embed-responsive text-gray-800">LIVING RAK SEPATU & HANDUK <?= $siswa2['name']; ?></h1>
                            <a href="livingraksepatudanhanduk.php?nis=<?= $nis; ?>" type=" button" class="btn btn-outline-primary active mt-2">Rak Sepatu</a>
                            <a href="livingsepatusidang.php?nis=<?= $nis; ?>" type=" button" class="btn btn-outline-success mt-2">Sepatu Sidang</a>
                            <a href="livingsepatuor.php?nis=<?= $nis; ?>" type=" button" class="btn btn-outline-warning mt-2">Sepatu Or</a>
                            <a href="livingsandal.php?nis=<?= $nis; ?>" type=" button" class="btn btn-outline-danger mt-2">Sandal</a>
                            <a href="livingrakhanduk.php?nis=<?= $nis; ?>" type=" button" class="btn btn-outline-primary mt-2">Rak Handuk</a>
                            <a href="livinghanduk.php?nis=<?= $nis; ?>" type=" button" class="btn btn-outline-success mt-2">Handuk</a>

                        </div>
                    </div>
                    <!-- DataTales Rak sepatu -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#livingraksepatu">Input</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th width="30">Jarak</th>
                                            <th width="40">Posisi</th>
                                            <th width="40">Rapi</th>
                                            <th width="40">Bersih</th>
                                            <th width="40">Raib</th>
                                            <th width="40">Image</th>
                                            <th width="100">Date</th>
                                            <th width="250">Mentor Notes</th>
                                            <th width="100">Option</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1;
                                        $total = 0;
                                        ?>
                                        <?php foreach ($penilaian as $row) : ?>
                                            <tr>
                                                <td> <?= $i; ?></td>
                                                <td><?= $row['jarak']; ?></td>
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
                                                    <a id="editpenilaian" type="button" data-toggle="modal" data-target="#edit" data-posisi="<?= $row['posisi']; ?>" data-jarak="<?= $row['jarak']; ?>" data-rapi="<?= $row['rapi']; ?>" data-nis="<?= $row['nis']; ?>" data-efata="<?= $row['efata']; ?>" data-cttn="<?= $row['catatan']; ?>" data-bersih="<?= $row['bersih']; ?>" data-raib="<?= $row['raib']; ?>" data-foto="<?= $row['image']; ?>" data-date="<?= $row['date']; ?>">
                                                        <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $total = $total + $row['jarak'] + $row['posisi'] + $row['rapi'] + $row['bersih'] + $row['raib']; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <th class="bg-warning text-right" colspan="9"> Total Point : </th>
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
    include 'modal/modal_living_rak_sepatu.php';
    include 'modal/modal_foto.php';
    include 'template/script_penilaian.php';
    ?>



</body>

</html>