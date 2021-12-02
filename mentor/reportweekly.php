<?php
include '../database.php';
if (isset($_POST['edit'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $presensi = htmlspecialchars($_POST['absen']);
    $status = htmlspecialchars($_POST['status']);
    $grace = htmlspecialchars($_POST['graces']);
    $punisment = htmlspecialchars($_POST['ps']);
    $date = htmlspecialchars($_POST['date']);
    $edit = mysqli_query($conn, "UPDATE `tb_presensi` SET `nis`='$nis',`presensi`='$presensi',`status`='$status',`date`='$date',`grace`='$grace',`punisment`='$punisment' WHERE `tb_presensi`.`nis`='$nis' AND `tb_presensi`.`date`='$date'");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Saved!';
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Sorry, the data was not edited successfully!';
    }
}

$nis = $_GET['nis'];
session_start();
include 'template/session.php';
//menampilkan data siswa dan jurnal
$siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC");
$murid = mysqli_fetch_array($siswa);
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
                        <h1 class="h3 mb-mb-4 text-gray-800">Jurnal Report <?= $murid['name']; ?></h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th width="200">Name</th>
                                            <th>Presensi</th>
                                            <th>Jurnal Daily</th>
                                            <th>Jurnal Weekly</th>
                                            <th>Jurnal Monthly</th>
                                            <th>Virtue</th>
                                            <th>Living Lemari</th>
                                            <th>Living Rak Sepatu dan Handuk</th>
                                            <th>Living Ranjang</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th width="200">Date</th>
                                            <th width="400">Sanksi</th>
                                            <th width="200">Option</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php
                                        date_default_timezone_set('Asia/Jakarta'); // Set timezone
                                        //variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"
                                        $dari = "2021-11-15"; // tanggal mulai
                                        $sampai = date('Y-m-d'); // tanggal akhir

                                        while (strtotime($dari) <= strtotime($sampai)) {
                                            // echo "$dari<br/>";

                                            // pembacaan alkitab
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

                                            $presensi = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE nis='$nis'  AND date BETWEEN '$dari' AND '" . date("Y-m-d", strtotime("+6 day", strtotime($dari))) . "' ORDER BY date DESC");

                                            $dari = date("Y-m-d", strtotime("+7 day", strtotime($dari))); //looping tambah 7 date

                                        ?>
                                            <?php foreach ($presensi as $row) :
                                                $hari = $dari;
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

                                                $presensiWeekly = mysqli_fetch_array($presensi);



                                                $totalpresensi = $row['presensi'];
                                                $total_livingraksepatudanhanduk = $living_raksepatu['jumlah'] + $living_sepatusidang['jumlah'] + $living_sepatuor['jumlah'] + $living_sandal['jumlah'] + $living_rakhanduk['jumlah'] + $living_handuk['jumlah'];
                                                $total_livinglemari = $living_buku['jumlah'] + $living_pakaianlipat['jumlah'] + $living_pakaiangantung['jumlah']  + $living_celana['jumlah'] + $living_logistik['jumlah'] + $living_pakaiandalam['jumlah'];
                                                $totalpeniliansikap = $sikap['jumlah'] + $virtues['jumlah'] + $karakter['jumlah'];
                                                $total_2 = $blessings['jumlah'];
                                                $total_1 = $personalgoal['jumlah'] + $pameran['jumlah'] + $persekutuan['jumlah'];
                                                $total = $biblereading['jumlah'] + $prayernote['jumlah'] + $revivalnote['jumlah'];

                                                $totalsemua = $total + $total_1 + $total_2 + $totalpeniliansikap + $total_livinglemari + $total_livingraksepatudanhanduk + $totalpresensi

                                            ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td>
                                                        <?= $murid['name']; ?>
                                                    </td>
                                                    <td><?= $row['presensi']; ?></td>
                                                    <td><?= $total; ?></td>
                                                    <td><?= $total_1; ?></td>
                                                    <td><?= $total_2; ?></td>
                                                    <td><?= $totalpeniliansikap; ?></td>
                                                    <td><?= $total_livinglemari; ?></td>
                                                    <td><?= $total_livingraksepatudanhanduk; ?></td>

                                                    <td></td>
                                                    <td><?= $totalsemua; ?></td>
                                                    <td>

                                                        <?= $row['status']; ?>

                                                    </td>
                                                    <td>Week <?= $i; ?></td>
                                                    <td><?= $dari; ?></td>
                                                    <td>
                                                        <?= $row['grace']; ?>
                                                        <?= $row['punisment']; ?>
                                                    </td>
                                                    <td>
                                                        <a id="edit_penilaian" data-toggle="modal" data-date="<?= $row['date']; ?>" data-target="#editreport" data-absen="<?= $row['presensi']; ?>" data-status="<?= $row['status']; ?>" data-graces="<?= $row['grace']; ?>" data-ps="<?= $presensiWeekly['punisment']; ?>">
                                                            <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button></a>
                                                    </td>

                                                </tr>

                                                <?php $i++; ?>
                                        <?php endforeach;
                                        } ?>
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




    <!--edit Modal -->
    <div class="modal fade" id="editreport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Presensi dan Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">

                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                        <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                        <input type="hidden" class="form-control" id="date" name="date">


                        <div class="form-group">
                            <label for="text">Presensi :</label>
                            <input type="text" class="form-control" id="absen" name="absen">
                        </div>



                        <div class="form-group">
                            <label for="text">Status :</label>
                            <select class="form-control" name="status" id="status" aria-label="Default select example">
                                <option value="">Select</option>
                                <option value="Complate">Complate</option>
                                <option value="Punishment">Punishment</option>
                                <option value="Grace">Grace</option>
                                <option value="Reward">Reward</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <h7 class="text-reset">Grace :</h7>
                            <select class="form-control" id="graces" name="graces">
                                <option value="">Select</option>
                                <?php
                                $grace = mysqli_query($conn, "SELECT * FROM tb_grace");
                                while ($datagrace = mysqli_fetch_array($grace)) {
                                    echo '<option value="' . $datagrace['grace'] . '">' . $datagrace['grace'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <h7 class="text-reset">Punishment :</h7>
                            <select class="form-control" name="ps" id="ps">
                                <option value="">Select</option>
                                <?php
                                $Punishment = mysqli_query($conn, "SELECT * FROM tb_punishment");
                                while ($dataPunishment = mysqli_fetch_array($Punishment)) {
                                    echo '<option value="' . $dataPunishment['Punishment'] . '">' . $dataPunishment['Punishment'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="edit" name="edit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Logout Modal-->
    <?php
    include 'modal/modal_logout.php';
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

        $(document).on("click", "#edit_penilaian", function() {
            let absen = $(this).data('absen');
            let status = $(this).data('status');
            let graces = $(this).data('graces');
            let date = $(this).data('date');
            let ps = $(this).data('ps');

            $(" #modal-edit #absen").val(absen);
            $(" #modal-edit #status").val(status);
            $(" #modal-edit #graces").val(graces);
            $(" #modal-edit #date").val(date);
            $(" #modal-edit #ps").val(ps);

        });
    </script>
</body>

</html>