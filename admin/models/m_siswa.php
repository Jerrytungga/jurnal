 <!-- Modal tambah Data Siswa-->
 <div class="modal fade" id="siswa" tabindex="-1" aria-labelledby="siswa" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="siswa">New siswa </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form action="" method="POST" enctype="multipart/form-data">
         <div class="modal-body">
           <div class="form-group">
             <label for="image">Foto</label>
             <input type="file" name="image" class="form-control-file" id="image">
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="nis_siswa">Nis Siswa :</h7>
             <input type="text" class="form-control" id="nis" name="nis" required>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="name">Nama Siswa :</h7>
             <input type="text" class="form-control" id="name" name="name" required>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="angkatan">Angkatan :</h7>
             <select class="form-control" name="angkatan" id="angkatan" aria-label="Default select example">
               <option selected>Select</option>
               <?php
                // looping data ankatan
                while ($data_angkatan = mysqli_fetch_array($sql_angkatan)) {
                  echo '<option value="' . $data_angkatan['angkatan'] . '">' . $data_angkatan['angkatan'] . '</option>';
                }
                ?>
             </select>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="gender">Gender :</h7>
             <select class="form-control" name="gender" id="gender" aria-label="Default select example">
               <option selected>Select</option>
               <option value="L">L</option>
               <option value="P">P</option>
             </select>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="jurusan">Jurusan :</h7>
             <select class="form-control" name="jurusan" id="jurusan" aria-label="Default select example">
               <option holder>Select</option>
               <?php
                // looping data jurusan
                while ($data_jurusan = mysqli_fetch_array($sql_jurusan)) {
                  echo '<option value="' . $data_jurusan['jurusan'] . '">' . $data_jurusan['jurusan'] . '</option>';
                }
                ?>
             </select>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="jurusan">Bimbel :</h7>
             <select class="form-control" name="bimbel" id="bimbel" aria-label="Default select example">
               <option selected>Select</option>
               <option value="IPS">IPS</option>
               <option value="IPA">IPA</option>
             </select>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="mentor">Mentor :</h7>
             <select class="form-control" name="mentor" id="mentor" aria-label="Default select example" required>
               <option selected>Select</option>
               <!-- Looping data mentor -->
               <?php
                while ($data_mentor = mysqli_fetch_array($sql_mentor)) {
                  echo '<option value="' . $data_mentor['efata'] . '">' . $data_mentor['name'] . '</option>';
                }
                ?>
             </select>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="username">Username :</h7>
             <input type="text" class="form-control" id="username" name="username" required>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="password">Password :</h7>
             <input type="text" class="form-control" id="password" name="password" required>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="status">Status :</h7>
             <select class="form-control" name="status" id="status" aria-label="Default select example">
               <option selected>Select</option>
               <option value="Aktif">Aktif</option>
               <option value="Tidak Aktif">Tidak Aktif</option>
             </select>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" name="btn_tambah_siswa" id="btn_tambah_siswa" class="btn btn-primary">Add</button>
         </div>
       </form>
     </div>
   </div>
 </div>

 <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
 <!-- Modal edit Data Siswa-->
 <div class="modal fade" id="edit">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="edit_siswa">Edit Data Siswa</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- bungkus untuk form -->
       <form action="models/function.php" method="POST" enctype="multipart/form-data">
         <div class="modal-body" id="modal-edit">
           <div class="form-group">
             <label for="image">Foto</label>
             <div class="padding-bottom:5px">
               <img src="" width="120px" id="image">
             </div>
             <input type="file" name="image" class="form-control-file mt-2" id="image">
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="nis_siswa">Nis Siswa :</h7>
             <input type="text" class="form-control" id="nis" name="nis" readonly>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="name">Nama Siswa :</h7>
             <input type="text" class="form-control" id="name" name="name">
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="angkatan">Angkatan :</h7>
             <select class="form-control" name="angkatan" id="angkatan">
               <option selected>Select</option>
               <?php
                $sql_angkatan = mysqli_query($conn, "SELECT * FROM tb_angkatan");
                while ($data_angkatan = mysqli_fetch_array($sql_angkatan)) {
                  echo '<option value="' . $data_angkatan['angkatan'] . '">' . $data_angkatan['angkatan'] . '</option>';
                }
                ?>
             </select>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="gender">Gender :</h7>
             <select class="form-control" name="gender" id="gender">
               <option selected>Select</option>
               <option value="L">L</option>
               <option value="P">P</option>
             </select>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="jurusan">Jurusan :</h7>
             <select class="form-control" name="jurusan" id="jurusan">
               <option selected>Select</option>
               <?php
                $sql_jurusan = mysqli_query($conn, "SELECT * FROM tb_jurusan");
                while ($data_jurusan = mysqli_fetch_array($sql_jurusan)) {
                  echo '<option value="' . $data_jurusan['jurusan'] . '">' . $data_jurusan['jurusan'] . '</option>';
                }
                ?>
             </select>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="bimbel">Bimbel :</h7>
             <select class="form-control" name="bimbel" id="bimbel">
               <option selected>Select</option>
               <option value="IPS">IPS</option>
               <option value="IPA">IPA</option>
             </select>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="mentor">Mentor :</h7>
             <select class="form-control" name="mentor" id="mentor">
               <option selected>Select</option>
               <!-- Looping data mentor -->
               <?php
                $sql_mentor = mysqli_query($conn, "SELECT * FROM mentor");
                while ($data_mentor = mysqli_fetch_array($sql_mentor)) {
                  echo '<option value="' . $data_mentor['efata'] . '">' . $data_mentor['name'] . '</option>';
                }
                ?>
             </select>
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="username">Username :</h7>
             <input type="text" class="form-control" id="username" name="username">
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="password">Password :</h7>
             <input type="text" class="form-control" id="password" name="password">
           </div>
           <div class="form-group">
             <h7 class="text-reset" for="status">Status :</h7>
             <select class="form-control" name="status" id="status" aria-label="Default select example">
               <option selected>Select</option>
               <option value="Aktif">Aktif</option>
               <option value="Tidak Aktif">Tidak Aktif</option>
             </select>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" name="btn_edit_siswa" id="btn_edit_siswa" class="btn btn-warning">Update</button>
         </div>
       </form>
     </div>
   </div>
 </div>