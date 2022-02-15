<!-- Modal Buku-->
<div class="modal fade" id="Buku" tabindex="-1" aria-labelledby="Buku" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="Buku">Living Buku</h5>
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
          <label class="font-weight-bold">Posisi :</label>
          <div class="form-group">
            <select class="form-control" name="posisi" aria-label="Default select example">
              <option selected>Select</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>


          <label class="font-weight-bold">Tinggi/Rendah :</label>
          <div class="form-group">
            <select class="form-control" name="tinggi/rendah" aria-label="Default select example">
              <option selected>Select</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>


          <label class="font-weight-bold">Rapi :</label>
          <div class="form-group">
            <select class="form-control" name="rapi" aria-label="Default select example">
              <option selected>Select</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>


          <label class="font-weight-bold">Bersih :</label>
          <div class="form-group">
            <select class="form-control" name="bersih" aria-label="Default select example">
              <option selected>Select</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>


          <label class="font-weight-bold">Raib :</label>
          <div class="form-group">
            <select class="form-control" name="raib" aria-label="Default select example">
              <option selected>Select</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>

          <label class="font-weight-bold">Benda Asing :</label>
          <div class="form-group">
            <select class="form-control" name="barangasing" aria-label="Default select example">
              <option selected>Select</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
              <option value="-2">-2</option>
              <option value="-3">-3</option>
              <option value="-4">-4</option>
              <option value="-5">-5</option>
              <option value="-6">-6</option>
              <option value="-7">-7</option>
              <option value="-8">-8</option>
              <option value="-9">-9</option>
              <option value="-10">-10</option>
            </select>
          </div>


          <div class="form-group">
            <label class="font-weight-bold" for="image">Foto</label>
            <input type="file" name="image" class="form-control-file" id="image">
          </div>

          <div class="form-group">
            <label class="font-weight-bold">Mentor Notes :</label>
            <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="btn_input" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>


<!-- Modal edit penilaian Buku-->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="Buku" aria-hidden="true">
  <div class="modal-dialog" id="modal-edit">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="Buku">Change Living Buku</h5>
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
          <label class="font-weight-bold">Posisi :</label>
          <div class="form-group">
            <select class="form-control" name="posisi" id="posisi" aria-label="Default select example">
              <option selected>Select</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>


          <label class="font-weight-bold">Tinggi/Rendah :</label>
          <div class="form-group">
            <select class="form-control" name="tinggirendah" id="tinggirendah" aria-label="Default select example">
              <option selected>Select</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>


          <label class="font-weight-bold">Rapi :</label>
          <div class="form-group">
            <select class="form-control" name="rapi" id="rapi" aria-label="Default select example">
              <option selected>Select</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>


          <label class="font-weight-bold">Bersih :</label>
          <div class="form-group">
            <select class="form-control" name="bersih" id="bersih" aria-label="Default select example">
              <option selected>Select</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>


          <label class="font-weight-bold">Raib :</label>
          <div class="form-group">
            <select class="form-control" name="raib" id="raib" aria-label="Default select example">
              <option selected>Select</option>
              <option value="1">1</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
            </select>
          </div>

          <label class="font-weight-bold">Benda Asing :</label>
          <div class="form-group">
            <select class="form-control" id="brngasing" name="brngasing" aria-label="Default select example">
              <option selected>Select</option>
              <option value="0">0</option>
              <option value="-1">-1</option>
              <option value="-2">-2</option>
              <option value="-3">-3</option>
              <option value="-4">-4</option>
              <option value="-5">-5</option>
              <option value="-6">-6</option>
              <option value="-7">-7</option>
              <option value="-8">-8</option>
              <option value="-9">-9</option>
              <option value="-10">-10</option>
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
            <label class="font-weight-bold">Mentor Notes :</label>
            <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="btn_update" class="btn btn-warning">Update</button>
        </div>
      </form>

    </div>
  </div>
</div>