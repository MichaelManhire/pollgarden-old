@can('create', App\Comment::class)
    <div class="flex items-start max-w-3xl px-2 py-4 mt-4 mb-4 bg-white shadow sm:px-5 sm:rounded-lg {{ $isReply ? 'ml-8' : '' }}">
        <div class="flex-shrink-0 text-white">
            <img class="h-12 w-12 rounded-full shadow-solid" src="{{ Auth::user()->avatar }}" alt="" height="48" width="48" loading="lazy">
        </div>

        <form class="flex-1 ml-4" action="{{ route('comments.store') }}" method="POST">
            @csrf

            <div>
                <label class="sr-only" for="{{ $id }}">{{ __('Comment') }}</label>
                <div class="rounded-md shadow-sm">
                    <textarea class="form-input block w-full @error('body') border-red-300 text-red-900 @enderror"
                           id="{{ $id }}"
                           name="body"
                           value="{{ old('body') }}"
                           autocomplete="off"
                           required
                           @error('body')
                           aria-invalid="true"
                           aria-describedby="{{ $id }}-error"
                           @enderror></textarea>
                </div>
                @error('body')
                    <p class="mt-2 text-sm text-red-600" id="{{ $id }}-error">{{ $message }}</p>
                @enderror
            </div>

            <input name="poll_id" type="hidden" value="{{ $poll->id }}">
            @if ($isReply)
                <input name="parent_comment_id" type="hidden" value="{{ $comment->id }}">
            @endif

            <div class="flex justify-end mt-4">
                <button class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-500" type="submit">
                    @if ($isReply)
                      {{ __('Submit Reply') }}
                    @else
                      {{ __('Submit Comment') }}
                    @endif
                </button>
            </div>
        </form>
    </div>
@endcan
