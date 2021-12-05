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
                     <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                     <input type="hidden" class="form-control" id="nis" name="nis">
                     <div class="form-group">
                         <label for="date-text" class="col-form-label font-weight-bold">Categori :</label>
                         <select class="form-control" name="category" id="category" aria-label="Default select example">
                             <option value="">Select</option>
                             <?php
                                $sql_category_exhibition = mysqli_query($conn, "SELECT * FROM tb_categori_exhibition");
                                while ($categori = mysqli_fetch_array($sql_category_exhibition)) {
                                    echo '<option value="' . $categori['category'] . '">' . $categori['category'] . '</option>';
                                }
                                ?>
                         </select>
                     </div>
                     <div class="form-group">
                         <label class="text-reset  font-weight-bold" for="verse2">Verse :</label>
                         <textarea rows="5" type="text" class="form-control" id="verse2" name="verse2"></textarea>

                     </div>
                     <div class="form-group">
                         <label class="text-reset  font-weight-bold" for="point">Point of Blessing :</label>
                         <textarea rows="5" type="text" class="form-control" id="pointblessing" name="pointblessing"></textarea>
                     </div>
                     <div class="form-group">
                         <label class="text-reset font-weight-bold" for="beban">Point :</label>
                         <select class="form-control" aria-label="Default select example" name="point" id="point">
                             <option selected>Select</option>
                             <option value="1">1</option>
                             <option value="0">0</option>
                             <option value="-1">-1</option>
                         </select>
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

 <!-- view -->
 <div class="modal fade" id="modal_detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog" id="modal-detail">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Exhibition Detail </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body table-responsive">

                 <div class="form-group">
                     <label for="date-text" class="col-form-label font-weight-bold">Date :</label>
                     <p type="text" class="form-control" id="date" readonly></p>
                 </div>
                 <div class="form-group">
                     <label for="date-text" class="col-form-label font-weight-bold">Categori :</label>
                     <p type="text" class="form-control" id="category" readonly></p>
                 </div>
                 <div class="form-group">
                     <label for="verse-text" class="col-form-label font-weight-bold">Verse :</label>
                     <textarea rows="5" type="text" class="form-control" id="verse" readonly>
                            </textarea>
                 </div>
                 <div class="form-group">
                     <label for="doa-text" class="col-form-label font-weight-bold">Point of Blessing :</label>
                     <textarea rows="5" type="text" class="form-control" id="pointblessings" readonly>
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


 <!-- Modal -->
 <div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" id="modal-hapus">
         <div class="modal-content">

             <form method="POST">
                 <div class="modal-body">
                     <h5>Are you sure you want to delete the data ?</h5>
                     <input type="hidden" class="form-control" id="nis" name="nis">
                     <input type="text" readonly class="form-control" id="date" name="date">
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                     <button type="submit" name="hapus" class="btn btn-danger">Yes</button>
                 </div>
             </form>
         </div>
     </div>
 </div>