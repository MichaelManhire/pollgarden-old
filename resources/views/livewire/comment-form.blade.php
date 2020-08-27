<div class="flex items-start px-2 py-4 mt-4 mb-4 bg-white shadow rounded-lg sm:px-5 {{ $isReply ? 'ml-8' : '' }}"
     x-show="isReplying">
    <div class="text-white">
        <x-avatar :src="Auth::user()->getAvatar()" />
    </div>

    <form class="flex-1 ml-4" action="{{ route('comments.store') }}" method="POST" wire:submit.prevent="comment()">
        @csrf

        <div>
            <label class="sr-only" for="{{ $htmlId }}">Comment</label>
            <div class="rounded-md shadow-sm">
                <textarea class="form-input block w-full @error('body') border-red-300 text-red-900 @enderror"
                          id="{{ $htmlId }}"
                          name="body"
                          wire:model="body"
                          placeholder="Write your comment here..."
                          required
                          autocomplete="off"
                          maxlength="3000"
                          x-ref="replyField"
                          @error('body')
                          aria-invalid="true"
                          aria-describedby="{{ $htmlId }}-error"
                          @enderror></textarea>
            </div>
            @error('body')
                <p class="mt-2 text-sm text-red-600" id="{{ $htmlId }}-error">{{ $message }}</p>
            @enderror
        </div>

        <input name="poll_id" type="hidden" value="{{ $poll_id }}">
        @if ($isReply)
            <input name="parent_comment_id" type="hidden" value="{{ $parent_comment_id }}">
        @endif

        <div class="flex justify-end mt-4">
            <x-button>{{ $isReply ? 'Submit Reply' : 'Submit Comment' }}</x-button>
        </div>
    </form>
</div>
