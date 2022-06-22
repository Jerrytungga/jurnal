<?php
include '../database.php';
session_start();
if (!isset($_SESSION['role'])) {
    echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu!');window.location='../index.php'</script>";
} else if ($_SESSION['role'] == "Siswa") {
    header("location:../siswa/index.php");
} else if ($_SESSION['role'] == "Mentor") {
    header("location:../mentor/index.php");
} else {
    $id = $_SESSION['id_Admin'];
    $get_data = mysqli_query($conn, "SELECT * FROM admin WHERE id='$id'");
    $data = mysqli_fetch_array($get_data);
}
$siswa = mysqli_query($conn, "SELECT * FROM siswa a JOIN tb_angkatan b ON a.angkatan= b.angkatan WHERE status='Aktif' ORDER BY a.date DESC ");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Report Weekly</title>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

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
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-mb-4 text-uppercase ">Laporan Mingguan</h1>
                    </div>
                    <div class="row mt-2 mb-4">
                        <div class="col">
                            <form action="cetak.php" target="blank" method="POST" class="form-inline">
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

                                <button type="submit" name="filter_tanggal" class="btn btn-dark ml-3">Cetak Laporan</button>
                                <!-- <button type="submit" name="reset" value="reset" class="btn btn-danger ml-3">Reset</button> -->
                            </form>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="example" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-dark text-light">
                                            <th width="10">No</th>
                                            <th width="70">Angkatan</th>
                                            <th width="700">Nama</th>
                                            <th width="50">Presensi</th>
                                            <th width="50">Jurnal Harian</th>
                                            <th width="50">Jurnal Mingguan</th>
                                            <th width="70">Jurnal Bulanan</th>
                                            <th width="50">Kebajikan</th>
                                            <th width="50">Pemerikasaan Lemari</th>
                                            <th width="50">Pemerikasaan Rak Sepatu dan Handuk</th>
                                            <th width="50">Pemerikasaan Ranjang</th>
                                            <th width="50">Total</th>
                                            <th width="50">Status</th>
                                            <th width="50">Keterangan</th>
                                            <th width="200">Tanggal</th>
                                            <th width="800">Sanksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1;
                                        ?>
                                        <?php
                                        date_default_timezone_set('Asia/Jakarta'); // Set timezone
                                        //variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"
                                        while ($murid = mysqli_fetch_array($siswa)) {

                                            $tgl = $murid['tgl'];
                                            $nis = $murid['nis'];
                                            $nama = $murid['name'];
                                            $Angkatan = $murid['angkatan'];
                                            $dari = $tgl; // tanggal mulai
                                            $sampai = date('Y-m-d'); // tanggal akhir



                                            // $s = 1;
                                            if (isset($_POST['filter_tanggal'])) {
                                                $dari = $_POST['tanggal_mulai'];
                                                $sampai = $_POST['tanggal_akhir'];
                                            }

                                            while (strtotime($dari) <= strtotime($sampai)) {

                                                // echo $s . "-" . $i . "=";
                                                $alkitab = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point`) as jumlah FROM tb_bible_reading WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                // doa
                                                $doa = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point`) as jumlah FROM tb_prayer_note WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                // penyegaran pagi
                                                $pp = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`) as jumlah FROM tb_revival_note WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");


                                                // personal goal
                                                $goalsetting = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point3`) as jumlah FROM tb_personal_goal WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                // exhibition
                                                $exhibition = mysqli_query($conn, "SELECT SUM(`point`) as jumlah FROM tb_exhibition WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                // home metting
                                                $homemetting = mysqli_query($conn, "SELECT SUM(`point`) as jumlah FROM tb_home_meeting WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                // Blessings
                                                $Blessings = mysqli_query($conn, "SELECT SUM(`point1`)+SUM(`point2`)+SUM(`point3`)+SUM(`point4`)+SUM(`point5`)+SUM(`point6`)+SUM(`point7`)+SUM(`point8`) as jumlah FROM tb_blessings WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                // virtue dan character
                                                $vc = mysqli_query($conn, "SELECT SUM(`perhatian_berbagi`)+SUM(`salam_sapa`)+SUM(`bersyukur_berterimakasih`)+SUM(`hormat_taat`) as jumlah FROM tb_vrtues_caharacter WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                // virtue
                                                $virtue = mysqli_query($conn, "SELECT SUM(`sikapramahsopan`)+SUM(`sikapberkordinasi`)+SUM(`sikaptolongmenolong`)+SUM(`sikapseedo`) as jumlah FROM tb_virtues WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                // character
                                                $character = mysqli_query($conn, "SELECT SUM(`benar`)+SUM(`tepat`)+SUM(`ketat`) as jumlah FROM tb_character WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                // living lemari
                                                $buku = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_buku WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                $pakaianlipat = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_pakaianlipat WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                $pakaiangantung = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bentuk`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as jumlah FROM tb_living_pakaiangantung WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                $celana = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_celanalipat WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                $logistik = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`tinggi/rendah`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`barang_asing`)+SUM(`raib`) as jumlah FROM tb_living_logistik WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");


                                                $pakaiandalam = mysqli_query($conn, "SELECT SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_pakaiandalam WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                // living rak sepatu dan handuk
                                                $raksepatu = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_sepatu WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                $sepatusidang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_sidang WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                $sepatu_or = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sepatu_or WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                $sandal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_sendal WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                $rakhanduk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`)+SUM(`barang_asing`) as jumlah FROM tb_living_rak_handuk WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                $handuk = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`rapi`)+SUM(`bersih`)+SUM(`raib`) as jumlah FROM tb_living_handuk WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                // living ranjang
                                                $ranjang = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_ranjang WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                $bantal = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_bantal WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                $seprei = mysqli_query($conn, "SELECT SUM(`rapi`)+SUM(`raib`)+SUM(`bersih`)+SUM(`benda_asing`) as jumlah FROM tb_living_seprei WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                                $selimut = mysqli_query($conn, "SELECT SUM(`jarak`)+SUM(`posisi`)+SUM(`bersih`)+SUM(`bentuk`)+SUM(`benda_asing`) as jumlah FROM tb_living_selimut WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");


                                                $presensia = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE nis='$nis' AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");


                                                $dari = date("Y-m-d", strtotime("+7 day", strtotime($dari))); //looping tambah 7 date

                                        ?>
                                                <?php foreach ($presensia as $row) :
                                                    $hari = $dari;
                                                    $presensi = mysqli_fetch_array($presensia);
                                                    $prayernote = mysqli_fetch_array($doa);
                                                    $biblereading = mysqli_fetch_array($alkitab);
                                                    $revivalnote = mysqli_fetch_array($pp);
                                                    $personalgoal = mysqli_fetch_array($goalsetting);
                                                    $pameran = mysqli_fetch_array($exhibition);
                                                    // living character dan virtues
                                                    $persekutuan = mysqli_fetch_array($homemetting);
                                                    $blessings = mysqli_fetch_array($Blessings);
                                                    $sikap = mysqli_fetch_array($vc);
                                                    $virtues = mysqli_fetch_array($virtue);
                                                    $karakter = mysqli_fetch_array($character);
                                                    // living lemari
                                                    $living_buku = mysqli_fetch_array($buku);
                                                    $living_pakaianlipat = mysqli_fetch_array($pakaianlipat);
                                                    $living_pakaiangantung = mysqli_fetch_array($pakaiangantung);
                                                    $living_celana = mysqli_fetch_array($celana);
                                                    $living_logistik = mysqli_fetch_array($logistik);

                                                    $living_pakaiandalam = mysqli_fetch_array($pakaiandalam);
                                                    // living rak sepatu dan handuk
                                                    $living_raksepatu = mysqli_fetch_array($raksepatu);
                                                    $living_sepatusidang = mysqli_fetch_array($sepatusidang);
                                                    $living_sepatuor = mysqli_fetch_array($sepatu_or);
                                                    $living_sandal = mysqli_fetch_array($sandal);
                                                    $living_rakhanduk = mysqli_fetch_array($rakhanduk);
                                                    $living_handuk = mysqli_fetch_array($handuk);
                                                    // living ranjang
                                                    $living_ranjang = mysqli_fetch_array($ranjang);
                                                    $living_bantal = mysqli_fetch_array($bantal);
                                                    $living_seprei = mysqli_fetch_array($seprei);
                                                    $living_selimut = mysqli_fetch_array($selimut);


                                                    // $presensiWeekly = mysqli_fetch_array($presensi);


                                                    $total_living_ranjang = $living_ranjang['jumlah'] + $living_bantal['jumlah'] + $living_seprei['jumlah'] + $living_selimut['jumlah'];
                                                    $totalpresensi = $row['presensi'];
                                                    $total_livingraksepatudanhanduk = $living_raksepatu['jumlah'] + $living_sepatusidang['jumlah'] + $living_sepatuor['jumlah'] + $living_sandal['jumlah'] + $living_rakhanduk['jumlah'] + $living_handuk['jumlah'];
                                                    $total_livinglemari = $living_buku['jumlah'] + $living_pakaianlipat['jumlah'] + $living_pakaiangantung['jumlah']  + $living_celana['jumlah'] + $living_logistik['jumlah'] + $living_pakaiandalam['jumlah'];
                                                    $totalpeniliansikap = $sikap['jumlah'] + $virtues['jumlah'] + $karakter['jumlah'];
                                                    $total_2 = $blessings['jumlah'];
                                                    $total_1 = $personalgoal['jumlah'] + $pameran['jumlah'] + $persekutuan['jumlah'];
                                                    $total = $biblereading['jumlah'] + $prayernote['jumlah'] + $revivalnote['jumlah'];

                                                    $totalsemua = $total + $total_1 + $total_2 + $totalpeniliansikap + $total_livinglemari + $total_livingraksepatudanhanduk + $totalpresensi + $total_living_ranjang
                                                ?>
                                                    <tr>
                                                        <td><?= $i; ?></td>
                                                        <td>
                                                            <?= $Angkatan; ?>
                                                        </td>
                                                        <td>
                                                            <?= $nama; ?>
                                                        </td>
                                                        <td><?= $row['presensi']; ?></td>
                                                        <td><?= $total; ?></td>
                                                        <td><?= $total_1; ?></td>
                                                        <td><?= $total_2; ?></td>
                                                        <td><?= $totalpeniliansikap; ?></td>
                                                        <td><?= $total_livinglemari; ?></td>
                                                        <td><?= $total_livingraksepatudanhanduk; ?></td>

                                                        <td><?= $total_living_ranjang; ?></td>
                                                        <td><?= $totalsemua; ?></td>
                                                        <td>

                                                            <?= $row['status']; ?>

                                                        </td>
                                                        <td>Minggu <?= $row['week']; ?></td>
                                                        <td><?= $row['date']; ?></td>
                                                        <td>
                                                            <a class="font-weight-bold text-danger font-italic"><?= $row['grace']; ?> <?= $row['punisment']; ?> </a>
                                                        </td>

                                                    </tr>

                                                    <?php $i++; ?>
                                        <?php endforeach;
                                                // $s++;
                                            }
                                            // $u++;
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <th width="10"></th>
                                        <th width="700"></th>
                                        <th width="50"></th>
                                        <th width="50"></th>
                                        <th width="50"></th>
                                        <th width="70"></th>
                                        <th width="50"></th>
                                        <th width="50"></th>
                                        <th width="50"></th>
                                        <th width="50"></th>
                                        <th width="50"></th>
                                        <th width="50"></th>
                                        <th width="50"></th>
                                        <th width="200"></th>
                                        <th width="800"></th>

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
            <footer class="sticky-footer bg-white">
                <?php
                include './template/footer.php';
                ?>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>





    <?php
    include 'models/m_logout.php';
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
            $('#example').DataTable({
                scrollY: 800,
                scrollX: true,
                scrollCollapse: true,
                paging: true,
                lengthMenu: [
                    [-1],
                    ["All"]
                ],
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                }
            });
        });
    </script>


</body>

</html>