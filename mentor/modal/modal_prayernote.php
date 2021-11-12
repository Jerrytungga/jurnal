<!-- Modal Prayer Note-->
<div class="modal fade" id="prayer_note" tabindex="-1" aria-labelledby="prayer_note" aria-hidden="true">
    <div class="modal-dialog" id="modal-edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prayer_note">Change Prayer Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- bungkus untuk form -->
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="nis" name="nis">
                    <div class="form-group">
                        <label for="kategori-text" class="col-form-label font-weight-bold">Category :</label>
                        <select class="form-control" name="judul" id="judul" aria-label="Default select example">
                            <option selected>Select</option>
                            <?php
                            $sql_categoridoa = mysqli_query($conn, "SELECT * FROM tb_categori_doa");
                            while ($categoridoa = mysqli_fetch_array($sql_categoridoa)) {
                                echo '<option value="' . $categoridoa['categori_doa'] . '">' . $categoridoa['categori_doa'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-reset font-weight-bold" for="beban">Burden & Inward Sense :</label>
                        <textarea rows="5" type="text" class="form-control" id="beban" name="beban" placeholder="Burden & inward sense"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-reset font-weight-bold" for="beban">Point :</label>
                        <select class="form-control" aria-label="Default select example" name="point" id="point">
                            <option selected>Select</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-reset font-weight-bold" for="catatan">Date :</label>
                        <input type="text" class="form-control" id="date" name="date">
                    </div>
                    <div class="form-group">
                        <label class="text-reset font-weight-bold" for="catatan">Mentor Notes :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_prayernote" class="btn btn-warning">Save</button>
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
                <h5 class="modal-title" id="staticBackdropLabel">Prayer Note Detail</h5>
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
                    <label for="category-text" class="col-form-label font-weight-bold">Category :</label>
                    <p type="text" class="form-control" id="category" readonly></p>
                </div>

                <div class="form-group">
                    <label for="inward-text" class="col-form-label font-weight-bold">Burden & Inward Sense :</label>
                    <textarea rows="5" type="text" class="form-control" id="inward" readonly>
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