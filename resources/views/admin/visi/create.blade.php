<x-layout :title="$title">
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Visi & Misi</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('visi.misi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Visi -->
                    <div class="mb-3">
                        <label class="form-label">Visi</label>
                        <textarea class="form-control" rows="3" name="vision"></textarea>
                    </div>

                    <!-- Misi -->
                    <div class="mb-3">
                        <label class="form-label">Misi</label>
                        <div id="misions-wrapper">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="missions[]" placeholder="Masukkan misi"
                                    autocomplete="off">
                                <button type="button" class="btn btn-danger remove-misi">X</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm" id="add-misi">+ Tambah Misi</button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="filepond" name="image" id="image">
                    </div>

                    <button type="submit" class="btn btn-success" id="submitBtn" disabled>Simpan</button>
                    <a href="{{ route('visi.misi') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>


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

    <script>
        // === FilePond setup ===
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize,
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginImageTransform
        );

        FilePond.create(document.querySelector('#image'), {
            acceptedFileTypes: ['image/png', 'image/jpeg'],
            labelFileTypeNotAllowed: 'Hanya file PNG atau JPG yang diizinkan',
            fileValidateTypeLabelExpectedTypes: 'Format yang didukung: {allTypes}',
            maxFileSize: '2MB',
            labelMaxFileSizeExceeded: 'Ukuran file terlalu besar',
            labelMaxFileSize: 'Maksimal {filesize}',
            imageResizeTargetWidth: 800,
            imageResizeTargetHeight: 800,
            storeAsFile: true,
            instantUpload: false
        });

        // === Validasi form: tombol simpan disable kalau visi/misi kosong ===
        const submitBtn = document.getElementById('submitBtn');
        const visionInput = document.querySelector('textarea[name="vision"]');
        const missionWrapper = document.getElementById('misions-wrapper');

        function validateForm() {
            let valid = true;

            // Cek visi
            if (!visionInput.value.trim()) {
                valid = false;
            }

            // Cek misi (pastikan ada setidaknya satu input terisi)
            const missionInputs = missionWrapper.querySelectorAll('input[name="missions"], input[name="missions[]"]');
            let hasMission = false;
            missionInputs.forEach(input => {
                if (input.value.trim() !== '') {
                    hasMission = true;
                }
            });
            if (!hasMission) {
                valid = false;
            }

            submitBtn.disabled = !valid;
        }

        // Event listener untuk semua field
        visionInput.addEventListener('input', validateForm);
        missionWrapper.addEventListener('input', validateForm);
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-misi') || e.target.id === 'add-misi') {
                setTimeout(validateForm, 100); // tunggu DOM update
            }
        });

        // Initial check
        validateForm();
    </script>

</x-layout>
