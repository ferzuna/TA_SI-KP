<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #04144C">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" style="height: auto !important"
        href="/">
        <img src="{{ asset('img/Logo-navbar.svg') }}" alt="">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    {{-- <hr class="sidebar-divider"> --}}

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        {{ __('Master Data') }}
    </div> --}}


    <!-- Nav Item - Santri -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen.list-mahasiswa') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('List Mahasiswa') }}</span>
        </a>
    </li>

    <!-- Nav Item - Santri -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen.pendaftaran') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Pendaftaran KP') }}</span>
        </a>
    </li>

    <!-- Nav Item - Pengaturan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen.bimbingan') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Bimbingan Seminar') }}</span>
        </a>
    </li>

    <!-- Nav Item - Pengaturan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen.jadwal') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Jadwal Pelaksanaan KP') }}</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen.pengaturan') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{ __('Pengaturan') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
