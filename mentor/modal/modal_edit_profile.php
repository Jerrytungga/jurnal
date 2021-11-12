<div class="modal fade" id="edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit_siswa">Ganti Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- bungkus untuk form -->
        <form action="modal/function.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body" id="modal-edit">
          <input type="hidden" class="form-control" id="efata" name="efata">
            <div class="form-group">
              <h7 class="text-reset" for="password">Masukan Password Baru :</h7>
              <input type="text" class="form-control" id="password" name="password">
            </div>
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="edit_profile" id="edit_profile" class="btn btn-warning">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>