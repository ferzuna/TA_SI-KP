@extends('admin.layouts.main')

@section('section')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">{{ __('Bobot Bimbingan Dosen') }}</h1>

        @if (session('success'))
            <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success border-left-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">

            <!-- Earnings (Monthly) Card Example -->

            @foreach ($alldosen as $dosen)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <a href="{{ route('bobot-list') }}" class="text-decoration-none text-dark">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 font-weight-bold text-primary mb-3">{{ $dosen['nama'] }}</div>
                                        <strong>NIP : <span>{{ $dosen['NIP'] }}</span></strong>
                                        <br>
                                        <strong>Kuota Bimbingan : <span>{{ $dosen['kuota_bimbingan'] }}</span></strong>
                                        <br>
                                        <strong>Bobot Bimbingan : <span>{{ $dosen['bobot_bimbingan'] }}</span></strong>
                                        <br>


                                    </div>
                                </div>
                            </a>
                            <span type="button" data-toggle="modal" data-target="#edit<?= $dosen['id'] ?>"><i
                                    class="fas fa-edit iconedit" style="padding-left: 9px;"></i> Edit </span>
                        </div>
                        <div class="modal fade" id="edit<?= $dosen['id'] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Bobot bimbingan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-6">
                                            <form method="POST" action="">
                                                @csrf
                                                <input type="text" class="border rounded-0 form-control"
                                                    style="width: 440px;margin-bottom: 15px;" placeholder="Nama"
                                                    name="nama" value="<?= $dosen['nama'] ?>" />
                                                <select type="text" class="border rounded-0 form-control"
                                                    style="width: 440px;margin-bottom: 15px;" placeholder="Gender"
                                                    name="gender" />
                                                <option <?= $dosen['gender'] == 'Laki - Laki' ? 'selected' : '' ?>
                                                    value="Laki - Laki">Laki - Laki</option>
                                                <option <?= $dosen['gender'] == 'Perempuan' ? 'selected' : '' ?>
                                                    value="Perempuan">Perempuan</option>
                                                </select>
                                                <input type="text" class="border rounded-0 form-control"
                                                    style="width: 440px;margin-bottom: 15px;" placeholder="Alamat"
                                                    name="kuota" value="<?= $dosen['kuota_bimbingan'] ?>" />

                                                <input type="text" class="border rounded-0 form-control"
                                                    placeholder="Jurusan" style="margin-bottom: 15px;width: 440px;"
                                                    name="jurusan" value="<?= $dosen['jurusan'] ?>" />
                                                <select type="text" class="border rounded-0 form-control"
                                                    style="width: 440px;margin-bottom: 15px;" placeholder="Status"
                                                    name="status" />
                                                <option <?= $dosen['status'] == 'Aktif' ? 'selected' : '' ?> value="Aktif">
                                                    Aktif</option>
                                                <option <?= $dosen['status'] == 'Tidak Aktif' ? 'selected' : '' ?>
                                                    value="Tidak Aktif">Tidak Aktif</option>
                                                </select>
                                                <input type="submit" class="btn btn-success" value="Save Changes"
                                                    name="update"></input>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach







        </div>
    </div>
@endsection
