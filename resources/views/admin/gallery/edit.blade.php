<x-layout :title="$title">
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h5>Edit Gambar</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label><br>
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Gambar" width="200">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-layout>
