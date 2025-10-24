<header class="site-header lonyo-header-section bg-white" id="sticky-menu">
    <div class="container">
        <div class="row gx-3 align-items-center justify-content-between">
            <div class="col-8 col-sm-auto">
                <div class="header-logo1">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('frontend/assets/images/logo/logo-header-ar.png') }}" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="lonyo-main-menu-item">
                    <nav class="main-menu menu-style1 d-none d-lg-block menu-left">
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
                    </nav>
                </div>
            </div>
            <div class="col-auto d-flex align-items-center">
                <div class="lonyo-header-info-wraper2">

                    @auth
                        <div class="lonyo-header-info-content">
                            <ul>
                                @if (Auth::user()->role === 'admin')
                                    <li><a href="{{ route('admin.dashboard') }}" target="_blank">Dashboard</a></li>
                                @elseif(Auth::user()->role === 'author')
                                    <li><a href="{{ route('author.dashboard') }}" target="_blank">Dashboard</a></li>
                                @endif
                            </ul>
                        </div>
                    @else
                        <div class="lonyo-header-info-content">
                            <ul>
                                <li><a href="{{ route('login') }}" target="_blank">Log in</a></li>
                            </ul>
                        </div>
                    @endauth


                </div>
                <div class="lonyo-header-menu">
                    <nav class="navbar site-navbar justify-content-between">
                        <!-- Brand Logo-->
                        <!-- mobile menu trigger -->
                        <button class="lonyo-menu-toggle d-inline-block d-lg-none">
                            <span></span>
                        </button>
                        <!--/.Mobile Menu Hamburger Ends-->
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
