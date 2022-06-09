 <!-- Sidebar -->
 <style type="text/css">
     .sidebar {
         background-color: black;
     }

     li:hover,
     li:active {
         background-color: #007BFF;
         color: white;
     }



     .nama {
         color: black;
     }

     .nama:hover {
         color: white;
     }
 </style>
 <ul class="navbar-nav hitam sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-bible"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Administrator</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="index.php">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dasbor</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">


     <!-- Data siswa -->
     <li class="nav-item active">
         <a class="nav-link" href="siswa.php">
             <i class="fas fa-fw fa-users"></i>
             <span>Data Siswa</span></a>
     </li>

     <!-- Data Mentor -->
     <li class="nav-item active">
         <a class="nav-link" href="mentor.php">
             <i class="fas fa-fw fa-users"></i>
             <span>Data Mentor</span></a>
     </li>


     <li class="nav-item active">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kategori" aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-plus-square"></i>
             <span>Kategori</span>
         </a>
         <div id="kategori" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="categoridoa.php">Doa</a>
                 <a class="collapse-item" href="categori_exhibition.php">Pameran</a>
                 <a class="collapse-item" href="Punishment.php">Punishment</a>
                 <a class="collapse-item" href="grace.php">Grace</a>
                 <a class="collapse-item" href="jurusan.php">Jurusan</a>
                 <a class="collapse-item" href="angkatan.php">Angkatan</a>
                 <a class="collapse-item" href="semester.php">Semester</a>
                 <a class="collapse-item" href="target_jurnal.php">Target Junal PKA</a>
                 <a class="collapse-item" href="kegiatan.php">Kegiatan Presensi</a>
             </div>
         </div>
     </li>


     <li class="nav-item active">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Additional" aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-fw fa-table"></i>
             <span>Aspek <br> Pembelajaran</span>
         </a>
         <div id="Additional" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Item:</h6>
                 <a class="collapse-item" href="tb_pengembangan_diri.php">Pengembangan Diri <br>(Kerohanian)</a>
                 <a class="collapse-item" href="tb_penetapan_tujuan_belajar.php">Penetapan Tujuan Belajar</a>
                 <a class="collapse-item" href="tb_keterampilan.php">Keterampilan</a>
                 <a class="collapse-item" href="tb_kehadiran_kelas.php">Kehadiran Kelas</a>
                 <a class="collapse-item" href="tb_jurnal.php">Jurnal</a>
                 <a class="collapse-item" href="tb_pengamatan_mentor.php">Kebajikan dan Karakter <br>
                     (Pengamatan Mentor)</a>
                 <a class="collapse-item" href="tb_Kebersihan_Kerapian.php">Kebersihan dan Kerapian</a>
                 <!-- <a class="collapse-item" href="#">Akademik <br>
                     (Persiapan SBMPTN)</a> -->
                 <h6 class="collapse-header">Pengetahuan:</h6>
                 <a class="collapse-item" href="tb_kelas_visi.php">Kelas Visi</a>
                 <a class="collapse-item" href="tb_kelas_hayat.php">Kelas Hayat</a>
                 <a class="collapse-item" href="tb_kelas_karakter.php">Kelas Karakter</a>
                 <a class="collapse-item" href="tb_kelas_konstitusi.php">Kelas Konsititusi</a>
             </div>
         </div>
     </li>

     <li class="nav-item active">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-fw fa-table"></i>
             <span>Laporan</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Kategori:</h6>
                 <a class="collapse-item" href="reportweekly.php">Mingguan</a>
                 <a class="collapse-item" href="rapor_siswa.php">Semester</a>
             </div>
         </div>
     </li>


     <!-- <li class="nav-item active">
         <a class="nav-link" href="backupdatabase.php">
             <i class="fas fa-database"></i>
             <span>Database</span></a>
     </li> -->

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Nav Item - Log Out-->
     <li class="nav-item active">
         <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
             <i class="fas fa-sign-out-alt"></i>
             <span>Keluar</span></a>
     </li>

     <!-- Sidebar Toggler (Sidebar) -->
     <!-- <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div> -->


 </ul>
 <!-- End of Sidebar -->