<?php
// menghubungkan ke database
$conn = mysqli_connect("127.0.0.1", "root", "#dbabsensipka#", "jurnal");
// menampilkan data siswa
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

// sistem ganti password siswa
if (isset($_POST['edit_profile'])) {
    $efata = htmlspecialchars($_POST['efata']);
    $password = htmlspecialchars($_POST['password']);
    $addtotable = mysqli_query($conn, "UPDATE `mentor` SET `efata`='$efata',`password`='$password' WHERE `mentor`.`efata`='$efata'");
    header('location:../profile.php');
}

// sistem submit/post di bagian jurnal personal goal
if (isset($_POST['update'])) {
    $efata = htmlspecialchars($_POST['efata']);
    $nis = htmlspecialchars($_POST['nis']);
    $character = htmlspecialchars($_POST['character']);
    $prayer = htmlspecialchars($_POST['prayer']);
    $Neutron = htmlspecialchars($_POST['neutron']);
    $date = htmlspecialchars($_POST['date']);
    $catatan = htmlspecialchars($_POST['catatan']);
    $point1 = htmlspecialchars($_POST['point1']);
    $point2 = htmlspecialchars($_POST['point2']);
    $point3 = htmlspecialchars($_POST['point3']);
    $goal = mysqli_query($conn, "UPDATE `tb_personal_goal` SET `nis`='$nis',`point1`='$point1',`point2`='$point2',`point3`='$point3',`efata`='$efata',`character_virtue`='$character',`prayer`='$prayer',`date`='$date',`neutron`='$Neutron',`Catatan_mentor`='$catatan' WHERE `tb_personal_goal`.`nis` ='$nis' AND `tb_personal_goal`.`date`='$date'");
}


