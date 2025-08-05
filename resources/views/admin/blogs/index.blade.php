<x-layout>
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Blogs</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Blogs</h5>
            </div><!-- end card header -->

            <div class="card-body">

                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                        + Tambah
                    </a>
                </div>

                @if ($blogs->isEmpty())
                    <div class="alert alert-warning">Belum ada postingan blog.</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Konten</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($blogs as $blog)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ Str::limit(strip_tags($blog->title), 15) }}</td>
                                    <td>
                                        @if ($blog->image)
                                            <img class="img-fluid rounded" src="{{ asset('storage/' . $blog->image) }}"
                                                alt="" style="max-width: 60px; height: auto;">
                                        @else
                                            <span class="text-muted">Tidak ada gambar.</span>
                                        @endif
                                    </td>
                                    <td>
                                        {!! Str::limit(strip_tags($blog->content), 50) !!}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.blogs.edit', $blog->id) }}" role="button">Edit</a>
                                        <form action="{{ route('admin.blogs.delete', $blog->id) }}" method="POST"
                                            id="delete-form-{{ $blog->id }}" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $blog->id }})">Hapus</button>
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

    <!-- SweetAlert -->


</x-layout>
