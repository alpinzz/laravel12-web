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
                                        <input class="form-control" type="file" name="image" id="image">
                                    </div>
                                </div>
                                @if ($blog->image)
                                    <div class="form-group mb-3">
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="">
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
</x-layout>
