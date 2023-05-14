@extends('koordinator.layouts.main')

@section('section')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><b>{{ __('Sistem Informasi Kerja Praktik') }}</b></h1>
        <div class="welcome-koordinator banner media-right">
            <div class="banner">
                <div class="media-right">
                    Anda telah Log In
                </div>
            </div>
            
        </div>
        

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
                <div class="card border-left-primary border-bottom-primary shadow h-100 py-2 notif-border">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-uppercase mb-1">Permohonan Belum Disetujui
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$mymahasiswa}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-alt fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success border-bottom-success shadow h-100 py-2 notif-border">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-uppercase mb-1">
                                    Permohonan Sudah Disetujui
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$mymahasiswa1}}</div>
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
                <div class="card border-left-info border-bottom-info shadow h-100 py-2 notif-border">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-uppercase mb-1">Berkas akhir yang belum dinilai</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$databelum}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-male fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning border-bottom-warning shadow h-100 py-2 notif-border">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-uppercase mb-1">
                                    Mahasiswa Sudah Selesai KP
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$mymahasiswaselesai}}</div>
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
                <div class="card card-border shadow mb-4">
                    <div class="card-header-primary card-header-border py-3">
                        <h4 class="m-0 font-weight-bold px-3" style="color:black">Welcome</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                            <b>Selamat Datang {{Auth::user()->name}} </b></br></br>
                            Anda telah login sebagai Koordinator KP, Silahkan menggunakan menu di panel kiri.
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 mb-4">

                <!-- Illustrations -->
                <div class="card card-border shadow mb-4">
                    <div class="card-header-primary card-header-border-about py-3">
                        <h4 class="m-0 font-weight-bold px-3" style="color:black">About</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4 card-border p-3" style="width: 25rem;"
                                src="{{ asset('img/logoUndip.svg') }}" alt="">
                        </div>
                        <p class="text-justify">Kerja Praktik (KP) merupakan salah satu syarat kelulusan yang harus ditempuh
                            oleh mahasiswa, salah satunya pada Departemen Teknik Komputer Universitas Diponegoro (Undip).
                            Tujuan KP adalah memperkenalkan mahasiswa pada situasi di dunia kerja yang sesungguhnya</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Page Heading -->
@endsection
