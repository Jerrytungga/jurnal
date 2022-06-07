<!-- modal foto -->
<!-- Modal -->
<div class="modal fade" id="gambar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" id="modal-gambar">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Foto Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
          <div class="padding-bottom:7px">
            <img src="../img/verifikasi/<?= $row["image"]; ?>" width="455px" height="400px" id="gambar">
          </div>
        </center>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="tanggal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <div class="col">
          <form action="" method="POST" class="form-inline">
            <?php
            if (isset($_POST['filter_tanggal'])) {
              $mulai = $_POST['tanggal_mulai'];
              $selesai = $_POST['tanggal_akhir'];
            ?>
              <input type="date" name="tanggal_mulai" value="<?= $mulai ?>" class="form-control">
              <input type="date" name="tanggal_akhir" value="<?= $selesai ?>" class="form-control ml-3">
            <?php
            } else {
            ?>
              <input type="date" name="tanggal_mulai" class="form-control">
              <input type="date" name="tanggal_akhir" class="form-control ml-3">
            <?php } ?>
            <button type="submit" name="filter_tanggal" class="btn btn-info ml-3">Filter</button>
            <button type="submit" name="reset" value="reset" class="btn btn-danger ml-3">Reset</button>
          </form>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Schedule</th>
              <th scope="col">Waktu Mulai</th>
              <th scope="col">Waktu Akhir</th>
              <th scope="col">Week</th>
              <th scope="col">Date</th>

            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($tamplkan_data as $row2) : ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= Kegiatan_1($row2["id"]); ?></td>
                <td><?= $row2["start_time"]; ?></td>
                <td><?= $row2["end_time"]; ?></td>
                <td><?= $row2["week"]; ?></td>
                <td><?= $row2["date"]; ?></td>

              </tr>
              <?php $i++; ?>
            <?php endforeach;
            ?>
          </tbody>
        </table>



      </div>

    </div>
  </div>
</div>