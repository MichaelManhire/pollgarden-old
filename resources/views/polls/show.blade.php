@extends('layouts.app')

@section('title', $poll->title . ' - ' . config('app.name', 'Poll Garden'))

@section('content')
<div class="px-4 py-8 bg-white shadow sm:px-10 sm:rounded-lg">
    <h1 class="text-3xl leading-tight font-extrabold">{{ $poll->title }}</h1>
    <p class="mt-2 text-sm leading-tight text-gray-600">{{ __('Posted by') }} <a class="hover:underline" href="{{ route('users.show', $poll->author) }}">{{ $poll->author->username }}</a> <time datetime="{{ $poll->created_at }}">{{ $poll->created_at->diffForHumans() }}</time> {{ __('in') . ' ' . $poll->category->name }}</p>
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
@if (count($poll->comments) > 0)
    <article class="mt-6">
        <h2 class="mb-2 text-2xl leading-tight font-extrabold">{{ __('Comments') }}</h2>
        @foreach ($poll->comments as $comment)
            <article class="flex items-start max-w-3xl px-2 py-4 bg-white shadow sm:px-5 sm:rounded-lg {{ (! $loop->first) ? 'mt-4' : '' }}">
                <a class="flex-shrink-0 text-center text-white" href="{{ route('users.show', $comment->author->id) }}">
                    <figure>
                        <img class="h-12 w-12 rounded-full shadow-solid" src="{{ $comment->author->avatar }}" alt="" height="48" width="48" loading="lazy">
                        <figcaption class="mt-1 text-sm text-black hover:underline">{{ $comment->author->username }}</figcaption>
                    </figure>
                </a>
                <div class="ml-4">
                    <p>{{ $comment->body }}</p>
                </div>
            </article>
        @endforeach
    </article>
@endif
@endsection
