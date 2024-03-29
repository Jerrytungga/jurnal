<?php
include '../database.php';
// proses input penilaian buku
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
    $brs = htmlspecialchars($_POST['barangasing']);
    $notes = htmlspecialchars($_POST['catatan']);
    $smt = htmlspecialchars($_POST['smt']);
    if ($nama_gambar != '') {
        if (move_uploaded_file($sumber, $target . $nama_gambar)) {
            $input =  mysqli_query($conn, "INSERT INTO `tb_living_buku`(`nis`, `posisi`, `tinggi/rendah`, `rapi`, `bersih`, `raib`,`barang_asing`, `image`, `catatan`, `efata`,`semester`) VALUES ('$nis','$pss','$tr','$rp','$br','$rb','$brs','$nama_gambar','$notes','$efata','$smt')");
            if ($input) {
                $notifinput = $_SESSION['sukses'] = 'Data Berhasil Di Masukan!';
            } else {
                $notifinput = $_SESSION['sukses'] = 'Data Berhasil Di Masukan!';
            }
        }
    } else {
        $input = mysqli_query($conn, "INSERT INTO `tb_living_buku`(`nis`, `posisi`, `tinggi/rendah`, `rapi`, `bersih`, `raib`,`barang_asing`, `catatan`, `efata`,`semester`) VALUES ('$nis','$pss','$tr','$rp','$br','$rb','$brs','$notes','$efata','$smt')");
        if ($input) {
            $notifinput = $_SESSION['sukses'] = 'Data Berhasil Di Masukan!';
        } else {
            $notifinput = $_SESSION['sukses'] = 'Data Berhasil Di Masukan!';
        }
    }
}
// proses update penilaian buku
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
    $barangasing = htmlspecialchars($_POST['brngasing']);
    $date = htmlspecialchars($_POST['date']);
    $notes = htmlspecialchars($_POST['catatan']);
    $smt = htmlspecialchars($_POST['smt']);
    if ($nama_gambar != '') {
        if (move_uploaded_file($sumber, $target . $nama_gambar)) {
            $edit =  mysqli_query($conn, "UPDATE `tb_living_buku` SET `nis`='$nis',`posisi`='$pss',`tinggi/rendah`='$tr',`rapi`='$rp',`bersih`='$br',`raib`='$rb',`image`='$nama_gambar',`barang_asing`='$barangasing',`catatan`='$notes',`date`='$date',`semester`='$smt' WHERE `tb_living_buku`.`nis`='$nis' AND `tb_living_buku`.`date`='$date'");

            if ($edit) {
                $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
            } else {
                $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil Di Edit!';
            }
        }
    } else {
        $edit = mysqli_query($conn, "UPDATE `tb_living_buku` SET `nis`='$nis',`posisi`='$pss',`tinggi/rendah`='$tr',`rapi`='$rp',`bersih`='$br',`barang_asing`='$barangasing',`raib`='$rb',`catatan`='$notes',`date`='$date',`semester`='$smt' WHERE `tb_living_buku`.`nis`='$nis' AND `tb_living_buku`.`date`='$date'");

        if ($edit) {
            $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
        } else {
            $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil Di Edit!';
        }
    }
}

