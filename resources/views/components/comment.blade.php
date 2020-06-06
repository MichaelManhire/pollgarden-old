<article class="relative flex items-start max-w-3xl px-2 pt-4 pb-6 bg-white shadow sm:px-5 sm:rounded-lg">
    <a class="flex-shrink-0 text-white" href="{{ route('users.show', $comment->author) }}">
        <img class="h-12 w-12 rounded-full shadow-solid" src="{{ $comment->author->avatar }}" alt="" height="48" width="48" loading="lazy">
    </a>
    <div class="ml-4">
        <p class="mb-1"><a class="text-green-600 hover:underline" href="{{ route('users.show', $comment->author) }}">{{ $comment->author->username }}</a> <span class="sr-only">{{ __('wrote:') }}</span></p>
        <p class="mb-2">{{ $comment->body }}</p>
    </div>
    <div class="absolute bottom-0 right-0 px-2 py-2 text-right text-sm sm:px-5">
        <p class="inline-block">{{ __('Posted') . ' ' }} <time datetime="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</time></p>
        @auth
            <button class="inline-block ml-2 text-green-600 hover:underline" type="button">{{ __('Reply') }}</button>
        @endauth
        @can('update', $comment)
            <button class="inline-block ml-2 text-green-600 hover:underline" type="button">{{ __('Edit') }}</button>
        @endcan
        @can('delete', $comment)
            <form class="inline-block ml-2" action="{{ route('comments.destroy', $comment) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="text-green-600 hover:underline" type="submit">{{ __('Delete') }}</button>
            </form>
        @endcan
    </div>
</article>
