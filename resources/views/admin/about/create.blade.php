<x-layout :title="$title">

    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">About</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Tambah About</h5>
                </div><!-- end card header -->

                <div class="card-body">

                    <div class="row">

                        <div class="col-12">
                            <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data"
                                id="myForm">
                                @csrf

                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" id="title" name="title" class="form-control">

                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="form-label">Profile Photo</label>
                                    <div class="col-lg-12 col-xl-12">
                                        <input class="filepond" type="file" name="image" id="image">

                                    </div>
                                </div>


                                <label for="content" class="form-label">Konten</label>
                                <div id="quill-editor" class="mb-3" style="height: 250px; width: 100%;"></div>
                                <input type="hidden" name="description" id="service_desc">

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet">

    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>


    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Include Quill JavaScript -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        // Initialize Quill editor
        var quill = new Quill('#quill-editor', {
            theme: 'snow'
        });

        // On form submission, update the hidden input value with the editor content
        document.getElementById('myForm').onsubmit = function() {
            document.getElementById('service_desc').value = quill.root.innerHTML;
        };
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginFileValidateSize,
                FilePondPluginImagePreview,
                FilePondPluginImageResize,
                FilePondPluginImageTransform
            );

            FilePond.create(document.querySelector('#image'), {
                allowImagePreview: true,
                allowImageResize: true,
                imageResizeTargetWidth: 200,
                imageResizeTargetHeight: 400,
                imageResizeMode: 'cover',
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
                maxFileSize: '2MB',
                storeAsFile: true,

                // Custom pesan error
                labelMaxFileSizeExceeded: 'Ukuran file melebihi 2MB',
                labelFileTypeNotAllowed: 'Format file tidak didukung. Hanya PNG, JPG, JPEG',
                fileValidateTypeLabelExpectedTypes: 'Harus berupa gambar',
            });
        });
    </script>

</x-layout>
