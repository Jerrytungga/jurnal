<!-- Modal -->
<div class="modal fade" id="QR" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../qrcode.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Please Select Student :</label>
            <select class="form-control" required name="nis" required id="nis" aria-label="Default select example">
              <?php
              $angkatan = mysqli_query($conn, "SELECT * FROM siswa ");
              while ($dataangkatan = mysqli_fetch_array($angkatan)) {
                echo '<option value="' . $dataangkatan['nis'] . '">' . $dataangkatan['name'] . '</option>';
              }
              ?>
              <!-- <input type="text" name="nis" required placeholder="Masukan Nis Siswa" class="form-control col-2 m-2"> -->
            </select>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="simpan" class="btn btn-success">Download</button>
          </div>
      </form>
    </div>
  </div>
</div>