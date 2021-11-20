<?php
include '../database.php';
// sistem submit/post di bagian jurnal personal goal
if (isset($_POST['submit'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $date = date('Y-m-d');
    $Character = htmlspecialchars($_POST['Character']);
    $prayer = htmlspecialchars($_POST['prayer']);
    $Neutron = htmlspecialchars($_POST['Neutron']);
    $goal = mysqli_query($conn, "INSERT INTO `tb_personal_goal`(`nis`, `character_virtue`, `prayer`, `neutron`,`Catatan_mentor`) VALUES ('$nis','$Character','$prayer','$Neutron',NULL)");
    if ($goal) {
        echo '<script>alert("Terima kasih telah mengisi jurnal hari ini.")</script>';
    } else {
        echo '<script>alert("Mohon Maaf Pengisian jurnal Hanya Sekali Saja")</script>';
    }
}

// proses edit goals seeting
if (isset($_POST['btn_update_personalgoal'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $character = htmlspecialchars($_POST['character']);
    $prayer = htmlspecialchars($_POST['prayer']);
    $Neutron = htmlspecialchars($_POST['neutron']);
    $date = htmlspecialchars($_POST['date']);
    $goal = mysqli_query($conn, "UPDATE `tb_personal_goal` SET `nis`='$nis',`character_virtue`='$character',`prayer`='$prayer',`date`='$date',`neutron`='$Neutron' WHERE `tb_personal_goal`.`nis` ='$nis' AND `tb_personal_goal`.`date`='$date'");
}

session_start();
include 'template/session.php';
$jurnal = mysqli_query($conn, "SELECT * FROM tb_personal_goal WHERE nis='$id' ORDER BY date DESC");
$goals_seeting = mysqli_fetch_array($jurnal);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jurnal Daily</title>
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <?php
                    include 'template/topbar_menu.php';
                    ?>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="group">
                            <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Weekly</h1>
                            <p class=" mt embed-responsive">adalah jurnal mingguan. Setiap item dapat diisi >1x dalam seminggu sesuai permintaan minimalnya. <span class="text-danger font-weight-bold">pengisian harus singkat dan jelas !</span></p>
                            <a href="Weekly.php" type="button" class="btn btn-outline-primary mt-2">Exhibition</a>
                            <a href="personalgoal.php" type="button" class="btn btn-outline-warning active mt-2">Personal Goal</a>
                            <a href="homemeeting.php" type="button" class="btn btn-outline-success mt-2">Home Meeting</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#PGSJ">Isi Jurnal</a>
                            <h5 class=" font-weight-bold text-primary">Personal Goal Setting</h5>
                            <!-- <p>adalah goal setting setiap hari berdasarkan arahan trainer menurut mapelnya. Isian dibawah ini adalah resume dari goal yang ditetapkan</p> -->
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="table-secondary">
                                            <th width="10">No</th>
                                            <th>Character Virtue</th>
                                            <th>Prayer</th>
                                            <th>Bimbel</th>
                                            <th width="100">Date</th>
                                            <th width="150">Mentor Notes</th>
                                            <th>Options</th>
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
                                                    $tanggal = date('Y-m-d', strtotime('-6 days'));

                                                    if ($tanggal <= $row['date']) { ?>
                                                        <!-- Edit Prayer Note -->
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
            <footer class=" sticky-footer bg-white">
                <?php
                include 'template/footer.php';
                ?>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <?php
    include 'modal/modal_goalseeting.php';
    include 'modal/modal_logout.php';
    ?>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
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

</body>

</html>