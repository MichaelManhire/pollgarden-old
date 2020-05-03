@extends('layouts.app')

@section('content')
<main class="flex-grow flex-shrink-0 bg-gray-50">
    @include('components.page-title', ['title' => $poll->title])

    <div class="container py-12">
        <form class="max-w-2xl" action="{{ route('polls.store') }}" method="POST">
            @csrf

            <fieldset>
                <legend class="sr-only">{{ $poll->title }}</legend>
                @for ($i = 0; $i < 5; $i++)
                    <label class="relative block pl-12 pr-4 py-4 mb-4 rounded-full bg-white cursor-pointer" for="option{{ $i }}">
                        <input class="appearance-none fancy-radio-button" id="option{{ $i }}" name="options" type="radio">
                        <span>Option {{ $i }}</span>
                        <span class="float-right">15%</span>
                    </label>
                @endfor
            </fieldset>
        </form>
    </div>
</main>
@endsection
