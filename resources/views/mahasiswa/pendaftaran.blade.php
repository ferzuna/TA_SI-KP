@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper">
        <div class="container">
            <div class="py-3">
                <form action="{{ route('pendaftaran.store') }}" method="POST">
                    <div class="row">
                        <h2>halaman pendaftaran kp</h2>
                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="a1">KP A1</label>
                                <input class="form-control" type="text" name="a1" value="{{ $pendaftaran['a1'] }}">
                            </div>
                            <div class="form-group">
                                <label for="diterima">Email/Surat Diterima KP</label>
                                <input class="form-control" type="text" name="bukti"
                                    value="{{ $pendaftaran['bukti'] }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="dosen">dosen pilihan :</label>
                                <select class="form-select input-border" name="dosbing" id=""
                                    aria-label="Default select example">

                                    @foreach ($alldosen as $dosen)
                                        <option id="" value="{{ $dosen['name'] }}">{{ $dosen['name'] }}
                                        </option>
                                    @endforeach
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
