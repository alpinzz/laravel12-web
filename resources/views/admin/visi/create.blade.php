<x-layout :title="$title">
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Visi & Misi</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('visi.misi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Visi -->
                    <div class="mb-3">
                        <label class="form-label">Visi</label>
                        <textarea class="form-control" rows="3" name="vision"></textarea>
                    </div>

                    <!-- Misi -->
                    <div class="mb-3">
                        <label class="form-label">Misi</label>
                        <div id="misions-wrapper">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="missions" placeholder="Masukkan misi">
                                <button type="button" class="btn btn-danger remove-misi">X</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm" id="add-misi">+ Tambah Misi</button>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="image">
                        <div class="mt-2" id="image-preview" style="display:none;">
                            <img src="" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
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

        // Preview gambar
        document.querySelector('input[type="file"]').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('image-preview');
                    preview.style.display = 'block';
                    preview.querySelector('img').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</x-layout>
