<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/{{$user->role->role}}/user">
                    <span class="align-text-bottom"><i class="fa-solid fa-user-group"></i></span>
                    User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/{{$user->role->role}}/role">
                    <span class="align-text-bottom"><i class="fa-solid fa-circle-check pe-1"></i></span>
                    Role
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " aria-current="page" href="/{{$user->role->role}}/dinas">
                    <span class="align-text-bottom"><i class="fa-solid fa-building-user"></i></span>
                    Dinas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " aria-current="page" href="/{{$user->role->role}}/profile">
                    <span class="align-text-bottom"><i class="fa-solid fa-user pe-1"></i></span>
                    Profile
                </a>
            </li>
        </ul>

        <div class="user-data">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-5 mb-1 text-muted text-uppercase">
                <span>User Information</span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                    <span data-feather="plus-circle" class="align-text-bottom"></span>
                </a>
            </h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <div class="nav-link">
                        username:
                        <p>{{$user->name}}</p>
                        
                        role:
                        <p>{{$user->role->role}}</p>
                        
                        dinas:
                        <p>{{$user->dinas->dinas}}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>