// sistem edit catatan siswa
if (isset($_POST['btn_catatan'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $title = htmlspecialchars($_POST['title']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $catatan = htmlspecialchars($_POST['catatan']);
    mysqli_query($conn, "UPDATE `tb_catatan` SET `nis`='$nis',`judul`='$title',`deskripsi`='$deskripsi',`cttn_mentor`='$catatan'WHERE `tb_catatan`.`nis` ='$nis'");
}

// sistem edit revival note
if (isset($_POST['btn_revivalnote'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $verse = htmlspecialchars($_POST['verse']);
    $blessing = htmlspecialchars($_POST['blessings']);
    $date = htmlspecialchars($_POST['date']);
    $point1 = htmlspecialchars($_POST['point1']);
    $point2 = htmlspecialchars($_POST['point2']);
    $catatan_mentor = htmlspecialchars($_POST['mentor']);
    mysqli_query($conn, "UPDATE `tb_revival_note` SET `nis`='$nis',`verse`='$verse',`blessing`='$blessing',`point1`='$point1',`point2`='$point2',`date`='$date',`catatan_mentor`='$catatan_mentor' WHERE `tb_revival_note`.`nis` ='$nis' AND `tb_revival_note`.`date` ='$date'");
}


// sistem edit prayer note
if (isset($_POST['btn_prayernote'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $judul = htmlspecialchars($_POST['judul']);
    $beban = htmlspecialchars($_POST['beban']);
    $point = htmlspecialchars($_POST['point']);
    $date = htmlspecialchars($_POST['date']);
    $catatan = htmlspecialchars($_POST['catatan']);
    mysqli_query($conn, "UPDATE `tb_prayer_note` SET `nis`='$nis',`point`='$point',`kategori`='$judul',`burden_inward_sense`='$beban',`catatan_mentor`='$catatan',`date`='$date' WHERE `tb_prayer_note`.`nis` ='$nis' AND `tb_prayer_note`.`date` ='$date'");
}

// sistem edit bible
if (isset($_POST['btn_bible'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $bible = htmlspecialchars($_POST['bible']);
    $ot = htmlspecialchars($_POST['ot']);
    $nt = htmlspecialchars($_POST['nt']);
    $date = htmlspecialchars($_POST['date']);
    $point_bible = htmlspecialchars($_POST['point']);
    $catatan4 = htmlspecialchars($_POST['catatan4']);
    mysqli_query($conn, "UPDATE `tb_bible_reading` SET `nis`='$nis', `point`='$point_bible',`bible`='$bible',`total_ot`='$ot',`total_nt`='$nt',`catatan_mentor`='$catatan4',`date`='$date' WHERE `tb_bible_reading`.`nis` ='$nis' AND `tb_bible_reading`.`date` ='$date'");
}


// sistem edit exhibition
if (isset($_POST['btn_exhibition'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $verse2 = htmlspecialchars($_POST['verse2']);
    $point = htmlspecialchars($_POST['pointblessing']);
    $catatan2 = htmlspecialchars($_POST['catatan2']);
    $date = htmlspecialchars($_POST['date']);
    $point_exhibition = htmlspecialchars($_POST['point']);
    mysqli_query($conn, "UPDATE `tb_exhibition` SET `nis`='$nis',`verse`='$verse2',`point_of_blessing`='$point',`catatan_mentor`='$catatan2',`date`='$date',`point`='$point_exhibition' WHERE `tb_exhibition`.`nis` ='$nis' AND `tb_exhibition`.`date` ='$date'");
}


// sistem edit home meeting
if (isset($_POST['btn_homemeeting'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $berkat = htmlspecialchars($_POST['berkat']);
    $catatan8 = htmlspecialchars($_POST['catatan8']);
    $point_homemeeting = htmlspecialchars($_POST['point']);
    $date = htmlspecialchars($_POST['date']);
    mysqli_query($conn, "UPDATE `tb_home_meeting` SET `nis`='$nis',`point`='$point_homemeeting',`date`='$date',`what_i_get_and_lern`='$berkat',`catatan_mentor`='$catatan8' WHERE `tb_home_meeting`.`nis` ='$nis' AND `tb_home_meeting`.`date` ='$date'");
}

// sistem edit blessings
if (isset($_POST['btn_blessings'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $god = htmlspecialchars($_POST['god']);
    $cttn1 = htmlspecialchars($_POST['cttn1']);
    $edu = htmlspecialchars($_POST['edu']);
    $cttn2 = htmlspecialchars($_POST['cttn2']);
    $chracter = htmlspecialchars($_POST['chracter']);
    $cttn3 = htmlspecialchars($_POST['cttn3']);
    $apresiasi1 = htmlspecialchars($_POST['apresiasi1']);
    $cttn4 = htmlspecialchars($_POST['cttn4']);
    $apresiasi2 = htmlspecialchars($_POST['apresiasi2']);
    $cttn5 = htmlspecialchars($_POST['cttn5']);
    $apresiasi3 = htmlspecialchars($_POST['apresiasi3']);
    $cttn6 = htmlspecialchars($_POST['cttn6']);
    $ask = htmlspecialchars($_POST['ask']);
    $cttn7 = htmlspecialchars($_POST['cttn7']);
    $berkat = htmlspecialchars($_POST['berkat']);
    $cttn8 = htmlspecialchars($_POST['cttn8']);
    $date = htmlspecialchars($_POST['date']);
    mysqli_query($conn, "UPDATE `tb_blessings` SET `nis`='$nis',`date`='$date',`what_i_gain_on_god`='$god',`cttn1`='$cttn1',`what_i_learn_on_education`='$edu',`cttn2`='$cttn2',`what_i_learn_on_character_and_virtue`='$chracter',`cttn3`='$cttn3',`what_l_appreciate_toward_brother_sister`='$apresiasi1',`cttn4`='$cttn4',`what_l_appreciate_toward_my_trainers`='$apresiasi2',`cttn5`='$cttn5',`what_l_appreciate_toward_saints`='$apresiasi3',`cttn6`='$cttn6',`what_I_want_to_ask`='$ask',`cttn7`='$cttn7',`what_i_learn_the_most_this_month`='$berkat',`cttn8`='$cttn8' WHERE `tb_blessings`.`nis` ='$nis' AND `tb_blessings`.`date`='$date'");
}

// sistem penilaian my virtues & character
if (isset($_POST['btn_myvirtues'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $berbagi = htmlspecialchars($_POST['berbagi']);
    $salam = htmlspecialchars($_POST['salam']);
    $berterimakasih = htmlspecialchars($_POST['berterimakasih']);
    $hormat = htmlspecialchars($_POST['hormat']);
    $catatan = htmlspecialchars($_POST['catatan']);
    mysqli_query($conn, "INSERT INTO `tb_vrtues_caharacter`(`nis`, `perhatian_berbagi`, `salam_sapa`, `bersyukur_berterimakasih`, `hormat_taat`, `efata`, `catatan`) VALUES ('$nis','$berbagi','$salam','$berterimakasih','$hormat','$efata','$catatan')");
}
// sistem edit penilaian my virtues & character
if (isset($_POST['btn_virtue_character'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $berbagi = htmlspecialchars($_POST['berbagi']);
    $salam = htmlspecialchars($_POST['salam']);
    $ucapan = htmlspecialchars($_POST['ucapan']);
    $hormat = htmlspecialchars($_POST['hormat']);
    $catatan = htmlspecialchars($_POST['catatan']);
    mysqli_query($conn, "UPDATE `tb_vrtues_caharacter` SET `perhatian_berbagi`='$berbagi',`salam_sapa`='$salam',`bersyukur_berterimakasih`='$ucapan',`hormat_taat`='$hormat',`catatan`='$catatan' WHERE `tb_vrtues_caharacter`.`nis`='$nis'");
}

//sistem input penilaian virtues
if (isset($_POST['btn_submit_virtues'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $sikapramahsopan = htmlspecialchars($_POST['sikapramahsopan']);
    $sikapberkordinasi = htmlspecialchars($_POST['sikapberkordinasi']);
    $sikaptolongmenolong = htmlspecialchars($_POST['sikaptolongmenolong']);
    $sikapseedo = htmlspecialchars($_POST['sikapseedo']);
    $catatan = htmlspecialchars($_POST['catatan']);
    mysqli_query($conn, "INSERT INTO `tb_virtues`(`nis`, `efata`, `sikapramahsopan`, `sikapberkordinasi`, `sikaptolongmenolong`, `sikapseedo`,`catatan`) VALUES ('$nis','$efata','$sikapramahsopan','$sikapberkordinasi','$sikaptolongmenolong','$sikapseedo','$catatan')");
}
//sistem edit penilaian virtues
if (isset($_POST['btn_virtue'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $sikapramahsopan = htmlspecialchars($_POST['sikapramahsopan']);
    $sikapberkordinasi = htmlspecialchars($_POST['sikapberkordinasi']);
    $sikaptolongmenolong = htmlspecialchars($_POST['sikaptolongmenolong']);
    $sikapseedo = htmlspecialchars($_POST['sikapseedo']);
    $catatan = htmlspecialchars($_POST['catatan']);
    mysqli_query($conn, "UPDATE `tb_virtues` SET `sikapramahsopan`='$sikapramahsopan',`sikapberkordinasi`='$sikapberkordinasi',`sikaptolongmenolong`='$sikaptolongmenolong',`sikapseedo`='$sikapseedo',`catatan`='$catatan' WHERE  `tb_virtues`.`nis`='$nis'");
}



// input dat6a report weekly
if (isset($_POST['input'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $name = htmlspecialchars($_POST['name']);
    $presensi = htmlspecialchars($_POST['presensi']);
    $jurnaldaily = htmlspecialchars($_POST['jurnaldaily']);
    $jurnalweekly = htmlspecialchars($_POST['jurnalweekly']);
    $jurnalMonthly = htmlspecialchars($_POST['jurnalMonthly']);
    $virtue = htmlspecialchars($_POST['virtue']);
    $lemari = htmlspecialchars($_POST['lemari']);
    $sepatu = htmlspecialchars($_POST['sepatu']);
    $ranjang = htmlspecialchars($_POST['ranjang']);
    $total = htmlspecialchars($_POST['total']);
    $status = htmlspecialchars($_POST['status']);
    $Keterangan = htmlspecialchars($_POST['Keterangan']);
    mysqli_query($conn, "INSERT INTO `tb_reportweekly`(`nis`, `name`, `presensi`, `jurnal_daily`, `jurnal_weekly`, `jurnal_monthly`, `virtue`, `living_buku`, `living_sepatu_handuk`, `living_ranjang`, `total`, `status`, `keterangan`, `efata`) VALUES ('$nis','$name','$presensi','$jurnaldaily','$jurnalweekly','$jurnalMonthly','$virtue','$lemari','$sepatu','$ranjang','$total','$status','$Keterangan','$efata')");
}


if (isset($_POST['btnpenilaian'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $efata = htmlspecialchars($_POST['efata']);
    $benar = htmlspecialchars($_POST['benar']);
    $tepat = htmlspecialchars($_POST['tepat']);
    $ketat = htmlspecialchars($_POST['ketat']);
    $notes = htmlspecialchars($_POST['catatan']);
    mysqli_query($conn, "INSERT INTO `tb_character`(`nis`, `efata`, `benar`, `tepat`, `ketat`, `catatan`) VALUES ('$nis','$efata','$benar','$tepat','$ketat','$notes')");
}

if (isset($_POST['editcharacter'])) {
    $no_efata = htmlspecialchars($_POST['efata']);
    $nis = htmlspecialchars($_POST['nis']);
    $date = htmlspecialchars($_POST['date']);
    $benar = htmlspecialchars($_POST['benar']);
    $tepat = htmlspecialchars($_POST['tepat']);
    $ketat = htmlspecialchars($_POST['ketat']);
    $notes = htmlspecialchars($_POST['catatan']);
    mysqli_query($conn, "UPDATE `tb_character` SET `nis`='$nis',`efata`='$no_efata',`benar`='$benar',`tepat`='$tepat',`ketat`='$ketat',`catatan`='$notes' WHERE `tb_character`.`nis`='$nis' AND `tb_character`.`date`='$date' ");
}
