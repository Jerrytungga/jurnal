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
  if (isset($notifgagal)) { ?>

    <script>
      Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: '<?php echo $notifgagal; ?>',

      })
    </script>

  <?php unset($notifgagal);
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
  <?php  } elseif (isset($Announcement)) { ?>

    <script>
      Swal.fire({
        icon: 'warning',
        title: '<p class="text-danger"><strong>Announcement!</strong></p>',
        html: '<?php echo $Announcement; ?>'
      })
    </script>
  <?php unset($Announcement);
  }
  ?>