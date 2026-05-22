 <div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        {{-- <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset('assets')}}/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('assets')}}/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset('assets')}}/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('assets')}}/images/logo-light.png" alt="" height="17">
            </span>
        </a> --}}
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <span class="fw-bold fs-5">Teman</span>
            </span>
            <span class="logo-lg">
                <span class="fw-bold fs-4">TemanPengurus</span>
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <span class="fw-bold fs-5">Teman</span>
            </span>
            <span class="logo-lg">
                <span class="fw-bold fs-4">TemanPengurus</span>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid" style="max-width: 100%">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('temanpengurus.dashboard.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('temanpengurus.dashboard.index') ? 'active' : '' }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-title"><span data-key="t-menu">Administrasi</span></li>
                <!-- Desa & Kelompok -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('temanpengurus.administrasi.desa-kelompok') ? 'active' : '' }}"
                        href="{{ route('temanpengurus.administrasi.desa-kelompok') }}">
                        <i class="mdi mdi-map-marker-multiple-outline"></i>
                        <span>Desa & Kelompok</span>
                    </a>
                </li>
                <!-- Pengurus -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('temanpengurus.administrasi.pengurus') ? 'active' : '' }}"
                        href="{{ route('temanpengurus.administrasi.pengurus') }}">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span>Master Pengurus</span>
                    </a>
                </li>
                {{-- Kegiatan --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('temanpengurus.administrasi.kegiatan-pengurus') ? 'active' : '' }}"
                        href="{{ route('temanpengurus.administrasi.kegiatan-pengurus') }}">
                        <i class="mdi mdi-calendar-check-outline"></i>
                        <span>Kegiatan Pengurus</span>
                    </a>
                </li>                                
                {{-- LAPORAN --}}
                <li class="menu-title"><span data-key="t-menu">Laporan</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('laporan.desa.event') ? 'active' : '' }}"
                        href="{{ route('laporan.desa.event') }}">
                        <i class="mdi mdi-calendar-check-outline"></i>
                        <span>Laporan Kegiatan Pengurus</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>