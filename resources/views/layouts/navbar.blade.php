<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="{{ asset('img/Logo.svg') }}" alt="Teknik Komputer Undip"></a>
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dokumen') }}" style="">Dokumen KP</a>
                </li>
                <li class="nav-item">
                    <div class="divider-vertical"></div>
                </li>
                <li class="nav-item">
                    <div class="btn-login">
                        <a href="{{ route('login') }}">
                            <button type="button" class="btn btn-light" style="border-radius: 10px; background-color:#0B87BA">
                                <div style="padding: 0px 15px; font-size: 14px; font-weight: 600; color:aliceblue">Login</div>
                            </button>
                        </a>
                    </div>
                </li>
                
            </ul>
        </div>
    </div>
</nav>

