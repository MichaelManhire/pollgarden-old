@extends('layouts.app')

@section('title', $user->username)

@section('content')
<article>
    <x-panel class="px-4 sm:px-10 mt-12 text-center">
        <div class="overlay">
            <div class="text-white">
                @include('_avatar', ['imageSrc' => $user->avatar, 'height' => 96, 'width' => 96, 'username' => $user->username])
            </div>

            <h1 class="mt-2 text-3xl leading-tight font-extrabold sm:text-4xl">{{ $user->username }}</h1>

            @if ($user->description)
                <p class="max-w-3xl mt-4 mx-auto">{{ $user->description }}</p>
            @endif
        </div>
    </x-panel>

    <div class="lg:flex lg:justify-between mt-4">
        <x-panel class="lg:order-1 p-4 lg:ml-2 min-w-1/4 whitespace-no-wrap">
            <article>
                <h2 class="text-xl font-medium leading-tight">Profile Details</h2>
                <dl class="mt-0.5 text-sm clearfix">
                    @if ($user->age)
                        <dt class="float-left clear-left mt-1 text-gray-600">Age:</dt>
                        <dd class="float-left mt-1 ml-1 font-medium">{{ $user->age }}</time></dd>
                    @endif
                    @if ($user->gender)
                        <dt class="float-left clear-left mt-1 text-gray-600">Gender:</dt>
                        <dd class="float-left mt-1 ml-1 font-medium">{{ $user->gender->name }}</time></dd>
                    @endif
                    @if ($user->country)
                        <dt class="float-left clear-left mt-1 text-gray-600">Country:</dt>
                        <dd class="float-left mt-1 ml-1 font-medium">{{ $user->country->name }}</time></dd>
                    @endif
                    @if ($user->state)
                        <dt class="float-left clear-left mt-1 text-gray-600">State:</dt>
                        <dd class="float-left mt-1 ml-1 font-medium">{{ $user->state->name }}</time></dd>
                    @endif
                    @if ($user->educationLevel)
                        <dt class="float-left clear-left mt-1 text-gray-600">Education:</dt>
                        <dd class="float-left mt-1 ml-1 font-medium">{{ $user->educationLevel->name }}</time></dd>
                    @endif
                    @if ($user->career)
                        <dt class="float-left clear-left mt-1 text-gray-600">Career:</dt>
                        <dd class="float-left mt-1 ml-1 font-medium">{{ $user->career->name }}</time></dd>
                    @endif
                    @if ($user->orientation)
                        <dt class="float-left clear-left mt-1 text-gray-600">Orientation:</dt>
                        <dd class="float-left mt-1 ml-1 font-medium">{{ $user->orientation->name }}</time></dd>
                    @endif
                    @if ($user->ethnicity)
                        <dt class="float-left clear-left mt-1 text-gray-600">Ethnicity:</dt>
                        <dd class="float-left mt-1 ml-1 font-medium">{{ $user->ethnicity->name }}</time></dd>
                    @endif
                    @if ($user->zodiacSign)
                        <dt class="float-left clear-left mt-1 text-gray-600">Zodiac Sign:</dt>
                        <dd class="float-left mt-1 ml-1 font-medium">{{ $user->zodiacSign->name }}</time></dd>
                    @endif
                    @if ($user->religion)
                        <dt class="float-left clear-left mt-1 text-gray-600">Religion:</dt>
                        <dd class="float-left mt-1 ml-1 font-medium">{{ $user->religion->name }}</time></dd>
                    @endif
                    @if ($user->politics)
                        <dt class="float-left clear-left mt-1 text-gray-600">Politics:</dt>
                        <dd class="float-left mt-1 ml-1 font-medium">{{ $user->politics->name }}</time></dd>
                    @endif
                </dl>
            </article>

            <article class="mt-6">
                <h2 class="text-xl font-medium leading-tight">Activity</h2>
                <dl class="mt-0.5 text-sm clearfix">
                    <dt class="float-left clear-left mt-1 text-gray-600">Polls Created:</dt>
                    <dd class="float-left mt-1 ml-1 font-medium">{{ $user->polls->count() }}</dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">Votes Cast:</dt>
                    <dd class="float-left mt-1 ml-1 font-medium">{{ $user->votes->count() }}</dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">Comments Posted:</dt>
                    <dd class="float-left mt-1 ml-1 font-medium">{{ $user->comments->count() }}</dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">Join Date:</dt>
                    <dd class="float-left mt-1 ml-1 font-medium"><time datetime="{{ $user->created_at }}">{{ $user->created_at->diffForHumans() }}</time></dd>
                </dl>
            </article>
        </x-panel>

        <x-panel class="lg:flex-grow mt-4 lg:mt-0 lg:mr-2">
            <nav class="border-b border-gray-200" aria-label="Profile tabs">
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
                            @include('_poll-listing', ['poll' => $poll])
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
                            @include('_vote-listing', ['poll' => $vote->recipient->poll, 'vote' => $vote])
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
                            @include('_comment-listing', ['poll' => $comment->poll, 'comment' => $comment])
                        @endforeach
                    </ol>
                @else
                    <p>This user has not commented on any polls yet!</p>
                @endif
            </article>
        </x-panel>
    </div>
</article>
@endsection
