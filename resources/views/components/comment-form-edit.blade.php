@can('update', $comment)
    <div class="flex items-start max-w-3xl px-2 py-4 mt-4 mb-4 bg-white shadow rounded-lg sm:px-5 {{ $isReply ? 'ml-8' : '' }}">
        <div class="flex-shrink-0 text-white">
            <img class="h-12 w-12 rounded-full shadow-solid" src="{{ Auth::user()->avatar }}" alt="" height="48" width="48" loading="lazy">
        </div>

        <form class="flex-1 ml-4" action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PATCH')

            <div>
                <label class="sr-only" for="{{ $id }}">{{ __('Edit Comment') }}</label>
                <div class="rounded-md shadow-sm">
                    <textarea class="form-input block w-full"
                           id="{{ $id }}"
                           name="body"
                           autocomplete="off"
                           required>{{ $comment->body }}</textarea>
                </div>
            </div>

            <input name="poll_id" type="hidden" value="{{ $comment->poll_id }}">
            @if ($isReply)
                <input name="parent_comment_id" type="hidden" value="{{ $comment->parent_comment_id }}">
            @endif

            <div class="flex justify-end mt-4">
                <button class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-500" type="submit">
                    @if ($isReply)
                      {{ __('Update Reply') }}
                    @else
                      {{ __('Update Comment') }}
                    @endif
                </button>
            </div>
        </form>
    </div>
@endcan
