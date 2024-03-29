    <!-- Modal blessings -->
    <div class="modal fade" id="Blessings" tabindex="-1" aria-labelledby="Blessings" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Blessings">Berkat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- bungkus untuk form -->
                <form action="" method="POST">
                    <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                    <input type="hidden" class="form-control" id="smt" name="smt" value="<?= $data_semester; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="god-text" class="col-form-label font-weight-bold">Apa yang saya dapatkan dari Tuhan :</label>
                            <textarea rows="5" type="text" class="form-control" id="god" name="god"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="education-text" class="col-form-label font-weight-bold">Apa yang saya pelajari di Pendidikan :</label>
                            <textarea rows="5" type="text" class="form-control" id="education" name="education"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="character-text" class="col-form-label font-weight-bold">Apa yang saya pelajari tentang karakter dan Kebajikan :</label>
                            <textarea rows="5" type="text" class="form-control" id="character" name="character"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="appreciate1-text" class="col-form-label font-weight-bold">Apa yang Saya Apresiasi Terhadap Kakak & Adik : </label>
                            <textarea rows="5" type="text" class="form-control" id="appreciate1" name="appreciate1"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="appreciate2-text" class="col-form-label font-weight-bold">Apa yang Saya Apresiasi Terhadap Pelatih/Mentor Saya :</label>
                            <textarea rows="5" type="text" class="form-control" id="appreciate2" name="appreciate2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="appreciate3-text" class="col-form-label font-weight-bold">Apa yang Saya Apresiasi Terhadap Orang :</label>
                            <textarea rows="5" type="text" class="form-control" id="appreciate3" name="appreciate3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ask-text" class="col-form-label font-weight-bold">Yang Ingin Saya Tanyakan :</label>
                            <textarea rows="5" type="text" class="form-control" id="ask" name="ask"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="thismonth-text" class="col-form-label font-weight-bold">Apa yang aling Saya pelajari bulan ini :</label>
                            <textarea rows="5" type="text" class="form-control" id="thismonth" name="thismonth"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="blessing" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- detail god -->
    <div class="modal fade" id="what_i_gain_on_god" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Apa yang saya dapatkan dari Tuhan :</label>
                        <textarea rows="5" type="text" class="form-control" id="god" name="god" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Catatan Mentor :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- detail education-->
    <div class="modal fade" id="what_i_learn_on_education" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Apa yang saya pelajari di Pendidikan :</label>
                        <textarea rows="5" type="text" class="form-control" id="edu" name="edu" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Catatan Mentor :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- detail learn on character & Virtue-->
    <div class="modal fade" id="what_i_learn_on_character_and_virtue" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Apa yang saya pelajari tentang karakter dan Kebajikan :</label>
                        <textarea rows="5" type="text" class="form-control" id="learnoncharacter" name="learnoncharacter" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Catatan Mentor :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- detail what_l_appreciate_toward_brother_sister -->
    <div class="modal fade" id="what_l_appreciate_toward_brother_sister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Apa yang Saya Apresiasi Terhadap Kakak & Adik :</label>
                        <textarea rows="5" type="text" class="form-control" id="appreciate" name="appreciate" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Catatan Mentor :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- detail What I Appreciate Toward My Trainers/Mentors -->
    <div class="modal fade" id="WhatIAppreciateTowardMyTrainers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Apa yang Saya Apresiasi Terhadap Pelatih/Mentor Saya :</label>
                        <textarea rows="5" type="text" class="form-control" id="appreciate1" name="appreciate1" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Catatan Mentor :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- detail What I Appreciate Toward My Trainers/Mentors -->
    <div class="modal fade" id="WhatIAppreciateTowardSaints" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Apa yang Saya Apresiasi Terhadap Orang :</label>
                        <textarea rows="5" type="text" class="form-control" id="appreciate2" name="appreciate2" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Catatan Mentor :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- detail What I Appreciate Toward My Trainers/Mentors -->
    <div class="modal fade" id="WhatIWantToAsk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Yang Ingin Saya Tanyakan :</label>
                        <textarea rows="5" type="text" class="form-control" id="ask" name="ask" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Catatan Mentor :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- detail What I Appreciate Toward My Trainers/Mentors -->
    <div class="modal fade" id="what_i_learn_the_most_this_month" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Apa yang aling Saya pelajari bulan ini :</label>
                        <textarea rows="5" type="text" class="form-control" id="whatlearnthismonht" name="whatlearnthismonht" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="god-text" class="col-form-label font-weight-bold">Catatan Mentor :</label>
                        <textarea rows="5" type="text" class="form-control" id="catatan" name="catatan" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="blessings" tabindex="-1" aria-labelledby="blessings" aria-hidden="true">
        <div class="modal-dialog" id="modal-chages">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blessings">Edit Catatan Berkat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- bungkus untuk form inputan personal goal-->
                <form action="" method="POST">
                    <input type="hidden" class="form-control" id="nis" name="nis">
                    <input type="hidden" class="form-control" id="smt" name="smt" value="<?= $data_semester; ?>">

                    <div class="modal-body">
                        <div class="form-group">
                            <h7 class="text-reset" for="date">Tanggal :</h7>
                            <input type="text" class="form-control" id="date" name="date" readonly>

                        </div>

                        <div class="form-group">
                            <label class="text-reset" for="god">Apa yang saya dapatkan dari Tuhan :</label>
                            <textarea rows="5" type="text" class="form-control" id="god" name="god"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="text-reset" for="edu">Apa yang saya pelajari di Pendidikan :</label>
                            <textarea rows="5" type="text" class="form-control" id="edu" name="edu"></textarea>
                        </div>


                        <div class="form-group">
                            <label class="text-reset" for="chracter">Apa yang saya pelajari tentang karakter dan Kebajikan :</label>
                            <textarea rows="5" type="text" class="form-control" id="chracter" name="chracter"></textarea>
                        </div>


                        <div class="form-group">
                            <label class="text-reset" for="apresiasi1">Apa yang Saya Apresiasi Terhadap Kakak & Adik :</label>
                            <textarea rows="5" type="text" class="form-control" id="apresiasi1" name="apresiasi1"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="text-reset" for="apresiasi2">Apa yang Saya Apresiasi Terhadap Pelatih/Mentor Saya :</label>
                            <textarea rows="5" type="text" class="form-control" id="apresiasi2" name="apresiasi2"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="text-reset" for="apresiasi3">Apa yang Saya Apresiasi Terhadap Orang :</label>
                            <textarea rows="5" type="text" class="form-control" id="apresiasi3" name="apresiasi3"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="text-reset" for="ask">Yang Ingin Saya Tanyakan :</label>
                            <textarea rows="5" type="text" class="form-control" id="ask" name="ask"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="text-reset" for="berkat">Apa yang aling Saya pelajari bulan ini :</label>
                            <textarea rows="5" type="text" class="form-control" id="berkat" name="berkat"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="btn_blessings" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>