<x-homelayout>

    <div class="breadcrumb-wrapper light-bg">
        <div class="container">

            <div class="breadcrumb-content">
                <h1 class="breadcrumb-title pb-0">Galeri</h1>
                <div class="breadcrumb-menu-wrapper">
                    <div class="breadcrumb-menu-wrap">
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><img src="{{ asset('frontend/assets/images/blog/right-arrow.svg') }}"
                                        alt="right-arrow"></li>
                                <li aria-current="page">Galeri</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="lonyo-section-padding10">
        <div class="container">
            <div class="row">

                @foreach ($galleries as $gallery)
                    <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="lonyo-about-us-wrap aos-init aos-animate"
                            data-aos="{{ ['fade-up', 'zoom-in', 'fade-left'][rand(0, 2)] }}"
                            data-aos-duration="{{ rand(500, 1000) }}">
                            <div class="lonyo-about-us-thumb">
                                <a href="{{ asset('storage/' . $gallery->image) }}" class="glightbox">
                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                zoomable: true,
                autoplayVideos: true
            });
        });
    </script>



</x-homelayout>
