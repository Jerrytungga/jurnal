<?php
include '../database.php';

session_start();
include 'template/session.php';
//menampilkan data siswa
$nis = $_GET['nis'];
$siswa2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM siswa WHERE mentor ='$id' AND nis='$nis' ORDER BY date DESC"));
$nama = $siswa2['name'];

?>
<!DOCTYPE html>
<html lang="en">

<?php
include 'template/head.php';
?>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include 'template/sidebar_menu.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include 'template/topbar_menu.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">

                        <div class="group">
                            <h1 class="h3 mb-mb-4  embed-responsive text-gray-800">LIVING RANJANG</h1>
                            <a href="livingranjang.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-primary mt-2">Bantal</a>
                            <a href="livingseprei.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-success mt-2">Seprei</a>
                            <a href="livingselimut.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-warning mt-2">Selimut</a>
                            <a href="living_ranjang.php?nis=<?= $nis; ?>" type="button" class="btn btn-outline-danger active mt-2">Ranjang</a>

                        </div>
                    </div>
                    <!-- DataTales Rak sepatu -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#ranjang">Input</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-info">
                                            <th width="10">No</th>
                                            <th>Jarak</th>
                                            <th>Posisi</th>
                                            <th>Rapi</th>
                                            <th>Bersih</th>
                                            <th>Benda Asing</th>
                                            <th>foto</th>
                                            <th>Catatan Mentor</th>
                                            <th>Date</th>
                                            <th>Option</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>



                                            <td>

                                                <button type="button" class="btn btn-success form-group">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger form-group">
                                                    Delete
                                                </button>
                                            </td>

                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include 'template/footer_menu.php';
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->



    <!-- Modal living ranjang-->
    <div class="modal fade" id="ranjang" tabindex="-1" aria-labelledby="ranjang" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="ranjang">Ranjang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>


                <!-- bungkus untuk form inputan -->
                <form action="post" method="POST">
                    <div class="modal-body">
                        <h5 class="text-reset">Jarak</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <hr>
                        <h5 class="text-reset">Posisi</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <hr>
                        <h5 class="text-reset">Bentuk</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <hr>
                        <h5 class="text-reset">Rapi</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <hr>
                        <h5 class="text-reset">Bersih</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <hr>
                        <h5 class="text-reset">Raib</h5>
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">1</option>
                                <option value="2">0</option>
                            </select>
                        </div>

                        <hr>
                        <div class="mb-3">
                            <label for="input_nis" class="form-label">Catatan Mentor :</label>
                            <input type="text" class="form-control" required id="catatanMentor">
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlFile1">Foto</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger ">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>





    <?php
    include 'modal/modal_logout.php';
    include 'template/script.php';
    ?>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                scrollY: 800,
                scrollX: true,
                scrollCollapse: true,
                paging: true
            });
        });

        // $(document).on("click", "#editpenilaian", function() {

        //     let nis = $(this).data('nis');
        //     let efata = $(this).data('efata');
        //     let posisi = $(this).data('posisi');
        //     let rapi = $(this).data('rapi');
        //     let bersih = $(this).data('bersih');
        //     let raib = $(this).data('raib');
        //     let foto = $(this).data('foto');
        //     let date = $(this).data('date');
        //     let brngasing = $(this).data('brngasing');
        //     let catatan = $(this).data('cttn');
        //     $(" #modal-edit #nis").val(nis);
        //     $(" #modal-edit #efata").val(efata);
        //     $(" #modal-edit #posisi").val(posisi);
        //     $(" #modal-edit #rapi").val(rapi);
        //     $(" #modal-edit #bersih").val(bersih);
        //     $(" #modal-edit #brngasing").val(brngasing);
        //     $(" #modal-edit #date").val(date);
        //     $(" #modal-edit #raib").val(raib);
        //     $(" #modal-edit #catatan").val(catatan);
        //     $(" #modal-edit #foto").attr("src", "../img/penilaian/" + foto);

        // });
    </script>

</body>

</html>