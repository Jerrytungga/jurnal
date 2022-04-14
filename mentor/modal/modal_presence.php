<!-- Modal add schedule -->
<div class="modal fade" id="add_presensi_siswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Add Presence</h5>
        <button type="button" class="close btn-danger text-white" data-dismiss="modal">&times;</button>
      </div>
      <form method="post" action="">
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="batch">Student</label>
              <select class="form-control" required name="nis" aria-label="Default select example">
                <option selected>Pilih Siswa</option>
                <?php

                $daftarsiswa = mysqli_query($conn, "SELECT * FROM siswa where status='Aktif' and mentor='$id'");
                while ($data1 = mysqli_fetch_array($daftarsiswa)) {
                  echo '<option value="' . $data1['nis'] . '">' . $data1['name'] . '</option>';
                }
                ?>
                <!-- <input type="text" name="nis" required placeholder="Masukan Nis Siswa" class="form-control col-2 m-2"> -->
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Select Schedule</label>
              <select class="form-control" name="item_schedule" aria-label="Default select example" required>
                <option selected>Select</option>
                <?php
                date_default_timezone_set('Asia/Jakarta');
                $hari_ini = date('Y-m-j');
                $waktu_sekarang = date('H:i:s');
                // looping data ankatan
                $listshedule = mysqli_query($conn, "SELECT * FROM schedule where status='Aktif' and end_time > '$waktu_sekarang' || absent_date='$hari_ini'");
                while ($data_schedule = mysqli_fetch_array($listshedule)) {
                  echo '<option value="' . $data_schedule['id'] . '">' . kegiatan($data_schedule['id_activity']) . '</option>';
                }
                ?>
              </select>
            </div> <br />

          </div>
          <div class="form-row">

            <div class="form-group col">

              <label>Mark Presence (V or O or X or I or S)</label>
              <!--<input type="text" name="participant" id="participant" class="form-control" /> -->
              <select class="custom-select" name="mark">
                <option value="V">V (Hadir)</option>
                <option value="O">O (Terlambat)</option>
                <option value="X">X (Tidak Hadir)</option>
                <option value="I">I (Ijin)</option>
                <option value="S">S (Sakit)</option>
              </select>
            </div>
            <div class="col">
              <label>Presence Date</label>
              <input type="date" name="date" class="form-control" required />
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              <label for="start_time">Presence Time (hh:mm:ss)</label>
              <input type="time" name="start_time" class="form-control" required />
            </div>

            <div class="col">
              <label>Agreement</label>
              <select class="custom-select" name="agreement">
                <option value="approve">Approve (Di setujui)</option>
                <option value="not approved">Not Approved (Tidak di setujui)</option>
                <option value="Waiting">Waiting (Menunggu)</option>
              </select>

            </div>
          </div><br />

          <div class="form-row">
            <div class="col">
              <label>Suggestion (Catatan Mentor)</label>
              <textarea rows="3" type="text" name="catatan" class="form-control"></textarea>
            </div>
          </div><br />
          <button type="submit" name="insert_presence" class="btn btn-success">Insert</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>



<!-- Modal edit schedule -->
<div class="modal fade" id="Edit_presensi_siswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" id="modal-edit_shedule">
    <div class="modal-content">
      <div class="modal-header bg-warning ">
        <h5 class="modal-title">Edit Presence</h5>
        <button type="button" class="close btn-danger text-white" data-dismiss="modal">&times;</button>
      </div>
      <form method="post" action="">
        <div class="modal-body">
          <input type="hidden" name="id1" id="id1">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="batch">Student</label>
              <select class="form-control" required name="nis1" id="nis1">
                <option selected>Pilih Siswa</option>
                <?php

                $daftarsiswa = mysqli_query($conn, "SELECT * FROM siswa where status='Aktif' and mentor='$id'");
                while ($data1 = mysqli_fetch_array($daftarsiswa)) {
                  echo '<option value="' . $data1['nis'] . '">' . $data1['name'] . '</option>';
                }
                ?>
                <!-- <input type="text" name="nis" required placeholder="Masukan Nis Siswa" class="form-control col-2 m-2"> -->
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Select Schedule</label>
              <select class="form-control" name="item_schedule1" id="item_schedule1" aria-label="Default select example" required>
                <option selected>Select</option>
                <?php
                date_default_timezone_set('Asia/Jakarta');
                $hari_ini = date('Y-m-j');
                $waktu_sekarang = date('H:i:s');
                // looping data ankatan
                $listshedule = mysqli_query($conn, "SELECT * FROM schedule where status='Aktif' and date='$hari_ini' and end_time > '$waktu_sekarang '");
                while ($data_schedule = mysqli_fetch_array($listshedule)) {
                  echo '<option value="' . $data_schedule['id'] . '">' . kegiatan($data_schedule['id_activity']) . '</option>';
                }
                ?>
              </select>
            </div> <br />

          </div>
          <div class="form-row">

            <div class="form-group col">

              <label>Mark Presence (V or O or X or I or S)</label>
              <!--<input type="text" name="participant" id="participant" class="form-control" /> -->
              <select class="custom-select" name="mark1" id="mark1">
                <option value="V">V (Hadir)</option>
                <option value="O">O (Terlambat)</option>
                <option value="X">X (Tidak Hadir)</option>
                <option value="I">I (Ijin)</option>
                <option value="S">S (Sakit)</option>
              </select>
            </div>
            <div class="col">
              <label>Presence Date</label>
              <input type="date" name="date1" id="date1" class="form-control" required />
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              <label for="start_time">Presence Time (hh:mm:ss)</label>
              <input type="time" name="time1" id="time1" class="form-control" required />
            </div>

            <div class="col">
              <label>Agreement</label>
              <select class="custom-select" name="agreement1" id="agreement1">
                <option value="approve">Approve (Di setujui)</option>
                <option value="not approved">Not Approved (Tidak di setujui)</option>
                <option value="Waiting">Waiting (Menunggu)</option>
              </select>

            </div>
          </div><br />

          <div class="form-row">
            <div class="col">
              <label>Suggestion (Catatan Mentor)</label>
              <textarea rows="3" type="text" name="catatan1" id="catatan1" class="form-control"></textarea>
            </div>
          </div><br />
          <button type="submit" name="insert_Edit_presence" class="btn btn-danger">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

















<!-- Modal tambah catatan mentor di presensi -->
<div class="modal fade" id="cttn_mentor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modal-pesan_mentor">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Suggestion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <input type="hidden" readonly name="id_absent1" id="id_absent1">
          <textarea name="pesan_mentor" id="pesan_mentor" placeholder="Sentences should be short and clear!" class="form-control" rows="10"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="save_pesan" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>