 <!-- Modal Revival Note -->
 <div class="modal fade" id="revival_note" tabindex="-1" aria-labelledby="revival_note" aria-hidden="true">
     <div class="modal-dialog" id="modal-edit">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="revival_note">Edit Revival Note</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <!-- bungkus untuk form -->
             <form action="" method="POST">
                 <div class="modal-body">
                     <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                     <input type="hidden" class="form-control" id="nis" name="nis">
                     <div class="form-group">
                         <label for="verse-text" class="col-form-label font-weight-bold">Ayat Alkitab :</label>
                         <textarea rows="5" type="text" class="form-control" id="verse" name="verse" placeholder="Verse"></textarea>
                     </div>
                     <div class="form-group">
                         <label for="point-text" class="col-form-label font-weight-bold">Poin :</label>
                         <select class="form-control" aria-label="Default select example" name="point1" id="point1">
                             <option value="">Silahkan Pilih Poin</option>
                             <option value="1">1</option>
                             <option value="0">0</option>
                             <option value="-1">-1</option>
                         </select>
                     </div>
                     <div class="form-group">
                         <label for="verse-text" class="col-form-label font-weight-bold">Berkat :</label>
                         <textarea rows="5" type="text" class="form-control" id="blessings" name="blessings" placeholder="Blessing"></textarea>
                     </div>

                     <div class="form-group">
                         <label for="point-text" class="col-form-label font-weight-bold">Poin :</label>
                         <select class="form-control" aria-label="Default select example" name="point2" id="point2">
                             <option value="">Silahkan Pilih Poin</option>
                             <option value="1">1</option>
                             <option value="0">0</option>
                             <option value="-1">-1</option>
                         </select>
                     </div>

                     <div class="form-group">
                         <label for="date-text" class="col-form-label font-weight-bold">Tanggal :</label>
                         <input type="text" class="form-control" id="date" name="date" placeholder="date"></input>

                     </div>
                     <div class="form-group">
                         <label for="mentor-text" class="col-form-label font-weight-bold">Catatan Mentor :</label>
                         <textarea rows="5" type="text" class="form-control" id="mentor" name="mentor"></textarea>

                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                     <button type="submit" name="btn_revivalnote" class="btn btn-success">Simpan Perubahan</button>
                 </div>
             </form>

         </div>
     </div>
 </div>



 <!-- view -->
 <div class="modal fade" id="modal_detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog" id="modal-detail">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Revival Note Detail</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body table-responsive">

                 <div class="form-group">
                     <label for="date-text" class="col-form-label font-weight-bold">Tanggal :</label>
                     <p type="text" class="form-control" id="date" name="date" readonly></p>
                 </div>
                 <div class="form-group">
                     <label for="verse-text" class="col-form-label font-weight-bold">Ayat Alkitab:</label>
                     <textarea rows="5" type="text" class="form-control" id="verse" readonly>
                            </textarea>
                 </div>
                 <div class="form-group">
                     <label for="blessings-text" class="col-form-label font-weight-bold">Berkat :</label>
                     <textarea rows="5" type="text" class="form-control" id="blessings" name="blessings" readonly>
                            </textarea>
                 </div>
                 <div class="form-group">
                     <label for="notes-text" class="col-form-label font-weight-bold">Catatan Mentor :</label>
                     <textarea rows="5" type="text" class="form-control font-weight-bold text-primary font-italic" id="mentor" readonly>
                            </textarea>
                 </div>
             </div>
         </div>
     </div>
 </div>