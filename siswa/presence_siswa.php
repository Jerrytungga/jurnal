<?php
include '../database.php';

// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
//function data siswa
function nama_siswa($name_siswa)
{
    global $conn;
    $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$name_siswa'"));
    return $sqly['name'];
} //akhir functioan data siswa


// function data kegiatan
function kegiatan($name_kegiatan)
{
    global $conn;
    $sqly3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$name_kegiatan'"));
    return $sqly3['items'];
} // akhir function data kegiatan



// if (isset($_POST['filter_tanggal'])) {
//     $mulai = $_POST['tanggal_mulai'];
//     $selesai = $_POST['tanggal_akhir'];

//     if ($mulai != null || $selesai != null) {
//         $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$id' and ACC_Mentor='approved' and absent_date BETWEEN '$mulai' AND '$selesai'   order by absent_time DESC");
//     } else {

//         $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$id'and ACC_Mentor='approved'   order by absent_time DESC");
//         $array_absent = mysqli_fetch_array($Sqli_absent);
//     }
// } else {
//     $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$id' and ACC_Mentor='approved' order by absent_time DESC");
//     $array_absent = mysqli_fetch_array($Sqli_absent);
// }
// if (isset($_POST['reset'])) {
//     $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$id'  order by absent_time DESC");
//     $array_absent = mysqli_fetch_array($Sqli_absent);
// }

if (isset($_POST['week'])) {
    $week = $_POST['week'];

    if ($week == '%') {
        $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$id' and ACC_Mentor='approved' order by absent_time DESC");
        $Sqli_target = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(target) as target  FROM tb_target_presensi WHERE week='$week' and  semester='$data_semester'"));
    } else {

        $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where week='$week' and nis='$id' and ACC_Mentor='approved' order by absent_time DESC");
        $array_absent = mysqli_fetch_array($Sqli_absent);
    }
} else {
    $Sqli_absent = mysqli_query($conn, "SELECT * FROM absent where nis='$id' and ACC_Mentor='approved' order by absent_time DESC");
    $Sqli_target = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(target) as target  FROM tb_target_presensi WHERE semester='$data_semester'"));
}

