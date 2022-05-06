 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

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
             <span>Dashboard </span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">


     <!-- Data siswa -->
     <li class="nav-item active">
         <a class="nav-link" href="siswa.php">
             <i class="fas fa-fw fa-users"></i>
             <span>Student Data</span></a>
     </li>

     <!-- Data Mentor -->
     <li class="nav-item active">
         <a class="nav-link" href="mentor.php">
             <i class="fas fa-fw fa-users"></i>
             <span>Mentor Data</span></a>
     </li>


     <li class="nav-item active">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kategori" aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-plus-square"></i>
             <span>Category</span>
         </a>
         <div id="kategori" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="categoridoa.php">Prayer</a>
                 <a class="collapse-item" href="categori_exhibition.php">Exhibition</a>
                 <a class="collapse-item" href="Punishment.php">Punishment</a>
                 <a class="collapse-item" href="grace.php">Grace</a>
                 <a class="collapse-item" href="jurusan.php">Department</a>
                 <a class="collapse-item" href="angkatan.php">Batch</a>
                 <a class="collapse-item" href="semester.php">Semester</a>
                 <a class="collapse-item" href="target_jurnal.php">Target Junal PKA</a>
                 <a class="collapse-item" href="kegiatan.php">Activity List</a>
             </div>
         </div>
     </li>


     <!-- <li class="nav-item active">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Additional" aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-fw fa-table"></i>
             <span>Semester report items</span>
         </a>
         <div id="Additional" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Item:</h6>
                 <a class="collapse-item" href="tb_pengembangan_diri.php">Pengembangan Diri <br> (Kerohanian)</a>
                 <a class="collapse-item" href="#">Penetapan Tujuan Belajar</a>
                 <a class="collapse-item" href="#">Keterampilan</a>
                 <a class="collapse-item" href="#">Kehadiran Kelas</a>
                 <a class="collapse-item" href="#">Jurnal</a>
                 <a class="collapse-item" href="#">Kebajikan dan Karakter <br>
                     (Pengamatan Mentor)</a>
                 <a class="collapse-item" href="#">Kebersihan dan Kerapian</a>
                 <a class="collapse-item" href="#">Akademik <br>
                     (Persiapan SBMPTN)</a>
                 <h6 class="collapse-header">Pengetahuan:</h6>
                 <a class="collapse-item" href="#">Kelas Visi</a>
                 <a class="collapse-item" href="#">Kelas Hayat</a>
                 <a class="collapse-item" href="#">Kelas Karakter</a>
                 <a class="collapse-item" href="#">Kelas Konsititusi</a>
             </div>
         </div>
     </li> -->

     <li class="nav-item active">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-fw fa-table"></i>
             <span>Report</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Category:</h6>
                 <a class="collapse-item" href="reportweekly.php">Weekly</a>
                 <a class="collapse-item" href="rapor_siswa.php">Final</a>
             </div>
         </div>
     </li>


     <li class="nav-item active">
         <a class="nav-link" href="backupdatabase.php">
             <i class="fas fa-database"></i>
             <span>Database</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Nav Item - Log Out-->
     <li class="nav-item active">
         <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
             <i class="fas fa-sign-out-alt"></i>
             <span>Log Out</span></a>
     </li>

     <!-- Sidebar Toggler (Sidebar) -->
     <!-- <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div> -->


 </ul>
 <!-- End of Sidebar -->