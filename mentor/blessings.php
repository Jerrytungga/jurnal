<?php
include '../database.php';
include 'modal/function.php';
session_start();
// // cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['role'])) {
    echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu!');window.location='../../index.php'</script>";
} else if ($_SESSION['role'] == "Siswa") {
    header("location:../siswa/index.php");
} else if ($_SESSION['role'] == "Admin") {
    header("location:../admin/index.php");
} else {
    $id = $_SESSION['id_Mentor'];
    $get_data = mysqli_query($conn, "SELECT * FROM mentor WHERE efata='$id'");
    $data = mysqli_fetch_array($get_data);
}
//menampilkan data siswa dan jurnal
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
$jurnal = query("SELECT * FROM tb_blessings WHERE nis='$nis' ORDER BY date DESC");
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
                        <h1 class="h3 mb-mb-4 text-gray-800">Jurnal Monthly</h1>
                    </div>

                    <div class="btn-group mb-4" role="group" aria-label="Basic outlined example">
                        <a href="blessings.php" type="button" class="btn btn-outline-primary active">Blessings</a>

                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th>What I Gain On God</th>
                                            <th class="bg-warning">Point</th>
                                            <th>What I Learn On Education</th>
                                            <th class="bg-warning">Point</th>
                                            <th>What I learn On Character & Virtue</th>
                                            <th class="bg-warning">Point</th>
                                            <th>What I Appreciate Toward Brother & Sister</th>
                                            <th class="bg-warning">Point</th>
                                            <th>What l Appreciate Toward My Trainers/Mentors</th>
                                            <th class="bg-warning">Point</th>
                                            <th>What I Appreciate Toward Saints</th>
                                            <th class="bg-warning">Point</th>
                                            <th>What I Want To Ask</th>
                                            <th class="bg-warning">Point</th>
                                            <th>What I Learn the most This Month</th>
                                            <th class="bg-warning">Point</th>
                                            <th>Date</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($jurnal as $row) : ?>
                                            <tr>

                                                <td><?= $i; ?></td>
                                                <td><?= $row['what_i_gain_on_god']; ?><br><br>
                                                    <a class="font-weight-bold text-primary font-italic"><?= $row['cttn1']; ?></a>
                                                </td>
                                                <td></td>
                                                <td><?= $row['what_i_learn_on_education']; ?><br><br>
                                                    <a class="font-weight-bold text-primary font-italic"><?= $row['cttn2']; ?></a>
                                                </td>
                                                <td></td>
                                                <td><?= $row['what_i_learn_on_character_and_virtue']; ?><br><br>
                                                    <a class="font-weight-bold text-primary font-italic"><?= $row['cttn3']; ?></a>
                                                </td>
                                                <td></td>
                                                <td><?= $row['what_l_appreciate_toward_brother_sister']; ?><br><br>
                                                    <a class="font-weight-bold text-primary font-italic"><?= $row['cttn4']; ?></a>
                                                </td>
                                                <td></td>
                                                <td><?= $row['what_l_appreciate_toward_my_trainers']; ?><br><br>
                                                    <a class="font-weight-bold text-primary font-italic"><?= $row['cttn5']; ?></a>
                                                </td>
                                                <td></td>
                                                <td><?= $row['what_l_appreciate_toward_saints']; ?><br><br>
                                                    <a class="font-weight-bold text-primary font-italic"><?= $row['cttn6']; ?></a>
                                                </td>
                                                <td></td>
                                                <td><?= $row['what_I_want_to_ask']; ?><br><br>
                                                    <a class="font-weight-bold text-primary font-italic"><?= $row['cttn7']; ?></a>
                                                </td>
                                                <td></td>
                                                <td><?= $row['what_i_learn_the_most_this_month']; ?><br><br>
                                                    <a class="font-weight-bold text-primary font-italic"><?= $row['cttn8']; ?></a>
                                                </td>
                                                <td></td>
                                                <td><?= $row['date']; ?></td>

                                                <td>
                                                    <!-- Get data personal siswa -->
                                                    <a id="edit_blessings" data-toggle="modal" data-target="#blessings" data-god="<?= $row["what_i_gain_on_god"]; ?>" data-nis="<?= $row["nis"]; ?>" data-cttn1="<?= $row["cttn1"]; ?>" data-edu="<?= $row["what_i_learn_on_education"]; ?>" data-cttn2="<?= $row["cttn2"]; ?>" data-chracter="<?= $row["what_i_learn_on_character_and_virtue"]; ?>" data-cttn3="<?= $row["cttn3"]; ?>" data-date="<?= $row["date"]; ?>" data-apresiasi1="<?= $row["what_l_appreciate_toward_brother_sister"]; ?>" data-cttn4="<?= $row["cttn4"]; ?>" data-apresiasi2="<?= $row["what_l_appreciate_toward_my_trainers"]; ?>" data-cttn5="<?= $row["cttn5"]; ?>" data-apresiasi3="<?= $row["what_l_appreciate_toward_saints"]; ?>" data-cttn6="<?= $row["cttn6"]; ?>" data-ask="<?= $row["what_I_want_to_ask"]; ?>" data-cttn7="<?= $row["cttn7"]; ?>" data-berkat="<?= $row["what_i_learn_the_most_this_month"]; ?>" data-cttn8="<?= $row["cttn8"]; ?>">
                                                        <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button></a>
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
    include 'modal/modal_blessings.php';
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
        });
    </script>

</body>

</html>