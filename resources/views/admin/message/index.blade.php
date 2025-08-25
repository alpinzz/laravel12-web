<x-layout :title="$title">
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Message</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Kotak Masuk</h5>
            </div>

            <div class="card-body">


                {{-- @if ($blogs->isEmpty())
                    <div class="alert alert-warning">Belum ada postingan blog.</div>
                @endif --}}

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Pesan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}
                                    </td>
                                    <td>{{ $message->message }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.message.show', $message->id) }}"
                                            role="button">Detail</a>
                                        <form action="{{ route('admin.message.delete', $message->id) }}" method="POST"
                                            id="delete-form-{{ $message->id }}" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $message->id }})">Hapus</button>
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
