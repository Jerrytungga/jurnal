<?php
// menghubungkan ke database
$conn = mysqli_connect("127.0.0.1", "root", "#dbabsensipka#", "jurnal");
// menampilkan data
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// menambahkan data mentor
if (isset($_POST['btn_tambah_mentor'])) {
    $sumber = $_FILES['image']['tmp_name'];
    $target = '../img/foto_mentor/';
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
            }
        } else {
            $addmentor = mysqli_query($conn, "INSERT INTO mentor (name,gender,username,password,status,efata) value ('$name','$gender','$username','$password','$status','$efata')");
        }
    }
}


// mengedit data mentor
if (isset($_POST['btn_edit_mentor'])) {
    $sumber = $_FILES['image']['tmp_name'];
    $target = '../img/foto_mentor/';
    $nama_gambar = $_FILES['image']['name'];
    $name = htmlspecialchars($_POST['name']);
    $gender = htmlspecialchars($_POST['gender']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $status = htmlspecialchars($_POST['status']);
    $efata = htmlspecialchars($_POST['efata']);
    if ($nama_gambar != '') {
        // if (move_uploaded_file($sumber, $target . $nama_gambar)) {
        $update = mysqli_query($conn, "UPDATE `mentor` SET `image`='$nama_gambar',`name`='$name',`gender`='$gender',`username`='$username',`password`='$password',`status`='$status',`efata`='$efata', `date` = current_timestamp WHERE `mentor`.`efata` = '$efata'");
        // }
        header('location:../mentor.php');
    } else {
        // jika tidak mengganti gambar profile
        $update = mysqli_query($conn, "UPDATE `mentor` SET `efata`='$efata',`name`='$name',`gender`='$gender',`username`='$username',`password`='$password',`status`='$status', `date` = current_timestamp WHERE `mentor`.`efata` = '$efata'");

        header('location:../mentor.php');
    }
}



// menambahkan data siswa
if (isset($_POST['btn_tambah_siswa'])) {
    $sumber = $_FILES['image']['tmp_name'];
    $target = '../img/foto_siswa/';
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
        echo "<script>alert('Username yang Anda pilih sudah ada, silahkan ganti yang lain');</script>";
    } else {
        if ($nama_gambar != '') {
            if (move_uploaded_file($sumber, $target . $nama_gambar)) {
                $addtotable = mysqli_query($conn, "INSERT INTO `siswa`(`image`, `nis`, `name`, `angkatan`, `gender`, `jurusan`, `bimbel`, `mentor`, `username`, `password`, `status`) VALUES ('$nama_gambar','$nis','$name','$angkatan','$gender','$jurusan','$bimbel','$mentor','$username','$password','$status')");
            }
        } else {
            $addtotable = mysqli_query($conn, "INSERT INTO `siswa`(`nis`, `name`, `angkatan`, `gender`, `jurusan`, `bimbel`, `mentor`, `username`, `password`, `status`) VALUES ('$nis','$name','$angkatan','$gender','$jurusan','$bimbel','$mentor','$username','$password','$status')");
        }
    }
}

// mengedit data siswa
if (isset($_POST['btn_edit_siswa'])) {
    $sumber = $_FILES['image']['tmp_name'];
    $target = '../img/foto_siswa/';
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
            $editsiswa = mysqli_query($conn, "UPDATE `siswa` SET `image`='$nama_gambar',`nis`='$nis',`name`='$name',`angkatan`='$angkatan',`gender`='$gender',`jurusan`='$jurusan',`bimbel`='$bimbel',`mentor`='$mentor',`username`='$username',`password`='$password',`status`='$status',`date`= current_timestamp WHERE `siswa`.`nis` = '$nis'");
        }
        header('location:../siswa.php');
    } else {
        // jika tidak mengganti gambar profile
        $editsiswa = mysqli_query($conn, "UPDATE `siswa` SET `nis`='$nis',`name`='$name',`mentor`='$mentor',`angkatan`='$angkatan',`gender`='$gender',`jurusan`='$jurusan',`bimbel`='$bimbel',`username`='$username',`password`='$password',`status`='$status',`date`= current_timestamp WHERE `siswa`.`nis` = '$nis'");
    }
    header('location:../siswa.php');
}


//input data jurusan
if (isset($_POST['btn_tambah_jurusan'])) {
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id`) As id FROM `tb_jurusan`"));
    $idbr = $max['id'] + 1;
    $datajurusan = mysqli_query($conn, "INSERT INTO `tb_jurusan`(`jurusan`,`id`) VALUES ('$jurusan',$idbr)");
    if ($datajurusan) {
        echo "<script>alert('Jurusan Berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Jurusan gagal ditambahkan');</script>";
    }
}

//edit data jurusan
if (isset($_POST['btn_edit_jurusan'])) {
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $kode = htmlspecialchars($_POST['kode']);
    $datajurusan = mysqli_query($conn, "UPDATE `tb_jurusan` SET `jurusan`='$jurusan',`id`='$kode' WHERE `tb_jurusan`.`id` = '$kode'");
    header('location:../jurusan.php');
}

//input data angkatan
if (isset($_POST['btn_tambah_angkatan'])) {
    $angkatan = htmlspecialchars($_POST['angkatan']);
    $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id`) As id FROM `tb_angkatan`"));
    $idbr = $max['id'] + 1;
    $t = mysqli_query($conn, "INSERT INTO `tb_angkatan`(`angkatan`, `id`) VALUES ('$angkatan',$idbr)");
    if ($t) {
        echo "<script>alert('Angkatan Berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Angkatan gagal ditambahkan');</script>";
    }
}

//edit data angkatan
if (isset($_POST['btn_edit_angkatan'])) {
    $angkatan = htmlspecialchars($_POST['angkatan']);
    $id = htmlspecialchars($_POST['id']);
    $editangkatan = mysqli_query($conn, "UPDATE `tb_angkatan` SET `angkatan`='$angkatan' WHERE `tb_angkatan`.`id` = '$id'");
    if ($editangkatan) {
        header('location:../angkatan.php');
    }
}


if (isset($_POST['btn_tbh_categori_doa'])) {
    $categori = htmlspecialchars($_POST['categori']);
    $max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(`id`) As id FROM `tb_categori_doa`"));
    $idbr = $max['id'] + 1;
    $categoridoa = mysqli_query($conn, "INSERT INTO `tb_categori_doa`(`categori_doa`, `id`) VALUES ('$categori',$idbr)");
}

if (isset($_POST['btn_edit_categori'])) {
    $categori = htmlspecialchars($_POST['categori']);
    $kode = htmlspecialchars($_POST['kode']);
    $editangkatan = mysqli_query($conn, "UPDATE `tb_categori_doa` SET `categori_doa`=' $categori' WHERE `tb_categori_doa`.`id`='$kode'");
    header('location:../categoridoa.php');
}




// code untuk select option data mentor
$sql_mentor = mysqli_query($conn, "SELECT * FROM mentor WHERE status= 'Aktif'") or die(mysqli_error($conn));
//code untuk select option data jurusan
$sql_jurusan = mysqli_query($conn, "SELECT * FROM tb_jurusan") or die(mysqli_error($conn));
//code untuk select option data angkatan
$sql_angkatan = mysqli_query($conn, "SELECT * FROM tb_angkatan") or die(mysqli_error($conn));
