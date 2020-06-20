<a class="block hover:bg-gray-50" href="{{ route('polls.show', $poll) }}">
    <article class="flex items-center p-4 sm:px-6">
        <div class="flex-1 flex items-start">
            <div class="flex-shrink-0 text-white">
                @include('components.avatar', ['imageSrc' => $poll->author->avatar, 'height' => 48, 'width' => 48, 'username' => $poll->author->username])
            </div>

            {{ $slot }}
        </div>

        <div class="text-gray-400">
            @include('icons.arrow-right')
        </div>
    </article>
</a>
