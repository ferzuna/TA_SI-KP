@extends('dosen.layouts.main')

@section('section')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col" style="width: 505px;">
                            <h1 class="h3 mb-2 text-gray-800"><b>List Bimbingan Laporan</b></h1>
                        </div>
                    </div>
                    <ul id="tabs" class="nav nav-tabs nav-fill">
                        <li class="nav-item"><a href="#belumdiperiksa" data-target="#belumdiperiksa" data-toggle="tab"
                                class="nav-link active">Belum Diperiksa</a></li>
                        <li class="nav-item"><a href="#revisi" data-target="#revisi" data-toggle="tab"
                                class="nav-link ">Revisi</a></li>
                        <li class="nav-item"><a href="#sudahdirevisi" data-target="#sudahdirevisi" data-toggle="tab"
                                class="nav-link ">Sudah Direvisi</a></li>
                        <li class="nav-item"><a href="#acc" data-target="#acc" data-toggle="tab"
                                class="nav-link ">ACC</a></li>
                    </ul>
                    <div id="tabsContent" class="tab-content tabs-border rounded">
                        <div id="belumdiperiksa" class="tab-pane fade active show">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Belum Diperiksa</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Laporan KP</th>
                                                    <th>Makalah KP</th>
                                                    <th>KP-B1</th>
                                                    <th>KP-B2</th>
                                                    <th>KP-B3</th>
                                                    <th>Survey</th>
                                                    <th>Status</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bimbingan as $data)
                                                    <tr>
                                                        <td><?= $data->bimbinganmhs->name ?></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['laporan'] ?>"><?= $data['laporan'] ?></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['makalah'] ?>"><?= $data['makalah'] ?></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['b1'] ?>"><?= $data['b1'] ?></a></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['b2'] ?>"><?= $data['b2'] ?></a></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['b3'] ?>"><?= $data['b3'] ?></a></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['survey'] ?>"><?= $data['survey'] ?></a></td>
                                                        <td>belum diperiksa</td>
                                                        <td><i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                                type="button" data-toggle="modal"
                                                                data-target="#edit<?= $data['id'] ?>"></i>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="edit<?= $data['id'] ?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Data Bimbingan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-md-6">
                                                                        <form method="POST"
                                                                            action="{{ route('dosen.editbimbingan',$data['id']) }}">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="nama">Nama</label>
                                                                                <input type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Nama" name="name"
                                                                                value="<?= $data->bimbinganmhs->name ?>" disabled/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="status">Status</label>
                                                                                <select type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Status" name="status">
                                                                                <option
                                                                                    <?= $data['status'] == 'revisi' ? 'selected' : '' ?>
                                                                                    value="revisi">revisi</option>
                                                                                <option
                                                                                    <?= $data['status'] == 'acc' ? 'selected' : '' ?>
                                                                                    value="acc">ACC</option>
                                                                                </select>
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
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>Laporan KP</strong></td>
                                                    <td><strong>Makalah KP</strong></td>
                                                    <td><strong>KP-B1</strong></td>
                                                    <td><strong>KP-B2</strong></td>
                                                    <td><strong>KP-B3</strong></td>
                                                    <td><strong>Survey</strong></td>
                                                    <td><strong>Status</strong></td>
                                                    <td><strong>Manage</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="revisi" class="tab-pane fade">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Revisi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Laporan KP</th>
                                                    <th>Makalah KP</th>
                                                    <th>KP-B1</th>
                                                    <th>KP-B2</th>
                                                    <th>KP-B3</th>
                                                    <th>Survey Perusahaan</th>
                                                    <th>Status</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bimbingan1 as $data)
                                                    <tr>
                                                        <td><?= $data->bimbinganmhs->name ?></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['laporan'] ?>"><?= $data['laporan'] ?></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['makalah'] ?>"><?= $data['makalah'] ?></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['b1'] ?>"><?= $data['b1'] ?></a></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['b2'] ?>"><?= $data['b2'] ?></a></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['b3'] ?>"><?= $data['b3'] ?></a></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['survey'] ?>"><?= $data['survey'] ?></a></td>
                                                        <td>{{ isset($data['status'])?$data['status']:'' }}</td>
                                                        <td><i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                                type="button" data-toggle="modal"
                                                                data-target="#edit<?= $data['id'] ?>"></i>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="edit<?= $data['id'] ?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Data Bimbingan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-md-6">
                                                                        <form method="POST"
                                                                            action="{{ route('dosen.editbimbingan',$data['id']) }}">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="nama">Nama</label>
                                                                                <input type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Nama" name="name"
                                                                                value="<?= $data->bimbinganmhs->name ?>" disabled/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="status">Status</label>
                                                                                <select type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Status" name="status">
                                                                                <option
                                                                                    <?= $data['status'] == 'revisi' ? 'selected' : '' ?>
                                                                                    value="revisi">revisi</option>
                                                                                <option
                                                                                    <?= $data['status'] == 'acc' ? 'selected' : '' ?>
                                                                                    value="acc">ACC</option>
                                                                                </select>
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
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>Laporan KP</strong></td>
                                                    <td><strong>Makalah KP</strong></td>
                                                    <td><strong>KP-B1</strong></td>
                                                    <td><strong>KP-B2</strong></td>
                                                    <td><strong>KP-B3</strong></td>
                                                    <td><strong>Survey Perusahaan</strong></td>
                                                    <td><strong>Status</strong></td>
                                                    <td><strong>Manage</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="sudahdirevisi" class="tab-pane fade">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Revisi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Laporan KP</th>
                                                    <th>Makalah KP</th>
                                                    <th>KP-B1</th>
                                                    <th>KP-B2</th>
                                                    <th>KP-B3</th>
                                                    <th>Survey Perusahaan</th>
                                                    <th>Status</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bimbingan3 as $data)
                                                    <tr>
                                                        <td><?= $data->bimbinganmhs->name ?></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['laporan'] ?>"><?= $data['laporan'] ?></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['makalah'] ?>"><?= $data['makalah'] ?></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['b1'] ?>"><?= $data['b1'] ?></a></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['b2'] ?>"><?= $data['b2'] ?></a></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['b3'] ?>"><?= $data['b3'] ?></a></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['survey'] ?>"><?= $data['survey'] ?></a></td>
                                                        <td>{{ isset($data['status'])?$data['status']:'' }}</td>
                                                        <td><i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                                type="button" data-toggle="modal"
                                                                data-target="#edit<?= $data['id'] ?>"></i>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="edit<?= $data['id'] ?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Data Bimbingan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-md-6">
                                                                        <form method="POST"
                                                                            action="{{ route('dosen.editbimbingan',$data['id']) }}">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="nama">Nama</label>
                                                                                <input type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Nama" name="name"
                                                                                value="<?= $data->bimbinganmhs->name ?>" disabled/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="status">Status</label>
                                                                                <select type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Status" name="status">
                                                                                <option
                                                                                    <?= $data['status'] == 'revisi' ? 'selected' : '' ?>
                                                                                    value="revisi">revisi</option>
                                                                                <option
                                                                                    <?= $data['status'] == 'acc' ? 'selected' : '' ?>
                                                                                    value="acc">ACC</option>
                                                                                </select>
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
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>Laporan KP</strong></td>
                                                    <td><strong>Makalah KP</strong></td>
                                                    <td><strong>KP-B1</strong></td>
                                                    <td><strong>KP-B2</strong></td>
                                                    <td><strong>KP-B3</strong></td>
                                                    <td><strong>Survey Perusahaan</strong></td>
                                                    <td><strong>Status</strong></td>
                                                    <td><strong>Manage</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="acc" class="tab-pane fade">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data ACC</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Laporan KP</th>
                                                    <th>Makalah KP</th>
                                                    <th>KP-B1</th>
                                                    <th>KP-B2</th>
                                                    <th>KP-B3</th>
                                                    <th>Survey Perusahaan</th>
                                                    <th>Status</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bimbingan2 as $data)
                                                    <tr>
                                                        <td><?= $data->bimbinganmhs->name ?></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['laporan'] ?>"><?= $data['laporan'] ?></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['makalah'] ?>"><?= $data['makalah'] ?></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['b1'] ?>"><?= $data['b1'] ?></a></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['b2'] ?>"><?= $data['b2'] ?></a></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['b3'] ?>"><?= $data['b3'] ?></a></td>
                                                        <td style="max-width: 120px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['survey'] ?>"><?= $data['survey'] ?></a></td>
                                                        <td>{{ isset($data['status'])?$data['status']:'' }}</td>
                                                        <td><i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                                type="button" data-toggle="modal"
                                                                data-target="#edit<?= $data['id'] ?>"></i>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="edit<?= $data['id'] ?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Santri</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-md-6">
                                                                        <form method="POST"
                                                                            action="{{ route('dosen.editbimbingan',$data['id']) }}">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="nama">Nama</label>
                                                                                <input type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Nama" name="name"
                                                                                value="<?= $data->bimbinganmhs->name ?>" disabled/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="status">Status</label>
                                                                                <select type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Status" name="status">
                                                                                <option
                                                                                    <?= $data['status'] == 'revisi' ? 'selected' : '' ?>
                                                                                    value="revisi">revisi</option>
                                                                                <option
                                                                                    <?= $data['status'] == 'acc' ? 'selected' : '' ?>
                                                                                    value="acc">ACC</option>
                                                                                </select>
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
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>Laporan KP</strong></td>
                                                    <td><strong>Makalah KP</strong></td>
                                                    <td><strong>KP-B1</strong></td>
                                                    <td><strong>KP-B2</strong></td>
                                                    <td><strong>KP-B3</strong></td>
                                                    <td><strong>Survey Perusahaan</strong></td>
                                                    <td><strong>Status</strong></td>
                                                    <td><strong>Manage</strong></td>
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
