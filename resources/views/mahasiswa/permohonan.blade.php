@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper">
        @if (session('status'))
            <div class="container justify-content-center alert-wrap">
                <div class="row">
                    <div class="col-lg-8 col-xl-8 col-md-10 mx-auto mt-5">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Pesan Terkirim! </strong> &nbsp; {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #181818">&times;</span>
                              </button>
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
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #181818">&times;</span>
                              </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="container">
            <div class="py-3">
                <form action="{{ route('permohonan.sendPermohonan') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <h2 class="py-3"><b>Halaman Permohonan Kerja Praktik</b></h2>

                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="perusahaan">Nama Perusahaan</label>
                                <input class="form-control" type="text" name="perusahaan"
                                    value="{{ isset($data['perusahaan']) ? $data['perusahaan'] : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="proposal">Proposal Perusahaan</label>
                                <input class="form-control" type="text" name="proposal"
                                    value="{{ isset($data['proposal']) ? $data['proposal'] : '' }}">
                                    <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="jadwal-seminar">Tanggal Mulai</label>
                                <input class="form-control" type="date" name="mulai" placeholder="dd-mm-yyyy" id=""
                                    value="{{ isset($data['mulai']) ? $data['mulai'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="jadwal-seminar">Tanggal Selesai</label>
                                <input class="form-control" type="date" name="selesai" id=""
                                    value="{{ isset($data['selesai']) ? $data['selesai'] : '' }}">
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
