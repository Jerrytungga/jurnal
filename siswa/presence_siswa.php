<?php
include '../database.php';
$hari_ini = date('Y-m-d');
// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
//function data siswa
function nama_siswa($name_siswa)
{
    global $conn;
    $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$name_siswa'"));
    return $sqly['name'];
} //akhir functioan data siswa


// function data kegiatan
function kegiatan($name_kegiatan)
{
    global $conn;
    $sqly3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$name_kegiatan'"));
    return $sqly3['items'];
} // akhir function data kegiatan



if (isset($_POST['week'])) {
    $week = $_POST['week'];

    if ($week == '%') {
        $Sqli_absent = mysqli_query($conn, "SELECT * FROM presensi where nis='$id' and batch='$angkatan' and ACC_Mentor='approved' order by presensi_time DESC");
        $Sqli_target = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(target) as target  FROM tb_target_presensi WHERE week='$week' and  semester='$data_semester'  and batch='$angkatan'"));
    } else {

        $Sqli_absent = mysqli_query($conn, "SELECT * FROM presensi where week='$week' and nis='$id' and batch='$angkatan' and ACC_Mentor='approved' order by presensi_time DESC");
        $array_absent = mysqli_fetch_array($Sqli_absent);
    }
} else {
    $Sqli_absent = mysqli_query($conn, "SELECT * FROM presensi where nis='$id' and batch='$angkatan' and ACC_Mentor='approved' order by presensi_time DESC");
    $Sqli_target = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(target) as target  FROM tb_target_presensi WHERE batch='$angkatan' and semester='$data_semester'"));
}

$cek = mysqli_num_rows($Sqli_absent);

