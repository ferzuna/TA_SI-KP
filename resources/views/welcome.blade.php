@extends('layouts.main')

@section('section')
    <section class="welcome">
        <div class="welcome-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="title-desc">
                            <h1 class="welcome-title"">Sistem Informasi Kerja Praktik Teknik Komputer</h1>
                            <p class="welcome-desc">
                                Sistem Informasi KP ini merupakan aplikasi yang dibuat untuk
                                membantu Mahasiswa, Dosen, dan juga Tenaga Pendidik
                                dalam melaksanakan segala kegiatan yang berkaitan dengan mata kuliah Kerja praktik
                            </p>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <button class="button-home">Info Magang</button>
                                    </div>
                                    <div class="col-lg-5">
                                        <button class="button-home">Selengkapnya</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="title-logo">
                            <img class="welcome-logo" src="{{ asset('img/logoUndip.svg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
