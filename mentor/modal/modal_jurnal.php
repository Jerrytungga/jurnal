<div class="modal fade" id="jurnalmodal" tabindex="-3" aria-labelledby="jurnalmodal" aria-hidden="true">
    <div class="modal-dialog" id="modal-edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jurnalmodal">Jurnal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body"><a id="nis">
               
                <input type="text" class="form-control" id="nis" name="nis">
                <a href="personalgoal.php?nis=<?= $row["nis"]; ?>" role="button" class="btn btn-primary">Daily</a>
                <a href="exhibition.php?nis=<?= $row["nis"]; ?>" role="button" class="btn btn-primary">Weekly</a>
                <a href="blessings.php?nis=<?= $row["nis"]; ?>" role="button" class="btn btn-primary">Monthly</a>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>