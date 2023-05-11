@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper" style="height:90vh">
        <div class="container">
            <div class="py-3">
                <form action="{{ route('finalisasi.store') }}" method="post">
                    <div class="row">
                        <h2 class="py-3"><b>Halaman Finalisasi Berkas Penilaian KP</b></h2>

                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="laporan"><b>Laporan Final</b></label>
                                <input class="form-control" type="text" name="laporan" value="{{ isset($data['laporan']) ? $data['laporan'] : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for=makalah><b>Makalah final</b></label>
                                <input class="form-control" type="text" name=makalah value="{{ isset($data['makalah']) ? $data['makalah'] : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="a2"><b>Form KP A-2</b></label>
                                <input class="form-control" type="text" name="a2" value="{{ isset($data['a2']) ? $data['a2'] : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="b2"><b>Form KP B-2</b></label>
                                <input class="form-control" type="text" name="b2" value="{{ isset($data['b2']) ? $data['b2'] : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="b3"><b>Form KP B-3</b></label>
                                <input class="form-control" type="text" name="b3" value="{{ isset($data['b3']) ? $data['b3'] : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="b4"><b>Form KP B-4</b></label>
                                <input class="form-control" type="text" name="b4" value="{{ isset($data['b4']) ? $data['b4'] : '' }}">
                                <div class="form-text">Input link Google Drive dokumen terkait</div>
                            </div>
                            <div class="form-group">
                                <label for="b5"><b>Form KP B-5</b></label>
                                <input class="form-control" type="text" name="b5" value="{{ isset($data['b5']) ? $data['b5'] : '' }}">
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
