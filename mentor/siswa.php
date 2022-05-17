<?php
include '../database.php';
session_start();
include 'template/session.php';
// if (isset($_POST['input'])) {
//     $nis = htmlspecialchars($_POST['nis']);
//     $efata = htmlspecialchars($_POST['efata']);
//     $presensi = htmlspecialchars($_POST['presensi']);
//     $nama = htmlspecialchars($_POST['name']);
//     $week = htmlspecialchars($_POST['Minggu']);
//     $smt = htmlspecialchars($_POST['smt']);
//     $input = mysqli_query($conn, "INSERT INTO `tb_presensi`(`nis`, `name`, `presensi`, `efata`,`week`,`semester`) VALUES ('$nis','$nama','$presensi','$efata','$week','$smt')");
//     if ($input) {
//         $notifinput = $_SESSION['sukses'] = 'Data entered successfully!';
//     } else {
//         $notifgagalinput = $_SESSION['gagal'] = 'Data not entered successfully!';
//     }
// }

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
                                            <th>Nis</th>
                                            <th>Nama</th>
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
                                        <?php foreach ($siswa as $row) :
                                            $nis2 = $row['nis'];
                                            $AKT = $row['angkatan'];
                                            $Cek_max_week = mysqli_fetch_array(mysqli_query($conn, "SELECT batch, MAX(week) as week FROM `presensi` where nis='$nis2' and batch='$AKT'"));
                                            $week_ = $Cek_max_week['week'];
                                            $AKTS = $Cek_max_week['batch'];
                                            $tampil = mysqli_query($conn, "SELECT * FROM presensi where nis='$nis2' and week='$week_ ' and ACC_Mentor='approved' and  mentor='$id' and batch='$AKTS'  order by presensi_time DESC");

                                            $array_presensi = mysqli_fetch_array($tampil);
                                            $week = $array_presensi['week'];
                                            $nis = $array_presensi['nis'];
                                            $AKT_cek = $array_presensi['batch'];
                                            $mark_V = $array_presensi['mark'] = 'V';
                                            $mark_O = $array_presensi['mark'] = 'O';
                                            $mark_X = $array_presensi['mark'] = 'X';
                                            $mark_I = $array_presensi['mark'] = 'I';
                                            $mark_S = $array_presensi['mark'] = 'S';

                                            $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where  semester='$data_semester' and nis='$nis' and week='$week' and ACC_Mentor='approved' and batch='$AKTS' and mark='$mark_V' ");
                                            $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                                            $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where semester='$data_semester' and nis='$nis' and week='$week' and ACC_Mentor='approved' and mark='$mark_O' and batch='$AKTS' ");
                                            $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                                            $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where semester='$data_semester' and nis='$nis' and week='$week' and ACC_Mentor='approved' and mark='$mark_X' and batch='$AKTS'");
                                            $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                                            $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where semester='$data_semester' and  nis='$nis' and week='$week' and ACC_Mentor='approved' and mark='$mark_I'and batch='$AKTS'");
                                            $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                                            $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where semester='$data_semester' and  nis='$nis' and week='$week' and ACC_Mentor='approved' and mark='$mark_S' and batch='$AKTS'");
                                            $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                                            $total = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];
                                            //isi presensi berdasarkan waktu yang di tentukan
                                            $date = date("w");
                                            date_default_timezone_set('Asia/Jakarta');
                                            $time = date('H');
                                            if ($date == 0 && $time == 21) {
                                                $nis = $row["nis"];
                                                $nama = $row["name"];
                                                $week;
                                                $total;
                                                $id;
                                                mysqli_query($conn, "INSERT INTO `tb_presensi`(`nis`, `name`, `presensi`, `efata`,`week`,`semester`) VALUES ('$nis','$nama','$total','$id','$week','$data_semester')");
                                            }


                                        ?>
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
                                                        Harian
                                                    </a>
                                                    <a href="personalgoal.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-success btn-sm  form-group">
                                                        Mingguan
                                                    </a>
                                                    <a href="blessings.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-warning btn-sm  form-group">
                                                        Bulanan
                                                    </a><br>
                                                    <a href="reportweekly.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-warning btn-sm  form-group">
                                                        Laporan mingguan
                                                    </a>
                                                    <a href="catatan.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-success btn-sm  form-group">
                                                        Catatan Harian
                                                    </a>
                                                    <a href="aspek_pembelajaran_pengetahuan.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-dark btn-sm  form-group">
                                                        Aspek Pembelajaran Pengetahuan
                                                    </a>
                                                    <a href="kelas_keterampilan.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-dark btn-sm  form-group">
                                                        Kelas Keterampilan
                                                    </a>


                                                    <!-- <a href="report_final.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-danger btn-sm  form-group">
                                                        isi Rapor
                                                    </a> -->

                                                    <!-- <a href="" id="pre" data-name="<?= $row["name"]; ?>" data-presensi="<?= $total; ?>" data-minggu="<?= $week; ?>" data-nis="<?= $row["nis"]; ?>" type="button" data-toggle="modal" data-target="#report" class="btn btn-dark btn-sm  form-group">
                                                        Presensi
                                                    </a> -->

                                                </td>

                                                <td>

                                                    <a href="virtues & Character.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-warning btn-sm  form-group">
                                                        Kebajikan dan Karakter
                                                    </a>
                                                    <a href="livinglemari.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-success btn-sm  form-group">
                                                        Pemeriksaan lemari
                                                    </a>
                                                    <a href="livingraksepatudanhanduk.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-info btn-sm  form-group">

                                                        Pemeriksaan rak sepatu dan handuk
                                                    </a>

                                                    <a href="living_ranjang.php?nis=<?= $row["nis"]; ?>" type="button" class="btn btn-danger btn-sm  form-group">
                                                        Pemeriksaan ranjang
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

            var presensi = $(this).data('presensi');
            var minggu = $(this).data('minggu');
            var nis = $(this).data('nis');
            var name = $(this).data('name');
            $(" #modal-presensi #presensi").val(presensi);
            $(" #modal-presensi #minggu").val(minggu);
            $(" #modal-presensi #nis").val(nis);
            $(" #modal-presensi #name").val(name);

        });
    </script>



</body>

</html>