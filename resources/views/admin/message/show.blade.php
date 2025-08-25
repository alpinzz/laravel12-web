<x-layout :title="$title">
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Detail Pesan</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $message->name }}</p>
                <p><strong>Email:</strong> {{ $message->email }}</p>
                <p><strong>Tanggal:</strong> {{ $message->created_at->format('d-m-Y H:i') }}</p>
                <p><strong>Pesan:</strong> <br> {{ $message->message }}</p>
                <a href="{{ route('admin.message') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</x-layout>
