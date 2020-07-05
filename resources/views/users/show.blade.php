@extends('layouts.app')

@section('title', $user->username)

@section('content')
<article>
    <x-panel class="px-4 sm:px-10 mt-12 text-center">
        <div class="overlay">
            <div class="text-white">
                <x-avatar :src="$user->getAvatar()" width="96" height="96" />
            </div>

            <h1 class="mt-2 text-3xl leading-tight font-extrabold sm:text-4xl">
                {{ $user->username }}
                @if ($user->is_deleted)
                    <span class="block text-red-600">[DELETED]</span>
                @endif
            </h1>

            @if ($user->description)
                <p class="max-w-3xl mt-4 mx-auto">{{ $user->description }}</p>
            @endif
        </div>
    </x-panel>

    <div class="lg:flex lg:justify-between lg:items-start mt-4">
        <x-panel class="lg:order-1 p-4 lg:ml-2 min-w-1/4 whitespace-no-wrap">
            <div class="sm:flex sm:justify-around lg:block">
                @if ($user->age || $user->gender || $user->county)
                    <article class="sm:px-2 lg:px-0 mb-6 sm:mb-0 lg:mb-6">
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
                        </dl>
                    </article>
                @endif

                <article class="sm:px-2 lg:px-0">
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
                @auth
                    <article class="sm:px-2 lg:px-0 mt-6 sm:mt-0 lg:mt-6">
                        @can('update', $user)
                        <a class="block lg:w-full py-2 px-4 mt-2 text-sm font-medium leading-5 text-white text-center border-1 border-transparent rounded-md bg-green-600 hover:bg-green-500 transition-colors duration-150 ease-in-out"
                           href="{{ route('users.edit', $user) }}">
                            Edit Profile
                        </a>
                        @endcan
                        @if (Auth::id() !== $user->id)
                            @can('create', App\Conversation::class)
                                <a class="block lg:w-full py-2 px-4 mt-2 text-sm font-medium leading-5 text-white text-center border-1 border-transparent rounded-md bg-green-600 hover:bg-green-500 transition-colors duration-150 ease-in-out"
                                href="{{ route('conversations.create', ['recipient_id' => $user->id, 'recipient_name' => $user->username, 'recipient_slug' => $user->slug]) }}">
                                    Send Message
                                </a>
                            @endcan
                        @endif
                    </article>
                @endauth
            </div>
        </x-panel>

        <x-panel class="lg:flex-grow mt-4 lg:mt-0 lg:mr-2">
            <div x-data="{ activeTab: '#polls' }" x-init="function () { if (window.location.hash) { this.activeTab = window.location.hash } }">
                <nav class="border-b border-gray-200" aria-label="Profile tabs">
                    <ul class="flex -mb-px">
                        <li class="flex w-1/3">
                            <a class="w-full py-4 px-1 text-center border-b-2 border-transparent hover:border-gray-300 text-sm md:text-md font-medium leading-5 text-gray-500 hover:text-gray-700 transition-colors duration-150 ease-in-out"
                               href="#polls"
                               :class="{ 'border-green-500 hover:border-green-500 text-green-600 hover:text-green-600 cursor-default': activeTab === '#polls' }"
                               @click="activeTab = '#polls'">
                                Polls
                            </a>
                        </li>
                        <li class="flex w-1/3">
                            <a class="w-full py-4 px-1 text-center border-b-2 border-transparent hover:border-gray-300 text-sm md:text-md font-medium leading-5 text-gray-500 hover:text-gray-700 transition-colors duration-150 ease-in-out"
                               href="#votes"
                               :class="{ 'border-green-500 hover:border-green-500 text-green-600 hover:text-green-600 cursor-default': activeTab === '#votes' }"
                               @click="activeTab = '#votes'">
                                Votes
                            </a>
                        </li>
                        <li class="flex w-1/3">
                            <a class="w-full py-4 px-1 text-center border-b-2 border-transparent hover:border-gray-300 text-sm md:text-md font-medium leading-5 text-gray-500 hover:text-gray-700 transition-colors duration-150 ease-in-out"
                               href="#comments"
                               :class="{ 'border-green-500 hover:border-green-500 text-green-600 hover:text-green-600 cursor-default': activeTab === '#comments' }"
                               @click="activeTab = '#comments'">
                                Comments
                            </a>
                        </li>
                    </ul>
                </nav>

                <article id="polls" x-show="activeTab === '#polls'">
                    <h2 class="sr-only">Polls</h2>
                    <ol class="text-left">
                        @forelse ($polls as $poll)
                            @include('_poll-listing', ['poll' => $poll])
                        @empty
                            <li class="p-4">{{ $user->username }} has not created any polls yet!</li>
                        @endforelse
                    </ol>

                    @if ($polls->hasPages())
                        <div class="px-4 border-t border-gray-100">
                            {{ $polls->fragment('polls')->links() }}
                        </div>
                    @endif
                </article>

                <article id="votes" x-show="activeTab === '#votes'">
                    <h2 class="sr-only">Votes</h2>
                    <ol class="text-left">
                        @forelse ($votes as $vote)
                            @include('_vote-listing', ['poll' => $vote->recipient->poll, 'vote' => $vote])
                        @empty
                            <li class="p-4">{{ $user->username }} has not voted in any polls yet!</li>
                        @endforelse
                    </ol>

                    @if ($votes->hasPages())
                        <div class="px-4 border-t border-gray-100">
                            {{ $votes->fragment('votes')->links() }}
                        </div>
                    @endif
                </article>

                <article id="comments" x-show="activeTab === '#comments'">
                    <h2 class="sr-only">Comments</h2>
                    <ol class="text-left">
                        @forelse ($comments as $comment)
                            @include('_comment-listing', ['poll' => $comment->poll, 'comment' => $comment])
                        @empty
                            <li class="p-4">{{ $user->username }} has not commented on any polls yet!</li>
                        @endforelse
                    </ol>

                    @if ($comments->hasPages())
                        <div class="px-4 border-t border-gray-100">
                            {{ $comments->fragment('comments')->links() }}
                        </div>
                    @endif
                </article>
            </div>
        </x-panel>
    </div>
</article>
@endsection
