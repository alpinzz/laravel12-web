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
                    <h5 class="card-title mb-0">Tambah Struktur {{ $division->name }}</h5>
                </div><!-- end card header -->

                <div class="card-body">

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ route('admin.structure.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="divisi_id" value="{{ $division->id }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        autocomplete="off">
                                    <div class="mt-3">
                                        <label for="example-select" class="form-label">Posisi</label>
                                        <select class="form-select" id="position" name="position">
                                            @foreach ($positions as $position)
                                                <option value="{{ $position }}">{{ $position }}</option>
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

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="{{ route('admin.structure.index', $division->slug) }}"
                                        class="btn btn-secondary">Batal</a>
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
            // Register the plugins
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginFileValidateSize,
                FilePondPluginImagePreview,
                FilePondPluginImageResize,
                FilePondPluginImageTransform
            );

            // Get all required elements
            const submitBtn = document.querySelector('button[type="submit"]');
            const form = document.querySelector('form');
            const nameInput = document.getElementById('name');
            const positionSelect = document.getElementById('position');
            let fileValidationError = null;

            // Create the FilePond instance
            const pond = FilePond.create(document.querySelector('#image'), {
                allowImagePreview: true,
                allowImageResize: true,
                imageResizeTargetWidth: 400,
                imageResizeTargetHeight: 500,
                imageResizeMode: 'cover',
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
                maxFileSize: '2MB',
                storeAsFile: true,
                required: true,

                // Custom error messages
                labelMaxFileSizeExceeded: 'Ukuran file melebihi 2MB',
                labelFileTypeNotAllowed: 'Format file tidak didukung. Hanya PNG, JPG, JPEG',
                fileValidateTypeLabelExpectedTypes: 'Harus berupa gambar',

                // Error handling
                onerror: (error) => {
                    fileValidationError = error ? error.main : null;
                    updateSubmitButton();
                },

                // Clear error when file is changed
                onaddfile: () => {
                    fileValidationError = null;
                    updateSubmitButton();
                },

                // Handle file processing
                onprocessfile: (error, file) => {
                    fileValidationError = error ? 'Gagal memproses gambar' : null;
                    updateSubmitButton();
                }
            });

            // Function to validate all fields
            function validateForm() {
                const nameValid = nameInput.value.trim() !== '';
                const positionValid = positionSelect.value !== '';
                const fileValid = pond.getFiles().length > 0 && !fileValidationError;

                return nameValid && positionValid && fileValid;
            }

            // Function to update submit button state
            function updateSubmitButton() {
                submitBtn.disabled = !validateForm();
                submitBtn.classList.toggle('disabled', submitBtn.disabled);
            }

            // Add event listeners for all form changes
            nameInput.addEventListener('input', updateSubmitButton);
            positionSelect.addEventListener('change', updateSubmitButton);
            pond.on('addfile', updateSubmitButton);
            pond.on('removefile', updateSubmitButton);
            pond.on('processfile', updateSubmitButton);
            pond.on('error', updateSubmitButton);

            // Initial validation
            updateSubmitButton();

            // Handle form submission
            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    return;
                }

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
                    Menyimpan...
                `;
            });
        });
    </script>

</x-layout>
