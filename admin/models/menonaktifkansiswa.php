<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Angkatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Angkatan :</label>
            <select class="form-control" required name="angkatan" required id="angkatan" aria-label="Default select example">
              <option selected>Pilih Angkatan</option>
              <?php
              $angkatan = mysqli_query($conn, "SELECT * FROM tb_angkatan ");
              while ($dataangkatan = mysqli_fetch_array($angkatan)) {
                echo '<option value="' . $dataangkatan['angkatan'] . '">' . $dataangkatan['angkatan'] . '</option>';
              }
              ?>
              <!-- <input type="text" name="nis" required placeholder="Masukan Nis Siswa" class="form-control col-2 m-2"> -->
            </select>
          </div>
          <div class="form-group">
            <label for="">Status :</label>
            <select class="form-control " name="status" id="status" aria-label="Default select example" required>
              <option selected>Pilih Status</option>
              <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" name="simpan" class="btn btn-warning">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>