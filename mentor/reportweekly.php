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
$report = mysqli_query($conn, "SELECT * FROM tb_reportweekly WHERE nis='$nis' ORDER BY date DESC");

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
                        <h1 class="h3 mb-mb-4 text-gray-800">Jurnal Report <?= $siswa2['name']; ?></h1>
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download Report</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-info  float-left" data-toggle="modal" data-target="#report">Isi Report</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th>Name</th>
                                            <th>Presensi</th>
                                            <th>Jurnal Daily</th>
                                            <th>Jurnal Weekly</th>
                                            <th>Jurnal Monthly</th>
                                            <th>Virtue</th>
                                            <th>Living Lemari Buku</th>
                                            <th>Living Rak Sepatu dan Handuk</th>
                                            <th>Living Ranjang</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Date</th>

                                        </tr>
                                    </thead>

                                    <tbody>
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
                                                <td><?= $row['date']; ?></td>

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

    <!-- Modal -->
    <div class="modal fade" id="report" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Report Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">

                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                        <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">

                        <div class="form-group">
                            <label for="text">Name :</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $siswa2['name']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="text">Presensi :</label>
                            <input type="text" class="form-control" id="presensi" name="presensi">
                        </div>

                        <div class="form-group">
                            <label for="text">Jurnal Daily :</label>
                            <input type="text" class="form-control" id="jurnaldaily" name="jurnaldaily">
                        </div>

                        <div class="form-group">
                            <label for="text">Jurnal Weekly :</label>
                            <input type="text" class="form-control" id="jurnalweekly" name="jurnalweekly">
                        </div>

                        <div class="form-group">
                            <label for="text">Jurnal Monthly :</label>
                            <input type="text" class="form-control" id="jurnalMonthly" name="jurnalMonthly">
                        </div>

                        <div class="form-group">
                            <label for="text">Virtue :</label>
                            <input type="text" class="form-control" id="virtue" name="virtue">
                        </div>

                        <div class="form-group">
                            <label for="text">Living Lemari Buku :</label>
                            <input type="text" class="form-control" id="lemari" name="lemari">
                        </div>

                        <div class="form-group">
                            <label for="text">Living Lemari Rak Sepatu & Handuk :</label>
                            <input type="text" class="form-control" id="sepatu" name="sepatu">
                        </div>

                        <div class="form-group">
                            <label for="text">Living Ranjang :</label>
                            <input type="text" class="form-control" id="renjang" name="ranjang">
                        </div>

                        <div class="form-group">
                            <label for="text">Total :</label>
                            <input type="text" class="form-control" id="total" name="total">
                        </div>


                        <div class="form-group">
                            <label for="text">Status :</label>
                            <select class="form-control" name="status" id="status" aria-label="Default select example" required>
                                <option value="">Keterangan</option>
                                <option value="Punishment">Punishment</option>
                                <option value="Grace">Grace</option>
                                <option value="Reward">Reward</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="text">Keterangan :</label>
                            <select type="text" class="form-control" id="Keterangan" name="Keterangan">
                                <option selected>Select</option>
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="input">Save</button>
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
    </script>
</body>

</html>