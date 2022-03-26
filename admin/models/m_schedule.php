<!-- Modal view Schedule-->
<div class="modal fade" id="schedule" tabindex="-1" aria-labelledby="activity" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="activity">Schedule :
          <button type="button" data-toggle="modal" data-target="#addschedule" class="btn btn-warning">Add Schedule</button>
          <button type="button" data-toggle="modal" data-target="#offschedule" class="btn btn-danger">Turn on/off all schedules</button>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table dataTable table-striped" width="70%" id="tableschedule">
          <thead class="bg-success">
            <tr>
              <th scope="col">Angkatan</th>
              <th scope="col">Week</th>
              <th scope="col">Schedule item</th>
              <th scope="col">Info Schedule</th>
              <th scope="col">Schedule Date</th>
              <th scope="col">Start Time</th>
              <th scope="col">End Time</th>
              <th scope="col">Absent Time</th>
              <th scope="col">Status</th>
              <th scope="col">Participant</th>
              <th scope="col">Absent Timer</th>
              <th scope="col">ID</th>
              <th scope="col">Options</th>
            </tr>
          </thead>
          <tbody>
            <?php function activity($activity)
            {
              global $conn;
              $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity WHERE id_activity='$activity'"));
              return $sqly['items'];
            }
            ?>
            <?php foreach ($jadwal as $data1) : ?>
              <tr>
                <td><?= $data1["batch"]; ?></td>
                <td><?= $data1["week"]; ?></td>
                <td><?= activity($data1["id_activity"]); ?></td>
                <td><?= $data1["info"]; ?></td>
                <td><?= $data1["date"]; ?></td>
                <td><?= $data1["start_time"]; ?></td>
                <td><?= $data1["end_time"]; ?></td>
                <td><?= $data1["absent_time"]; ?></td>
                <td><?= $data1["status"]; ?></td>
                <td><?= $data1["participant"]; ?></td>
                <td><?= $data1["timer"]; ?></td>
                <td><?= $data1["id"]; ?></td>
                <td width="50">
                  <div class="btn-group" aria-label="Basic example">
                    <button data-toggle="modal" data-idschedule="<?= $data1["id"]; ?>" id="edit_schedule" data-angkatan="<?= $data1["batch"]; ?>" data-timerabsen="<?= $data1["timer"]; ?>" data-wilaya="<?= $data1["area"]; ?>" data-peserta="<?= $data1["participant"]; ?>" data-keterangan="<?= $data1["status"]; ?>" data-presensiatautidak="<?= $data1["is_need_absent"]; ?>" data-waktuabsen="<?= $data1["absent_time"]; ?>" data-waktuakhir="<?= $data1["end_time"]; ?>" data-waktumulai="<?= $data1["start_time"]; ?>" data-tanggal="<?= $data1["date"]; ?>" data-pesan="<?= $data1["info"]; ?>" data-itemaktivitas="<?= $data1["id_activity"]; ?>" data-minggu="<?= $data1["week"]; ?>" data-target="#editschedule" class=" m-1 btn btn-info btn-warning"><i class="fa fa-edit"></i></button></a>

                    <button type="button" id="edit_schedule" data-aktivitas="<?= $data1["id_activity"]; ?>" data-id="<?= $data1["id"]; ?>" data-toggle="modal" data-target="#hapus" class="btn m-1 btn-danger"><i class="fa fa-trash"></i></button>
                  </div>
                </td>

              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>







