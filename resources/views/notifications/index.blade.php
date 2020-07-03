@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<article>
    <h1 class="sr-only">Notifications</h1>
    <ol>
        @forelse ($notifications as $notification)
            @if ($notification['type'] === 'App\Notifications\CommentReceived')
                <li class="{{ ($loop->first) ? '' : 'mt-4' }}">
                    <x-panel class="p-3">
                        <div class="relative inline-block" style="top: 2px;">
                            @include('icons.comment', ['width' => '16', 'height' => '16'])
                        </div>
                        <span class="font-medium">New comment:</span>
                        <a class="text-green-600 underline" href="{{ route('users.show', $notification->data['authorSlug']) }}">{{ $notification->data['author'] }}</a>
                        left a comment on your poll,
                        <a class="text-green-600 underline" href="{{ route('polls.show', $notification->data['pollSlug']) }}#comment{{ $notification->data['commentId'] }}">
                            {{ $notification->data['poll'] }}
                        </a>
                    </x-panel>
                </li>
            @endif
        @empty
            <li>You don't have any notifications!</li>
        @endforelse
    </ol>
</article>
@endsection
