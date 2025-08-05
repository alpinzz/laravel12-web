<x-layout>

    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Slider</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Tambah Slider</h5>
                </div><!-- end card header -->

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ route('admin.slider.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3 row">
                                    <label class="form-label">Profile Photo</label>
                                    <div class="col-lg-12 col-xl-12">
                                        <input class="form-control" type="file" name="image" id="image">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="#" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
