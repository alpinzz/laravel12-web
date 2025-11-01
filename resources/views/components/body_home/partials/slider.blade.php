<div class="class=container-fluid px-0 mt-md-0 mt-5">

    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">

            @forelse ($sliders as $slider)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $loop->index }}"
                    class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}"
                    aria-label="Slide {{ $loop->iteration }}"></button>

            @empty
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1">
                </button>
            @endforelse
        </div>
        <div class="carousel-inner">

            @forelse ($sliders as $slider)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ url('storage/' . $slider->image) }}" class="d-block w-100" alt="carousel">

                </div>

            @empty
                <div class="carousel-item active">
                    <img src="{{ asset('frontend/assets/img/hero-carousel/no-photo.png') }}" class="d-block w-100"
                        alt="">
                </div>
            @endforelse
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
