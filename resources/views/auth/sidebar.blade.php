<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            @canany(['newuser','superadmin','skpd','admin_fo','staff_perundang_undangan',
            'kasubag_perundang_undangan','kabag','kepala_dinas','sekda','walikota',
            'kasubag_dokumentasi'])
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <span class="align-text-bottom"><i class="fa-solid fa-table-columns"></i></span>
                    Dashboard
                </a>
            </li>
            @endcanany

            @can('skpd')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/skpd/addprodukhukum') ? 'active' : '' }}" aria-current="page" href="/dashboard/skpd/addprodukhukum">
                    <span class="align-text-bottom"><i class="fa-solid fa-plus"></i></span>
                    Pengajuan Produk Hukum
                </a>
            </li>
            @endcan

            @can('staff_dokumentasi')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <span class="align-text-bottom"><i class="fa-solid fa-table-columns"></i></span>
                    Pengajuan Produk Hukum
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/katalogprodukhukum') ? 'active' : '' }}" aria-current="page" href="/dashboard/katalogprodukhukum">
                    <span class="align-text-bottom"><i class="fa-solid fa-table-columns"></i></span>
                    Katalog Produk Hukum 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/staffd/addprodukhukum') ? 'active' : '' }}" aria-current="page" href="/dashboard/staffd/addprodukhukum">
                    <span class="align-text-bottom"><i class="fa-solid fa-plus"></i></span>
                    Tambah Produk Hukum
                </a>
            </li>
            @endcan

            @can('kasubag_dokumentasi')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/kasubagd/publikasi') ? 'active' : '' }}" aria-current="page" href="/dashboard/kasubagd/publikasi">
                    <span class="align-text-bottom"><i class="fa-solid fa-table-columns"></i></span>
                    Publikasi
                </a>
            </li>
            @endcan

            @can('superadmin')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/user') ? 'active' : '' }}" aria-current="page" href="/dashboard/user">
                    <span class="align-text-bottom"><i class="fa-solid fa-user-group"></i></span>
                    User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/dinas') ? 'active' : '' }}" aria-current="page" href="/dashboard/dinas">
                    <span class="align-text-bottom"><i class="fa-solid fa-building-user"></i></span>
                    Dinas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/jenis') ? 'active' : '' }}" aria-current="page" href="/dashboard/jenis">
                    <span class="align-text-bottom"><i class="fa-solid fa-list pe-1"></i></span>
                    Jenis
                </a>
            </li>
            @endcan
            <li class="nav-item ">
                <a class="nav-link {{ Request::is('dashboard/profile') ? 'active' : '' }}" aria-current="page" href="/dashboard/profile">
                    <span class="align-text-bottom"><i class="fa-solid fa-user pe-1"></i></span>
                    Profile
                </a>
            </li>
        </ul>

        <div class="user-data">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-5 mb-1 text-muted text-uppercase">
                <span class="fw-bold font-black">User Information</span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                    <span data-feather="plus-circle" class="align-text-bottom"></span>
                </a>
            </h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <div class="nav-link">
                        <strong>Username:</strong>
                        <p>{{Auth::user()->name}}</p>
                        
                        <strong>Role:</strong>
                        <p>{{Auth::user()->role->role}}</p>
                        
                        <strong>Dinas:</strong>
                        <p>{{Auth::user()->dinas->dinas}}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>