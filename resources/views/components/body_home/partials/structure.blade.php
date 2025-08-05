@props(['members'])

<div class="lonyo-section-padding4">
    <div class="container mt-4">
        <div class="lonyo-section-title center">
            <h2>Pimpinan Harian</h2>
        </div>

        <div class="row">
            @forelse ($members as $member)
                <!-- Card 1 -->
                <div class="col-lg-4 col-md-6 col-12 mb-4 px-4">
                    <div class="card border-0 bg-light">
                        <img src="{{ $member->image ? asset('storage/' . $member->image) : asset('upload/no_image.jpg') }}"
                            alt="{{ $member->image }}" class="object-fit-cover rounded" style="height: 290px" />
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $member->position }}</h5>
                            <p class="card-text">
                                {{ $member->name }}
                            </p>

                        </div>
                    </div>
                </div>

            @empty
                <div class="col-lg-4 col-md-6 col-12 mb-4 px-4">
                    <div class="card border-0 bg-light">
                        <img src="{{ asset('frontend/assets/img/team/no-image.jpg') }}" alt=""
                            class="object-fit-cover rounded" style="height: 290px">
                        <div class="card-body text-center">
                            <h5 class="card-title">Ketua Umum</h5>
                            <p class="card-title">Nama</p>
                        </div>
                    </div>
                </div>
            @endforelse


        </div>
        <div class="faq-btn" data-aos="fade-up" data-aos-duration="700">
            <a class="lonyo-default-btn faq-btn2 btn-sm" href="{{ route('all.structure') }}">Selengkapnya...</a>
        </div>

    </div>
</div>
