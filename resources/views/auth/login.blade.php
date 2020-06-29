@extends('layouts.app')

@section('title', 'Log In')

@section('content')
<article class="max-w-md mx-auto">
    <x-form-header>
        <x-slot name="title">Log In to Your Account</x-slot>

        Or, if you need to create an account, <a class="font-medium text-green-600 hover:text-green-500 hover:underline" href="{{ route('register') }}">sign up for a new account</a>.
    </x-form-header>

    <x-panel class="px-4 sm:px-10 py-8 mt-8">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div>
                <label class="block text-sm font-medium leading-tight" for="username">Username</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <input class="form-input block w-full @error('username') border-red-300 text-red-900 @enderror"
                           id="username"
                           name="username"
                           type="text"
                           value="{{ old('username') }}"
                           required
                           autocomplete="username"
                           autofocus
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
                <label class="block text-sm font-medium leading-tight" for="password">Password</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <input class="form-input block w-full @error('password') border-red-300 text-red-900 @enderror"
                           id="password"
                           name="password"
                           type="password"
                           required
                           autocomplete="current-password"
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
                <x-button class="w-full">Log In</x-button>
            </div>
        </form>
    </x-panel>
</article>
@endsection
