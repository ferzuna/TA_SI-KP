@extends('admin.layouts.main')

@section('section')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">{{ __('Berkas Akhir') }}</h1>

                    @if (session('success'))
                        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger border-left-danger" role="alert">
                            <ul class="pl-4 my-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-4 order-lg-2">
                            <div class="card shadow mb-4">
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            @if ($mhs['image'])
                                                <div id="imagePreview"
                                                    style="background-image: url({{ asset('storage/' . $mhs['image']) }});">
                                                </div>
                                            @else()
                                                <div id="imagePreview" class="rounded-circle avatar avatar font-weight-bold"
                                                    style="background-image: url(''); font-size: 60px; height: 180px; width: 180px;"
                                                    data-initial="{{ $mhs['name'][0] }}">
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <h5 class="font-weight-bold">{{ $mhs['name'] }}</h5>
                                                    <p>Semester {{ $mhs['semester'] }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-8 order-lg-1">

                            <div class="card shadow mb-4">

                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Berkas Penilaian</h6>
                                </div>

                                <div class="card-body">

                                        <h6 class="heading-small text-muted mb-4">User information</h6>

                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group focused">
                                                        <label class="form-control-label" for="name">Nama</label>
                                                        <div class="form-control" style="overflow-y:hidden; white-space: nowrap;">{{ $mhs['name'] }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group focused">
                                                        <label class="form-control-label" for="nim">NIM</label>
                                                        <div class="form-control">{{ $mhs['NIM'] }}</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Perusahaan</label>
                                                                <div class="form-control" style="overflow-y:hidden; white-space: nowrap;">{{ $mhs['perusahaan'] }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Email/Surat Diterima KP</label>
                                                                <div class="form-control" style="overflow-y:hidden; white-space: nowrap;"><a href="{{$mhs['bukti']}}" target="_blank">{{$mhs['bukti']}}</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Laporan</label>
                                                                <div class="form-control" style="overflow-y:hidden; white-space: nowrap;"><a href="{{ $mhs['laporan'] }}" target="_blank">{{ $mhs['laporan'] }}</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Makalah</label>
                                                                <div class="form-control" style="overflow-y:hidden; white-space: nowrap;"><a href="{{ $mhs['makalah'] }}" target="_blank">{{ $mhs['makalah'] }}</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form Permohonan KP (KP-A1)</label>
                                                                <div class="form-control" style="overflow-y:hidden; white-space: nowrap;"><a href="{{ $mhs['a1'] }}" target="_blank">{{ $mhs['a1'] }}</a></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form Absensi dan Nilai Lapangan (KP-A2)</label>
                                                                <div class="form-control" style="overflow-y:hidden; white-space: nowrap;"><a href="{{ $mhs['a2'] }}" target="_blank">{{ $mhs['a2'] }}</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form Permohonan Seminar KP (KP-B1)</label>
                                                                <div class="form-control" style="overflow-y:hidden; white-space: nowrap;"><a href="{{ $mhs['b1'] }}" target="_blank">{{ $mhs['b1'] }}</a></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form Presensi Seminar (KP-B2)</label>
                                                                <div class="form-control" style="overflow-y:hidden; white-space: nowrap;"><a href="{{ $mhs['b2'] }}" target="_blank">{{ $mhs['b2'] }}</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form Nilai Seminar (KP-B3)</label>
                                                                <div class="form-control" style="overflow-y:hidden; white-space: nowrap;"><a href="{{ $mhs['b3'] }}" target="_blank">{{ $mhs['b3'] }}</a></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form Tugas Terlambat (KP-B4)</label>
                                                                <div class="form-control" style="overflow-y:hidden; white-space: nowrap;"><a href="{{ $mhs['b4'] }}" target="_blank">{{ $mhs['b4'] }}</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form List Absensi Kuliah (KP-B5)</label>
                                                                <div class="form-control" style="overflow-y:hidden; white-space: nowrap;"><a href="{{ $mhs['b5'] }}" target="_blank">{{ $mhs['b5'] }}</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection