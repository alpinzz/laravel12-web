<x-layout :title="$title">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Video Profile</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Video YouTube</h5>
            </div>

            <div class="card-body">

                <div class="mb-3 d-flex justify-content-end">
                    @if (!$video)
                        <a href="{{ route('admin.video.create') }}" class="btn btn-primary">
                            + Tambah
                        </a>
                    @else
                        <a class="btn btn-primary" id="btn-alert-video">
                            + Tambah
                        </a>
                    @endif
                </div>

                @if (is_null($video))
                    <div class="alert alert-warning">Belum ada video ditambahkan.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Video</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @php
                                            function getYoutubeId($url)
                                            {
                                                // regex untuk youtube
                                                preg_match(
                                                    '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i',
                                                    $url,
                                                    $matches,
                                                );
                                                return $matches[1] ?? null;
                                            }

                                            $videoId = getYoutubeId($video->yt_url);
                                        @endphp

                                        @if ($videoId)
                                            <div class="ratio ratio-16x9">
                                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                                    allowfullscreen></iframe>
                                            </div>
                                        @else
                                            <p class="text-danger">Link YouTube tidak valid</p>
                                        @endif

                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.video.edit', $video->id) }}">Edit</a>
                                        <form action="{{ route('admin.video.delete', $video->id) }}" method="POST"
                                            id="delete-form-{{ $video->id }}" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $video->id }})">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script>
        document.getElementById('btn-alert-video')?.addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Video sudah ada! Silakan edit jika ingin mengubah.',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin hapus?',
                text: "Video akan dihapus permanen!",
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
