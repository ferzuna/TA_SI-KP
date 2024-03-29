@extends('koordinator.layouts.main')

@section('section')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col" style="width: 505px;">
                            <h1 class="h3 mb-2 text-gray-800"><b>Halaman Progress KP</b></h1>
                        </div>
                    </div>
                    <ul id="tabs" class="nav nav-tabs nav-fill">
                        <li class="nav-item"><a href="#belumdimulai" data-target="#belumdimulai" data-toggle="tab"
                                class="nav-link active">Belum Seminar KP</a></li>
                        <li class="nav-item"><a href="#belumdinilai" data-target="#belumdinilai" data-toggle="tab"
                                class="nav-link ">Belum Dinilai Dosen</a></li>
                        <li class="nav-item"><a href="#sudahdinilai" data-target="#sudahdinilai" data-toggle="tab"
                                class="nav-link ">Sudah Dinilai Dosen</a></li>
                        <li class="nav-item"><a href="#selesaikp" data-target="#selesaikp" data-toggle="tab"
                                class="nav-link ">Sudah Berkas dan Seminar</a></li>
                    </ul>
                    <div id="tabsContent" class="tab-content border border-top-0 rounded">
                        <div id="belumdimulai" class="tab-pane fade active show">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">List Data</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>NIM</th>
                                                    <th>Dosen Pembimbing</th>
                                                    <th>Selesai KP</th>
                                                    <th>Detail Berkas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mhsbelum as $data)
                                                    <tr> 
                                                        <td><?= $data['name'] ?></td>
                                                        <td><?= $data['NIM'] ?></td>
                                                        <td><?= $data->mhspendaftaran->pendaftarandosen->name ?></td>
                                                        <td><?= $data->mhspermohonan->selesai ?></td>
                                                        <td><a href='/koordinator/penilaian/berkas-akhir/<?= $data->mhspenilaian->id ?>' target="_blank">Detail berkas</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>NIM</strong></td>
                                                    <td><strong>Dosen Pembimbing</strong></td>
                                                    <td><strong>Selesai KP</strong></td>
                                                    <td><strong>Detail Berkas</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="belumdinilai" class="tab-pane fade">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">List Data</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>NIM</th>
                                                    <th>Dosen Pembimbing</th>
                                                    <th>Selesai KP</th>
                                                    <th>Detail Berkas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($belumdinilai as $data)
                                                    <tr>
                                                        <td><?= $data['name'] ?></td>
                                                        <td><?= $data['NIM'] ?></td>
                                                        <td><?= $data->mhspendaftaran->pendaftarandosen->name ?></td>
                                                        <td><?= $data->mhspermohonan->selesai ?></td>
                                                        <td><a href='/koordinator/penilaian/berkas-akhir/<?= $data->mhspenilaian->id ?>' target="_blank">Detail berkas</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>NIM</strong></td>
                                                    <td><strong>Dosen Pembimbing</strong></td>
                                                    <td><strong>Selesai KP</strong></td>
                                                    <td><strong>Detail Berkas</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="sudahdinilai" class="tab-pane fade">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">List Data</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>NIM</th>
                                                    <th>Dosen Pembimbing</th>
                                                    <th>Selesai KP</th>
                                                    <th>Detail Berkas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sudahdinilai as $data)
                                                    <tr>
                                                        <td><?= $data['name'] ?></td>
                                                        <td><?= $data['NIM'] ?></td>
                                                        <td><?= $data->mhspendaftaran->pendaftarandosen->name ?></td>
                                                        <td><?= $data->mhspermohonan->selesai ?></td>
                                                        <td><a href='/koordinator/penilaian/berkas-akhir/<?= $data->mhspenilaian->id ?>' target="_blank">Detail berkas</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>NIM</strong></td>
                                                    <td><strong>Dosen Pembimbing</strong></td>
                                                    <td><strong>Selesai KP</strong></td>
                                                    <td><strong>Detail Berkas</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="selesaikp" class="tab-pane fade">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">List Data</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>NIM</th>
                                                    <th>Dosen Pembimbing</th>
                                                    <th>Selesai KP</th>
                                                    <th>Detail Berkas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($berkassudah as $data)
                                                    <tr>
                                                        <td><?= $data['name'] ?></td>
                                                        <td><?= $data['NIM'] ?></td>
                                                        <td><?= $data->mhspendaftaran->pendaftarandosen->name ?></td>
                                                        <td><?= $data->mhspermohonan->selesai ?></td>
                                                        <td><a href='/koordinator/penilaian/berkas-akhir/<?= $data->mhspenilaian->id ?>' target="_blank">Detail berkas</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>NIM</strong></td>
                                                    <td><strong>Dosen Pembimbing</strong></td>
                                                    <td><strong>Selesai KP</strong></td>
                                                    <td><strong>Detail Berkas</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
@endsection

