<section class="lonyo-section-padding6">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 w-30">
                <div class="lonyo-content-thumb" data-aos="fade-up" data-aos-duration="700">
                    <img class="object-fit-cover w-100"
                        src="{{ $about && $about->image ? asset('storage/' . $about->image) : asset('frontend/assets/img/about.jpg') }}"
                        alt="" />
                </div>
            </div>
            <div class="col-lg-7 d-flex pt-4 w-5">
                <div class="lonyo-default-content pl-30" data-aos="fade-up" data-aos-duration="700">
                    <h2>{{ $about->title }}</h2>
                    <p class="data">
                        {!! $about->description !!}
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>
