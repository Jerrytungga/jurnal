 <!-- Modal -->
 <div class="modal fade" id="exhibition" tabindex="-1" aria-labelledby="exhibition" aria-hidden="true">
     <div class="modal-dialog" id="modal-edit">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exhibition">Edit Exhibition</h5>
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
                         <label for="date-text" class="col-form-label font-weight-bold">Kategori :</label>
                         <select class="form-control" name="category" id="category" aria-label="Default select example">
                             <option value="">Pilih Kategori</option>
                             <?php
                                $sql_category_exhibition = mysqli_query($conn, "SELECT * FROM tb_categori_exhibition");
                                while ($categori = mysqli_fetch_array($sql_category_exhibition)) {
                                    echo '<option value="' . $categori['category'] . '">' . $categori['category'] . '</option>';
                                }
                                ?>
                         </select>
                     </div>
                     <div class="form-group">
                         <label class="text-reset  font-weight-bold" for="verse2">Ayat Alkitab :</label>
                         <textarea rows="5" type="text" class="form-control" id="verse2" name="verse2"></textarea>

                     </div>
                     <div class="form-group">
                         <label class="text-reset  font-weight-bold" for="point">Poin Kelas Pameran :</label>
                         <textarea rows="5" type="text" class="form-control" id="pointblessing" name="pointblessing"></textarea>
                     </div>
                     <div class="form-group">
                         <label class="text-reset font-weight-bold" for="beban">Poin :</label>
                         <select class="form-control" aria-label="Default select example" name="point" id="point">
                             <option selected>Pilih Poin</option>
                             <option value="1">1</option>
                             <option value="0">0</option>
                             <option value="-1">-1</option>
                         </select>
                     </div>
                     <div class="form-group">
                         <label class="text-reset font-weight-bold" for="date">Tanggal :</label>
                         <input type="text" class="form-control" id="date" name="date" placeholder="date">
                     </div>

                     <div class="form-group">
                         <label class="text-reset font-weight-bold" for="catatan2">Catatan Mentor :</label>
                         <textarea rows="5" type="text" class="form-control" id="catatan2" name="catatan2"></textarea>

                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                     <button type="submit" name="btn_exhibition" class="btn btn-warning">Simpan Perubahan</button>
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
                     <label for="date-text" class="col-form-label font-weight-bold">Tanggal:</label>
                     <p type="text" class="form-control" id="date" readonly></p>
                 </div>
                 <div class="form-group">
                     <label for="date-text" class="col-form-label font-weight-bold">Kategori :</label>
                     <p type="text" class="form-control" id="category" readonly></p>
                 </div>
                 <div class="form-group">
                     <label for="verse-text" class="col-form-label font-weight-bold">Ayat Alkitab :</label>
                     <textarea rows="5" type="text" class="form-control" id="verse" readonly>
                            </textarea>
                 </div>
                 <div class="form-group">
                     <label for="doa-text" class="col-form-label font-weight-bold">Poin Kelas Pameran :</label>
                     <textarea rows="5" type="text" class="form-control" id="pointblessings" readonly>
                            </textarea>
                 </div>
                 <div class="form-group">
                     <label for="notes-text" class="col-form-label font-weight-bold">Catatan Mentor :</label>
                     <textarea rows="5" type="text" class="form-control font-weight-bold text-primary font-italic" id="mentor" readonly>
                            </textarea>
                 </div>
             </div>
         </div>
     </div>
 </div>