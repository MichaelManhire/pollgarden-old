@if ($comments->isNotEmpty())
    <ol id="comments">
        @foreach ($comments as $comment)
            <li class="my-4" x-data="comment()">
                @include('_comment', ['comment' => $comment])
                {{-- @include('_comment-form-edit', ['comment' => $comment, 'id' => 'edit-for-comment-' . $comment->id, 'isReply' => false]) --}}
                @can('create', App\Comment::class)
                    <livewire:comment-form :htmlId="'reply-for-comment-' . $comment->id"
                                           :isReply="true"
                                           :parentCommentId="$comment->id"
                                           :pollId="$poll->id" />
                @endcan
            </li>

            @if ($comment->replies->isNotEmpty())
                <ol class="ml-8">
                    @foreach ($comment->replies as $reply)
                        <li class="my-4" x-data="comment()">
                            @include('_comment', ['comment' => $reply])
                            {{-- @include('_comment-form-edit', ['comment' => $reply, 'id' => 'edit-for-comment-' . $reply->id, 'isReply' => true]) --}}
                            {{-- @can('create', App\Comment::class)
                                <livewire:comment-form :htmlId="'reply-for-comment-' . $reply->id"
                                                       :isReply="true"
                                                       :parentCommentId="$comment->id"
                                                       :poll="$poll" />
                            @endcan --}}
                        </li>
                    @endforeach
                </ol>
            @endif
        @endforeach
    </ol>
@else
    <x-panel class="p-3 mt-4">
        <p>No one has left a comment on this poll yet!</p>
    </x-panel>
@endif

{{-- @if ($comments->hasPages())
    {{ $comments->fragment('comments')->links() }}
@endif --}}

{{-- {{ $comments->links() }} --}}
