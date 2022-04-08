  <?php
  function name($name_absent)
  {
    global $conn;
    $sqly2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$name_absent'"));
    return $sqly2['name'];
  }
  function kegiatan($name_kegiatan)
  {
    global $conn;
    $sqly3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$name_kegiatan'"));
    return $sqly3['items'];
  }

  if (isset($notifsukses)) { ?>
    <script>
      Swal.fire({
        position: 'center',
        icon: 'info',
        title: '<div id="my_camera"></div>',
        showConfirmButton: false,
        html: ' <a href="contoh.php?nis=<?= $_POST['nis']; ?>&id=<?= $id_kegiatan; ?>" class="btn btn-success text-light my-2 my-sm-0">Ambil Gambar</a>'
        // timer: 1500
      })
    </script>

    <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($notifsukses);
  } else if (isset($notifgagal)) { ?>

    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '<?php echo $notifgagal; ?>',

      })
    </script>

  <?php

  } elseif (isset($cekdata)) {
    $cek_data_absesnt = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `absent` WHERE nis='$nis' and `schedule_id`='$id_kegiatan'"));
    $timeabsent = $sql_schedule5['absent_time'];

  ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: '<p class="text-danger"><strong>Announcement!</strong></p>',
        html: '<p class=" text-uppercase"><b><?= name($_POST['nis']) ?></b><br><br> Have done the presence before </p>',
        footer: '<?php echo $cekdata; ?>'
      })
    </script>
  <?php  }
  ?>