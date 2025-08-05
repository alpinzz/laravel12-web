<x-layout>




    <div class="container-xxl">


        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Gallery</h4>
            </div>
        </div>

        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Tambah Gallery</h5>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('admin.gallery.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar</label>
                                    <input type="file" class="filepond" name="files[]" id="files" multiple />


                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
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
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>



    <script>
        FilePond.registerPlugin(
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview
        );


        FilePond.create(document.querySelector('input[name="image[]"]'), {
            allowMultiple: true,
            instantUpload: false,
            maxFileSize: '2MB',
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg']

        });
        // const inputElement = document.getElementById('image');
    </script>



</x-layout>
