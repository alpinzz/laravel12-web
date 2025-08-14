{{-- <x-layout :title="$title">
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Slider</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Slider</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Gambar Saat Ini</label><br>
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Gambar" width="200">
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="image" class="form-label">Gambar</label>
                                <input type="file" name="image" id="image" class="filepond">
                                @error('image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-start gap-1">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.slider.index') }}" class="btn btn-danger">Batal</a>
                            </div>



                        </form>
                    </div>
                </div>
            </div>



        </div>
    </div>

    </div>

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />


    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>

</x-layout> --}}


<x-layout :title="$title">
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Slider</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Slider</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Gambar Saat Ini --}}
                            <div class="mb-3">
                                <label class="form-label">Gambar Saat Ini</label><br>
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Gambar" width="200">
                            </div>

                            {{-- Ganti Gambar --}}
                            <div class="form-group mb-3">
                                <label for="image" class="form-label">Gambar Baru</label>
                                <input type="file" name="image" id="image" class="filepond">
                                @error('image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-start gap-1">
                                <button type="submit" id="btnUpdate" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.slider.index') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
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
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginImageTransform
        );

        FilePond.create(document.querySelector('#image'), {
            allowMultiple: false,
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'],
            labelFileTypeNotAllowed: 'Format file tidak diizinkan',
            fileValidateTypeLabelExpectedTypes: 'Hanya {allTypes}',

            imageResizeTargetWidth: 1920,
            imageResizeTargetHeight: 1080,
            imageResizeMode: 'cover',

            instantUpload: false,
            storeAsFile: true,

            imageTransformOutputMimeType: 'image/webp',
            imageTransformOutputQuality: 0.9,
            imageTransformClientTransforms: ['resize']
        });
    </script>

</x-layout>
