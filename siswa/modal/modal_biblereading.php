<!-- Modal bible reading-->
<div class="modal fade" id="biblereading" tabindex="-1" aria-labelledby="biblereading" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="biblereading">Pembacaan Alkitab</h5>
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

                        <select class="form-control" name="kitab" id="kitab" aria-label="Default select example" required>
                            <option selected>Pilih Kitab</option>
                            <option value="OTNT">OTNT</option>
                            <option value="OT">OT</option>
                            <option value="NT">NT</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="OT" id="OT" aria-label="Default select example" required>
                            <option selected>Pilih Total Pasal OT</option>
                            <option value="Tidak Baca">Tidak Baca</option>
                            <option value="1 Pasal">1 Pasal</option>
                            <option value="2 Pasal">2 Pasal</option>
                            <option value="3 Pasal">3 Pasal</option>
                            <option value="4 Pasal">4 Pasal</option>
                            <option value="5 Pasal">5 Pasal</option>
                            <option value="6 Pasal">6 Pasal</option>
                            <option value="7 Pasal">7 Pasal</option>
                            <option value="8 Pasal">8 Pasal</option>
                            <option value="9 Pasal">9 Pasal</option>
                            <option value="10 Pasal">10 Pasal</option>
                            <option value="11 Pasal">11 Pasal</option>
                            <option value="12 Pasal">12 Pasal</option>
                            <option value="13 Pasal">13 Pasal</option>
                            <option value="14 Pasal">14 Pasal</option>
                            <option value="15 Pasal">15 Pasal</option>
                            <option value="16 Pasal">16 Pasal</option>
                            <option value="17 Pasal">17 Pasal</option>
                            <option value="18 Pasal">18 Pasal</option>
                            <option value="19 Pasal">19 Pasal</option>
                            <option value="20 Pasal">20 Pasal</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <select class="form-control" name="NT" id="NT" aria-label="Default select example" required>
                            <option selected>Pilih Total Pasal NT</option>
                            <option value="Tidak Baca">Tidak Baca</option>
                            <option value="1 Pasal">1 Pasal</option>
                            <option value="2 Pasal">2 Pasal</option>
                            <option value="3 Pasal">3 Pasal</option>
                            <option value="4 Pasal">4 Pasal</option>
                            <option value="5 Pasal">5 Pasal</option>
                            <option value="6 Pasal">6 Pasal</option>
                            <option value="7 Pasal">7 Pasal</option>
                            <option value="8 Pasal">8 Pasal</option>
                            <option value="9 Pasal">9 Pasal</option>
                            <option value="10 Pasal">10 Pasal</option>
                            <option value="11 Pasal">11 Pasal</option>
                            <option value="12 Pasal">12 Pasal</option>
                            <option value="13 Pasal">13 Pasal</option>
                            <option value="14 Pasal">14 Pasal</option>
                            <option value="15 Pasal">15 Pasal</option>
                            <option value="16 Pasal">16 Pasal</option>
                            <option value="17 Pasal">17 Pasal</option>
                            <option value="18 Pasal">18 Pasal</option>
                            <option value="19 Pasal">19 Pasal</option>
                            <option value="20 Pasal">20 Pasal</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="bible_reading" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal edit bible reading-->
<div class="modal fade" id="editbiblereading" tabindex="-1" aria-labelledby="biblereading" aria-hidden="true">
    <div class="modal-dialog" id="modal-edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="biblereading">Edit Pembacaan Alkitab</h5>
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
                        <select class="form-control" name="bible" id="bible" aria-label="Default select example" required>
                            <option selected>Pilih Kitab</option>
                            <option value="OTNT">OTNT</option>
                            <option value="OT">OT</option>
                            <option value="NT">NT</option>

                        </select>
                    </div>


                    <div class="form-group">
                        <select class="form-control" name="ot" id="ot" aria-label="Default select example" required>
                            <option selected>Pilih Total Pasal OT</option>
                            <option value="Tidak Baca">Tidak Baca</option>
                            <option value="1 Pasal">1 Pasal</option>
                            <option value="2 Pasal">2 Pasal</option>
                            <option value="3 Pasal">3 Pasal</option>
                            <option value="4 Pasal">4 Pasal</option>
                            <option value="5 Pasal">5 Pasal</option>
                            <option value="6 Pasal">6 Pasal</option>
                            <option value="7 Pasal">7 Pasal</option>
                            <option value="8 Pasal">8 Pasal</option>
                            <option value="9 Pasal">9 Pasal</option>
                            <option value="10 Pasal">10 Pasal</option>
                            <option value="11 Pasal">11 Pasal</option>
                            <option value="12 Pasal">12 Pasal</option>
                            <option value="13 Pasal">13 Pasal</option>
                            <option value="14 Pasal">14 Pasal</option>
                            <option value="15 Pasal">15 Pasal</option>
                            <option value="16 Pasal">16 Pasal</option>
                            <option value="17 Pasal">17 Pasal</option>
                            <option value="18 Pasal">18 Pasal</option>
                            <option value="19 Pasal">19 Pasal</option>
                            <option value="20 Pasal">20 Pasal</option>
                        </select>

                    </div>


                    <div class="form-group">
                        <select class="form-control" name="nt" id="nt" aria-label="Default select example" required>
                            <option selected>Pilih Total Pasal NT</option>
                            <option value="Tidak Baca">Tidak Baca</option>
                            <option value="1 Pasal">1 Pasal</option>
                            <option value="2 Pasal">2 Pasal</option>
                            <option value="3 Pasal">3 Pasal</option>
                            <option value="4 Pasal">4 Pasal</option>
                            <option value="5 Pasal">5 Pasal</option>
                            <option value="6 Pasal">6 Pasal</option>
                            <option value="7 Pasal">7 Pasal</option>
                            <option value="8 Pasal">8 Pasal</option>
                            <option value="9 Pasal">9 Pasal</option>
                            <option value="10 Pasal">10 Pasal</option>
                            <option value="11 Pasal">11 Pasal</option>
                            <option value="12 Pasal">12 Pasal</option>
                            <option value="13 Pasal">13 Pasal</option>
                            <option value="14 Pasal">14 Pasal</option>
                            <option value="15 Pasal">15 Pasal</option>
                            <option value="16 Pasal">16 Pasal</option>
                            <option value="17 Pasal">17 Pasal</option>
                            <option value="18 Pasal">18 Pasal</option>
                            <option value="19 Pasal">19 Pasal</option>
                            <option value="20 Pasal">20 Pasal</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="btn_editbible" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>
</div>



<!-- view -->
<div class="modal fade" id="modal_detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-detail">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Lihat Pembacaan Alkitab</h5>
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
                    <label for="date-text" class="col-form-label font-weight-bold">Kitab :</label>
                    <p type="text" class="form-control" id="bible" readonly></p>
                </div>
                <div class="form-group">
                    <label for="date-text" class="col-form-label font-weight-bold">Total Pasal OT :</label>
                    <p type="text" class="form-control" id="ot" readonly></p>
                </div>
                <div class="form-group">
                    <label for="date-text" class="col-form-label font-weight-bold">Total Pasal NT :</label>
                    <p type="text" class="form-control" id="nt" readonly></p>
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