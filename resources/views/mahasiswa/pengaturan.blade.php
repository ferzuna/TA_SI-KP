@extends('mahasiswa.layouts.main')

@section('section')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <!-- Page Heading -->

                    @if (session('success'))
                        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger border-left-danger" role="alert">
                            <ul class="pl-4 my-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="py-5" action="{{ route('mahasiswa.setting') }}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4 order-lg-2">

                                <div class="card shadow mb-4 card-border-pengaturan">
                                    {{-- <div class="card-profile-image mt-4">
    
                                    </div> --}}

                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            {{-- <form id="form1" action="{{ route('mahasiswa.setting') }}" method="post"
                                                enctype="multipart/form-data"> --}}
                                            <input type='file' id="imageUpload" name="imageUpload"
                                                accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="oldImage" value="{{ Auth::user()->image }}">
                                            <label for="imageUpload"></label>
                                            {{-- </form> --}}

                                        </div>
                                        <div class="avatar-preview">
                                            @if (Auth::user()->image)
                                                <div id="imagePreview"
                                                    style="background-image: url({{ asset('storage/' . Auth::user()->image) }});">
                                                </div>
                                            @else()
                                                <div id="imagePreview" class="rounded-circle avatar avatar font-weight-bold"
                                                    style="background-image: url(''); font-size: 60px; height: 180px; width: 180px;"
                                                    data-initial="{{ Auth::user()->name[0] }}">
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <h5 class="font-weight-bold">{{ Auth::user()->name }}</h5>
                                                    <p>Semester {{ Auth::user()->semester }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row">
                                            <div class="col-md-4">
                                                <div class="card-profile-stats">
                                                    <span class="heading">22</span>
                                                    <span class="description">Friends</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card-profile-stats">
                                                    <span class="heading">10</span>
                                                    <span class="description">Photos</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card-profile-stats">
                                                    <span class="heading">89</span>
                                                    <span class="description">Comments</span>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-8 order-lg-1">

                                <div class="card shadow mb-4" style="border-radius:20px 20px 20px 20px; border:2px solid black">

                                    <div class="card-header py-3" style="background-color: #FF8422; border-radius:20px 20px 0px 0px;" >
                                        <h4 class="m-0 font-weight-bold" style="color:black">Pengaturan</h4>
                                    </div>

                                    <div class="card-body">

                                        {{-- <form id="form2" method="POST" action="{{ route('mahasiswa.setting') }}"
                                            autocomplete="off"> --}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <input type="hidden" name="_method" value="POST">

                                        <h6 class="heading-small mb-4">User information</h6>

                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group focused">
                                                        <label class="form-control-label" for="name">Name<span
                                                                class="small text-danger">*</span></label>
                                                        <input type="text" id="name" class="form-control"
                                                            name="name" placeholder="Name"
                                                            value="{{ old('name', Auth::user()->name) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group focused">
                                                        <label class="form-control-label" for="name">NIM<span
                                                                class="small text-danger">*</span></label>
                                                        <input type="number" id="name" class="form-control"
                                                            name="NIM" placeholder="NIM"
                                                            value="{{ old('nim', Auth::user()->NIM) }}" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="email">Username<span
                                                                class="small text-danger">*</span></label>
                                                        <input type="text" id="username" class="form-control"
                                                            name="username" placeholder="Username"
                                                            value="{{ old('username', Auth::user()->username) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="email">E-mail<span
                                                                class="small text-danger">*</span></label>
                                                        <input type="email" id="email" class="form-control"
                                                            name="email" placeholder="Email"
                                                            value="{{ old('email', Auth::user()->email) }}" hidden>
                                                        <input type="email" id="email" class="form-control"
                                                            name="email" placeholder="Email"
                                                            value="{{ old('email', Auth::user()->email) }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group focused">
                                                        <label class="form-control-label" for="confirm_password">Nomor
                                                            Telepon</label>
                                                        <input type="number" id="confirm_password" class="form-control"
                                                            name="no_telp" placeholder="No. Telepon"
                                                            value="{{ old('no_telp', Auth::user()->no_telp) }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group focused">
                                                        <label class="form-control-label" for="current_password">Jumlah
                                                            SKSk</label>
                                                        <input type="number" id="current_password" class="form-control"
                                                            name="sks" placeholder="Jumlah SKSk"
                                                            value="{{ old('sks', Auth::user()->sks) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group focused">
                                                        <label class="form-control-label"
                                                            for="semester">Semester</label>
                                                        <input type="number" id="semester" class="form-control"
                                                            name="semester" placeholder="Semester"
                                                            value="{{ old('semester', Auth::user()->semester) }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group focused">
                                                        <label class="form-control-label"
                                                            for="confirm_password">Alamat</label>
                                                        <input type="text area" id="confirm_password"
                                                            class="form-control" name="alamat" placeholder="Alamat Anda"
                                                            value="{{ old('alamat', Auth::user()->alamat) }}" required>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group focused">
                                                        <label class="form-control-label" for="current_password">Current
                                                            password</label>
                                                        <input type="password" id="current_password" class="form-control"
                                                            name="current_password" placeholder="Current password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group focused">
                                                        <label class="form-control-label" for="new_password">New
                                                            password</label>
                                                        <input type="password" id="new_password" class="form-control"
                                                            name="new_password" placeholder="New password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group focused">
                                                        <label class="form-control-label" for="confirm_password">Confirm
                                                            password</label>
                                                        <input type="password" id="confirm_password" class="form-control"
                                                            name="password_confirmation" placeholder="Confirm password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Button -->
                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col text-center">
                                                    <button id="submitBtn" type="submit" class="btn btn-primary" style="background-color:#001A41 !important">Save
                                                        Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- </form> --}}

                                    </div>

                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                    $('#imagePreview').removeAttr('data-initial');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
@endsection
