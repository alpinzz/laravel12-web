<x-layout>

    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Struktur {{ $division->name }}</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Struktur {{ $division->name }}</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ route('admin.structure.update', $member->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="divisi_id" value="{{ $division->id }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" id="name" name="name" value="{{ $member->name }}"
                                        class="form-control">
                                    <div class="mt-3">
                                        <label for="example-select" class="form-label">Posisi</label>
                                        <select class="form-select" id="position" name="position">
                                            @foreach ($positions as $position)
                                                <option value="{{ $position }}"
                                                    {{ old('position', $member->position) == $position ? 'selected' : '' }}>
                                                    {{ $position }}</option>
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
                                @if ($member->image)
                                    <div class="form-group mb-3">
                                        <img src="{{ asset('storage/' . $member->image) }}" alt="">
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('admin.structure.index', $division->slug) }}"
                                    class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
