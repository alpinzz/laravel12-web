<x-layout :title="$title">
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Slider</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Slider</h5>
            </div><!-- end card header -->

            <div class="card-body">

                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">
                        + Tambah
                    </a>
                </div>

                @if ($sliders->isEmpty())
                    <div class="alert alert-warning">Belum ada data gambar slider.</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>

                                        <img class="img-fluid rounded" src="{{ asset('storage/' . $slider->image) }}"
                                            alt="" style="max-width: 60px; height: auto;">

                                    </td>

                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.slider.edit', $slider->id) }}" role="button">Edit</a>
                                        <form action="{{ route('admin.slider.delete', $slider->id) }}" method="POST"
                                            id="delete-form-{{ $slider->id }}" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $slider->id }})">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-layout>
