<div class="col-md-3 col-lg-2 d-md-block sidebar collapse" id="sidebarMenu">
    <div class="position-sticky pt-3">
        <div class="text-center mb-4">
            <h4 class="text-white">Sistem Logistik</h4>
            <p class="text-white-50 small mb-0">Rumah Sakit</p>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('logistik.dashboard') ? 'active' : '' }}" 
                   href="{{ route('logistik.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    Beranda
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('equipment.*') ? 'active' : '' }}" 
                   href="{{ route('equipment.index') }}">
                    <i class="fas fa-fw fa-hospital"></i>
                    Peralatan
                </a>
            </li>
        </ul>
    </div>
</div> 