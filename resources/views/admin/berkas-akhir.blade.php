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
                                <div class="card-profile-image mt-4">
                                    <figure class="rounded-circle avatar avatar font-weight-bold"
                                        style="font-size: 60px; height: 180px; width: 180px;"
                                        data-initial="{{ Auth::user()->name[0] }}">
                                    </figure>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <h5 class="font-weight-bold">{{ Auth::user()->fullName }}</h5>
                                                <h5><b>Administrator</b></h5>
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
                                                        <div class="form-control">Fadzil Ferdiawan</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group focused">
                                                        <label class="form-control-label" for="nim">NIM</label>
                                                        <div class="form-control">21120119130056</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Perusahaan</label>
                                                                <div class="form-control" style="overflow-y:hidden; scroll; white-space: nowrap;"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Email/Surat Diterima KP</label>
                                                                <div class="form-control" style="overflow-y:hidden; scroll; white-space: nowrap;"><a href="linknya" target="_blank"></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Laporan</label>
                                                                <div class="form-control" style="overflow-y:hidden; scroll; white-space: nowrap;"><a href="linknya" target="_blank">https://drive.google.com/drive/folders/1_FUzscAGEuttbPg8C8jgauMwotnYx0IY</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Makalah</label>
                                                                <div class="form-control" style="overflow-y:hidden; scroll; white-space: nowrap;"><a href="linknya" target="_blank">https://drive.google.com/drive/folders/1_FUzscAGEuttbPg8C8jgauMwotnYx0IY</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form Permohonan KP (KP-A1)</label>
                                                                <div class="form-control" style="overflow-y:hidden; scroll; white-space: nowrap;"><a href="linknya" target="_blank">https://drive.google.com/drive/folders/1_FUzscAGEuttbPg8C8jgauMwotnYx0IY</a></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form Absensi dan Nilai Lapangan (KP-A2)</label>
                                                                <div class="form-control" style="overflow-y:hidden; scroll; white-space: nowrap;"><a href="linknya" target="_blank">https://drive.google.com/drive/folders/1_FUzscAGEuttbPg8C8jgauMwotnYx0IY</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form Permohonan Seminar KP (KP-B1)</label>
                                                                <div class="form-control" style="overflow-y:hidden; scroll; white-space: nowrap;"><a href="linknya" target="_blank">https://drive.google.com/drive/folders/1_FUzscAGEuttbPg8C8jgauMwotnYx0IY</a></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form Presensi Seminar (KP-B2)</label>
                                                                <div class="form-control" style="overflow-y:hidden; scroll; white-space: nowrap;"><a href="linknya" target="_blank">https://drive.google.com/drive/folders/1_FUzscAGEuttbPg8C8jgauMwotnYx0IY</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form Nilai Seminar (KP-B3)</label>
                                                                <div class="form-control" style="overflow-y:hidden; scroll; white-space: nowrap;"><a href="linknya" target="_blank">https://drive.google.com/drive/folders/1_FUzscAGEuttbPg8C8jgauMwotnYx0IY</a></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Form Tugas Terlambat (KP-B4)</label>
                                                                <div class="form-control" style="overflow-y:hidden; scroll; white-space: nowrap;"><a href="linknya" target="_blank">https://drive.google.com/drive/folders/1_FUzscAGEuttbPg8C8jgauMwotnYx0IY</a></div>
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