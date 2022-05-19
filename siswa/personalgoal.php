<?php
include '../database.php';
// sistem submit/post di bagian jurnal personal goal
if (isset($_POST['submit'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $date = date('Y-m-d');
    $Character = htmlspecialchars($_POST['Character']);
    $prayer = htmlspecialchars($_POST['prayer']);
    $Neutron = htmlspecialchars($_POST['Neutron']);
    $smt = htmlspecialchars($_POST['smt']);
    $goal = mysqli_query($conn, "INSERT INTO `tb_personal_goal`(`nis`, `character_virtue`, `prayer`, `neutron`,`semester`) VALUES ('$nis','$Character','$prayer','$Neutron','$smt')");
    if ($goal) {
        $notifsukses = $_SESSION['sukses'] = 'Berhasil Disimpan';
        echo notice(1);
    } else {
        $notifgagal = $_SESSION['gagal'] = 'Mohon Maaf Pengisian jurnal Hanya Sekali Saja';
        echo notice(0);
    }
}

// proses edit goals seeting
if (isset($_POST['btn_update_personalgoal'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $character = htmlspecialchars($_POST['character']);
    $prayer = htmlspecialchars($_POST['prayer']);
    $Neutron = htmlspecialchars($_POST['neutron']);
    $date = htmlspecialchars($_POST['date']);
    $smt = htmlspecialchars($_POST['smt']);
    $edit = mysqli_query($conn, "UPDATE `tb_personal_goal` SET `nis`='$nis',`character_virtue`='$character',`prayer`='$prayer',`date`='$date',`neutron`='$Neutron',`semester`='$smt' WHERE `tb_personal_goal`.`nis` ='$nis' AND `tb_personal_goal`.`date`='$date'");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
        echo notice(1);
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil Di Edit!';
        echo notice(0);
    }
}

session_start();
include 'template/session.php';
$jurnal = mysqli_query($conn, "SELECT * FROM tb_personal_goal WHERE nis='$id' ORDER BY date DESC");
$goals_seeting = mysqli_fetch_array($jurnal);
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
                <!-- Topbar -->

                <!-- Topbar Navbar -->
                <?php
                include 'template/topbar_menu.php';
                ?>

                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="group">
                            <h1 class="h3 mb-mb-4 text-uppercase embed-responsive">Mingguan</h1>
                            <p class=" mt embed-responsive">Setiap item dapat diisi >1x dalam seminggu sesuai permintaan minimalnya. <span class="text-danger font-weight-bold">pengisian harus singkat dan jelas !</span></p>
                            <a href="Weekly.php" type="button" class="btn btn-outline-primary mt-2">Pameran</a>
                            <a href="personalgoal.php" type="button" class="btn btn-primary active mt-2 ">Tujuan Pribadi</a>
                            <a href="homemeeting.php" type="button" class="btn btn-outline-primary mt-2">Persekutuan Mentor</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#PGSJ">Isi Jurnal</a>
                            <h5 class=" font-weight-bold text-dark">Pengaturan Tujuan Pribadi</h5>
                            <!-- <p>adalah goal setting setiap hari berdasarkan arahan trainer menurut mapelnya. Isian dibawah ini adalah resume dari goal yang ditetapkan</p> -->
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-primary text-light">
                                            <th width="10">No</th>
                                            <th>Kelas Kebajikan Karakter</th>
                                            <th>Kelas Doa</th>
                                            <th>Kelas Bimbel</th>
                                            <th width="100">Tanggal</th>
                                            <th width="150">Catatan Mentor</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($jurnal as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['character_virtue']; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['prayer']; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['neutron']; ?>
                                                    </span>
                                                </td>
                                                <td><?= $row['date']; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['Catatan_mentor']; ?></a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal view -->
                                                    <button type="button" id="detail" class="btn btn-dark " data-toggle="modal" data-target="#modal_detail" data-nis="<?= $row['nis']; ?>" data-karakter="<?= $row['character_virtue']; ?>" data-doa="<?= $row['prayer']; ?>" data-neutron="<?= $row['neutron']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['Catatan_mentor']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <?php
                                                    $tanggal = date('Y-m-d');


                                                    if ($tanggal <= $row['date']) { ?>

                                                        <a id="edit_personalgoal" data-toggle="modal" data-target="#personalgoal" data-character="<?= $row["character_virtue"]; ?>" data-date="<?= $row["date"]; ?>" data-nis="<?= $row["nis"]; ?>" data-prayer="<?= $row["prayer"]; ?>" data-neutron="<?= $row["neutron"]; ?>">
                                                            <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button></a>
                                                    <?php }
                                                    ?>



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
            include 'template/footer.php';
            ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <?php
    include 'modal/modal_goalseeting.php';
    include 'modal/modal_logout.php';
    include 'template/script.php';
    include 'template/alert.php';
    ?>
    <script>
        $(document).on("click", "#detail", function() {
            let nis = $(this).data('nis');
            let karakter = $(this).data('karakter');
            let doa = $(this).data('doa');
            let neutron = $(this).data('neutron');
            let mentor = $(this).data('mentor');
            let date = $(this).data('date');
            $(" #modal-detail #nis").val(nis);
            $(" #modal-detail #karakter").val(karakter);
            $(" #modal-detail #doa").val(doa);
            $(" #modal-detail #neutron").val(neutron);
            $(" #modal-detail #mentor").val(mentor);
            $(" #modal-detail #date").val(date);

        });
        $('document').ready(function() {
            $('textarea').each(function() {
                $(this).val($(this).val().trim());
            });
        });

        $(document).on("click", "#edit_personalgoal", function() {

            let nis = $(this).data('nis');
            let character = $(this).data('character');
            let prayer = $(this).data('prayer');
            let neutron = $(this).data('neutron');
            let date = $(this).data('date');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #character").val(character);
            $(" #modal-edit #prayer").val(prayer);
            $(" #modal-edit #neutron").val(neutron);
            $(" #modal-edit #date").val(date);
        });
    </script>

    <!-- <script>
        var edit_personalgoal = document.getElementById('edit_personalgoal');
        var waktu = new Date();
        var hari = waktu.getDay();
        var bulan = waktu.getMonth();
        // alert(hari)

        if (hari == 7) {
            edit_personalgoal.style.display = 'blok';
        } else {
            edit_personalgoal.style.display = 'none';
        }
    </script> -->

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