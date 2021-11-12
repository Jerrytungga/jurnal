  <!-- Modal bible reading-->
  <div class="modal fade" id="biblereading" tabindex="-1" aria-labelledby="biblereading" aria-hidden="true">
      <div class="modal-dialog" id="modal-edit">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="biblereading">Change Bible Reading</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <!-- bungkus untuk form -->
              <form action="" method="POST">
                  <div class="modal-body">
                      <input type="hidden" class="form-control" id="nis" name="nis">
                      <div class="form-group">
                          <select class="form-control" name="bible" id="bible" aria-label="Default select example" required>
                              <option value="">Select Bible</option>
                              <option value="OTNT">OTNT</option>
                              <option value="OT">OT</option>
                              <option value="NT">NT</option>

                          </select>
                      </div>


                      <div class="form-group">
                          <select class="form-control" name="ot" id="ot" aria-label="Default select example" required>
                              <option value="">Select Total OT Chapter(s)</option>
                              <option value="Tidak Baca">Tidak Baca</option>
                              <option value="1 Pasal">1 Pasal</option>
                              <option value="2 Pasal">2 Pasal</option>
                              <option value="3 Pasal">3 Pasal</option>
                              <option value="4 Pasal">4 Pasal</option>
                              <option value="5 Pasal">5 Pasal</option>
                              <option value="6 Pasal">6 Pasal</option>
                              <option value="7 Pasal">7 Pasal</option>
                              <option value="8 Pasal">8 Pasal</option>
                              <option value="9 Pasal">9 Pasal</option>
                              <option value="10 Pasal">10 Pasal</option>
                              <option value="11 Pasal">11 Pasal</option>
                              <option value="12 Pasal">12 Pasal</option>
                              <option value="13 Pasal">13 Pasal</option>
                              <option value="14 Pasal">14 Pasal</option>
                              <option value="15 Pasal">15 Pasal</option>
                              <option value="16 Pasal">16 Pasal</option>
                              <option value="17 Pasal">17 Pasal</option>
                              <option value="18 Pasal">18 Pasal</option>
                              <option value="19 Pasal">19 Pasal</option>
                              <option value="20 Pasal">20 Pasal</option>
                          </select>

                      </div>


                      <div class="form-group">
                          <select class="form-control" name="nt" id="nt" aria-label="Default select example" required>
                              <option value="">Select Total NT Chapter(s)</option>
                              <option value="Tidak Baca">Tidak Baca</option>
                              <option value="1 Pasal">1 Pasal</option>
                              <option value="2 Pasal">2 Pasal</option>
                              <option value="3 Pasal">3 Pasal</option>
                              <option value="4 Pasal">4 Pasal</option>
                              <option value="5 Pasal">5 Pasal</option>
                              <option value="6 Pasal">6 Pasal</option>
                              <option value="7 Pasal">7 Pasal</option>
                              <option value="8 Pasal">8 Pasal</option>
                              <option value="9 Pasal">9 Pasal</option>
                              <option value="10 Pasal">10 Pasal</option>
                              <option value="11 Pasal">11 Pasal</option>
                              <option value="12 Pasal">12 Pasal</option>
                              <option value="13 Pasal">13 Pasal</option>
                              <option value="14 Pasal">14 Pasal</option>
                              <option value="15 Pasal">15 Pasal</option>
                              <option value="16 Pasal">16 Pasal</option>
                              <option value="17 Pasal">17 Pasal</option>
                              <option value="18 Pasal">18 Pasal</option>
                              <option value="19 Pasal">19 Pasal</option>
                              <option value="20 Pasal">20 Pasal</option>
                          </select>
                      </div>

                      <div class="form-group">
                          <label class="text-reset font-weight-bold" for="beban">Point :</label>
                          <select class="form-control" aria-label="Default select example" name="point" id="point">
                              <option selected>Select</option>
                              <option value="1">1</option>
                              <option value="0">0</option>
                              <option value="-1">-1</option>
                          </select>
                      </div>

                      <div class="form-group">
                          <label class="text-reset font-weight-bold" for="mentor">Date :</label>
                          <input type="text" class="form-control" id="date" name="date" placeholder="date">
                      </div>
                      <div class="form-group">
                          <label class="text-reset font-weight-bold" for="catatan4">Mentor Notes :</label>
                          <textarea rows="5" type="text" class="form-control" id="catatan4" name="catatan4"></textarea>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="btn_bible" class="btn btn-danger">Save</button>
                  </div>
              </form>

          </div>
      </div>
  </div>