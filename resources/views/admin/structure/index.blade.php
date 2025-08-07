<x-layout :title="$title">
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Struktur {{ $division->name }}</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ $division->name }}</h5>
            </div><!-- end card header -->

            <div class="card-body">

                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('admin.structure.create', ['slug' => $division->slug]) }}" class="btn btn-primary">
                        + Tambah
                    </a>
                </div>

                @if ($members->isEmpty())
                    <div class="alert alert-warning">Belum ada data struktur.</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($members as $member)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->position }}</td>
                                    <td>
                                        @if ($member->image)
                                            <img class="img-fluid rounded"
                                                src="{{ asset('storage/' . $member->image) }}" alt=""
                                                style="max-width: 60px; height: auto;">
                                        @else
                                            <em>Tidak ada foto</em>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.structure.edit', ['slug' => $division->slug, 'id' => $member->id]) }}"
                                            role="button">Edit</a>
                                        <form
                                            action="{{ route('admin.structure.delete', ['slug' => $division->id, 'id' => $member->id]) }}"
                                            method="POST" id="delete-form-{{ $member->id }}" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $member->id }})">Hapus</button>
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
