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
                        x-on:click="toggleReplyForm()"
                        x-text="! isReplying ? 'Reply' : 'Cancel Reply'">Reply</button>
            @endauth

            <div class="inline-flex items-center ml-2">
                <dl>
                    <dt class="sr-only">Number of likes</dt>
                    <dd>{{ $comment->numberOfLikes() }}</dd>
                </dl>
                <span class="inline-block ml-1.5">
                    @include('icons.like', ['width' => '14', 'height' => '14'])
                </span>

                @auth
                    <div class="ml-1.5">
                        @if ($comment->hasBeenLiked(Auth::user()))
                            @can('delete', Auth::user()->like($comment))
                                <form action="{{ route('likes.destroy', Auth::user()->like($comment)->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="font-medium" type="submit">
                                        Liked <span class="sr-only">- Unlike</span>
                                    </button>
                                </form>
                            @endcan
                        @else
                            @can('create', App\Like::class)
                                <form action="{{ route('likes.store') }}" method="POST">
                                    @csrf

                                    <input name="comment_id" type="hidden" value="{{ $comment->id }}">

                                    <button class="flex items-center text-green-600 hover:underline" type="submit">
                                        Like
                                    </button>
                                </form>
                            @endcan
                        @endif
                    </div>
                @endauth
            </div>

            <div class="mt-2">
                @can('update', $comment)
                    <button class="inline-block ml-2 text-green-600 hover:underline"
                            type="button"
                            x-on:click="toggleEditForm()"
                            x-text="! isEditing ? 'Edit' : 'Cancel Edit'">Edit</button>
                @endcan

                @can('delete', $comment)
                    <form class="inline-block ml-2" action="{{ route('comments.destroy', $comment) }}" method="POST" x-data x-on:submit.prevent="if (confirm('Are you sure you want to delete your comment?')) { $el.submit() }">
                        @csrf
                        @method('DELETE')

                        <button class="text-green-600 hover:underline" type="submit">Delete</button>
                    </form>
                @endcan
            </div>
        </footer>
    </article>
</x-panel>
