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
            <a href="{{ route('bobot-list') }}" class="text-decoration-none text-dark">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 font-weight-bold text-primary mb-3">{{ $dosen['nama'] }}</div>
                                    <strong>NIP : <span>{{ $dosen['NIP'] }}</span></strong>
                                    <br>
                                    <strong>Kuota Bimbingan : <span>{{ $dosen['kuota_bimbingan'] }}</span></strong>
                                    <br>
                                    <strong>Bobot Bimbingan : <span>{{ $dosen['bobot_bimbingan'] }}</span></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach







        </div>
    </div>
@endsection
