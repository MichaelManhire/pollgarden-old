<li class="{{ (! $loop->first) ? 'border-t border-gray-100' : '' }}">
    <a class="block hover:bg-gray-50" href="{{ route('polls.show', $poll) }}">
        <div class="flex items-center px-4 py-4 sm:px-6">
            <div class="min-w-0 flex-1 flex items-start">
                <div class="flex-shrink-0 text-white">
                    <img class="h-12 w-12 rounded-full shadow-solid" src="{{ $poll->author->avatar }}" alt="" height="48" width="48" loading="lazy">
                </div>
                <div class="min-w-0 flex-1 px-4">
                    <div>
                        <p class="text-sm leading-5 font-medium text-green-600">{{ $poll->title }}</p>
                        <p class="mt-2 text-sm leading-5 text-gray-500">{{ __('Comment from') . ' ' . $comment->author->username }} <time datetime="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</time>:</p>
                        <p class="max-w-3xl mt-0.5 text-sm leading-5 font-medium text-gray-900">{{ $comment->body }}</p>
                    </div>
                </div>
            </div>
            <div>
                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" height="20" width="20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </a>
</li>
