<!-- Modal CHARACTER -->
<div class="modal fade" id="CHARACTER" tabindex="-1" aria-labelledby="Character" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title font-weight-bold" id="Character">Karakter</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <!-- bungkus untuk form inputan -->
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                    <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                    <input type="hidden" class="form-control" id="smt" name="smt" value="<?= $data_semester; ?>">
                    <label class="font-weight-bold">Benar :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="benar" id="benar">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>

                    <label class="font-weight-bold">Tepat :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="tepat" id="tepat">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>

                    <label class="font-weight-bold">Ketat :</label>
                    <div class="form-group">
                        <select class="form-control" name="ketat" id="ketat" aria-label="Default select example">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Catatan Mentor :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan"></textarea>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning" name="btnpenilaian">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>


<!-- modal edit -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" id="modal-edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit">Edit Karakter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                    <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                    <input type="hidden" class="form-control" id="smt" name="smt" value="<?= $data_semester; ?>">

                    <div class="form-group">
                        <label class="font-weight-bold">Tanggal :</label>
                        <input type="text" class="form-control" id="date" name="date" readonly>
                    </div>
                    <label class=" font-weight-bold" for="berbagi">Benar :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="benar" id="benar">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>
                    <label class=" font-weight-bold">Tepat :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="tepat" id="tepat">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>

                    <label class="font-weight-bold">Ketat :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="ketat" id="ketat">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label class="font-weight-bold">Catatan Mentor :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning" name="editcharacter">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>