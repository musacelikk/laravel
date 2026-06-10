@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div class="flex flex-wrap items-center justify-center gap-2">
            @if ($paginator->onFirstPage())
                <span class="inline-flex min-h-9 min-w-9 cursor-not-allowed items-center justify-center border border-luxe-ink/10 px-3 text-xs uppercase tracking-wider text-luxe-muted opacity-40" aria-disabled="true">&laquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex min-h-9 min-w-9 items-center justify-center border border-luxe-ink/10 px-3 text-xs uppercase tracking-wider text-luxe-muted transition hover:border-luxe-ink hover:text-luxe-ink">&laquo;</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="inline-flex min-h-9 items-center justify-center px-2 text-xs text-luxe-muted">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page"><span class="inline-flex min-h-9 min-w-9 items-center justify-center border border-luxe-ink bg-luxe-ink px-3 text-xs font-semibold uppercase tracking-wider text-luxe-cream">{{ $page }}</span></span>
                        @else
                            <a href="{{ $url }}" class="inline-flex min-h-9 min-w-9 items-center justify-center border border-luxe-ink/10 px-3 text-xs uppercase tracking-wider text-luxe-muted transition hover:border-luxe-ink hover:text-luxe-ink">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex min-h-9 min-w-9 items-center justify-center border border-luxe-ink/10 px-3 text-xs uppercase tracking-wider text-luxe-muted transition hover:border-luxe-ink hover:text-luxe-ink">&raquo;</a>
            @else
                <span class="inline-flex min-h-9 min-w-9 cursor-not-allowed items-center justify-center border border-luxe-ink/10 px-3 text-xs uppercase tracking-wider text-luxe-muted opacity-40" aria-disabled="true">&raquo;</span>
            @endif
        </div>
    </nav>
@endif
