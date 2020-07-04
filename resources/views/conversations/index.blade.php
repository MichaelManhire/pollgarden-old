@extends('layouts.app')

@section('title', 'Messages')

@section('content')
<article>
    <h1 class="sr-only">Messages</h1>

    <x-panel class="p-4">
        <ol>
            @forelse ($conversations as $conversation)
                <li class="mb-4">
                    {{ $conversation->sender->username }} and {{ $conversation->recipient->username }}
                </li>
            @empty
                <li>You don't have any messages!</li>
            @endforelse
        </ol>
    </x-panel>
</article>

{{-- {{ $messages->links() }} --}}
@endsection
