@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper">
        <div class="container">
            <div class="py-3">
                <form action="" method="post">
                    <div class="row">
                        <h2 class="py-3"><b>Halaman pengumpulan berkas bimbingan kp</b></h2>

                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="laporan">Laporan Final</label>
                                <input class="form-control" type="text" name="laporan">
                            </div>
                            <div class="form-group">
                                <label for=makalah>Makalah final</label>
                                <input class="form-control" type="text" name=makalah>
                            </div>
                            <div class="form-group">
                                <label for="kehadiran">Form Bukti Kehadiran</label>
                                <input class="form-control" type="text" name="kehadiran">
                            </div>
                            <div class="form-group">
                                <label for="a2">Form KP A-2</label>
                                <input class="form-control" type="text" name="a2">
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="b2">Form KP B-2</label>
                                <input class="form-control" type="text" name="b2">
                            </div>
                            <div class="form-group">
                                <label for="b3">Form KP B-3</label>
                                <input class="form-control" type="text" name="b3">
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
