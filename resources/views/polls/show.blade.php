@extends('layouts.app')

@section('title', $poll->title)

@section('content')
<article>
    <x-panel class="p-6">
        <div class="flex-1 flex items-start">
            <div class="flex-shrink-0 text-white">
                <x-avatar :src="$poll->getImage()" :width="64" :height="64" />
            </div>

            <div class="ml-4">
                <h1 class="text-3xl leading-tight font-extrabold">{{ $poll->title }}</h1>

                <div class="mt-2 text-sm leading-tight text-gray-500">
                    <p class="inline-block mb-2 mr-2">
                        <span>Posted by</span>
                        <a class="text-green-600 hover:underline" href="{{ route('users.show', $poll->author) }}">{{ $poll->author->username }}</a>
                        <time datetime="{{ $poll->created_at }}">{{ $poll->created_at->diffForHumans() }}</time>
                        <span>in {{ $poll->category->name }}</span>
                        @if ($poll->created_at != $poll->updated_at)
                            <span>(edited <time datetime="{{ $poll->updated_at }}">{{ $poll->updated_at->diffForHumans() }})</time></span>
                        @endif
                    </p>

                    @can('update', $poll)
                        <a class="inline-block mb-2 mr-2 text-green-600 hover:underline" href="{{ route('polls.edit', $poll) }}">Edit Poll</a>
                    @endcan

                    @can('delete', $poll)
                        <form class="inline-block mb-2" action="{{ route('polls.destroy', $poll) }}" method="POST" x-data @submit.prevent="if (confirm('Are you sure you want to delete your poll?')) { $el.submit() }">
                            @csrf
                            @method('DELETE')

                            <input name="id" type="hidden" value="{{ $poll->id }}">
                            <button class="text-green-600 hover:underline" type="submit">Delete Poll</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>

        @auth
        <article class="block mt-5">
            @if (! Auth::user()->hasVoted($poll))
                <h2 class="sr-only">Vote</h2>
                <form action="{{ route('votes.store') }}" method="POST" x-data="{ isShowingResults: false }">
                    @csrf

                    <fieldset>
                        <legend class="sr-only">{{ $poll->title }}</legend>
                        @foreach ($poll->options as $option)
                            <div class="flex items-center {{ ($loop->first) ? '' : 'mt-4' }}">
                                <label class="relative flex-grow block py-4 pl-12 pr-4 bg-gray-300 rounded-full cursor-pointer" for="{{ $option->id }}">
                                    <input class="fancy-radio-button"
                                           id="{{ $option->id }}"
                                           name="option_id"
                                           type="radio"
                                           value="{{ $option->id }}"
                                           required
                                           @change="$el.submit()">
                                    <span class="relative z-10">{{ $option->name }}</span>
                                    <span class="relative z-10 float-right font-bold" x-show="isShowingResults">{{ $option->percentage(count($poll->votes)) }}</span>
                                    <span class="result-bar js-result-bar" data-percentage="{{ $option->percentage($poll->votes->count()) }}"></span>
                                </label>
                                <div class="flex-shrink-0 ml-3 text-green-600 invisible">
                                    @include('icons.checkmark', ['height' => '24', 'width' => '24'])
                                </div>
                            </div>
                        @endforeach
                    </fieldset>

                    <button class="sr-only" type="submit">Cast Your Vote</button>

                    <div class="mt-2 ml-5">
                        <button class="text-sm text-green-600 hover:underline" type="button" @click="isShowingResults = true; document.querySelectorAll('.js-result-bar').forEach(function (resultBar) { resultBar.style.maxWidth = resultBar.dataset.percentage })">Show Results</button>
                    </div>
                </form>
            @else
                <h2 class="sr-only">Change Your Vote</h2>
                <form action="{{ route('votes.update', $poll->usersVote(Auth::id())) }}" method="POST" x-data="{ isShowingResults: false }">
                    @csrf
                    @method('PATCH')

                    <fieldset>
                        <legend class="sr-only">{{ $poll->title }}</legend>
                        @foreach ($poll->options as $option)
                            <div class="flex items-center {{ ($loop->first) ? '' : 'mt-4' }}">
                                <label class="relative flex-grow block py-4 pl-12 pr-4 bg-gray-300 rounded-full cursor-pointer" for="{{ $option->id }}">
                                    <input class="fancy-radio-button"
                                           id="{{ $option->id }}"
                                           name="option_id"
                                           type="radio"
                                           value="{{ $option->id }}"
                                           required
                                           {{ $poll->usersVote(Auth::id())->option_id === $option->id ? 'checked' : '' }}
                                           @change="$el.submit()">
                                    <span class="relative z-10">{{ $option->name }}</span>
                                    <span class="relative z-10 float-right font-bold" x-show="isShowingResults">{{ $option->percentage(count($poll->votes)) }}</span>
                                    <span class="result-bar js-result-bar" data-percentage="{{ $option->percentage($poll->votes->count()) }}"></span>
                                </label>
                                <div class="flex-shrink-0 ml-3 text-green-600 @if ($poll->usersVote(Auth::id())->option_id !== $option->id) invisible @endif">
                                    @include('icons.checkmark', ['height' => '24', 'width' => '24'])
                                </div>
                            </div>
                        @endforeach
                    </fieldset>

                    <button class="sr-only" type="submit">Change Your Vote</button>

                    <div class="mt-2 ml-5">
                        <button class="text-sm text-green-600 hover:underline" type="button" @click="isShowingResults = true; document.querySelectorAll('.js-result-bar').forEach(function (resultBar) { resultBar.style.maxWidth = resultBar.dataset.percentage })">Show Results</button>
                    </div>
                </form>

                <form class="mt-3 text-right text-sm" action="{{ route('votes.destroy', $poll->usersVote(Auth::id())) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="text-green-600 hover:underline" type="submit">Withdraw Your Vote</button>
                </form>
            @endif
        </article>
        @endauth
    </x-panel>

    <article class="mt-6">
        <h2 class="text-2xl leading-tight font-extrabold">Comments</h2>

        @include('_comment-form', ['id' => 'comment-for-poll-' . $poll->id, 'isReply' => false])

        @if ($poll->parentComments->isNotEmpty())
            <ol>
                @foreach ($poll->parentComments as $comment)
                    <li class="my-4" x-data="comment()">
                        @include('_comment', ['comment' => $comment])
                        @include('_comment-form-edit', ['comment' => $comment, 'id' => 'edit-for-comment-' . $comment->id, 'isReply' => false])
                        @include('_comment-form', ['id' => 'reply-for-comment-' . $comment->id, 'isReply' => true])
                    </li>

                    @if ($comment->replies->isNotEmpty())
                        <ol class="ml-8">
                            @foreach ($comment->replies as $reply)
                                <li class="my-4" x-data="comment()">
                                    @include('_comment', ['comment' => $reply])
                                    @include('_comment-form-edit', ['comment' => $reply, 'id' => 'edit-for-comment-' . $reply->id, 'isReply' => true])
                                    @include('_comment-form', ['id' => 'reply-for-comment-' . $reply->id, 'isReply' => true])
                                </li>
                            @endforeach
                        </ol>
                    @endif
                @endforeach
            </ol>
        @endif
    </article>
</article>
@endsection
