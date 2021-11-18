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
    $tr = htmlspecialchars($_POST['tinggi/rendah']);
    $rp = htmlspecialchars($_POST['rapi']);
    $br = htmlspecialchars($_POST['bersih']);
    $rb = htmlspecialchars($_POST['raib']);
    $notes = htmlspecialchars($_POST['catatan']);
    if ($nama_gambar != '') {
        if (move_uploaded_file($sumber, $target . $nama_gambar)) {
            mysqli_query($conn, "INSERT INTO `tb_living_pakaiandalam`(`nis`, `posisi`, `tinggi/rendah`, `rapi`, `bersih`, `raib`, `image`, `catatan`, `efata`) VALUES ('$nis','$pss','$tr','$rp','$br','$rb','$nama_gambar','$notes','$efata')");
        }
    } else {
        mysqli_query($conn, "INSERT INTO `tb_living_pakaiandalam`(`nis`, `posisi`, `tinggi/rendah`, `rapi`, `bersih`, `raib`, `catatan`, `efata`) VALUES ('$nis','$pss','$tr','$rp','$br','$rb','$notes','$efata')");
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
    $tr = htmlspecialchars($_POST['tinggirendah']);
    $rp = htmlspecialchars($_POST['rapi']);
    $br = htmlspecialchars($_POST['bersih']);
    $rb = htmlspecialchars($_POST['raib']);
    $date = htmlspecialchars($_POST['date']);
    $notes = htmlspecialchars($_POST['catatan']);
    if ($nama_gambar != '') {
        if (move_uploaded_file($sumber, $target . $nama_gambar)) {
            mysqli_query($conn, "UPDATE `tb_living_pakaiandalam` SET `nis`='$nis',`posisi`='$pss',`tinggi/rendah`='$tr',`rapi`='$rp',`bersih`='$br',`raib`='$rb',`image`='$nama_gambar',`catatan`='$notes',`date`='$date' WHERE `tb_living_pakaiandalam`.`nis`='$nis' AND `tb_living_pakaiandalam`.`date`='$date'");
        }
    } else {
        mysqli_query($conn, "UPDATE `tb_living_pakaiandalam` SET `nis`='$nis',`posisi`='$pss',`tinggi/rendah`='$tr',`rapi`='$rp',`bersih`='$br',`raib`='$rb',`catatan`='$notes',`date`='$date' WHERE `tb_living_pakaiandalam`.`nis`='$nis' AND `tb_living_pakaiandalam`.`date`='$date'");
    }
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
//menampilkan data siswa
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
if (isset($_POST['filter_tanggal'])) {
    $mulai = $_POST['tanggal_mulai'];
    $selesai = $_POST['tanggal_akhir'];
    $nis = $_GET['nis'];

    if ($mulai != null || $selesai != null) {

        $penilaian = mysqli_query($conn, "SELECT * FROM tb_living_pakaiandalam WHERE nis='$nis' AND date BETWEEN '$mulai' AND '$selesai' ORDER BY date DESC;");
    } else {

        $nis = $_GET['nis'];
        $penilaian = mysqli_query($conn, "SELECT * FROM tb_living_pakaiandalam WHERE nis='$nis' ORDER BY date DESC");
        $nilai = mysqli_fetch_array($penilaian);
    }
} else {
    $nis = $_GET['nis'];
    $penilaian = mysqli_query($conn, "SELECT * FROM tb_living_pakaiandalam WHERE nis='$nis' ORDER BY date DESC");
    $nilai = mysqli_fetch_array($penilaian);
}
if (isset($_POST['reset'])) {
    $nis = $_GET['nis'];
    $penilaian = mysqli_query($conn, "SELECT * FROM tb_living_pakaiandalam WHERE nis='$nis' ORDER BY date DESC");
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
                            <h1 class="h3 mb-mb-4  embed-responsive text-gray-800">LIVING LEMARI <?= $siswa2['name']; ?></h1>
                            <a href="livinglemari.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary mt-2">Buku</a>
                            <a href="livingpakaian.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-success mt-2">Pakaian Lipat</a>
                            <a href="livingpakaiangantung.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-warning mt-2">Pakaian Gantung</a>
                            <a href="livingcelana.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-danger mt-2">Celana Lipat & Dll</a>
                            <a href="livinglogistik.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary mt-2">Logistik & Make Up</a>
                            <a href="livingdalaman.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-success mt-2">Pakaian Dalam</a>
                            <a href="livinglocker.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-warning active mt-2">Locker</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#livinglocker">Input</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th>Rapi</th>
                                            <th>Bersih</th>
                                            <th>Lain-Lain</th>
                                            <th>Catatan Mentor</th>
                                            <th>foto</th>
                                            <th>Date</th>
                                            <th>Option</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>


                                            <td>

                                                <button type="button" class="btn btn-success form-group">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger form-group">
                                                    Delete
                                                </button>
                                            </td>

                                        </tr>

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



    <!-- Modal living Locker -->
    <div class="modal fade" id="livinglocker" tabindex="-1" aria-labelledby="livinglocker" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="livinglocker">Locker</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>


                <!-- bungkus untuk form inputan -->
                <form action="post" method="POST">
                    <div class="modal-body">
                        <h5 class="text-reset">Rapi</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <hr>
                        <h5 class="text-reset">Bersih</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <hr>
                        <h5 class="text-reset">Lain-lain</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="input_nis" class="form-label">Catatan Mentor :</label>
                            <input type="text" class="form-control" required id="catatanMentor">
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlFile1">Foto</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning ">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>





    <?php
    include 'modal/modal_logout.php';
    //include 'modal/modal_living_pakaiandalam.php';
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
            let posisi = $(this).data('posisi');
            let tinggirendah = $(this).data('tinggirendah');
            let rapi = $(this).data('rapi');
            let bersih = $(this).data('bersih');
            let raib = $(this).data('raib');
            let foto = $(this).data('foto');
            let date = $(this).data('date');
            let catatan = $(this).data('cttn');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #efata").val(efata);
            $(" #modal-edit #posisi").val(posisi);
            $(" #modal-edit #tinggirendah").val(tinggirendah);
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