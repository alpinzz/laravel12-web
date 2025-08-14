@props(['blogs'])
<div class="lonyo-section-padding6 overflow-hidden">
    <div class="container">
        <div class="lonyo-section-title">
            <div class="lonyo-section-padding2 position-relative">
                <div class="container">
                    <div class="lonyo-section-title center">
                        <h2>Berita Terbaru</h2>
                    </div>

                    @if ($blogs->isEmpty())
                        <div class="text-center py-5">
                            <p class="text-muted">Belum ada berita nichh..</p>
                        </div>
                    @endif

                    <div class="row">

                        @foreach ($blogs as $blog)
                            <div class="col-lg-4 col-md-6 col-12 mb-4">
                                <div class="lonyo-blog-wrap" data-aos="fade-right" data-aos-duration="500">
                                    <div class="lonyo-blog-thumb">
                                        <img src="{{ asset('storage/' . ($blog->image ?? 'frontend/assets/images/blog/b11.png')) }}"
                                            alt="">
                                    </div>
                                    <div class="lonyo-blog-meta">
                                        <ul>
                                            <li>
                                                <a href="#" class="text-sm text-muted"><img
                                                        src="{{ asset('frontend/assets/images/blog/date.svg') }}"
                                                        alt="">{{ $blog->divisi->name ?? '-' }}</a> |
                                                {{ $blog->created_at->diffForHumans() }}
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="lonyo-blog-content">
                                        <a href="{{ route('single.blog', $blog->slug) }}">
                                            <h4>{{ Str::limit(strip_tags($blog->title), 30) }}</h4>
                                        </a>
                                        <p class="small">{!! Str::limit(strip_tags($blog->content), 100) !!}</p>
                                    </div>
                                    <div>
                                        <a href="{{ route('single.blog', $blog->slug) }}"
                                            class="next">Selengkapnya...</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
