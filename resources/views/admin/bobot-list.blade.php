@extends('admin.layouts.main')

@section('section')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col" style="width: 505px;">
                            <h1 class="h3 mb-2 text-gray-800"><b>{{$dosen}}</b></h1>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NIM</th>
                                            <th>Nama Lengkap</th>
                                            <th>Semester</th>
                                            <th>Perusahaan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                <!-- <td class="namecntr"><img class="rounded-circle mr-2" width="30"
                                                        height="30"
                                                        src="{{ asset('img/user.png') }}"><?= $data['nama'] ?>
                                                </td> -->
                                                <td><?= $data['NIM'] ?></td>
                                                <td><?= $data['name'] ?></td>
                                                <td><?= $data['semester'] ?></td>
                                                <td><?= $data['perusahaan'] ?></td>
                                                <td><?= $data['status'] ?></td>
                                                {{-- <td><i class="fas fa-edit iconedit" style="padding-left: 9px;"
                                                        type="button" data-toggle="modal"
                                                        data-target="#edit<?= $data['id'] ?>"></i>
                                                    <i class="material-icons icondelete" style="padding-left: 8px;"
                                                        type="button" data-toggle="modal"
                                                        data-target="#deletemas<?= $data['id'] ?>">delete</i>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>NIM</strong></td>
                                            <td><strong>Nama Lengkap</strong></td>
                                            <td><strong>Semester</strong></td>
                                            <td><strong>Perusahaan</strong></td>
                                            <td><strong>Status</strong></td>
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
