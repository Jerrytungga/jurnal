<?php
include '../database.php';
session_start();
include 'template/session.php';
//menampilkan data siswa dan jurnal

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Report Semester</title>
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

                    <form action="./report_final.php">
                        <div class="container-fluid">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-mb-4 text-gray-800">Please select student and semester</h1>
                            </div>
                            <select class="form-control col-2 m-2" required name="filter" id="filter" aria-label="Default select example">
                                <option value="">Select Semester</option>
                                <?php

                                $semester = mysqli_query($conn, "SELECT * FROM tb_semester ");
                                while ($thn = mysqli_fetch_array($semester)) {
                                    echo '<option value="' . $thn['thn_semester'] . '">' . $thn['keterangan'] . '</option>';
                                }
                                ?>
                                <!-- <input type="text" name="nis" required placeholder="Masukan Nis Siswa" class="form-control col-2 m-2"> -->
                            </select>
                            <select class="form-control col-2 m-2" required name="nis" id="nis" aria-label="Default select example">
                                <option value="">Select Student</option>
                                <?php

                                $daftarsiswa = mysqli_query($conn, "SELECT * FROM siswa where status='Aktif' and mentor='$id' ");
                                while ($data1 = mysqli_fetch_array($daftarsiswa)) {
                                    echo '<option value="' . $data1['nis'] . '">' . $data1['name'] . '</option>';
                                }
                                ?>
                                <!-- <input type="text" name="nis" required placeholder="Masukan Nis Siswa" class="form-control col-2 m-2"> -->
                            </select>
                            <button class="btn btn-dark mt-2 m-2" type="submit">Show</button>
                        </div>
                    </form>

                </div>

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




    <!--edit Modal -->
    <div class="modal fade" id="editreport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Presensi dan Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">

                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                        <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                        <input type="hidden" class="form-control" id="date" name="date">


                        <div class="form-group">
                            <label for="text">Presensi :</label>
                            <input type="text" class="form-control" id="absen" name="absen">
                        </div>



                        <div class="form-group">
                            <label for="text">Status :</label>
                            <select class="form-control" name="status" id="status" aria-label="Default select example">
                                <option value="">Select</option>
                                <option value="Complate">Complate</option>
                                <option value="Punishment">Punishment</option>
                                <option value="Grace">Grace</option>
                                <option value="Reward">Reward</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <h7 class="text-reset">Grace :</h7>
                            <select class="form-control" id="graces" name="graces">
                                <option value="">Select</option>
                                <?php
                                $grace = mysqli_query($conn, "SELECT * FROM tb_grace");
                                while ($datagrace = mysqli_fetch_array($grace)) {
                                    echo '<option value="' . $datagrace['grace'] . '">' . $datagrace['grace'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <h7 class="text-reset">Punishment :</h7>
                            <select class="form-control" name="ps" id="ps">
                                <option value="">Select</option>
                                <?php
                                $Punishment = mysqli_query($conn, "SELECT * FROM tb_punishment");
                                while ($dataPunishment = mysqli_fetch_array($Punishment)) {
                                    echo '<option value="' . $dataPunishment['Punishment'] . '">' . $dataPunishment['Punishment'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="edit" name="edit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Logout Modal-->
    <?php
    include 'modal/modal_logout.php';
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

        $(document).on("click", "#edit_penilaian", function() {
            let absen = $(this).data('absen');
            let status = $(this).data('status');
            let graces = $(this).data('graces');
            let date = $(this).data('date');
            let ps = $(this).data('ps');

            $(" #modal-edit #absen").val(absen);
            $(" #modal-edit #status").val(status);
            $(" #modal-edit #graces").val(graces);
            $(" #modal-edit #date").val(date);
            $(" #modal-edit #ps").val(ps);

        });
    </script>
</body>

</html>