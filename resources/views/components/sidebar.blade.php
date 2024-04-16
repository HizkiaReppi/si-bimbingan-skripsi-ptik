@php
    $homeLink = null;

    if(auth()->user()->role == 'student') {
        $homeLink = route('dashboard.bimbingan.index');
    } elseif(auth()->user()->role == 'lecturer') {
        $homeLink = route('dashboard.atur-jadwal-bimbingan.index');
    } elseif(auth()->user()->role == 'HoD') {
        $homeLink = route('dashboard.aktivitas-bimbingan.index');
    } elseif(auth()->user()->role == 'admin') {
        $homeLink = route('dashboard');
    }
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ $homeLink }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold ms-2 text-uppercase">SIBS PTIK</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        @can('student')
            <li class="menu-item {{ request()->is('bimbingan*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons fa-solid fa-list-check"></i>
                    <div data-i18n="Bimbingan">Bimbingan</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('dashboard.bimbingan.*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.bimbingan.index') }}" class="menu-link">
                            <div data-i18n="Bimbingan">Bimbingan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('dashboard.bimbingan-1.*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.bimbingan-1.index') }}" class="menu-link">
                            <div data-i18n="Dosen Pembimbing 1">Dosen Pembimbing 1</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('dashboard.bimbingan-2.*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.bimbingan-2.index') }}" class="menu-link">
                            <div data-i18n="Dosen Pembimbing 2">Dosen Pembimbing 2</div>
                        </a>
                    </li>
                </ul>
            </li>
        @elsecan('lecturer')
            <li class="menu-item {{ request()->routeIs('dashboard.atur-jadwal-bimbingan.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.atur-jadwal-bimbingan.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-list-check"></i>
                    <div data-i18n="Bimbingan">Atur Jadwal Bimbingan</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.mahasiswa-bimbingan.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.mahasiswa-bimbingan.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-user"></i>
                    <div data-i18n="Bimbingan">Mahasiswa Bimbingan</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.pengajuan-ujian-mahasiswa.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.pengajuan-ujian-mahasiswa.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-clipboard-list"></i>
                    <div data-i18n="Bimbingan">Pengajuan Ujian Hasil Mahasiswa</div>
                </a>
            </li>
        @elsecan('HoD')
            <li class="menu-item {{ request()->routeIs('dashboard.aktivitas-bimbingan.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.aktivitas-bimbingan.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-list-check"></i>
                    <div data-i18n="Aktivitas Bimbingan">Aktivitas Bimbingan</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.ujian.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.ujian.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-clipboard-list"></i>
                    <div data-i18n="Pengajuan Ujian Hasil">Pengajuan Ujian Hasil</div>
                </a>
            </li>
        @elsecan('admin')
            <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-list-check"></i>
                    <div data-i18n="Bimbingan">Dashboard</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Manajemen Pengguna</span>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.lecturer.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.lecturer.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-chalkboard-user"></i>
                    <div data-i18n="Dosen">Dosen</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.student.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.student.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-user"></i>
                    <div data-i18n="Mahasiswa">Mahasiswa</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.kajur.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.kajur.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-user-graduate"></i>
                    <div data-i18n="Kajur">Ketua Jurusan</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Manajemen Bimbingan</span>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.aktivitas-bimbingan.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.aktivitas-bimbingan.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-list-check"></i>
                    <div data-i18n="Aktivitas Bimbingan">Aktivitas Bimbingan</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.pengajuan-ujian-mahasiswa.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.pengajuan-ujian-mahasiswa.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-clipboard-list"></i>
                    <div data-i18n="Bimbingan">Pengajuan Ujian Hasil Mahasiswa</div>
                </a>
            </li>
        @endcan
    </ul>
</aside>
