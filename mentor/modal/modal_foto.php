<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" id="modal-edit">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <label class="modal-title" id="staticBackdropLabel">Foto </label>
      </div>
      <div class="modal-body modal-responsive">
        <center>
          <img src="../img/penilaian/<?= $row["image"]; ?>" id="foto" class="img-thumbnail" alt="Cinque Terre" width="604px" height="536px">
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>