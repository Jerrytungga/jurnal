<!-- profile Modal -->
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
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body" id="modal-edit">
                    <input type="hidden" class="form-control" id="nis" name="nis">
                    <div class="form-group">
                        <h7 class="text-reset" for="password">Masukan Password Baru :</h7>
                        <input type="text" class="form-control mt-2" id="password" name="password">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="edit_profile" id="edit_profile" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>