<!-- Modal -->
<div class="modal fade" id="blessings" tabindex="-1" aria-labelledby="blessings" aria-hidden="true">
    <div class="modal-dialog" id="modal-edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blessings">Edit Blessings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- bungkus untuk form inputan personal goal-->
            <form method="POST">

                <div class="modal-body">
                    <input type="hidden" class="form-control" id="efata" name="efata" value="<?= $_SESSION['id_Mentor']; ?>">
                    <input type="hidden" class="form-control" id="nis" name="nis">
                    <div class="form-group">
                        <label class="text-reset" for="date">Tanggal :</label>
                        <input type="text" class="form-control" id="date" name="date" placeholder="date">
                    </div>

                    <div class="form-group">
                        <label class="text-reset" for="god">Apa yang saya dapatkan dari Tuhan :</label>
                        <textarea rows="5" type="text" class="form-control" id="god" name="god" placeholder="What I Gain On God"></textarea>
                    </div>
                    <label class=" font-weight-bold">Poin1 :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="point1" id="point1">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="cttn1">Cttn1 :</label>
                        <textarea rows="5" type="text" class="form-control" id="cttn1" name="cttn1" placeholder="cttn1"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="edu">Apa yang saya pelajari tentang pendidikan :</label>
                        <textarea rows="5" type="text" class="form-control" id="edu" name="edu" placeholder="What I Learn On Education"></textarea>
                    </div>
                    <label class=" font-weight-bold">Poin2 :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="point2" id="point2">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="cttn2">Cttn2 :</label>
                        <textarea rows="5" type="text" class="form-control" id="cttn2" name="cttn2" placeholder="cttn2"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="text-reset" for="chracter">Apa yang saya pelajari tentang karakter dan kebajikan :</label>
                        <textarea rows="5" type="text" class="form-control" id="chracter" name="chracter" placeholder="What L learn On Character & Virtue"></textarea>
                    </div>
                    <label class=" font-weight-bold">Poin3 :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="point3" id="point3">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="cttn3">Cttn3 :</label>
                        <textarea rows="5" type="text" class="form-control" id="cttn3" name="cttn3" placeholder="cttn3"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="text-reset" for="apresiasi1">Apa yang saya apresiasi untuk kakak & adik :</label>
                        <textarea rows="5" type="text" class="form-control" id="apresiasi1" name="apresiasi1" placeholder="What L Appreciate Toward Brother & Sister"></textarea>
                    </div>
                    <label class=" font-weight-bold">Poin4 :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="point4" id="point4">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="cttn4">Cttn4 :</label>
                        <textarea rows="5" type="text" class="form-control" id="cttn4" name="cttn4" placeholder="cttn4"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="apresiasi2">Apa yang saya apresiasi terhadap pelatih/mentor Saya :</label>
                        <textarea rows="5" type="text" class="form-control" id="apresiasi2" name="apresiasi2" placeholder="What l Appreciate Toward My Trainers/Mentors"></textarea>
                    </div>
                    <label class=" font-weight-bold">Poin5 :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="point5" id="point5">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="cttn5">Cttn5 :</label>
                        <textarea rows="5" type="text" class="form-control" id="cttn5" name="cttn5" placeholder="cttn5"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="apresiasi3">Apa yang saya apresiasi terhadap orang :</label>
                        <textarea rows="5" type="text" class="form-control" id="apresiasi3" name="apresiasi3" placeholder="What I Appreciate Toward Saints"></textarea>
                    </div>
                    <label class="font-weight-bold">Poin6 :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="point6" id="point6">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="cttn6">Cttn6 :</label>
                        <textarea rows="5" type="text" class="form-control" id="cttn6" name="cttn6" placeholder="cttn6"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="ask">Apa yang Ingin saya tanyakan :</label>
                        <textarea rows="5" type="text" class="form-control" id="ask" name="ask" placeholder="What I Want To Ask"></textarea>
                    </div>
                    <label class=" font-weight-bold">Poin7 :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="point7" id="point7">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="cttn7">Cttn7 :</label>
                        <textarea rows="5" type="text" class="form-control" id="cttn7" name="cttn7" placeholder="cttn7"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="berkat">Apa yang paling saya pelajari bulan ini :</label>
                        <textarea rows="5" type="text" class="form-control" id="berkat" name="berkat" placeholder="What I Learn the most This Month"></textarea>
                    </div>
                    <label class=" font-weight-bold">Poin8 :</label>
                    <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="point8" id="point8">
                            <option selected>Pilih Poin</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-reset" for="cttn8">Cttn8 :</label>
                        <textarea rows="5" type="text" class="form-control" id="cttn8" name="cttn8" placeholder="cttn8"></textarea>
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
            <!-- <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>"> -->
            <div class=" modal-body">
                <div class=" form-group">
                    <label for="god-text" class="col-form-label font-weight-bold">Apa yang saya dapatkan dari Tuhan : </label>
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
            <!-- <input type="text" class="form-control" id="nis" name="nis" value="w"> -->
            <div class=" modal-body">
                <div class="form-group">
                    <label for="god-text" class="col-form-label font-weight-bold">Apa yang saya pelajari tentang pendidikan :</label>
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
            <!-- <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>"> -->
            <div class=" modal-body">
                <div class="form-group">
                    <label for="god-text" class="col-form-label font-weight-bold">Apa yang saya pelajari tentang karakter dan kebajikan :</label>
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
            <!-- <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>"> -->
            <div class=" modal-body">
                <div class="form-group">
                    <label for="god-text" class="col-form-label font-weight-bold">Apa yang saya apresiasi untuk kakak & adik :</label>
                    <textarea rows="5" type="text" class="form-control" id="appreciate" name="appreciate" disabled></textarea>
                </div>
                <div class="form-group">
                    <label for="god-text" class="col-form-label font-weight-bold">Catatan Mentor:</label>
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
            <!-- <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>"> -->
            <div class=" modal-body">
                <div class="form-group">
                    <label for="god-text" class="col-form-label font-weight-bold">Apa yang saya apresiasi terhadap pelatih/mentor Saya :</label>
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
            <!-- <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>"> -->
            <div class=" modal-body">
                <div class="form-group">
                    <label for="god-text" class="col-form-label font-weight-bold">Apa yang saya apresiasi terhadap orang :</label>
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
            <!-- <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>"> -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="god-text" class="col-form-label font-weight-bold">Apa yang Ingin saya tanyakan :</label>
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
            <!-- <input type="hidden" class="form-control" id="nis" name="nis" value="<?= $_SESSION['id_Siswa']; ?>"> -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="god-text" class="col-form-label font-weight-bold">Apa yang paling saya pelajari bulan ini :</label>
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