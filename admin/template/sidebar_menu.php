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

     <!-- Heading -->
     <div class="sidebar-heading">
         Interface Administrator
     </div>


     <!-- Data siswa -->
     <li class="nav-item active">
         <a class="nav-link" href="Siswa.php">
             <i class="fas fa-fw fa-users"></i>
             <span>Data Siswa</span></a>
     </li>

     <!-- Data Mentor -->
     <li class="nav-item active">
         <a class="nav-link" href="mentor.php">
             <i class="fas fa-fw fa-users"></i>
             <span>Data Mentor</span></a>
     </li>

     <!-- Data Jurusan -->
     <li class="nav-item active">
         <a class="nav-link" href="jurusan.php">
             <i class="fas fa-plus-square"></i>
             <span>Tambah Jurusan</span></a>
     </li>


     <!-- Data Angkatan -->
     <li class="nav-item active">
         <a class="nav-link" href="angkatan.php">
             <i class="fas fa-plus-square"></i>
             <span>Tambah Angkatan</span></a>
     </li>

     <!-- Data Categori doa -->
     <li class="nav-item active">
         <a class="nav-link" href="categoridoa.php">
             <i class="fas fa-plus-square"></i>
             <span>Tambah Categori Doa</span></a>
     </li>









     <!-- 
     <li class="nav-item active">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-plus-square"></i>
             <span>Data</span>
         </a>
         <div id="collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">kategori:</h6>
                 <a class="collapse-item" href="jurusan.php">Jurusan</a>
                 <a class="collapse-item" href="angkatan.php">Angkatan</a>
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
                 <h6 class="collapse-header">kategori:</h6>
                 <a class="collapse-item" href="report.php">Weekly</a>
                 <a class="collapse-item" href="report_final.php">Final</a>
             </div>
         </div>
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