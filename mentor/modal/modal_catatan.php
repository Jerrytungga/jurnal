  <!-- Modal -->
  <div class="modal fade" id="Catatan" tabindex="-1" aria-labelledby="Catatan" aria-hidden="true">
      <div class="modal-dialog" id="modal-edit">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="Catatan">Edit Catatan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <!-- bungkus untuk form inputan personal goal-->
              <form action="" method="POST">
                  <div class="modal-body">
                      <input type="hidden" class="form-control" id="nis" name="nis" placeholder="Title">
                      <div class="form-group">
                          <label class="form-text font-weight-bold">Judul :</label>
                          <textarea rows="5" type="text" class="form-control" id="title" name="title"></textarea>
                      </div>
                      <div class="form-group">
                          <label class="form-text font-weight-bold">Keterangan :</label>
                          <textarea rows="5" type="text" class="form-control" id="deskripsi" name="deskripsi"></textarea>
                      </div>
                      <div class="form-group">
                          <label class="text-reset font-weight-bold" for="catatan">Catatan Mentor :</label>
                          <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan"></textarea>
                      </div>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" name="btn_catatan" class="btn btn-warning">Simpan Perubahan</button>
                  </div>
              </form>

          </div>
      </div>
  </div>