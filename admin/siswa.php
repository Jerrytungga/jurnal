<?php
include '../database.php';
// menambahkan data siswa
if (isset($_POST['btn_tambah_siswa'])) {
  $sumber = $_FILES['image']['tmp_name'];
  $target = '../img/fotosiswa/';
  $nama_gambar = $_FILES['image']['name'];
  $nis = htmlspecialchars($_POST['nis']);
  $name = htmlspecialchars($_POST['name']);
  $angkatan = htmlspecialchars($_POST['angkatan']);
  $gender = htmlspecialchars($_POST['gender']);
  $jurusan = htmlspecialchars($_POST['jurusan']);
  $bimbel = htmlspecialchars($_POST['bimbel']);
  $mentor = htmlspecialchars($_POST['mentor']);
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);
  $status = htmlspecialchars($_POST['status']);
  $cek_username = mysqli_query($conn, "SELECT * FROM siswa WHERE username = '$username'") or die($conn->error);
  if (mysqli_num_rows($cek_username) > 0) {
    $notifgagal = $_SESSION['gagal'] = 'Username yang Anda pilih sudah ada';
  } else {
    if ($nama_gambar != '') {
      if (move_uploaded_file($sumber, $target . $nama_gambar)) {
        $addtotable = mysqli_query($conn, "INSERT INTO `siswa`(`image`, `nis`, `name`, `angkatan`, `gender`, `jurusan`, `bimbel`, `mentor`, `username`, `password`, `status`) VALUES ('$nama_gambar','$nis','$name','$angkatan','$gender','$jurusan','$bimbel','$mentor','$username','$password','$status')");
        if ($addtotable) {
          $notifsukses = $_SESSION['sukses'] =  'Data Berhasil Disimpan';
        } else {
          $notifgagal = $_SESSION['gagal'] = 'Data Gagal Disimpan';
        }
      }
    } else {
      $addtotable = mysqli_query($conn, "INSERT INTO `siswa`(`nis`, `name`, `angkatan`, `gender`, `jurusan`, `bimbel`, `mentor`, `username`, `password`, `status`) VALUES ('$nis','$name','$angkatan','$gender','$jurusan','$bimbel','$mentor','$username','$password','$status')");
      if ($addtotable) {
        $notifsukses = $_SESSION['sukses'] =  'Data Berhasil Disimpan';
      } else {
        $notifgagal = $_SESSION['gagal'] = 'Data Gagal Disimpan';
      }
    }
  }
}

// mengedit data siswa
if (isset($_POST['btn_edit_siswa'])) {
  $sumber = $_FILES['image']['tmp_name'];
  $target = '../img/fotosiswa/';
  $nama_gambar = $_FILES['image']['name'];
  $nis = htmlspecialchars($_POST['nis']);
  $name = htmlspecialchars($_POST['name']);
  $angkatan = htmlspecialchars($_POST['angkatan']);
  $gender = htmlspecialchars($_POST['gender']);
  $jurusan = htmlspecialchars($_POST['jurusan']);
  $bimbel = htmlspecialchars($_POST['bimbel']);
  $mentor = htmlspecialchars($_POST['mentor']);
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);
  $status = htmlspecialchars($_POST['status']);
  if ($nama_gambar != '') {
    if (move_uploaded_file($sumber, $target . $nama_gambar)) {

      // jika ingin mengganti gambar profile
      $editsiswa = mysqli_query($conn, "UPDATE `siswa` SET `image`='$nama_gambar',`nis`='$nis',`name`='$name',`angkatan`='$angkatan',`gender`='$gender',`jurusan`='$jurusan',`bimbel`='$bimbel',`mentor`='$mentor',`username`='$username',`password`='$password',`status`='$status' WHERE `siswa`.`nis` = '$nis'");
      if ($editsiswa) {
        $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
      } else {
        $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil Di Edit!';
      }
    }
  } else {
    // jika tidak mengganti gambar profile
    $editsiswa = mysqli_query($conn, "UPDATE `siswa` SET `nis`='$nis',`name`='$name',`mentor`='$mentor',`angkatan`='$angkatan',`gender`='$gender',`jurusan`='$jurusan',`bimbel`='$bimbel',`username`='$username',`password`='$password',`status`='$status' WHERE `siswa`.`nis` = '$nis'");
    if ($editsiswa) {
      $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
    } else {
      $notifgagaledit = $_SESSION['gagal'] = 'Mohon Maaf Data Tidak Berhasil Di Edit!';
    }
  }
}

