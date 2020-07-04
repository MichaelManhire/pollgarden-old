@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<article>
    <h1 class="mb-4 text-3xl leading-tight font-extrabold">Notifications</h1>
    @if ($unreadNotifications->count())
        <article class="mb-4">
            <h2 class="sr-only">Unread Notifications</h2>
            <ol>
                @forelse ($unreadNotifications as $unreadNotification)
                    @if ($unreadNotification['type'] === 'App\Notifications\CommentReceived')
                        <li class="{{ ($loop->first) ? '' : 'mt-4' }}">
                            <x-panel class="p-3">
                                <div class="relative inline-block" style="top: 2px;">
                                    @include('icons.comment', ['width' => '16', 'height' => '16'])
                                </div>
                                <span class="font-medium">New comment:</span>
                                <a class="text-green-600 underline" href="{{ route('users.show', $unreadNotification->data['authorSlug']) }}">{{ $unreadNotification->data['author'] }}</a>
                                left a comment on your poll,
                                <a class="text-green-600 underline" href="{{ route('polls.show', $unreadNotification->data['pollSlug']) }}#comment{{ $unreadNotification->data['commentId'] }}">
                                    {{ $unreadNotification->data['poll'] }}
                                </a>
                            </x-panel>
                        </li>
                    @endif

                    @if ($unreadNotification['type'] === 'App\Notifications\CommentReplyReceived')
                        <li class="{{ ($loop->first) ? '' : 'mt-4' }}">
                            <x-panel class="p-3">
                                <div class="relative inline-block" style="top: 2px;">
                                    @include('icons.comment', ['width' => '16', 'height' => '16'])
                                </div>
                                <span class="font-medium">New reply:</span>
                                <a class="text-green-600 underline" href="{{ route('users.show', $unreadNotification->data['authorSlug']) }}">{{ $unreadNotification->data['author'] }}</a>
                                replied to your comment on the poll,
                                <a class="text-green-600 underline" href="{{ route('polls.show', $unreadNotification->data['pollSlug']) }}#comment{{ $unreadNotification->data['commentId'] }}">
                                    {{ $unreadNotification->data['poll'] }}
                                </a>
                            </x-panel>
                        </li>
                    @endif

                    @if ($unreadNotification['type'] === 'App\Notifications\VotesReceived')
                        <li class="{{ ($loop->first) ? '' : 'mt-4' }}">
                            <x-panel class="p-3">
                                <div class="relative inline-block" style="top: 2px;">
                                    @include('icons.poll', ['width' => '16', 'height' => '16'])
                                </div>
                                <span class="font-medium">New votes:</span>
                                People have begun voting on your poll,
                                <a class="text-green-600 underline" href="{{ route('polls.show', $unreadNotification->data['pollSlug']) }}">
                                    {{ $unreadNotification->data['poll'] }}
                                </a>
                            </x-panel>
                        </li>
                    @endif

                    @if ($unreadNotification['type'] === 'App\Notifications\MessageReceived')
                        <li class="{{ ($loop->first) ? '' : 'mt-4' }}">
                            <x-panel class="p-3">
                                <div class="relative inline-block" style="top: 2px;">
                                    @include('icons.message', ['width' => '16', 'height' => '16'])
                                </div>
                                <span class="font-medium">New message:</span>
                                <a class="text-green-600 underline" href="{{ route('users.show', $unreadNotification->data['authorSlug']) }}">{{ $unreadNotification->data['author'] }}</a>
                                has sent you a
                                <a class="text-green-600 underline" href="{{ route('conversations.show', $unreadNotification->data['conversationId']) }}">
                                    new message
                                </a>
                            </x-panel>
                        </li>
                    @endif
                @endforeach
            </ol>
        </article>
    @else
        <x-panel class="p-3 mb-4">
            <p>You don't have any new notifications right now!</p>
        </x-panel>
    @endif
    @if ($readNotifications->count())
        <article>
            <h2 class="sr-only">Old Notifications</h2>
            <ol>
                @foreach ($readNotifications as $readNotification)
                    @if ($readNotification['type'] === 'App\Notifications\CommentReceived')
                        <li class="{{ ($loop->first) ? '' : 'mt-4' }} opacity-75">
                            <x-panel class="p-3">
                                <div class="relative inline-block" style="top: 3px;">
                                    @include('icons.checkmark', ['width' => '18', 'height' => '18'])
                                </div>
                                <span class="font-medium">New comment:</span>
                                <a class="text-green-600 underline" href="{{ route('users.show', $readNotification->data['authorSlug']) }}">{{ $readNotification->data['author'] }}</a>
                                left a comment on your poll,
                                <a class="text-green-600 underline" href="{{ route('polls.show', $readNotification->data['pollSlug']) }}#comment{{ $readNotification->data['commentId'] }}">
                                    {{ $readNotification->data['poll'] }}
                                </a>
                            </x-panel>
                        </li>
                    @endif

                    @if ($readNotification['type'] === 'App\Notifications\CommentReplyReceived')
                        <li class="{{ ($loop->first) ? '' : 'mt-4' }} opacity-75">
                            <x-panel class="p-3">
                                <div class="relative inline-block" style="top: 3px;">
                                    @include('icons.checkmark', ['width' => '18', 'height' => '18'])
                                </div>
                                <span class="font-medium">New reply:</span>
                                <a class="text-green-600 underline" href="{{ route('users.show', $readNotification->data['authorSlug']) }}">{{ $readNotification->data['author'] }}</a>
                                replied to your comment on the poll,
                                <a class="text-green-600 underline" href="{{ route('polls.show', $readNotification->data['pollSlug']) }}#comment{{ $readNotification->data['commentId'] }}">
                                    {{ $readNotification->data['poll'] }}
                                </a>
                            </x-panel>
                        </li>
                    @endif

                    @if ($readNotification['type'] === 'App\Notifications\VotesReceived')
                        <li class="{{ ($loop->first) ? '' : 'mt-4' }} opacity-75">
                            <x-panel class="p-3">
                                <div class="relative inline-block" style="top: 3px;">
                                    @include('icons.checkmark', ['width' => '18', 'height' => '18'])
                                </div>
                                <span class="font-medium">New votes:</span>
                                People have begun voting on your poll,
                                <a class="text-green-600 underline" href="{{ route('polls.show', $readNotification->data['pollSlug']) }}">
                                    {{ $readNotification->data['poll'] }}
                                </a>
                            </x-panel>
                        </li>
                    @endif

                    @if ($readNotification['type'] === 'App\Notifications\MessageReceived')
                        <li class="{{ ($loop->first) ? '' : 'mt-4' }} opacity-75">
                            <x-panel class="p-3">
                                <div class="relative inline-block" style="top: 3px;">
                                    @include('icons.checkmark', ['width' => '18', 'height' => '18'])
                                </div>
                                <span class="font-medium">New message:</span>
                                <a class="text-green-600 underline" href="{{ route('users.show', $readNotification->data['authorSlug']) }}">{{ $readNotification->data['author'] }}</a>
                                has sent you a
                                <a class="text-green-600 underline" href="{{ route('conversations.show', $readNotification->data['conversationId']) }}">
                                    new message
                                </a>
                            </x-panel>
                        </li>
                    @endif
                @endforeach
            </ol>
        </article>
    @endif
</article>
@endsection
