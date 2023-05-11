@extends('admin.layouts.main')

@section('section')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                {{-- Floating Modal --}}
                <div class="modal fade" id="addsantri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Info Magang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-6">
                                    <form method="POST" action="{{ route('addinfomagang') }}">
                                        @csrf
                                        <input type="text" class="border rounded-0 form-control"
                                            style="width: 440px;margin-bottom: 15px;" placeholder="Perusahaan" name="perusahaan" />
                                        <input type="text" class="border rounded-0 form-control"
                                            style="width: 440px;margin-bottom: 15px;" placeholder="Posisi" name="posisi" />
                                        <input type="text" class="border rounded-0 form-control"
                                            style="width: 440px;margin-bottom: 15px;" placeholder="Durasi"
                                            name="durasi" />
                                        <textarea style="margin-bottom: 15px;width: 440px;" placeholder="Requirement yang dibutuhkan" name="requirement" class="border rounded-0 form-control"></textarea>
                                        <input type="submit" class="btn btn-success" value="Save Changes"
                                            name="submit"></input>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col" style="width: 505px;">
                            <h1 class="h3 mb-2 text-gray-800"><b>Informasi Magang</b></h1>
                        </div>
                        <div class="col text-right"> <button
                                class="btn btn-outline-success btn-sm float-none float-sm-none add-another-btn"
                                type="button" style="margin-right: 2px; margin-bottom: 8px;" data-toggle="modal"
                                data-target="#addsantri">Tambah Data<i class="fas fa-plus-circle edit-icon"></i></button>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Data</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Perusahaan</th>
                                            <th>Posisi</th>
                                            <th>Durasi</th>
                                            <th>Requirement</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($infomagang as $data)
                                            <tr>
                                                <td><?= $data['perusahaan'] ?></td>
                                                <td><?= $data['posisi'] ?></td>
                                                <td><?= $data['durasi'] ?></td>
                                                <td><?= $data['requirement'] ?></td>
                                                <td style="display: flex">
                                                    <div style="margin-right:10px" class="icon-wrap" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                        type="button" data-toggle="modal"
                                                        data-target="#edit<?= $data['id'] ?>"></i>
                                                    </div>
                                                    <div style="margin-right:10px" class="icon-wrap" data-toggle="tooltip" data-placement="top" title="Hapus"> 
                                                        <i class="fas fa-trash" style="padding-left: 8px;"
                                                            type="button" data-toggle="modal"
                                                            data-target="#deletemas<?= $data['id'] ?>"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="edit<?= $data['id'] ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-6">
                                                                <form method="POST" action="{{ route('infomagang.update', $data['id']) }}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="perusahaan">Perusahaan</label>
                                                                        <input type="text"
                                                                            class="border rounded-0 form-control"
                                                                            style="width: 440px;margin-bottom: 15px;"
                                                                            placeholder="Perusahaan" name="perusahaan"
                                                                            value="<?= $data['perusahaan'] ?>" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="posisi">Posisi</label>
                                                                        <input type="text"
                                                                            class="border rounded-0 form-control"
                                                                            style="width: 440px;margin-bottom: 15px;"
                                                                            placeholder="Posisi" name="posisi"
                                                                            value="<?= $data['posisi'] ?>" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="Durasi">Durasi</label>
                                                                        <input type="text"
                                                                            class="border rounded-0 form-control"
                                                                            style="width: 440px;margin-bottom: 15px;"
                                                                            placeholder="Durasi" name="durasi"
                                                                            value="<?= $data['durasi'] ?>" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="requirement">Requirement</label>
                                                                    <textarea style="margin-bottom: 15px;width: 440px;" placeholder="Requirement yang dibutuhkan" name="requirement" class="border rounded-0 form-control"></textarea>
                                                                    </div>
                                                                    <input type="submit" class="btn btn-success"
                                                                        value="Save Changes" name="update"></input>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="deletemas<?= $data['id'] ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Delete magang</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-6">
                                                                <form method="POST"
                                                                    action="{{ route('infomagang.destroy',$data['id']) }}">
                                                                    @csrf
                                                                    <h6>Apakah Anda Yakin?</h6>
                                                                    <input type="submit" class="btn btn-success"
                                                                        value="Okay" name="delete"></input>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
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
                                            <td><strong>Perusahaan</strong></td>
                                            <td><strong>Posisi</strong></td>
                                            <td><strong>Durasi</strong></td>
                                            <td><strong>Requirement</strong></td>
                                            <td><strong>Manage</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
@endsection
