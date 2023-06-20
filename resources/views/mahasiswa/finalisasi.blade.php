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
                <form action="{{ route('finalisasi.store') }}" method="post">
                    <div class="row">
                        <h2 class="py-3"><b>Halaman Finalisasi Berkas Penilaian KP</b></h2>

                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="laporan"><b>Laporan KP Final</b></label>
                                <input id="laporan-input" class="form-control" type="text" name="laporan" value="{{ isset($mhs->mhsbimbingan->laporan) ? $mhs->mhsbimbingan->laporan : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for=makalah><b>Makalah KP final</b></label>
                                <input id="makalah-input" class="form-control" type="text" name=makalah value="{{ isset($mhs->mhsbimbingan->makalah) ? $mhs->mhsbimbingan->makalah : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="a2"><b>Form Presensi dan Nilai Lapangan (KP-A2)</b></label>
                                <input id="a2-input" class="form-control" type="text" name="a2" value="{{ isset($mhs->mhspenilaian->a2) ? $mhs->mhspenilaian->a2 : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="b2"><b>Form Presensi Seminar  (KP-B2)</b></label>
                                <input id="b2-input" class="form-control" type="text" name="b2" value="{{ isset($mhs->mhspenilaian->b2) ? $mhs->mhspenilaian->b2 : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="b3"><b>Form Nilai Seminar (KP-B3)</b></label>
                                <input id="b3-input" class="form-control" type="text" name="b3" value="{{ isset($mhs->mhspenilaian->b3) ? $mhs->mhspenilaian->b3 : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="b4"><b>Form Tugas Terlambat (KP-B4)</b></label>
                                <input id="b4-input" class="form-control" type="text" name="b4" value="{{ isset($mhs->mhspenilaian->b4) ? $mhs->mhspenilaian->b4 : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="b5"><b>Surat Izin Perkuliahan Saat KP (KP-B5)</b></label>
                                <input id="b5-input" class="form-control" type="text" name="b5" value="{{ isset($mhs->mhspenilaian->b5) ? $mhs->mhspenilaian->b5 : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
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

@section('script')
    <script>
    const inputs = document.querySelectorAll('#laporan-input, #makalah-input, #survey-input, #kehadiran-input, #b1-input, #b2-input, #b3-input');
    const linkRegex = /^(http(s)?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- ;,./?%&=]*)?$/;

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            const isValidLink = linkRegex.test(input.value);
            input.setCustomValidity(isValidLink ? '' : 'Please enter a valid link (e.g., https://drive.google.com)');
        });
    });
    </script>
@endsection
