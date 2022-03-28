  <?php if (isset($notifsukses)) { ?>
    <script>
      Swal.fire({
        position: 'center',
        icon: 'info',
        title: 'Verifikasi Langkah Ke 2',
        showConfirmButton: false,
        html: ' <a href="contoh.php?nis=<?= $nis; ?>" class="btn btn-success text-light my-2 my-sm-0">Ambil Gambar</a>'
        // timer: 1500
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
  } else if (isset($notifdelete)) { ?>

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

  <?php } else if (isset($notifgagal)) { ?>

    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '<?php echo $notifgagal; ?>',

      })
    </script>

  <?php } else if (isset($pesan)) { ?>
    <script>
      Swal.fire({
        title: '<strong>Maintenance</strong>',
        icon: 'info',
        html: 'Saudara/i Jurnal akan ditutup pukul 20:00 WIB',
        showCloseButton: true,
        focusConfirm: true,
        confirmButtonAriaLabel: 'Thumbs up, great!',
      })
    </script>
  <?php } ?>