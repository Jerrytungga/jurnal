<!-- view -->
<div class="modal fade" id="modal_detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-detail">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Revival Note Detail</h5>
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
                    <label for="blessings-text" class="col-form-label font-weight-bold">Blessing :</label>
                    <textarea rows="5" type="text" class="form-control" id="blessings" readonly>
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




<!-- Edit Revival Note -->
<div class="modal fade" id="revival_note" tabindex="-1" aria-labelledby="revival_note" aria-hidden="true">
    <div class="modal-dialog" id="modal-edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="revival_note">Change Revival Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- bungkus untuk form -->
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="nis" name="nis">
                    <div class="form-group">
                        <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                        <input type="text" class="form-control" id="date" name="date" readonly></input>
                    </div>
                    <div class="form-group">
                        <label for="verse-text" class="col-form-label font-weight-bold">Verse :</label>
                        <textarea rows="5" type="text" class="form-control" id="verse" name="verse"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="blessings-text" class="col-form-label font-weight-bold">Blessing :</label>
                        <textarea rows="5" type="text" class="form-control" id="blessings" name="blessings"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_editrevivalnote" class="btn btn-success">Save</button>
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
                <h5 class="modal-title" id="Revivalnote">Revival Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- bungkus untuk form -->
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                    <div class="form-group">
                        <label for="verse1-text" class="col-form-label font-weight-bold">Verse :</label>
                        <textarea rows="5" type="text" class="form-control" id="verse1" name="verse1">
                            </textarea>
                    </div>
                    <div class="form-group">
                        <label for="blessing1-text" class="col-form-label font-weight-bold">Blessing :</label>
                        <textarea rows="5" type="text" class="form-control" id="blessing1" name="blessing1">
                            </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="revival_note" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>