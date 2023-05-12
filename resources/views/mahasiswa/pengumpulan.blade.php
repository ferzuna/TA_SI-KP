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
                <form action="{{ route('bimbingan.store') }}" method="post">
                    <div class="row">

                        <h2 style="margin-bottom:2em"><b>Halaman Pengumpulan Berkas Bimbingan KP</b></h2>
                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="laporan"><b>Laporan</b></label>
                                <input class="form-control" type="text" name="laporan"
                                    value="{{ isset($data['laporan']) ? $data['laporan'] : '' }}">
                                    <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="makalah"><b>Makalah</b></label>
                                <input class="form-control" type="text" name="makalah"
                                    value="{{ isset($data['makalah']) ? $data['makalah'] : '' }}">
                                    <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for=makalah><b>KP A1</b></label>
                                <input class="form-control" type="text" name=a1
                                    value="{{ isset($data['a1']) ? $data['a1'] : '' }}">
                                    <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="b1"><b>KP B1</b></label>
                                <input class="form-control" type="text" name="b1"
                                    value="{{ isset($data['b1']) ? $data['b1'] : '' }}">
                                    <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="kehadiran"><b>Bukti Kehadiran 10 Seminar</b></label>
                                <input class="form-control" type="text" name="kehadiran" value="{{ isset($data['kehadiran']) ? $data['kehadiran'] : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            @if (isset($data['status']))
                                <div class="form-group">
                                    <label for="status"><b>Status</b></label>
                                    @if($data['status']=='acc')
                                    <select class="form-select input-border" name="status" id="" aria-label="Default select example" disabled>
                                        <option <?= $data['status'] == 'acc' ? 'selected' : '' ?> value="acc">ACC
                                        </option>
                                    </select>
                                    @else
                                    <select class="form-select input-border" name="status" id=""
                                        aria-label="Default select example">
                                        <option <?= $data['status'] == 'revisi' ? 'selected' : '' ?> id="" value="revisi">Belum diRevisi
                                        </option>
                                        <option <?= $data['status'] == 'sudah direvisi' ? 'selected' : '' ?> value="sudah direvisi">Sudah Direvisi
                                        </option>
                                    </select>
                                    @endif
                                    
                                </div>
                                
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-6">

                            <div class="form-group">
                                <label for="b2"><b>KP B2</b></label>
                                <input class="form-control" type="text" name="b2"
                                    value="{{ isset($data['b2']) ? $data['b2'] : '' }}">
                                    <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="b3"><b>KP B3</b></label>
                                <input class="form-control" type="text" name="b3"
                                    value="{{ isset($data['b3']) ? $data['b3'] : '' }}">
                                    <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="survey-perusahaan"><b>Form Survey Perusahaan</b></label>
                                <input class="form-control" type="text" name="survey"
                                    value="{{ isset($data['survey']) ? $data['survey'] : '' }}">
                                    <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="jadwal-seminar"><b>Jadwal Seminar</b></label>
                                <input class="form-control" type="datetime-local" name="jadwal" id=""
                                    value="{{ isset($data['jadwal']) ? $data['jadwal'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="jadwal-seminar"><b>Ruangan Seminar</b></label>
                                <input class="form-control" type="text" name="ruangan" id=""
                                    value="{{ isset($data['ruangan']) ? $data['ruangan'] : '' }}">
                                    <div class="form-text">Input Ruangan yang ingin digunakan. Contoh: Ruangan A-201</div>
                            </div>
                        </div>





                        <div class="py-2">
                            <button type="submit" class="btn btn-light btn-outline-dark btn-submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
