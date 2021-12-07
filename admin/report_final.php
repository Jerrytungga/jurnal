<?php
include '../database.php';
session_start();
include 'template/Session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jurnal PKA</title>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        include 'template/sidebar_menu.php';
        ?>
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
                    <!-- isi konten -->

                    <h1 class="text-dark text-center font-weight-bold">Yayasan Kebenaran Alkitab</h1>
                    <p class=" text-dark text-center font-monospace">PELATIHAN PELAYANAN ROHANI “KEBENARAN ALKITAB” <br> Jalan Ngamarto 2, Lawang 65211; Telpon 0341 4301212, Fax 0341 426639 <br>Email address : pka.lawang@gmail.com <br> Keputusan Dirjen Bimas Kristen (Protestan)<br>Kementrian Agama nomor F/Kep/HK 00579/22377/99, Tgl 20-7-1999</p>
                    <h5 class="text-dark text-center font-weight-bold">LAPORAN SEMESTER PERKEMBANGAN BELAJAR SISWA PKA LAWANG</h5>
                    <p>
                    <h6>Nama</h6>
                    <center>
                        <table class="table table-sm table-bordered" style="width: 70%" cellspacing="0">
                            <thead class=" table-secondary border-dark">
                                <tr class="border-dark text-center">
                                    <th class="border-dark" rowspan="2" width="200">ASPEK PEMBELAJARAN</th>
                                    <th class="border-dark" rowspan="2" width="210">FOKUS/MATERI PEMBELAJARAN</th>
                                    <th class="border-dark" rowspan="2" width="10">Target</th>
                                    <th class="border-dark" colspan="3" class=" text-center border-dark">Pencapaian Akhir</th>
                                    <th class="border-dark" rowspan="2">Bobot</th>
                                    <th class="border-dark" rowspan="2" width="270">Deskripsi Pelaksanaan</th>
                                    <th class="border-dark" rowspan="2" width="250">Ket.</th>

                                </tr>
                                <tr class=" text-center">
                                    <th class="border-dark" width="130">Nilai Akhir</th>
                                    <th class="border-dark" class=" text-center" width="10">%</th>
                                    <th class="border-dark" width="130">Huruf</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-dark text-center">
                                    <th rowspan="3" class="border-dark">
                                        Pengembangan Diri (Kerohanian)
                                    </th>
                                    <td class="border-dark">Penyegaran Pagi<br>(saat teduh)</td>
                                    <!-- target -->
                                    <td class="border-dark">133</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">130</td>
                                    <!-- persen -->
                                    <td class="border-dark">98</td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border-dark">Membaca Alkitab</td>
                                    <!-- target -->
                                    <td class="border-dark">266</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">238</td>
                                    <!-- persen -->
                                    <td class="border-dark">89</td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">3</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border-dark">Doa</td>
                                    <!-- target -->
                                    <td class="border-dark">133</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">132</td>
                                    <!-- persen -->
                                    <td class="border-dark">99</td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>



                                <tr class="text-center">
                                    <th class="border-dark" rowspan="3">
                                        Penetapan Tujuan Belajar
                                    </th>
                                    <td class="border-dark">Kerohanian</td>
                                    <!-- target -->
                                    <td class="border-dark">38</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">38</td>
                                    <!-- persen -->
                                    <td class="border-dark">100</td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border-dark">Pendidikan</td>
                                    <!-- target -->
                                    <td class="border-dark">24</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">24</td>
                                    <!-- persen -->
                                    <td class="border-dark">100</td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border-dark">Karakter</td>
                                    <!-- target -->
                                    <td class="border-dark">38</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">38</td>
                                    <!-- persen -->
                                    <td class="border-dark">100</td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>


                                <tr class="text-center">
                                    <th class="border-dark" rowspan="6">
                                        Pengetahuan dan Keterampilan
                                    </th>
                                    <td class="border-dark">PDTH</td>
                                    <!-- target -->
                                    <td class="border-dark">100</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">85</td>
                                    <!-- persen -->
                                    <td class="border-dark">85</td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">3</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border-dark">KARAKTER</td>
                                    <!-- target -->
                                    <td class="border-dark">100</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">85</td>
                                    <!-- persen -->
                                    <td class="border-dark">85</td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">3</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border-dark">Alkitab</td>
                                    <!-- target -->
                                    <td class="border-dark">100</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">85</td>
                                    <!-- persen -->
                                    <td class="border-dark">85</td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">3</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">Gitar</td>
                                    <!-- target -->
                                    <td class="border-dark">100</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">85</td>
                                    <!-- persen -->
                                    <td class="border-dark">85</td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">3</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">Media Komunikasi</td>
                                    <!-- target -->
                                    <td class="border-dark">100</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">95</td>
                                    <!-- persen -->
                                    <td class="border-dark">95</td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">Pameran**</td>
                                    <!-- target -->
                                    <td class="border-dark">19</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">18</td>
                                    <!-- persen -->
                                    <td class="border-dark">95</td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <th class="border-dark">
                                        Kehadiran Kelas
                                    </th>
                                    <td class="border-dark">Kehadiran</td>
                                    <!-- target -->
                                    <td class="border-dark">1886</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">1852</td>
                                    <!-- persen -->
                                    <td class="border-dark">98</td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>



                                <tr class="text-center">
                                    <th rowspan="2" class="border-dark">
                                        JURNAL
                                    </th>
                                    <td class="border-dark">Home Meeting</td>
                                    <!-- target -->
                                    <td class="border-dark">19</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">19</td>
                                    <!-- persen -->
                                    <td class="border-dark">100</td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">

                                    <td class="border-dark">Catatan Berkat</td>
                                    <!-- target -->
                                    <td class="border-dark">19</td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark">18</td>
                                    <!-- persen -->
                                    <td class="border-dark">95</td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Mencapai Target</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>


                                <tr class="text-center">
                                    <th rowspan="11" class="border-dark">
                                        Kebajikan dan Karakter <br>(Pengamatan Mentor)
                                    </th>
                                    <td class="border-dark">Perhatian & Berbagi</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">3</td>
                                    <td class="border-dark">Sangat Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">

                                    <td class="border-dark">Tegur - Sapa - Salam</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">3</td>
                                    <td class="border-dark">Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">Bersyukur dan Berterima Kasih</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Sangat Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">Hormat & Taat</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">3</td>
                                    <td class="border-dark">Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">Ramah & Sopan</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Sangat Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">Berkordinasi</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark"></td>
                                    <td class="border-dark"></td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Sangat Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">Tolong Menolong</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Sangat Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">See & Do</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Sangat Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">Benar</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">3</td>
                                    <td class="border-dark">Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">Tepat</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">3</td>
                                    <td class="border-dark">Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">Ketat</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">B</td>
                                    <td class="border-dark">3</td>
                                    <td class="border-dark">Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <th rowspan="3" class="border-dark">
                                        Kebersihan dan Kerapian
                                    </th>
                                    <td class="border-dark">Lemari</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Sangat Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>


                                <tr class="text-center">
                                    <td class="border-dark">Ranjang</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Sangat Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="border-dark">Rak Sepatu</td>
                                    <!-- target -->
                                    <td class="border-dark"></td>
                                    <!-- nilai akhir -->
                                    <td class="border-dark"></td>
                                    <!-- persen -->
                                    <td class="border-dark"></td>
                                    <td class="border-dark">A</td>
                                    <td class="border-dark">4</td>
                                    <td class="border-dark">Sangat Baik</td>
                                    <!-- keterangan -->
                                    <td class="border-dark"></td>
                                </tr>

                                <tr class="text-center">
                                    <th rowspan="2" colspan="5" class="table-secondary border-dark mb-md-3">
                                        Bobot (116)
                                    </th>
                                    <th class="border-dark">Huruf</th>
                                    <th rowspan="2" class=" table-secondary border-dark">105</th>
                                    <th class=" border-dark b table-secondary">Persentase</th>
                                    <th rowspan="2" class=" border-dark"></th>
                                </tr>
                                <tr class="text-center">
                                    <th class="border-dark">A</th>
                                    <th class=" border-dark table-secondary">90.52%</th>
                                </tr>

                                <tr>
                                    <th rowspan="3" class="border-dark text-center">
                                        Akademik<br>(Persiapan SBMPTN)
                                    </th>
                                    <th class="border-dark text-center">MATERI</th>
                                    <th class="border-dark text-center">TPA</th>
                                    <th class="border-dark text-center">TPS</th>
                                    <th class="border-dark text-center">Total</th>
                                    <th class="border-dark text-center">Rata-rata</th>
                                    <td colspan="3" rowspan="3" class="border-dark">
                                        <a class="font-weight-bold">
                                            Keterangan:<br>
                                        </a>
                                        PDTH: Pelajaran Dasar Tentang Hayat <br>
                                        *Pengisian Jurnal<br>
                                        ** Partisipasi
                                    </td>

                                </tr>

                                <tr>
                                    <td class="border-dark">Tryout</td>
                                    <td class="border-dark"></td>
                                    <td class="border-dark"></td>
                                    <td class="border-dark"></td>
                                    <td class="border-dark"></td>
                                </tr>
                                <tr>
                                    <td class="border-dark">UTBK</td>
                                    <td class="border-dark"></td>
                                    <td class="border-dark"></td>
                                    <td class="border-dark"></td>
                                    <td class="border-dark"></td>
                                </tr>

                                <tr>
                                    <th colspan="9" class="border-dark">
                                        Catatan:
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="8" class="border-dark">

                                    </th>
                                    <td class="border-dark text-center">
                                        Mentor
                                        <br><br><br><br><br><br><br><br> Adi Pamungkas
                                    </td>
                                </tr>
                            </tbody>













































































                        </table>

                    </center>






                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <?php
                include 'template/footer.php';
                ?>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>


</body>

</html>