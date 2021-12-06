<!-- Modal -->
<div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modal-hapus">
    <div class="modal-content">

      <form method="POST">
        <div class="modal-body">
          <h5>Are you sure you want to delete the data ?</h5>
          <input type="hidden" class="form-control" id="nis" name="nis">
          <input type="text" readonly class="form-control" id="date" name="date">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit" name="hapus" class="btn btn-danger">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>