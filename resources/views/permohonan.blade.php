@extends('layouts.main')

@section('section')
    <div class="wrapper">
        @if (session('status'))
            <div class="container justify-content-center alert-wrap">
                <div class="row">
                    <div class="col-lg-8 col-xl-8 col-md-10 mx-auto">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Pesan Terkirim! </strong> &nbsp; {{ session('status') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="container justify-content-center alert-wrap">
                <div class="row">
                    <div class="col-lg-8 col-xl-8 col-md-10 mx-auto">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Pesan Anda gagal Terkirim</strong> &nbsp; {{ session('error') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="container">
            <div class="py-3">
                <form action="{{ route('permohonan.sendPermohonan') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <h2 class="py-3"><b>Halaman pengumpulan berkas bimbingan kp</b></h2>

                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input class="form-control" type="text" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for=nim>NIM</label>
                                <input class="form-control" type="text" name="nim" required>
                            </div>
                            <div class="form-group">
                                <label for=email>email</label>
                                <input class="form-control" type="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="perusahaan">Nama Perusahaan</label>
                                <input class="form-control" type="text" name="perusahaan" required>
                            </div>
                            <div class="form-group">
                                <label for="proposal">Proposal Perusahaan</label>
                                <input class="form-control" type="text" name="proposal" required>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="dokumen">Dokumen Rekomendasi</label>
                                <input class="form-control" type="text" name="dokumen" required>
                            </div>
                            <div class="form-group">
                                <label for="sks">Jumlah SKS Kumulatif</label>
                                <input class="form-control" type="text" name="sks" required>
                            </div>
                        </div>
                        <div class="py-2">
                            <button type="submit" class="btn btn-light btn-outline-dark">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