?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'template/head.php'
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



                <!-- Topbar Navbar -->
                <?php
                include 'template/topbar_menu.php';
                ?>


                <!-- End of Topbar -->
                <?php

                error_reporting(E_ALL ^ E_NOTICE);
                $Sqli_presensi = mysqli_query($conn, "SELECT * FROM presensi where nis='$id' and ACC_Mentor='approved' order by presensi_time DESC");
                $array_presensi = mysqli_fetch_array($Sqli_presensi);
                $mark_V = $array_presensi['mark'] = 'V';
                $mark_O = $array_presensi['mark'] = 'O';
                $mark_X = $array_presensi['mark'] = 'X';
                $mark_I = $array_presensi['mark'] = 'I';
                $mark_S = $array_presensi['mark'] = 'S';
                $week = $_POST['week'];
                $date = $array_presensi['presensi_date'];
                $batch = $array_presensi['batch'];


                if ($week) {

                    if ($week != null) {

                        $Sqli_target = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(target) as target FROM tb_target_presensi WHERE week like '$week' and  semester='$data_semester' and batch='$batch'"));


                        $tampil_mark_V = mysqli_query($conn, "SELECT *, COUNT(mark) as total FROM `presensi` WHERE week like '$week' and nis='$id' and ACC_Mentor='approved' and mark='$mark_V' and semester='$data_semester' ");
                        $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);


                        $tampil_mark_O = mysqli_query($conn, "SELECT *, COUNT(mark) as total FROM `presensi` WHERE week like '$week' and nis='$id' and ACC_Mentor='approved' and mark='$mark_O' and semester='$data_semester' ");
                        $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                        $tampil_mark_X = mysqli_query($conn, "SELECT *, COUNT(mark) as total FROM `presensi` WHERE week like '$week' and nis='$id' and ACC_Mentor='approved' and mark='$mark_X' and semester='$data_semester' ");
                        $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                        $tampil_mark_I = mysqli_query($conn, "SELECT *, COUNT(mark) as total FROM `presensi` WHERE week like '$week' and nis='$id' and ACC_Mentor='approved' and mark='$mark_I'  and semester='$data_semester' ");
                        $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                        $tampil_mark_S = mysqli_query($conn, "SELECT *, COUNT(mark) as total FROM `presensi` WHERE week like '$week' and nis='$id' and ACC_Mentor='approved' and mark='$mark_S' and semester='$data_semester' ");
                        $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                        $points = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];

                        // jika target mingguan terpenuhi
                        if ($points > $Sqli_target['target']) { ?>

                            <script>
                                Swal.fire({
                                    icon: 'warning',
                                    title: '<p class="text-primary"><strong class="text-primary">Selamat</strong></p>',
                                    html: '<b>Target Tercapai</b><br><br>Poin Anda adalah <?= $points; ?>'
                                })
                            </script>
                            <audio src="../music/error.wav" autoplay="autoplay" hidden="hidden"></audio>
                    <?php        }
                    } else {

                        $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$id' and ACC_Mentor='approved' and mark='$mark_V' and  semester='$data_semester'  ");
                        $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                        $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$id' and ACC_Mentor='approved' and mark='$mark_O' and semester='$data_semester' ");
                        $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                        $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$id' and ACC_Mentor='approved' and mark='$mark_X' and semester='$data_semester'");
                        $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                        $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$id' and ACC_Mentor='approved' and mark='$mark_I' and semester='$data_semester'");
                        $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                        $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$id' and ACC_Mentor='approved' and mark='$mark_S' semester='$data_semester' ");
                        $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                        $points = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];
                    }
                } else {

                    // $Sqli_target = mysqli_fetch_array(mysqli_query($conn, "SELECT target  FROM tb_target_presensi WHERE semester='$data_semester'"));

                    $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$id' and ACC_Mentor='approved' and mark='$mark_V' and semester='$data_semester'  ");
                    $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                    $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$id' and ACC_Mentor='approved' and mark='$mark_O' and semester='$data_semester' ");
                    $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                    $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$id' and ACC_Mentor='approved' and mark='$mark_X' and semester='$data_semester' ");
                    $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                    $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$id' and ACC_Mentor='approved' and mark='$mark_I'  and semester='$data_semester' ");
                    $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                    $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM presensi where nis='$id' and ACC_Mentor='approved' and mark='$mark_S' and semester='$data_semester' ");
                    $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                    $points = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];
                }

                if ($points < $Sqli_target['target']) { ?>

                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: '<p class="text-danger"><strong>Peringatan!</strong></p>',
                            html: '<b>Poin Belum Memenuhi Target</b><br><br>Poin Anda adalah <?= $points; ?>'
                        })
                    </script>
                    <audio src="../music/error.wav" autoplay="autoplay" hidden="hidden"></audio>
                <?php        }
                ?>






                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-mb-4 text-uppercase">Presensi</h1>
                        <?php
                        if (isset($_SESSION['alert_point'])) { ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <b>Peringatan!</b> <?php echo $_SESSION['alert_point']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                            unset($_SESSION['alert_point']);
                        } ?>
                    </div>
                    <div class="row">
                        <div class="card_information">
                            <div class="card bg-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1">
                                            <center>
                                                <div class="text-m font-weight-bold text-light text-uppercase mb-1">
                                                    POIN</div>
                                                <div class="h5 mb-0 font-weight-bold text-light">
                                                    <?php
                                                    $points;
                                                    if ($points == -1) {
                                                        $_SESSION['alert_point'] = 'Poin Anda Mines!';
                                                        echo $points;
                                                    } else {
                                                        echo  $points;
                                                    }
                                                    ?></div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card_information">
                            <div class="card bg-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1 ">
                                            <center>

                                                <div class="text-m font-weight-bold text-light text-uppercase mb-1">
                                                    TARGET</div>
                                                <div class="h5 mb-0 font-weight-bold text-light">
                                                    <?php
                                                    if ($Sqli_target['target']) { ?>
                                                        <?= $Sqli_target['target']; ?>
                                                    <?php   } else {
                                                        echo '0';
                                                    }

                                                    ?>



                                                </div>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card_presence">
                            <div class="card bg-gradient-light shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1 ">
                                            <center>
                                                <div class="text-m font-weight-bold text-danger text-uppercase mb-1">
                                                    Hadir</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $arraytampil_mark_V['total']; ?></div>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card_presence">
                            <div class="card bg-gradient-light shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1 ">
                                            <!-- <?php

                                                    $cek_total_jadwal = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(id_activity) total_jadwal FROM `schedule` WHERE week='$week'"));

                                                    if ($week) {

                                                        if ($week == '%') {
                                                            $total5 = $Sqli_target['target'] - $points - $arraytampil_mark_I['total'] - $arraytampil_mark_S['total'] - $arraytampil_mark_O['total'];
                                                        } else {
                                                            $cek_total_target = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(target) as total FROM `tb_target_presensi` WHERE week='$week' and batch='$angkatan'"));
                                                            $total5 =  $cek_total_target['total'] - $points
                                                                - $arraytampil_mark_I['total'] - $arraytampil_mark_S['total'] - $arraytampil_mark_O['total'];
                                                        }
                                                    } else {
                                                        $total5 = $Sqli_target['target'] - $points - $arraytampil_mark_I['total'] - $arraytampil_mark_S['total'] - $arraytampil_mark_O['total'];
                                                    }

                                                    ?> -->
                                            <center>
                                                <div class="text-m font-weight-bold text-danger text-uppercase mb-1">
                                                    Tidak Presensi</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                                    <?= $arraytampil_mark_X['total']; ?>
                                                </div>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card_presence">
                            <div class="card bg-gradient-light shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1 ">
                                            <center>

                                                <div class="text-m font-weight-bold text-danger text-uppercase mb-1">
                                                    Terlambat</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $arraytampil_mark_O['total']; ?></div>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card_presence">
                            <div class="card bg-gradient-light shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1 ">
                                            <center>

                                                <div class="text-m font-weight-bold text-danger text-uppercase mb-1">
                                                    IZin</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $arraytampil_mark_I['total']; ?></div>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card_presence">
                            <div class="card bg-gradient-light shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1 ">
                                            <center>

                                                <div class="text-m font-weight-bold text-danger text-uppercase mb-1">
                                                    Sakit</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $arraytampil_mark_S['total']; ?></div>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card  mb-4">
                        <div class=" card-header py-3">
                            <div class="alert alert-warning col-3 mb-4" role="alert">
                                Untuk Mengetahui Poin Silahkan Pilih Minggu
                            </div>
                            <div class="form-inline">

                                <form action="" method="POST" id="form_id">
                                    <b class="font-weight-normal">Minggu :</b>&nbsp;&nbsp;


                                    <select id="" class="form-control col-12" name="week" onChange="document.getElementById('form_id').submit();">
                                        <?php
                                        if (isset($_POST['week'])) {
                                            $value_minggu = mysqli_fetch_array(mysqli_query($conn, "SELECT week, nis FROM `presensi` where nis='$id' and week='" . $_POST['week'] . "'")); ?>
                                            <option value="<?= $value_minggu['week'] ?>"><?= $value_minggu['week'] ?></option>
                                        <?php    } else {
                                            echo  '<option selected>Pilih Minggu</option>';
                                        }
                                        $presensi_hasil = mysqli_query($conn, "SELECT week, nis FROM `presensi` where nis='$id' GROUP by week");
                                        while ($hasil_data = mysqli_fetch_array($presensi_hasil)) { ?>
                                            <option value="<?= $hasil_data['week'] ?>"><?= $hasil_data['week'] ?></option>
                                        <?php    }  ?>
                                    </select>
                                    <a href="presence_siswa.php" class="btn btn-danger">Reset</a>

                                </form>

                                <!-- <form action="" method="POST">
                                    <?php
                                    if (isset($_POST['filter_tanggal'])) {
                                        $mulai = $_POST['tanggal_mulai'];
                                        $selesai = $_POST['tanggal_akhir'];
                                    ?>
                                        <input type="date" name="tanggal_mulai" value="<?= $mulai ?>" class="form-control ml-3">
                                        <input type="date" name="tanggal_akhir" value="<?= $selesai ?>" class="form-control ml-3">
                                    <?php
                                    } else {
                                    ?>
                                        <input type="date" name="tanggal_mulai" class="form-control ml-3">
                                        <input type="date" name="tanggal_akhir" class="form-control ml-3">
                                    <?php } ?>
                                    <button type="submit" name="filter_tanggal" class="btn btn-info ml-3">Search</button>
                                    <button type="submit" name="reset" value="reset" class="btn btn-danger ml-3">Reset</button>
                                </form> -->
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                    if ($cek == 0) { ?>

                                        <script>
                                            Swal.fire(
                                                '<strong>Peringatan!</strong>', 'Tidak Ada Presensi', 'question')
                                        </script>
                                        <audio src="../music/error.wav" autoplay="autoplay" hidden="hidden"></audio>

                                    <?php   } else { ?>
                                        <thead>
                                            <tr class="bg-primary text-light">
                                                <th width="10">No</th>
                                                <!-- <th>Presence Picture</th> -->
                                                <th>Kegiatan</th>
                                                <th>Waktu Kegiatan</th>
                                                <th>Waktu Mulai Presensi</th>
                                                <th>Waktu Presensi</th>
                                                <th>Minggu</th>
                                                <th>Tanda</th>
                                                <th>Persetujuan</th>
                                                <th>Catatan Mentor</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($Sqli_absent as $row) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <!-- <td>

                                                        <?php
                                                        $gambar = $row["image"];
                                                        if ($gambar) { ?>
                                                            <button type="button" data-gambar="<?= $row["image"]; ?>" class="btn " data-toggle="modal" data-target="#gambar">
                                                                <img src="../img/verifikasi/<?= $row["image"]; ?>" width="90">
                                                            </button>

                                                        <?php }

                                                        ?>

                                                    </td> -->
                                                    <td><?= kegiatan($row['id_activity']); ?></td>
                                                    <td>
                                                        <?php
                                                        // mengambil waktu kegiatanm di tabel kegiatan berdasarkan id kegiatan
                                                        $id_kegiatan = $row["schedule_id"];
                                                        $sqli_schedule = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schedule WHERE id='$id_kegiatan'"));
                                                        $waktu_kegiatan = $sqli_schedule['start_time'];
                                                        $absent_time = $sqli_schedule['presensi_time'];
                                                        ?>
                                                        <?= $waktu_kegiatan; ?>
                                                    </td>
                                                    <td>
                                                        <?= $absent_time; ?>
                                                    </td>
                                                    <td><?= $row['presensi_time']; ?></td>
                                                    <td><?= $row['week']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row['mark'] == 'V') { ?>
                                                            <span class="badge badge-pill badge-primary"><?= $row['mark']; ?></span>
                                                        <?php  } else if ($row['mark'] == 'O') { ?>
                                                            <span class="badge badge-pill badge-warning"><?= $row['mark']; ?></span>
                                                        <?php   } else if ($row['mark'] == 'X') { ?>
                                                            <span class="badge badge-pill badge-danger"><?= $row['mark']; ?></span>
                                                        <?php  } else if ($row['mark'] == 'I') { ?>
                                                            <span class="badge badge-pill badge-info"><?= $row['mark']; ?></span>
                                                        <?php   }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        // jika presensinya terlambat maka warna merah statusnya
                                                        if ($row["ACC_Mentor"] == 'Waiting') { ?>
                                                            <span class="badge badge-pill badge-warning"><?= $row["ACC_Mentor"]; ?></span>
                                                        <?php  } else if ($row["ACC_Mentor"] == 'not approved') { ?>
                                                            <span class="badge badge-pill badge-danger"><?= $row["ACC_Mentor"]; ?></span>
                                                        <?php   } else { ?>
                                                            <span class="badge badge-pill badge-success"><?= $row["ACC_Mentor"]; ?></span>
                                                        <?php  } ?>
                                                    </td>
                                                    <td><?= $row['catatan']; ?></td>
                                                    <td><?= $row['presensi_date']; ?></td>

                                                </tr>
                                                <?php

                                                $i++; ?>
                                        <?php endforeach;
                                        }
                                        ?>

                                        </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <?php
            include 'template/footer.php';
            ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Modal Log Out -->
    <?php
    include 'modal/modal_notes.php';
    include 'modal/modal_logout.php';
    include 'template/script.php';
    include 'template/alert.php';
    include '../modal.php';
    ?>
    <script>
        // edit catatan
        $(document).on("click", "#edit_catatan", function() {
            let judul = $(this).data('judul');
            let deskripsi = $(this).data('deskripsi');
            let id = $(this).data('id');
            let date = $(this).data('date');
            $(" #modal-edit #judul").val(judul);
            $(" #modal-edit #deskripsi").val(deskripsi);
            $(" #modal-edit #id").val(id);
            $(" #modal-hapus #id").val(id);
            $(" #modal-hapus #date").val(date);

        });
    </script>
</body>

</html>

<?php
function notice($type)
{
    if ($type == 1) {
        return "<audio autoplay><source src='" . '../music/success.wav' . "'></audio>";
    } elseif ($type == 0) {
        return "<audio autoplay><source src='" . '../music/error.wav' . "'></audio>";
    }
}

?>