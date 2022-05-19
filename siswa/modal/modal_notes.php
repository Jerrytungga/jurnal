<div class="modal fade" id="notes" tabindex="-1" aria-labelledby="notes" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notes">Catatan Harian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- bungkus untuk form -->
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                    <div class="form-group">
                        <label for="title">Judul :</label>
                        <input type="text" class="form-control" id="jd_diary" name="jd_diary" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="descrition">Keterangan :</label>
                        <textarea rows="5" type="text" class="form-control" id="isi_diary" name="isi_diary" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="catatan" class="btn btn-primary">Simpan</button>
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
                <h5 class="modal-title" id="notes">Edit Catatan Harian </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" method="POST">
                <div class="modal-body" id="modal-edit">
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="form-group">
                        <label for="judul-text" class="col-form-label font-weight-bold">Judul :</label>
                        <textarea rows="5" type="text" class="form-control" id="judul" name="judul"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi-text" class="col-form-label font-weight-bold">Keterangan :</label>
                        <textarea rows="5" type="text" class="form-control" id="deskripsi" name="deskripsi"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="perubahan" id="perubahan" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-hapus">
        <div class="modal-content">

            <form method="POST">
                <div class="modal-body">
                    <h5>Apakah Anda yakin ingin menghapus data ?</h5>
                    <input type="hidden" class="form-control" id="id" name="id">
                    <input type="text" readonly class="form-control" id="date" name="date">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TIDAK</button>
                    <button type="submit" name="hapus" class="btn btn-danger">IYA</button>
                </div>
            </form>
        </div>
    </div>
</div>