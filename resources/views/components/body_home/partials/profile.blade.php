<div class="mt-5">
    <div class="lonyo-section-title center">
        <h3>Pimpinan Komisariat AR Fachruddin</h3>
    </div>

    <section class="lonyo-cta-section bg-heading py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10" data-aos="fade-up" data-aos-duration="700">
                    <div class="ratio ratio-16x9">
                        @if ($video && $video->yt_url)
                            <iframe src="{{ $video->embed_url }}" title="video profile" allowfullscreen></iframe>
                        @else
                            <div class="text-center text-muted">
                                <p>Belum ada video profile</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
