<li class="{{ (! $loop->first) ? 'border-t border-gray-100' : '' }}">
    <a class="block hover:bg-gray-50" href="{{ route('polls.show', $poll) }}">
        <div class="flex items-center px-4 py-4 sm:px-6">
            <div class="min-w-0 flex-1 flex items-center">
                <div class="flex-shrink-0 text-white">
                    <img class="h-12 w-12 rounded-full shadow-solid" src="{{ $poll->author->avatar }}" alt="" height="48" width="48" loading="lazy">
                </div>
                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                    <div>
                        <p class="text-sm leading-5 font-medium text-green-600">{{ $poll->title }}</p>
                        <p class="mt-2 text-sm leading-5 text-gray-500">{{ __('Created by') . ' ' . $poll->author->username }} <time datetime="{{ $poll->created_at }}">{{ $poll->created_at->diffForHumans() }}</time></p>
                    </div>
                    <div class="hidden md:block md:text-0">
                        <div>
                            <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-{{ $poll->category->color }}-100 text-{{ $poll->category->color }}-800">{{ $poll->category->name }}</p>
                            <div class="mt-2 text-sm leading-5 text-gray-500">
                                <svg class="inline-block align-middle" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <line x1="18" y1="20" x2="18" y2="10" />
                                    <line x1="12" y1="20" x2="12" y2="4" />
                                    <line x1="6" y1="20" x2="6" y2="14" />
                                </svg>
                                <p class="inline-block align-middle">{{ count($poll->votes) . ' ' . (count($poll->votes) !== 1 ? __('votes') : __('vote')) }}</p>
                                <svg class="inline-block align-middle ml-2" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
                                </svg>
                                <p class="inline-block align-middle">{{ count($poll->comments) . ' ' . (count($poll->comments) !== 1 ? __('comments') : __('comment')) }}</p>
                            </div>
                        </div>
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
