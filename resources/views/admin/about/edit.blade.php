<x-layout :title="$title">

    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">About</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Edit About</h5>
                </div><!-- end card header -->

                <div class="card-body">

                    <div class="row">

                        <div class="col-12">
                            <form action="{{ route('admin.about.update') }}" method="POST"
                                enctype="multipart/form-data" id="myForm">
                                @csrf

                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                        value="{{ old('title', $about->title) }}">

                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="form-label">Profile Photo</label>
                                    <div class="col-lg-12 col-xl-12">
                                        <input class="form-control" type="file" name="image" id="image">
                                    </div>
                                    @if (isset($about->image))
                                        <img src="{{ asset('storage/' . $about->image) }}" alt="">
                                    @endif
                                </div>


                                <label for="content" class="form-label">Konten</label>
                                <div id="quill-editor" class="mb-3" style="height: 250px; width: 100%;"></div>
                                <input type="hidden" name="description" id="service_desc"
                                    value="{{ old('title', $about->description) }}">

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Batal</a>
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

        var initialContent = document.getElementById('service_desc').value;
        quill.root.innerHTML = initialContent;

        // On form submission, update the hidden input value with the editor content
        document.getElementById('myForm').onsubmit = function() {
            document.getElementById('service_desc').value = quill.root.innerHTML;
        };
    </script>

</x-layout>
