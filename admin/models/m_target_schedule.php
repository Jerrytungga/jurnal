<!-- Modal Menampilkan data target -->
<div class="modal fade" id="targetpoin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                                                    <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="staticBackdropLabel">Target Points</h5>
                                                                                                        <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#targetpoin">
                                                                                                        </button>
                                                                                                        Add Target
                                                                                                        </button>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                                                                                                                                                      <th scope="col">Date</th>
                                                                                                                                                            </tr>
                                                                                                                                  </thead>
                                                                                                                                  <tbody>
                                                                                                                                                            <?php $T = 1; ?>
                                                                                                                                                            <?php foreach ($sqli_target as $row2) : ?>
                                                                                                                                                                                      <tr>
                                                                                                                                                                                                                <th scope="row"><?= $T; ?></th>
                                                                                                                                                                                                                <td><?= $row2['Day']; ?></td>
                                                                                                                                                                                                                <td><?= $row2['target']; ?></td>
                                                                                                                                                                                                                <td><?= $row2['date']; ?></td>
                                                                                                                                                                                      </tr>
                                                                                                                                                                                      <?php $T++; ?>
                                                                                                                                                            <?php endforeach; ?>
                                                                                                                                  </tbody>
                                                                                                        </table>
                                                                              </div>
                                                    </div>
                          </div>
</div>