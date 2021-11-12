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
}
$jurnal = query("SELECT * FROM tb_personal_goal WHERE nis='$id' ORDER BY date DESC");
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
                            <a href="personalgoal.php" type="button" class="btn btn-outline-warning active mt-2">Pesonal Goal</a>
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
                                                    $tanggal = date('Y-m-d');
                                                    if ($tanggal == $row['date']) { ?>

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


    <!-- view -->
    <div class="modal fade" id="modal_detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-detail">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Personal goal Detail </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">

                    <div class="form-group">
                        <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                        <input type="text" class="form-control" id="date" name="date" readonly></input>
                    </div>
                    <div class="form-group">
                        <label for="Character-text" class="col-form-label font-weight-bold">Character Virtue :</label>
                        <textarea rows="5" type="text" class="form-control" id="karakter" readonly>
                            </textarea>
                    </div>
                    <div class="form-group">
                        <label for="doa-text" class="col-form-label font-weight-bold">Prayer :</label>
                        <textarea rows="5" type="text" class="form-control" id="doa" readonly>
                            </textarea>
                    </div>
                    <div class="form-group">
                        <label for="neutron-text" class="col-form-label font-weight-bold">Bimbel :</label>
                        <textarea rows="5" type="text" class="form-control" id="neutron" readonly>
                            </textarea>
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
    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <!-- Modal edit -->
    <div class="modal fade" id="personalgoal" tabindex="-1" aria-labelledby="personalgoal" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="personalgoal">Change Personal Goal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="nis" name="nis">
                        <div class="form-group">
                            <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                            <input type="text" class="form-control" id="date" name="date" readonly></input>
                        </div>
                        <div class="form-group">
                            <label for="character-text" class="col-form-label font-weight-bold">Character Virtue :</label>
                            <textarea type="text" rows="5" class="form-control" id="character" name="character"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="prayer-text" class="col-form-label font-weight-bold">Prayer :</label>
                            <textarea rows="5" type="text" class="form-control" id="prayer" name="prayer"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="neutron-text" class="col-form-label font-weight-bold">Bimbel :</label>
                            <textarea rows="5" type="text" class="form-control" id="neutron" name="neutron"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_update_personalgoal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <!-- Modal tambah data  -->
    <div class="modal fade" id="PGSJ" tabindex="-1" aria-labelledby="PGSJ" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="PGSJ">Personal Goal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- bungkus untuk form -->
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                        <div class="form-group">
                            <label for="Character-text" class="col-form-label font-weight-bold">Character Virtue :</label>
                            <textarea rows="5" type="text" class="form-control" id="Character" name="Character">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="prayer-text" class="col-form-label font-weight-bold">Prayer :</label>
                            <textarea rows="5" type="text" class="form-control" id="prayer" name="prayer">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="prayer-text" class="col-form-label font-weight-bold">Neutron :</label>
                            <textarea rows="5" type="text" class="form-control" id="Neutron" name="Neutron">
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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