@if ($paginator->hasPages())
    <nav class="lonyo-pagination center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagi-btn" aria-disabled="true">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagi-btn" rel="prev">&lsaquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @php
            $start = max(1, $paginator->currentPage() - 1);
            $end = min($paginator->lastPage(), $paginator->currentPage() + 1);
            $showEllipsisBefore = $start > 2;
            $showEllipsisAfter = $end < $paginator->lastPage() - 1;
        @endphp

        {{-- First Page --}}
        @if ($start > 1)
            <a href="{{ $paginator->url(1) }}" class="pagi-btn">1</a>
        @endif

        {{-- Ellipsis Before --}}
        @if ($showEllipsisBefore)
            <span class="pagi-btn">...</span>
        @endif

        {{-- Page Number Links --}}
        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $paginator->currentPage())
                <span class="pagi-btn current">{{ $i }}</span>
            @else
                <a href="{{ $paginator->url($i) }}" class="pagi-btn">{{ $i }}</a>
            @endif
        @endfor

        {{-- Ellipsis After --}}
        @if ($showEllipsisAfter)
            <span class="pagi-btn">...</span>
        @endif

        {{-- Last Page --}}
        @if ($end < $paginator->lastPage())
            <a href="{{ $paginator->url($paginator->lastPage()) }}" class="pagi-btn">{{ $paginator->lastPage() }}</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagi-btn" rel="next">&rsaquo;</a>
        @else
            <span class="pagi-btn" aria-disabled="true">&rsaquo;</span>
        @endif
    </nav>
@endif
