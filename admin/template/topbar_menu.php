<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <!-- <label class=" m-lg-1">Pilih Siswa</label>
    <select name="filter" id="filter">
        <option value="">Pilih</option>
        <option value="1">Per Tanggal</option>
        <option value="2">Per Bulan</option>
        <option value="3">Per Tahun</option>
    </select> -->


    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow"><a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="mr-3 d-none nama d-lg-inline text-uppercase small"><?php echo $data['name']; ?></span></a>

            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown"><a class="dropdown-item" href="../../logout.php" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout </a></div>
        </li>
    </ul>
</nav>