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
                <span class="fw-bold fs-4">TemanGenerus</span>
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <span class="fw-bold fs-5">Teman</span>
            </span>
            <span class="logo-lg">
                <span class="fw-bold fs-4">TemanGenerus</span>
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
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-title"><span data-key="t-menu">Administrasi</span></li>
                <!-- Desa & Kelompok -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('administrasi.desa-kelompok') ? 'active' : '' }}"
                        href="{{ route('administrasi.desa-kelompok') }}">
                        <i class="mdi mdi-map-marker-multiple-outline"></i>
                        <span>Desa & Kelompok</span>
                    </a>
                </li>
                <!-- Genersi Penerus -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('administrasi.generasi-penerus') ? 'active' : '' }}"
                        href="{{ route('administrasi.generasi-penerus') }}">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span>Generasi Penerus</span>
                    </a>
                </li>
                {{-- Kegiatan --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('administrasi.kegiatan-generus') ? 'active' : '' }}"
                        href="{{ route('administrasi.kegiatan-generus') }}">
                        <i class="mdi mdi-calendar-check-outline"></i>
                        <span>Kegiatan Generus</span>
                    </a>
                </li>         
                
                <li class="menu-title"><span data-key="t-menu">Kurikulum KBM</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('kurikulum-kbm.periode-jenjang') ? 'active' : '' }}"
                        href="{{ route('kurikulum-kbm.periode-jenjang') }}">
                        <i class="mdi mdi-calendar-check-outline"></i>
                        <span>Periode & Jenjang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('kurikulum-kbm.aspek-materi') ? 'active' : '' }}"
                        href="{{ route('kurikulum-kbm.aspek-materi') }}">
                        <i class="mdi mdi-calendar-check-outline"></i>
                        <span>Aspek Materi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('kurikulum-kbm.laporan-kbm') ? 'active' : '' }}"
                        href="{{ route('kurikulum-kbm.laporan-kbm') }}">
                        <i class="mdi mdi-calendar-check-outline"></i>
                        <span>Laporan KBM</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('kurikulum-kbm.rekap-kbm') ? 'active' : '' }}"
                        href="{{ route('kurikulum-kbm.rekap-kbm') }}">
                        <i class="mdi mdi-calendar-check-outline"></i>
                        <span>Rekap Kurikulum</span>
                    </a>
                </li>
                @php($role = auth()->user()->peran)
                
                {{-- DESA --}}
                @if(in_array($role, ['SUPERADMIN','DESA']))
                <li class="menu-title"><span data-key="t-menu">Operasional</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('operasional.kegiatan-generus') ? 'active' : '' }}"
                        href="{{ route('operasional.kegiatan-generus') }}">
                        <i class="mdi mdi-calendar-check-outline"></i>
                        <span>Operasional Kegiatan</span>
                    </a>
                </li>
                @endif
                <li class="menu-title"><span data-key="t-menu">MODUL</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('temanpengurus.dashboard.index') ? 'active' : '' }}"
                        href="{{ route('temanpengurus.dashboard.index') }}" target="_blank">
                        <i class="mdi mdi-shield-account-outline"></i>
                        <span>TemanPengurus</span>
                    </a>
                </li>
                @if(in_array($role, ['SUPERADMIN']))
                <li class="menu-title"><span data-key="t-menu">sistem</span></li>
                <!-- Akses Petugas -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('sistem.akses-pengguna') ? 'active' : '' }}"
                        href="{{ route('sistem.akses-pengguna') }}">
                        <i class="mdi mdi-shield-account-outline"></i>
                        <span>Akses Pengguna</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>