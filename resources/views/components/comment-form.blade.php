@can('create', App\Comment::class)
    <div class="flex items-start max-w-3xl px-2 py-4 mt-4 mb-4 bg-white shadow rounded-lg sm:px-5 {{ $isReply ? 'ml-8' : '' }}">
        @include('components.avatar', ['isLink' => false, 'src' => Auth::user()->avatar])

        <form class="flex-1 ml-4" action="{{ route('comments.store') }}" method="POST">
            @csrf

            <div>
                <label class="sr-only" for="{{ $id }}">Comment</label>
                <div class="rounded-md shadow-sm">
                    <textarea class="form-input block w-full" id="{{ $id }}" name="body" autocomplete="off" required></textarea>
                </div>
            </div>

            <input name="poll_id" type="hidden" value="{{ $poll->id }}">
            @if ($isReply)
                <input name="parent_comment_id" type="hidden" value="{{ $comment->id }}">
            @endif

            <div class="flex justify-end mt-4">
                <button class="py-2 px-4 text-sm font-medium leading-5 text-white border-1 border-transparent rounded-md bg-green-600 hover:bg-green-500" type="submit">
                    @if ($isReply)
                      Submit Reply
                    @else
                      Submit Comment
                    @endif
                </button>
            </div>
        </form>
    </div>
@endcan
