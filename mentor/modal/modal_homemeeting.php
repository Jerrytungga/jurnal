    <!-- Modal -->
    <div class="modal fade" id="home_meeting" tabindex="-1" aria-labelledby="home_meeting" aria-hidden="true">
        <div class="modal-dialog " id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="home_meeting">Change Home Meeting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="nis" name="nis">
                        <div class="form-group">
                            <label class="message-text font-weight-bold" for="berkat">What I get and learn</label> <br>
                            <textarea rows="5" type="text" class="form-control" id="berkat" name="berkat">
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label class="text-date font-weight-bold" for="date">Date :</label>
                            <input type="text" class="form-control" id="date" name="date" placeholder="date">
                        </div>

                        <div class="form-group">

                            <label class="text-reset font-weight-bold" for="catatan8">Mentor Notes :</label>
                            <textarea rows="5" type="text" class="form-control" id="catatan8" name="catatan8"></textarea>

                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_homemeeting" class="btn btn-success">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>