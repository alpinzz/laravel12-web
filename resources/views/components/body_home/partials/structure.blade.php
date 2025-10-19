@props(['members'])

<div class="lonyo-section-padding4">
    <div class="container mt-4">
        <div class="lonyo-section-title center">
            <h2>Pimpinan Harian</h2>
        </div>

        <div class="row">
            @forelse ($members as $member)
                <div class="col-lg-4 col-md-6 col-12 mb-4 px-4">
                    <div class="card border-0 bg-light text-center">
                        <div class="p-3">
                            <img src="{{ $member->image ? asset('storage/' . $member->image) : asset('upload/no_image.jpg') }}"
                                alt="{{ $member->image }}" class="rounded mx-auto d-block"
                                style="width: 200px; height: 200px; object-fit: contain;" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $member->position }}</h5>
                            <p class="card-text">
                                {{ $member->name }}
                            </p>
                        </div>
                    </div>
                </div>

            @empty
                <!-- <div class="col-lg-4 col-md-6 col-12 mb-4 px-4">
                    <div class="card border-o bg-light overflow-hidden">
                        <img src="{{ asset('frontend/assets/img/team/no-image.jpg') }}" alt=""
                            class="object-cover rounded-2xl" style="height: 290px">
                        <div class="card-body text-center">
                            <h5 class="card-title">Ketua Umum</h5>
                            <p class="card-title">Nama</p>
                        </div>
                    </div>
                </div> -->
                <div class="card border-0 bg-light overflow-hidden rounded-2xl">
                    <img src="{{ asset('frontend/assets/img/team/no-image.jpg') }}" alt=""
                        style="height: 290px; width:100%; border-radius: 1rem; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Ketua Umum</h5>
                        <p class="card-title">Nama</p>
                    </div>
                </div>
            @endforelse


        </div>
        <div class="faq-btn" data-aos="fade-up" data-aos-duration="700">
            <a class="lonyo-default-btn faq-btn2 btn-sm" href="{{ route('all.structure') }}">Selengkapnya...</a>
        </div>

    </div>
</div>
