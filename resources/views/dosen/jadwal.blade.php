@extends('dosen.layouts.main')

@section('section')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">

                {{-- Content --}}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col" style="width: 505px;">
                            <h1 class="h3 mb-2 text-gray-800"><b>Jadwal Pelaksanaan Seminar KP</b></h1>
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
                                            <th>Nama Perusahaan</th>
                                            <th>Tanggal</th>
                                            <th>Ruangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($seminar as $data)
                                            <tr>
                                                <td><?= $data['name'] ?></td>
                                                <td><?= $data['perusahaan'] ?></td>
                                                <td><?= $data['jadwal'] ?></td>
                                                <td><?= $data['ruangan'] ?></td>
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
                                                                    action="{{-- route('santri.update',$data['id']) --}}">
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
                                            <div class="modal fade" id="deletemas<?= $data['id'] ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Delete Santri</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-6">
                                                                <form method="POST"
                                                                    action="{{-- route('santri.destroy',$data['id']) --}}">
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
                                            <td><strong>Nama</strong></td>
                                            <td><strong>Nama Perusahaan</strong></td>
                                            <td><strong>Tanggal</strong></td>
                                            <td><strong>Ruangan</strong></td>
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
