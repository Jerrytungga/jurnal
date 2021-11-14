<div class="modal fade" id="notes" tabindex="-1" aria-labelledby="notes" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notes">New Diary </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- bungkus untuk form -->
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                    <div class="form-group">
                        <label for="title">Title :</label>
                        <input type="text" class="form-control" id="jd_diary" name="jd_diary" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="descrition">Description :</label>
                        <textarea rows="5" type="text" class="form-control" id="isi_diary" name="isi_diary" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="catatan" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit catatan harian -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notes">Edit Diary </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" method="POST">
                <div class="modal-body" id="modal-edit">
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="form-group">
                        <label for="judul-text" class="col-form-label font-weight-bold">Title :</label>
                        <textarea rows="5" type="text" class="form-control" id="judul" name="judul"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi-text" class="col-form-label font-weight-bold">Description :</label>
                        <textarea rows="5" type="text" class="form-control" id="deskripsi" name="deskripsi"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="perubahan" id="perubahan" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>