<x-layout :title="$title">
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Edit Visi & Misi</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('visi.misi.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Visi -->
                    <div class="mb-3">
                        <label class="form-label">Visi</label>
                        <textarea class="form-control" rows="3" name="vision" required>{{ old('vision', $data->vision) }}</textarea>
                    </div>

                    <!-- Misi -->
                    <div class="mb-3">
                        <label class="form-label">Misi</label>
                        <div id="misions-wrapper">
                            @foreach ($data->missions as $misi)
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="missions[]"
                                        value="{{ $misi }}" required>
                                    <button type="button" class="btn btn-danger remove-misi">X</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-primary btn-sm" id="add-misi">+ Tambah Misi</button>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="image">
                        @if ($data->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $data->image) }}" alt="Preview" class="img-thumbnail"
                                    style="max-height: 200px;">
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Tambah field misi
        document.getElementById('add-misi').addEventListener('click', function() {
            const wrapper = document.getElementById('misions-wrapper');
            const newField = document.createElement('div');
            newField.classList.add('input-group', 'mb-2');
            newField.innerHTML = `
                <input type="text" class="form-control" name="missions[]" placeholder="Masukkan misi" required>
                <button type="button" class="btn btn-danger remove-misi">X</button>
            `;
            wrapper.appendChild(newField);
        });

        // Hapus field misi
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-misi')) {
                e.target.parentElement.remove();
            }
        });
    </script>
</x-layout>
