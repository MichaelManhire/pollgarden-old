<a class="block hover:bg-gray-50" href="{{ route('polls.show', $poll) }}">
    <article class="flex items-center p-4 sm:px-6">
        <div class="flex-1 flex items-start">
            <div class="flex-shrink-0 text-white">
                <x-avatar :src="$poll->getImage()" />
            </div>

            {{ $slot }}
        </div>

        <div class="text-gray-400">
            @include('icons.arrow-right', ['width' => '20', 'height' => '20'])
        </div>
    </article>
</a>
