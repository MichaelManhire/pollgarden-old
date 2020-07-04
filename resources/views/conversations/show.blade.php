@extends('layouts.app')

@section('title', $conversation->sender->username . ' and ' . $conversation->recipient->username)

@section('content')
<article>
    <h1 class="sr-only">Messages between {{ $conversation->sender->username }} and {{ $conversation->recipient->username }}</h1>

    <x-panel class="p-4">
        <form class="mb-8" action="{{ route('messages.store') }}" method="POST">
            @csrf

            <label for="body">Message</label>
            <textarea class="form-input w-full" id="body" name="body"></textarea>

            <input name="conversation_id" type="hidden" value="{{ $conversation->id }}">

            <div class="flex justify-end">
                <x-button>Send Message</x-button>
            </div>
        </form>

        @foreach ($conversation->messages as $message)
            <article class="mb-4">
                <p>{{ $message->author->username }} wrote:</p>
                <p>{{ $message->body }}</p>
            </article>
        @endforeach
    </x-panel>
</article>

{{-- {{ $messages->links() }} --}}
@endsection
