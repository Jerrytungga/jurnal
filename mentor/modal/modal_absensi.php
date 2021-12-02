 <!-- Modal -->
 <div class="modal fade" id="report" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" id="modal-presensi">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Presensi</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form method="POST" action="">

                 <div class="modal-body">
                     <input type="hidden" class="form-control" id="nis" name="nis">
                     <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">

                     <div class="form-group">
                         <label for="text">Name :</label>
                         <input type="text" class="form-control" id="name" name="name">
                     </div>
                     <div class="form-group">
                         <label for="text">Date :</label>
                         <input type="date" class="form-control" id="date" name="date">
                     </div>

                     <div class="form-group">
                         <label for="text">Presensi :</label>
                         <input type="text" class="form-control" id="presensi" name="presensi">
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary" name="input">Submit</button>
                 </div>
             </form>
         </div>
     </div>
 </div>