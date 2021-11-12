 <?php
    // menampilkan data jurnal 
    $conn = mysqli_connect("127.0.0.1", "root", "#dbabsensipka#", "jurnal");
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

    // sistem submit/post di bagian jurnal personal goal
    if (isset($_POST['submit'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $date = date('Y-m-d');
        $Character = htmlspecialchars($_POST['Character']);
        $prayer = htmlspecialchars($_POST['prayer']);
        $Neutron = htmlspecialchars($_POST['Neutron']);
        $goal = mysqli_query($conn, "INSERT INTO `tb_personal_goal`(`nis`, `character_virtue`, `prayer`, `neutron`,`Catatan_mentor`) VALUES ('$nis','$Character','$prayer','$Neutron',NULL)");
        if ($goal) {
            echo '<script>alert("Terimakasih, jurnal anda berhasil di isi")</script>';
        } else {
            echo '<script>alert("Mohon Maaf Pengisian jurnal Hanya Sekali Saja")</script>';
        }
    }



    if (isset($_POST['btn_update_personalgoal'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $character = htmlspecialchars($_POST['character']);
        $prayer = htmlspecialchars($_POST['prayer']);
        $Neutron = htmlspecialchars($_POST['neutron']);
        $date = htmlspecialchars($_POST['date']);
        $goal = mysqli_query($conn, "UPDATE `tb_personal_goal` SET `nis`='$nis',`character_virtue`='$character',`prayer`='$prayer',`date`='$date',`neutron`='$Neutron' WHERE `tb_personal_goal`.`nis` ='$nis' AND `tb_personal_goal`.`date`='$date'");
    }



    // sistem submit/post di bagian jurnal revival note
    if (isset($_POST['revival_note'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $verse = htmlspecialchars($_POST['verse1']);
        $blessing = htmlspecialchars($_POST['blessing1']);
        $revival = mysqli_query($conn, "INSERT INTO `tb_revival_note`(`nis`, `verse`, `blessing`, `catatan_mentor`) VALUES ('$nis','$verse','$blessing',NULL)");
        if ($revival) {
            echo '<script>alert("Terimakasih, jurnal anda berhasil di isi")</script>';
        } else {
            echo '<script>alert("Mohon Maaf Pengisian jurnal Hanya Sekali Saja")</script>';
        }
    }


    // sistem edit revival note
    if (isset($_POST['btn_editrevivalnote'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $verse = htmlspecialchars($_POST['verse']);
        $blessing = htmlspecialchars($_POST['blessings']);
        $date = htmlspecialchars($_POST['date']);
        mysqli_query($conn, "UPDATE `tb_revival_note` SET `nis`='$nis',`verse`='$verse',`blessing`='$blessing' WHERE `tb_revival_note`.`nis` ='$nis' AND `tb_revival_note`.`date`='$date'");
    }


    // sistem submit/post di bagian jurnal prayer note
    if (isset($_POST['prayer_note'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $kategori = htmlspecialchars($_POST['kategori']);
        $burden_inward_sense = htmlspecialchars($_POST['burden_inward_sense']);
        $praye = mysqli_query($conn, "INSERT INTO `tb_prayer_note`(`nis`, `kategori`, `burden_inward_sense`, `catatan_mentor`) VALUES ('$nis','$kategori','$burden_inward_sense',NULL)");
        if ($praye) {
            echo '<script>alert("Terimakasih, jurnal anda berhasil di isi")</script>';
        } else {
            echo '<script>alert("Mohon Maaf Pengisian jurnal Hanya Sekali Saja")</script>';
        }
    }

    // sistem edit prayer note
    if (isset($_POST['btn_edit_prayernote'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $judul = htmlspecialchars($_POST['judul']);
        $beban = htmlspecialchars($_POST['beban']);
        $date = htmlspecialchars($_POST['date']);
        mysqli_query($conn, "UPDATE `tb_prayer_note` SET `kategori`='$judul',`burden_inward_sense`='$beban' WHERE `tb_prayer_note`.`nis` ='$nis' AND `tb_prayer_note`.`date` ='$date'");
    }




    // sistem submit/post di bagian jurnal bible reading
    if (isset($_POST['bible_reading'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $kitab = htmlspecialchars($_POST['kitab']);
        $OT = htmlspecialchars($_POST['OT']);
        $NT = htmlspecialchars($_POST['NT']);
        $bible = mysqli_query($conn, "INSERT INTO `tb_bible_reading`(`nis`, `bible`, `total_ot`, `total_nt`, `catatan_mentor`) VALUES ('$nis','$kitab','$OT','$NT',NULL)");
        if ($bible) {
            echo '<script>alert("Terimakasih, jurnal anda berhasil di isi")</script>';
        } else {
            echo '<script>alert("Mohon Maaf Pengisian jurnal Hanya Sekali Saja")</script>';
        }
    }

    // sistem edit bible
    if (isset($_POST['btn_editbible'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $bible = htmlspecialchars($_POST['bible']);
        $ot = htmlspecialchars($_POST['ot']);
        $nt = htmlspecialchars($_POST['nt']);
        $date = htmlspecialchars($_POST['date']);
        mysqli_query($conn, "UPDATE `tb_bible_reading` SET `bible`='$bible',`total_ot`='$ot',`total_nt`='$nt' WHERE `tb_bible_reading`.`nis` ='$nis' AND `tb_bible_reading`.`date` ='$date'");
    }


    // sistem submit/post di bagian jurnal exhibition
    if (isset($_POST['exhibition'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $verse = htmlspecialchars($_POST['verse_exhibition']);
        $blessing = htmlspecialchars($_POST['blessing_exhibition']);
        $exhibition = mysqli_query($conn, "INSERT INTO `tb_exhibition`(`nis`, `verse`, `point_of_blessing`, `catatan_mentor`) VALUES ('$nis','$verse','$blessing',NULL)");
        if ($exhibition) {
            echo '<script>alert("Terimakasih, jurnal anda berhasil di isi")</script>';
        } else {
            echo '<script>alert("Mohon Maaf Pengisian jurnal Hanya Sekali Saja")</script>';
        }
    }

    if (isset($_POST['btn_editexhibition'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $verse = htmlspecialchars($_POST['verse']);
        $pointblessings = htmlspecialchars($_POST['pointblessings']);
        $date = htmlspecialchars($_POST['date']);
        $exhibition = mysqli_query($conn, "UPDATE `tb_exhibition` SET `nis`='$nis',`verse`='$verse',`point_of_blessing`='$pointblessings' WHERE `tb_exhibition`.`nis`='$nis' AND `tb_exhibition`.`date`='$date'");
    }




    // sistem submit/post di bagian jurnal homemeeting
    if (isset($_POST['home_meeting'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $getandlern = htmlspecialchars($_POST['getandlern']);
        $homemeeting = mysqli_query($conn, "INSERT INTO `tb_home_meeting`(`nis`, `what_i_get_and_lern`, `catatan_mentor`) VALUES ('$nis','$getandlern',NULL)");
        if ($homemeeting) {
            echo '<script>alert("Terimakasih, jurnal anda berhasil di isi")</script>';
        } else {
            echo '<script>alert("Mohon Maaf Pengisian jurnal Hanya Sekali Saja")</script>';
        }
    }

    if (isset($_POST['btn_update_hommeeting'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $learn = htmlspecialchars($_POST['learn']);
        $date = htmlspecialchars($_POST['date']);
        $edithomemeeting = mysqli_query($conn, "UPDATE `tb_home_meeting` SET `nis`='$nis',`what_i_get_and_lern`='$learn' WHERE `tb_home_meeting`.`nis`='$nis' AND `tb_home_meeting`.`date`='$date' ");
    }


    // sistem submit/post di bagian jurnal blessings
    if (isset($_POST['blessing'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $god = htmlspecialchars($_POST['god']);
        $education = htmlspecialchars($_POST['education']);
        $character = htmlspecialchars($_POST['character']);
        $appreciate1 = htmlspecialchars($_POST['appreciate1']);
        $appreciate2 = htmlspecialchars($_POST['appreciate2']);
        $appreciate3 = htmlspecialchars($_POST['appreciate3']);
        $ask = htmlspecialchars($_POST['ask']);
        $thismonth = htmlspecialchars($_POST['thismonth']);
        $blessings1 = mysqli_query($conn, "INSERT INTO `tb_blessings`(`nis`, `what_i_gain_on_god`, `cttn1`, `what_i_learn_on_education`, `cttn2`, `what_i_learn_on_character_and_virtue`, `cttn3`, `what_l_appreciate_toward_brother_sister`, `cttn4`, `what_l_appreciate_toward_my_trainers`, `cttn5`, `what_l_appreciate_toward_saints`, `cttn6`, `what_I_want_to_ask`, `cttn7`, `what_i_learn_the_most_this_month`, `cttn8`, `catatan_mentor`) VALUES ('$nis','$god',NULL,'$education',NULL,'$character',NULL,'$appreciate1',NULL,'$appreciate2',NULL,'$appreciate3',NULL,'$ask',NULL,'$thismonth',NULL,NULL)");
        if ($blessings1) {
            echo '<script>alert("Terimakasih, jurnal anda berhasil di isi")</script>';
        } else {
            echo '<script>alert("Mohon Maaf Pengisian jurnal Hanya Sekali Saja")</script>';
        }
    }

    // sistem edit blessings
    if (isset($_POST['btn_blessings'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $god = htmlspecialchars($_POST['god']);
        $edu = htmlspecialchars($_POST['edu']);
        $chracter = htmlspecialchars($_POST['chracter']);
        $apresiasi1 = htmlspecialchars($_POST['apresiasi1']);
        $apresiasi2 = htmlspecialchars($_POST['apresiasi2']);
        $apresiasi3 = htmlspecialchars($_POST['apresiasi3']);
        $ask = htmlspecialchars($_POST['ask']);
        $berkat = htmlspecialchars($_POST['berkat']);
        $date = htmlspecialchars($_POST['date']);
        mysqli_query($conn, "UPDATE `tb_blessings` SET `nis`='$nis',`what_i_gain_on_god`='$god',`what_i_learn_on_education`='$edu',`what_i_learn_on_character_and_virtue`='$chracter',`what_l_appreciate_toward_brother_sister`='$apresiasi1',`what_l_appreciate_toward_my_trainers`='$apresiasi2',`what_l_appreciate_toward_saints`='$apresiasi3',`what_I_want_to_ask`='$ask',`what_i_learn_the_most_this_month`='$berkat' WHERE `tb_blessings`.`nis`='$nis' AND `tb_blessings`.`date`='$date'");
    }

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

    // sistem ganti password siswa
    if (isset($_POST['edit_profile'])) {
        $nis = htmlspecialchars($_POST['nis']);
        $password = htmlspecialchars($_POST['password']);
        $addtotable = mysqli_query($conn, "UPDATE `siswa` SET `password`='$password' WHERE `siswa`.`nis` = '$nis'");
        header('location:../profile.php');
    }
