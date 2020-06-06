@extends('layouts.app')

@section('title', $poll->title . ' - ' . config('app.name', 'Poll Garden'))

@section('content')
<div class="px-4 py-8 bg-white shadow sm:px-10 sm:rounded-lg">
    <h1 class="text-3xl leading-tight font-extrabold">{{ $poll->title }}</h1>

    <div class="mt-2 text-sm leading-tight text-gray-600">
        <p class="inline-block">{{ __('Posted by') }} <a class="text-green-600 hover:underline" href="{{ route('users.show', $poll->author) }}">{{ $poll->author->username }}</a> <time datetime="{{ $poll->created_at }}">{{ $poll->created_at->diffForHumans() }}</time> {{ __('in') . ' ' . $poll->category->name }}</p>
        @can('update', $poll)
            <a class="inline-block ml-2 text-green-600 hover:underline" href="{{ route('polls.edit', $poll) }}">{{ __('Edit Poll') }}</a>
        @endcan
    </div>

    <div class="block mt-8 max-w-2xl"
         id="ballot-box"
         data-endpoint-url-store="{{ route('votes.store') }}"
         data-endpoint-url-update="{{ route('votes.update', $poll->id) }}"
         data-is-showing-results="{{ (Auth::check() && $poll->optionVotedForBy(auth()->user()->id)) ? true : false }}"
         data-option-voted-for-id="{{ (Auth::check() && $poll->optionVotedForBy(auth()->user()->id)) ? $poll->optionVotedForBy(auth()->user()->id) : '' }}"
         data-poll-id="{{ $poll->id }}">
        @if (Auth::check() && $poll->optionVotedForBy(auth()->user()->id))
            <table class="block">
                <caption class="sr-only">{{ $poll->title }}</caption>
                <thead class="sr-only">
                    <tr>
                        <th scope="col">{{ __('Option Name') }}</th>
                        <th scope="col">{{ __('Percentage Voted For') }}</th>
                    </tr>
                </thead>
                <tbody class="block">
                    @foreach ($poll->options as $option)
                        <tr class="flex justify-between pl-12 pr-4 py-4 mb-4 rounded-full bg-gray-300" style="background: linear-gradient(to right, #bcf0da {{ $option->percentage(count($poll->votes)) }}, #d2d6dc {{ $option->percentage(count($poll->votes)) }});">
                            <td>{{ $option->name }}</td>
                            <td>{{ $option->percentage(count($poll->votes)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <form action="{{ route('votes.store') }}" method="POST">
                @csrf

                <fieldset>
                    <legend class="sr-only">{{ $poll->title }}</legend>
                    @foreach ($poll->options as $option)
                        <label class="relative block pl-12 pr-4 py-4 mb-4 rounded-full bg-gray-300 cursor-pointer" for="{{ $option->id }}">
                            <input class="appearance-none fancy-radio-button" id="{{ $option->id }}" name="option_id" type="radio" value="{{ $option->id }}">
                            <span>{{ $option->name }}</span>
                            <span>{{ $option->percentage(count($poll->votes)) }}</span>
                        </label>
                    @endforeach
                </fieldset>

                <button class="sr-only" type="submit">Cast Your Vote</button>
            </form>
        @endif
    </div>
</div>

@if ($poll->parentComments->isNotEmpty())
    <div class="mt-6">
        <h2 class="mb-2 text-2xl leading-tight font-extrabold">{{ __('Comments') }}</h2>

        @include('components.comment-form', ['id' => 'comment-for-poll-' . $poll->id, 'isReply' => false])

        <ol>
            @foreach ($poll->parentComments->sortByDesc('created_at') as $comment)
                <li class="js-comment mt-4 mb-4">
                    @include('components.comment', ['comment' => $comment])
                    @include('components.comment-form-edit', ['comment' => $comment, 'id' => 'edit-for-comment-' . $comment->id, 'isReply' => false])
                    @include('components.comment-form', ['id' => 'reply-for-comment-' . $comment->id, 'isReply' => true])
                </li>

                @if ($comment->childComments->isNotEmpty())
                    <ol class="ml-8">
                        @foreach ($comment->childComments->sortByDesc('created_at') as $childComment)
                            <li class="js-comment mt-4 mb-4">
                                @include('components.comment', ['comment' => $childComment])
                                @include('components.comment-form-edit', ['comment' => $childComment, 'id' => 'edit-for-comment-' . $comment->id, 'isReply' => true])
                                @include('components.comment-form', ['id' => 'reply-for-comment-' . $childComment->id, 'isReply' => true])
                            </li>
                        @endforeach
                    </ol>
                @endif
            @endforeach
        </ol>
    </div>
@endif
@endsection
