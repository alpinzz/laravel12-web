<x-layout :title="$title">

    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Struktur {{ $division->name }}</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Struktur {{ $division->name }}</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ route('admin.structure.update', $member->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="divisi_id" value="{{ $division->id }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" id="name" name="name" value="{{ $member->name }}"
                                        class="form-control">
                                    <div class="mt-3">
                                        <label for="example-select" class="form-label">Posisi</label>
                                        <select class="form-select" id="position" name="position">
                                            @foreach ($positions as $position)
                                                <option value="{{ $position }}"
                                                    {{ old('position', $member->position) == $position ? 'selected' : '' }}>
                                                    {{ $position }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group mb-3 row">
                                    <label class="form-label">Profile Photo</label>
                                    <div class="col-lg-12 col-xl-12">
                                        <input class="filepond" type="file" name="image" id="image">
                                    </div>
                                </div>
                                @if ($member->image)
                                    <div class="form-group mb-3">
                                        <!-- tambah text-center jika ingin di tengah -->
                                        <img src="{{ asset('storage/' . $member->image) }}" alt="Profile Photo"
                                            class="img-thumbnail rounded"
                                            style="width: 120px; height: 120px; object-fit: contain;">
                                    </div>
                                @endif



                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('admin.structure.index', $division->slug) }}"
                                    class="btn btn-secondary">Batal</a>
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


    <!-- FilePond JS -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginFileValidateSize,
                FilePondPluginImagePreview,
                FilePondPluginImageResize,
                FilePondPluginImageTransform
            );

            const existingImage = document.querySelector('#image').dataset.existing;

            const pond = FilePond.create(document.querySelector('#image'), {
                allowImagePreview: true,
                allowImageResize: true,
                imageResizeTargetWidth: 400,
                imageResizeTargetHeight: 500,
                imageResizeMode: 'cover',
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
                maxFileSize: '2MB',
                storeAsFile: true,

                // preload gambar lama kalau ada
                files: existingImage ? [{
                    source: existingImage,
                    options: {
                        type: 'local'
                    }
                }] : []
            });
        });
    </script>


</x-layout>
