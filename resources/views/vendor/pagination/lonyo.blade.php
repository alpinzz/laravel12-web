@if ($paginator->hasPages())
    <div class="lonyo-pagination center">
        {{-- Tombol kiri --}}
        <a class="pagi-btn btn2 {{ $paginator->onFirstPage() ? 'disabled' : '' }}"
            href="{{ $paginator->previousPageUrl() ?? '#' }}" aria-label="Previous">
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.75 0.75L6 6L0.75 11.25" stroke="#001A3D" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>

        <ul>
            @foreach ($elements as $element)
                {{-- Jika berupa titik (separator) --}}
                @if (is_string($element))
                    <li><span>{{ $element }}</span></li>
                @endif

                {{-- Link halaman --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="current" href="#">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>

        {{-- Tombol kanan --}}
        <a class="pagi-btn {{ $paginator->hasMorePages() ? '' : 'disabled' }}"
            href="{{ $paginator->nextPageUrl() ?? '#' }}" aria-label="Next">
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.75 0.75L6 6L0.75 11.25" stroke="#001A3D" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
    </div>
@endif