$cek = mysqli_num_rows($Sqli_absent);

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



                <!-- Topbar Navbar -->
                <?php
                include 'template/topbar_menu.php';
                ?>


                <!-- End of Topbar -->
                <?php

                error_reporting(E_ALL ^ E_NOTICE);
                $Sqli_presensi = mysqli_query($conn, "SELECT * FROM absent where nis='$id' and ACC_Mentor='approved' order by absent_time DESC");
                $array_presensi = mysqli_fetch_array($Sqli_presensi);
                $mark_V = $array_presensi['mark'] = 'V';
                $mark_O = $array_presensi['mark'] = 'O';
                $mark_X = $array_presensi['mark'] = 'X';
                $mark_I = $array_presensi['mark'] = 'I';
                $mark_S = $array_presensi['mark'] = 'S';
                $week = $_POST['week'];
                $date = $array_presensi['absent_date'];


                if ($week) {

                    if ($week != null) {

                        $Sqli_target = mysqli_fetch_array(mysqli_query($conn, "SELECT target  FROM tb_target_presensi WHERE week like '$week' and  semester='$data_semester'"));



                        $tampil_mark_V = mysqli_query($conn, "SELECT *, COUNT(mark) as total FROM `absent` WHERE week like '$week' and nis='$id' and ACC_Mentor='approved' and mark='$mark_V' and semester='$data_semester' ");
                        $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);


                        $tampil_mark_O = mysqli_query($conn, "SELECT *, COUNT(mark) as total FROM `absent` WHERE week like '$week' and nis='$id' and ACC_Mentor='approved' and mark='$mark_O' and semester='$data_semester' ");
                        $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                        $tampil_mark_X = mysqli_query($conn, "SELECT *, COUNT(mark) as total FROM `absent` WHERE week like '$week' and nis='$id' and ACC_Mentor='approved' and mark='$mark_X' and semester='$data_semester' ");
                        $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                        $tampil_mark_I = mysqli_query($conn, "SELECT *, COUNT(mark) as total FROM `absent` WHERE week like '$week' and nis='$id' and ACC_Mentor='approved' and mark='$mark_I'  and semester='$data_semester' ");
                        $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                        $tampil_mark_S = mysqli_query($conn, "SELECT *, COUNT(mark) as total FROM `absent` WHERE week like '$week' and nis='$id' and ACC_Mentor='approved' and mark='$mark_S' and semester='$data_semester' ");
                        $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                        $points = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];

                        // jika target mingguan terpenuhi
                        if ($points > $Sqli_target['target']) { ?>

                            <script>
                                Swal.fire({
                                    icon: 'warning',
                                    title: '<p class="text-primary"><strong>Congratulations</strong></p>',
                                    html: '<b>The Target Is Met</b><br><br>Your Point is <?= $points; ?>'
                                })
                            </script>
                            <audio src="../music/error.wav" autoplay="autoplay" hidden="hidden"></audio>
                    <?php        }
                    } else {

                        $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approved' and mark='$mark_V' and  semester='$data_semester'  ");
                        $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                        $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approved' and mark='$mark_O' and semester='$data_semester' ");
                        $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                        $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approved' and mark='$mark_X' and semester='$data_semester'");
                        $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                        $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approved' and mark='$mark_I' and semester='$data_semester'");
                        $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                        $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approved' and mark='$mark_S' semester='$data_semester' ");
                        $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                        $points = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];
                    }
                } else {

                    // $Sqli_target = mysqli_fetch_array(mysqli_query($conn, "SELECT target  FROM tb_target_presensi WHERE semester='$data_semester'"));

                    $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approved' and mark='$mark_V' and semester='$data_semester'  ");
                    $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

                    $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approved' and mark='$mark_O' and semester='$data_semester' ");
                    $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

                    $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approved' and mark='$mark_X' and semester='$data_semester' ");
                    $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

                    $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approved' and mark='$mark_I'  and semester='$data_semester' ");
                    $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

                    $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$id' and ACC_Mentor='approved' and mark='$mark_S' and semester='$data_semester' ");
                    $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

                    $points = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];
                }

                if ($points < $Sqli_target['target']) { ?>

                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: '<p class="text-danger"><strong>Announcement!</strong></p>',
                            html: '<b>Points Have Not Met The Target</b><br><br>Your Point is <?= $points; ?>'
                        })
                    </script>
                    <audio src="../music/error.wav" autoplay="autoplay" hidden="hidden"></audio>
                <?php        }
                ?>






                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-mb-4 text-gray-800">Presence</h1>
                        <?php
                        if (isset($_SESSION['alert_point'])) { ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <b>Attendance!</b> <?php echo $_SESSION['alert_point']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                            unset($_SESSION['alert_point']);
                        } ?>
                    </div>
                    <div class="row">
                        <div class="card_information">
                            <div class="card bg-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1">
                                            <center>
                                                <div class="text-m font-weight-bold text-light text-uppercase mb-1">
                                                    POINTS</div>
                                                <div class="h5 mb-0 font-weight-bold text-light">
                                                    <?php
                                                    $points;
                                                    if ($points == -1) {
                                                        $_SESSION['alert_point'] = 'Your Points Mines!';
                                                        echo $points;
                                                    } else {
                                                        echo  $points;
                                                    }
                                                    ?></div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card_information">
                            <div class="card bg-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1 ">
                                            <center>

                                                <div class="text-m font-weight-bold text-light text-uppercase mb-1">
                                                    TARGET</div>
                                                <div class="h5 mb-0 font-weight-bold text-light">
                                                    <?php
                                                    if ($Sqli_target['target']) { ?>
                                                        <?= $Sqli_target['target']; ?>
                                                    <?php   } else {
                                                        echo '0';
                                                    }

                                                    ?>



                                                </div>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card_presence">
                            <div class="card bg-gradient-light shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1 ">
                                            <center>
                                                <div class="text-m font-weight-bold text-danger text-uppercase mb-1">
                                                    PRESENT</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $arraytampil_mark_V['total']; ?></div>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card_presence">
                            <div class="card bg-gradient-light shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1 ">
                                            <center>
                                                <div class="text-m font-weight-bold text-danger text-uppercase mb-1">
                                                    NOT PRESENT</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $arraytampil_mark_X['total']; ?></div>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card_presence">
                            <div class="card bg-gradient-light shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1 ">
                                            <center>

                                                <div class="text-m font-weight-bold text-danger text-uppercase mb-1">
                                                    LATE</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $arraytampil_mark_O['total']; ?></div>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card_presence">
                            <div class="card bg-gradient-light shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1 ">
                                            <center>

                                                <div class="text-m font-weight-bold text-danger text-uppercase mb-1">
                                                    PERMISSION</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $arraytampil_mark_I['total']; ?></div>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card_presence">
                            <div class="card bg-gradient-light shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-1 ">
                                            <center>

                                                <div class="text-m font-weight-bold text-danger text-uppercase mb-1">
                                                    SICK</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $arraytampil_mark_S['total']; ?></div>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card  mb-4">
                        <div class=" card-header py-3">
                            <div class="alert alert-warning col-3 mb-4" role="alert">
                                To Find Out The Points Please Select The Week
                            </div>
                            <div class="form-inline">

                                <form action="" method="POST" id="form_id">
                                    <b class="font-weight-normal">Week :</b>&nbsp;&nbsp;
                                    <?php
                                    if (isset($_POST['week'])) {
                                        $week = $_POST['week']; ?>
                                        <select id="" class="form-control col-10" name="week" onChange="document.getElementById('form_id').submit();">
                                            <option value="%">Select All Weeks</option>
                                            <option value="1" <?php if ($week == "1") { ?> selected <?php } ?>>01</option>
                                            <option value="2" <?php if ($week == "2") { ?> selected <?php } ?>>02</option>
                                            <option value="3" <?php if ($week == "3") { ?> selected <?php } ?>>03</option>
                                            <option value="4" <?php if ($week == "4") { ?> selected <?php } ?>>04</option>
                                            <option value="5" <?php if ($week == "5") { ?> selected <?php } ?>>05</option>
                                            <option value="6" <?php if ($week == "6") { ?> selected <?php } ?>>06</option>
                                            <option value="7" <?php if ($week == "7") { ?> selected <?php } ?>>07</option>
                                            <option value="8" <?php if ($week == "8") { ?> selected <?php } ?>>08</option>
                                            <option value="9" <?php if ($week == "9") { ?> selected <?php } ?>>09</option>
                                            <option value="10" <?php if ($week == "10") { ?> selected <?php } ?>>10</option>
                                            <option value="11" <?php if ($week == "11") { ?> selected <?php } ?>>11</option>
                                            <option value="12" <?php if ($week == "12") { ?> selected <?php } ?>>12</option>
                                            <option value="13" <?php if ($week == "13") { ?> selected <?php } ?>>13</option>
                                            <option value="14" <?php if ($week == "14") { ?> selected <?php } ?>>14</option>
                                            <option value="15" <?php if ($week == "15") { ?> selected <?php } ?>>15</option>
                                            <option value="16" <?php if ($week == "16") { ?> selected <?php } ?>>16</option>
                                            <option value="17" <?php if ($week == "17") { ?> selected <?php } ?>>17</option>
                                            <option value="18" <?php if ($week == "18") { ?> selected <?php } ?>>18</option>
                                            <option value="19" <?php if ($week == "19") { ?> selected <?php } ?>>19</option>
                                            <option value="20" <?php if ($week == "20") { ?> selected <?php } ?>>20</option>
                                            <option value="21" <?php if ($week == "21") { ?> selected <?php } ?>>21</option>
                                            <option value="22" <?php if ($week == "22") { ?> selected <?php } ?>>22</option>
                                            <option value="23" <?php if ($week == "23") { ?> selected <?php } ?>>23</option>
                                            <option value="24" <?php if ($week == "24") { ?> selected <?php } ?>>24</option>
                                            <option value="25" <?php if ($week == "25") { ?> selected <?php } ?>>25</option>
                                            <option value="26" <?php if ($week == "26") { ?> selected <?php } ?>>26</option>
                                            <option value="27" <?php if ($week == "27") { ?> selected <?php } ?>>27</option>
                                            <option value="28" <?php if ($week == "28") { ?> selected <?php } ?>>28</option>
                                            <option value="29" <?php if ($week == "29") { ?> selected <?php } ?>>29</option>
                                            <option value="30" <?php if ($week == "30") { ?> selected <?php } ?>>30</option>
                                            <option value="31" <?php if ($week == "31") { ?> selected <?php } ?>>31</option>
                                            <option value="32" <?php if ($week == "32") { ?> selected <?php } ?>>32</option>
                                            <option value="33" <?php if ($week == "33") { ?> selected <?php } ?>>33</option>
                                            <option value="34" <?php if ($week == "34") { ?> selected <?php } ?>>34</option>
                                            <option value="35" <?php if ($week == "35") { ?> selected <?php } ?>>35</option>
                                            <option value="36" <?php if ($week == "36") { ?> selected <?php } ?>>36</option>
                                            <option value="37" <?php if ($week == "37") { ?> selected <?php } ?>>37</option>
                                            <option value="38" <?php if ($week == "38") { ?> selected <?php } ?>>38</option>
                                            <option value="39" <?php if ($week == "39") { ?> selected <?php } ?>>39</option>
                                            <option value="40" <?php if ($week == "40") { ?> selected <?php } ?>>40</option>
                                            <option value="41" <?php if ($week == "41") { ?> selected <?php } ?>>41</option>
                                            <option value="42" <?php if ($week == "42") { ?> selected <?php } ?>>42</option>
                                            <option value="43" <?php if ($week == "43") { ?> selected <?php } ?>>43</option>
                                            <option value="44" <?php if ($week == "44") { ?> selected <?php } ?>>44</option>
                                            <option value="45" <?php if ($week == "45") { ?> selected <?php } ?>>45</option>
                                            <option value="46" <?php if ($week == "46") { ?> selected <?php } ?>>46</option>
                                            <option value="47" <?php if ($week == "47") { ?> selected <?php } ?>>47</option>
                                            <option value="48" <?php if ($week == "48") { ?> selected <?php } ?>>48</option>
                                            <option value="49" <?php if ($week == "49") { ?> selected <?php } ?>>49</option>
                                            <option value="50" <?php if ($week == "50") { ?> selected <?php } ?>>50</option>
                                            <option value="51" <?php if ($week == "51") { ?> selected <?php } ?>>51</option>
                                            <option value="52" <?php if ($week == "52") { ?> selected <?php } ?>>52</option>
                                        </select>
                                    <?php
                                    } else {
                                    ?>
                                        <select id="" class="form-control col-10" name="week" onChange="document.getElementById('form_id').submit();">
                                            <option value="%">Select All Weeks</option>
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                            <option value="5">05</option>
                                            <option value="6">06</option>
                                            <option value="7">07</option>
                                            <option value="8">08</option>
                                            <option value="9">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                            <option value="32">32</option>
                                            <option value="33">33</option>
                                            <option value="34">34</option>
                                            <option value="35">35</option>
                                            <option value="36">36</option>
                                            <option value="37">37</option>
                                            <option value="38">38</option>
                                            <option value="39">39</option>
                                            <option value="40">40</option>
                                            <option value="41">41</option>
                                            <option value="42">42</option>
                                            <option value="43">43</option>
                                            <option value="44">44</option>
                                            <option value="45">45</option>
                                            <option value="46">46</option>
                                            <option value="47">47</option>
                                            <option value="48">48</option>
                                            <option value="49">49</option>
                                            <option value="50">50</option>
                                            <option value="51">51</option>
                                            <option value="52">52</option>
                                        </select>
                                    <?php } ?>
                                </form>

                                <!-- <form action="" method="POST">
                                    <?php
                                    if (isset($_POST['filter_tanggal'])) {
                                        $mulai = $_POST['tanggal_mulai'];
                                        $selesai = $_POST['tanggal_akhir'];
                                    ?>
                                        <input type="date" name="tanggal_mulai" value="<?= $mulai ?>" class="form-control ml-3">
                                        <input type="date" name="tanggal_akhir" value="<?= $selesai ?>" class="form-control ml-3">
                                    <?php
                                    } else {
                                    ?>
                                        <input type="date" name="tanggal_mulai" class="form-control ml-3">
                                        <input type="date" name="tanggal_akhir" class="form-control ml-3">
                                    <?php } ?>
                                    <button type="submit" name="filter_tanggal" class="btn btn-info ml-3">Search</button>
                                    <button type="submit" name="reset" value="reset" class="btn btn-danger ml-3">Reset</button>
                                </form> -->
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                    if ($cek == 0) { ?>

                                        <script>
                                            Swal.fire(
                                                '<strong>Announcement!</strong>', 'No Presence', 'question')
                                        </script>
                                        <audio src="../music/error.wav" autoplay="autoplay" hidden="hidden"></audio>

                                    <?php   } else { ?>
                                        <thead>
                                            <tr class="table-primary">
                                                <th width="10">No</th>
                                                <!-- <th>Presence Picture</th> -->
                                                <th>Schedule</th>
                                                <th>Schedule Time</th>
                                                <th>Absent Time Schedule</th>
                                                <th>Presence Time</th>
                                                <th>Week</th>
                                                <th>Mark</th>
                                                <th>Agreement</th>
                                                <th>Suggestion Mentor</th>
                                                <th>Absent Date</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($Sqli_absent as $row) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <!-- <td>

                                                        <?php
                                                        $gambar = $row["image"];
                                                        if ($gambar) { ?>
                                                            <button type="button" data-gambar="<?= $row["image"]; ?>" class="btn " data-toggle="modal" data-target="#gambar">
                                                                <img src="../img/verifikasi/<?= $row["image"]; ?>" width="90">
                                                            </button>

                                                        <?php }

                                                        ?>

                                                    </td> -->
                                                    <td><?= kegiatan($row['schedule_id']); ?></td>
                                                    <td>
                                                        <?php
                                                        // mengambil waktu kegiatanm di tabel kegiatan berdasarkan id kegiatan
                                                        $id_kegiatan = $row["schedule_id"];
                                                        $sqli_schedule = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schedule WHERE id='$id_kegiatan'"));
                                                        $waktu_kegiatan = $sqli_schedule['start_time'];
                                                        $absent_time = $sqli_schedule['absent_time'];
                                                        ?>
                                                        <?= $waktu_kegiatan; ?>
                                                    </td>
                                                    <td>
                                                        <?= $absent_time; ?>
                                                    </td>
                                                    <td><?= $row['absent_time']; ?></td>
                                                    <td><?= $row['week']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row['mark'] == 'V') { ?>
                                                            <span class="badge badge-pill badge-primary"><?= $row['mark']; ?></span>
                                                        <?php  } else if ($row['mark'] == 'O') { ?>
                                                            <span class="badge badge-pill badge-warning"><?= $row['mark']; ?></span>
                                                        <?php   } else if ($row['mark'] == 'X') { ?>
                                                            <span class="badge badge-pill badge-danger"><?= $row['mark']; ?></span>
                                                        <?php  } else if ($row['mark'] == 'I') { ?>
                                                            <span class="badge badge-pill badge-info"><?= $row['mark']; ?></span>
                                                        <?php   }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        // jika presensinya terlambat maka warna merah statusnya
                                                        if ($row["ACC_Mentor"] == 'Waiting') { ?>
                                                            <span class="badge badge-pill badge-warning"><?= $row["ACC_Mentor"]; ?></span>
                                                        <?php  } else if ($row["ACC_Mentor"] == 'not approved') { ?>
                                                            <span class="badge badge-pill badge-danger"><?= $row["ACC_Mentor"]; ?></span>
                                                        <?php   } else { ?>
                                                            <span class="badge badge-pill badge-success"><?= $row["ACC_Mentor"]; ?></span>
                                                        <?php  } ?>
                                                    </td>
                                                    <td><?= $row['catatan']; ?></td>
                                                    <td><?= $row['absent_date']; ?></td>

                                                </tr>
                                                <?php

                                                $i++; ?>
                                        <?php endforeach;
                                        }
                                        ?>

                                        </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <?php
            include 'template/footer.php';
            ?>
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
    include 'template/alert.php';
    include '../modal.php';
    ?>
    <script>
        // edit catatan
        $(document).on("click", "#edit_catatan", function() {
            let judul = $(this).data('judul');
            let deskripsi = $(this).data('deskripsi');
            let id = $(this).data('id');
            let date = $(this).data('date');
            $(" #modal-edit #judul").val(judul);
            $(" #modal-edit #deskripsi").val(deskripsi);
            $(" #modal-edit #id").val(id);
            $(" #modal-hapus #id").val(id);
            $(" #modal-hapus #date").val(date);

        });
    </script>
</body>

</html>

<?php
function notice($type)
{
    if ($type == 1) {
        return "<audio autoplay><source src='" . '../music/success.wav' . "'></audio>";
    } elseif ($type == 0) {
        return "<audio autoplay><source src='" . '../music/error.wav' . "'></audio>";
    }
}

?>