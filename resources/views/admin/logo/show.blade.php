{{-- <x-layout :title="$title">
    <div class="container-xxl py-3">
        <h4>Logo Bidang: {{ $divisi->name }}</h4>

        <div class="card mb-3">
            @if ($divisi->logo)
                <img src="{{ asset('storage/' . $divisi->logo) }}" class="card-img-top"
                    style="max-height:200px; object-fit:contain;">
            @else
                <img src="https://via.placeholder.com/300x150?text=No+Logo" class="card-img-top">
            @endif
            <div class="card-body">
                <a href="{{ route('admin.logo.form', $divisi) }}" class="btn btn-primary">
                    {{ $divisi->logo ? 'Ganti Logo' : 'Unggah Logo' }}
                </a>
            </div>
        </div>
    </div>
</x-layout> --}}

{{-- <x-layout :title="$title">
    <div class="container-xxl py-3">
        <h4>Detail Logo Bidang: {{ $divisi->name }}</h4>

        <div class="card mb-3" style="max-width: 400px;">
            @if ($divisi->logoBidang && $divisi->logoBidang->logo)
                <img src="{{ asset('storage/' . $divisi->logoBidang->logo) }}" class="card-img-top"
                    style="max-height:200px; object-fit:contain;">
            @else
                <img src="https://via.placeholder.com/300x200?text=No+Logo" class="card-img-top">
            @endif
            <div class="card-body">
                <a href="{{ route('admin.logo.form', $divisi) }}" class="btn btn-primary">
                    {{ $divisi->logoBidang ? 'Ganti Logo' : 'Unggah Logo' }}
                </a>
            </div>
        </div>

        <a href="{{ route('admin.logo') }}" class="btn btn-secondary">Kembali</a>
    </div>
</x-layout> --}}


<x-layout :title="$title">
    <div class="container-xxl py-3">
        <h4>{{ $divisi->name }} - Logo Bidang</h4>
        @if ($divisi->logoBidang && $divisi->logoBidang->logo)
            <img src="{{ asset('storage/' . $divisi->logoBidang->logo) }}" style="max-height:200px;">
        @else
            <p>Belum ada logo untuk bidang ini.</p>
        @endif
        <div class="mt-3">
            <a href="{{ route('admin.logo.form', $divisi->id) }}" class="btn btn-primary">
                {{ $divisi->logoBidang ? 'Ganti Logo' : 'Unggah Logo' }}
            </a>
            <a href="{{ route('admin.logo') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</x-layout>
