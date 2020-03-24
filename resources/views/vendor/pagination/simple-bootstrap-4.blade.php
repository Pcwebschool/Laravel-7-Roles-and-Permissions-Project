@if ($paginator->hasPages())
    <nav aria-label="Paginate">
        <div class="clearfix">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="btn btn-primary float-left">← Newer Posts</span>
            @else
                <a class="btn btn-primary float-left" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Newer Posts</a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="btn btn-primary float-right" href="{{ $paginator->nextPageUrl() }}" rel="next">Older Posts →</a>
            @else
                <span class="btn btn-primary float-right">Older Posts →</span>
            @endif
        </div>
    </nav>
@endif



    
