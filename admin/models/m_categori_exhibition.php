 <!-- Modal tambah jurusan-->
 <div class="modal fade" id="category_exhibition" tabindex="-1">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="jurusan">New Categori</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form action="" method="POST">
         <div class="modal-body">
           <div class="form-group">
             <input type="hidden" class="form-control" id="kode" name="kode">
             <label for="categori-text" class="col-form-label font-weight-bold">Categori :</label>
             <textarea rows="2" type="text" class="form-control" id="categori" name="categori" required></textarea>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" name="btn_tbh_categori" id="btn_tbh_categori" class="btn btn-primary">Add</button>
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
         <h5 class="modal-title" id="edit_jurusan">Edit Categori</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form method="POST" action="">
         <div class="modal-body" id="modal-edit">
           <input type="hidden" class="form-control" id="kode" name="kode">
           <div class="form-group">
             <label for="categori-text" class="col-form-label font-weight-bold">Categori :</label>
             <textarea rows="2" type="text" class="form-control" id="categori" name="categori"> </textarea>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" name="btn_edit_categori" id="btn_edit_categori" class="btn btn-warning">Update</button>
         </div>
       </form>
     </div>
   </div>
 </div>