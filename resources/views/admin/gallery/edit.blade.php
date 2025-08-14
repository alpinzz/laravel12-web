{{-- <x-layout :title="$title">
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h5>Edit Gambar</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label><br>
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Gambar" width="200">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-layout> --}}


<x-layout :title="$title">
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h5>Edit Gambar</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Gambar Saat Ini --}}
                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label><br>
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Gambar" width="200">
                    </div>

                    {{-- Ganti Gambar --}}
                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar</label>
                        <input type="file" class="filepond" name="image">
                    </div>

                    <button type="submit" id="btnUpdate" class="btn btn-success">Update</button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    {{-- FilePond Styles --}}
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />

    {{-- FilePond Scripts --}}
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>

    <script>
        FilePond.registerPlugin(
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
        );

        const btnUpdate = document.getElementById('btnUpdate');
        btnUpdate.disabled = true; // awalnya disable

        const pond = FilePond.create(document.querySelector('.filepond'), {
            allowMultiple: false, // update hanya 1 file
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
            maxFileSize: '2MB',
            labelIdle: 'Tarik & Lepas atau <span class="filepond--label-action">Pilih</span> gambar',

            // Resize client-side
            imageResizeTargetWidth: 400,
            imageResizeTargetHeight: 800,
            imageResizeMode: 'cover',


            instantUpload: false,
            storeAsFile: true,

            // Pesan error custom
            labelFileTypeNotAllowed: 'Hanya file gambar (PNG/JPG) yang diperbolehkan!',
            fileValidateTypeLabelExpectedTypes: 'Hanya PNG atau JPG',
        });

        function updateButtonState() {
            const files = pond.getFiles();
            const hasFiles = files.length > 0;
            const noErrors = files.every(file => file.status !== 8); // 8 = error

            btnUpdate.disabled = !(hasFiles && noErrors);
        }

        pond.on('addfile', updateButtonState);
        pond.on('removefile', updateButtonState);
        pond.on('processfile', updateButtonState);
        pond.on('error', updateButtonState);
    </script>
</x-layout>
