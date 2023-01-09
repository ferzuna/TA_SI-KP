@extends('koordinator.layouts.main')

@section('section')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">{{ __('Sistem Manajemen Data Mahasantri') }}</h1>

        @if (session('success'))
            <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success border-left-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Santri Aktif</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">aktif</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Santri Tidak Aktif
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">noaktif</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-alt-slash fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Santri Putra</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">putra</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-male fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Santri Putri</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">putri</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-female fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header-primary py-3">
                        <h6 class="m-0 font-weight-bold text-gray-100">Welcome</h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                            <b>Selamat Datang Fadzil </b></br></br>
                            Anda telah login sebagai Administrator, Silahkan menggunakan menu di panel kiri.
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header-success py-3">
                        <h6 class="m-0 font-weight-bold text-gray-100">About</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                src="{{ asset('img/logoundip.svg') }}" alt="">
                        </div>
                        <p class="text-justify">Pondok Pesantren Darul Ilmi ini didirikan pada tahun 2018. Berawal dari
                            kontrak
                            asrama hingga dapat membangun bangunan pesantren pada tahun 2020. Pesantren modern berbasis
                            digital
                            dan entrepreneurship yang menjadi santri mahir dalam teknologi serta mampu beradaptasi dengan
                            perkembangan zaman.</p>
                        <a target="_blank" rel="nofollow" href="https://ponpesdarulilmimeteseh.com/">Website Utama Ponpes
                            Darul
                            Ilmi →</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Page Heading -->
@endsection
