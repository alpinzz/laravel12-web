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
                <h5 class="card-title mb-0">Visi & Misi</h5>
            </div>

            <div class="card-body">



                <div class="mb-3 d-flex justify-content-end">

                    @if (!$data)
                        {{-- Kalau belum ada data About --}}
                        <a href="{{ route('visi.misi.create') }}" class="btn btn-primary">
                            + Tambah
                        </a>
                    @else
                        <a class="btn btn-primary" id="btn-alert-about">
                            + Tambah
                        </a>
                    @endif


                </div>

                @if (is_null($data))
                    <div class="alert alert-warning">Belum ada data visi & misi.</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">Misi</th>
                                <th scope="col">Visi</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($data)
                                <tr>
                                    <td>{{ $data->vision }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($data->missions as $misi)
                                                <li>{{ $misi }}</li>
                                            @endforeach
                                        </ul>

                                    </td>
                                    <td>
                                        @if ($data->image)
                                            <img src="{{ asset('storage/' . $data->image) }}" alt=""
                                                width="120px">
                                        @else
                                            Tidak ada gambar
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('visi.misi.edit') }}"
                                            role="button">Edit</a>
                                        <form action="{{ route('visi.misi.delete') }}" method="POST"
                                            id="delete-form-{{ $data->id }}" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $data->id }})">Hapus</button>
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
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Visi & Misi sudah ada!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: "{{ html_entity_decode(session('warning')) }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif



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
