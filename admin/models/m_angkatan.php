 <!-- Modal tambah angkatan-->
 <div class="modal fade" id="angkatan" tabindex="-1" aria-labelledby="angkatan" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="angkatan">New Angkatan</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form action="" method="POST">
         <div class="modal-body">
           <div class="form-group">
           </div>
           <div class="form-group">
             <label for="angkatan-text" class="col-form-label font-weight-bold">Angkatan :</label>
             <input type="text" class="form-control" id="angkatan" name="angkatan" required>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" name="btn_tambah_angkatan" id="btn_tambah_angkatan" class="btn btn-primary ">Add</button>
         </div>
       </form>
     </div>
   </div>
 </div>
 <!-- Modal edit Data angkatan-->
 <div class="modal fade" id="edit">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="edit_angkatan">Edit Data Angkatan</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form action="models/function.php" method="POST">
         <div class="modal-body" id="modal-edit">
           <input type="hidden" class="form-control" id="id" name="id">
           <div class="form-group">
             <h7 class="text-reset" for="username">Angkatan :</h7>
             <p>
               <input type="text" class="form-control" id="angkatan" name="angkatan">
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" name="btn_edit_angkatan" id="btn_edit_angkatan" class="btn btn-warning">Update</button>
         </div>
       </form>
     </div>
   </div>
 </div>