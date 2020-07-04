@extends('layouts.app')

@section('title', $conversation->sender->username . ' and ' . $conversation->recipient->username)

@section('content')
<article>
    <h1 class="sr-only">Messages between {{ $conversation->sender->username }} and {{ $conversation->recipient->username }}</h1>

    <x-panel class="p-4">
        <form action="{{ route('messages.store') }}" method="POST">
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

            <div class="flex justify-end mt-4">
                <x-button>Send Message</x-button>
            </div>
        </form>
    </x-panel>

    <ol class="mt-4">
        @foreach ($conversation->messages as $message)
            <li class="{{ ($loop->first) ? '' : 'mt-4' }}">
                <x-panel class="p-4">
                    <article>
                        <div class="flex items-start">
                            <a class="flex-shrink-0 text-white" href="{{ route('users.show', $message->author) }}">
                                <x-avatar :src="$message->author->getAvatar()" />
                            </a>

                            <div class="ml-4">
                                <h2>
                                    <a class="text-green-600 hover:underline" href="{{ route('users.show', $message->author) }}">{{ $message->author->username }}</a>
                                </h2>
                                <p class="mt-1">{{ $message->body }}</p>
                            </div>
                        </div>

                        <footer class="mt-2 text-right text-sm">
                            <p>
                                <span>Sent</span>
                                <time datetime="{{ $message->created_at }}">{{ $message->created_at->diffForHumans() }}</time>
                            </p>
                        </footer>
                    </article>
                </x-panel>
            </li>
        @endforeach
    </ol>
</article>

{{-- {{ $messages->links() }} --}}
@endsection
