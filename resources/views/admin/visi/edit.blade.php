<x-layout :title="$title">
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Edit Visi & Misi</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('visi.misi.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Visi -->
                    <div class="mb-3">
                        <label class="form-label">Visi</label>
                        <textarea class="form-control" rows="3" name="vision" required>{{ old('vision', $data->vision) }}</textarea>
                    </div>

                    <!-- Misi -->
                    <div class="mb-3">
                        <label class="form-label">Misi</label>
                        <div id="misions-wrapper">
                            @foreach ($data->missions as $misi)
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="missions[]"
                                        value="{{ $misi }}" required>
                                    <button type="button" class="btn btn-danger remove-misi">X</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-primary btn-sm" id="add-misi">+ Tambah Misi</button>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="filepond" name="image" id="image">
                        @if ($data->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $data->image) }}" alt="Preview" class="img-thumbnail"
                                    style="max-height: 200px;">
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js"></script>

    <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css"
        rel="stylesheet">

    <script>
        // Register plugins
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize,
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginImageTransform
        );

        // Init FilePond
        const pond = FilePond.create(document.querySelector('#image'), {
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
            maxFileSize: '2MB',
            instantUpload: false, // ikut submit form
            storeAsFile: true, // kirim file sebagai input form
            imageResizeTargetWidth: 800,
            imageResizeTargetHeight: 800,
            labelIdle: 'Drag & Drop gambar atau <span class="filepond--label-action">Browse</span>',
            labelFileProcessingError: 'Terjadi kesalahan saat upload',
            labelFileTypeNotAllowed: 'Hanya boleh upload gambar PNG, JPG, JPEG',
            labelMaxFileSizeExceeded: 'Ukuran file terlalu besar (max 2MB)',
            labelMaxFileSize: 'Ukuran maksimal file adalah 2MB'
        });
    </script>


    <script>
        // Tambah field misi
        document.getElementById('add-misi').addEventListener('click', function() {
            const wrapper = document.getElementById('misions-wrapper');
            const newField = document.createElement('div');
            newField.classList.add('input-group', 'mb-2');
            newField.innerHTML = `
                <input type="text" class="form-control" name="missions[]" placeholder="Masukkan misi" required>
                <button type="button" class="btn btn-danger remove-misi">X</button>
            `;
            wrapper.appendChild(newField);
        });

        // Hapus field misi
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-misi')) {
                e.target.parentElement.remove();
            }
        });
    </script>
</x-layout>
