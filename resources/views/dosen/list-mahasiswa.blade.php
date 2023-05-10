@extends('dosen.layouts.main')

@section('section')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col" style="width: 505px;">
                            <h1 class="h3 mb-2 text-gray-800"><b>List Bimbingan Mahasiswa</b></h1>
                        </div>
                        <!-- <div class="col"> <button
                                class="btn btn-outline-success btn-sm float-none float-sm-none add-another-btn"
                                type="button" style="margin-right: 2px; margin-bottom: 8px;" data-toggle="modal"
                                data-target="#addsantri">Add
                                Santri<i class="fas fa-plus-circle edit-icon"></i></button>
                        </div> -->
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
                                            <th>No_telp</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mymahasiswa as $data)
                                            <tr>
                                                <td><?= $data['NIM'] ?></td>
                                                <td><?= $data['name'] ?></td>
                                                <td><?= $data['semester'] ?></td>
                                                <td><?= $data['no_telp'] ?></td>
                                                <td><?= $data['perusahaan'] ?></td>
                                                <td><?= $data['status'] ?></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>NIM</strong></td>
                                            <td><strong>Nama Lengkap</strong></td>
                                            <td><strong>Semester</strong></td>
                                            <td><strong>No_telp</strong></td>
                                            <td><strong>Nama Perusahaan</strong></td>
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