<!-- Modal add schedule -->
<div class="modal fade" id="addschedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Schedule Data</h5>
        <button type="button" class="close btn-danger text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="batch">Angkatan</label>
              <select class="form-control" name="angkatan" aria-label="Default select example" required>
                <option selected>Select</option>
                <?php
                // looping data ankatan
                while ($data_angkatan = mysqli_fetch_array($sql_angkatan)) {
                  echo '<option value="' . $data_angkatan['angkatan'] . '">' . $data_angkatan['angkatan'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="week">Week</label>
              <input type="number" min="1" name="week" class="form-control" required />
            </div> <br />
          </div>
          <div class="form-row">
            <div class="col">
              <label>Select Schedule</label>
              <select class="form-control" name="item_schedule" aria-label="Default select example" required>
                <option selected>Select</option>
                <?php
                // looping data ankatan
                $listshedule = mysqli_query($conn, "SELECT * FROM activity");
                while ($data_schedule = mysqli_fetch_array($listshedule)) {
                  echo '<option value="' . $data_schedule['id_activity'] . '">' . $data_schedule['items'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col">
              <label>Additional info of Schedule</label>
              <input type="text" name="info" class="form-control" />
            </div>
          </div><br>

          <div class="form-row">
            <div class="col">
              <label>Schedule Date</label>
              <input type="date" name="date" class="form-control" required />
            </div>
            <div class="col">
              <label for="start_time">Start Time (hh:mm:ss)</label>
              <input type="time" name="start_time" class="form-control" required />
            </div>
            <div class="col">
              <label for="end_time">End Time (hh:mm:ss)</label>
              <input type="time" name="end_time" id="end_time" class="form-control" required />
            </div>
            <div class="col">
              <label>Absent Time (hh:mm:ss)</label>
              <input type="time" name="absent_time" id="absent_time" class="form-control" required />
            </div>
          </div><br />
          <div class="form-row">
            <div class="col">
              <label>Is Need Absent (0=no or 1=yes)</label>
              <!--<input type="number" min="0" max="1" name="is_need_absent" id="is_need_absent" class="form-control" /> -->
              <select class="custom-select" name="is_need_absent" id="is_need_absent">
                <option>1</option>
                <option>0</option>
              </select>
            </div>
            <div class="col">
              <label>Status</label>
              <!--<input type="number" min="0" max="1" name="has_triggered" id="has_triggered" class="form-control" />-->
              <select class="custom-select" name="status">
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
              </select>
            </div>
          </div><br />
          <div class="form-row">
            <div class="col">
              <label>Participant (all or ipa or ips)</label>
              <!--<input type="text" name="participant" id="participant" class="form-control" /> -->
              <select class="custom-select" name="participant" id="participant">
                <option value="ALL">all</option>
                <option value="IPA">ipa</option>
                <option value="IPS">ips</option>
              </select>
            </div>
            <div class="col">
              <label>Area (umum or kamar)</label>
              <!--<input type="text" name="area" id="area" class="form-control" /> -->
              <select class="custom-select" name="area" id="area">
                <option value="umum">umum</option>
                <option value="kamar">kamar</option>
              </select>

            </div>
            <div class="col">
              <label>Absent Timer (durasi absensi)</label>
              <input type="number" min="5" value="5" name="txtAbsentTimer" id="txtAbsentTimer" class="form-control" required />
            </div>
          </div><br />
          <button type="submit" name="insert_shedule" class="btn btn-success">Insert</button>
        </form>
      </div>
    </div>
  </div>
</div>









<!-- Modal edit schedule -->
<div class="modal fade" id="editschedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Change Schedule Data</h5>
        <button type="button" class="close btn-danger text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="modal-editschedule">
        <form method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="batch">Angkatan</label>
              <input type="hidden" readonly id="idschedule" name="idschedule" class="form-control" />
              <select class="form-control" name="angkatan" id="angkatan" aria-label="Default select example" required>
                <option selected>Select</option>
                <?php
                $sqlangkatan = mysqli_query($conn, "SELECT * FROM tb_angkatan") or die(mysqli_error($conn));
                // looping data ankatan
                while ($angkatan = mysqli_fetch_array($sqlangkatan)) {
                  echo '<option value="' . $angkatan['angkatan'] . '">' . $angkatan['angkatan'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="week">Week</label>
              <input type="number" min="1" id="minggu" name="week" class="form-control" required />
            </div> <br />
          </div>
          <div class="form-row">
            <div class="col">
              <label>Select Schedule</label>
              <select class="form-control" id="itemaktivitas" name="itemaktivitas" aria-label="Default select example" required>
                <option selected>Select</option>
                <?php
                // looping data ankatan
                $listshedule = mysqli_query($conn, "SELECT * FROM activity");
                while ($data_schedule = mysqli_fetch_array($listshedule)) {
                  echo '<option value="' . $data_schedule['id_activity'] . '">' . $data_schedule['items'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col">
              <label>Additional info of Schedule</label>
              <input type="text" id="pesan" name="pesan" class="form-control" />
            </div>
          </div><br>

          <div class="form-row">
            <div class="col">
              <label>Schedule Date</label>
              <input type="date" id="tanggal" name="tanggal" class="form-control" required />
            </div>
            <div class="col">
              <label for="start_time">Start Time (hh:mm:ss)</label>
              <input type="time" id="waktumulai" name="waktumulai" class="form-control" required />
            </div>
            <div class="col">
              <label for="end_time">End Time (hh:mm:ss)</label>
              <input type="time" id="waktuakhir" name="waktuakhir" id="end_time" class="form-control" required />
            </div>
            <div class="col">
              <label>Absent Time (hh:mm:ss)</label>
              <input type="time" name="waktuabsen" id="waktuabsen" class="form-control" required />
            </div>
          </div><br />
          <div class="form-row">
            <div class="col">
              <label>Is Need Absent (0=no or 1=yes)</label>
              <!--<input type="number" min="0" max="1" name="is_need_absent" id="is_need_absent" class="form-control" /> -->
              <select class="custom-select" name="presensiatautidak" id="presensiatautidak">
                <option>1</option>
                <option>0</option>
              </select>
            </div>
            <div class="col">
              <label>Status</label>
              <!--<input type="number" min="0" max="1" name="has_triggered" id="has_triggered" class="form-control" />-->
              <select class="form-control" name="keterangan" id="keterangan">
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
              </select>
            </div>
          </div><br />
          <div class="form-row">
            <div class="col">
              <label>Participant (all or ipa or ips)</label>
              <!--<input type="text" name="participant" id="participant" class="form-control" /> -->
              <select class="custom-select" name="peserta" id="peserta">
                <option value="ALL">all</option>
                <option value="IPA">ipa</option>
                <option value="IPS">ips</option>
              </select>
            </div>
            <div class=" col">
              <label>Area (umum or kamar)</label>
              <!--<input type="text" name="area" id="area" class="form-control" /> -->
              <select class="custom-select" name="wilaya" id="wilaya">
                <option value="umum">umum</option>
                <option value="kamar">kamar</option>
              </select>

            </div>
            <div class="col">
              <label>Absent Timer (durasi absensi)</label>
              <input type="number" min="5" value="5" name="timerabsen" id="timerabsen" class="form-control" required />
            </div>
          </div><br />
          <button type="submit" name="updateschedule" class="btn btn-warning">Update Schedule</button>
        </form>
      </div>

    </div>
  </div>
</div>






<!-- modal hapus data schedule -->
<div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modal-hapus">
    <div class="modal-content">

      <form method="POST">
        <div class="modal-body">
          <h5>Are you sure you want to delete the data ?</h5>
          <input type="hidden" class="form-control" id="id" name="id">
          <input type="text" readonly class="form-control" id="aktivitas" name="aktivitas">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit" name="hapus" class="btn btn-danger">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>










<!-- Modal Matikan semua jadwal -->
<div class="modal fade" id="offschedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Silahkan Pilih Angkatan :</label>
            <select class="form-control" required name="angkatan" required aria-label="Default select example">
              <?php
              $angkatan = mysqli_query($conn, "SELECT * FROM tb_angkatan ");
              while ($dataangkatan = mysqli_fetch_array($angkatan)) {
                echo '<option value="' . $dataangkatan['angkatan'] . '">' . $dataangkatan['angkatan'] . '</option>';
              }
              ?>
              <!-- <input type="text" name="nis" required placeholder="Masukan Nis Siswa" class="form-control col-2 m-2"> -->
            </select>
          </div>
          <div class="form-group">
            <label for="">Status :</label>
            <select class="form-control " name="status" aria-label="Default select example" required>
              <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="offallschedule" class="btn btn-warning">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>