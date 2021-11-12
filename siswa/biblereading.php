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
$jurnal = query("SELECT * FROM tb_bible_reading WHERE nis='$id' ORDER BY date DESC");
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="group">
                            <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Daily</h1>
                            <p class=" mt embed-responsive">ini adalah jurnal yang harus diisi setiap hari, 7 hari/minggu, <span class="text-danger font-weight-bold">pengisian harus singkat dan jelas !</span></p>
                            <!-- <a href="Daily.php" type="button" class="btn btn-outline-primary mt-2">Pesonal Goal</a> -->
                            <a href="revivalnote.php" type="button" class="btn btn-outline-success mt-2">Revival Note</a>
                            <a href="prayernote.php" type="button" class="btn btn-outline-warning mt-2">Prayer Note</a>
                            <a href="biblereading.php" type="button" class="btn btn-outline-danger active mt-2">Bible Reading</a>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-danger float-right" data-toggle="modal" data-target="#biblereading">Isi Jurnal</a>
                            <h5 class=" font-weight-bold text-danger">Bible Reading</h5>
                            <p>diisi sesuai dengan kitab dan jumlah pasal yang dibaca</p>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="table-secondary">
                                            <th width="10">No</th>
                                            <th>Bible</th>
                                            <th>Total OT Chapter(s)</th>
                                            <th>Total NT Chapter(s)</th>
                                            <th width="100">Date</th>
                                            <th width="250">Mentor Notes</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($jurnal as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['bible']; ?></td>
                                                <td><?= $row['total_ot']; ?></td>
                                                <td><?= $row['total_nt']; ?></td>
                                                <td><?= $row['date']; ?></td>
                                                <td>
                                                    <span class="d-inline-block text-truncate text-justify" style="max-width: 200px;">
                                                        <a class="font-weight-bold text-primary font-italic"><?= $row['catatan_mentor']; ?></a>
                                                    </span>
                                                <td>
                                                    <!-- Button trigger modal view -->
                                                    <button type="button" id="detail" class="btn btn-dark " data-toggle="modal" data-target="#modal_detail" data-nis="<?= $row['nis']; ?>" data-bible="<?= $row['bible']; ?>" data-ot="<?= $row['total_ot']; ?>" data-nt="<?= $row['total_nt']; ?>" data-date="<?= $row['date']; ?>" data-mentor="<?= $row['catatan_mentor']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>


                                                    <?php
                                                    $tanggal = date('Y-m-d');
                                                    if ($tanggal == $row['date']) { ?>
                                                        <!-- Edit Prayer Note -->
                                                        <a id="edit_bible" data-toggle="modal" data-target="#editbiblereading" data-bible="<?= $row["bible"]; ?>" data-nis="<?= $row["nis"]; ?>" data-date="<?= $row["date"]; ?>" data-ot="<?= $row["total_ot"]; ?>" data-nt="<?= $row["total_nt"]; ?>">
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
    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

    <!-- Modal bible reading-->
    <div class="modal fade" id="biblereading" tabindex="-1" aria-labelledby="biblereading" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="biblereading">Bible Reading</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- bungkus untuk form -->
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                        <div class="form-group">

                            <select class="form-control" name="kitab" id="kitab" aria-label="Default select example" required>
                                <option value="">Select Bible</option>
                                <option value="OTNT">OTNT</option>
                                <option value="OT">OT</option>
                                <option value="NT">NT</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="OT" id="OT" aria-label="Default select example" required>
                                <option value="">Select Total OT Chapter(s)</option>
                                <option value="Tidak Baca">Tidak Baca</option>
                                <option value="1 Pasal">1 Pasal</option>
                                <option value="2 Pasal">2 Pasal</option>
                                <option value="3 Pasal">3 Pasal</option>
                                <option value="4 Pasal">4 Pasal</option>
                                <option value="5 Pasal">5 Pasal</option>
                                <option value="6 Pasal">6 Pasal</option>
                                <option value="7 Pasal">7 Pasal</option>
                                <option value="8 Pasal">8 Pasal</option>
                                <option value="9 Pasal">9 Pasal</option>
                                <option value="10 Pasal">10 Pasal</option>
                                <option value="11 Pasal">11 Pasal</option>
                                <option value="12 Pasal">12 Pasal</option>
                                <option value="13 Pasal">13 Pasal</option>
                                <option value="14 Pasal">14 Pasal</option>
                                <option value="15 Pasal">15 Pasal</option>
                                <option value="16 Pasal">16 Pasal</option>
                                <option value="17 Pasal">17 Pasal</option>
                                <option value="18 Pasal">18 Pasal</option>
                                <option value="19 Pasal">19 Pasal</option>
                                <option value="20 Pasal">20 Pasal</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <select class="form-control" name="NT" id="NT" aria-label="Default select example" required>
                                <option value="">Select Total NT Chapter(s)</option>
                                <option value="Tidak Baca">Tidak Baca</option>
                                <option value="1 Pasal">1 Pasal</option>
                                <option value="2 Pasal">2 Pasal</option>
                                <option value="3 Pasal">3 Pasal</option>
                                <option value="4 Pasal">4 Pasal</option>
                                <option value="5 Pasal">5 Pasal</option>
                                <option value="6 Pasal">6 Pasal</option>
                                <option value="7 Pasal">7 Pasal</option>
                                <option value="8 Pasal">8 Pasal</option>
                                <option value="9 Pasal">9 Pasal</option>
                                <option value="10 Pasal">10 Pasal</option>
                                <option value="11 Pasal">11 Pasal</option>
                                <option value="12 Pasal">12 Pasal</option>
                                <option value="13 Pasal">13 Pasal</option>
                                <option value="14 Pasal">14 Pasal</option>
                                <option value="15 Pasal">15 Pasal</option>
                                <option value="16 Pasal">16 Pasal</option>
                                <option value="17 Pasal">17 Pasal</option>
                                <option value="18 Pasal">18 Pasal</option>
                                <option value="19 Pasal">19 Pasal</option>
                                <option value="20 Pasal">20 Pasal</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="bible_reading" class="btn btn-danger">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
 -->
    <!-- Modal edit bible reading-->
    <div class="modal fade" id="editbiblereading" tabindex="-1" aria-labelledby="biblereading" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="biblereading">Change Bible Reading</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- bungkus untuk form -->
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="nis" name="nis">
                        <div class="form-group">
                            <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                            <input type="text" class="form-control" id="date" name="date" readonly></input>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="bible" id="bible" aria-label="Default select example" required>
                                <option value="">Select Bible</option>
                                <option value="OTNT">OTNT</option>
                                <option value="OT">OT</option>
                                <option value="NT">NT</option>

                            </select>
                        </div>


                        <div class="form-group">
                            <select class="form-control" name="ot" id="ot" aria-label="Default select example" required>
                                <option value="">Select Total OT Chapter(s)</option>
                                <option value="Tidak Baca">Tidak Baca</option>
                                <option value="1 Pasal">1 Pasal</option>
                                <option value="2 Pasal">2 Pasal</option>
                                <option value="3 Pasal">3 Pasal</option>
                                <option value="4 Pasal">4 Pasal</option>
                                <option value="5 Pasal">5 Pasal</option>
                                <option value="6 Pasal">6 Pasal</option>
                                <option value="7 Pasal">7 Pasal</option>
                                <option value="8 Pasal">8 Pasal</option>
                                <option value="9 Pasal">9 Pasal</option>
                                <option value="10 Pasal">10 Pasal</option>
                                <option value="11 Pasal">11 Pasal</option>
                                <option value="12 Pasal">12 Pasal</option>
                                <option value="13 Pasal">13 Pasal</option>
                                <option value="14 Pasal">14 Pasal</option>
                                <option value="15 Pasal">15 Pasal</option>
                                <option value="16 Pasal">16 Pasal</option>
                                <option value="17 Pasal">17 Pasal</option>
                                <option value="18 Pasal">18 Pasal</option>
                                <option value="19 Pasal">19 Pasal</option>
                                <option value="20 Pasal">20 Pasal</option>
                            </select>

                        </div>


                        <div class="form-group">
                            <select class="form-control" name="nt" id="nt" aria-label="Default select example" required>
                                <option value="">Select Total NT Chapter(s)</option>
                                <option value="Tidak Baca">Tidak Baca</option>
                                <option value="1 Pasal">1 Pasal</option>
                                <option value="2 Pasal">2 Pasal</option>
                                <option value="3 Pasal">3 Pasal</option>
                                <option value="4 Pasal">4 Pasal</option>
                                <option value="5 Pasal">5 Pasal</option>
                                <option value="6 Pasal">6 Pasal</option>
                                <option value="7 Pasal">7 Pasal</option>
                                <option value="8 Pasal">8 Pasal</option>
                                <option value="9 Pasal">9 Pasal</option>
                                <option value="10 Pasal">10 Pasal</option>
                                <option value="11 Pasal">11 Pasal</option>
                                <option value="12 Pasal">12 Pasal</option>
                                <option value="13 Pasal">13 Pasal</option>
                                <option value="14 Pasal">14 Pasal</option>
                                <option value="15 Pasal">15 Pasal</option>
                                <option value="16 Pasal">16 Pasal</option>
                                <option value="17 Pasal">17 Pasal</option>
                                <option value="18 Pasal">18 Pasal</option>
                                <option value="19 Pasal">19 Pasal</option>
                                <option value="20 Pasal">20 Pasal</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_editbible" class="btn btn-danger">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <!-- view -->
    <div class="modal fade" id="modal_detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-detail">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Bible Reading Detail </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">

                    <div class="form-group">
                        <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                        <p type="text" class="form-control" id="date" readonly></p>
                    </div>
                    <div class="form-group">
                        <label for="date-text" class="col-form-label font-weight-bold">Bible :</label>
                        <p type="text" class="form-control" id="bible" readonly></p>
                    </div>
                    <div class="form-group">
                        <label for="date-text" class="col-form-label font-weight-bold">Total OT Chapter(s) :</label>
                        <p type="text" class="form-control" id="ot" readonly></p>
                    </div>
                    <div class="form-group">
                        <label for="date-text" class="col-form-label font-weight-bold">Total NT Chapter(s) :</label>
                        <p type="text" class="form-control" id="nt" readonly></p>
                    </div>

                    <div class="form-group">
                        <label for="notes-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                        <textarea rows="5" type="text" class="form-control font-weight-bold text-primary font-italic" id="mentor" readonly>
                            </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modal Log out -->
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

        $(document).on("click", "#edit_bible", function() {

            let nis = $(this).data('nis');
            let bible = $(this).data('bible');
            let ot = $(this).data('ot');
            let nt = $(this).data('nt');
            let date = $(this).data('date');
            $(" #modal-edit #nis").val(nis);
            $(" #modal-edit #bible").val(bible);
            $(" #modal-edit #ot").val(ot);
            $(" #modal-edit #nt").val(nt);
            $(" #modal-edit #date").val(date);

        });

        $(document).on("click", "#detail", function() {
            let nis = $(this).data('nis');
            let bible = $(this).data('bible');
            let ot = $(this).data('ot');
            let nt = $(this).data('nt');
            let mentor = $(this).data('mentor');
            let date = $(this).data('date');
            $(" #modal-detail #nis").text(nis);
            $(" #modal-detail #bible").text(bible);
            $(" #modal-detail #ot").text(ot);
            $(" #modal-detail #nt").text(nt);
            $(" #modal-detail #mentor").val(mentor);
            $(" #modal-detail #date").text(date);

        });
    </script>
</body>

</html>