@extends('dosen.layouts.main')

@section('section')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col" style="width: 505px;">
                            <h1 class="h3 mb-2 text-gray-800"><b>Pendaftaran KP</b></h1>
                        </div>
                    </div>
                    <ul id="tabs" class="nav nav-tabs nav-fill">
                        <li class="nav-item"><a href="#home1" data-target="#home1" data-toggle="tab"
                                class="nav-link active">Belum disetujui</a></li>
                        <li class="nav-item"><a href="#profile1" data-target="#profile1" data-toggle="tab"
                                class="nav-link ">Sudah disetujui</a></li>
                    </ul>
                    <div id="tabsContent" class="tab-content border border-top-0 rounded">
                        <div id="home1" class="tab-pane fade active show">
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
                                                    <th>Semester</th>
                                                    <th>Nama Perusahaan</th>
                                                    <th>Topik KP</th>
        
                                                    <th>Email/Surat Diterima</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mymahasiswa as $data)
                                                    <tr>
                                                        <td><?= $data['name'] ?></td>
                                                        <td><?= $data['semester'] ?></td>
                                                        <td><?= $data['perusahaan'] ?></td>
                                                        <td style="max-width: 300px !important; overflow-x:scroll; white-space: nowrap;"><?= $data['topik_kp'] ?></td>
                                                        <td style="max-width: 300px !important; overflow-x:scroll; white-space: nowrap;"><a href="<?= $data['bukti'] ?>" target="_blank" rel="noopener noreferrer"><?= $data['bukti'] ?></a></td>
                                                        <td style="display:flex">
                                                            <div class="icon-wrap" data-target="tooltip" data-placement="top" title="Setujui">
                                                                <i class="fas fa-check-circle" style="padding-left: 9px;"
                                                                    type="button" data-toggle="modal"
                                                                    data-target="#approve<?= $data['id'] ?>"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{-- Approved --}}
                                                    <div class="modal fade" id="approve<?= $data['id'] ?>"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Setujui Data</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-md-6">
                                                                        <form method="POST"
                                                                            action="{{ route('dosen.setujuipendaftaran', $data['id']) }}">
                                                                            @csrf
                                                                            <h6>Apakah Anda Yakin?</h6>
                                                                            <input type="submit"
                                                                                class="btn btn-success" value="Ya"
                                                                                name="approve"></input>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Tidak</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>Semester</strong></td>
                                                    <td><strong>Nama Perusahaan</strong></td>
                                                    <td><strong>Topik KP</strong></td>
                                                    <td><strong>Email/Surat Diterima</strong></td>
                                                    <td><strong>Manage</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="profile1" class="tab-pane fade">
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
                                                    <th>Semester</th>
                                                    <th>Nama Perusahaan</th>
                                                    <th>Topik KP</th>
        
                                                    <th>Email/Surat Diterima</th>
                                                    {{-- <th>Manage</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mymahasiswa1 as $data)
                                                    <tr>
                                                        <td><?= $data['name'] ?></td>
                                                        <td><?= $data['semester'] ?></td>
                                                        <td><?= $data['perusahaan'] ?></td>
                                                        <td style="max-width: 300px !important; overflow-x:scroll; white-space: nowrap;"><?= $data['topik_kp'] ?></td>
                                                        <td style="max-width: 300px !important; overflow-x:scroll; white-space: nowrap;"><a href="<?= $data['bukti'] ?>" target="_blank" rel="noopener noreferrer"><?= $data['bukti'] ?></a></td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>Semester</strong></td>
                                                    <td><strong>Nama Perusahaan</strong></td>
                                                    <td><strong>KP-A1</strong></td>
                                                    <td><strong>Email/Surat Diterima</strong></td>
                                                    {{-- <td><strong>Manage</strong></td> --}}
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
