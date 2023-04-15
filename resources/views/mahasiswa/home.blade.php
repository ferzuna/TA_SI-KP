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
                        
                        @if ($permohonan->status === 1)
                        <div class="alert alert-success">Permohonan KP Anda sudah diterima, download surat permohonan KP Anda <a href="{{ route('export-pdf') }}">disini</a>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #181818">&times;</span>
                              </button>
                        </div>
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
                                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                            style="max-width: 150px; width: 100%" alt="foto">
                                                    </div>

                                                </div>
                                                <div class="col-md-8">
                                                    <div class="py-2">
                                                        <h4><b>Mahasiswa</b></h4>
                                                        <span>{{ isset($mhs['name']) ? $mhs['name'] : '' }}</span>
                                                        <br>
                                                        <span>Angkatan
                                                            {{ isset($mhs['angkatan']) ? $mhs['angkatan'] : '' }}</span>
                                                        <br>
                                                        <span>Nomor telepon:
                                                            {{ isset($mhs['no_telp']) ? $mhs['no_telp'] : '' }}</span>
                                                        <br>
                                                        <span>{{ isset($mhs['email']) ? $mhs['email'] : '' }}</span>
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
                                Pelaksanaan seminar kerja praktik akan dilaksanakan pada tanggal :
                                {{ isset($jadwal['jadwal']) ? $jadwal['jadwal'] : '' }}
                            </div>
                        </div>
                        <div class="banner">
                            <div class="media-left">

                            </div>
                            <div class="media-right">
                                Dosen Pembimbing : {{ isset($pendaftaran['dosbing']) ? $pendaftaran['dosbing'] : '' }}
                            </div>
                        </div>
                        <div class="banner">
                            <div class="media-left">

                            </div>
                            <div class="media-right">
                                Pelaksanaan Kerja Praktik dilaksanakan di :
                                {{ isset($pendaftaran['perusahaan']) ? $pendaftaran['perusahaan'] : '' }}
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
                    <div class="row my-2">
                        <div class="col-lg-6">
                            <div class="card h-100">
                                <a href="{{ route('permohonan') }}" class="link-dark">
                                    <div class="card-content">
                                        <h4 class="text-center">Permohonan KP</h4>
                                        <p style="margin-top:2em">Pengajuan proposal dan surat permohonan KP untuk di TTD
                                            Kepala
                                            Departemen lalu diberikan
                                            kepaada perusahaan</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card h-100">
                                <a href="{{ route('pendaftaran') }}" class="link-dark">
                                    <div class="card-content">
                                        <h4 class="text-center">Pendaftaran KP</h4>
                                        <p style="margin-top:2em">Pengajuan pendaftaran KP serta pemilihan dosen pembimbing
                                            KP setelah diterima di perusahaan</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card h-100">
                                <a href="{{ route('pengumpulan') }}" class="link-dark">
                                    <div class="card-content">
                                        <h4 class="text-center">Pengumpulan Berkas</h4>
                                        <p style="margin-top:2em">Pengumpulan berkas yang berkairan dengan magang yang peru
                                            ditanda
                                            tangan diikumpulkan disini
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card h-100">
                                <a href="{{ route('finalisasi') }}" class="link-dark">
                                    <div class="card-content">
                                        <h4 class="text-center">Finalisasi Berkas</h4>
                                        <p style="margin-top:2em">Pengumpulan semua berkas yang perlu ditanda tangan dosen
                                            dan
                                            juga
                                            pengumpulan lainnya
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    
@endsection