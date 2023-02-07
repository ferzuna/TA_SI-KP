@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper">
        <div class="container">
            <div class="py-3">
                <form action="" method="post">
                    <div class="row">

                        <h2>halaman pengumpulan berkas bimbingan kp</h2>
                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="laporan">Laporan</label>
                                <input class="form-control" type="text" name="laporan">
                            </div>
                            <div class="form-group">
                                <label for="makalah">Makalah</label>
                                <input class="form-control" type="text" name="makalah">
                            </div>
                            <div class="form-group">
                                <label for=makalah>KP A1</label>
                                <input class="form-control" type="text" name=makalah>
                            </div>
                            <div class="form-group">
                                <label for="b1">KP B1</label>
                                <input class="form-control" type="text" name="b1">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">

                            <div class="form-group">
                                <label for="b2">KP B2</label>
                                <input class="form-control" type="text" name="b2">
                            </div>
                            <div class="form-group">
                                <label for="b3">KP B3</label>
                                <input class="form-control" type="text" name="b3">
                            </div>
                            <div class="form-group">
                                <label for="survey-perusahaan">Form Survey Perusahaan</label>
                                <input class="form-control" type="text" name="survey-perusahaan">
                            </div>
                            <div class="form-group">
                                <label for="jadwal-seminar">Jadwal Seminar</label>
                                <input class="form-control" type="datetime-local" name="jadwal-seminar" id="">
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