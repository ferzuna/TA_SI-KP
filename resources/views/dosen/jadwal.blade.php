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
                    <ul id="tabs" class="nav nav-tabs nav-fill">
                        <li class="nav-item"><a href="#home1" data-target="#home1" data-toggle="tab"
                                class="nav-link active">Belum disetujui</a></li>
                        <li class="nav-item"><a href="#revisijadwal" data-target="#revisijadwal" data-toggle="tab"
                                class="nav-link">Revisi Jadwal</a></li>
                        <li class="nav-item"><a href="#profile1" data-target="#profile1" data-toggle="tab"
                                class="nav-link ">Sudah disetujui</a></li>
                        <li class="nav-item"><a href="#sudahdinilai" data-target="#sudahdinilai" data-toggle="tab"
                                class="nav-link ">Sudah Dinilai</a></li>
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
                                                    <th>Nama Perusahaan</th>
                                                    <th>Bukti Seminar (10)</th>
                                                    <th>Tanggal</th>
                                                    <th>Ruangan</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($seminar1 as $data)
                                                    <tr>
                                                        <td><?= $data['name'] ?></td>
                                                        <td><?= $data['perusahaan'] ?></td>
                                                        <td style="max-width: 200px !important; overflow-x:scroll; white-space: nowrap;"><a href="<?= $data['kehadiran'] ?>" target="_blank" rel="noopener noreferrer"><?= $data['kehadiran'] ?></a></td>
                                                        <td><?= $data['jadwal'] ? Carbon\Carbon::parse($data['jadwal'])->isoFormat('dddd, D MMMM Y | HH:mm') : 'Belum Dijawalkan' ?>  </td>
                                                        <td><?= $data['ruangan'] ?></td>
                                                        </td>
                                                        <td><i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                            type="button" data-toggle="modal"
                                                            data-target="#edit<?= $data['id'] ?>"></i>
                                                        </td>
                                                    </tr>
                                                    {{-- Floating Modal --}}
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
                                                                        <form method="POST"
                                                                            action="{{ route('dosen.setujuijadwal', $data['id']) }}">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="nama">Nama</label>
                                                                                <input type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Nama" name="name"
                                                                                value="<?= $data->name ?>" disabled/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="status">Status</label>
                                                                                <select type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Status" name="status">
                                                                                <option
                                                                                    <?= $data['status'] == 'revisi jadwal' ? 'selected' : '' ?>
                                                                                    value="revisi jadwal">Revisi Jadwal</option>
                                                                                <option
                                                                                    <?= $data['status'] == 'acc' ? 'selected' : '' ?>
                                                                                    value="acc">ACC Jadwal</option>
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
                                                    <td><strong>Nama Perusahaan</strong></td>
                                                    <td><strong>Bukti Seminar (10)</strong></td>
                                                    <td><strong>Tanggal</strong></td>
                                                    <td><strong>Ruangan</strong></td>
                                                    <td><strong>Manage</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="revisijadwal" class="tab-pane fade show">
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
                                                    <th>Bukti Seminar (10)</th>
                                                    <th>Tanggal</th>
                                                    <th>Ruangan</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($seminar2 as $data)
                                                    <tr>
                                                        <td><?= $data['name'] ?></td>
                                                        <td><?= $data['perusahaan'] ?></td>
                                                        <td style="max-width: 200px !important; overflow-x:scroll; white-space: nowrap;"><a href="<?= $data['kehadiran'] ?>" target="_blank" rel="noopener noreferrer"><?= $data['kehadiran'] ?></a></td>
                                                        <td><?= $data['jadwal'] ? Carbon\Carbon::parse($data['jadwal'])->isoFormat('dddd, D MMMM Y | HH:mm') : 'Belum Dijawalkan' ?>  </td>
                                                        <td><?= $data['ruangan'] ?></td>
                                                        </td>
                                                        <td><i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                            type="button" data-toggle="modal"
                                                            data-target="#edit<?= $data['id'] ?>"></i>
                                                        </td>
                                                    </tr>
                                                    {{-- Floating Modal --}}
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
                                                                        <form method="POST"
                                                                            action="{{ route('dosen.setujuijadwal', $data['id']) }}">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="nama">Nama</label>
                                                                                <input type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Nama" name="name"
                                                                                value="<?= $data->name ?>" disabled/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="status">Status</label>
                                                                                <select type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Status" name="status">
                                                                                <option
                                                                                    <?= $data['status'] == 'revisi jadwal' ? 'selected' : '' ?>
                                                                                    value="revisi jadwal">Revisi Jadwal</option>
                                                                                <option
                                                                                    <?= $data['status'] == 'acc' ? 'selected' : '' ?>
                                                                                    value="acc">ACC Jadwal</option>
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
                                                    <td><strong>Nama Perusahaan</strong></td>
                                                    <td><strong>Bukti Seminar (10)</strong></td>
                                                    <td><strong>Tanggal</strong></td>
                                                    <td><strong>Ruangan</strong></td>
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
                                                    <th>Nama Perusahaan</th>
                                                    <th>Bukti Seminar(10)</th>
                                                    <th>Tanggal</th>
                                                    <th>Ruangan</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($seminar3 as $data)
                                                    <tr>
                                                        <td><?= $data['name'] ?></td>
                                                        <td><?= $data['perusahaan'] ?></td>
                                                        <td style="max-width: 200px !important; overflow-x:scroll; white-space: nowrap;"><a href="<?= $data['kehadiran'] ?>" target="_blank" rel="noopener noreferrer"><?= $data['kehadiran'] ?></a></td>
                                                        <td><?= $data['jadwal'] ? Carbon\Carbon::parse($data['jadwal'])->isoFormat('dddd, D MMMM Y | HH:mm') : 'Belum Dijawalkan' ?>  </td>
                                                        <td><?= $data['ruangan'] ?></td>
                                                        </td>
                                                        <td><i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                            type="button" data-toggle="modal"
                                                            data-target="#edit<?= $data['id'] ?>"></i>
                                                        </td>
                                                    </tr>
                                                    {{-- Floating Modal --}}
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
                                                                        <form method="POST"
                                                                            action="{{ route('dosen.nilaikp', $data['id']) }}">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="nama">Nama</label>
                                                                                <input type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Nama" name="name"
                                                                                value="<?= $data->name ?>" disabled/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="nilai_laporan">Nilai Laporan</label>
                                                                                <input type="number"
                                                                                    class="border rounded-0 form-control"
                                                                                    placeholder="Nilai Laporan KP"
                                                                                    oninput="limitInputLength(this, 3)"
                                                                                    maxlength="3"
                                                                                    pattern="[0-9]{3}"
                                                                                    style="margin-bottom: 15px;width: 440px;"
                                                                                    name="nilai_laporan" value="<?= $data['nilai_laporan'] ?>"  />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="nilai_seminar">Nilai Seminar</label>
                                                                                <input type="number"
                                                                                    class="border rounded-0 form-control"
                                                                                    placeholder="Nilai Seminar KP"
                                                                                    oninput="limitInputLength(this, 3)"
                                                                                    maxlength="3"
                                                                                    pattern="[0-9]{3}"
                                                                                    style="margin-bottom: 15px;width: 440px;"
                                                                                    name="nilai_seminar" value="<?= $data['nilai_seminar'] ?>"  />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="status">Status</label>
                                                                                <select type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Status" name="status">
                                                                                <option
                                                                                    <?= $data['status'] == 'revisi jadwal' ? 'selected' : '' ?>
                                                                                    value="revisi jadwal">Revisi Jadwal</option>
                                                                                <option
                                                                                    <?= $data['status'] == 'acc' ? 'selected' : '' ?>
                                                                                    value="acc">ACC Jadwal</option>
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
                                                    <td><strong>Nama Perusahaan</strong></td>
                                                    <td><strong>Bukti Seminar(10)</strong></td>
                                                    <td><strong>Tanggal</strong></td>
                                                    <td><strong>Ruangan</strong></td>
                                                    <td><strong>Manage</strong></td>
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
                                                    <th>Nama Perusahaan</th>
                                                    <th>Tanggal</th>
                                                    <th>Ruangan</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($seminar4 as $data)
                                                    <tr>
                                                        <td><?= $data['name'] ?></td>
                                                        <td><?= $data['perusahaan'] ?></td>
                                                        <td><?= $data['jadwal'] ? Carbon\Carbon::parse($data['jadwal'])->isoFormat('dddd, D MMMM Y | HH:mm') : 'Belum Dijawalkan' ?>  </td>
                                                        <td><?= $data['ruangan'] ?></td>
                                                        </td>
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
                                                                    <h5 class="modal-title">Edit Data</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-md-6">
                                                                        <form method="POST"
                                                                            action="{{ route('dosen.nilaikp', $data['id']) }}">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="nama">Nama</label>
                                                                                <input type="text"
                                                                                class="border rounded-0 form-control"
                                                                                style="width: 440px;margin-bottom: 15px;"
                                                                                placeholder="Nama" name="name"
                                                                                value="<?= $data->name ?>" disabled/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="nilai_laporan">Nilai Laporan</label>
                                                                                <input type="number"
                                                                                    class="border rounded-0 form-control"
                                                                                    placeholder="Nilai Laporan KP"
                                                                                    oninput="limitInputLength(this, 3)"
                                                                                    maxlength="3"
                                                                                    pattern="[0-9]{3}"
                                                                                    style="margin-bottom: 15px;width: 440px;"
                                                                                    name="nilai_laporan" value="<?= $data['nilai_laporan'] ?>" required />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="nilai_seminar">Nilai Seminar</label>
                                                                                <input type="number"
                                                                                    class="border rounded-0 form-control"
                                                                                    placeholder="Nilai Seminar KP"
                                                                                    oninput="limitInputLength(this, 3)"
                                                                                    maxlength="3"
                                                                                    pattern="[0-9]{3}"
                                                                                    style="margin-bottom: 15px;width: 440px;"
                                                                                    name="nilai_seminar" value="<?= $data['nilai_seminar'] ?>" required />
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
                                                    <td><strong>Nama Perusahaan</strong></td>
                                                    <td><strong>Tanggal</strong></td>
                                                    <td><strong>Ruangan</strong></td>
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

@section('script')
<script>
    function limitInputLength(element, maxLength) {
        if (element.value.length > maxLength) {
            element.value = element.value.slice(0, maxLength);
        }
    }
</script>
@endsection
