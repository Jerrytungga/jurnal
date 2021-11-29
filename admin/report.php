<?php
include '../database.php';
// cek apakah yang mengakses halaman ini sudah login
session_start();
// // cek apakah yang mengakses halaman ini sudah login
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

$report = mysqli_query($conn, "SELECT * FROM tb_reportweekly ORDER BY date DESC");
$weekl = mysqli_fetch_array($report);


if (isset($_POST['week'])) {
    $week = $_POST['week'];

    if ($week != null) {

        $report = mysqli_query($conn, "SELECT * FROM tb_reportweekly WHERE keterangan LIKE '$week' ORDER BY date DESC");
    } else {

        $report = mysqli_query($conn, "SELECT * FROM tb_reportweekly ORDER BY date DESC");
        $weekl = mysqli_fetch_array($report);
    }
} else {

    $report = mysqli_query($conn, "SELECT * FROM tb_reportweekly ORDER BY date DESC");
    $weekl = mysqli_fetch_array($report);
}

// if (isset($_POST['reset'])) {
//     $report = mysqli_query($conn, "SELECT * FROM tb_reportweekly ORDER BY date DESC");
//     $weekl = mysqli_fetch_array($report);
// }



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Report Jurnal</title>
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
                            <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Jurnal Report</h1>
                            <a href="cetak.php?week=<?= $week ?>" class="btn btn-primary" target="blank" type="button"><i class="fas fa-download fa-sm text-white-50"></i> Download Report</a>

                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <h6 class=" font-weight-bold text-primary">Please Select Week</h6>
                            <form action="" method="POST" id="form_id" class="form-inline">
                                <?php
                                if (isset($_POST['week'])) {
                                    $week = $_POST['week'];

                                ?>
                                    <select type="text" class="form-control col-md-2" id="week" name="week" onChange="document.getElementById('form_id').submit();">
                                        <option value="%">Select All Weeks</option>
                                        <option value="Week 1" <?php if ($week == "Week 1") { ?> Selected <?php } ?>> Week 1 </option>
                                        <option value="Week 2" <?php if ($week == "Week 2") { ?> Selected <?php } ?>>Week 2</option>
                                        <option value="Week 3" <?php if ($week == "Week 3") { ?> Selected <?php } ?>>Week 3 </option>
                                        <option value="week 4" <?php if ($week == "Week 4") { ?> Selected <?php } ?>>Week 4 </option>
                                        <option value="Week 5" <?php if ($week == "Week 5") { ?> Selected <?php } ?>>Week 5 </option>
                                        <option value="Week 6" <?php if ($week == "Week 6") { ?> Selected <?php } ?>>Week 6</option>
                                        <option value="Week 7" <?php if ($week == "Week 7") { ?> Selected <?php } ?>>Week 7</option>
                                        <option value="Week 8" <?php if ($week == "Week 8") { ?> Selected <?php } ?>>Week 8</option>
                                        <option value="Week 9" <?php if ($week == "Week 9") { ?> Selected <?php } ?>>Week 9</option>
                                        <option value="Week 10" <?php if ($week == "Week 10") { ?> Selected <?php } ?>>Week 10</option>
                                        <option value="Week 11" <?php if ($week == "Week 11") { ?> Selected <?php } ?>>Week 11</option>
                                        <option value="Week 12" <?php if ($week == "Week 12") { ?> Selected <?php } ?>>Week 12</option>
                                        <option value="Week 13" <?php if ($week == "Week 13") { ?> Selected <?php } ?>>Week 13</option>
                                        <option value="Week 14" <?php if ($week == "Week 14") { ?> Selected <?php } ?>>Week 14</option>
                                        <option value="Week 15" <?php if ($week == "Week 15") { ?> Selected <?php } ?>>Week 15</option>
                                        <option value="Week 16" <?php if ($week == "Week 16") { ?> Selected <?php } ?>>Week 16</option>
                                        <option value="Week 17" <?php if ($week == "Week 17") { ?> Selected <?php } ?>>Week 17</option>
                                        <option value="Week 18" <?php if ($week == "Week 18") { ?> Selected <?php } ?>>Week 18</option>
                                        <option value="Week 19" <?php if ($week == "Week 19") { ?> Selected <?php } ?>>Week 19</option>
                                        <option value="Week 20" <?php if ($week == "Week 20") { ?> Selected <?php } ?>>Week 20</option>
                                        <option value="Week 21" <?php if ($week == "Week 21") { ?> Selected <?php } ?>>Week 21</option>
                                        <option value="Week 22" <?php if ($week == "Week 22") { ?> Selected <?php } ?>>Week 22</option>
                                        <option value="Week 23" <?php if ($week == "Week 23") { ?> Selected <?php } ?>>Week 23</option>
                                        <option value="Week 24" <?php if ($week == "Week 24") { ?> Selected <?php } ?>>Week 24</option>
                                        <option value="Week 25" <?php if ($week == "Week 25") { ?> Selected <?php } ?>>Week 25</option>
                                        <option value="Week 26" <?php if ($week == "Week 26") { ?> Selected <?php } ?>>Week 26</option>
                                        <option value="Week 27" <?php if ($week == "Week 27") { ?> Selected <?php } ?>>Week 27</option>
                                        <option value="Week 28" <?php if ($week == "Week 28") { ?> Selected <?php } ?>>Week 28</option>
                                        <option value="Week 29" <?php if ($week == "Week 29") { ?> Selected <?php } ?>>Week 29</option>
                                        <option value="Week 30" <?php if ($week == "Week 30") { ?> Selected <?php } ?>>Week 30</option>
                                        <option value="Week 31" <?php if ($week == "Week 31") { ?> Selected <?php } ?>>Week 31</option>
                                        <option value="Week 32" <?php if ($week == "Week 32") { ?> Selected <?php } ?>>Week 32</option>
                                        <option value="Week 33" <?php if ($week == "Week 33") { ?> Selected <?php } ?>>Week 33</option>
                                        <option value="Week 34" <?php if ($week == "Week 34") { ?> Selected <?php } ?>>Week 34</option>
                                        <option value="Week 35" <?php if ($week == "Week 35") { ?> Selected <?php } ?>>Week 35</option>
                                        <option value="Week 36" <?php if ($week == "Week 36") { ?> Selected <?php } ?>>Week 36</option>
                                        <option value="Week 37" <?php if ($week == "Week 37") { ?> Selected <?php } ?>>Week 37</option>
                                        <option value="Week 38" <?php if ($week == "Week 38") { ?> Selected <?php } ?>>Week 38</option>
                                        <option value="Week 39" <?php if ($week == "Week 39") { ?> Selected <?php } ?>>Week 39</option>
                                        <option value="Week 40" <?php if ($week == "Week 40") { ?> Selected <?php } ?>>Week 40</option>
                                        <option value="Week 41" <?php if ($week == "Week 41") { ?> Selected <?php } ?>>Week 41</option>
                                        <option value="Week 42" <?php if ($week == "Week 42") { ?> Selected <?php } ?>>Week 42</option>
                                        <option value="Week 43" <?php if ($week == "Week 43") { ?> Selected <?php } ?>>Week 43</option>
                                        <option value="Week 44" <?php if ($week == "Week 44") { ?> Selected <?php } ?>>Week 44</option>
                                        <option value="Week 45" <?php if ($week == "Week 45") { ?> Selected <?php } ?>>Week 45</option>
                                        <option value="Week 46" <?php if ($week == "Week 46") { ?> Selected <?php } ?>>Week 46</option>
                                        <option value="Week 47" <?php if ($week == "Week 47") { ?> Selected <?php } ?>>Week 47</option>
                                        <option value="Week 48" <?php if ($week == "Week 48") { ?> Selected <?php } ?>>Week 48</option>
                                    </select>
                                <?php
                                } else {
                                ?>
                                    <select type="text" class="form-control col-md-2" id="week" name="week" onChange="document.getElementById('form_id').submit();">
                                        <option value="%">Select All Weeks</option>
                                        <option value="Week 1">Week 1</option>
                                        <option value="Week 2">Week 2</option>
                                        <option value="Week 3">Week 3</option>
                                        <option value="week 4">Week 4</option>
                                        <option value="Week 5">Week 5</option>
                                        <option value="Week 6">Week 6</option>
                                        <option value="Week 7">Week 7</option>
                                        <option value="Week 8">Week 8</option>
                                        <option value="Week 9">Week 9</option>
                                        <option value="Week 10">Week 10</option>
                                        <option value="Week 11">Week 11</option>
                                        <option value="Week 12">Week 12</option>
                                        <option value="Week 13">Week 13</option>
                                        <option value="Week 14">Week 14</option>
                                        <option value="Week 15">Week 15</option>
                                        <option value="Week 16">Week 16</option>
                                        <option value="Week 17">Week 17</option>
                                        <option value="Week 18">Week 18</option>
                                        <option value="Week 19">Week 19</option>
                                        <option value="Week 20">Week 20</option>
                                        <option value="Week 21">Week 21</option>
                                        <option value="Week 22">Week 22</option>
                                        <option value="Week 23">Week 23</option>
                                        <option value="Week 24">Week 24</option>
                                        <option value="Week 25">Week 25</option>
                                        <option value="Week 26">Week 26</option>
                                        <option value="Week 27">Week 27</option>
                                        <option value="Week 28">Week 28</option>
                                        <option value="Week 29">Week 29</option>
                                        <option value="Week 30">Week 30</option>
                                        <option value="Week 31">Week 31</option>
                                        <option value="Week 32">Week 32</option>
                                        <option value="Week 33">Week 33</option>
                                        <option value="Week 34">Week 34</option>
                                        <option value="Week 35">Week 35</option>
                                        <option value="Week 36">Week 36</option>
                                        <option value="Week 37">Week 37</option>
                                        <option value="Week 38">Week 38</option>
                                        <option value="Week 39">Week 39</option>
                                        <option value="Week 40">Week 40</option>
                                        <option value="Week 41">Week 41</option>
                                        <option value="Week 42">Week 42</option>
                                        <option value="Week 43">Week 43</option>
                                        <option value="Week 44">Week 44</option>
                                        <option value="Week 45">Week 45</option>
                                        <option value="Week 46">Week 46</option>
                                        <option value="Week 47">Week 47</option>
                                        <option value="Week 48">Week 48</option>
                                    </select>
                                <?php } ?>

                                <!-- <button type="submit" name="reset" value="Reset" class="btn btn-danger ml-3">Reset</button> -->
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr class="table-warning">
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
                                            <th>Sanksi</th>
                                            <th width="200">Date</th>

                                        </tr>
                                    </thead>

                                    <tbody class="text-center">
                                        <?php $i = 1; ?>
                                        <?php foreach ($report as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['name']; ?></td>
                                                <td><?= $row['presensi']; ?></td>
                                                <td><?= $row['jurnal_daily']; ?></td>
                                                <td><?= $row['jurnal_weekly']; ?></td>
                                                <td><?= $row['jurnal_monthly']; ?></td>
                                                <td><?= $row['virtue']; ?></td>
                                                <td><?= $row['living_buku']; ?></td>
                                                <td><?= $row['living_sepatu_handuk']; ?></td>
                                                <td><?= $row['living_ranjang']; ?></td>
                                                <td><?= $row['total']; ?></td>
                                                <td><?= $row['status']; ?></td>
                                                <td><?= $row['keterangan']; ?></td>
                                                <td><a class="font-weight-bold text-danger font-italic"><?= $row['sanksi']; ?> <?= $row['punisment']; ?></a>
                                                </td>
                                                <td><?= $row['date']; ?>


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
                include './template/footer.php';
                ?>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Modal Log Out -->
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
            $('#dataTable').DataTable({
                scrollY: 800,
                scrollX: true,
                scrollCollapse: true,
                paging: true
            });
        });
    </script>

</body>

</html>