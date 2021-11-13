<?php
include '../database.php';
include 'modal/function.php';
// cek apakah yang mengakses halaman ini sudah login
session_start();
// // cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['role'])) {
    echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu!');
    window.location='../index.php'</script>";
    //echo "tanpa role";
} else if ($_SESSION['role'] == "Mentor") {
    header("location:../mentor/index.php");
} else if ($_SESSION['role'] == "Admin") {
    header("location:../admin/index.php");
} else {
    $id = $_SESSION['id_Siswa'];
    $get_data = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$id'");
    $data = mysqli_fetch_array($get_data);
    // echo "else";
}
$jurnal = query("SELECT * FROM tb_blessings WHERE nis='$id' ORDER BY date DESC");
?>
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
                                        <tr class="table-secondary">
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
                                                    $tanggal = date('Y-m-d');
                                                    if ($tanggal == $row['date']) { ?>

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

    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <!-- Modal blessings -->
    <div class="modal fade" id="Blessings" tabindex="-1" aria-labelledby="Blessings" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Blessings">Blessings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- bungkus untuk form -->
                <form action="" method="POST">
                    <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="god-text" class="col-form-label font-weight-bold">What I gain on God :</label>
                            <textarea rows="5" type="text" class="form-control" id="god" name="god"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="education-text" class="col-form-label font-weight-bold">What I learn on Education :</label>
                            <textarea rows="5" type="text" class="form-control" id="education" name="education"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="character-text" class="col-form-label font-weight-bold">What I learn on character & Virtue :</label>
                            <textarea rows="5" type="text" class="form-control" id="character" name="character"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="appreciate1-text" class="col-form-label font-weight-bold">What I Appreciate Toward Brother & Sisters :</label>
                            <textarea rows="5" type="text" class="form-control" id="appreciate1" name="appreciate1"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="appreciate2-text" class="col-form-label font-weight-bold">What I Appreciate Toward My Trainers/Mentors :</label>
                            <textarea rows="5" type="text" class="form-control" id="appreciate2" name="appreciate2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="appreciate3-text" class="col-form-label font-weight-bold">What I Appreciate Toward Saints :</label>
                            <textarea rows="5" type="text" class="form-control" id="appreciate3" name="appreciate3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ask-text" class="col-form-label font-weight-bold">What I Want To Ask :</label>
                            <textarea rows="5" type="text" class="form-control" id="ask" name="ask"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="thismonth-text" class="col-form-label font-weight-bold">What I Learn the most This Month :</label>
                            <textarea rows="5" type="text" class="form-control" id="thismonth" name="thismonth"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="blessing" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- detail god -->
    <div class="modal fade" id="what_i_gain_on_god" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">What I gain on God :</label>
                        <textarea rows="5" type="text" class="form-control" id="god" name="god" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- detail education-->
    <div class="modal fade" id="what_i_learn_on_education" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">What I learn on Education :</label>
                        <textarea rows="5" type="text" class="form-control" id="edu" name="edu" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- detail learn on character & Virtue-->
    <div class="modal fade" id="what_i_learn_on_character_and_virtue" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">What I learn on character & Virtue :</label>
                        <textarea rows="5" type="text" class="form-control" id="learnoncharacter" name="learnoncharacter" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- detail what_l_appreciate_toward_brother_sister -->
    <div class="modal fade" id="what_l_appreciate_toward_brother_sister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">What I Appreciate Toward Brother & Sisters :</label>
                        <textarea rows="5" type="text" class="form-control" id="appreciate" name="appreciate" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- detail What I Appreciate Toward My Trainers/Mentors -->
    <div class="modal fade" id="WhatIAppreciateTowardMyTrainers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">What I Appreciate Toward My Trainers/Mentors :</label>
                        <textarea rows="5" type="text" class="form-control" id="appreciate1" name="appreciate1" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- detail What I Appreciate Toward My Trainers/Mentors -->
    <div class="modal fade" id="WhatIAppreciateTowardSaints" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">What I Appreciate Toward Saints :</label>
                        <textarea rows="5" type="text" class="form-control" id="appreciate2" name="appreciate2" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- detail What I Appreciate Toward My Trainers/Mentors -->
    <div class="modal fade" id="WhatIWantToAsk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">What I Want To Ask :</label>
                        <textarea rows="5" type="text" class="form-control" id="ask" name="ask" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- detail What I Appreciate Toward My Trainers/Mentors -->
    <div class="modal fade" id="what_i_learn_the_most_this_month" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">What I Learn the most This Month :</label>
                        <textarea rows="5" type="text" class="form-control" id="whatlearnthismonht" name="whatlearnthismonht" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="blessings" tabindex="-1" aria-labelledby="blessings" aria-hidden="true">
        <div class="modal-dialog" id="modal-chages">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blessings">Changes Blessings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- bungkus untuk form inputan personal goal-->
                <form action="" method="POST">
                    <input type="hidden" class="form-control" id="nis" name="nis">

                    <div class="modal-body">
                        <div class="form-group">
                            <h7 class="text-reset" for="date">Date :</h7>
                            <input type="text" class="form-control" id="date" name="date" readonly>

                        </div>

                        <div class="form-group">
                            <label class="text-reset" for="god">What I Gain On God :</label>
                            <textarea rows="5" type="text" class="form-control" id="god" name="god" placeholder="What I Gain On God"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="text-reset" for="edu">What I Learn On Education :</label>
                            <textarea rows="5" type="text" class="form-control" id="edu" name="edu" placeholder="What I Learn On Education"></textarea>
                        </div>


                        <div class="form-group">
                            <label class="text-reset" for="chracter">What L learn On Character & Virtue :</label>
                            <textarea rows="5" type="text" class="form-control" id="chracter" name="chracter" placeholder="What L learn On Character & Virtue"></textarea>
                        </div>


                        <div class="form-group">
                            <label class="text-reset" for="apresiasi1">What L Appreciate Toward Brother & Sister :</label>
                            <textarea rows="5" type="text" class="form-control" id="apresiasi1" name="apresiasi1" placeholder="What L Appreciate Toward Brother & Sister"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="text-reset" for="apresiasi2">What l Appreciate Toward My Trainers/Mentors :</label>
                            <textarea rows="5" type="text" class="form-control" id="apresiasi2" name="apresiasi2" placeholder="What l Appreciate Toward My Trainers/Mentors"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="text-reset" for="apresiasi3">What I Appreciate Toward Saints :</label>
                            <textarea rows="5" type="text" class="form-control" id="apresiasi3" name="apresiasi3" placeholder="What I Appreciate Toward Saints"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="text-reset" for="ask">What I Want To Ask :</label>
                            <textarea rows="5" type="text" class="form-control" id="ask" name="ask" placeholder="What I Want To Ask"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="text-reset" for="berkat">What I Learn the most This Month :</label>
                            <textarea rows="5" type="text" class="form-control" id="berkat" name="berkat" placeholder="What I Learn the most This Month"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_blessings" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <?php
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