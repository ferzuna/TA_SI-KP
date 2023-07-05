@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper" style="height:90vh">
        {{-- @dd($mhs) --}}
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
                <form action="{{ route('pendaftaran.store') }}" method="POST">
                    <div class="row">
                        <h2 style="margin-bottom:2em"><b>Halaman Pendaftaran KP</b></h2>
                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="topik_kp"><b>Topik Kerja Praktik</b></label>
                                <input class="form-control" type="text" name="topik_kp"
                                    value="{{ isset($pendaftaran['topik_kp']) ? $pendaftaran['topik_kp'] : '' }}" required>
                                <div class="form-text">Contoh: Perangkat Lunak, Jaringan, dan lain-lain</div>
                            </div>
                            <div class="form-group">
                                <label for="diterima"><b>Email/Surat Diterima KP</b></label>
                                <input id="bukti-input" class="form-control" type="text" name="bukti"
                                    value="{{ isset($pendaftaran['bukti']) ? $pendaftaran['bukti'] : '' }}" required>
                                <div class="form-text">Input link Folder Google Drive dokumen terkait</div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="dosen"><b>Dosen Pilihan :</b></label>
                                @if (isset($mhs->mhspendaftaran->status) && $mhs->mhspendaftaran->status == 1)
                                <select class="form-select input-border" name="dosbing" id="" aria-label="Default select example" hidden>
                                    <option id="" value="{{ isset($dp['NIP']) ? $dp['NIP'] : '' }}">{{ isset($dp['name']) ? $dp['name'] : '' }}</option>
                                </select>
                                <select class="form-select input-border" name="dosbing" id="" aria-label="Default select example" disabled>
                                    <option id="" value="{{ isset($dp['NIP']) ? $dp['NIP'] : '' }}">{{ isset($dp['name']) ? $dp['name'] : '' }}</option>
                                </select>
                                @else
                                <select class="form-select input-border" name="dosbing" id=""
                                    aria-label="Default select example" required>
                                        <option id="" value="{{ isset($dp['NIP']) ? $dp['NIP'] : '' }}">{{ isset($dp['name']) ? $dp['name'] : '' }}</option>
                                    @foreach ($alldosen as $dosen)
                                        <option id="" value="{{ $dosen['NIP'] }}">{{ $dosen['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @endif
                                
                                
                                
                                <div class="form-text">Dosen yang tertera merupakan dosen yang tersedia</div>
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
    const inputs = document.querySelectorAll('#bukti-input');
    const linkRegex = /^(http(s)?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- ;,./?%&=]*)?$/;

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            const isValidLink = linkRegex.test(input.value);
            input.setCustomValidity(isValidLink ? '' : 'Please enter a valid link (e.g., http://drive.google.com)');
        });
    });
    </script>
@endsection