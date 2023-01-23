@extends('mahasiswa.layouts.main')

@section('section')
    <h1>tester</h1>
    <h2>halaman pendaftaran kp</h2>
    <form action="" method="post">
        <input type="text">
        <p>
            <label for="">dosen pilihan :</label>
            <select name="" id="">
                @foreach($alldosen as $dosen)
                    <option value="{{ $dosen['nama'] }}">{{ $dosen['nama'] }}</option>
                @endforeach
            </select>
        </p>
        <button type="submit">submit</button>
    </form>
@endsection