<?php
include '../database.php';

// menambahkan data mentor
if (isset($_POST['btn_tambah_mentor'])) {
    $sumber = $_FILES['image']['tmp_name'];
    $target = '../img/fotomentor/';
    $nama_gambar = $_FILES['image']['name'];
    $name = htmlspecialchars($_POST['name']);
    $gender = htmlspecialchars($_POST['gender']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $status = htmlspecialchars($_POST['status']);
    $efata = htmlspecialchars($_POST['efata']);
    $cek_username = mysqli_query($conn, "SELECT * FROM mentor WHERE efata = '$efata'") or die($conn->error);
    if (mysqli_num_rows($cek_username) > 0) {
        echo "<script>alert('Username yang Anda pilih sudah ada, silahkan ganti yang lain');</script>";
    } else {
        if ($nama_gambar != '') {
            if (move_uploaded_file($sumber, $target . $nama_gambar)) {
                $addmentor = mysqli_query($conn, "INSERT INTO mentor (image,name,gender,username,password,status,efata) value ('$nama_gambar','$name','$gender','$username','$password','$status','$efata')");
                echo "<script>alert('Data berhasil ditambahkan!');</script>";
            }
        } else {
            $addmentor = mysqli_query($conn, "INSERT INTO mentor (name,gender,username,password,status,efata) value ('$name','$gender','$username','$password','$status','$efata')");
            echo "<script>alert('Data berhasil ditambahkan!');</script>";
        }
    }
}


// mengedit data mentor
if (isset($_POST['btn_edit_mentor'])) {
    $sumber = $_FILES['image']['tmp_name'];
    $target = '../img/fotomentor/';
    $nama_gambar = $_FILES['image']['name'];
    $name = htmlspecialchars($_POST['name']);
    $gender = htmlspecialchars($_POST['gender']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $status = htmlspecialchars($_POST['status']);
    $efata = htmlspecialchars($_POST['efata']);
    if ($nama_gambar != '') {

        if (move_uploaded_file($sumber, $target . $nama_gambar)) {
            $update = mysqli_query($conn, "UPDATE `mentor` SET `image`='$nama_gambar',`name`='$name',`gender`='$gender',`username`='$username',`password`='$password',`status`='$status',`efata`='$efata', `date` = current_timestamp WHERE `mentor`.`efata` = '$efata'");
            echo "<script>alert('Data berhasil di Edit!');</script>";
        }
    } else {
        // jika tidak mengganti gambar profile
        $update = mysqli_query($conn, "UPDATE `mentor` SET `efata`='$efata',`name`='$name',`gender`='$gender',`username`='$username',`password`='$password',`status`='$status', `date` = current_timestamp WHERE `mentor`.`efata` = '$efata'");
        echo "<script>alert('Data berhasil di Edit!');</script>";
    }
}

session_start();
// // cek apakah yang mengakses halaman ini sudah login
$mentor = mysqli_query($conn, "SELECT * FROM mentor ORDER BY date DESC");
$m = mysqli_fetch_array($mentor);
include 'template/Session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jurnal PKA</title>
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
        include './template/sidebar_menu.php';
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php
                include './template/topbar_menu.php';
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="group">
                            <h1 class="h3 mb-mb-4 text-gray-800 embed-responsive">Data Mentor</h1>
                            <div class="alert alert-warning">
                                Admin hanya menetapkan 1x di bagian Efata mentor selain efata admin bebas untuk mengedit.
                            </div>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#Mentor"><i class="fas fa-user-plus"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mydatatable" id="dataTable" width="100%">
                                    <thead class=" text-md-center">
                                        <tr>
                                            <th width="10">No</th>
                                            <th width="90">Foto</th>
                                            <th>Efata</th>
                                            <th width="150">Nama</th>
                                            <th>Gender</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" text-md-center">
                                        <?php $i = 1; ?>
                                        <?php foreach ($mentor as $data) : ?>
                                            <tr>
                                                <td width="10"><?= $i; ?></td>
                                                <td>
                                                    <img src="../img/fotomentor/<?= $data['image']; ?>" width="90">
                                                </td>
                                                <td><?= $data["efata"]; ?></td>
                                                <td width="150"><?= $data["name"]; ?></td>
                                                <td><?= $data["gender"]; ?></td>
                                                <td><?= $data["username"]; ?></td>
                                                <td><?= $data["password"]; ?></td>
                                                <td><?= $data["status"]; ?></td>
                                                <td>
                                                    <!-- Get data mentor -->
                                                    <a id="edit_mentor" data-toggle="modal" data-target="#edit" data-foto="<?= $data["image"]; ?>" data-efata="<?= $data["efata"]; ?>" data-nama="<?= $data["name"]; ?>" data-jenis_kelamin="<?= $data["gender"]; ?>" data-usnm="<?= $data["username"]; ?>" data-pss="<?= $data["password"]; ?>" data-sts="<?= $data["status"]; ?>">
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
                include './template/footer.php';
                ?>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php
    include 'models/m_logout.php';
    include 'models/m_mentor.php';
    ?>
    <script src="../vendor/jquery/jquery.min.js">
    </script>
    <!-- Core plugin JavaScript-->
    <script src=" ../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- script dataTable mentor -->
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
    <!-- Akhir script dataTable mentor -->
    <!-- script edit data mentor -->
    <script>
        $(document).on("click", "#edit_mentor", function() {
            var image = $(this).data('foto');
            var efata = $(this).data('efata');
            var name = $(this).data('nama');
            var gender = $(this).data('jenis_kelamin');
            var username = $(this).data('usnm');
            var password = $(this).data('pss');
            var status = $(this).data('sts');
            $(" #modal-edit #efata").val(efata);
            $(" #modal-edit #name").val(name);
            $(" #modal-edit #gender").val(gender);
            $(" #modal-edit #username").val(username);
            $(" #modal-edit #password").val(password);
            $(" #modal-edit #status").val(status);
            $(" #modal-edit #pict").attr("src", "../img/fotomentor/" + image);
        });
    </script>
</body>

</html>