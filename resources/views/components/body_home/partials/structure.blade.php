@props(['members'])

<div class="lonyo-section-padding4">
    <div class="container mt-4">
        <div class="lonyo-section-title center">
            <h2>Pimpinan Harian</h2>
        </div>
        {{-- <div class="container"> --}}

        <div class="row">
            @foreach ($members as $member)
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
            @endforeach

            {{-- <div class="col-lg-4 col-md-6 col-12 mb-4 px-4">
                <div class="card border-0 bg-light">
                    <img src="https://mdbcdn.b-cdn.net/wp-content/uploads/2020/06/vertical.webp"
                        alt="Trendy Pants and Shoes" class="object-fit-cover rounded" style="height: 290px" />
                    <div class="card-body text-center">
                        <h5 class="card-title">Sekretaris Umum</h5>
                        <p class="card-text">
                            Nama
                        </p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-4 px-4">
                <div class="card border-0 bg-light">
                    <img src="https://mdbcdn.b-cdn.net/wp-content/uploads/2020/06/vertical.webp"
                        alt="Trendy Pants and Shoes" class="object-fit-cover rounded" style="height: 290px" />
                    <div class="card-body text-center">
                        <h5 class="card-title">Bendahara Umum</h5>
                        <p class="card-text">
                            Nama
                        </p>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="faq-btn" data-aos="fade-up" data-aos-duration="700">
            <a class="lonyo-default-btn faq-btn2 btn-sm" href="{{ route('all.structure') }}">Selengkapnya...</a>
        </div>
        {{-- </div> --}}



        {{-- <div class="lonyo-faq-shape"></div> --}}
        {{-- <div class="lonyo-faq-wrap1">
            <div class="lonyo-faq-item item2 open" data-aos="fade-up" data-aos-duration="500">
                <div class="lonyo-faq-header">
                    <h4>Is my financial data safe and secure?</h4>
                    <div class="lonyo-active-icon">
                        <img class="plasicon" src="assets/images/v1/mynus.svg" alt="" />
                        <img class="mynusicon" src="assets/images/v1/plas.svg" alt="" />
                    </div>
                </div>
                <div class="lonyo-faq-body body2">
                    <p>
                        Yes, this finance apps use bank-level encryption, multi-factor
                        authentication, and other security measures to protect your
                        sensitive information.
                    </p>
                </div>
            </div>
            <div class="lonyo-faq-item item2" data-aos="fade-up" data-aos-duration="700">
                <div class="lonyo-faq-header">
                    <h4>Can I link multiple bank accounts and credit cards?</h4>
                    <div class="lonyo-active-icon">
                        <img class="plasicon" src="assets/images/v1/mynus.svg" alt="" />
                        <img class="mynusicon" src="assets/images/v1/plas.svg" alt="" />
                    </div>
                </div>
                <div class="lonyo-faq-body body2">
                    <p>
                        Yes, this finance apps use bank-level encryption, multi-factor
                        authentication, and other security measures to protect your
                        sensitive information.
                    </p>
                </div>
            </div>
            <div class="lonyo-faq-item item2" data-aos="fade-up" data-aos-duration="900">
                <div class="lonyo-faq-header">
                    <h4>How does the app help me stick to my budget?</h4>
                    <div class="lonyo-active-icon">
                        <img class="plasicon" src="assets/images/v1/mynus.svg" alt="" />
                        <img class="mynusicon" src="assets/images/v1/plas.svg" alt="" />
                    </div>
                </div>
                <div class="lonyo-faq-body body2">
                    <p>
                        Yes, this finance apps use bank-level encryption, multi-factor
                        authentication, and other security measures to protect your
                        sensitive information.
                    </p>
                </div>
            </div>
            <div class="lonyo-faq-item item2" data-aos="fade-up" data-aos-duration="1100">
                <div class="lonyo-faq-header">
                    <h4>Can I track my investments with the app?</h4>
                    <div class="lonyo-active-icon">
                        <img class="plasicon" src="assets/images/v1/mynus.svg" alt="" />
                        <img class="mynusicon" src="assets/images/v1/plas.svg" alt="" />
                    </div>
                </div>
                <div class="lonyo-faq-body body2">
                    <p>
                        Yes, this finance apps use bank-level encryption, multi-factor
                        authentication, and other security measures to protect your
                        sensitive information.
                    </p>
                </div>
            </div>
            <div class="lonyo-faq-item item2" data-aos="fade-up" data-aos-duration="1300">
                <div class="lonyo-faq-header">
                    <h4>Is the app free, or are there subscription fees?</h4>
                    <div class="lonyo-active-icon">
                        <img class="plasicon" src="assets/images/v1/mynus.svg" alt="" />
                        <img class="mynusicon" src="assets/images/v1/plas.svg" alt="" />
                    </div>
                </div>
                <div class="lonyo-faq-body body2">
                    <p>
                        Yes, this finance apps use bank-level encryption, multi-factor
                        authentication, and other security measures to protect your
                        sensitive information.
                    </p>
                </div>
            </div>
        </div>
        <div class="faq-btn" data-aos="fade-up" data-aos-duration="700">
            <a class="lonyo-default-btn faq-btn2" href="faq.html">Can't find your answer</a>
        </div> --}}
    </div>
</div>
