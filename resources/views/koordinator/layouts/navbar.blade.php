<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink iconsenyum"></i></div>
        <div class="sidebar-brand-text mx-3"> SMDM </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Master Data') }}
    </div>

    <!-- Nav Item - Santri -->
    <li class="nav-item">
        <a class="nav-link">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Data Santri') }}</span>
        </a>
    </li>

    <!-- Nav Item - Pengaturan -->
    <li class="nav-item">
        <a class="nav-link">
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
