  <!-- modal edit -->
  <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog" id="modal-edit">
          <div class="modal-content">
              <div class="modal-header">
                  <label class=" font-weight-bold">Changes Virtues</label>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form method="POST" action="">
                  <div class="modal-body">

                      <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                      <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                      <label class=" font-weight-bold">Ramah & Sopan :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="sikapramahsopan" id="sikapramahsopan">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>
                      <label class="font-weight-bold">Berkordinasi :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="sikapberkordinasi" id="sikapberkordinasi">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>

                      <label class="font-weight-bold">Tolong Menolong :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="sikaptolongmenolong" id="sikaptolongmenolong">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>
                      <label class="font-weight-bold">See & Do :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="sikapseedo" id="sikapseedo">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>

                      <div class="form-group">
                          <label class="font-weight-bold">Mentor Notes :</label>
                          <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan"></textarea>
                      </div>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="btn_virtue">Save changes</button>
                  </div>
              </form>
          </div>
      </div>
  </div>




  <!-- Modal VIRTUES -->
  <div class="modal fade" id="virtues" tabindex="-1" aria-labelledby="virtues" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title font-weight-bold" id="virtues">Virtues</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>

              </div>
              <!-- bungkus untuk form inputan -->
              <form action="" method="POST">
                  <div class="modal-body">
                      <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                      <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                      <label class=" font-weight-bold">Ramah & Sopan :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="sikapramahsopan" id="sikapramahsopan">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>

                      <label class="font-weight-bold">Berkordinasi :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="sikapberkordinasi" id="sikapberkordinasi">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>
                      <label class="font-weight-bold">Tolong Menolong :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="sikaptolongmenolong" id="sikaptolongmenolong">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>

                      <label class="font-weight-bold">See & Do :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="sikapseedo" id="sikapseedo">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>

                      <div class="form-group">
                          <label class="font-weight-bold">Mentor Notes :</label>
                          <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan"></textarea>
                      </div>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success" name="btn_submit_virtues">Submit</button>
                  </div>
              </form>

          </div>
      </div>
  </div>