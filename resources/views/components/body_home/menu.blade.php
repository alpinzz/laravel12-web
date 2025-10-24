<div class="lonyo-menu-wrapper">
    <div class="lonyo-menu-area text-center">
        <div class="lonyo-menu-mobile-top">
            <div class="mobile-logo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('frontend/assets/images/logo/logo-header-ar.png') }}" alt="logo" />
                </a>
            </div>
            <button class="lonyo-menu-toggle mobile">
                <i class="ri-close-line"></i>
            </button>
        </div>
        <div class="lonyo-mobile-menu">


            <ul>

                <li>
                    <a href="{{ route('index') }}">Beranda</a>
                </li>

                <li class="menu-item-has-children">
                    <a href="#">Profil</a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ route('all.structure') }}"> Sruktur Organisasi </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}"> Tentang Kami </a>
                        </li>
                    </ul>
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
