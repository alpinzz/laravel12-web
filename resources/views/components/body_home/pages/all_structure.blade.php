<x-homelayout>
    <div class="breadcrumb-wrapper light-bg mb-5">
        <div class="container">

            <div class="breadcrumb-content">
                <h1 class="breadcrumb-title pb-0">Struktur Organisasi</h1>
                <div class="breadcrumb-menu-wrapper">
                    <div class="breadcrumb-menu-wrap">
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><img src="{{ asset('frontend/assets/images/blog/right-arrow.svg') }}"
                                        alt="right-arrow"></li>
                                <li aria-current="page">Struktur Organisasi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="container">
        @foreach ($divisions as $division)
            <div class="lonyo-section-title center max-width-750">
                <h2>{{ $division->name }}</h2>
            </div>
            <div class="row justify-content-center">
                @forelse ($division->structures as $member)
                    <div class="col-6 col-md-6 col-lg-3">
                        <div class="lonyo-team-wrap aos-init aos-animate" data-aos="fade-up" data-aos-duration="500">
                            <div class="lonyo-team-thumb">
                                <img src="{{ $member->image ? asset('storage/' . $member->image) : asset('frontend/assets/images/about-us/img1.png') }}"
                                    alt="{{ $member->name }}">
                            </div>
                            <div class="lonyo-team-content">

                                <h4>{{ $member->name }}</h4>
                                <p class="font-semibold text-sm">{{ $member->position }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-danger">Belum ada anggota di divisi ini.</p>
                @endforelse
            </div>
        @endforeach

    </div>
</x-homelayout>
