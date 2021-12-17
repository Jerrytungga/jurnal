<?php
include '../database.php';
// sistem submit/post di bagian jurnal blessings
if (isset($_POST['blessing'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $god = htmlspecialchars($_POST['god']);
    $education = htmlspecialchars($_POST['education']);
    $character = htmlspecialchars($_POST['character']);
    $appreciate1 = htmlspecialchars($_POST['appreciate1']);
    $appreciate2 = htmlspecialchars($_POST['appreciate2']);
    $appreciate3 = htmlspecialchars($_POST['appreciate3']);
    $ask = htmlspecialchars($_POST['ask']);
    $thismonth = htmlspecialchars($_POST['thismonth']);
    $blessings1 = mysqli_query($conn, "INSERT INTO `tb_blessings`(`nis`, `what_i_gain_on_god`, `cttn1`, `what_i_learn_on_education`, `cttn2`, `what_i_learn_on_character_and_virtue`, `cttn3`, `what_l_appreciate_toward_brother_sister`, `cttn4`, `what_l_appreciate_toward_my_trainers`, `cttn5`, `what_l_appreciate_toward_saints`, `cttn6`, `what_I_want_to_ask`, `cttn7`, `what_i_learn_the_most_this_month`, `cttn8`, `catatan_mentor`) VALUES ('$nis','$god',NULL,'$education',NULL,'$character',NULL,'$appreciate1',NULL,'$appreciate2',NULL,'$appreciate3',NULL,'$ask',NULL,'$thismonth',NULL,NULL)");
    if ($blessings1) {
        $notifsukses = $_SESSION['sukses'] = 'Berhasil Disimpan';
    } else {
        $notifgagal = $_SESSION['gagal'] = 'Mohon Maaf Pengisian jurnal Hanya Sekali Saja';
    }
}

// sistem proses edit blessings
if (isset($_POST['btn_blessings'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $god = htmlspecialchars($_POST['god']);
    $edu = htmlspecialchars($_POST['edu']);
    $chracter = htmlspecialchars($_POST['chracter']);
    $apresiasi1 = htmlspecialchars($_POST['apresiasi1']);
    $apresiasi2 = htmlspecialchars($_POST['apresiasi2']);
    $apresiasi3 = htmlspecialchars($_POST['apresiasi3']);
    $ask = htmlspecialchars($_POST['ask']);
    $berkat = htmlspecialchars($_POST['berkat']);
    $date = htmlspecialchars($_POST['date']);
    $edit = mysqli_query($conn, "UPDATE `tb_blessings` SET `nis`='$nis',`what_i_gain_on_god`='$god',`what_i_learn_on_education`='$edu',`what_i_learn_on_character_and_virtue`='$chracter',`what_l_appreciate_toward_brother_sister`='$apresiasi1',`what_l_appreciate_toward_my_trainers`='$apresiasi2',`what_l_appreciate_toward_saints`='$apresiasi3',`what_I_want_to_ask`='$ask',`what_i_learn_the_most_this_month`='$berkat' WHERE `tb_blessings`.`nis`='$nis' AND `tb_blessings`.`date`='$date'");
    if ($edit) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Saved!';
    } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Gagal!';
    }
}

// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
$jurnal = mysqli_query($conn, "SELECT * FROM tb_blessings WHERE nis='$id' ORDER BY date DESC");
$blessings = mysqli_fetch_array($jurnal);
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
                <?php
                include 'template/topbar_menu.php';
                ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="group">
                            <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Monthly</h1>
                            <p class=" mt embed-responsive">pengisian minimal 1x/bulan per item, <span class="text-danger font-weight-bold">pengisian harus singkat dan jelas !</span></p>
                            <a href="Monthly.php" type="button" class="btn btn-outline-primary active mt-2">Blessings</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#Blessings">Isi Jurnal</a>
                            <h5 class=" font-weight-bold text-primary">Blessings</h5>
                            <p>adalah catatan berkat-berkat yang di dapatkan selama 1 bulan</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="table-primary">
                                            <th width="10">No</th>
                                            <th width="150">What I gain on God</th>
                                            <th width="150">What I learn on Education</th>
                                            <th width="150">What I learn on character & Virtue</th>
                                            <th width="150">What I Appreciate Toward Brother & Sisters</th>
                                            <th width="150">What I Appreciate Toward My Trainers/Mentors</th>
                                            <th width="150">What I Appreciate Toward Saints</th>
                                            <th width="150">What I Want To Ask</th>
                                            <th width="150">What I Learn the most This Month</th>
                                            <th width="150">Date</th>
                                            <th width="150">Options</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($jurnal as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 150px;">
                                                        <?= $row['what_i_gain_on_god']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn1']; ?></a><br>
                                                        <a type="button" class="fas fa-eye" id="detail" data-whatigod="<?= $row['what_i_gain_on_god']; ?>" data-cttn="<?= $row['cttn1']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#what_i_gain_on_god">
                                                        </a>
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 150px;">
                                                        <?= $row['what_i_learn_on_education']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn2']; ?></a><br>
                                                        <a type="button" class="fas fa-eye" id="detail" data-whateducation="<?= $row['what_i_learn_on_education']; ?>" data-cttn="<?= $row['cttn2']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#what_i_learn_on_education">
                                                        </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 150px;">
                                                        <?= $row['what_i_learn_on_character_and_virtue']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn3']; ?></a><br>
                                                        <a type="button" class="fas fa-eye" id="detail" data-learn="<?= $row['what_i_learn_on_character_and_virtue']; ?>" data-cttn="<?= $row['cttn3']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#what_i_learn_on_character_and_virtue">
                                                        </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 150px;">
                                                        <?= $row['what_l_appreciate_toward_brother_sister']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn4']; ?></a><br>
                                                        <a type="button" class="fas fa-eye" id="detail" data-appreciate="<?= $row['what_l_appreciate_toward_brother_sister']; ?>" data-cttn="<?= $row['cttn4']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#what_l_appreciate_toward_brother_sister">
                                                        </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 150px;">
                                                        <?= $row['what_l_appreciate_toward_my_trainers']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn5']; ?></a><br>
                                                        <a type="button" class="fas fa-eye" id="detail" data-appreciate1="<?= $row['what_l_appreciate_toward_my_trainers']; ?>" data-cttn="<?= $row['cttn5']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#WhatIAppreciateTowardMyTrainers">
                                                        </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 150px;">
                                                        <?= $row['what_l_appreciate_toward_saints']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn6']; ?></a><br>
                                                        <a type="button" class="fas fa-eye" id="detail" data-appreciate2="<?= $row['what_l_appreciate_toward_saints']; ?>" data-cttn="<?= $row['cttn6']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#WhatIAppreciateTowardSaints">
                                                        </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 150px;">
                                                        <?= $row['what_I_want_to_ask']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn7']; ?></a><br>
                                                        <a type="button" class="fas fa-eye" id="detail" data-ask="<?= $row['what_I_want_to_ask']; ?>" data-cttn="<?= $row['cttn7']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#WhatIWantToAsk">
                                                        </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 150px;">
                                                        <?= $row['what_i_learn_the_most_this_month']; ?><br>
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['cttn8']; ?></a><br>
                                                        <a type="button" class="fas fa-eye" id="detail" data-whatlearnthismonht="<?= $row['what_i_learn_the_most_this_month']; ?>" data-cttn="<?= $row['cttn8']; ?>" data-nis="<?= $row['nis']; ?>" data-date="<?= $row['date']; ?>" data-toggle="modal" data-target="#what_i_learn_the_most_this_month">
                                                        </a>
                                                    </span>
                                                </td>
                                                <td><?= $row['date']; ?></td>
                                                <td>


                                                    <?php


                                                    $tanggal = date('Y-m-d', strtotime('+12 days'));

                                                    if ($tanggal >= $row['date']) { ?>
                                                        <a id="edit_blessings" data-toggle="modal" data-target="#blessings" data-god="<?= $row["what_i_gain_on_god"]; ?>" data-nis="<?= $row["nis"]; ?>" data-date="<?= $row["date"]; ?>" data-edu="<?= $row["what_i_learn_on_education"]; ?>" data-chracter="<?= $row["what_i_learn_on_character_and_virtue"]; ?>" data-apresiasi1="<?= $row["what_l_appreciate_toward_brother_sister"]; ?>" data-apresiasi2="<?= $row["what_l_appreciate_toward_my_trainers"]; ?>" data-apresiasi3="<?= $row["what_l_appreciate_toward_saints"]; ?>" data-ask="<?= $row["what_I_want_to_ask"]; ?>" data-berkat="<?= $row["what_i_learn_the_most_this_month"]; ?>">
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
            <footer class="sticky-footer bg-white">
                <?php
                include 'template/footer.php';
                ?>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Logout Modal-->
    <?php
    include 'modal/modal_blessings.php';
    include 'modal/modal_logout.php';
    include 'template/script.php';
    include 'template/alert.php';
    ?>

    <script>
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

        $(document).on("click", "#edit_blessings", function() {
            let nis = $(this).data('nis');
            let god = $(this).data('god');
            let edu = $(this).data('edu');
            let chracter = $(this).data('chracter');
            let apresiasi1 = $(this).data('apresiasi1');
            let apresiasi2 = $(this).data('apresiasi2');
            let apresiasi3 = $(this).data('apresiasi3');
            let ask = $(this).data('ask');
            let berkat = $(this).data('berkat');
            let date = $(this).data('date');
            $(" #modal-chages #date").val(date);
            $(" #modal-chages #nis").val(nis);
            $(" #modal-chages #god").val(god);
            $(" #modal-chages #edu").val(edu);
            $(" #modal-chages #chracter").val(chracter);
            $(" #modal-chages #apresiasi1").val(apresiasi1);
            $(" #modal-chages #apresiasi2").val(apresiasi2);
            $(" #modal-chages #apresiasi3").val(apresiasi3);
            $(" #modal-chages #ask").val(ask);
            $(" #modal-chages #berkat").val(berkat);
        });
    </script>
</body>

</html>