<?php
include '../database.php';
if (isset($_POST['btn_input'])) {
    $sumber = $_FILES['image']['tmp_name'];
    $target = '../img/penilaian/';
    $nama_gambar = $_FILES['image']['name'];
    $nis = htmlspecialchars($_POST['nis']);
    $rp = htmlspecialchars($_POST['rapi']);
    $br = htmlspecialchars($_POST['bersih']);
    $rb = htmlspecialchars($_POST['raib']);
    $brs = htmlspecialchars($_POST['brngasing']);
    $notes = htmlspecialchars($_POST['cttn']);
    $efata = htmlspecialchars($_POST['efata']);
    $smt = htmlspecialchars($_POST['smt']);
    if ($nama_gambar != '') {
        if (move_uploaded_file($sumber, $target . $nama_gambar)) {
            $input =  mysqli_query($conn, "INSERT INTO `tb_living_seprei`(`nis`, `rapi`, `bersih`, `raib`, `benda_asing`, `image`, `catatan`, `efata`, `semester`) VALUES ('$nis','$rp','$br','$rb','$brs','$nama_gambar','$notes','$efata','$smt') ");
            if ($input) {
                $notifinput = $_SESSION['sukses'] = 'Data entered successfully!';
            } else {
                $notifgagalinput = $_SESSION['gagal'] = 'Data not entered successfully!';
            }
        }
    } else {
        $input =  mysqli_query($conn, "INSERT INTO `tb_living_seprei`(`nis`, `rapi`, `bersih`, `raib`, `benda_asing`, `catatan`, `efata`, `semester`) VALUES ('$nis','$rp','$br','$rb','$brs','$notes','$efata','$smt') ");
        if ($input) {
            $notifinput = $_SESSION['sukses'] = 'Data entered successfully!';
        } else {
            $notifgagalinput = $_SESSION['gagal'] = 'Data not entered successfully!';
        }
    }
}

if (isset($_POST['btn_update'])) {
    $sumber = $_FILES['foto']['tmp_name'];
    $target = '../img/penilaian/';
    $nama_gambar = $_FILES['foto']['name'];
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $rp = htmlspecialchars($_POST['rapi']);
    $rb = htmlspecialchars($_POST['raib']);
    $br = htmlspecialchars($_POST['bersih']);
    $brs = htmlspecialchars($_POST['brngasing']);
    $notes = htmlspecialchars($_POST['catatan']);
    $date = htmlspecialchars($_POST['date']);
    $smt = htmlspecialchars($_POST['smt']);
    if ($nama_gambar != '') {
        if (move_uploaded_file($sumber, $target . $nama_gambar)) {
            $edit =  mysqli_query($conn, "UPDATE `tb_living_seprei` SET `nis`='$nis',`rapi`='$rp',`bersih`='$br',`raib`='$rb',`benda_asing`='$brs',`image`='$nama_gambar',`catatan`='$notes',`efata`='$efata',`date`='$date',`semester`='$smt' WHERE `tb_living_seprei`.`nis`='$nis' AND `tb_living_seprei`.`date`='$date' ");
            if ($edit) {
                $notifsuksesedit = $_SESSION['sukses'] = 'Saved!';
            } else {
                $notifgagaledit = $_SESSION['gagal'] = 'Sorry, the data was not edited successfully!';
            }
        }
    } else {
        $edit =  mysqli_query($conn, "UPDATE `tb_living_seprei` SET `nis`='$nis',`rapi`='$rp',`bersih`='$br',`raib`='$rb',`benda_asing`='$brs',`catatan`='$notes',`efata`='$efata',`date`='$date',`semester`='$smt' WHERE `tb_living_seprei`.`nis`='$nis' AND `tb_living_seprei`.`date`='$date' ");
        if ($edit) {
            $notifsuksesedit = $_SESSION['sukses'] = 'Saved!';
        } else {
            $notifgagaledit = $_SESSION['gagal'] = 'Sorry, the data was not edited successfully!';
        }
    }
}

