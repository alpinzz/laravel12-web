<x-layout :title="$title">
    <div class="container-xxl py-3">
        <h4>{{ $divisi->name }} - {{ $divisi->logoBidang ? 'Ganti Logo' : 'Unggah Logo' }}</h4>
        <form action="{{ route('admin.logo.store', $divisi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="logo" class="form-label">Pilih Logo</label>
                <input type="file" name="logo" id="logo" class="filepond" required>
                @error('logo')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            @if ($divisi->logoBidang && $divisi->logoBidang->logo)
                <div class="mb-3">
                    <label class="form-label">Logo Saat Ini</label><br>
                    <img src="{{ asset('storage/' . $divisi->logoBidang->logo) }}" style="max-height:150px;">
                </div>
            @endif
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.logo') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- FilePond core -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

    <!-- Plugins -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js"></script>

    <!-- CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css"
        rel="stylesheet">

    <script>
        // Register FilePond plugins
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize,
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginImageTransform
        );

        // Init FilePond
        FilePond.create(document.querySelector('#logo'), {
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
            maxFileSize: '2MB',
            instantUpload: false, // ikut submit form
            storeAsFile: true, // biar dikirim sebagai input form biasa
            imageResizeTargetWidth: 400,
            imageResizeTargetHeight: 400,
            labelIdle: 'Drag & Drop logo atau <span class="filepond--label-action">Browse</span>',
            labelFileProcessingError: 'Terjadi kesalahan saat upload',
            labelFileTypeNotAllowed: 'Hanya boleh upload PNG, JPG, JPEG',
            labelMaxFileSizeExceeded: 'Ukuran file terlalu besar (max 2MB)',
            labelMaxFileSize: 'Ukuran maksimal file adalah 2MB'
        });
    </script>



</x-layout>
