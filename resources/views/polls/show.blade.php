@extends('layouts.app')

@section('title', $poll->title . ' - ' . config('app.name', 'Poll Garden'))

@section('content')
<div class="px-4 py-8 bg-white shadow sm:px-10 sm:rounded-lg">
    <h1 class="text-3xl leading-tight font-extrabold">{{ $poll->title }}</h1>
    <p class="mt-2 text-sm leading-tight text-gray-600">{{ __('Posted by') }} <a class="hover:underline" href="{{ route('users.show', $poll->author) }}">{{ $poll->author->username }}</a> <time datetime="{{ $poll->created_at }}">{{ $poll->created_at->diffForHumans() }}</time> {{ __('in') . ' ' . $poll->category->name }}</p>
    <div class="block mt-8 max-w-2xl"
         id="ballot-box"
         data-endpoint-url="{{ route('votes.store') }}"
         data-is-showing-results="{{ (Auth::check() && $poll->hasBeenVotedOnBy(auth()->user()->id)) ? true : false }}"
         data-poll-id="{{ $poll->id }}">
        @if (Auth::check() && $poll->hasBeenVotedOnBy(auth()->user()->id))
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
@endsection
