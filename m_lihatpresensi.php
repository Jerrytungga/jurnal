<?php
function activity_name($nama_activity)
{
  global $conn;
  $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nama_activity'"));
  return $sqly['name'];
}

// $tampilan_jadwal = mysqli_query($conn, "SELECT * FROM schedule");
// $tampilan = mysqli_fetch_array($tampilan_jadwal);

$tampilan_presensi = mysqli_query($conn, "SELECT * FROM absent group by nis");

// $tampilan_aktivitas = mysqli_query($conn, "SELECT * FROM activity");
// $array_aktivitas = mysqli_fetch_array($tampilan_aktivitas);

// $array_presensi = mysqli_fetch_array($tampilan_presensi);



?>

<!-- Modal aksi tombol -->
<div class="modal fade" id="tombolaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Daily Attendance (Presensi Harian)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <table class="table  text-dark">
        <thead>
          <tr>
            <th width="150">&nbsp;&nbsp;No</th>
            <th width="310">Name</th>
            <th width="100"><span class="badge badge-pill badge-success">V</span></th>
            <th width="100"><span class="badge badge-pill badge-warning">O</span></th>
            <th width="100"><span class="badge badge-pill badge-danger">X</span></th>
            <th width="100"><span class="badge badge-pill badge-primary">I</span></th>
            <th width="100"><span class="badge badge-pill badge-dark">S</span></th>
            <th width="100">POINT</th>
          </tr>
        </thead>
      </table>
      <div class="modal-body " style="height: 400px;overflow: scroll;">
        <table class=" table table-striped">
          <tbody>
            <?php $i = 1; ?>
            <?php
            while ($array_presensi = mysqli_fetch_array($tampilan_presensi)) {
              $nis = $array_presensi['nis'];
              $mark_V = $array_presensi['mark'] = 'V';
              $mark_O = $array_presensi['mark'] = 'O';
              $mark_X = $array_presensi['mark'] = 'X';
              $mark_I = $array_presensi['mark'] = 'I';
              $mark_S = $array_presensi['mark'] = 'S';
              date_default_timezone_set('Asia/Jakarta');
              $hari_ini = date('Y-m-d');

              $tampil_mark_V = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_V' AND absent_date='$hari_ini' ");
              $arraytampil_mark_V = mysqli_fetch_array($tampil_mark_V);

              $tampil_mark_O = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_O'AND absent_date='$hari_ini' ");
              $arraytampil_mark_O = mysqli_fetch_array($tampil_mark_O);

              $tampil_mark_X = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_X' AND absent_date='$hari_ini'");
              $arraytampil_mark_X = mysqli_fetch_array($tampil_mark_X);

              $tampil_mark_I = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_I' AND absent_date='$hari_ini'");
              $arraytampil_mark_I = mysqli_fetch_array($tampil_mark_I);

              $tampil_mark_S = mysqli_query($conn, "SELECT nis, count(mark) as total FROM absent where nis='$nis' and mark='$mark_S' AND absent_date='$hari_ini'");
              $arraytampil_mark_S = mysqli_fetch_array($tampil_mark_S);

              $tampil3 = mysqli_query($conn, "SELECT * FROM absent where nis='$nis' group by nis ");
              $arraytampil3 = mysqli_fetch_array($tampil3);

              $total_point = $arraytampil_mark_V['total'] + $arraytampil_mark_O['total'] - $arraytampil_mark_X['total'] + $arraytampil_mark_I['total'] + $arraytampil_mark_S['total'];
            ?>

              <?php foreach ($tampil3  as $data) :
              ?>
                <tr>
                  <th width="75"><?= $i; ?></th>
                  <td width="370"><a href="" type="button" class="btn"><?= activity_name($data["nis"]); ?></a></td>
                  <td width="125"><?= $arraytampil_mark_V['total']; ?></td>
                  <td width="110"><?= $arraytampil_mark_O['total']; ?></td>
                  <td width="110"><?= $arraytampil_mark_X['total']; ?></td>
                  <td width="100"><?= $arraytampil_mark_I['total']; ?></td>
                  <td width="120"><?= $arraytampil_mark_S['total']; ?></td>
                  <td width="30"><span class="badge badge-pill badge-info"><?= $total_point; ?></span></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach;
            }
            ?>

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <?php
        echo date('d F Y');
        ?>
      </div>

    </div>
  </div>
</div>