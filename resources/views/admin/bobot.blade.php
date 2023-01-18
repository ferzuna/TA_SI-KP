@extends('admin.layouts.main')

@section('section')
    
<div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">{{ __('Sistem Manajemen Data Mahasantri') }}</h1>

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

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>email</th>
                    <th>Bobot Bimbingan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alldosen as $dosen)
                <tr>
                    <td> {{ $dosen['nama'] }} </td>
                    <td> {{ $dosen['NIP'] }} </td>
                    <td> {{ $dosen['email'] }} </td>
                    <td> {{ $dosen['bobot_bimbingan'] }} </td>
                </tr>
            </tbody>
        </table> 
    @endforeach
@endsection