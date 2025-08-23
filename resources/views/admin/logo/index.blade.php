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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
