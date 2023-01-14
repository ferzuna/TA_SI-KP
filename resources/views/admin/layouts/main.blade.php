<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- untuk css ini di folder public ya -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Kerja Praktik - Teknik Komputer</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/koordinator.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">

    <!-- tambahan untuk logout -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="app-koordinator">
        @include('admin.layouts.navbar')
        <div id="content-wrapper" class="d-flex flex-column">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3"
                        id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                    <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <div class="d-none d-sm-block topbar-divider"></div>

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                            </li>
                        @endguest
                        <!-- <li class="nav-item dropdown no-arrow" role="presentation">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                    data-toggle="dropdown" aria-expanded="false" href="#"><span
                                        class="d-none d-lg-inline mr-2 text-gray-600 small">Fadzil</span>
                                    <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="F">
                                    </figure>
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </div>
                        </li> -->
                    </ul>
                </div>
            </nav>

            @yield('section')
        </div>


    </div>
    @include('admin.layouts.footer')

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>


</body>

</html>
