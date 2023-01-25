@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper">
        <h2>halaman pendaftaran kp</h2>
        <form action="" method="post">
            @csrf
            <label for="perusahaan">Nama Perusahaan</label>
            <input type="text" name="perusahaan">
            <label for="a1">KP A1</label>
            <input type="text" name="a1">
            <label for="diterima">Email/Surat Diterima KP</label>
            <input type="text" name="diterima">
            <label for="dosen">dosen pilihan :</label>
            <select name="" id="">
                @foreach ($alldosen as $dosen)
                    <option value="{{ $dosen['nama'] }}">{{ $dosen['nama'] }}</option>
                @endforeach
            </select>
            <button type="submit">submit</button>
        </form>
    </div>
@endsection
