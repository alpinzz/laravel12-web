{{-- <x-layout :title="$title">

    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Slider</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Tambah Slider</h5>
                </div><!-- end card header -->

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ route('admin.slider.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3 row">
                                    <label class="form-label">Profile Photo</label>
                                    <div class="col-lg-12 col-xl-12">
                                        <input class="filepond" type="file" name="image[]" id="image">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="#" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- FilePond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <!-- FilePond JS -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <!-- Plugin Validasi Type -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

    <!-- Plugin Preview -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet">

    <!-- Plugin Resize -->
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>

    <!-- Plugin Transform (WAJIB untuk kirim hasil resize) -->


    <script>
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginImageResize,
            FilePondPluginImageTransform,
            FilePondPluginImagePreview
        );

        FilePond.create(document.querySelector('#image'), {
            instantUpload: false,
            storeAsFile: true,

            allowMultiple: true, // kalau mau banyak gambar
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
            labelFileTypeNotAllowed: 'Format file tidak diizinkan',
            fileValidateTypeLabelExpectedTypes: 'Hanya {allTypes}',

            imageResizeTargetWidth: 1920,
            imageResizeTargetHeight: 1080,
            imageResizeMode: 'cover',

            // Supaya hasil resize dikirim ke server
            imageTransformOutputMimeType: 'image/jpeg', // bisa diganti 'image/webp'
            imageTransformOutputQuality: 0.9, // kualitas 90%
            imageTransformClientTransforms: ['resize']
        });
    </script>



</x-layout> --}}


<x-layout :title="$title">
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Slider</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tambah Slider</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('admin.slider.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label">Gambar Slider</label>
                                    <input type="file" id="image" name="image[]" multiple class="w-100">
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="#" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FilePond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet">

    <!-- FilePond JS -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>

    <script>
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginImageTransform
        );

        FilePond.create(document.querySelector('#image'), {
            instantUpload: false,
            storeAsFile: true,
            allowMultiple: true,

            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'],
            labelFileTypeNotAllowed: 'Format file tidak diizinkan',
            fileValidateTypeLabelExpectedTypes: 'Hanya {allTypes}',

            imageResizeTargetWidth: 1920,
            imageResizeTargetHeight: 1080,
            imageResizeMode: 'cover',

            imageTransformOutputMimeType: 'image/webp',
            imageTransformOutputQuality: 0.9,
            imageTransformClientTransforms: ['resize']
        });
    </script>
</x-layout>
