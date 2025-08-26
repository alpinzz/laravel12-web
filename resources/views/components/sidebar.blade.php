<div>
    <div class="app-sidebar-menu">
        <div class="h-100" data-simplebar>

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <div class="logo-box">
                    <a
                        href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('author.dashboard') }}"class="logo logo-dark">
                        <span class="logo-lg">
                            <img src="{{ asset('backend/assets/images/logo-header-ar.png') }}" alt=""
                                height="70">
                        </span>
                    </a>
                </div>

                <ul id="side-menu">

                    <li class="menu-title">Menu</li>

                    <li>
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('author.dashboard') }}"
                            class="tp-link">
                            <i data-feather="home"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>


                    <li class="menu-title">Pages</li>

                    <li>
                        <a href="#sidebarAuth" data-bs-toggle="collapse">
                            <i data-feather="users"></i>
                            <span> Struktur </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarAuth">
                            <ul class="nav-second-level">
                                @if (Auth::user()->role === 'admin')
                                    @foreach (\App\Models\Divisi::all() as $division)
                                        <li>
                                            <a href="{{ route('admin.structure.index', $division->slug) }}"
                                                class="tp-link">{{ $division->name }}</a>
                                        </li>
                                    @endforeach
                                @elseif (Auth::user()->role === 'author' && Auth::user()->divisi)
                                    <li><a href="{{ route('admin.structure.index', Auth::user()->divisi->slug) }}"
                                            class="tp-link">{{ Auth::user()->divisi->name }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="{{ route('admin.blogs.index') }}" class="tp-link">
                            <i data-feather="file-text"></i>
                            <span> Blogs </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.gallery.index') }}" class="tp-link">
                            <i data-feather="image"></i>
                            <span> Gallery </span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('admin.slider.index') }}" class="tp-link">
                            <i data-feather="sliders"></i>
                            <span> Slider </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.about.index') }}" class="tp-link">
                            <i data-feather="users"></i>
                            <span> About </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('visi.misi') }}" class="tp-link">
                            <i data-feather="globe"></i>
                            <span> Visi & Misi </span>
                        </a>
                    </li>

                    @php
                        $user = Auth::user();
                    @endphp

                    @if (!($user->role === 'author' && optional($user->divisi)->slug === 'bph'))
                        <li>
                            <a href="{{ route('admin.logo') }}" class="tp-link">
                                <i data-feather="aperture"></i>
                                <span> Logo Bidang </span>
                            </a>
                        </li>
                    @endif


                    @auth
                        @if (auth()->user()->role === 'admin')
                            <li class="menu-title mt-2">General</li>

                            <li>
                                <a href="{{ route('admin.video') }}" class="tp-link">
                                    <i data-feather="film"></i>
                                    <span> Video Profile </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.message') }}" class="tp-link">
                                    <i data-feather="mail"></i>
                                    <span> Message </span>
                                </a>
                            </li>
                        @endif
                    @endauth



                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
    </div>
</div>