if (isset($_POST['simpan'])) {
  $angkatansiswa = htmlspecialchars($_POST['angkatan']);
  $statusangkatan = htmlspecialchars($_POST['status']);
  $updateangkatan = mysqli_query($conn, "UPDATE siswa SET status='$statusangkatan' WHERE angkatan='$angkatansiswa'");
  if ($updateangkatan) {
    $notifsuksesedit = $_SESSION['sukses'] = 'Tersimpan!';
  } else {
    $notifgagaledit = $_SESSION['gagal'] = 'Data Angkatan Gagal di Update!';
  }
}
$siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY date DESC");
$s = mysqli_fetch_array($siswa);
session_start();
include 'template/Session.php';
// code untuk select option data mentor
$sql_mentor = mysqli_query($conn, "SELECT * FROM mentor WHERE status= 'Aktif'") or die(mysqli_error($conn));
//code untuk select option data jurusan
$sql_jurusan = mysqli_query($conn, "SELECT * FROM tb_jurusan") or die(mysqli_error($conn));
//code untuk select option data angkatan
$sql_angkatan = mysqli_query($conn, "SELECT * FROM tb_angkatan") or die(mysqli_error($conn));
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
    <!-- Sidebar -->
    <?php
    include './template/sidebar_menu.php';
    ?>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <?php
        include './template/topbar_menu.php';
        ?>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid ">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="group">
              <h1 class="h3 mb-mb-4 text-uppercase embed-responsive">Data Siswa</h1>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4 ">
            <div class="card-header py-3 ">
              <button href="" class="btn btn-primary mt-2 " data-toggle="modal" data-target="#siswa"><i class="fas fa-user-plus"></i> Tambah Siswa</button>
              <button type="button" class="btn btn-danger d-inline mt-2" data-toggle="modal" data-target="#exampleModal">
                Aktifkan Dan Nonaktifkan Angkatan Siswa
              </button>
              <button type="button" target-blank class="btn btn-success d-inline mt-2" data-toggle="modal" data-target="#QR">
                Cetak Qr Code Siswa
              </button>

            </div>
            <div class="card-body">
              <div class="table-responsive overflow-hidden">
                <table class="table table-bordered mydatatable" id="dataTable" width="100%">
                  <thead class=" text-md-center bg-dark text-light">
                    <tr>
                      <th>No</th>
                      <th width="90">Gambar</th>
                      <th>Nis</th>
                      <th witdh="50">Nama</th>
                      <th>Angkatan</th>
                      <th>Gender</th>
                      <th>Jurusan</th>
                      <th>Bimbel</th>
                      <th>Mentor</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody class=" text-md-center">
                    <?php $i = 1;
                    function mentor($mentor)
                    {
                      global $conn;
                      $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mentor WHERE efata='$mentor'"));
                      return $sqly['name'];
                    }
                    ?>
                    <?php foreach ($siswa as $row) : ?>

                      <tr>
                        <td><?= $i; ?></td>
                        <td>
                          <img src="../img/fotosiswa/<?= $row["image"]; ?>" width="90">
                        </td>
                        <td><?= $row["nis"]; ?></td>
                        <td witdh="50"><?= $row["name"]; ?></td>
                        <td><?= $row["angkatan"]; ?></td>
                        <td><?= $row["gender"]; ?></td>
                        <td><?= $row["jurusan"]; ?></td>
                        <td><?= $row["bimbel"]; ?></td>
                        <td><?= mentor($row["mentor"]); ?></td>
                        <td><?= $row["username"]; ?></td>
                        <td><?= $row["password"]; ?></td>
                        <td><?= $row["status"]; ?></td>
                        <td width="50">
                          <!-- Get data Siswa -->
                          <a id="edit_siswa" data-toggle="modal" data-target="#edit" data-foto="<?= $row["image"]; ?>" data-nis="<?= $row["nis"]; ?>" data-nama="<?= $row["name"]; ?>" data-angkatan="<?= $row["angkatan"]; ?>" data-gender="<?= $row["gender"]; ?>" data-jurusan="<?= $row["jurusan"]; ?>" data-bimbel="<?= $row["bimbel"]; ?>" data-mentor="<?= $row["mentor"]; ?>" data-username="<?= $row["username"]; ?>" data-password="<?= $row["password"]; ?>" data-status="<?= $row["status"]; ?>">
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
  include 'models/m_siswa.php';
  include 'models/menonaktifkansiswa.php';
  include 'models/download_qrcode.php';
  include 'template/script.php';
  include 'template/alert.php';
  ?>
  <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <!-- script dataTable mentor -->
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable({
        scrollY: 800,
        scrollX: true,
        scrollCollapse: true,
        paging: true
      });
    });

    //js untuk edit siswa
    $(document).on("click", "#edit_siswa", function() {
      let image = $(this).data('foto');
      let nis = $(this).data('nis');
      let name = $(this).data('nama');
      let angkatan = $(this).data('angkatan');
      let gender = $(this).data('gender');
      let jurusan = $(this).data('jurusan');
      let bimbel = $(this).data('bimbel');
      let mentor = $(this).data('mentor');
      let username = $(this).data('username');
      let password = $(this).data('password');
      let status = $(this).data('status');
      $(" #modal-edit #nis").val(nis);
      $(" #modal-edit #name").val(name);
      $(" #modal-edit #angkatan").val(angkatan);
      $(" #modal-edit #gender").val(gender);
      $(" #modal-edit #jurusan").val(jurusan);
      $(" #modal-edit #bimbel").val(bimbel);
      $(" #modal-edit #mentor").val(mentor);
      $(" #modal-edit #username").val(username);
      $(" #modal-edit #password").val(password);
      $(" #modal-edit #status").val(status);
      $(" #modal-edit #image").attr("src", "../img/fotosiswa/" + image);
    });
  </script>
</body>

</html>