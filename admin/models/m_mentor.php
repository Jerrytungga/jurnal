<-- Modal Edit data mentor-->
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edi_mentor">Edit Mentor </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- bungkus untuk form -->
                <form id="form" method="POST" enctype="multipart/form-data" action="models/function.php">
                    <div class="modal-body" id="modal-edit">

                        <div class="form-group">
                            <label for="image">Foto</label>
                            <div class="padding-bottom:5px">
                                <img src="" width="120px" id="pict">
                            </div>
                            <input type="file" name="image" class="form-control-file mt-2" id="image">
                        </div>
                        <h7 class="text-reset">Efata :</h7>
                        <div class="form-group">
                            <input type="text" class="form-control" id="efata" name="efata" readonly>
                        </div>
                        <h7 class="text-reset">Nama :</h7>
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <h7 class="text-reset">Gender :</h7>
                        <div class="form-group">
                            <select class="form-control" name="gender" id="gender">
                                <option selected>Select</option>
                                <option value="P">P</option>
                                <option value="L">L</option>
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

                        <h7 class="text-reset">Status :</h7>
                        <div class="form-group">
                            <select class="form-control" name="status" id="status">
                                <option selected>Select</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_edit_mentor" id="btn_edit_mentor" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <!-- Modal Tambah data mentor-->
    <div class="modal fade" id="Mentor" tabindex="-1" aria-labelledby="Mentor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Mentor">New Mentor </h5>
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
                        <h7 class="text-reset">Efata :</h7>
                        <div class="form-group">
                            <input type="text" class="form-control" id="efata" name="efata" required>
                        </div>
                        <h7 class="text-reset">Nama :</h7>
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <h7 class="text-reset">Gender :</h7>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example" name="gender" id="gender">
                                <option selected>Select</option>
                                <option value="P">P</option>
                                <option value="L">L</option>
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
                        <h7 class="text-reset">Status :</h7>
                        <div class="form-group">
                            <select class="form-control" name="status" id="status" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_tambah_mentor" id="btn_tambah_mentor" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>