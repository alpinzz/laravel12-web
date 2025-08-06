<x-layout>
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
                            <div class="form-group mb-3 row">
                                <label for="image" class="form-label">Gambar</label>
                                <input type="file" name="image" id="image" class="form-control">
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
</x-layout>
