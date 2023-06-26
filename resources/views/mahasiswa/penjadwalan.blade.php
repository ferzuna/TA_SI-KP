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
                <form action="{{ route('penjadwalan.store') }}" method="post">
                    <div class="row">

                        <h2 style="margin-bottom:2em"><b>Halaman Penjadwalan Seminar KP</b></h2>
                        @csrf
                        
                        
                        <div class="col-lg-4 col-md-6">          
                            <div class="form-group">
                                <label for="jadwal-seminar"><b>Jadwal Seminar</b></label>
                                <input class="form-control" type="datetime-local" name="jadwal" id=""
                                    value="{{ isset($mhs->mhspenjadwalan->jadwal) ? $mhs->mhspenjadwalan->jadwal : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="jadwal-seminar"><b>Ruangan Seminar</b></label>
                                <input class="form-control" type="text" name="ruangan" id=""
                                    value="{{ isset($mhs->mhspenjadwalan->ruangan) ? $mhs->mhspenjadwalan->ruangan : '' }}">
                                    <div class="form-text">Input Ruangan yang ingin digunakan. Contoh: Ruangan A-201</div>
                            </div>                
                            
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="survey-perusahaan"><b>Form Survey Perusahaan</b></label>
                                <input id="survey-input" class="form-control" type="text" name="survey"
                                    value="{{ isset($mhs->mhspenjadwalan->survey) ? $mhs->mhspenjadwalan->survey : '' }}">
                                    <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="kehadiran"><b>Bukti Kehadiran 10 Seminar</b></label>
                                <input id="kehadiran-input" class="form-control" type="text" name="kehadiran" value="{{ isset($mhs->mhspenjadwalan->kehadiran) ? $mhs->mhspenjadwalan->kehadiran : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            @if (isset($mhs->mhspenjadwalan->status))
                            <div class="form-group">
                                <label for="status"><b>Status</b></label>
                                @if($mhs->mhspenjadwalan->status=='acc')
                                <select class="form-select input-border" name="status" id="" aria-label="Default select example" hidden>
                                    <option <?= $mhs->mhspenjadwalan->status == 'acc' ? 'selected' : '' ?> value="acc">ACC
                                    </option>
                                </select>
                                <select class="form-select input-border" name="status" id="" aria-label="Default select example" disabled>
                                    <option <?= $mhs->mhspenjadwalan->status == 'acc' ? 'selected' : '' ?> value="acc">ACC
                                    </option>
                                </select>
                                @else
                                <select class="form-select input-border" name="status" id=""
                                    aria-label="Default select example">
                                    <option <?= $mhs->mhspenjadwalan->status == 'revisi jadwal' ? 'selected' : '' ?> id="" value="revisi jadwal">Revisi Jadwal
                                    </option>
                                    <option <?= $mhs->mhspenjadwalan->status == 'sudah direvisi' ? 'selected' : '' ?> value="sudah direvisi">Jadwal sudah disesuaikan
                                    </option>
                                </select>
                                @endif
                                
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
    const inputs = document.querySelectorAll('#survey-input, #kehadiran-input, #b1-input, #b2-input, #b3-input');
    const linkRegex = /^(http(s)?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- ;,./?%&=]*)?$/;

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            const isValidLink = linkRegex.test(input.value);
            input.setCustomValidity(isValidLink ? '' : 'Please enter a valid link (e.g., https://drive.google.com)');
        });
    });
    </script>
@endsection