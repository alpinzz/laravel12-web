<x-layout :title="$title">
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Gallery</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="filepond" name="files[]" multiple>
                    </div>
                    <button type="submit" id="btnSave"class="btn btn-success">Simpan</button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>


    {{-- FilePond Styles --}}
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

        const btnSave = document.getElementById('btnSave');
        btnSave.disabled = true; // awalnya disable

        const pond = FilePond.create(document.querySelector('.filepond'), {
            allowMultiple: true,
            maxFiles: 10,
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

            btnSave.disabled = !(hasFiles && noErrors);
        }

        pond.on('addfile', updateButtonState);
        pond.on('removefile', updateButtonState);
        pond.on('processfile', updateButtonState);
        pond.on('error', updateButtonState);
    </script>


</x-layout>
