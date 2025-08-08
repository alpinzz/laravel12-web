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
                    <h5 class="card-title mb-0">Tambah Blogs</h5>
                </div><!-- end card header -->

                <div class="card-body">

                    <div class="row">

                        <div class="col-12">
                            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data"
                                id="myForm">
                                @csrf


                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" id="title" name="title" class="form-control">
                                    <div class="mt-3">
                                        <label for="example-select" class="form-label">Kategori</label>
                                        <select class="form-select" id="category" name="category_id">

                                            <option value="" disabled selected>Pilih Kategori</option>

                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="form-label">Profile Photo</label>
                                    <div class="col-lg-12 col-xl-12">
                                        <input class="form-control" type="file" name="image" id="image">
                                    </div>
                                </div>

                                @auth
                                    @if (Auth::user()->role === 'admin')
                                        <div class="mb-3">
                                            <label for="divisi_id">Bidang</label>
                                            <select name="divisi_id" id="divisi_id" class="form-select">

                                                <option value="" disabled selected>Pilih Bidang</option>
                                                @foreach ($divisions as $divisi)
                                                    <option value="{{ $divisi->id }}">{{ $divisi->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <input type="hidden" name="divisi_id" value="{{ Auth::user()->division }}">
                                    @endif
                                @endauth

                                <label for="content" class="form-label">Konten</label>
                                <div id="quill-editor" class="mb-3" style="height: 250px; width: 100%;"></div>
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
