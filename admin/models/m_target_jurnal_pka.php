 <!-- Modal tambah jurusan-->
 <div class="modal fade" id="target" tabindex="-1" aria-labelledby="jurusan" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="jurusan">Tambah Target jurnal</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form action="" method="POST">
         <div class="modal-body">
           <div class="form-group">

             <label for="name">Presensi :</label>
             <input type="text" class="form-control mb-2" name="presensi" required>
             <label for="target">Jurnal :</label>
             <input type="text" class="form-control mb-2" name="jurnal" required>
             <label for="semester">Semester:</label>
             <select class="form-control mb-2" name="semester" aria-label="Default select example">
               <option selected>Select</option>
               <?php
                // looping data ankatan
                $semester = mysqli_query($conn, "SELECT * FROM `tb_semester`");
                while ($data_semester = mysqli_fetch_array($semester)) {
                  echo '<option value="' . $data_semester['thn_semester'] . '">' . $data_semester['keterangan'] . '</option>';
                }
                ?>
             </select>
             <label class="text-reset" for="angkatan">Pemerikasaan :</label>
             <input type="text" class="form-control" name="pemeriksaan">
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
           <button type="submit" name="btn_tambah_target" class="btn btn-primary">Simpan</button>
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
         <h5 class="modal-title" id="edit_jurusan">Edit Target Jurnal</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form method="POST" action="">
         <div class="modal-body" id="modal-edit">
           <input type="hidden" class="form-control" id="kode" name="kode">
           <div class="form-group">
             <label for="name">Presensi :</label>
             <input type="text" class="form-control mb-2" name="presensi" id="presensi1" required>
             <label for="target">Jurnal :</label>
             <input type="text" class="form-control mb-2" name="jurnal" id="jurnal1" required>
             <label for="semester">Semester:</label>
             <select class="form-control mb-2" name="semester" id="semesterjurnal" aria-label="Default select example">
               <option selected>Select</option>
               <?php
                // looping data ankatan
                $semester = mysqli_query($conn, "SELECT * FROM `tb_semester`");
                while ($data_semester = mysqli_fetch_array($semester)) {
                  echo '<option value="' . $data_semester['thn_semester'] . '">' . $data_semester['keterangan'] . '</option>';
                }
                ?>
             </select>
             <label class="text-reset" for="angkatan">Pemeriksaan :</label>
             <input type="text" class="form-control" name="pemeriksaan" id="pemeriksaan1">
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
           <button type="submit" name="btn_edit_target" class="btn btn-warning">Simpan Perubahan</button>
         </div>
       </form>
     </div>
   </div>
 </div>