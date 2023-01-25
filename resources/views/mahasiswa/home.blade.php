@extends('mahasiswa.layouts.main')

@section('section')
    <section class="welcome-mahasiswa">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="banner">
                        <div class="media-left">

                        </div>
                        <div class="media-right">
                            selamat datang Fadzil, di sistem informasi KP
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="biodata-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="biodata-card">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-header">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="d-flex justify-content-end">
                                                    <a href="{{ route('mahasiswa.pengaturan') }}">
                                                        <i class="fas fa-fw fa-cog"></i>
                                                        <span>{{ __('Ubah Profil') }}</span>
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="py-2">
                                                        <img src="https://www.w3schools.com/howto/img_avatar.png"
                                                            style="max-width: 150px; width: 100%" alt="foto">
                                                    </div>

                                                </div>
                                                <div class="col-md-8">
                                                    <div class="py-2">
                                                        <h4><b>Mahasiswa</b></h4>
                                                        <span>Fadzil Ferdiawan</span>
                                                        <br>
                                                        <span>Angkatan 2019</span>
                                                        <br>
                                                        <span>0812939491929</span>
                                                        <br>
                                                        <span>fadzilferdiawan@students.undip.ac.id</span>
                                                    </div>



                                                </div>


                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <span>Departemen Teknik Komputer
                                            </span>
                                            <br>
                                            <span>Teknik Komputer S1</span>
                                            <br>
                                            <span>Semester 8</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="banner">
                            <div class="media-left">

                            </div>
                            <div class="media-right">
                                Mahasiswa mencari tempat/lokasi Kerja Praktek, setelah diterima Mahasiswa mengajukan Surat
                                Permohonan Kerja Praktek dan proposal
                                pengajuan pelaksanaan Kerja Praktek ke Dosen Pembimbing
                            </div>
                        </div>
                        <div class="banner">
                            <div class="media-left">

                            </div>
                            <div class="media-right">
                                Mahasiswa mencari tempat/lokasi Kerja Praktek, setelah diterima Mahasiswa mengajukan Surat
                                Permohonan Kerja Praktek dan proposal
                                pengajuan pelaksanaan Kerja Praktek ke Dosen Pembimbing
                            </div>
                        </div>
                        <div class="banner">
                            <div class="media-left">

                            </div>
                            <div class="media-right">
                                Mahasiswa mencari tempat/lokasi Kerja Praktek, setelah diterima Mahasiswa mengajukan Surat
                                Permohonan Kerja Praktek dan proposal
                                pengajuan pelaksanaan Kerja Praktek ke Dosen Pembimbing
                            </div>
                        </div>
                        <div class="banner">
                            <div class="media-left">

                            </div>
                            <div class="media-right">
                                Mahasiswa mencari tempat/lokasi Kerja Praktek, setelah diterima Mahasiswa mengajukan Surat
                                Permohonan Kerja Praktek dan proposal
                                pengajuan pelaksanaan Kerja Praktek ke Dosen Pembimbing
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Menu Mahasiswa --}}
        <div class="menu-mahasiswa">
            <div class="container-fluid">
                <h2 class="title text-center">
                    Layanan
                </h2>
                <div class="wrap">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card h-100">
                                <div class="card-content">
                                    <h4 class="text-center">Pendaftaran KP</h4>
                                    <p style="margin-top:2em">Pengajuan proposal dan surat permohonan KP untuk di TTD
                                        Kepala
                                        Departemen lalu diberikan
                                        kepaada perusahaan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card h-100">
                                <div class="card-content">
                                    <h4 class="text-center">Pengumpulan Berkas</h4>
                                    <p style="margin-top:2em">Pengumpulan berkas yang berkairan dengan magang yang peru
                                        ditanda
                                        tangan diikumpulkan disini
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card h-100">
                                <div class="card-content">
                                    <h4 class="text-center">Finalisasi Berkas</h4>
                                    <p style="margin-top:2em">Pengumpulan semua berkas yang perlu ditanda tangan dosen
                                        dan
                                        juga
                                        pengumpulan lainnya
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
