<li class="{{ (! $loop->first) ? 'border-t border-gray-100' : '' }}">
    <a class="block hover:bg-gray-50" href="{{ route('polls.show', $poll) }}">
        <article class="flex items-center p-4 sm:px-6">
            <div class="flex-1 flex items-start">
                @include('components.avatar', ['isLink' => false, 'src' => $poll->author->avatar])

                <div class="flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                    <div>
                        <h2 class="text-sm font-medium leading-5 text-green-600">{{ $poll->title }}</h2>
                        <p class="mt-2 text-sm leading-5 text-gray-500">
                            <span>Created by {{ $poll->author->username }}</span>
                            <time datetime="{{ $poll->created_at }}">{{ $poll->created_at->diffForHumans() }}</time>
                        </p>
                    </div>

                    <div class="hidden text-0 md:block">
                        <p class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium leading-4 rounded-full bg-{{ $poll->category->color }}-100 text-{{ $poll->category->color }}-800">
                            <span class="sr-only">Category:</span>
                            <span>{{ $poll->category->name }}</span>
                        </p>

                        <div class="mt-2 text-sm leading-5 text-gray-500">
                            <div class="inline-block align-middle">
                                @include('icons.poll')
                            </div>
                            <p class="inline-block align-middle">{{ $poll->numberOfVotes() }}</p>

                            <div class="inline-block align-middle ml-2">
                                @include('icons.comment')
                            </div>
                            <p class="inline-block align-middle">{{ $poll->numberOfComments() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-gray-400">
                @include('icons.arrow-right')
            </div>
        </article>
    </a>
</li>
