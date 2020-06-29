@extends('layouts.app')

@section('title', 'Password Reset')

@section('content')
<article class="max-w-md mx-auto">
    <x-form-header>
        <x-slot name="title">Reset Your Password</x-slot>

        Please update your password to something new below.
    </x-form-header>

    <x-panel class="px-4 sm:px-10 py-8 mt-8">
        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label class="block text-sm font-medium leading-tight" for="email">Email</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <input class="form-input block w-full @error('email') border-red-300 text-red-900 @enderror"
                           id="email"
                           name="email"
                           type="email"
                           required
                           autocomplete="email"
                           autofocus
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

            <div class="mt-6">
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

            <div class="mt-6">
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
                <x-button class="w-full">Reset Password</x-button>
            </div>
        </form>
    </x-panel>
</article>
@endsection
