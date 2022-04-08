 <!-- Modal tambah jurusan-->
 <div class="modal fade" id="punishment" tabindex="-1" aria-labelledby="jurusan" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="jurusan">Grace Category </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form action="" method="POST">
         <div class="modal-body">
           <div class="form-group">
             <label class="text-reset" for="name">Grace :</label>
             <textarea rows="4" type="text" class="form-control" id="grace" name="grace" required></textarea>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" name="btn_tambah_grace" id="btn_tambah_grace" class="btn btn-primary">Add</button>
         </div>
       </form>
     </div>
   </div>
 </div>

 <!-- Modal edit Data jurusan-->
 <div class="modal fade" id="edit">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">Change Grace Category </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form method="POST" action="">
         <div class="modal-body" id="modal-edit">
           <input type="hidden" class="form-control" id="kode" name="kode">
           <div class="form-group">
             <label class="text-reset" for="Grace">Grace :</label>
             <textarea rows="4" type="text" class="form-control" id="ctg" name="ctg"></textarea>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" name="btn_edit_grace" id="btn_edit_punishment" class="btn btn-warning">Update</button>
         </div>
       </form>
     </div>
   </div>
 </div>