@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper">
        <div class="container">
            <div class="py-3">
                <form action="{{ route('bimbingan.store') }}" method="post">
                    <div class="row">

                        <h2>halaman pengumpulan berkas bimbingan kp</h2>
                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="laporan">Laporan</label>
                                <input class="form-control" type="text" name="laporan"
                                    value="{{ isset($data['laporan']) ? $data['laporan'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="makalah">Makalah</label>
                                <input class="form-control" type="text" name="makalah"
                                    value="{{ isset($data['makalah']) ? $data['makalah'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for=makalah>KP A1</label>
                                <input class="form-control" type="text" name=a1
                                    value="{{ isset($data['a1']) ? $data['a1'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="b1">KP B1</label>
                                <input class="form-control" type="text" name="b1"
                                    value="{{ isset($data['b1']) ? $data['b1'] : '' }}">
                            </div>
                            @if (isset($data->status))
                                <div class="form-group">
                                    <label for="jadwal-seminar">Status</label>
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
                                <label for="b2">KP B2</label>
                                <input class="form-control" type="text" name="b2"
                                    value="{{ isset($data['b2']) ? $data['b2'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="b3">KP B3</label>
                                <input class="form-control" type="text" name="b3"
                                    value="{{ isset($data['b3']) ? $data['b3'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="survey-perusahaan">Form Survey Perusahaan</label>
                                <input class="form-control" type="text" name="survey"
                                    value="{{ isset($data['survey']) ? $data['survey'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="jadwal-seminar">Jadwal Seminar</label>
                                <input class="form-control" type="datetime-local" name="jadwal" id=""
                                    value="{{ isset($data['jadwal']) ? $data['jadwal'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="jadwal-seminar">Ruangan Seminar</label>
                                <select class="form-select input-border" name="ruangan" id=""
                                    aria-label="Default select example">

                                    <option id="" value="Ruangan E-201">Ruangan E-201
                                    </option>
                                    <option id="" value="Ruangan A-201">Ruangan A-201
                                    </option>
                                    <option id="" value="Lab. Jarkom">Lab. Jarkom
                                    </option>
                                </select>
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
