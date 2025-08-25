<x-homelayout>

    <div class="breadcrumb-wrapper light-bg mb-5">
        <div class="container">

            <div class="breadcrumb-content">
                <h1 class="breadcrumb-title pb-0">Blogs</h1>
                <div class="breadcrumb-menu-wrapper">
                    <div class="breadcrumb-menu-wrap">
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ route('index') }}">Home</a></li>
                                <li><img src="{{ asset('frontend/assets/images/blog/right-arrow.svg') }}"
                                        alt="right-arrow"></li>
                                <li aria-current="page">Blogs{{ isset($divisi) ? '-' . $divisi->name : '' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="lonyo-section-padding9 overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    @forelse ($blogs as $blog)
                        <div class="lonyo-blog-wrap aos-init aos-animate" data-aos="fade-up" data-aos-duration="500">
                            <div class="lonyo-blog-thumb">
                                <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('frontend/assets/images/blog/b1.png') }}"
                                    alt="">
                            </div>
                            <div class="lonyo-blog-meta">
                                <ul>
                                    <li>
                                        <a
                                            href="{{ route('blog.divisi', $blog->divisi->slug) }}">{{ $blog->divisi->name ?? '-' }}</a>
                                        |
                                        {{ $blog->created_at->format('F d, Y') }}
                                    </li>

                                </ul>
                            </div>
                            <div class="lonyo-blog-content">
                                <h2><a href="{{ route('single.blog', $blog->slug) }}">{{ $blog->title }}</a></h2>
                                <p class="text-muted">{{ Str::limit(strip_tags($blog->content), 150) }}</p>
                            </div>
                            <div>
                                <a href="{{ route('single.blog', $blog->slug) }}" class="next">Selengkapnya...</a>
                            </div>
                        </div>
                    @empty
                        <span class="text-muted">belum ada postingan blogs.</span>
                    @endforelse


                </div>
                <div class="col-lg-4">
                    <div class="lonyo-blog-sidebar aos-init aos-animate" data-aos="fade-left" data-aos-duration="700">
                        <div class="lonyo-blog-widgets">
                            <form action="{{ route('search.blog') }}" method="GET">
                                <div class="lonyo-search-box">
                                    <input type="search" placeholder="Type keyword here" name="q"
                                        autocomplete="off">
                                    <button id="lonyo-search-btn" type="submit"><i class="ri-search-line"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="lonyo-blog-widgets">
                            <h4>Kategori</h4>
                            <div class="lonyo-blog-categorie">
                                @foreach ($categories as $category)
                                    <ul>
                                        <li><a
                                                href="{{ route('blog.category', $category->slug) }}">{{ $category->name }}<span>{{ $category->blogs_count }}</span></a>
                                        </li>

                                    </ul>
                                @endforeach
                            </div>
                        </div>
                        <div class="lonyo-blog-widgets">
                            <h4>Recent Posts</h4>
                            @foreach ($recentBlogs as $recent)
                                <a class="lonyo-blog-recent-post-item" href="{{ route('single.blog', $blog->slug) }}">
                                    <div class="lonyo-blog-recent-post-thumb"
                                        style="max-width: 80px; max-height: 80px; overflow: hidden;">
                                        <img style="width: 100%; height: auto; object-fit: cover;"
                                            src="{{ $recent->image ? asset('storage/' . $recent->image) : asset('frontend/assets/images/blog/b4.png') }}"
                                            alt="">
                                    </div>
                                    <div class="lonyo-blog-recent-post-data">
                                        <ul>
                                            <li>{{ $recent->created_at->format('F d, Y') }}</li>
                                        </ul>
                                        <div>
                                            <h4>{{ Str::limit($recent->title, 40) }}</h4>
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
            <div class="lonyo-pagination center">
                {{ $blogs->links('vendor.pagination.custom_paginate') }}</div>
        </div>
    </div>


</x-homelayout>
