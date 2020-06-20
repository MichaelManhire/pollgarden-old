@extends('layouts.app')

@section('title', $user->username)

@section('content')
<article class="px-4 mt-12 text-center bg-white shadow rounded-lg sm:px-10">
    <div class="overlay">
        <div class="text-white">
            @include('_avatar', ['imageSrc' => $user->avatar, 'height' => 96, 'width' => 96, 'username' => $user->username])
        </div>

        <h1 class="mt-2 text-3xl leading-tight font-extrabold sm:text-4xl">{{ $user->username }}</h1>

        <div class="md:flex md:justify-between mt-8 text-left">
            <article class="md:px-2" style="flex: 1 0 225px;">
                <h2 class="text-xl font-medium leading-tight">Profile Details</h2>
                <dl class="mt-1.5 text-sm clearfix">
                    <dt class="float-left clear-left text-gray-600">Age:</dt>
                    <dd class="float-left ml-1 font-medium">27</time></dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">Gender:</dt>
                    <dd class="float-left mt-1 ml-1 font-medium">Male</dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">Country:</dt>
                    <dd class="float-left mt-1 ml-1 font-medium">United States</dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">State:</dt>
                    <dd class="float-left mt-1 ml-1 font-medium">California</dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">Education:</dd>
                    <dd class="float-left mt-1 ml-1 font-medium">Some College</dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">Career:</dd>
                    <dd class="float-left mt-1 ml-1 font-medium">Technology</dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">Ethnicity:</dt>
                    <dd class="float-left mt-1 ml-1 font-medium">White</dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">Religion:</dd>
                    <dd class="float-left mt-1 ml-1 font-medium">Agnostic</dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">Politics:</dd>
                    <dd class="float-left mt-1 ml-1 font-medium">Moderate</dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">Orientation:</dd>
                    <dd class="float-left mt-1 ml-1 font-medium">Straight</dd>
                    <dt class="float-left clear-left mt-1 text-gray-600">Zodiac Sign:</dd>
                    <dd class="float-left mt-1 ml-1 font-medium">Taurus</dd>
                </dl>
            </article>
            @if ($user->description)
                <article class="md:px-2">
                    <h2 class="text-xl font-medium leading-tight">Description</h2>
                    <p class="max-w-3xl mt-1.5">{{ $user->description }}</p>
                </article>
            @endif
            <article class="md:px-2" style="flex: 0 0 200px;">
                <h2 class="text-xl font-medium leading-tight">Activity</h2>
                <dl class="mt-1.5 text-sm">
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
        </div>

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
    </div>
</article>
@endsection
