@can('update', $comment)
    <div class="flex items-start px-2 py-4 mt-4 mb-4 bg-white shadow rounded-lg sm:px-5 {{ $isReply ? 'ml-8' : '' }}" x-show="isEditing">
        <div class="text-white">
            <x-avatar :src="Auth::user()->avatar" />
        </div>

        <form class="flex-1 ml-4" action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-sm font-medium leading-tight" for="{{ $id }}">Edit Comment</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <textarea class="form-input block w-full @error('body') border-red-300 text-red-900 @enderror"
                              id="{{ $id }}"
                              name="body"
                              placeholder="Write your comment here..."
                              required
                              autocomplete="off"
                              maxlength="3000"
                              @error('body')
                              aria-invalid="true"
                              aria-describedby="{{ $id }}-error"
                              @enderror>{{ $comment->body }}</textarea>
                </div>
                @error('body')
                    <p class="mt-2 text-sm text-red-600" id="{{ $id }}-error">{{ $message }}</p>
                @enderror
            </div>

            <input name="poll_id" type="hidden" value="{{ $comment->poll_id }}">
            @if ($isReply)
                <input name="parent_comment_id" type="hidden" value="{{ $comment->parent_comment_id }}">
            @endif

            <div class="flex justify-end mt-4">
                <x-button>{{ $isReply ? 'Update Reply' : 'Update Comment' }}</x-button>
            </div>
        </form>
    </div>
@endcan
