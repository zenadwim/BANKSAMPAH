<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="halaman_admin.php">
        <div class="sidebar-brand-text mx-3">BSPBS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="halaman_admin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Admin -->
    <li class="nav-item active">
        <a class="nav-link" href="tabel_admin.php">
            <i class="fas fa-user-cog"></i>
            <span>Admin</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Nasabah -->
    <li class="nav-item active">
        <a class="nav-link" href="tabel_nasabah.php">
            <i class="fas fa-users"></i>
            <span>Nasabah</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Sampah -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-trash"></i>
            <span>Sampah</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Sampah:</h6>
                <a class="collapse-item" href="sampah.php">Tabel Sampah</a>
                <a class="collapse-item" href="tabel_kategori.php">Kategori Sampah</a>
                <a class="collapse-item" href="harga_nasabah.php">Detil Harga Nasabah</a>
                <a class="collapse-item" href="harga_pengepul.php">Detil Harga Pengepul</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Setor -->
    <li class="nav-item active">
        <a class="nav-link" href="setor.php">
            <i class="fas fa-cart-plus"></i>
            <span>Setor</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Tabungan -->
    <li class="nav-item active">
        <a class="nav-link" href="tabel_penabung.php">
            <i class="fas fa-book"></i>
            <span>Riwayat Setor</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Tabungan -->
    <li class="nav-item active">
        <a class="nav-link" href="validasi_pengajuan.php">
            <i class="fas fa-check"></i>
            <span>Validasi Pengajuan</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->