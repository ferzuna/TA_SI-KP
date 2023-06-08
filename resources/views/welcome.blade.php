@extends('layouts.main')

@section('section')
    <section class="welcome">
        <div class="welcome-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="title-desc">
                            <h1 class="welcome-title">Sistem Informasi Kerja Praktik Teknik Komputer</h1>
                            <p class="welcome-desc">
                                Sistem Informasi KP ini merupakan aplikasi yang dibuat untuk
                                membantu Mahasiswa, Dosen, dan juga Tenaga Pendidik
                                dalam melaksanakan segala kegiatan yang berkaitan dengan mata kuliah Kerja praktik
                            </p>
                            <div class="container">
                                <div class="row">
                                    <div class="py-3">
                                        <a href="{{ route('login') }}">
                                            <div class="d-lg-none d-lg-block col-lg-5">
                                                <button class="button-home" style="background-color:#0B87BA; color:white">Login</button>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="py-3">
                                        <a href="{{ route('info-magang') }}">
                                            <div class="col-lg-5">
                                                <button class="button-home">Info Magang</button>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-md-none d-none d-lg-block">
                            <div class="title-logo">
                                <img class="welcome-logo" src="{{ asset('img/logoUndip.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
