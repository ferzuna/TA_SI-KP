@extends('mahasiswa.layouts.main')

@section('section')
    <section class="welcome-mahasiswa">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="banner">
                        @if (Auth::user()->alamat === null || Auth::user()->alamat === null || Auth::user()->sks === null || Auth::user()->no_telp === null)    
                        <div class="alert alert-warn">Perhatian!! Harap Lengkapi data diri Anda <a href="{{ route('mahasiswa.pengaturan') }}">
                            <span>{{ __('disini') }}</span>
                        </a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="color: #181818">&times;</span>
                          </button>
                    </div>
                        @endif
                        
                        @if (isset($mhs->mhspermohonan->status))
                        @if ($mhs->mhspermohonan->status == 1)
                        <div class="alert alert-success">Permohonan KP Anda sudah diterima, download surat permohonan KP 
                            {{-- untuk Perusahaan <a href="{{ route('export-pdf') }}">disini</a>, untuk Fakultas  --}}
                            <a href="{{ route('permohonan-fakultas') }}">disini</a>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #181818">&times;</span>
                              </button>
                        </div>
                        @endif
                        @endif
                        

                        <div class="media-right">
                            selamat datang {{ isset($mhs['name']) ? $mhs['name'] : '' }}, di sistem informasi KP
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
                                <div class="card-content" >
                                    <div class="card-header" style="background-color: #012E67; color:white">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="d-flex justify-content-end">
                                                    <a href="{{ route('mahasiswa.pengaturan') }}">
                                                        <i class="fas fa-fw fa-cog" style="color:white"></i>
                                                        <span style="color: white">{{ __('Ubah Profil') }}</span>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 col-12 d-flex justify-content-center">
                                                    <div class="py-2">
                                                    @if (Auth::user()->image)
                                                    <figure class="img-profile font-weight-bold"
                                                style="background-image: url({{ asset('storage/' . Auth::user()->image) }});
                                                object-fit: fill;
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: center;
                                                width: 100px;
                                                height: 120px;
                                                overflow: hidden;
                                                opacity: 1;
                                                display: inline-flex;
                                                vertical-align: middle;">
                                            </figure>
                                                    @else
                                                    <img src="https://www.w3schools.com/howto/img_avatar.png"
                                                    style="max-width: 150px; width: 100%" alt="foto">
                                                    @endif
                                                        
                                                    </div>

                                                </div>
                                                <div class="col-md-8">
                                                    <div class="py-2">
                                                        <h4><b>Mahasiswa</b></h4>
                                                        <span>{{ isset($mhs['name']) ? $mhs['name'] : '' }}</span>
                                                        <br>
                                                        <span>Semester
                                                            {{ isset($mhs['semester']) ? $mhs['semester'] : '' }}</span>
                                                        <br>
                                                        <span>Nomor telepon:
                                                            {{ isset($mhs['no_telp']) ? $mhs['no_telp'] : '' }}</span>
                                                        <br>
                                                        <span>{{ isset($mhs['email']) ? $mhs['email'] : '' }}</span>
                                                    </div>



                                                </div>


                                            </div>
                                        </div>
                                        <div class="card-footer text-center" style="background-color: #012E67; color:white">
                                            <span>Departemen Teknik Komputer
                                            </span>
                                            <br>
                                            <span>Teknik Komputer S1</span>
                                            <br>
                                            @if (isset(Auth::user()->semester))    
                                            <span>Semester {{Auth::user()->semester}}</span>
                                            @endif
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
                                <b>Dosen Pembimbing :</b> {{ isset($dosbing['name']) ? $dosbing['name'] : 'Belum Ditentukan' }}
                                <br>
                                @if (isset($mhs->mhspendaftaran) && $mhs->mhspendaftaran->status == 1)
                                <span>
                                    <b style="color: green">Berkas KP A1 dapat didownload <a href="{{ route('kp-a1')}}">disini</a></b>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="banner">
                            <div class="media-left">

                            </div>
                            <div class="media-right">
                                <b>Pelaksanaan KP dilaksanakan di :</b>
                                {{ isset($mhs->mhspermohonan->perusahaan) ? $mhs->mhspermohonan->perusahaan : '' }}
                            </div>
                        </div>
                        <div class="banner">
                            <div class="media-left">

                            </div>
                            <div class="media-right">
                                <b>Pelaksanaan seminar KP :</b>
                                {{ isset($mhs->mhspenjadwalan->jadwal) ? Carbon\Carbon::parse($mhs->mhspenjadwalan->jadwal)->isoFormat('dddd, D MMMM Y | HH:mm')  : 'Belum Dijadwalkan' }}
                                <br>
                                @if (isset($mhs->mhspenjadwalan) && $mhs->mhspenjadwalan->status == 'acc jadwal')
                                <span>
                                    <b style="color: green">Berkas KP B1 dapat didownload  <a href="{{ route('kp-b1')}}">disini</a></b>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        @if (isset($mhs->mhspenilaian->nilai_laporan ) && isset($mhs->mhspenilaian->nilai_seminar))
                        <div class="banner">
                            <div class="media-left">

                            </div>
                            <div class="media-right">
                               
                                <span>
                                    <b style="color: green">Berkas KP B3 dapat didownload  <a href="{{ route('kp-b3')}}">disini</a></b>
                                </span>
                               
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Menu Mahasiswa --}}
        <div class="menu-mahasiswa">
            <div class="container-fluid">
                <h2 class="title text-center">
                    <strong style="border-bottom: 5px solid #012E67; padding: 10px;">Layanan</strong>
                </h2>
                <div class="wrap">
                    <div class="row my-2">
                        <div class="col-lg-6">
                            <div class="m-3">
                                <div class="menu-wrap">
                                        <a href="{{ route('permohonan') }}" class="link-dark">
                                            <div class="card-content">
                                                <h3 class="text-center"><b>Permohonan KP</b></h3>
                                                <p style="margin-top:2em; font-size:16px">Pengajuan proposal dan surat permohonan KP untuk di TTD
                                                    Kepala
                                                    Departemen lalu diberikan
                                                    kepaada perusahaan</p>
                                            </div>
                                        </a>
                                </div>
                            </div>
                        </div>
                        @if(isset($mhs->mhspermohonan) && $mhs->mhspermohonan->status == 1)

                        <div class="col-lg-6">
                            <div class="m-3">
                                <div class="menu-wrap">
                                        <a href="{{ route('pendaftaran') }}" class="link-dark">
                                            <div class="card-content">
                                                <h3 class="text-center"><b>Pendaftaran KP</b></h3>
                                                <p style="margin-top:2em; font-size:16px">Pengajuan pendaftaran KP serta pemilihan dosen pembimbing
                                                    KP setelah diterima di perusahaan</p>
                                            </div>
                                        </a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-6">
                            <div class="m-3">
                                <div class="menu-wrap" style="background-color: grey">
                                        <div>
                                            <div class="card-content">
                                                <h3 class="text-center"><b>Pendaftaran KP</b></h3>
                                                <p style="margin-top:2em; font-size:16px">Pengajuan pendaftaran KP serta pemilihan dosen pembimbing
                                                    KP setelah diterima di perusahaan</p>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if(isset($mhs->mhspendaftaran) && $mhs->mhspermohonan->status == 1 && $mhs->mhspendaftaran->status == 1)
                        <div class="col-lg-6">
                            <div class="m-3">
                                <div class="menu-wrap">
                                    <a href="{{ route('pengumpulan') }}" class="link-dark">
                                        <div class="card-content">
                                            <h3 class="text-center"><b>Bimbingan Laporan</b></h3>
                                            <p style="margin-top:2em; font-size:16px">Pengumpulan berkas yang berkaitan dengan magang yang perlu
                                                ditanda
                                                tangan diikumpulkan disini
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-6">
                            <div class="m-3">
                                <div class="menu-wrap" style="background-color: grey">
                                    <div>
                                        <div class="card-content">
                                            <h3 class="text-center"><b>Bimbingan Laporan</b></h3>
                                            <p style="margin-top:2em; font-size:16px">Pengumpulan berkas yang berkairan dengan magang yang peru
                                                ditanda
                                                tangan diikumpulkan disini
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($mhs->mhsbimbingan) && $mhs->mhsbimbingan->status == 'acc' && $mhs->mhspermohonan->status == 1 && $mhs->mhspendaftaran->status == 1)
                        <div class="col-lg-6">
                            <div class="m-3">
                                <div class="menu-wrap">
                                    <a href="{{ route('penjadwalan') }}" class="link-dark">
                                        <div class="card-content">
                                            <h3 class="text-center"><b>Penjadwalan Seminar</b></h3>
                                            <p style="margin-top:2em; font-size:16px">Penjadwalan seminar yang dilakukan untuk menentukan waktu dan tempat dapat dilakukan disini.
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-6">
                            <div class="m-3">
                                <div class="menu-wrap" style="background-color: grey">
                                    <div>
                                        <div class="card-content">
                                            <h3 class="text-center"><b>Penjadwalan Seminar</b></h3>
                                            <p style="margin-top:2em; font-size:16px">Penjadwalan seminar yang dilakukan untuk menentukan waktu dan tempat dapat dilakukan disini.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($mhs->mhsbimbingan) && $mhs->mhsbimbingan->status == 'acc' && $mhs->mhspermohonan->status == 1 && $mhs->mhspendaftaran->status == 1)
                        <div class="col-lg-6">
                            <div class="m-3">
                                <div class="menu-wrap">
                                    <a href="{{ route('finalisasi') }}" class="link-dark">
                                        <div class="card-content">
                                            <h3 class="text-center"><b>Finalisasi Berkas</b></h3>
                                            <p style="margin-top:2em; font-size:16px">Pengumpulan semua berkas yang perlu ditanda tangan dosen
                                                dan
                                                juga
                                                pengumpulan lainnya
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-6">
                            <div class="m-3">
                                <div class="menu-wrap" style="background-color: grey">
                                    <div>
                                        <div class="card-content">
                                            <h3 class="text-center"><b>Finalisasi Berkas</b></h3>
                                            <p style="margin-top:2em; font-size:16px">Pengumpulan semua berkas yang perlu ditanda tangan dosen
                                                dan
                                                juga
                                                pengumpulan lainnya
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    
@endsection