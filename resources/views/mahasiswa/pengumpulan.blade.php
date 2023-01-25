@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper">
        <h2>halaman pengumpulan berkas bimbingan kp</h2>
        <form action="" method="post">
            @csrf
            <label for="laporan">Nama laporan</label>
            <input type="text" name="laporan">
            <label for=makalah>KP A1</label>
            <input type="text" name=makalah>
            <label for="a2">KP A2</label>
            <input type="text" name="a2">
            <label for="b1">KP B1</label>
            <input type="text" name="b1">
            <label for="b2">KP B2</label>
            <input type="text" name="b2">
            <label for="b3">KP B3</label>
            <input type="text" name="b3">
            <label for="survey-perusahaan">Form Survey Perusahaan</label>
            <input type="text" name="survey-perusahaan">
            <label for="jadwal-seminar">Jadwal Seminar</label>
            <input type="datetime-local" name="jadwal-seminar" id="">

            <button type="submit">submit</button>
        </form>
    </div>
@endsection