if (isset($_POST['hapus'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $date = htmlspecialchars($_POST['date']);
    $hapus =  mysqli_query($conn, "DELETE FROM `tb_living_seprei`  WHERE `nis` ='$nis' AND `date`='$date'");
    if ($hapus) {
        $notifdelete = $_SESSION['sukses'] = 'Data Successfully Deleted!';
    } else {
        $notifgagal = $_SESSION['sukses'] = 'Data failed to delete!';
    }
}
session_start();
include 'template/session.php';
//menampilkan data siswa
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];
$penilaian = mysqli_query($conn, "SELECT * FROM tb_living_seprei WHERE nis='$nis' ORDER BY date DESC");
$nilai = mysqli_fetch_array($penilaian);

?>
<!DOCTYPE html>
<html lang="en">


<?php
include 'template/head.php';
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
                <?php
                include 'template/topbar_menu.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                    include 'template/menu_living_ranjang.php'
                    ?>
                    <!-- DataTales Rak sepatu -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <h6 class=" font-weight-bold text-success">Seprei</h6>
                            <a href="" class="btn btn-success" data-toggle="modal" data-target="#livingseprei">Input</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th width="30">Rapi</th>
                                            <th width="30">Bersih</th>
                                            <th width="30">Raib</th>
                                            <th width="100">Benda Asing</th>
                                            <th width="150">foto</th>
                                            <th width="200">Catatan Mentor</th>
                                            <th width="100">Date</th>
                                            <th width="100">Option</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1;
                                        $total = 0;
                                        ?>
                                        <?php foreach ($penilaian as $row) : ?>
                                            <tr>
                                                <td> <?= $i; ?></td>
                                                <td><?= $row['rapi']; ?></td>
                                                <td><?= $row['bersih']; ?></td>
                                                <td><?= $row['raib']; ?></td>
                                                <td><?= $row['benda_asing']; ?></td>
                                                <td>
                                                    <?php
                                                    $gambar = $row["image"];
                                                    if ($gambar) { ?>

                                                        <a id="editpenilaian" type="button" data-foto="<?= $row['image']; ?>" class="btn  btn-lg" data-toggle="modal" data-target="#myModal">
                                                            <img src="../img/penilaian/<?= $row["image"]; ?>" class="img-responsive" width="90" height="90">
                                                        </a>

                                                    <?php }

                                                    ?>
                                                </td>
                                                <td><a class="font-weight-bold text-primary font-italic"><?= $row['catatan']; ?></a></td>
                                                <td><?= $row['date']; ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle " data-toggle="dropdown" aria-expanded="false">
                                                            Choice
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                            <a id="editpenilaian" type="button" data-toggle="modal" data-target="#edit" data-rapi="<?= $row['rapi']; ?>" data-nis="<?= $row['nis']; ?>" data-efata="<?= $row['efata']; ?>" data-cttn="<?= $row['catatan']; ?>" data-bersih="<?= $row['bersih']; ?>" data-brngasing="<?= $row['benda_asing']; ?>" data-raib="<?= $row['raib']; ?>" data-foto="<?= $row['image']; ?>" data-date="<?= $row['date']; ?>" class="dropdown-item">
                                                                Edit
                                                            </a>

                                                            <a type="button" id="editpenilaian" class="dropdown-item text-danger" data-date="<?= $row["date"]; ?>" data-nis="<?= $row["nis"]; ?>" data-toggle="modal" data-target="#hapus">
                                                                Delete
                                                            </a>

                                                        </div>
                                                    </div>

                                                </td>

                                            </tr>
                                            <?php
                                            $total = $total + $row['rapi'] + $row['raib'] + $row['bersih'] + $row['benda_asing']; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <th class="bg-warning text-right" colspan="7"> Total Point : </th>
                                        <th class="text-center"><?= $total; ?></th>
                                    </tfoot>
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



    <!-- Modal living seprei-->
    <div class="modal fade" id="livingseprei" tabindex="-1" aria-labelledby="livingseprei" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title font-weight-bold" id="livingseprei">Living Seprei</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <!-- bungkus untuk form inputan -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                        <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                        <input type="hidden" class="form-control" id="smt" name="smt" value="<?= $data_semester; ?>">
                        <label class="text-reset">Rapi</label>
                        <div class="form-group">
                            <select class="form-control" name="rapi" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                            </select>
                        </div>


                        <label class="text-reset">Bersih</label>
                        <div class="form-group">
                            <select class="form-control" name="bersih" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                            </select>
                        </div>


                        <label class="text-reset">Raib</label>
                        <div class="form-group">
                            <select class="form-control" name="raib" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                            </select>
                        </div>

                        <label>Benda asing </label>
                        <div class="form-group">
                            <select class="form-control" name="brngasing" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                                <option value="-2">-2</option>
                                <option value="-3">-3</option>
                                <option value="-4">-4</option>
                                <option value="-5">-5</option>
                                <option value="-6">-6</option>
                                <option value="-7">-7</option>
                                <option value="-8">-8</option>
                                <option value="-9">-9</option>
                                <option value="-10">-10</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Foto</label>
                            <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        </div>

                        <div class="form-group">
                            <label>Mentor Notes </label>
                            <textarea rows="5" type="text" class="form-control" id="cttn" name="cttn"></textarea>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_input" class="btn btn-success ">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>








    <!-- Modal living seprei-->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="livingseprei" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title font-weight-bold" id="livingseprei">Change Living Seprei</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <!-- bungkus untuk form inputan -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                        <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                        <input type="hidden" class="form-control" id="smt" name="smt" value="<?= $data_semester; ?>">
                        <input type="hidden" class="form-control" id="date" name="date">
                        <label class="text-reset">Rapi</label>
                        <div class="form-group">
                            <select class="form-control" id="rapi" name="rapi" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                            </select>
                        </div>


                        <label class="text-reset">Bersih</label>
                        <div class="form-group">
                            <select class="form-control" id="bersih" name="bersih" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                            </select>
                        </div>


                        <label class="text-reset">Raib</label>
                        <div class="form-group">
                            <select class="form-control" id="raib" name="raib" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                            </select>
                        </div>

                        <label>Benda asing </label>
                        <div class="form-group">
                            <select class="form-control" id="brngasing" name="brngasing" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="0">0</option>
                                <option value="-1">-1</option>
                                <option value="-2">-2</option>
                                <option value="-3">-3</option>
                                <option value="-4">-4</option>
                                <option value="-5">-5</option>
                                <option value="-6">-6</option>
                                <option value="-7">-7</option>
                                <option value="-8">-8</option>
                                <option value="-9">-9</option>
                                <option value="-10">-10</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">Foto</label>
                            <div class="padding-bottom:5px">
                                <img src="" width="250px" id="foto">
                            </div>
                            <input type="file" name="foto" class="form-control-file mt-2" id="foto">
                        </div>

                        <div class="form-group">
                            <label>Mentor Notes </label>
                            <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan"></textarea>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_update" class="btn btn-warning ">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>





    <?php
    include 'modal/modal_logout.php';
    include 'template/script_penilaian.php';
    include 'template/alert.php';
    include 'modal/modal_foto.php';
    include 'modal/modal_hapus.php';
    ?>


</body>

</html>