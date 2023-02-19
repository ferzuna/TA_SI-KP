<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="{{ asset('img/Logo.svg') }}" alt="Teknik Komputer Undip"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="#">Dokumen KP</a>
                </li>
            </ul>
            <div class="btn-login">
                <a href="{{ route('login') }}">
                    <button type="button" class="btn btn-light" style="border-radius: 24px">
                        <div style="padding: 0px 10px; font-size: 14px; font-weight: 600">Login</div>
                    </button>
                </a>
            </div>
        </div>
    </div>
</nav>
