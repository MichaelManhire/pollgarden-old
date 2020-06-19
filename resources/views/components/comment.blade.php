<article class="max-w-3xl p-4 bg-white rounded-lg shadow">
    <div class="flex items-start">
        @include('components.avatar', ['href' => route('users.show', $comment->author), 'isLink' => true, 'src' => $comment->author->avatar])

        <div class="ml-4">
            <h3>
                <a class="text-green-600 hover:underline" href="{{ route('users.show', $comment->author) }}">{{ $comment->author->username }}</a>
                <span class="sr-only">wrote:</span>
            </h3>
            <p class="mt-1">{{ $comment->body }}</p>
        </div>
    </div>

    <footer class="mt-2 text-right text-sm">
        <p class="inline-block">
            <span>Posted</span>
            <time datetime="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</time>
        </p>

        @auth
            <button class="inline-block ml-2 text-green-600 hover:underline" type="button">Reply</button>
        @endauth

        @can('update', $comment)
            <button class="inline-block ml-2 text-green-600 hover:underline" type="button">Edit</button>
        @endcan

        @can('delete', $comment)
            <form class="inline-block ml-2" action="{{ route('comments.destroy', $comment) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="text-green-600 hover:underline" type="submit">Delete</button>
            </form>
        @endcan
    </footer>
</article>
