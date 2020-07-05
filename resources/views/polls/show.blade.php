@extends('layouts.app')

@section('title', $poll->title)

@section('content')
<article>
    <x-panel class="pt-6">
        <div class="flex-1 flex items-start px-6">
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

        @can('create', App\Vote::class)
            <article class="block mt-5" x-data="ballotBox({{ Auth::user()->hasVoted($poll) }})" x-init="initResults()">
                @if (! Auth::user()->hasVoted($poll))
                    <h2 class="sr-only">Vote</h2>
                    <form class="js-ballot-box-form px-6" action="{{ route('votes.store') }}" method="POST">
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
                                            @change="vote()">
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
                    </form>
                @else
                    <h2 class="sr-only">Change Your Vote</h2>
                    <form class="js-ballot-box-form px-6" action="{{ route('votes.update', Auth::user()->vote($poll)->id) }}" method="POST">
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
                                            {{ Auth::user()->vote($poll)->option_id === $option->id ? 'checked' : '' }}
                                            @change="vote()">
                                        <span class="relative z-10">{{ $option->name }}</span>
                                        <span class="relative z-10 float-right font-bold" x-show="isShowingResults">{{ $option->percentage(count($poll->votes)) }}</span>
                                        <span class="result-bar js-result-bar" data-percentage="{{ $option->percentage($poll->votes->count()) }}"></span>
                                    </label>
                                    <div class="flex-shrink-0 ml-3 text-green-600 @if (Auth::user()->vote($poll)->option_id !== $option->id) invisible @endif">
                                        @include('icons.checkmark', ['height' => '24', 'width' => '24'])
                                    </div>
                                </div>
                            @endforeach
                        </fieldset>

                        <button class="sr-only" type="submit">Change Your Vote</button>
                    </form>
                @endif

                <div class="flex mt-6 py-2 px-6 border-t border-gray-100">
                    <div class="text-sm text-gray-600">
                        <div class="inline-block align-middle">
                            @include('icons.poll', ['width' => '16', 'height' => '16'])
                        </div>
                        <p class="inline-block align-middle">{{ $poll->numberOfVotes() }}</p>
                    </div>

                    <div class="ml-4 text-sm text-gray-600">
                        <div class="inline-block align-middle">
                            @include('icons.comment', ['width' => '16', 'height' => '16'])
                        </div>
                        <p class="inline-block align-middle">{{ $poll->numberOfComments() }}</p>
                    </div>

                    <button class="ml-auto text-sm text-green-600 hover:underline"
                            type="button"
                            x-show="! isShowingResults"
                            :disabled="isShowingResults"
                            @click="showResults()">
                        Show Results
                    </button>

                    @can('delete', Auth::user()->vote($poll))
                        <form class="ml-auto" action="{{ route('votes.destroy', Auth::user()->vote($poll)->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="text-sm text-green-600 hover:underline" type="submit">Withdraw Your Vote</button>
                        </form>
                    @endcan
                </div>
            </article>
        @else
            <article class="block mt-5">
                <h2 class="sr-only">Poll Results</h2>
                @foreach ($poll->options as $option)
                    <div class="flex items-center px-6 {{ ($loop->first) ? '' : 'mt-4' }}">
                        <p class="relative flex-grow block py-4 pl-12 pr-4 bg-gray-300 rounded-full">
                            <span class="fancy-radio-button-placeholder"></span>
                            <span class="relative z-10">{{ $option->name }}</span>
                            <span class="relative z-10 float-right font-bold">{{ $option->percentage(count($poll->votes)) }}</span>
                            <span class="result-bar js-result-bar" style="max-width: {{ $option->percentage($poll->votes->count()) }};"></span>
                        </p>
                        <div class="flex-shrink-0 ml-3 text-green-600 invisible">
                            @include('icons.checkmark', ['height' => '24', 'width' => '24'])
                        </div>
                    </div>
                @endforeach
            </article>

            <div class="flex mt-6 py-2 px-6 border-t border-gray-100">
                <div class="text-sm">
                    <div class="inline-block align-middle">
                        @include('icons.poll', ['width' => '16', 'height' => '16'])
                    </div>
                    <p class="inline-block align-middle">{{ $poll->numberOfVotes() }}</p>
                </div>
            </div>
        @endcan
    </x-panel>

    <article class="mt-6">
        <h2 class="text-2xl leading-tight font-extrabold">Comments</h2>

        @include('_comment-form', ['id' => 'comment-for-poll-' . $poll->id, 'isReply' => false])

        @if ($comments->isNotEmpty())
            <ol id="comments">
                @foreach ($comments as $comment)
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

        @if ($comments->hasPages())
            {{ $comments->fragment('comments')->links() }}
        @endif
    </article>
</article>
@endsection
