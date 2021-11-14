<!-- modal edit exhibition -->
<div class="modal fade" id="modal_edit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Change Home meeting </h5>
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
                        <label for="learn-text" class="col-form-label font-weight-bold">What I get and learn :</label>
                        <textarea rows="5" type="text" class="form-control" id="learn" name="learn">
                            </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_update_hommeeting" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- modal view exhibition -->
<div class="modal fade" id="modal_detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-detail">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Home Meeting Detail </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">

                <div class="form-group">
                    <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                    <input type="text" class="form-control" id="date" name="date" readonly></input>
                </div>
                <div class="form-group">
                    <label for="learn-text" class="col-form-label font-weight-bold">What I get and learn :</label>
                    <textarea rows="5" type="text" class="form-control" id="learn" readonly>
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


<!-- Modal Home Meeting-->
<div class="modal fade" id="homemeeting" tabindex="-1" aria-labelledby="homemeeting" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="homemeeting">Home Meeting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- bungkus untuk form -->
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                    <div class="form-group">
                        <label for="learn-text" class="col-form-label font-weight-bold">What I get and learn :</label>
                        <textarea rows="5" type="text" class="form-control" id="getandlern" name="getandlern" required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="home_meeting" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>