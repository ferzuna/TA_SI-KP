@extends('mahasiswa.layouts.main')

@section('section')
    <div class="wrapper" style="height:90vh">
        <div class="container">
            <div class="py-3">
                <form action="{{ route('mahasiswa.driveUpload') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <h2 class="py-3"><b>Halaman Permohonan Kerja Praktik</b></h2>

                        @csrf
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="proposal"><b>Default file input example</b></label>
                                    <input class="form-control" type="file" id="proposal" name="proposal">
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="py-2">
                            <button type="submit" class="btn btn-light btn-outline-dark btn-submit"><b>Submit</b></button>
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
