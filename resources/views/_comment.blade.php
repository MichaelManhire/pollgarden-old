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

        <footer class="mt-4 text-right text-sm">
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

            <div class="inline-flex ml-2">
                @if ($comment->hasBeenLiked(Auth::user()))
                    <form action="{{ route('likes.destroy', Auth::user()->like($comment)->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="flex items-center" type="submit">
                            <span class="font-medium">Liked</span>
                            <span class="inline-block ml-1.5">
                                @include('icons.like', ['width' => '14', 'height' => '14'])
                            </span>
                        </button>
                    </form>
                @else
                    @can('create', App\Like::class)
                        <form action="{{ route('likes.store') }}" method="POST">
                            @csrf

                            <input name="comment_id" type="hidden" value="{{ $comment->id }}">

                            <button class="flex items-center" type="submit">
                                <span class="text-green-600 hover:underline">Like</span>
                                <span class="inline-block ml-1.5">
                                    @include('icons.like', ['width' => '14', 'height' => '14'])
                                </span>
                            </button>
                        </form>
                    @endcan
                @endif

                <dl class="ml-1.5">
                    <dt class="sr-only">Number of likes</dt>
                    <dd>{{ $comment->numberOfLikes() }}</dd>
                </dl>
            </div>

            <div class="mt-2">
                @can('update', $comment)
                    <button class="inline-block ml-2 text-green-600 hover:underline"
                            type="button"
                            @click="toggleEditForm()"
                            x-text="! isEditing ? 'Edit' : 'Cancel Edit'">Edit</button>
                @endcan

                @can('delete', $comment)
                    <form class="inline-block ml-2" action="{{ route('comments.destroy', $comment) }}" method="POST" x-data @submit.prevent="if (confirm('Are you sure you want to delete your comment?')) { $el.submit() }">
                        @csrf
                        @method('DELETE')

                        <button class="text-green-600 hover:underline" type="submit">Delete</button>
                    </form>
                @endcan
            </div>
        </footer>
    </article>
</x-panel>
