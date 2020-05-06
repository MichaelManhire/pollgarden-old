@extends('layouts.app')

@section('title', $user->username . ' - ' . config('app.name', 'Poll Garden'))

@section('content')
    <div class="px-4 mt-12 text-center bg-white shadow sm:px-10 sm:rounded-lg">
        <div class="overlay">
            <div class="text-white">
                <img class="mx-auto rounded-full shadow-solid" src="{{ $user->avatar }}" alt="" width="96" height="96">
            </div>
            <h1 class="mt-2 text-3xl leading-tight font-extrabold tracking-tight sm:text-4xl">{{ $user->username }}</h1>
            @if ($user->description)
                <p class="max-w-xl mx-auto mt-4">{{ $user->description }}</p>
            @endif
            <div>
                <div class="sm:hidden">
                    <select class="form-select block w-full" aria-hidden="true">
                        <option selected>{{ __('Polls') }}</option>
                        <option>{{ __('Votes') }}</option>
                        <option>{{ __('Comments') }}</option>
                        <option>{{ __('Details') }}</option>
                    </select>
                </div>
                <nav class="hidden sm:block mt-8 border-b border-gray-200" aria-label="Profile tabs">
                    <ul class="flex -mb-px">
                        <li class="flex w-1/4">
                            <a class="w-full py-4 px-1 text-center border-b-2 border-green-500 font-medium text-sm leading-5 text-green-600 cursor-default md:text-md" href="#polls" aria-current="true">{{ __('Polls') }}</a>
                        </li>
                        <li class="flex w-1/4">
                            <a class="w-full py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 md:text-md" href="#votes">{{ __('Votes') }}</a>
                        </li>
                        <li class="flex w-1/4">
                            <a class="w-full py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 md:text-md" href="#comments">{{ __('Comments') }}</a>
                        </li>
                        <li class="flex w-1/4">
                            <a class="w-full py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 md:text-md" href="#details">{{ __('Details') }}</a>
                        </li>
                    </ul>
                </nav>
                <article class="mt-6" id="polls">
                    <h2 class="sr-only">{{ __('Polls by') . ' ' . $user->username }}</h2>
                    @if (count($user->polls) > 0)
                        <ol class="text-left">
                            @foreach ($user->polls as $poll)
                                @include('components.poll-listing', ['poll' => $poll])
                            @endforeach
                        </ol>
                    @else
                        <p>{{ $user->username . ' ' . __('has not created any polls yet!') }}</p>
                    @endif
                </article>
            </div>
        </div>
    </div>
@endsection
