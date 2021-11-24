<?php
include '../database.php';
// sistem submit/post di bagian catatan siswa
if (isset($_POST['catatan'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $jd_diary = htmlspecialchars($_POST['jd_diary']);
    $isi_diary = htmlspecialchars($_POST['isi_diary']);
    mysqli_query($conn, "INSERT INTO `tb_catatan`(`nis`, `judul`, `deskripsi`) VALUES ('$nis','$jd_diary','$isi_diary')");
}

// sistem edit di bagian catatan siswa
if (isset($_POST['perubahan'])) {
    $judul = htmlspecialchars($_POST['judul']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $id = htmlspecialchars($_POST['id']);
    mysqli_query($conn, "UPDATE `tb_catatan` SET `judul`='$judul',`deskripsi`='$deskripsi' WHERE `tb_catatan`.`id_catatan`='$id'");
}
// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
$catatan = mysqli_query($conn, "SELECT * FROM tb_catatan WHERE nis='$id' ORDER BY date DESC");
$catatanharian = mysqli_fetch_array($catatan);
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
                        <h1 class="h3 mb-mb-4 text-gray-800">Diary</h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#notes">Add New Diary</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="table-secondary">
                                            <th width="10">No</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Option</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($catatan as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['judul']; ?></td>
                                                <td><?= $row['deskripsi']; ?><br><br>
                                                    <a class="font-weight-bold text-primary font-italic"><?= $row['cttn_mentor']; ?></a>
                                                </td>
                                                <td><?= $row['date']; ?></td>
                                                <td>
                                                    <!-- Get data Siswa -->
                                                    <a id="edit_catatan" data-toggle="modal" data-target="#edit" data-judul="<?= $row["judul"]; ?>" data-deskripsi="<?= $row["deskripsi"]; ?>" data-id="<?= $row["id_catatan"]; ?>">
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

    <!-- Modal Log Out -->
    <?php
    include 'modal/modal_notes.php';
    include 'modal/modal_logout.php';
    include 'template/script.php';
    ?>
    <script>
        // edit catatan
        $(document).on("click", "#edit_catatan", function() {
            let judul = $(this).data('judul');
            let deskripsi = $(this).data('deskripsi');
            let id = $(this).data('id');
            $(" #modal-edit #judul").val(judul);
            $(" #modal-edit #deskripsi").val(deskripsi);
            $(" #modal-edit #id").val(id);

        });
    </script>
</body>

</html>