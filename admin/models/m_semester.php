 <!-- Modal tambah angkatan-->
 <div class="modal fade" id="semester" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="angkatan">New Semester</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form action="" method="POST">
         <div class="modal-body">
           <div class="form-group">
             <label for="angkatan-text" class="col-form-label font-weight-bold">ID Semester :</label>
             <input type="text" class="form-control" id="idsemester" name="idsemester" required placeholder="Contoh id 20221 adalah semester gasal">
           </div>
           <div class="alert alert-warning mt-2 " role="alert">
             Make sure the semester ID you entered is correct!
           </div>
           <div class="form-group">
             <label for="angkatan-text" class="col-form-label font-weight-bold">Semester :</label>
             <input type="text" class="form-control" id="semester" name="semester" required placeholder="Contoh: Gasal 2022">
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" name="tambah_semester" id="tambah_semester" class="btn btn-primary ">Add</button>
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
         <h5 class="modal-title" id="edit_semester">Change Semester</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form action="" method="POST">
         <div class="modal-body" id="modal-edit">
           <div class="form-group">
             <label class="text-reset">ID Semester :</label>
             <input type="text" readonly class="form-control" id="id" name="id">
           </div>
           <div class="form-group">
             <label class="text-reset">Semester :</label>
             <input type="text" class="form-control" id="semester" name="semester">
           </div>
           <div class="form-group">
             <label class="text-reset">Status :</label>
             <select class="form-control" name="status" id="status" aria-label="Default select example" required>
               <option value="Aktif">Aktif</option>
               <option value="Tidak Aktif">Tidak Aktif</option>
             </select>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" name="edit_semester" id="btn_edit_angkatan" class="btn btn-warning">Update</button>
         </div>
       </form>
     </div>
   </div>
 </div>