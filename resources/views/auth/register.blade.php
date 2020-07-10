@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
<article class="max-w-md mx-auto">
    <x-form-header>
        <x-slot name="title">Sign Up for an Account</x-slot>

        Signing up for an account will allow you to create your own polls, vote in other polls, share your opinion on various topics, message other users, and so much more.
    </x-form-header>

    <x-panel class="px-4 sm:px-10 py-8 mt-8">
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div>
                <label class="block text-sm font-medium leading-tight" for="username">Username</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <input class="form-input block w-full @error('username') border-red-300 text-red-900 @enderror"
                           id="username"
                           name="username"
                           type="text"
                           value="{{ old('username') }}"
                           autocomplete="username"
                           autofocus
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

            <div class="mt-4">
                <label class="block text-sm font-medium leading-tight" for="email">Email</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <input class="form-input block w-full @error('email') border-red-300 text-red-900 @enderror"
                           id="email"
                           name="email"
                           type="email"
                           required
                           autocomplete="email"
                           maxlength="255"
                           @error('email')
                           aria-invalid="true"
                           aria-describedby="email-error"
                           @enderror>
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium leading-tight" for="password">Password</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <input class="form-input block w-full @error('password') border-red-300 text-red-900 @enderror"
                           id="password"
                           name="password"
                           type="password"
                           required
                           autocomplete="new-password"
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

            <div class="mt-4">
                <label class="block text-sm font-medium leading-tight" for="password-confirm">Confirm Password</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <input class="form-input block w-full"
                           id="password-confirm"
                           name="password_confirmation"
                           type="password"
                           required
                           autocomplete="new-password"
                           minlength="8">
                </div>
            </div>

            <div class="mt-6 rounded-md shadow-sm">
                <x-button class="w-full">Create Account</x-button>
            </div>
        </form>
    </x-panel>
</article>
@endsection
