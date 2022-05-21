<!-- Modal Menampilkan data target -->
<div class="modal fade" id="targetpoin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Target Poin Presensi</h5>
        <?php
        date_default_timezone_set('Asia/Jakarta');
        $hari_ini = date('Y-m-d');
        $waktu_sekarang = date('H:i:s');
        $cek_target = mysqli_query($conn, "SELECT target, date FROM `tb_target_presensi` where date='$hari_ini '");
        $cektarget = mysqli_num_rows($cek_target);
        if ($cektarget < 2) { ?>
          <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#targettambah">
            Tambah Target Presensi
          </button>
        <?php    }
        ?>


        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
        <span aria-hidden="true">&times;</span>

        <?php
        $sqli_target = mysqli_query($conn, "SELECT * FROM `tb_target_presensi` where date='$hari_ini'  ORDER BY date DESC");
        $data_target = mysqli_fetch_array($sqli_target);
        ?>
      </div>
      <div class="modal-body">

        <table class="table table-striped">
          <thead class="bg-dark text-light">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Angkatan</th>
              <th scope="col">Hari</th>
              <th scope="col">Target</th>
              <th scope="col">Minggu</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php $T = 1; ?>
            <?php foreach ($sqli_target as $row2) : ?>
              <tr>
                <th scope="row"><?= $T; ?></th>
                <td><?= $row2['batch']; ?></td>
                <td><?= $row2['Day']; ?></td>
                <td><?= $row2['target']; ?></td>
                <td><?= $row2['week']; ?></td>
                <td><?= $row2['date']; ?></td>
                <td>
                  <?php
                  if ($row2['date'] == $hari_ini) { ?>
                    <a id="edit_items" data-toggle="modal" data-target="#edit_target_m" data-id_taget_presensi="<?= $row2["id_tabel_presence"]; ?>" data-hari="<?= $row2["Day"]; ?>" data-target2="<?= $row2["target"]; ?>" data-angkatan2="<?= $row2["batch"]; ?>" data-week="<?= $row2["week"]; ?>">
                      <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button></a>
                  <?php  }
                  ?>

                </td>
              </tr>
              <?php $T++; ?>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>







<div class="modal fade" id="targettambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Target</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
        <span aria-hidden="true">&times;</span>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <div class="form-row">
            <div class="col">
              <label for="Day">Hari</label>
              <select class="form-control" name="Day" required>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
              </select>
            </div>
            <div class="col">
              <label for="target">Target</label>
              <input type="text" name="target" class="form-control" required>
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              <label for="angkatan1">Angkatan</label>
              <select class="form-control" name="angkatan1" required>
                <option selected>Pilih Angkatan</option>
                <?php
                // looping data ankatan
                $sql_angkatan = mysqli_query($conn, "SELECT * FROM tb_angkatan") or die(mysqli_error($conn));
                while ($data_angkatan = mysqli_fetch_array($sql_angkatan)) {
                  echo '<option value="' . $data_angkatan['angkatan'] . '">' . $data_angkatan['angkatan'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col">
              <label for="target">Minggu</label>
              <input type="number" name="week" class="form-control" required>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" name="addtarget" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="edit_target_m" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Target</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
        <span aria-hidden="true">&times;</span>
      </div>
      <div class="modal-body" id="modal-edittarget">
        <form action="" method="POST">
          <input type="hidden" name="id_taget_presensi" id="id_taget_presensi" class="form-control">
          <div class="form-row">
            <div class="col">
              <label for="Day">Hari</label>
              <select class="form-control" name="hari" id="hari">
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
              </select>
            </div>

            <div class="col">
              <label for="target">Target</label>
              <input type="text" name="target2" id="target2" class="form-control">
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              <label for="angkatan1">Angkatan</label>
              <select class="form-control" id="angkatan2" name="angkatan2" required>
                <option selected>Pilih Angkatan</option>
                <?php
                // looping data ankatan
                $sql_angkatan = mysqli_query($conn, "SELECT * FROM tb_angkatan") or die(mysqli_error($conn));
                while ($data_angkatan = mysqli_fetch_array($sql_angkatan)) {
                  echo '<option value="' . $data_angkatan['angkatan'] . '">' . $data_angkatan['angkatan'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col">
              <label for="target">Minggu</label>
              <input type="number" name="week" id="week" class="form-control">
            </div>
          </div><br>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" name="updatetarget" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>