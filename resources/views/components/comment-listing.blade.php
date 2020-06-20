<li class="{{ ($loop->last) ? '' : 'border-t border-gray-100' }}">
    <x-listing :poll="$poll">
        <div class="flex-1 px-4">
            <h3 class="text-sm font-medium leading-5 text-green-600">{{ $poll->title }}</h3>
            <p class="max-w-3xl mt-2 text-sm font-medium leading-5">{{ $comment->body }}</p>
            <p class="mt-1 text-sm leading-5 text-gray-500">
                <span>Commented</span>
                <time datetime="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</time>
            </p>
        </div>
    </x-listing>
</li>
