<!-- Modal living rak sepatu-->
<div class="modal fade" id="livinghanduk" tabindex="-1" aria-labelledby="livinghanduk" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="livingsendal">Handuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <!-- bungkus untuk form inputan -->
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
          <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
          <input type="hidden" class="form-control" id="smt" name="smt" value="<?= $data_semester; ?>">
          <label class="font-weight-bold">Jarak</label>
          <div class="form-group">
            <select class="form-control" name="jarak" aria-label="Default select example">
              <option selected>Pilih Poin</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>

          <label class="font-weight-bold">Posisi</label>
          <div class="form-group">
            <select class="form-control" name="posisi" aria-label="Default select example">
              <option selected>Pilih Poin</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>

          <label class="font-weight-bold">Rapi</label>
          <div class="form-group">
            <select class="form-control" name="rapi" aria-label="Default select example">
              <option selected>Pilih Poin</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>


          <label class="font-weight-bold">Bersih</label>
          <div class="form-group">
            <select class="form-control" name="bersih" aria-label="Default select example">
              <option selected>Pilih Poin</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>

          <label class="font-weight-bold">Raib</label>
          <div class="form-group">
            <select class="form-control" name="raib" aria-label="Default select example">
              <option selected>Pilih Poin</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>

          <div class="form-group">
            <label class="font-weight-bold" for="image">Foto</label>
            <input type="file" name="image" class="form-control-file" id="image">
          </div>

          <div class="form-group">
            <label class="font-weight-bold">Catatan Mentor :</label>
            <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" name="btn_input" class="btn btn-primary ">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="livingraksepatu" aria-hidden="true">
  <div class="modal-dialog" id="modal-edit">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="livingraksepatu">Edit Penilaian Handuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <!-- bungkus untuk form inputan -->
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
          <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
          <input type="hidden" class="form-control" id="smt" name="smt" value="<?= $data_semester; ?>">
          <input type="hidden" class="form-control" id="date" name="date">
          <label class="font-weight-bold">Jarak</label>
          <div class="form-group">
            <select class="form-control" id="jarak" name="jarak" aria-label="Default select example">
              <option selected>Pilih Poin</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>

          <label class="font-weight-bold">Posisi</label>
          <div class="form-group">
            <select class="form-control" id="posisi" name="posisi" aria-label="Default select example">
              <option selected>Pilih Poin</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>

          <label class="font-weight-bold">Rapi</label>
          <div class="form-group">
            <select class="form-control" id="rapi" name="rapi" aria-label="Default select example">
              <option selected>Pilih Poin</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>


          <label class="font-weight-bold">Bersih</label>
          <div class="form-group">
            <select class="form-control" id="bersih" name="bersih" aria-label="Default select example">
              <option selected>Pilih Poin</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>

          <label class="font-weight-bold">Raib</label>
          <div class="form-group">
            <select class="form-control" id="raib" name="raib" aria-label="Default select example">
              <option selected>Pilih Poin</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>

          <div class="form-group">
            <label for="image">Foto</label>
            <div class="padding-bottom:5px">
              <img src="" width="250px" id="foto">
            </div>
            <input type="file" name="foto" class="form-control-file mt-2" id="foto">
          </div>

          <div class="form-group">
            <label class="font-weight-bold">Catatan Mentor :</label>
            <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" name="btn_update" class="btn btn-warning">Simpan Perubahan</button>
        </div>
      </form>

    </div>
  </div>
</div>