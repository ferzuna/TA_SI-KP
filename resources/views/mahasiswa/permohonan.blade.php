@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper" style="height:90vh">
        @if (session('status'))
            <div class="container justify-content-center alert-wrap">
                <div class="row">
                    <div class="col-lg-8 col-xl-8 col-md-10 mx-auto mt-5">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Pesan Terkirim! </strong> &nbsp; {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #181818">&times;</span>
                              </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="container justify-content-center alert-wrap">
                <div class="row">
                    <div class="col-lg-8 col-xl-8 col-md-10 mx-auto">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Pesan Anda gagal Terkirim</strong> &nbsp; {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #181818">&times;</span>
                              </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="container">
            <div class="py-3">
                <form action="{{ route('permohonan.sendPermohonan') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <h2 class="py-3"><b>Halaman Permohonan Kerja Praktik</b></h2>

                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="perusahaan"><b>Nama Perusahaan/Instansi</b></label>
                                <input class="form-control" type="text" name="perusahaan"
                                    value="{{ isset($data['perusahaan']) ? $data['perusahaan'] : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat"><b>Alamat Perusahaan/Instansi</b></label>
                                <input class="form-control" type="text" name="alamat"
                                    value="{{ isset($data['alamat']) ? $data['alamat'] : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="proposal"><b>Proposal Perusahaan</b></label>
                                <input id="proposal-input" class="form-control" type="text" name="proposal"
                                    value="{{ isset($data['proposal']) ? $data['proposal'] : '' }}">
                                    <div class="form-text">Input link Google Drive dokumen terkait dan berikan akses untuk mengedit</div>
                            </div>
                            
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="jadwal-seminar"><b>Tanggal Mulai</b></label>
                                <input class="form-control" type="date" name="mulai" placeholder="dd-mm-yyyy" id=""
                                    value="{{ isset($data['mulai']) ? $data['mulai'] : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jadwal-seminar"><b>Tanggal Selesai</b></label>
                                <input class="form-control" type="date" name="selesai" id=""
                                    value="{{ isset($data['selesai']) ? $data['selesai'] : '' }}" required>
                            </div>
                            
                        </div>
                        <div class="py-2">
                            @if (isset($mhs->mhspermohonan))
                                <div class="btn btn-light btn-outline-dark btn-submit" data-toggle="modal"
                                data-target="#approve"><b>Update</b></div>
                                {{-- Approve --}}
                                <div class="modal fade" id="approve"
                                    tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Ubah Data</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">                     
                                                    <h6>Proses akan dimulai dari awal apabila anda mengubah data permohonan KP. Apakah Anda yakin ingin mengubahnya?</h6>
                                                    <input type="submit"
                                                        class="btn btn-success" value="Ya"
                                                        name="approve"></input>
                                                    <button type="button"
                                                        class="btn btn-secondary"
                                                        data-dismiss="modal">Tidak</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <button type="submit" class="btn btn-light btn-outline-dark btn-submit"><b>Submit</b></button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const proposalInput = document.getElementById('proposal-input');
        const linkRegex = /^(http(s)?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- ;,./?%&=]*)?$/;

        proposalInput.addEventListener('input', function() {
            const inputValue = this.value;
            const isValidLink = linkRegex.test(inputValue);

            if (isValidLink) {
                this.setCustomValidity(''); // Clear any previous validation error message
            } else {
                this.setCustomValidity('Please enter a valid link'); // Set validation error message
            }
        });
    </script>
@endsection
