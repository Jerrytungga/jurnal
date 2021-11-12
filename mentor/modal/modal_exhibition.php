 <!-- Modal -->
 <div class="modal fade" id="exhibition" tabindex="-1" aria-labelledby="exhibition" aria-hidden="true">
     <div class="modal-dialog" id="modal-edit">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exhibition">Change Exhibition</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <!-- bungkus untuk form inputan personal goal-->
             <form action="" method="POST">
                 <div class="modal-body">
                     <input type="hidden" class="form-control" id="nis" name="nis">
                     <div class="form-group">
                         <label class="text-reset  font-weight-bold" for="verse2">Verse :</label>
                         <textarea rows="5" type="text" class="form-control" id="verse2" name="verse2"></textarea>

                     </div>
                     <div class="form-group">
                         <label class="text-reset  font-weight-bold" for="point">Point of Blessing :</label>
                         <textarea rows="5" type="text" class="form-control" id="point" name="point"></textarea>

                     </div>
                     <div class="form-group">
                         <label class="text-reset font-weight-bold" for="date">Date :</label>
                         <input type="text" class="form-control" id="date" name="date" placeholder="date">
                     </div>

                     <div class="form-group">
                         <label class="text-reset font-weight-bold" for="catatan2">Mentor Notes :</label>
                         <textarea rows="5" type="text" class="form-control" id="catatan2" name="catatan2"></textarea>

                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" name="btn_exhibition" class="btn btn-primary">Save</button>
                 </div>
             </form>

         </div>
     </div>
 </div>