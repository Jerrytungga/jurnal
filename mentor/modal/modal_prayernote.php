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