<x-layout :title="$title">
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Video Profile</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Video Profile</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="video-form" action="{{ route('admin.video.update', $video->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label class="form-label">URL Video (YouTube)</label>
                                    <input type="url" id="yt_url" name="yt_url"
                                        value="{{ old('yt_url', $video->yt_url) }}" class="form-control" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ route('admin.video') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CDN JustValidate --}}
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>

    <script>
        const validation = new JustValidate('#video-form', {
            errorFieldCssClass: 'is-invalid',
            errorLabelStyle: {
                color: '#dc3545',
                fontSize: '14px',
            },
        });

        validation
            .addField('#yt_url', [{
                    rule: 'required',
                    errorMessage: 'URL wajib diisi',
                },
                {
                    validator: (value) => {
                        const pattern = /^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[\w\-]{11}/;
                        return pattern.test(value);
                    },
                    errorMessage: 'Masukkan link YouTube yang valid',
                },
            ])
            .onSuccess((event) => {
                event.target.submit();
            });
    </script>
</x-layout>
