@extends('layouts.app')

@section('content')
<form class="max-w-2xl" action="{{ route('polls.store') }}" method="POST">
    @csrf

    <fieldset>
        <legend class="sr-only">{{ $poll->title }}</legend>
        @foreach ($poll->options as $option)
            <label class="relative block pl-12 pr-4 py-4 mb-4 rounded-full bg-white cursor-pointer" for="option{{ $loop->index }}">
                <input class="appearance-none fancy-radio-button" id="option{{ $loop->index }}" name="options" type="radio">
                <span>{{ $option->name }}</span>
                <span class="float-right">15%</span>
            </label>
        @endforeach
    </fieldset>
</form>
@endsection
