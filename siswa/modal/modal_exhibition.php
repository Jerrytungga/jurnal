    <!-- edit exhibition -->
    <div class="modal fade" id="edit_exhibition" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Change Exhibition </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body table-responsive">
                        <input type="hidden" class="form-control" id="nis" name="nis">
                        <div class="form-group">
                            <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                            <input type="text" class="form-control" id="date" name="date" readonly></input>
                        </div>
                        <div class="form-group">
                            <label for="verse-text" class="col-form-label font-weight-bold">Verse :</label>
                            <textarea rows="5" type="text" class="form-control" id="verse" name="verse">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="doa-text" class="col-form-label font-weight-bold">Point of Blessing :</label>
                            <textarea rows="5" type="text" class="form-control" id="pointblessings" name="pointblessings">
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_editexhibition" class="btn btn-primary">Save</button>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Exhibition Detail </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">

                    <div class="form-group">
                        <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                        <p type="text" class="form-control" id="date" readonly></p>
                    </div>
                    <div class="form-group">
                        <label for="verse-text" class="col-form-label font-weight-bold">Verse :</label>
                        <textarea rows="5" type="text" class="form-control" id="verse" readonly>
                            </textarea>
                    </div>
                    <div class="form-group">
                        <label for="doa-text" class="col-form-label font-weight-bold">Point of Blessing :</label>
                        <textarea rows="5" type="text" class="form-control" id="pointblessings" readonly>
                            </textarea>
                    </div>
                    <div class="form-group">
                        <label for="notes-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                        <textarea rows="5" type="text" class="form-control font-weight-bold text-primary font-italic" id="mentor" readonly>
                            </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal tambah exhibition -->
    <div class="modal fade" id="Exhibition" tabindex="-1" aria-labelledby="Exhibition" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Exhibition">Exhibition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- bungkus untuk form -->
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                        <div class="form-group">
                            <label for="verse-text" class="col-form-label font-weight-bold">Verse :</label>
                            <textarea rows="5" type="text" class="form-control" id="verse_exhibition" name="verse_exhibition"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="poin-text" class="col-form-label font-weight-bold">Point of Blessing :</label>
                            <textarea rows="5" type="text" class="form-control" id="blessing_exhibition" name="blessing_exhibition"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="exhibition" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>