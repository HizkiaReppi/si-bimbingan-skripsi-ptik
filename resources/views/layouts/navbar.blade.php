<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if (Auth::user()->photo)
                            <img src="{{ asset('storage/images/profile-photo/' . Auth::user()->photo) }}" class="w-px-40 h-auto rounded-circle" alt="{{ Auth::user()->name }}" />
                        @else
                            <img src="https://eu.ui-avatars.com/api/?name={{ Auth::user()->name }}&size=250" class="w-px-40 h-auto rounded-circle" alt="{{ Auth::user()->name }}" />
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="" class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block">{{ auth()->user()->name }}</span>
                                    @if (auth()->user()->role == 'lecturer')
                                        <small class="text-muted">{{ auth()->user()->lecturer->nidn }}</small>
                                    @elseif (auth()->user()->role == 'student')
                                        <small class="text-muted">{{ auth()->user()->student->nim }}</small>
                                    @elseif (auth()->user()->role == 'HoD')
                                        <small class="text-muted">Ketua Jurusan</small>
                                    @else 
                                        <small class="text-muted text-capitalize">{{ auth()->user()->role }}</small>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                            <form class="dropdown-item" method="POST" action="/logout">
                                @csrf
                                
                                <button type="submit" class="btn p-0">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">Log Out</span>
                                </button>
                            </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>