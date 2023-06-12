<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('mahasiswa') }}"><img src="{{ asset('img/Logo.svg') }}"
                alt="Teknik Komputer Undip"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex justify-content-start">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    

                </ul>
            </div>
            <ul class="navbar-nav mb-2 mb-lg-0">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item mx-2" style="list-style-type: none">
                            <a href="{{ route('login') }}" type="button" class="btn btn-light nav-link"
                                style="border-radius: 24px">
                                <div style="padding: 0px 10px; font-size: 14px; font-weight: 600; color: black"">
                                    {{ __('Login') }}</div>
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item" style="list-style-type: none">
                            <a href="{{ route('register') }}" type="button" class="btn btn-light nav-link"
                                style="border-radius: 24px">
                                <div style="padding: 0px 10px; font-size: 14px; font-weight: 600; color: black">
                                    {{ __('Register') }}</div>
                            </a>
                        </li>
                    @endif
                @else
                <li class="nav-item my-auto">
                    <a class="nav-link" aria-current="page" href="{{ route('permohonan') }}">Permohonan KP</a>
                </li>
                <li class="nav-item my-auto">
                    @if(isset($mhs->mhspermohonan) && $mhs->mhspermohonan->status == 1)
                    <a class="nav-link" href="{{ route('pendaftaran') }}">Pendaftaran KP</a>
                    @else
                    
                    @endif
                </li>
                <li class="nav-item my-auto">
                    @if(isset($mhs->mhspendaftaran) && $mhs->mhspermohonan->status == 1)
                    <a class="nav-link" href="{{ route('pengumpulan') }}">Pengumpulan Berkas</a>
                    @else
                    @endif
                </li>
                <li class="nav-item my-auto">
                    @if(isset($mhs->mhsbimbingan) && $mhs->mhsbimbingan->status == 'acc' && $mhs->mhspermohonan->status == 1)
                    <a class="nav-link" href="{{ route('finalisasi') }}">Finalisasi Berkas</a>
                    @else
                    @endif
                </li>
                <li class="nav-item">
                    <div class="divider-vertical"></div>
                </li>
                    <li class="nav-item dropdown no-arrow" role="presentation" style="list-style-type: none">
                        <div class="nav-item dropdown no-arrow">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown"
                                aria-expanded="false" href="#">
                                
                                @if (Auth::user()->image)
                                    <figure class="img-profile rounded-circle avatar font-weight-bold"
                                        style="background-image: url({{ asset('storage/' . Auth::user()->image) }});
                                        object-fit: fill;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: center;
                                        width: 45px;
                                        height: 45px;
                                        border-radius: 50%;
                                        overflow: hidden;
                                        opacity: 1;
                                        display: inline-flex;
                                        vertical-align: middle;">
                                    </figure>
                                @else()
                                    <figure class="img-profile rounded-circle avatar font-weight-bold"
                                        data-initial="{{ Auth::user()->name[0] }}">
                                    </figure>
                                @endif
                                <span class="d-none d-lg-inline mr-2 text-gray-600 small">{{ substr(Auth::user()->name, 0,  20) }}</span>
                            </a>
                            <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                    {{-- <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li> --}}
                @endguest
            </ul>

        </div>
    </div>
</nav>

<script>
    const mediaQuery = window.matchMedia('(max-width: 768px)');
    // Function to handle the media query changes
    const handleMediaQueryChange = (mediaQuery) => {
    const element = document.getElementById('navbarSupportedContent'); // Replace 'your-element-id' with the actual ID of your element

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
