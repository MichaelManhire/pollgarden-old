@extends('layouts.app')

@section('title', 'Log In' . ' - ' . config('app.name', 'Poll Garden'))

@section('content')
<div class="max-w-md mx-auto">
    <div class="text-center">
        <img class="mx-auto" src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Poll Garden') }}" height="64" width="64">
        <h1 class="mt-4 text-3xl leading-9 font-extrabold">{{ __('Log in to your account') }}</h1>
        <p class="mt-2 text-sm leading-5 text-gray-600">
            {{ __('Or') }} <a class="font-medium text-green-600 hover:text-green-500 hover:underline" href="{{ route('register') }}">{{ __('register a new account') }}</a>
        </p>
    </div>
    <form class="px-4 py-8 mt-8 bg-white shadow rounded-lg sm:px-10" action="{{ route('login') }}" method="POST">
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
                       autocomplete="current-password"
                       required
                       @error('password')
                       aria-invalid="true"
                       aria-describedby="password-error"
                       @enderror>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-600" id="password-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between items-center mt-6">
            <div class="flex items-center">
                <input class="form-checkbox h-4 w-4 text-green-600" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                <label class="ml-2 text-sm leading-5" for="remember">{{ __('Remember Me') }}</label>
            </div>

            <div class="text-sm leading-5">
                <a class="font-medium text-green-600 hover:text-green-500 hover:underline" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            </div>
        </div>

        <div class="mt-6 rounded-md shadow-sm">
            <button class="flex justify-center w-full py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-500" type="submit">{{ __('Log In') }}</button>
        </div>
    </form>
</div>
@endsection