if (isset($_POST['hapus'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $date = htmlspecialchars($_POST['date']);
    $hapus =  mysqli_query($conn, "DELETE FROM `tb_living_buku`  WHERE `nis` ='$nis' AND `date`='$date'");
    if ($hapus) {
        $notifdelete = $_SESSION['sukses'] = 'Data Berhasil Di Hapus!';
    } else {
        $notifgagal = $_SESSION['sukses'] = 'Data Gagal Di Hapus!';
    }
}

session_start();
include 'template/session.php';
//menampilkan data siswa dan jurnal
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
$semester = mysqli_query($conn, "SELECT * FROM tb_semester WHERE status= '1'") or die(mysqli_error($conn));
if (isset($_POST['filter_tanggal'])) {
    $mulai = $_POST['tanggal_mulai'];
    $selesai = $_POST['tanggal_akhir'];
    $nis = $_GET['nis'];

    if ($mulai != null || $selesai != null) {

        $penilaian = mysqli_query($conn, "SELECT * FROM tb_living_buku WHERE nis='$nis' AND date BETWEEN '$mulai' AND '$selesai' ORDER BY date DESC;");
    } else {

        $nis = $_GET['nis'];
        $penilaian = mysqli_query($conn, "SELECT * FROM tb_living_buku WHERE nis='$nis' ORDER BY date DESC");
        $nilai = mysqli_fetch_array($penilaian);
    }
} else {
    $nis = $_GET['nis'];
    $penilaian = mysqli_query($conn, "SELECT * FROM tb_living_buku WHERE nis='$nis' ORDER BY date DESC");
    $nilai = mysqli_fetch_array($penilaian);
}
if (isset($_POST['reset'])) {
    $nis = $_GET['nis'];
    $penilaian = mysqli_query($conn, "SELECT * FROM tb_living_buku WHERE nis='$nis' ORDER BY date DESC");
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
                            <h6 class=" font-weight-bold text-primary ">Buku</h6>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#Buku">Masukan Penilaian</a>
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
                                        <button type="submit" name="filter_tanggal" class="btn btn-info ml-3">Tampilkan</button>
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
                                            <th width="50">Posisi</th>
                                            <th width="50">Tinggi/ Rendah</th>
                                            <th width="50">Rapi</th>
                                            <th width="50">Bersih</th>
                                            <th width="50">Raib</th>
                                            <th width="150">Benda Asing</th>
                                            <th width="150">Foto</th>
                                            <th width="100">Tanggal</th>
                                            <th width="250">Catatan Mentor</th>
                                            <th width="200">Aksi</th>

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
                                                <td><?= $row['tinggi/rendah']; ?></td>
                                                <td><?= $row['rapi']; ?></td>
                                                <td><?= $row['bersih']; ?></td>
                                                <td><?= $row['raib']; ?></td>
                                                <td><?= $row['barang_asing']; ?></td>
                                                <td>
                                                    <?php
                                                    $gambar = $row["image"];
                                                    if ($gambar) { ?>

                                                        <a id="editpenilaian" type="button" data-foto="<?= $row['image']; ?>" class="btn  btn-lg" data-toggle="modal" data-target="#myModal">
                                                            <img src="../img/penilaian/<?= $row["image"]; ?>" class="img-responsive" width="90" height="90">
                                                        </a>

                                                    <?php }

                                                    ?>
                                                </td>
                                                <td><?= $row['date']; ?></td>
                                                <td><a class="font-weight-bold text-primary font-italic"><?= $row['catatan']; ?></a></td>
                                                <td>

                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle " data-toggle="dropdown" aria-expanded="false">
                                                            Pilihan
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <!-- Button trigger modal -->
                                                            <a id="editpenilaian" type="button" data-toggle="modal" data-target="#edit" data-posisi="<?= $row['posisi']; ?>" data-tinggirendah="<?= $row['tinggi/rendah']; ?>" data-rapi="<?= $row['rapi']; ?>" data-nis="<?= $row['nis']; ?>" data-efata="<?= $row['efata']; ?>" data-cttn="<?= $row['catatan']; ?>" data-bersih="<?= $row['bersih']; ?>" data-raib="<?= $row['raib']; ?>" data-brngasing="<?= $row['barang_asing']; ?>" data-foto="<?= $row['image']; ?>" data-date="<?= $row['date']; ?>" class="dropdown-item">
                                                                Edit
                                                            </a>

                                                            <a type="button" id="editpenilaian" class="dropdown-item text-danger" data-date="<?= $row["date"]; ?>" data-nis="<?= $row["nis"]; ?>" data-toggle="modal" data-target="#hapus">
                                                                Hapus
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <?php
                                            $total = $total + $row['posisi'] + $row['tinggi/rendah'] + $row['rapi'] + $row['bersih'] + $row['raib'] + $row['barang_asing']; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <th class="bg-warning text-right" colspan="10"> Total Poin : </th>
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
    include 'modal/modal_living_buku.php';
    include 'modal/modal_hapus.php';
    include 'modal/modal_foto.php';
    include 'template/script.php';
    include 'template/alert.php';
    ?>


    <script>
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
            let brngasing = $(this).data('brngasing');
            let catatan = $(this).data('cttn');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #efata").val(efata);
            $(" #modal-edit #posisi").val(posisi);
            $(" #modal-edit #tinggirendah").val(tinggirendah);
            $(" #modal-edit #rapi").val(rapi);
            $(" #modal-edit #bersih").val(bersih);
            $(" #modal-edit #date").val(date);
            $(" #modal-edit #brngasing").val(brngasing);
            $(" #modal-edit #raib").val(raib);
            $(" #modal-edit #catatan").val(catatan);
            $(" #modal-edit #foto").attr("src", "../img/penilaian/" + foto);
            $(" #modal-hapus #date").val(date);
            $(" #modal-hapus #nis").val(nis);

        });
    </script>
</body>

</html>