@extends('layouts.app')

@section('title', $user->username)

@section('content')
<article class="px-4 mt-12 text-center bg-white shadow rounded-lg sm:px-10">
    <div class="overlay">
        <div class="text-white">
            <img class="mx-auto rounded-full shadow-solid" src="{{ $user->avatar }}" alt="" width="96" height="96">
        </div>

        <h1 class="mt-2 text-3xl leading-tight font-extrabold sm:text-4xl">{{ $user->username }}</h1>

        @if ($user->description)
            <p class="max-w-xl mt-4 mx-auto">{{ $user->description }}</p>
        @endif

        <div>
            <nav class="mt-8 border-b border-gray-200" aria-label="Profile tabs">
                <ul class="flex -mb-px">
                    <li class="flex w-1/3">
                        <a class="w-full py-4 px-1 text-center border-b-2 border-green-500 text-sm md:text-md font-medium leading-5 text-green-600 cursor-default" href="#polls">Polls</a>
                    </li>
                    <li class="flex w-1/3">
                        <a class="w-full py-4 px-1 text-center border-b-2 border-transparent hover:border-gray-300 text-sm md:text-md font-medium leading-5 text-gray-500 hover:text-gray-700" href="#votes">Votes</a>
                    </li>
                    <li class="flex w-1/3">
                        <a class="w-full py-4 px-1 text-center border-b-2 border-transparent hover:border-gray-300 text-sm md:text-md font-medium leading-5 text-gray-500 hover:text-gray-700" href="#comments">Comments</a>
                    </li>
                </ul>
            </nav>
            <article class="profile-tab-content mt-6" id="polls">
                <h2 class="sr-only">Polls</h2>
                @if ($user->polls->isNotEmpty())
                    <ol class="text-left">
                        @foreach ($user->polls as $poll)
                            @include('components.poll-listing', ['poll' => $poll])
                        @endforeach
                    </ol>
                @else
                    <p>This user has not created any polls yet!</p>
                @endif
            </article>

            <article class="profile-tab-content mt-6" id="votes">
                <h2 class="sr-only">Votes</h2>
                @if ($user->votes->isNotEmpty())
                    <ol class="text-left">
                        @foreach ($user->votes as $vote)
                            @include('components.vote-listing', ['poll' => $vote->recipient->poll, 'vote' => $vote])
                        @endforeach
                    </ol>
                @else
                    <p>This user has not voted in any polls yet!</p>
                @endif
            </article>

            <article class="profile-tab-content mt-6" id="comments">
                <h2 class="sr-only">Comments</h2>
                @if ($user->comments->isNotEmpty())
                    <ol class="text-left">
                        @foreach ($user->comments as $comment)
                            @include('components.comment-listing', ['poll' => $comment->poll, 'comment' => $comment])
                        @endforeach
                    </ol>
                @else
                    <p>This user has not commented on any polls yet!</p>
                @endif
            </article>
        </div>
    </div>
</article>
@endsection
