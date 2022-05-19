<!-- view -->
<div class="modal fade" id="modal_detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-detail">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Lihat Penyegaran Pagi (saat teduh)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">

                <div class="form-group">
                    <label for="date-text" class="col-form-label font-weight-bold">Tanggal :</label>
                    <p type="text" class="form-control" id="date" readonly></p>
                </div>
                <div class="form-group">
                    <label for="verse-text" class="col-form-label font-weight-bold">Ayat Alkitab :</label>
                    <textarea rows="5" type="text" class="form-control" id="verse" readonly>
                            </textarea>
                </div>
                <div class="form-group">
                    <label for="blessings-text" class="col-form-label font-weight-bold">Berkat :</label>
                    <textarea rows="5" type="text" class="form-control" id="blessings" readonly>
                            </textarea>
                </div>
                <div class="form-group">
                    <label for="notes-text" class="col-form-label font-weight-bold">Catatan Mentor :</label>
                    <textarea rows="5" type="text" class="form-control font-weight-bold text-primary font-italic" id="mentor" readonly>
                            </textarea>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Edit Revival Note -->
<div class="modal fade" id="revival_note" tabindex="-1" aria-labelledby="revival_note" aria-hidden="true">
    <div class="modal-dialog" id="modal-edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="revival_note">Edit Penyegaran Pagi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- bungkus untuk form -->
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="nis" name="nis">
                    <input type="hidden" class="form-control" id="smt" name="smt" value="<?= $data_semester; ?>">
                    <div class="form-group">
                        <label for="date-text" class="col-form-label font-weight-bold">Tanggal :</label>
                        <input type="text" class="form-control" id="date" name="date" readonly></input>
                    </div>
                    <div class="form-group">
                        <label for="verse-text" class="col-form-label font-weight-bold">Ayat Alkitab :</label>
                        <textarea rows="5" type="text" class="form-control" id="verse" name="verse"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="blessings-text" class="col-form-label font-weight-bold">Berkat :</label>
                        <textarea rows="5" type="text" class="form-control" id="blessings" name="blessings"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="btn_editrevivalnote" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>
</div>





<!-- proses input jurnal revival note -->
<div class="modal fade" id="Revivalnote" tabindex="-1" aria-labelledby="Revivalnote" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Revivalnote">Penyegaran Pagi (Saat Teduh)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- bungkus untuk form -->
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                    <input type="hidden" class="form-control" id="smt" name="smt" value="<?= $data_semester; ?>">
                    <div class="form-group">
                        <label for="verse1-text" class="col-form-label font-weight-bold">Ayat Alkitab :</label>
                        <textarea rows="5" type="text" class="form-control" id="verse1" name="verse1">
                            </textarea>
                    </div>
                    <div class="form-group">
                        <label for="blessing1-text" class="col-form-label font-weight-bold">Berkat :</label>
                        <textarea rows="5" type="text" class="form-control" id="blessing1" name="blessing1">
                            </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="revival_note" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>