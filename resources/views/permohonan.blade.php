@extends('layouts.main')

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
                                <label for="Nama">Nama</label>
                                <input class="form-control" type="text" name="Nama">
                            </div>
                            <div class="form-group">
                                <label for=nim>NIM</label>
                                <input class="form-control" type="text" name=nim>
                            </div>
                            <div class="form-group">
                                <label for="perusahaan">Nama Perusahaan</label>
                                <input class="form-control" type="text" name="perusahaan">
                            </div>
                            <div class="form-group">
                                <label for="proposal">Proposal Perusahaan</label>
                                <input class="form-control" type="text" name="proposal">
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="dokumen">Dokumen Rekomendasi</label>
                                <input class="form-control" type="text" name="dokumen">
                            </div>
                            <div class="form-group">
                                <label for="sks">Jumlah SKS Kumulatif</label>
                                <input class="form-control" type="text" name="sks">
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
