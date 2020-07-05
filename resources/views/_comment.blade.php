<x-panel class="p-4">
    <article class="comment" id="comment{{ $comment->id }}">
        <div class="flex items-start">
            <a class="flex-shrink-0 text-white" href="{{ route('users.show', $comment->author) }}">
                <x-avatar :src="$comment->author->getAvatar()" />
            </a>

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
                @if ($comment->created_at != $comment->updated_at)
                    <span>(edited <time datetime="{{ $comment->updated_at }}">{{ $comment->updated_at->diffForHumans() }}</time>)</span>
                @endif
            </p>

            @auth
                <button class="inline-block ml-2 text-green-600 hover:underline"
                        type="button"
                        @click="toggleReplyForm()"
                        x-text="! isReplying ? 'Reply' : 'Cancel Reply'">Reply</button>
            @endauth

            @can('update', $comment)
                <button class="inline-block ml-2 text-green-600 hover:underline"
                        type="button"
                        @click="toggleEditForm()"
                        x-text="! isEditing ? 'Edit' : 'Cancel Edit'">Edit</button>
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
</x-panel>
