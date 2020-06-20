<li class="{{ ($loop->last) ? '' : 'border-t border-gray-100' }}">
    <x-listing :poll="$poll">
        <div class="flex-1 px-4">
            <h3 class="text-sm font-medium leading-5 text-green-600">{{ $poll->title }}</h3>
            <p class="mt-2 text-sm leading-5 text-gray-500">
                <span>{{ $vote->caster->username }} voted for</span>
                <span class="font-bold">{{ $vote->recipient->name }}</span>
                <time datetime="{{ $vote->created_at }}">{{ $vote->created_at->diffForHumans() }}</time>
            </p>
        </div>
    </x-listing>
</li>
