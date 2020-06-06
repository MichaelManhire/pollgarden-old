@extends('layouts.app')

@section('title', 'Sign Up' . ' - ' . config('app.name', 'Poll Garden'))

@section('content')
<div class="max-w-md mx-auto">
    <div class="text-center">
        <img class="mx-auto" src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Poll Garden') }}" height="64" width="64">
        <h1 class="mt-4 text-3xl leading-9 font-extrabold">{{ __('Sign up for a new account') }}</h1>
        <p class="mt-2 text-sm leading-5 text-gray-600">{{ __('Registering an account allows you to create polls, vote in polls, share your opinions, message other users, and more.') }}</p>
    </div>
    <form class="px-4 py-8 mt-8 bg-white shadow rounded-lg sm:px-10" action="{{ route('register') }}" method="POST">
        @csrf

        <div>
            <label class="text-sm font-medium leading-5 text-gray-700" for="username">{{ __('Username') }}</label>
            <div class="mt-1 rounded-md shadow-sm">
                <input class="form-input block w-full @error('username') border-red-300 text-red-900 @enderror"
                       id="username"
                       name="username"
                       type="text"
                       value="{{ old('username') }}"
                       autocomplete="username"
                       required
                       maxlength="255"
                       @error('username')
                       aria-invalid="true"
                       aria-describedby="username-error"
                       @enderror>
            </div>
            @error('username')
                <p class="mt-2 text-sm text-red-600" id="username-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6">
            <label class="text-sm font-medium leading-5 text-gray-700" for="password">{{ __('Password') }}</label>
            <div class="mt-1 rounded-md shadow-sm">
                <input class="form-input block w-full @error('password') border-red-300 text-red-900 @enderror"
                       id="password"
                       name="password"
                       type="password"
                       autocomplete="new-password"
                       required
                       minlength="8"
                       @error('password')
                       aria-invalid="true"
                       aria-describedby="password-error"
                       @enderror>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-600" id="password-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6">
            <label class="text-sm font-medium leading-5 text-gray-700" for="password-confirm">{{ __('Confirm Password') }}</label>
            <div class="mt-1 rounded-md shadow-sm">
                <input class="form-input block w-full"
                       id="password-confirm"
                       name="password_confirmation"
                       type="password"
                       autocomplete="new-password"
                       required
                       minlength="8">
            </div>
        </div>

        <div class="mt-6 rounded-md shadow-sm">
            <button class="flex justify-center w-full py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-500" type="submit">{{ __('Register Account') }}</button>
        </div>
    </form>
</div>
@endsection
