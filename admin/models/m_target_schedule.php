<!-- Modal Menampilkan data target -->
<div class="modal fade" id="targetpoin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Target Points</h5>
        <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#targettambah">
          Add Target
        </button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
        <span aria-hidden="true">&times;</span>

        <?php
        $sqli_target = mysqli_query($conn, "SELECT * FROM tb_target_presensi ORDER BY date DESC");
        $data_target = mysqli_fetch_array($sqli_target);
        ?>
      </div>
      <div class="modal-body">

        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Day</th>
              <th scope="col">Target</th>
              <th scope="col">Week</th>
              <th scope="col">Date</th>
              <th scope="col">Option</th>
            </tr>
          </thead>
          <tbody>
            <?php $T = 1; ?>
            <?php foreach ($sqli_target as $row2) : ?>
              <tr>
                <th scope="row"><?= $T; ?></th>
                <td><?= $row2['Day']; ?></td>
                <td><?= $row2['target']; ?></td>
                <td><?= $row2['week']; ?></td>
                <td><?= $row2['date']; ?></td>
                <td><a id="edit_items" data-toggle="modal" data-target="#edit_target_m" data-id_taget_presensi="<?= $row2["id_tabel_presence"]; ?>" data-hari="<?= $row2["Day"]; ?>" data-target2="<?= $row2["target"]; ?>" data-date="<?= $row2["date"]; ?>" data-week="<?= $row2["week"]; ?>">
                    <button class="btn btn-info btn-warning"><i class="fa fa-edit"></i></button></a></td>
              </tr>
              <?php $T++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>







<div class="modal fade" id="targettambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Target</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
        <span aria-hidden="true">&times;</span>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <div class="form-row">
            <div class="col">
              <label for="Day">Day</label>
              <select class="form-control" name="Day">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
              </select>
            </div>
            <div class="col">
              <label for="target">Target</label>
              <input type="text" name="target" class="form-control">
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              <label for="target">Date</label>
              <input type="date" name="tanggal" class="form-control">
            </div>
            <div class="col">
              <label for="target">Week</label>
              <input type="number" name="week" class="form-control">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addtarget" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="edit_target_m" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Target</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
        <span aria-hidden="true">&times;</span>
      </div>
      <div class="modal-body" id="modal-edittarget">
        <form action="" method="POST">
          <input type="hidden" name="id_taget_presensi" id="id_taget_presensi" class="form-control">
          <div class="form-row">
            <div class="col">
              <label for="Day">Day</label>
              <select class="form-control" name="hari" id="hari">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
              </select>
            </div>

            <div class="col">
              <label for="target">Target</label>
              <input type="text" name="target2" id="target2" class="form-control">
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              <label>Date</label>
              <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="col">
              <label for="target">Week</label>
              <input type="number" name="week" id="week" class="form-control">
            </div>
          </div><br>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="updatetarget" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>