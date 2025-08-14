<x-homelayout>
    <div class="breadcrumb-wrapper light-bg">
        <div class="container">
            <div class="breadcrumb-content">
                <h1 class="breadcrumb-title pb-0">Tentang Kami</h1>
                <div class="breadcrumb-menu-wrapper">
                    <div class="breadcrumb-menu-wrap">
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><img src="{{ asset('frontend/assets/images/blog/right-arrow.svg') }}"
                                        alt="right-arrow"></li>
                                <li aria-current="page">Tentang Kami</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section About --}}
    <div class="lonyo-section-padding3">
        <div class="container">
            @if ($about)
                <div class="row">
                    <div class="col-lg-5">
                        <div class="lonyo-about-us-thumb2 pr-lg-4" data-aos="fade-up" data-aos-duration="700">
                            <img src="{{ $about->image ? asset('storage/' . $about->image) : asset('frontend/assets/img/about.jpg') }}"
                                alt="IMM" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="lonyo-default-content h-100 d-flex flex-column justify-content-start"
                            data-aos="fade-up" data-aos-duration="900">
                            <h2 class="mb-1">{{ $about->title }}</h2>
                            <p class="text-muted small">{!! $about->description !!}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center text-muted py-5">
                    Coming Soon.
                </div>
            @endif
        </div>
    </div>

    {{-- Section Visi Misi --}}
    <div class="lonyo-section-padding3 bg-light mb-5">
        <div class="container">
            @if ($visiMisi)
                <div class="row align-items-center">
                    <div class="col-lg-7 order-lg-1 order-2">
                        <div class="lonyo-default-content visi pe-lg-4" data-aos="fade-up" data-aos-duration="900">
                            <div class="mb-5">
                                <h4 class="mb-3">Visi</h4>
                                <p>{{ $visiMisi->vision }}</p>
                            </div>
                            <div>
                                <h4 class="mb-3">Misi</h4>
                                @if (!empty($visiMisi->missions))
                                    <ul class="list-unstyled">
                                        @foreach ($visiMisi->missions as $misi)
                                            <li class="mb-2"><i
                                                    class="fas fa-check-circle text-primary me-2"></i>{{ $misi }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted">Misi belum ada.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 order-lg-2 order-1 mb-4 mb-lg-0">
                        <div class="lonyo-about-us-thumb2" data-aos="fade-up" data-aos-duration="700">
                            <img src="{{ $visiMisi->image ? asset('storage/' . $visiMisi->image) : asset('frontend/assets/images/about-us/img7.png') }}"
                                alt="Visi Misi IMM" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center text-muted py-5">
                    Coming Soon.
                </div>
            @endif
        </div>
    </div>

    {{-- Section Logo Bidang --}}
    <div class="lonyo-section-padding10 team-section">
        <div class="container">
            <div class="lonyo-section-title center max-width-750">
                <h2>Bidang-bidang</h2>
            </div>
            <div class="row">
                @forelse ($logo as $item)
                    <div class="col-lg-3 col-md-6">
                        <div class="lonyo-team-wrap" data-aos="fade-up" data-aos-duration="700">
                            <div class="lonyo-team-thumb">
                                <img src="{{ asset('storage/' . $item->logo) }}" alt="">
                            </div>
                            <div class="lonyo-team-content">
                                <p>{{ $item->divisi->name }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        Data logo bidang belum ada.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-homelayout>



{{-- <x-homelayout>
    <div class="breadcrumb-wrapper light-bg">
        <div class="container">
            <div class="breadcrumb-content">
                <h1 class="breadcrumb-title pb-0">Tentang Kami</h1>
                <div class="breadcrumb-menu-wrapper">
                    <div class="breadcrumb-menu-wrap">
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><img src="{{ asset('frontend/assets/images/blog/right-arrow.svg') }}"
                                        alt="right-arrow"></li>
                                <li aria-current="page">Tentang Kami</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lonyo-section-padding3">


        <div class="container">
            <div class="row">
                <!-- Kolom Gambar -->
                <div class="col-lg-5">
                    <div class="lonyo-about-us-thumb2 pr-lg-4 aos-init aos-animate" data-aos="fade-up"
                        data-aos-duration="700">
                        <img src="{{ $about && $about->image ? asset('storage/' . $about->image) : asset('frontend/assets/img/about.jpg') }}"
                            alt="IMM" class="img-fluid">
                    </div>
                </div>

                <!-- Kolom Teks -->
                <div class="col-lg-7">
                    <div class="lonyo-default-content h-100 d-flex flex-column justify-content-start aos-init aos-animate"
                        data-aos="fade-up" data-aos-duration="900">
                        <h2 class="mb-1">{{ $about->title }}</h2>
                        <p class="text-muted small">{!! $about->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Visi Misi -->
    <div class="lonyo-section-padding3 bg-light mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 order-lg-1 order-2">
                    <div class="lonyo-default-content visi pe-lg-4 aos-init aos-animate" data-aos="fade-up"
                        data-aos-duration="900">
                        <div class="mb-5">
                            <h4 class="mb-3">Visi</h4>
                            <p>{{ $visiMisi->vision }}</p>
                        </div>

                        <div>
                            <h4 class="mb-3">Misi</h4>
                            <ul class="list-unstyled">
                                @foreach ($visiMisi->missions as $misi)
                                    <li class="mb-2"><i
                                            class="fas fa-check-circle text-primary me-2"></i>{{ $misi }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 order-lg-2 order-1 mb-4 mb-lg-0">
                    <div class="lonyo-about-us-thumb2 aos-init aos-animate" data-aos="fade-up" data-aos-duration="700">
                        <img src="{{ $visiMisi->image ? asset('storage/' . $visiMisi->image) : asset('frontend/assets/images/about-us/img7.png') }}"
                            alt="Visi Misi IMM" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lonyo-section-padding10 team-section">
        <div class="shape">
            <img src="assets/images/about-us/shape1.svg" alt="">
        </div>
        <div class="container">
            <div class="lonyo-section-title center max-width-750">
                <h2>Bidang-bidang</h2>
            </div>
            <div class="row">
                @foreach ($logo as $item)
                    <div class="col-lg-3 col-md-6">
                        <div class="lonyo-team-wrap aos-init aos-animate" data-aos="fade-up" data-aos-duration="700">
                            <div class="lonyo-team-thumb">
                                <img src="{{ asset('storage/' . $item->logo) }}" alt="">
                            </div>
                            <div class="lonyo-team-content">

                                <p>{{ $item->divisi->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-homelayout> --}}
