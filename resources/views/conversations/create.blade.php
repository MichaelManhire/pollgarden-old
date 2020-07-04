@extends('layouts.app')

@section('title', 'Send Message to ' . request()->recipient_name)

@section('content')
<article>
    <h1 class="sr-only">Send a Message</h1>

    <x-panel class="p-4">
        <p class="mb-4">You're writing a message to <a class="font-bold hover:underline" href="{{ route('users.show', request()->recipient_slug) }}">{{ request()->recipient_name }}</a>.</p>

        <form action="{{ route('conversations.store') }}" method="POST">
            @csrf

            <div>
                <label class="sr-only" for="body">Message</label>
                    <div class="rounded-md shadow-sm">
                        <textarea class="form-input block w-full @error('body') border-red-300 text-red-900 @enderror"
                                  id="body"
                                  name="body"
                                  placeholder="Write your message here..."
                                  required
                                  autocomplete="off"
                                  autofocus
                                  maxlength="3000"
                                  @error('body')
                                  aria-invalid="true"
                                  aria-describedby="body-error"
                                  @enderror></textarea>
                    </div>
                    @error('body')
                        <p class="mt-2 text-sm text-red-600" id="body-error">{{ $message }}</p>
                    @enderror
            </div>

            <input name="recipient_id" type="hidden" value="{{ request()->recipient_id }}">

            <div class="flex justify-end mt-4">
                <x-button>Send Message</x-button>
            </div>
        </form>
    </x-panel>
</article>
@endsection
