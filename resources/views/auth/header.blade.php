<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand logo col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">SmartKUM</a>
    <!-- <button class="navbar-toggler position-absolute d-md-none collapsed me-5" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> -->
    <button class="navbar-toggler position-absolute d-md-none collapsed me-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <input class="form-control form-control-dark rounded-3 border-1 search-bar" type="text" placeholder="Search" aria-label="Search"> -->
    
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                @canany(['newuser','skpd','admin_fo','staff_perundang_undangan',
                'kasubag_perundang_undangan','kabag','kepala_dinas','sekda','walikota',
                'staff_dokumentasi','kasubag_dokumentasi'])
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
                    <a class="nav-link {{ Request::is('dashboard/dokumentasi/addprodukhukum') ? 'active' : '' }}" aria-current="page" href="/dashboard/skpd/addprodukhukum">
                        <span class="align-text-bottom"><i class="fa-solid fa-plus"></i></span>
                        Tambah Produk Hukum
                    </a>
                </li>
                @endcan

                @can('superadmin')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                        <span class="align-text-bottom"><i class="fa-solid fa-user-group"></i></span>
                        User
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/role') ? 'active' : '' }}" href="/dashboard/role">
                        <span class="align-text-bottom"><i class="fa-solid fa-circle-check pe-1"></i></span>
                        Role
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/dinas') ? 'active' : '' }}" aria-current="page" href="/dashboard/dinas">
                        <span class="align-text-bottom"><i class="fa-solid fa-building-user"></i></span>
                        Dinas
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
    </div>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="nav-link px-3 rounded-3 border-0 btn-logout">Logout</button>
        </form>
        </div>
    </div>
</header>