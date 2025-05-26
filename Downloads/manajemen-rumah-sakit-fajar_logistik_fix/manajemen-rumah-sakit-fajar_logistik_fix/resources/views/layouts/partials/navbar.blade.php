<nav class="navbar navbar-expand-md navbar-light sticky-top">
    <div class="container-fluid">
        <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
            Manajemen Rumah Sakit
        </a>
        <div class="d-flex align-items-center">
            <div class="dropdown">
                <button class="btn btn-link nav-link dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle"></i>
                    {{ Auth::user()->name ?? 'Pengguna' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user fa-fw me-2"></i>Profil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog fa-fw me-2"></i>Pengaturan</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt fa-fw me-2"></i>Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav> 