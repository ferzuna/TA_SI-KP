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
                                <label for="judul"><b>Judul Laporan KP</b></label>
                                <input class="form-control" type="text" name="judul"
                                    value="{{ isset($mhs->mhsbimbingan->judul) ? $mhs->mhsbimbingan->judul : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="laporan"><b>Laporan</b></label>
                                <input id="laporan-input" class="form-control" type="text" name="laporan"
                                    value="{{ isset($mhs->mhsbimbingan->laporan) ? $mhs->mhsbimbingan->laporan : '' }}" required>
                                    <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="makalah"><b>Makalah</b></label>
                                <input id="makalah-input" class="form-control" type="text" name="makalah"
                                    value="{{ isset($mhs->mhsbimbingan->makalah) ? $mhs->mhsbimbingan->makalah : '' }}" required>
                                    <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            @if (isset($mhs->mhsbimbingan->status))
                            <div class="form-group">
                                <label for="status"><b>Status</b></label>
                                @if($mhs->mhsbimbingan->status=='acc')
                                <select class="form-select input-border" name="status" id="" aria-label="Default select example" hidden>
                                    <option <?= $mhs->mhsbimbingan->status == 'acc' ? 'selected' : '' ?> value="acc">ACC
                                    </option>
                                </select>
                                <select class="form-select input-border" name="status" id="" aria-label="Default select example" disabled>
                                    <option <?= $mhs->mhsbimbingan->status == 'acc' ? 'selected' : '' ?> value="acc">ACC
                                    </option>
                                </select>
                                @else
                                <select class="form-select input-border" name="status" id=""
                                    aria-label="Default select example">
                                    <option <?= $mhs->mhsbimbingan->status == 'revisi' ? 'selected' : '' ?> id="" value="revisi">Belum diRevisi
                                    </option>
                                    <option <?= $mhs->mhsbimbingan->status == 'sudah direvisi' ? 'selected' : '' ?> value="sudah direvisi">Sudah Direvisi
                                    </option>
                                </select>
                                @endif
                                
                            </div>
                            @endif
                            
                        </div>
                        <div class="col-lg-4 col-md-6">
                            @if (isset($mhs->mhsbimbingan->catatan))
                            <div class="form-group">
                                <label for="makalah"><b>Catatan</b></label>
                                <div class="form-control h-100">
                                    {!!nl2br($mhs->mhsbimbingan->catatan)!!}
                                </div>
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            @endif
                            
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

@section('script')
    <script>
    const inputs = document.querySelectorAll('#laporan-input, #makalah-input, #kehadiran-input, #b1-input, #b2-input, #b3-input');
    const linkRegex = /^(http(s)?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- ;,./?%&=]*)?$/;

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            const isValidLink = linkRegex.test(input.value);
            input.setCustomValidity(isValidLink ? '' : 'Please enter a valid link (e.g., https://drive.google.com)');
        });
    });
    </script>
@endsection