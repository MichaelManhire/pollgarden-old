@can('update', $comment)
    <div class="flex items-start max-w-3xl px-2 py-4 mt-4 mb-4 bg-white shadow rounded-lg sm:px-5 {{ $isReply ? 'ml-8' : '' }}" x-show="isEditing">
        <div class="text-white">
            @include('_avatar', ['imageSrc' => Auth::user()->avatar, 'height' => 48, 'width' => 48, 'username' => Auth::user()->username])
        </div>

        <form class="flex-1 ml-4" action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PATCH')

            <div>
                <label class="sr-only" for="{{ $id }}">Edit Comment</label>
                <div class="rounded-md shadow-sm">
                    <textarea class="form-input block w-full" id="{{ $id }}" name="body" autocomplete="off" required>{{ $comment->body }}</textarea>
                </div>
            </div>

            <input name="poll_id" type="hidden" value="{{ $comment->poll_id }}">
            @if ($isReply)
                <input name="parent_comment_id" type="hidden" value="{{ $comment->parent_comment_id }}">
            @endif

            <div class="flex justify-end mt-4">
                <button class="py-2 px-4 text-sm font-medium leading-5 text-white border-1 border-transparent rounded-md bg-green-600 hover:bg-green-500" type="submit">
                    @if ($isReply)
                      Update Reply
                    @else
                      Update Comment
                    @endif
                </button>
            </div>
        </form>
    </div>
@endcan
