 <!-- Modal tambah jurusan-->
 <div class="modal fade" id="categorydoa" tabindex="-1" aria-labelledby="jurusan" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="jurusan">Tambah Kategori Doa</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form action="" method="POST">
         <div class="modal-body">
           <div class="form-group">
             <input type="hidden" class="form-control" id="kode" name="kode">
             <label for="categori-text" class="col-form-label font-weight-bold">Kategori Doa :</label>
             <textarea rows="2" type="text" class="form-control" id="categori" name="categori" required></textarea>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
           <button type="submit" name="btn_tbh_categori_doa" id="btn_tbh_categori_doa" class="btn btn-primary">Simpan</button>
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
         <h5 class="modal-title" id="edit_jurusan">Edit Kategori Doa</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form method="POST" action="">
         <div class="modal-body" id="modal-edit">
           <input type="hidden" class="form-control" id="kode" name="kode">
           <div class="form-group">
             <label for="categori-text" class="col-form-label font-weight-bold">Kategori Doa :</label>
             <textarea rows="2" type="text" class="form-control" id="categori" name="categori"> </textarea>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
           <button type="submit" name="btn_edit_categori" id="btn_edit_categori" class="btn btn-warning">Simpan Perubahan</button>
         </div>
       </form>
     </div>
   </div>
 </div>