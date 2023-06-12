<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #04144C">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" style="height: auto !important"
        href="/">
        <img style="width:95%" src="{{ asset('img/Logo-Navbar.svg') }}" alt="">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.info-magang') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Info Magang') }}</span></a>
    </li>

    <!-- Divider -->
    {{-- <hr class="sidebar-divider"> --}}

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        {{ __('Master Data') }}
    </div> --}}

    <!-- Nav Item - Santri -->

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.list-mahasiswa') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('List Mahasiswa') }}</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('bobot') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Bobot Bimbingan') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.permohonan') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Permohonan KP') }}</span>
        </a>
    </li>


    <!-- Nav Item - Pengaturan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.berkas-nilai') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Daftar Berkas dan Nilai') }}</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.pengaturan') }}">
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

<script>
    const mediaQuery = window.matchMedia('(max-width: 768px)');
    // Function to handle the media query changes
    const handleMediaQueryChange = (mediaQuery) => {
    const element = document.getElementById('accordionSidebar'); // Replace 'your-element-id' with the actual ID of your element

    if (mediaQuery.matches) {
        // Add the class when the media query matches
        element.classList.add('toggled'); // Replace 'your-class-name' with the name of your desired class
    } else {
        // Remove the class when the media query doesn't match
        element.classList.remove('toggled');
    }
    };

    // Initially, call the handler function once
    handleMediaQueryChange(mediaQuery);

    // Attach the handler function to the media query change event
    mediaQuery.addListener(handleMediaQueryChange);
</script>
