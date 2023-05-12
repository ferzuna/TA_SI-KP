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
                                            <th>KP-A1</th>

                                            <th>Surat Diterima</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mymahasiswa as $data)
                                            <tr>
                                                <td><?= $data['name'] ?></td>
                                                <td><?= $data['semester'] ?></td>
                                                <td><?= $data['perusahaan'] ?></td>
                                                <td style="max-width: 300px !important; overflow-x:scroll; white-space: nowrap;"><a href="<?= $data['a1'] ?>" target="_blank" rel="noopener noreferrer"><?= $data['a1'] ?></a></td>
                                                <td style="max-width: 300px !important; overflow-x:scroll; white-space: nowrap;"><a href="<?= $data['bukti'] ?>" target="_blank" rel="noopener noreferrer"><?= $data['bukti'] ?></a></td>
                                                {{-- <td><i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                        type="button" data-toggle="modal"
                                                        data-target="#edit<?= $data['id'] ?>"></i>
                                                </td> --}}
                                            </tr>
                                            <div class="modal fade" id="edit<?= $data['id'] ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data Pendaftaran</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-6">
                                                                <form method="POST"
                                                                    action="{{-- route('santri.update',$data['id']) --}}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="nama">Nama</label>
                                                                        <input type="text"
                                                                        class="border rounded-0 form-control"
                                                                        style="width: 440px;margin-bottom: 15px;"
                                                                        placeholder="Nama" name="name"
                                                                        value="<?= $data['name'] ?>" disabled/>
                                                                    </div>
                                                                    <select type="text"
                                                                        class="border rounded-0 form-control"
                                                                        style="width: 440px;margin-bottom: 15px;"
                                                                        placeholder="Gender" name="gender" />
                                                                    <option
                                                                        <?= $data['gender'] == 'Laki - Laki' ? 'selected' : '' ?>
                                                                        value="Laki - Laki">Laki - Laki</option>
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
                                                                        placeholder="Perguruan Tinggi" name="pt"
                                                                        value="<?= $data['pt'] ?>" />
                                                                    <input type="text"
                                                                        class="border rounded-0 form-control"
                                                                        placeholder="Jurusan"
                                                                        style="margin-bottom: 15px;width: 440px;"
                                                                        name="jurusan" value="<?= $data['jurusan'] ?>" />
                                                                    <select type="text"
                                                                        class="border rounded-0 form-control"
                                                                        style="width: 440px;margin-bottom: 15px;"
                                                                        placeholder="Status" name="status" />
                                                                    <option
                                                                        <?= $data['status'] == 'Aktif' ? 'selected' : '' ?>
                                                                        value="Aktif">Aktif</option>
                                                                    <option
                                                                        <?= $data['status'] == 'Tidak Aktif' ? 'selected' : '' ?>
                                                                        value="Tidak Aktif">Tidak Aktif</option>
                                                                    </select>
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
                                            <td><strong>Semester</strong></td>
                                            <td><strong>Nama Perusahaan</strong></td>
                                            <td><strong>KP-A1</strong></td>
                                            <td><strong>Surat Diterima</strong></td>
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
