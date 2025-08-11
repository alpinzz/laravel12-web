<x-layout :title="$title">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">About</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">About Us</h5>
            </div>

            <div class="card-body">



                <div class="mb-3 d-flex justify-content-end">

                    @if (!$about)
                        {{-- Kalau belum ada data About --}}
                        <a href="{{ route('admin.about.create') }}" class="btn btn-primary">
                            + Tambah
                        </a>
                    @else
                        {{-- Kalau sudah ada data About --}}
                        <a href="#" class="btn btn-primary" id="btn-alert-about">
                            + Tambah
                        </a>
                    @endif


                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">Judul</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Konten</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($about)
                                <tr>
                                    {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                    <td>{{ $about->title }}</td>
                                    <td>
                                        @if ($about->image)
                                            <img src="{{ asset('storage/' . $about->image) }}" alt=""
                                                width="150px">
                                        @else
                                            Tidak ada gambar
                                        @endif
                                    </td>
                                    <td>{!! Str::limit(strip_tags($about->description), 50) !!}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.about.edit') }}"
                                            role="button">Edit</a>
                                        <form action="{{ route('admin.about.delete') }}" method="POST"
                                            id="delete-form-{{ $about->id }}" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $about->id }})">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('btn-alert-about')?.addEventListener('click', function(event) {
            event.preventDefault(); // stop link agar tidak pindah halaman

            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'About sudah ada!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                confirmButtonText: 'OK',
                allowOutsideClick: false, // klik luar tidak menutup
                allowEscapeKey: false // ESC tidak menutup
            });
        });
    </script>


    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

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
