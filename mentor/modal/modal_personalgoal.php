 <!-- Modal -->
 <div class="modal fade" id="personalgoal" tabindex="-1" aria-labelledby="personalgoal" aria-hidden="true">
     <div class="modal-dialog" id="modal-edit">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="personalgoal">Change Personal Goal</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <!-- bungkus untuk form inputan personal goal-->
             <form action="" method="POST">
                 <div class="modal-body">
                     <input type="hidden" class="form-control" id="nis" name="nis">
                     <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                     <div class="form-group">
                         <label for="character-text" class="col-form-label font-weight-bold">Character Virtue :</label>
                         <textarea rows="5" type="text" class="form-control" id="character" name="character"></textarea>
                     </div>
                     <div class="form-group">
                         <label for="point-text" class="col-form-label font-weight-bold">Point :</label>
                         <select class="form-control" aria-label="Default select example" name="point1" id="point1">
                             <option value="">Silahkan Pilih Point</option>
                             <option value="1">1</option>
                             <option value="0">0</option>
                             <option value="-1">-1</option>
                         </select>
                     </div>

                     <div class="form-group">
                         <label for="prayer-text" class="col-form-label font-weight-bold">Prayer :</label>
                         <textarea rows="5" type="text" class="form-control" id="prayer" name="prayer"></textarea>
                     </div>
                     <div class="form-group">
                         <label for="point-text" class="col-form-label font-weight-bold">Point :</label>
                         <select class="form-control" aria-label="Default select example" name="point2" id="point2">
                             <option value="">Silahkan Pilih Point</option>
                             <option value="1">1</option>
                             <option value="0">0</option>
                             <option value="-1">-1</option>
                         </select>
                     </div>

                     <div class="form-group">
                         <label for="neutron-text" class="col-form-label font-weight-bold">Neutron :</label>
                         <textarea rows="5" type="text" class="form-control" id="neutron" name="neutron"></textarea>
                     </div>
                     <div class="form-group">
                         <label for="point-text" class="col-form-label font-weight-bold">Point :</label>
                         <select class="form-control" aria-label="Default select example" name="point3" id="point3">
                             <option value="">Silahkan Pilih Point</option>
                             <option value="1">1</option>
                             <option value="0">0</option>
                             <option value="-1">-1</option>
                         </select>
                     </div>

                     <div class="form-group">
                         <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                         <input type="text" class="form-control" id="date" name="date"></input>
                     </div>
                     <div class="form-group">
                         <label for="catatan-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                         <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan"></textarea>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" name="update" class="btn btn-primary">Save</button>
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
                 <h5 class="modal-title" id="staticBackdropLabel">Personal goal Detail </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body table-responsive">

                 <div class="form-group">
                     <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                     <input type="text" class="form-control" id="date" name="date" readonly></input>
                 </div>
                 <div class="form-group">
                     <label for="Character-text" class="col-form-label font-weight-bold">Character Virtue :</label>
                     <textarea rows="5" type="text" class="form-control" id="karakter" readonly>
                            </textarea>
                 </div>
                 <div class="form-group">
                     <label for="doa-text" class="col-form-label font-weight-bold">Prayer :</label>
                     <textarea rows="5" type="text" class="form-control" id="doa" readonly>
                            </textarea>
                 </div>
                 <div class="form-group">
                     <label for="neutron-text" class="col-form-label font-weight-bold">Bimbel :</label>
                     <textarea rows="5" type="text" class="form-control" id="neutron" readonly>
                            </textarea>
                 </div>
                 <div class="form-group">
                     <label for="notes-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                     <textarea rows="5" type="text" class="form-control font-weight-bold text-primary font-italic" id="mentor" readonly>
                            </textarea>
                 </div>
             </div>
         </div>
     </div>
 </div>