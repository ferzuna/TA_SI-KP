@extends('admin.layouts.main')

@section('section')
    <div class="container-fluid">
        <div class="header-wrap">
            <h1 class="h3 mb-5 text-gray-800 text-center"><b style="border-bottom:5px solid #2B6684; padding:10px">{{ __('Bobot Bimbingan Dosen') }}</b></h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success border-left-success alert-dismissible fade show my-2" role="alert">
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
<div class="container">
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->

        @foreach ($alldosen as $dosen)
            <div class="col-lg-3 col-md-6 mb-4">
                @if ($dosen['status'])
                <div id="bobot {{ $loop->iteration }}" class="card shadow h-100 py-1 bobot-card" style="background-color:rgba(0,255,0,0.3); border:2px solid black">
                @else
                <div id="bobot {{ $loop->iteration }}" class="card shadow h-100 py-1 bobot-card" style="background-color:rgba(255,0,0,0.3); border:2px solid black">
                @endif
                
                    <div class="card-body">
                        <a href="{{ route('bobot-list', $dosen['id']) }}" class="text-decoration-none text-dark">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h4 font-weight-bold text-primary">{{ $dosen['name'] }}</div>
                                    <p class="h6 font-weight-bold text-primary mb-3">NIP: {{ $dosen['NIP'] }}</p>
                                    <strong>Kuota Bimbingan : <span>{{ $dosen['kuota_bimbingan'] }}</span></strong>
                                    <br>
                                    <strong>Bobot Bimbingan : <span>{{ $dosen['bobot_bimbingan'] }}</span></strong>
                                    <br>
                                    <strong>Status : <span>{{ $dosen['status'] ? 'Aktif' : 'Tidak Aktif'}}</span></strong>


                                </div>
                            </div>
                        </a>
                        <br>
                        <span type="button" data-toggle="modal" data-target="#edit<?= $dosen['id'] ?>"><i
                                class="p-0 fas fa-edit iconedit" style="padding-left: 9px;"></i> Edit </span>
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
                                        <form method="POST" action="{{route('kuota', $dosen['id'])}}">
                                            @csrf
                                            <label class="p-0" for="nama">Nama</label>
                                            <input type="text" disabled class="border rounded-0 form-control"
                                                style="width: 440px;margin-bottom: 15px;" placeholder="Nama"
                                                name="nama" value="<?= $dosen['name'] ?>" />
                                            <label class="p-0" for="nama">Kuota Bimbingan</label>
                                            <input type="text" class="border rounded-0 form-control"
                                                style="width: 440px;margin-bottom: 15px;" placeholder="Alamat"
                                                name="kuota" value="<?= $dosen['kuota_bimbingan'] ?>" />


                                            <label class="p-0" for="nama">Status</label>
                                            <select type="text" class="border rounded-0 form-control"
                                                style="width: 440px;margin-bottom: 15px;" placeholder="Status"
                                                name="status" />
                                            <option <?= $dosen['status'] == 1 ? 'selected' : '' ?> value="1">
                                                Aktif</option>
                                            <option <?= $dosen['status'] == 0 ? 'selected' : '' ?>
                                                value="0">Tidak Aktif</option>
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
    </div>
@endsection

@section('script')
    <script>
        const bobotCards = document.querySelectorAll('.bobot-card');

bobotCards.forEach(card => {
    const randomColor = Math.floor(Math.random()*0xFFFFFF).toString(16);
    card.style.borderRight = `10px solid #${randomColor}`;
});
    </script>
@endsection
