@extends('layouts.app')

@section('title', 'Send a Message')

@section('content')
<article>
    <h1 class="sr-only">Send a Message</h1>

    <x-panel class="p-4">
        <form class="mb-8" action="{{ route('conversations.store') }}" method="POST">
            @csrf

            <label for="body">Message</label>
            <textarea class="form-input w-full" id="body" name="body"></textarea>

            <input name="recipient_id" type="hidden" value="{{ request()->recipient_id }}">

            <div class="flex justify-end">
                <x-button>Send Message</x-button>
            </div>
        </form>
    </x-panel>
</article>
@endsection
