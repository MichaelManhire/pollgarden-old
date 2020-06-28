<nav class="flex justify-center md:justify-end py-3" aria-label="Pagination">
    <ul class="inline-flex shadow-sm">
        @if ($paginator->onFirstPage())
            <li aria-disabled="true">
                <span class="inline-flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-500 bg-white border border-gray-200 rounded-l-md">
                    @include('icons.arrow-left', ['width' => '20', 'height' => '20'])
                    <span class="sr-only">Previous</span>
                </span>
            </li>
        @else
            <li>
                <a class="inline-flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 bg-white border border-gray-200 rounded-l-md"
                   href="{{ $paginator->previousPageUrl() }}"
                   rel="prev"
                   aria-label="Previous">
                    @include('icons.arrow-left', ['width' => '20', 'height' => '20'])
                    <span class="sr-only">Previous</span>
                </a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li aria-disabled="true">
                    <span class="inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-700 bg-white border border-gray-200">
                        {{ $element }}
                    </span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li aria-current="page">
                            <span class="inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-green-600 bg-green-100 border border-green-100">
                                {{ $page }}
                            </span>
                        </li>
                    @else
                        <li>
                            <a class="inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-700 hover:text-gray-500 bg-white border border-gray-200"
                               href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li>
                <a class="inline-flex items-center px-2 py-2 -ml-px text-sm font-medium leading-5 text-gray-500 hover:text-gray-400 bg-white border border-gray-200 rounded-r-md"
                   href="{{ $paginator->nextPageUrl() }}"
                   rel="next"
                   aria-label="Next">
                    @include('icons.arrow-right', ['width' => '20', 'height' => '20'])
                    <span class="sr-only">Next</span>
                </a>
            </li>
        @else
            <li aria-disabled="true">
                <span class="inline-flex items-center px-2 py-2 -ml-px text-sm leading-5 font-medium text-gray-500 bg-white border border-gray-200 rounded-r-md">
                    @include('icons.arrow-right', ['width' => '20', 'height' => '20'])
                    <span class="sr-only">Next</span>
                </span>
            </li>
        @endif
    </ul>
</nav>
