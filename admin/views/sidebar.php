<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $page == 1 ? 'active' : '' ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $page == 7 ? 'active' : '' ?>">
        <a class="nav-link" href="admin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Admin</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Admin -->
    <li class="nav-item <?= $page == 2 ? 'active' : '' ?>">
        <a class="nav-link" href="data_pendaftar.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Pendaftar</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $page == 3 || $page == 4  || $page == 5 ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#active" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Kriteria</span>
        </a>
        <div id="active" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kategori</h6>
                <a class="collapse-item <?= $page == 3 ? 'active' : '' ?>" href="kriteria.php">Kriteria</a>
                <a class="collapse-item <?= $page == 4 ? 'active' : '' ?>" href="sub_kriteria.php">Sub Kriterai</a>
                <a class="collapse-item <?= $page == 5 ? 'active' : '' ?>" href="kriteria_karyawan.php">Kriteria Karyawan</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $page == 6 ? 'active' : '' ?>">
        <a class="nav-link" href="hasil.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Metode PROMETHEE</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $page == 8 ? 'active' : '' ?>">
        <a class="nav-link" href="smart.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Metode SMART</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->