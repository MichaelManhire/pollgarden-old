<nav class="py-3 text-center sm:text-right" aria-label="Pagination">
    <ul class="inline-flex shadow-sm">
        @if ($paginator->onFirstPage())
            <li aria-disabled="true">
                <span class="inline-flex items-center px-2 py-2 rounded-l-md border border-gray-200 bg-white text-sm leading-5 font-medium text-gray-500" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <svg class="h-5 w-5" height="20" width="20" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only" aria-hidden="true">{{ __('Previous') }}</span>
                </span>
            </li>
        @else
            <li>
                <a class="inline-flex items-center px-2 py-2 rounded-l-md border border-gray-200 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <svg class="h-5 w-5" height="20" width="20" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">{{ __('Previous') }}</span>
                </a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li aria-disabled="true">
                    <span class="-ml-px inline-flex items-center px-4 py-2 border border-gray-200 bg-white text-sm leading-5 font-medium text-gray-700">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li aria-current="page">
                            <span class="-ml-px inline-flex items-center px-4 py-2 border border-gray-200 bg-gray-50 text-sm leading-5 font-medium text-gray-700">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a class="-ml-px inline-flex items-center px-4 py-2 border border-gray-200 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li>
                <a class="-ml-px inline-flex items-center px-2 py-2 rounded-r-md border border-gray-200 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <svg class="h-5 w-5" height="20" width="20" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">{{ __('Next') }}</span>
                </a>
            </li>
        @else
            <li aria-disabled="true">
                <span class="-ml-px inline-flex items-center px-2 py-2 rounded-r-md border border-gray-200 bg-white text-sm leading-5 font-medium text-gray-500" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <svg class="h-5 w-5" height="20" width="20" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only" aria-disabled="true">{{ __('Next') }}</span>
                </span>
            </li>
        @endif
    </ul>
</nav>
