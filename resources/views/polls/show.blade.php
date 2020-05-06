@extends('layouts.app')

@section('title', $poll->title . ' - ' . config('app.name', 'Poll Garden'))

@section('content')
<div class="px-4 py-8 bg-white shadow sm:px-10 sm:rounded-lg">
    <h1 class="text-3xl leading-tight font-extrabold">{{ $poll->title }}</h1>
    <p class="mt-2 text-sm leading-tight text-gray-600">{{ __('Posted by') }} <a class="hover:underline" href="{{ route('users.show', $poll->author) }}">{{ $poll->author->username }}</a> <time datetime="{{ $poll->created_at }}">{{ $poll->created_at->diffForHumans() }}</time> {{ __('in') . ' ' . $poll->category->name }}</p>
    <form class="mt-8 max-w-2xl" action="" method="POST">
        @csrf

        <fieldset>
            <legend class="sr-only">{{ $poll->title }}</legend>
            @foreach ($poll->options as $option)
                <label class="relative block pl-12 pr-4 py-4 mb-4 rounded-full bg-gray-300 cursor-pointer" for="option{{ $loop->index }}">
                    <input class="appearance-none fancy-radio-button" id="option{{ $loop->index }}" name="options" type="radio">
                    <span>{{ $option->name }}</span>
                    <span class="float-right">{{ round(count($option->votes) / count($poll->votes) * 100) . '%'}}</span>
                </label>
            @endforeach
        </fieldset>
    </form>
</div>
@endsection
