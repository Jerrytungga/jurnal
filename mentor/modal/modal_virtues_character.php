  <!-- modal edit -->
  <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog" id="modal-edit">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="edit">Changes My Virtues & Character</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form method="POST" action="">
                  <div class="modal-body">

                      <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                      <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                      <label class=" font-weight-bold" for="berbagi">Perhatian & berbagi :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="berbagi" id="berbagi">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>
                      <label class=" font-weight-bold">Tegor sapa / Salam :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="salam" id="salam">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>

                      <label class="font-weight-bold">Bersyukur / Berterima kasih :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="ucapan" id="ucapan">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>
                      <label class="font-weight-bold">Hormat & Taat :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="hormat" id="hormat">
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
                      <button type="submit" class="btn btn-primary" name="btn_virtue_character">Save changes</button>
                  </div>
              </form>
          </div>
      </div>
  </div>


  <!-- Modal MY VIRTUES & CHARACTER -->
  <div class="modal fade" id="virtuesdancharacter" tabindex="-1" aria-labelledby="virtuesdancharacter" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title font-weight-bold" id="virtuesdancharacter">MY VIRTUES & CHARACTER</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>

              </div>
              <!-- bungkus untuk form inputan -->
              <form action="" method="POST">
                  <div class="modal-body">
                      <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                      <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $nis; ?>">
                      <label class=" font-weight-bold" for="berbagi">Perhatian & berbagi :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="berbagi" id="berbagi">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>
                      <label class=" font-weight-bold">Tegor sapa / Salam :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="salam" id="salam">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>

                      <label class="font-weight-bold">Bersyukur / Berterima kasih :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="berterimakasih" id="berterimakasih">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>
                      <label class="font-weight-bold">Hormat & Taat :</label>
                      <div class="form-group">
                          <select class="form-control" aria-label="Default select example" name="hormat" id="hormat">
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
                      <button type="submit" name="btn_myvirtues" class="btn btn-primary">Submit</button>
                  </div>
              </form>

          </div>
      </div>
  </div>