@extends('layouts.app')

@section('title', 'Polls')
@section('robots', 'noindex')

@section('content')
<article>
    <h1 class="mb-4 text-3xl leading-tight font-extrabold">Registered Users</h1>

    <ol class="flex flex-wrap align-top text-center">
        @forelse ($users as $user)
            <li class="w-1/2 sm:w-1/3 md:w-1/4 xl:w-1/5 p-1.5">
                <a class="block w-full py-3 px-2 text-white bg-white hover:bg-gray-50 rounded-lg shadow break-words transition-colors duration-150 ease-in-out" href="{{ route('users.show', $user) }}">
                    <x-avatar :src="$user->getAvatar()" :width="64" :height="64" />
                    <p class="mt-1.5 text-gray-900">{{ $user->username }}</p>
                    <dl class="flex justify-around max-w-12 mt-2 mx-auto text-sm text-gray-600">
                        <dt class="sr-only">Polls Created:</dt>
                        <dd>
                            <span class="inline-block align-middle">@include('icons.poll', ['width' => '16', 'height' => '16'])</span>
                            <span class="inline-block align-middle">{{ $user->polls->count() }}</span>
                        </dd>
                        <dt class="sr-only">Votes Cast:</dt>
                        <dd>
                            <span class="inline-block align-middle">@include('icons.check-circled', ['width' => '16', 'height' => '16'])</span>
                            <span class="inline-block align-middle">{{ $user->votes->count() }}</span>
                        </dd>
                        <dt class="sr-only">Comments Posted:</dt>
                        <dd>
                            <span class="inline-block align-middle">@include('icons.comment', ['width' => '16', 'height' => '16'])</span>
                            <span class="inline-block align-middle">{{ $user->comments->count() }}</span>
                        </dd>
                    </dl>
                </a>
            </li>

        @empty
            <li>There are currently no users!</li>
        @endforelse
    </ol>
</article>

@if ($users->hasPages())
    {{ $users->links() }}
@endif
@endsection
