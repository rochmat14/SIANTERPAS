@if ($paginator->hasPages())
    <div class="custom-pagination mt-60 d-flex justify-content-center">
        <nav aria-label="Post Pagination" class="fullwidth">
            <ul id="pagination" class="pagination justify-content-between d-flex">
                <li class="page-item mr-auto">
                    @if ($paginator->onFirstPage())
                        <a class="page-link" href="#" aria-label="Previous" onclick="event.preventDefault();">&laquo;</a>
                    @else
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">&laquo;</a>
                    @endif
                </li>

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item active"><a class="page-link" href="#">{{ $element }}</a></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                <li class="page-item ml-auto">
                    @if ($paginator->hasMorePages())
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">&raquo;</a>
                    @else
                        <a class="page-link" href="#" aria-label="Next" onclick="event.preventDefault();">&raquo;</a>
                    @endif
                </li>
            </ul>
        </nav>
    </div>
@endif

