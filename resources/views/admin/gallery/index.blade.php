<x-layout :title='$title'>
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Gallery</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Gallery</h5>
            </div><!-- end card header -->

            <div class="card-body">

                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                        + Tambah
                    </a>
                </div>


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

                            @foreach ($galleries as $gallery)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>

                                        <img class="img-fluid rounded" src="{{ asset('storage/' . $gallery->image) }}"
                                            alt="" style="max-width: 60px; height: auto;">

                                    </td>

                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.gallery.edit', $gallery->id) }}"
                                            role="button">Edit</a>
                                        <form id="delete-form-{{ $gallery->id }}"
                                            action="{{ route('admin.gallery.delete', $gallery->id) }}" method="POST"
                                            style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $gallery->id }})">Hapus</button>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin hapus?',
                text: "Gambar akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>


</x-layout>
