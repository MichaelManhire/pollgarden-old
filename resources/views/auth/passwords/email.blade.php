@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="text-center">
        <img class="mx-auto" src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Poll Garden') }}" height="64" width="64">
        <h1 class="mt-4 text-3xl leading-9 font-extrabold">{{ __('Reset Password') }}</h1>
    </div>
    <form class="px-4 py-8 mt-8 bg-white shadow sm:px-10 sm:rounded-lg" action="{{ route('login') }}" method="POST">
        @csrf

        <div>
            <label class="text-sm font-medium leading-5 text-gray-700" for="email">{{ __('Email') }}</label>
            <div class="mt-1 rounded-md shadow-sm">
                <input class="form-input block w-full @error('email') border-red-300 text-red-900 @enderror"
                       id="email"
                       name="email"
                       type="text"
                       value="{{ old('email') }}"
                       autocomplete="email"
                       required
                       @error('email')
                       aria-invalid="true"
                       aria-describedby="email-error"
                       @enderror>
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 rounded-md shadow-sm">
            <button class="flex justify-center w-full py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-500" type="submit">{{ __('Send Password Reset Link') }}</button>
        </div>
    </form>
</div>
@endsection
