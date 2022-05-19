<!-- view -->
<div class="modal fade" id="modal_detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-detail">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Lihat Pengaturan Tujuan Pribadi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <div class="form-group">
                    <label for="date-text" class="col-form-label font-weight-bold">Tanggal :</label>
                    <input type="text" class="form-control" id="date" name="date" readonly></input>
                </div>
                <div class="form-group">
                    <label for="Character-text" class="col-form-label font-weight-bold">Kelas Kebajikan Karakter :</label>
                    <textarea rows="5" type="text" class="form-control" id="karakter" readonly>
                            </textarea>
                </div>
                <div class="form-group">
                    <label for="doa-text" class="col-form-label font-weight-bold">Kelas Doa :</label>
                    <textarea rows="5" type="text" class="form-control" id="doa" readonly>
                            </textarea>
                </div>
                <div class="form-group">
                    <label for="neutron-text" class="col-form-label font-weight-bold">Kelas Bimbel :</label>
                    <textarea rows="5" type="text" class="form-control" id="neutron" readonly>
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


<!-- Modal edit -->
<div class="modal fade" id="personalgoal" tabindex="-1" aria-labelledby="personalgoal" aria-hidden="true">
    <div class="modal-dialog" id="modal-edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="personalgoal">Edit Pengaturan Tujuan Pribadi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="nis" name="nis">
                    <input type="hidden" class="form-control" id="smt" name="smt" value="<?= $data_semester; ?>">
                    <div class="form-group">
                        <label for="date-text" class="col-form-label font-weight-bold">Tanggal :</label>
                        <input type="text" class="form-control" id="date" name="date" readonly></input>
                    </div>
                    <div class="form-group">
                        <label for="character-text" class="col-form-label font-weight-bold">Kelas Kebajikan Karakter :</label>
                        <textarea type="text" rows="5" class="form-control" id="character" name="character"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="prayer-text" class="col-form-label font-weight-bold">Kelas Doa :</label>
                        <textarea rows="5" type="text" class="form-control" id="prayer" name="prayer"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="neutron-text" class="col-form-label font-weight-bold">Kelas Bimbel :</label>
                        <textarea rows="5" type="text" class="form-control" id="neutron" name="neutron"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="btn_update_personalgoal" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal tambah data  -->
<div class="modal fade" id="PGSJ" tabindex="-1" aria-labelledby="PGSJ" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PGSJ">Pengaturan Tujuan Pribadi</h5>
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
                        <label for="Character-text" class="col-form-label font-weight-bold">Kelas Kebajikan Karakter :</label>
                        <textarea rows="5" type="text" class="form-control" id="Character" name="Character">
                            </textarea>
                    </div>
                    <div class="form-group">
                        <label for="prayer-text" class="col-form-label font-weight-bold">Kelas Doa :</label>
                        <textarea rows="5" type="text" class="form-control" id="prayer" name="prayer">
                            </textarea>
                    </div>
                    <div class="form-group">
                        <label for="prayer-text" class="col-form-label font-weight-bold">Kelas Bimbel :</label>
                        <textarea rows="5" type="text" class="form-control" id="Neutron" name="Neutron">
                            </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>