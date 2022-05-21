<!-- Sidebar -->
<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-bible"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Jurnal PKA</div>
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

    <!-- Heading -->
    <div class="sidebar-heading">
        Tampilan Siswa
    </div>

    <!-- Nav Item - Profile -->
    <li class="nav-item active">
        <a class="nav-link" href="profile.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil Saya</span></a>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#jurnal" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fab fa-audible"></i>
            <span>Jurnal</span>
        </a>
        <div id="jurnal" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">kategori:</h6>
                <a class="collapse-item" href="revivalnote.php">Harian</a>
                <a class="collapse-item" href="Weekly.php">Mingguan</a>
                <a class="collapse-item" href="Monthly.php">Bulanan</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#living" aria-expanded="true" aria-controls="living">
            <i class="far fa-clipboard"></i>
            <span>Pemeriksaan</span>
        </a>
        <div id="living" class="collapse" aria-labelledby="living" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">kategori:</h6>
                <a class="collapse-item" href="living_buku.php">Lemari</a>
                <a class="collapse-item" href="livingraksepatudanhanduk.php">Rak Sepatu & Handuk</a>
                <a class="collapse-item" href="living_ranjang.php">Ranjang</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - final report -->
    <li class="nav-item active">
        <a class="nav-link" href="presence_siswa.php" aria-expanded="true" aria-controls="presence">
            <i class="fas fa-fw fa-table"></i>
            <span>Presensi</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pka" aria-expanded="true" aria-controls="pka">
            <i class="far fa-clipboard"></i>
            <span>Laporan</span>
        </a>
        <div id="pka" class="collapse" aria-labelledby="pka" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">kategori:</h6>
                <a class="collapse-item" href="reportweekly.php">Mingguan</a>
                <!-- <a class="collapse-item" href="report_semester.php">Semester</a> -->
            </div>
        </div>
    </li>











    <!-- Nav Item - final report -->
    <!-- <li class="nav-item active">
        <a class="nav-link" href="pengembangan.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Rapor Akhir</span></a>
    </li> -->
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Catatan
    </div>


    <!-- Nav Item - Tables -->
    <li class="nav-item active">
        <a class="nav-link" href="notes.php">
            <i class="fas fa-fw fa-file"></i>
            <span>Catatan Harian</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Log Out-->
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Log Out</span></a>
    </li>



    <!-- Sidebar Toggler (Sidebar) -->
    <!-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> -->

</ul>