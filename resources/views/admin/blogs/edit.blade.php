{{-- <x-layout :title="$title">

    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Blogs</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Blogs</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST"
                                enctype="multipart/form-data" id="myForm">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="divisi_id" value="{{ $blog->divisi_id }}">

                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" id="title" name="title"
                                        value="{{ old('title', $blog->title) }}" class="form-control">
                                    <div class="mt-3">
                                        <label for="category_id" class="form-label">Kategori</label>
                                        <select class="form-select" id="category_id" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $blog->category_id === $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group mb-3 row">
                                    <label class="form-label">Gambar</label>
                                    <div class="col-lg-12 col-xl-12">
                                        <input class="filepond" type="file" name="image" id="image"
                                            data-existing="{{ $blog->image ? asset('storage/' . $blog->image) : '' }}">

                                    </div>
                                </div>
                                @if ($blog->image)
                                    <div class="form-group mb-3 text-center">
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image"
                                            class="img-fluid rounded" style="max-width: 300px; height: auto;">
                                    </div>
                                @endif

                                <label for="quill-editor" class="form-label">Konten</label>
                                <div id="quill-editor" style="height: 250px">{!! $blog->content !!}</div>
                                <input type="hidden" name="content" id="service_desc">

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Batal</a>
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

            const existingImage = document.querySelector('#image').dataset.existing;

            FilePond.create(document.querySelector('#image'), {
                allowImagePreview: true,
                allowImageResize: true,
                imageResizeTargetWidth: 400,
                imageResizeTargetHeight: 600,
                imageResizeMode: 'cover',
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
                maxFileSize: '2MB',
                storeAsFile: true,
                required: false, // <-- supaya edit tidak wajib upload gambar baru

                // preload gambar lama jika ada
                files: existingImage ? [{
                    source: existingImage,
                    options: {
                        type: 'local'
                    }
                }] : []
            });
        });
    </script>

</x-layout> --}}

<x-layout :title="$title">

    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Blogs</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Blogs</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST"
                                enctype="multipart/form-data" id="myForm">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="divisi_id" value="{{ $blog->divisi_id }}">

                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" id="title" name="title"
                                        value="{{ old('title', $blog->title) }}" class="form-control w-100">
                                    <div class="mt-3">
                                        <label for="category_id" class="form-label">Kategori</label>
                                        <select class="form-select w-100" id="category_id" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $blog->category_id === $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group mb-3 row">
                                    <label class="form-label">Gambar</label>
                                    <div class="col-12">
                                        <input class="filepond" type="file" name="image" id="image"
                                            data-existing="{{ $blog->image ? asset('storage/' . $blog->image) : '' }}">

                                    </div>
                                </div>
                                @if ($blog->image)
                                    <div class="form-group mb-3">
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image"
                                            class="img-fluid rounded" style="max-width: 300px; height: auto;">
                                    </div>
                                @endif

                                <label for="quill-editor" class="form-label">Konten</label>
                                <div id="quill-editor" style="height: 250px; width: 100%;">{!! $blog->content !!}</div>
                                <input type="hidden" name="content" id="service_desc">

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet">
    <!-- Hapus link CSS preview -->
    <!-- <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"> -->

    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <!-- Hapus script preview -->
    <!-- <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script> -->
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
                // Hapus plugin preview dari register
                // FilePondPluginImagePreview,
                FilePondPluginImageResize,
                FilePondPluginImageTransform
            );

            const existingImage = document.querySelector('#image').dataset.existing;

            FilePond.create(document.querySelector('#image'), {
                // Nonaktifkan preview
                allowImagePreview: false,
                allowImageResize: true,
                imageResizeTargetWidth: 400,
                imageResizeTargetHeight: 600,
                imageResizeMode: 'cover',
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
                maxFileSize: '2MB',
                storeAsFile: true,
                required: false,

                // preload gambar lama jika ada

            });
        });
    </script>

</x-layout>
