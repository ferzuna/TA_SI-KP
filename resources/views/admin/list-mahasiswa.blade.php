@extends('admin.layouts.main')

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
                                <h5 class="modal-title">Add Santri</h5>
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
                            <h1 class="h3 mb-2 text-gray-800"><b>List Mahasiswa KP</b></h1>
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
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Semester</th>
                                            <th>No. telp</th>
                                            <th>Jumlah SKSk</th>
                                            <th>Status</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mymahasiswa as $data)
                                            <tr>
                                                <td><?= $data['NIM'] ?></td>
                                                <td><?= $data['name'] ?></td>
                                                <td><?= $data['semester'] ?></td>
                                                <td><?= $data['no_telp'] ?></td>
                                                <td><?= $data['sks'] ?></td>
                                                <td><?= isset($data['status']) ? $data['status'] : 'Belum Mendaftar'?></td>
                                                <td style="display: flex">
                                                    <div style="margin-right:10px" class="icon-wrap" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                            type="button" data-toggle="modal"
                                                            data-target="#edit<?= $data['id'] ?>"></i>
                                                    </div>
                                                    <div class="icon-wrap" data-toggle="tooltip" data-placement="top" title="Hapus">
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
                                                                <form method="POST" action="{{ route('admin.editmahasiswa', $data['id']) }}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="NIM">NIM</label>
                                                                        <input type="number"
                                                                            class="border rounded-0 form-control"
                                                                            style="width: 440px;margin-bottom: 15px;"
                                                                            placeholder="NIM" name="NIM"
                                                                            oninput="limitInputLength(this, 14)"
                                                                            maxlength="14"
                                                                            pattern="[0-9]{14}"
                                                                            title="Digit yang diterima hanya 14 digit."
                                                                            value="<?= $data['NIM'] ?>" required/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="nama">Nama</label>
                                                                        <input type="text"
                                                                            class="border rounded-0 form-control"
                                                                            style="width: 440px;margin-bottom: 15px;"
                                                                            placeholder="Nama" name="name"
                                                                            value="<?= $data['name'] ?>" required/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="semester">Semester</label>
                                                                        <input type="number"
                                                                            class="border rounded-0 form-control"
                                                                            style="width: 440px;margin-bottom: 15px;"
                                                                            placeholder="Semester" name="semester"
                                                                            oninput="limitInputLength(this, 2)"
                                                                            maxlength="2"
                                                                            pattern="[0-9]{2}"
                                                                            value="<?= $data['semester'] ?>" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="no_telp">No Telepon</label>
                                                                        <input type="number"
                                                                            class="border rounded-0 form-control"
                                                                            style="width: 440px;margin-bottom: 15px;"
                                                                            placeholder="No Telpon" name="no_telp"
                                                                            value="<?= $data['no_telp'] ?>" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="sks">Jumlah SKS</label>
                                                                        <input type="number"
                                                                            class="border rounded-0 form-control"
                                                                            placeholder="Jumlah SKS"
                                                                            oninput="limitInputLength(this, 3)"
                                                                            maxlength="3"
                                                                            pattern="[0-9]{3}"
                                                                            style="margin-bottom: 15px;width: 440px;"
                                                                            name="sks" value="<?= $data['sks'] ?>" required />
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
                                                            <h5 class="modal-title">Delete Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-6">
                                                                <form method="POST"
                                                                    action="{{ route('admin.mhsdestroy',$data['id']) }}">
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
                                            <td><strong>NIM</strong></td>
                                            <td><strong>Nama</strong></td>
                                            <td><strong>Semester</strong></td>
                                            <td><strong>No. telp</strong></td>
                                            <td><strong>Jumlah SKSk</strong></td>
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
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
@endsection

@section('script')
<script>
    function limitInputLength(element, maxLength) {
        if (element.value.length > maxLength) {
            element.value = element.value.slice(0, maxLength);
        }
    }
</script>
@endsection
