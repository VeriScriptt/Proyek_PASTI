<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Partiga-Tiga</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <br>

    <!-- Nav Item - Dashboard -->
    <!-- Nav Item - Profil Toko -->
    <li class="nav-item" id="menu-profil-toko">
        <a href="/toko" class="nav-link" >
            <i class="fas fa-fw fa-user"></i>
            <span>Profil Toko</span></a>
    </li>

    <!-- Nav Item - Produk -->
    <li class="nav-item" id="menu-produk">
        <a href="/produk" class="nav-link">
            <i class="fas fa-fw fa-cubes"></i>
            <span>Produk</span></a>
    </li>

    <!-- Nav Item - Kategori -->
    <li class="nav-item" id="menu-kategori">
        <a href="/kategori" class="nav-link" >
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Kategori</span></a>
    </li>

    <!-- Nav Item - Ulasan -->
    <li class="nav-item" id="menu-ulasan">
        <a href="/ulasan" class="nav-link" >
            <i class="fas fa-fw fa-comment"></i>
            <span>Ulasan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<script>
    // Menangani klik pada toggler sidebar
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        document.getElementById('accordionSidebar').classList.toggle('toggled');
    });

    // Fungsi untuk menambahkan kelas 'active' ke menu yang sesuai
    function setActiveMenu() {
        const path = window.location.pathname;
        const menuItems = {
            '/penjual': 'menu-dashboard',
            '/toko': 'menu-profil-toko',
            '/produk': 'menu-produk',
            '/kategori': 'menu-kategori',
            '/penjual/ulasan': 'menu-ulasan'
        };

        if (menuItems[path]) {
            document.getElementById(menuItems[path]).classList.add('active');
        }
    }

    // Memanggil fungsi setActiveMenu saat halaman dimuat
    document.addEventListener('DOMContentLoaded', setActiveMenu);
</script>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('admin_assets/js/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin_assets/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('admin_assets/js/demo/chart-pie-demo.js') }}"></script>
