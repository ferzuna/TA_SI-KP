@extends('koordinator.layouts.main')

@section('section')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">

                {{-- Floating Modal --}}
                {{-- <div class="modal fade" id="addsantri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-6">
                                    <form method="POST" action="">
                                        @csrf
                                        <input type="text" class="border rounded-0 form-control"
                                            style="width: 440px;margin-bottom: 15px;" placeholder="Nama" name="nama" />
                                        <select type="text" class="border rounded-0 form-control"
                                            style="width: 440px;margin-bottom: 15px;" placeholder="Gender" name="gender" />
                                        <option value="Laki - Laki" selected>Laki - Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                        </select>
                                        <input type="text" class="border rounded-0 form-control"
                                            style="width: 440px;margin-bottom: 15px;" placeholder="Alamat" name="alamat" />
                                        <input type="text" class="border rounded-0 form-control"
                                            style="width: 440px;margin-bottom: 15px;" placeholder="Perguruan Tinggi"
                                            name="pt" />
                                        <input type="text" class="border rounded-0 form-control" placeholder="Jurusan"
                                            style="margin-bottom: 15px;width: 440px;" name="jurusan" />
                                        <select type="text" class="border rounded-0 form-control"
                                            style="width: 440px;margin-bottom: 15px;" placeholder="Status" name="status" />
                                        <option value="Aktif" selected>Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                        </select>
                                        <input type="submit" class="btn btn-success" value="Save Changes"
                                            name="submit"></input>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="container-fluid">
                    <div class="row">
                        <div class="col" style="width: 505px;">
                            <h1 class="h3 mb-2 text-gray-800">Halaman Permohonan KP</h1>
                        </div>
                        {{-- <div class="col"> <button
                                class="btn btn-outline-success btn-sm float-none float-sm-none add-another-btn"
                                type="button" style="margin-right: 2px; margin-bottom: 8px;" data-toggle="modal"
                                data-target="#addsantri">Tambah Data<i class="fas fa-plus-circle edit-icon"></i></button>
                        </div> --}}
                    </div>
                    <div class="col-md-12">
                        <ul id="tabs" class="nav nav-tabs nav-fill">
                            <li class="nav-item"><a href="#home1" data-target="#home1" data-toggle="tab"
                                    class="nav-link active">Belum disetujui</a></li>
                            <li class="nav-item"><a href="#profile1" data-target="#profile1" data-toggle="tab"
                                    class="nav-link ">Sudah disetujui</a></li>
                        </ul>
                        <div id="tabsContent" class="tab-content p-5 border border-top-0 rounded">
                            <div id="home1" class="tab-pane fade active show">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Data belum disetujui</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered data" id="dataTable" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>NIM</th>
                                                        <th>Perusahaan</th>
                                                        <th>Proposal</th>
                                                        <th>SKSk</th>
                                                        <th>Status</th>
                                                        <th>Manage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($mymahasiswa as $data)
                                                        <tr>
                                                            <td><?= $data['name'] ?></td>
                                                            <td><?= $data['NIM'] ?></td>
                                                            <td><?= $data['perusahaan'] ?></td>
                                                            <td style="max-width: 300px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['proposal'] ?>"><?= $data['proposal'] ?></a></td>
                                                            <td><?= $data['sks'] ?></td>
                                                            <td>{{ $data['status'] ? 'disetujui' : 'belum disetujui' }}</td>
                                                            <td><i class="fas fa-check-circle" style="padding-left: 9px;"
                                                                    type="button" data-toggle="modal"
                                                                    data-target="#approve<?= $data['id'] ?>"></i>
                                                                <i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                                    type="button" data-toggle="modal"
                                                                    data-target="#edit<?= $data['id'] ?>"></i>
                                                                <i class="material-icons icondelete"
                                                                    style="padding-left: 8px;" type="button"
                                                                    data-toggle="modal"
                                                                    data-target="#deletemas<?= $data['id'] ?>">delete</i>
                                                            </td>
                                                        </tr>
                                                        <div class="modal fade" id="edit<?= $data['id'] ?>" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Santri</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-md-6">
                                                                            <form method="POST" action="">
                                                                                @csrf
                                                                                <input type="text"
                                                                                    class="border rounded-0 form-control"
                                                                                    style="width: 440px;margin-bottom: 15px;"
                                                                                    placeholder="Nama" name="nama"
                                                                                    value="<?= $data['nama'] ?>" />
                                                                                <select type="text"
                                                                                    class="border rounded-0 form-control"
                                                                                    style="width: 440px;margin-bottom: 15px;"
                                                                                    placeholder="Gender" name="gender" />
                                                                                <option
                                                                                    <?= $data['gender'] == 'Laki - Laki' ? 'selected' : '' ?>
                                                                                    value="Laki - Laki">Laki - Laki
                                                                                </option>
                                                                                <option
                                                                                    <?= $data['gender'] == 'Perempuan' ? 'selected' : '' ?>
                                                                                    value="Perempuan">Perempuan</option>
                                                                                </select>
                                                                                <input type="text"
                                                                                    class="border rounded-0 form-control"
                                                                                    style="width: 440px;margin-bottom: 15px;"
                                                                                    placeholder="Alamat" name="alamat"
                                                                                    value="<?= $data['alamat'] ?>" />
                                                                                <input type="text"
                                                                                    class="border rounded-0 form-control"
                                                                                    style="width: 440px;margin-bottom: 15px;"
                                                                                    placeholder="Perguruan Tinggi"
                                                                                    name="pt"
                                                                                    value="<?= $data['pt'] ?>" />
                                                                                <input type="text"
                                                                                    class="border rounded-0 form-control"
                                                                                    placeholder="Jurusan"
                                                                                    style="margin-bottom: 15px;width: 440px;"
                                                                                    name="jurusan"
                                                                                    value="<?= $data['jurusan'] ?>" />
                                                                                <select type="text"
                                                                                    class="border rounded-0 form-control"
                                                                                    style="width: 440px;margin-bottom: 15px;"
                                                                                    placeholder="Status" name="status" />
                                                                                <option
                                                                                    <?= $data['status'] == 'Aktif' ? 'selected' : '' ?>
                                                                                    value="Aktif">Aktif</option>
                                                                                <option
                                                                                    <?= $data['status'] == 'Tidak Aktif' ? 'selected' : '' ?>
                                                                                    value="Tidak Aktif">Tidak Aktif
                                                                                </option>
                                                                                </select>
                                                                                <input type="submit"
                                                                                    class="btn btn-success"
                                                                                    value="Save Changes"
                                                                                    name="update"></input>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="deletemas<?= $data['id'] ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Delete Data</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-md-6">
                                                                            <form method="POST"
                                                                                action="{{-- route('santri.destroy',$data['id']) --}}">
                                                                                @csrf
                                                                                <h6>Apakah Anda Yakin?</h6>
                                                                                <input type="submit"
                                                                                    class="btn btn-success" value="Okay"
                                                                                    name="delete"></input>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- approved -->
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
                                                                                action="{{ route('koordinator.approved', $data['id']) }}">
                                                                                @csrf
                                                                                <h6>Apakah Anda Yakin?</h6>
                                                                                <input type="submit"
                                                                                    class="btn btn-success" value="Okay"
                                                                                    name="approve"></input>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
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
                                                        <td><strong>NIM</strong></td>
                                                        <td><strong>Perusahaan</strong></td>
                                                        <td><strong>Proposal</strong></td>
                                                        <td><strong>SKSk</strong></td>
                                                        <td><strong>Status</strong></td>
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
                                        <h6 class="m-0 font-weight-bold text-primary">Data sudah disetujui</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered data" id="dataTable" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>NIM</th>
                                                        <th>Perusahaan</th>
                                                        <th>Proposal</th>
                                                        <th>SKSk</th>
                                                        <th>Status</th>
                                                        <th>Manage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($mymahasiswa1 as $data)
                                                        <tr>
                                                            <td><?= $data['name'] ?></td>
                                                            <td><?= $data['NIM'] ?></td>
                                                            <td><?= $data['perusahaan'] ?></td>
                                                            <td style="max-width: 300px !important; overflow-x:scroll; white-space: nowrap;"><a target="_blank" href="<?= $data['proposal'] ?>"><?= $data['proposal'] ?></a></td>
                                                            <td><?= $data['sks'] ?></td>
                                                            <td>{{ $data['status'] ? 'telah disetujui' : 'belum disetujui' }}</td>
                                                            <td><i class="fas fa-check-circle" style="padding-left: 9px;"
                                                                    type="button" data-toggle="modal"
                                                                    data-target="#approve<?= $data['id'] ?>"></i>
                                                                <i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                                    type="button" data-toggle="modal"
                                                                    data-target="#edit<?= $data['id'] ?>"></i>
                                                                <i class="material-icons icondelete"
                                                                    style="padding-left: 8px;" type="button"
                                                                    data-toggle="modal"
                                                                    data-target="#deletemas<?= $data['id'] ?>">delete</i>
                                                            </td>
                                                        </tr>
                                                        <div class="modal fade" id="edit<?= $data['id'] ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Santri</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-md-6">
                                                                            <form method="POST" action="">
                                                                                @csrf
                                                                                <input type="text"
                                                                                    class="border rounded-0 form-control"
                                                                                    style="width: 440px;margin-bottom: 15px;"
                                                                                    placeholder="Nama" name="nama"
                                                                                    value="<?= $data['nama'] ?>" />
                                                                                <select type="text"
                                                                                    class="border rounded-0 form-control"
                                                                                    style="width: 440px;margin-bottom: 15px;"
                                                                                    placeholder="Gender" name="gender" />
                                                                                <option
                                                                                    <?= $data['gender'] == 'Laki - Laki' ? 'selected' : '' ?>
                                                                                    value="Laki - Laki">Laki - Laki
                                                                                </option>
                                                                                <option
                                                                                    <?= $data['gender'] == 'Perempuan' ? 'selected' : '' ?>
                                                                                    value="Perempuan">Perempuan</option>
                                                                                </select>
                                                                                <input type="text"
                                                                                    class="border rounded-0 form-control"
                                                                                    style="width: 440px;margin-bottom: 15px;"
                                                                                    placeholder="Alamat" name="alamat"
                                                                                    value="<?= $data['alamat'] ?>" />
                                                                                <input type="text"
                                                                                    class="border rounded-0 form-control"
                                                                                    style="width: 440px;margin-bottom: 15px;"
                                                                                    placeholder="Perguruan Tinggi"
                                                                                    name="pt"
                                                                                    value="<?= $data['pt'] ?>" />
                                                                                <input type="text"
                                                                                    class="border rounded-0 form-control"
                                                                                    placeholder="Jurusan"
                                                                                    style="margin-bottom: 15px;width: 440px;"
                                                                                    name="jurusan"
                                                                                    value="<?= $data['jurusan'] ?>" />
                                                                                <select type="text"
                                                                                    class="border rounded-0 form-control"
                                                                                    style="width: 440px;margin-bottom: 15px;"
                                                                                    placeholder="Status" name="status" />
                                                                                <option
                                                                                    <?= $data['status'] == 'Aktif' ? 'selected' : '' ?>
                                                                                    value="Aktif">Aktif</option>
                                                                                <option
                                                                                    <?= $data['status'] == 'Tidak Aktif' ? 'selected' : '' ?>
                                                                                    value="Tidak Aktif">Tidak Aktif
                                                                                </option>
                                                                                </select>
                                                                                <input type="submit"
                                                                                    class="btn btn-success"
                                                                                    value="Save Changes"
                                                                                    name="update"></input>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="deletemas<?= $data['id'] ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Delete Data</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-md-6">
                                                                            <form method="POST"
                                                                                action="{{-- route('santri.destroy',$data['id']) --}}">
                                                                                @csrf
                                                                                <h6>Apakah Anda Yakin?</h6>
                                                                                <input type="submit"
                                                                                    class="btn btn-success" value="Okay"
                                                                                    name="delete"></input>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- approved -->
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
                                                                                action="{{ route('koordinator.approved', $data['id']) }}">
                                                                                @csrf
                                                                                <h6>Apakah Anda Yakin?</h6>
                                                                                <input type="submit"
                                                                                    class="btn btn-success" value="Okay"
                                                                                    name="approve"></input>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
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
                                                        <td><strong>NIM</strong></td>
                                                        <td><strong>Perusahaan</strong></td>
                                                        <td><strong>Proposal</strong></td>
                                                        <td><strong>SKSk</strong></td>
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
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
@endsection
