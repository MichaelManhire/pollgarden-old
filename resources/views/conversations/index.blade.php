@extends('layouts.app')

@section('title', 'Messages')

@section('content')
<article>
    <h1 class="mb-4 text-3xl leading-tight font-extrabold">Messages</h1>

    @if ($conversations->count())
        <ol>
            @foreach ($conversations as $conversation)
                <li class="{{ ($loop->first) ? '' : 'mt-4' }}">
                    <x-panel>
                        <a class="block p-3 hover:bg-gray-50 transition-colors duration-150 ease-in-out" href="{{ route('conversations.show', $conversation) }}">
                            <article>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 text-white">
                                        @if (Auth::id() === $conversation->sender_id)
                                            <x-avatar :src="$conversation->recipient->getAvatar()" />
                                        @else
                                            <x-avatar :src="$conversation->sender->getAvatar()" />
                                        @endif
                                    </div>

                                    <div class="ml-4">
                                        <h2>
                                            <span class="text-green-600">
                                                @if (Auth::id() === $conversation->sender_id)
                                                    {{ $conversation->recipient->username }}
                                                @else
                                                    {{ $conversation->sender->username }}
                                                @endif
                                            </span>
                                        </h2>
                                        <p class="mt-1">{{ $conversation->messages->first()->body }}</p>
                                    </div>
                                </div>

                                <footer class="mt-2 text-right text-sm">
                                    <p>
                                        <span>{{ Auth::id() === $conversation->messages->first()->user_id ? 'Sent' : 'Received' }}</span>
                                        <time datetime="{{ $conversation->messages->first()->created_at }}">{{ $conversation->messages->first()->created_at->diffForHumans() }}</time>
                                    </p>
                                </footer>
                            </article>
                        </a>
                    </x-panel>
                </li>
            @endforeach
        </ol>
    @else
    <x-panel class="p-3 mb-4">
        <p>You don't have any messages!</p>
    </x-panel>
    @endif
</article>

@if ($conversations->hasPages())
    {{ $conversations->links() }}
@endif
@endsection
