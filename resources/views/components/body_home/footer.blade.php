{{-- <footer class="lonyo-footer-section light-bg">
    <div class="container">
        <div class="lonyo-footer-one">
            <div class="row">
                <div class="col-xxl-4 col-xl-12 col-md-6">
                    <div class="lonyo-footer-textarea">
                        <a href="index.html">
                            <img src="assets/images/logo/logo-dark.svg" alt="" />
                        </a>

                        <div class="lonyo-social-wrap">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com">
                                        <i class="fa-brands fa-tiktok fa-xs" title="Tiktok"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://www.instagram.com">
                                        <i class="fa-brands fa-instagram fa-xs" title="Instagram"></i>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-4 col-md-6">
                    <div class="lonyo-footer-menu">
                        <h4>Tautan</h4>
                        <div class="lonyo-footer-menu-wrap">
                            <div class="lonyo-footer-menu1">
                                <ul>
                                    <li>
                                        <a href="index.html">Home 01</a>
                                    </li>
                                    <li>
                                        <a href="index-02.html">Home 02</a>
                                    </li>
                                    <li>
                                        <a href="index-03.html">Home 03</a>
                                    </li>
                                    <li>
                                        <a href="about-us.html">About us</a>
                                    </li>
                                    <li>
                                        <a href="contact-us.html">Contact us</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                
                <div class="col-xxl-3 col-xl-4 col-md-6">
                    <div class="lonyo-footer-menu pl-31 mb-0">

                        <div class="lonyo-subscription-field2">
                            <img src="{{ asset('frontend/assets/images/about-us/img3.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="lonyo-footer-shape"></div>
        </div>
        <div class="lonyo-footer-bottom-text">
            <p>
                © Copyright <span id="current-year"></span>, All Rights Reserved by
                Mthemeus
            </p>
        </div>
    </div>
</footer> --}}

<footer class="lonyo-footer-section light-bg">
    <div class="container">
        <div class="lonyo-footer-one">
            <div class="row justify-content-center text-center text-md-start">
                <!-- Kolom Logo dan Sosial Media -->
                <div class="col-xxl-4 col-xl-12 col-md-6 mb-4 mb-md-0">
                    <div class="lonyo-footer-textarea">
                        <a href="index.html">
                            <img src="assets/images/logo/logo-dark.svg" alt="" class="mx-auto mx-md-0" />
                        </a>
                        <div class="lonyo-social-wrap mt-3">
                            <ul class="justify-content-center justify-content-md-start">
                                <!-- Item sosial media -->
                                <li>
                                    <a href="https://www.tiktok.com/@pk_arfachruddinumpwrj" target="_blank"
                                        rel="noopener noreferrer">
                                        <i class="fa-brands fa-tiktok fa-xs" title="Tiktok"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://www.instagram.com/pk_arfachruddinumpwrj" target="_blank"
                                        rel="noopener noreferrer">
                                        <i class="fa-brands fa-instagram fa-xs" title="Instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/@pkarfachruddin" target="_blank"
                                        rel="noopener noreferrer">
                                        <i class="fa-brands fa-youtube" title="YouTube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Kolom Tautan -->
                <div class="col-xxl-3 col-xl-4 col-md-6 mb-4 mb-md-0">
                    <div class="lonyo-footer-menu">
                        <h4>Tautan</h4>
                        <div class="lonyo-footer-menu-wrap">
                            <div class="lonyo-footer-menu1">
                                <ul class="text-center text-md-start">
                                    <!-- Item tautan -->
                                    <li>
                                        <a href="{{ route('index') }}">Beranda</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('all.structure') }}">Struktur Organisasi</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about') }}">Tentang Kami</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('gallery') }}">Galeri</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('all.news') }}">Berita</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact') }}">Kontak</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Gambar -->
                <div class="col-xxl-3 col-xl-4 col-md-6">
                    <div class="lonyo-footer-menu">
                        <div class="lonyo-subscription-field2 text-center">
                            <img src="{{ asset('frontend/assets/images/about-us/img3.png') }}" alt=""
                                class="img-fluid mx-auto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="lonyo-footer-shape"></div>
        </div>
        <div class="lonyo-footer-bottom-text text-center">
            <p>
                © Copyright <span id="current-year"></span>, PK AR FACHRUDDIN
            </p>
        </div>
    </div>
</footer>
