<?php
include '../database.php';
// sistem edit blessings method Post
if (isset($_POST['btn_blessings'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $god = htmlspecialchars($_POST['god']);
    $cttn1 = htmlspecialchars($_POST['cttn1']);
    $edu = htmlspecialchars($_POST['edu']);
    $cttn2 = htmlspecialchars($_POST['cttn2']);
    $chracter = htmlspecialchars($_POST['chracter']);
    $cttn3 = htmlspecialchars($_POST['cttn3']);
    $apresiasi1 = htmlspecialchars($_POST['apresiasi1']);
    $cttn4 = htmlspecialchars($_POST['cttn4']);
    $apresiasi2 = htmlspecialchars($_POST['apresiasi2']);
    $cttn5 = htmlspecialchars($_POST['cttn5']);
    $apresiasi3 = htmlspecialchars($_POST['apresiasi3']);
    $cttn6 = htmlspecialchars($_POST['cttn6']);
    $ask = htmlspecialchars($_POST['ask']);
    $cttn7 = htmlspecialchars($_POST['cttn7']);
    $berkat = htmlspecialchars($_POST['berkat']);
    $cttn8 = htmlspecialchars($_POST['cttn8']);
    $date = htmlspecialchars($_POST['date']);
    $point1 = htmlspecialchars($_POST['point1']);
    $point2 = htmlspecialchars($_POST['point2']);
    $point3 = htmlspecialchars($_POST['point3']);
    $point4 = htmlspecialchars($_POST['point4']);
    $point5 = htmlspecialchars($_POST['point5']);
    $point6 = htmlspecialchars($_POST['point6']);
    $point7 = htmlspecialchars($_POST['point7']);
    $point8 = htmlspecialchars($_POST['point8']);
    $edit = mysqli_query($conn, "UPDATE `tb_blessings` SET `nis`='$nis',`efata`='$efata',`date`='$date',`point1`='$point1',`point2`='$point2',`point3`='$point3',`point4`='$point4',`point5`='$point5',`point6`='$point6',`point7`='$point7',`point8`='$point8',`what_i_gain_on_god`='$god',`cttn1`='$cttn1',`what_i_learn_on_education`='$edu',`cttn2`='$cttn2',`what_i_learn_on_character_and_virtue`='$chracter',`cttn3`='$cttn3',`what_l_appreciate_toward_brother_sister`='$apresiasi1',`cttn4`='$cttn4',`what_l_appreciate_toward_my_trainers`='$apresiasi2',`cttn5`='$cttn5',`what_l_appreciate_toward_saints`='$apresiasi3',`cttn6`='$cttn6',`what_I_want_to_ask`='$ask',`cttn7`='$cttn7',`what_i_learn_the_most_this_month`='$berkat',`cttn8`='$cttn8' WHERE `tb_blessings`.`nis` ='$nis' AND `tb_blessings`.`date`='$date'");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Saved!';
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil Di Edit!';
    }
}

if (isset($_POST['hapus'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $date = htmlspecialchars($_POST['date']);
    $hapus =  mysqli_query($conn, "DELETE FROM `tb_blessings`  WHERE `nis` ='$nis' AND `date`='$date'");
    if ($hapus) {
        $notifdelete = $_SESSION['sukses'] = 'Data Successfully Deleted!';
    } else {
        $notifgagal = $_SESSION['sukses'] = 'Data failed to delete!';
    }
}
session_start();
include 'template/session.php';
//menampilkan data siswa dan jurnal
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
if (isset($_POST['filter_tanggal'])) {
    $mulai = $_POST['tanggal_mulai'];
    $selesai = $_POST['tanggal_akhir'];
    $nis = $_GET['nis'];

    if ($mulai != null || $selesai != null) {

        $jurnal = mysqli_query($conn, "SELECT * FROM tb_blessings WHERE nis='$nis' AND date BETWEEN '$mulai' AND '$selesai' ORDER BY date DESC;");
    } else {

        $nis = $_GET['nis'];
        $jurnal = mysqli_query($conn, "SELECT * FROM tb_blessings WHERE nis='$nis' ORDER BY date DESC");
        $exhibition = mysqli_fetch_array($jurnal);
    }
} else {
    $nis = $_GET['nis'];
    $jurnal = mysqli_query($conn, "SELECT * FROM tb_blessings WHERE nis='$nis' ORDER BY date DESC");
    $exhibition = mysqli_fetch_array($jurnal);
}
if (isset($_POST['reset'])) {
    $nis = $_GET['nis'];
    $jurnal = mysqli_query($conn, "SELECT * FROM tb_blessings WHERE nis='$nis' ORDER BY date DESC");
    $exhibition = mysqli_fetch_array($jurnal);
}

?>


<!-- Html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jurnal Monthly</title>
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
                <?php
                include 'template/topbar_menu.php';
                ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-mb-4 text-gray-800">Jurnal Monthly <?= $siswa2['name']; ?></h1>
                    </div>

                    <div class="btn-group mb-4" role="group" aria-label="Basic outlined example">
                        <a href="blessings.php" type="button" class="btn btn-outline-primary active">Blessings</a>

                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
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
                                            <th width="150">What I Gain On God</th>
                                            <th width="100">What I Learn On Education</th>
                                            <th width="100">What I learn On Character & Virtue</th>
                                            <th width="100">What I Appreciate Toward Brother & Sister</th>
                                            <th width="100">What l Appreciate Toward My Trainers/Mentors</th>
                                            <th width="100">What I Appreciate Toward Saints</th>
                                            <th width="100">What I Want To Ask</th>
                                            <th width="100">What I Learn the most This Month</th>
                                            <th width="100">Date</th>
                                            <th width="200">Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1;
                                        $total = 0;
                                        ?>
                                        <?php foreach ($jurnal as $row) : ?>
                                            <tr>

                                                <td><?= $i; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['what_i_gain_on_god']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn1']; ?></a><br>
                                                        <a class="font-weight-bold text-danger font-italic">Point : <?= $row['point1']; ?></a>
                                                        <a type="button" class="fas fa-eye" id="detail" data-whatigod="<?= $row['what_i_gain_on_god']; ?>" data-cttn="<?= $row['cttn1']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#what_i_gain_on_god">

                                                        </a>
                                                    </span>

                                                </td>

                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['what_i_learn_on_education']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn2']; ?></a><br>
                                                        <a class="font-weight-bold text-danger font-italic">Point : <?= $row['point2']; ?></a>
                                                        <a type="button" class="fas fa-eye" id="detail" data-whateducation="<?= $row['what_i_learn_on_education']; ?>" data-cttn="<?= $row['cttn2']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#what_i_learn_on_education">
                                                        </a>
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['what_i_learn_on_character_and_virtue']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn3']; ?></a><br>
                                                        <a class="font-weight-bold text-danger font-italic">Point : <?= $row['point3']; ?></a>
                                                        <a type="button" class="fas fa-eye" id="detail" data-learn="<?= $row['what_i_learn_on_character_and_virtue']; ?>" data-cttn="<?= $row['cttn3']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#what_i_learn_on_character_and_virtue">
                                                        </a>
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['what_l_appreciate_toward_brother_sister']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn4']; ?></a><br>
                                                        <a class="font-weight-bold text-danger font-italic">Point : <?= $row['point4']; ?></a>
                                                        <a type="button" class="fas fa-eye" id="detail" data-appreciate="<?= $row['what_l_appreciate_toward_brother_sister']; ?>" data-cttn="<?= $row['cttn4']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#what_l_appreciate_toward_brother_sister">
                                                        </a>
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['what_l_appreciate_toward_my_trainers']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn5']; ?></a><br>
                                                        <a class="font-weight-bold text-danger font-italic">Point : <?= $row['point5']; ?></a>
                                                        <a type="button" class="fas fa-eye" id="detail" data-appreciate1="<?= $row['what_l_appreciate_toward_my_trainers']; ?>" data-cttn="<?= $row['cttn5']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#WhatIAppreciateTowardMyTrainers">
                                                        </a>
                                                    </span>

                                                </td>

                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['what_l_appreciate_toward_saints']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn6']; ?></a><br>
                                                        <a class="font-weight-bold text-danger font-italic">Point : <?= $row['point6']; ?></a>
                                                        <a type="button" class="fas fa-eye" id="detail" data-appreciate2="<?= $row['what_l_appreciate_toward_saints']; ?>" data-cttn="<?= $row['cttn6']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#WhatIAppreciateTowardSaints">
                                                        </a>
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['what_I_want_to_ask']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn7']; ?></a><br>
                                                        <a class="font-weight-bold text-danger font-italic">Point : <?= $row['point7']; ?></a>
                                                        <a type="button" class="fas fa-eye" id="detail" data-ask="<?= $row['what_I_want_to_ask']; ?>" data-cttn="<?= $row['cttn7']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#WhatIWantToAsk">
                                                        </a>
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <?= $row['what_i_learn_the_most_this_month']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn8']; ?></a><br>
                                                        <a class="font-weight-bold text-danger font-italic">Point : <?= $row['point8']; ?></a>
                                                        <a type="button" class="fas fa-eye" id="detail" data-whatlearnthismonht="<?= $row['what_i_learn_the_most_this_month']; ?>" data-cttn="<?= $row['cttn8']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#what_i_learn_the_most_this_month">
                                                        </a>
                                                    </span>
                                                </td>

                                                <td><?= $row['date']; ?></td>

                                                <td>


                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle " data-toggle="dropdown" aria-expanded="false">
                                                            Choice
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">


                                                            <!-- Get data personal siswa -->
                                                            <a id="edit_blessings" data-toggle="modal" data-target="#blessings" data-god="<?= $row["what_i_gain_on_god"]; ?>" data-nis="<?= $row["nis"]; ?>" data-point1="<?= $row["point1"]; ?>" data-point2="<?= $row["point2"]; ?>" data-point3="<?= $row["point3"]; ?>" data-point4="<?= $row["point4"]; ?>" data-point5="<?= $row["point5"]; ?>" data-point6="<?= $row["point6"]; ?>" data-point7="<?= $row["point7"]; ?>" data-point8="<?= $row["point8"]; ?>" data-nis="<?= $row["nis"]; ?>" data-cttn1="<?= $row["cttn1"]; ?>" data-edu="<?= $row["what_i_learn_on_education"]; ?>" data-cttn2="<?= $row["cttn2"]; ?>" data-chracter="<?= $row["what_i_learn_on_character_and_virtue"]; ?>" data-cttn3="<?= $row["cttn3"]; ?>" data-date="<?= $row["date"]; ?>" data-apresiasi1="<?= $row["what_l_appreciate_toward_brother_sister"]; ?>" data-cttn4="<?= $row["cttn4"]; ?>" data-apresiasi2="<?= $row["what_l_appreciate_toward_my_trainers"]; ?>" data-cttn5="<?= $row["cttn5"]; ?>" data-apresiasi3="<?= $row["what_l_appreciate_toward_saints"]; ?>" data-cttn6="<?= $row["cttn6"]; ?>" data-ask="<?= $row["what_I_want_to_ask"]; ?>" data-cttn7="<?= $row["cttn7"]; ?>" data-berkat="<?= $row["what_i_learn_the_most_this_month"]; ?>" data-cttn8="<?= $row["cttn8"]; ?>" class="dropdown-item">
                                                                Edit</a>
                                                            <!-- btn hapus data -->
                                                            <a type="button" id="edit_blessings" class="dropdown-item text-danger" data-date="<?= $row["date"]; ?>" data-nis="<?= $row["nis"]; ?>" data-toggle="modal" data-target="#hapus">
                                                                Delete
                                                            </a>

                                                        </div>
                                                    </div>


                                                </td>


                                            </tr>
                                            <?php
                                            $total = $total + $row['point1'] + $row['point2'] + $row['point3']  + $row['point4'] + $row['point5'] + $row['point6'] + $row['point7'] + $row['point8']; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <th class="bg-warning text-right" colspan="10"> Total Point : </th>
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
    include 'modal/modal_blessings.php';
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

        $(document).on("click", "#edit_blessings", function() {

            let nis = $(this).data('nis');
            let god = $(this).data('god');
            let cttn1 = $(this).data('cttn1');
            let edu = $(this).data('edu');
            let cttn2 = $(this).data('cttn2');
            let chracter = $(this).data('chracter');
            let cttn3 = $(this).data('cttn3');
            let apresiasi1 = $(this).data('apresiasi1');
            let cttn4 = $(this).data('cttn4');
            let apresiasi2 = $(this).data('apresiasi2');
            let cttn5 = $(this).data('cttn5');
            let apresiasi3 = $(this).data('apresiasi3');
            let cttn6 = $(this).data('cttn6');
            let ask = $(this).data('ask');
            let cttn7 = $(this).data('cttn7');
            let berkat = $(this).data('berkat');
            let cttn8 = $(this).data('cttn8');
            let date = $(this).data('date');
            let point1 = $(this).data('point1');
            let point2 = $(this).data('point2');
            let point3 = $(this).data('point3');
            let point4 = $(this).data('point4');
            let point5 = $(this).data('point5');
            let point6 = $(this).data('point6');
            let point7 = $(this).data('point7');
            let point8 = $(this).data('point8');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #god").val(god);
            $(" #modal-edit #cttn1").val(cttn1);
            $(" #modal-edit #edu").val(edu);
            $(" #modal-edit #cttn2").val(cttn2);
            $(" #modal-edit #chracter").val(chracter);
            $(" #modal-edit #cttn3").val(cttn3);
            $(" #modal-edit #apresiasi1").val(apresiasi1);
            $(" #modal-edit #cttn4").val(cttn4);
            $(" #modal-edit #apresiasi2").val(apresiasi2);
            $(" #modal-edit #cttn5").val(cttn5);
            $(" #modal-edit #apresiasi3").val(apresiasi3);
            $(" #modal-edit #cttn6").val(cttn6);
            $(" #modal-edit #ask").val(ask);
            $(" #modal-edit #cttn7").val(cttn7);
            $(" #modal-edit #berkat").val(berkat);
            $(" #modal-edit #cttn8").val(cttn8);
            $(" #modal-edit #date").val(date);
            $(" #modal-edit #point1").val(point1);
            $(" #modal-edit #point2").val(point2);
            $(" #modal-edit #point3").val(point3);
            $(" #modal-edit #point4").val(point4);
            $(" #modal-edit #point5").val(point5);
            $(" #modal-edit #point6").val(point6);
            $(" #modal-edit #point7").val(point7);
            $(" #modal-edit #point8").val(point8);
        });

        $(document).on("click", "#detail", function() {

            let nis = $(this).data('nis');
            let god = $(this).data('whatigod');
            let edu = $(this).data('whateducation');
            let learnoncharacter = $(this).data('learn');
            let appreciate = $(this).data('appreciate');
            let appreciate1 = $(this).data('appreciate1');
            let appreciate2 = $(this).data('appreciate2');
            let ask = $(this).data('ask');
            let whatlearnthismonht = $(this).data('whatlearnthismonht');
            let catatan = $(this).data('cttn');
            let date = $(this).data('date');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #god").val(god);
            $(" #modal-edit #edu").val(edu);
            $(" #modal-edit #learnoncharacter").val(learnoncharacter);
            $(" #modal-edit #appreciate").val(appreciate);
            $(" #modal-edit #appreciate1").val(appreciate1);
            $(" #modal-edit #appreciate2").val(appreciate2);
            $(" #modal-edit #ask").val(ask);
            $(" #modal-edit #whatlearnthismonht").val(whatlearnthismonht);
            $(" #modal-edit #catatan").val(catatan);
            $(" #modal-edit #date").val(date);
        });
    </script>

</body>

</html>