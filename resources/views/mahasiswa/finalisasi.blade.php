@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper">
        <div class="container">
            <div class="py-3">
                <form action="{{ route('finalisasi.store') }}" method="post">
                    <div class="row">
                        <h2 class="py-3"><b>Halaman Finalisasi Berkas Penilaian KP</b></h2>

                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="laporan">Laporan Final</label>
                                <input class="form-control" type="text" name="laporan" value="{{ isset($data['laporan']) ? $data['laporan'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for=makalah>Makalah final</label>
                                <input class="form-control" type="text" name=makalah value="{{ isset($data['makalah']) ? $data['makalah'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="kehadiran">Form Bukti Kehadiran</label>
                                <input class="form-control" type="text" name="kehadiran" value="{{ isset($data['kehadiran']) ? $data['kehadiran'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="a2">Form KP A-2</label>
                                <input class="form-control" type="text" name="a2" value="{{ isset($data['a2']) ? $data['a2'] : '' }}">
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="b2">Form KP B-2</label>
                                <input class="form-control" type="text" name="b2" value="{{ isset($data['b2']) ? $data['b2'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="b3">Form KP B-3</label>
                                <input class="form-control" type="text" name="b3" value="{{ isset($data['b3']) ? $data['b3'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="b4">Form KP B-4</label>
                                <input class="form-control" type="text" name="b4" value="{{ isset($data['b4']) ? $data['b4'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="b5">Form KP B-5</label>
                                <input class="form-control" type="text" name="b5" value="{{ isset($data['b5']) ? $data['b5'] : '' }}">
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
