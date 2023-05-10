@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper" style="height:90vh">
        <div class="container">
            <div class="py-3">
                <form action="{{ route('pendaftaran.store') }}" method="POST">
                    <div class="row">
                        <h2 style="margin-bottom:2em"><b>Halaman Pendaftaran KP</b></h2>
                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="a1"><b>KP A1</b></label>
                                <input class="form-control" type="text" name="a1"
                                    value="{{ isset($pendaftaran['a1']) ? $pendaftaran['a1'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="diterima"><b>Email/Surat Diterima KP</b></label>
                                <input class="form-control" type="text" name="bukti"
                                    value="{{ isset($pendaftaran['bukti']) ? $pendaftaran['bukti'] : '' }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="dosen"><b>Dosen Pilihan :</b></label>
                                <select class="form-select input-border" name="dosbing" id=""
                                    aria-label="Default select example">
                                        <option id="" value="{{ $dp }}">{{ $dp }}</option>
                                    @foreach ($alldosen as $dosen)
                                        <option id="" value="{{ $dosen['name'] }}">{{ $dosen['name'] }}
                                        </option>
                                    @endforeach
                                </select>
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
