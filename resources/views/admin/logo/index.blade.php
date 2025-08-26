<x-layout :title="$title">
    <div class="container-xxl py-3">
        <h4>Logo Bidang</h4>
        <div class="row">
            @foreach ($divisis as $divisi)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        @if ($divisi->logoBidang && $divisi->logoBidang->logo)
                            <img src="{{ asset('storage/' . $divisi->logoBidang->logo) }}" class="card-img-top"
                                style="max-height:150px; object-fit:contain;">
                        @else
                            <img src="https://via.placeholder.com/300x150?text=No+Logo" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $divisi->name }}</h5>

                            <a href="{{ route('admin.logo.form', $divisi) }}" class="btn btn-primary">
                                {{ $divisi->logoBidang ? 'Ganti Logo' : 'Unggah Logo' }}
                            </a>

                            @if ($divisi->logoBidang && $divisi->logoBidang->logo)
                                <form action="{{ route('admin.logo.delete', $divisi) }}"
                                    id="delete-form-{{ $divisi->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $divisi->id }})"
                                        class="btn btn-danger">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach
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
