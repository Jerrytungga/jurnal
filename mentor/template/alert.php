  <?php if (isset($notifdelete)) { ?>
    <script>
      Swal.fire({
        position: 'top-end',
        size: '20px',
        icon: 'success',
        title: '<?php echo $notifdelete; ?>',
        showConfirmButton: false,
        timer: 1500
      })
    </script>

    <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($notif);
  } else if (isset($notifgagal)) { ?>

    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '<?php echo $notifgagal; ?>',

      })
    </script>

  <?php
  } else if (isset($notifsuksesedit)) { ?>
    <script>
      Swal.fire({
        position: 'top-end',
        size: '20px',
        icon: 'success',
        title: '<?php echo $notifsuksesedit; ?>',
        showConfirmButton: false,
        timer: 1500
      })
    </script>

  <?php  } else if (isset($notifgagaledit)) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '<?php echo $notifgagaledit; ?>',

      })
    </script>
  <?php
  } else if (isset($notifinput)) { ?>
    <script>
      Swal.fire({
        position: 'top-end',
        size: '20px',
        icon: 'success',
        title: '<?php echo $notifinput; ?>',
        showConfirmButton: false,
        timer: 1500
      })
    </script>
  <?php } else if (isset($notifgagalinput)) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '<?php echo $notifgagalinput; ?>',
      })
    </script>
  <?php } else if (isset($insertpresensi)) { ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '<?php echo $insertpresensi; ?>',
      })
    </script>
  <?php } else if (isset($gagalinsertpresensi)) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '<?php echo $gagalinsertpresensi; ?>',
      })
    </script>
  <?php } else if (isset($cek_data_presensi)) { ?>
    <script>
      Swal.fire({
        title: '<p class="text-danger"><strong>Announcement!</strong></p>',
        icon: 'info',
        html: '<p class=" text-uppercase"><b><?= nama_siswa($nis) ?></b><br><br> has made a presence at schedule </p><p class=" text-capitalize"><?= kegiatan($activity); ?> || <b>Time <?= $timeabsent; ?> WIB </b> </p>',
        footer: '<?php echo $cek_data_presensi; ?>',
        showCloseButton: true,
        focusConfirm: true,
        confirmButtonAriaLabel: 'Thumbs up, great!',
      })
    </script>
  <?php } ?>