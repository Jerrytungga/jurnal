 <!-- Modal Revival Note -->
 <div class="modal fade" id="revival_note" tabindex="-1" aria-labelledby="revival_note" aria-hidden="true">
     <div class="modal-dialog" id="modal-edit">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="revival_note">Change Revival Note</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <!-- bungkus untuk form -->
             <form action="" method="POST">
                 <div class="modal-body">
                     <input type="hidden" class="form-control" id="nis" name="nis">
                     <div class="form-group">
                         <label for="verse-text" class="col-form-label font-weight-bold">Verse :</label>
                         <textarea rows="5" type="text" class="form-control" id="verse" name="verse" placeholder="Verse"></textarea>
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
                         <label for="verse-text" class="col-form-label font-weight-bold">Blessing :</label>
                         <textarea rows="5" type="text" class="form-control" id="blessings" name="blessings" placeholder="Blessing"></textarea>
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
                         <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                         <input type="text" class="form-control" id="date" name="date" placeholder="date"></input>

                     </div>
                     <div class="form-group">
                         <label for="mentor-text" class="col-form-label font-weight-bold">Mentor Notes :</label>
                         <textarea rows="5" type="text" class="form-control" id="mentor" name="mentor"></textarea>

                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" name="btn_revivalnote" class="btn btn-success">Save</button>
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
                     <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                     <p type="text" class="form-control" id="date" name="date" readonly></p>
                 </div>
                 <div class="form-group">
                     <label for="verse-text" class="col-form-label font-weight-bold">Verse :</label>
                     <textarea rows="5" type="text" class="form-control" id="verse" readonly>
                            </textarea>
                 </div>
                 <div class="form-group">
                     <label for="blessings-text" class="col-form-label font-weight-bold">Blessing :</label>
                     <textarea rows="5" type="text" class="form-control" id="blessings" name="blessings" readonly>
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