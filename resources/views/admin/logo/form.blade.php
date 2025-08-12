{{-- <x-layout :title="$title">

    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">About</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">{{ $divisi->logo ? 'Ganti' : 'Unggah' }} Logo {{ $divisi->name }}</h5>
                </div><!-- end card header -->

                <div class="card-body">

                    <div class="row">

                        <div class="col-12">

                            <form action="{{ route('admin.logo.store', $divisi) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Pilih Logo</label>
                                    <input type="file" name="logo" id="logo" class="form-control" required>
                                    @error('logo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                @if ($divisi->logo)
                                    <p>Logo saat ini:</p>
                                    <img src="{{ asset('storage/' . $divisi->logo) }}"
                                        style="max-height: 150px; object-fit: contain;">
                                @endif

                                <br><br>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('admin.logo') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}

<!-- Include Quill JavaScript -->
{{-- <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        // Initialize Quill editor
        var quill = new Quill('#quill-editor', {
            theme: 'snow'
        });

        // On form submission, update the hidden input value with the editor content
        document.getElementById('myForm').onsubmit = function() {
            document.getElementById('service_desc').value = quill.root.innerHTML;
        };
    </script> --}}
{{-- </x-layout>  --}}

{{-- <x-layout :title="$title">
    <div class="container-xxl py-3">
        <h4>{{ $divisi->logoBidang ? 'Ganti Logo' : 'Unggah Logo' }} Bidang: {{ $divisi->name }}</h4>

        <form action="{{ route('admin.logo.store', $divisi) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="logo" class="form-label">Pilih Logo</label>
                <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" required>
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.logo.show', $divisi) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</x-layout> --}}


<x-layout :title="$title">
    <div class="container-xxl py-3">
        <h4>{{ $divisi->name }} - {{ $divisi->logoBidang ? 'Ganti Logo' : 'Unggah Logo' }}</h4>
        <form action="{{ route('admin.logo.store', $divisi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="logo" class="form-label">Pilih Logo</label>
                <input type="file" name="logo" class="form-control" required>
                @error('logo')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            @if ($divisi->logoBidang && $divisi->logoBidang->logo)
                <div class="mb-3">
                    <label class="form-label">Logo Saat Ini</label><br>
                    <img src="{{ asset('storage/' . $divisi->logoBidang->logo) }}" style="max-height:150px;">
                </div>
            @endif
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.logo') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-layout>
