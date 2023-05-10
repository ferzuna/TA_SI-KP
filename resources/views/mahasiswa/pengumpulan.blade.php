@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper">
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
                            </div>
                            @if (isset($data->status))
                                <div class="form-group">
                                    <label for="jadwal-seminar"><b>Status</b></label>
                                    <select class="form-select input-border" name="ruangan" id=""
                                        aria-label="Default select example">
                                        <option id="" value="Sudah Revisi">Sudah Revisi
                                        </option>
                                        <option id="" value="Revisi">Belum Revisi
                                        </option>
                                    </select>
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
