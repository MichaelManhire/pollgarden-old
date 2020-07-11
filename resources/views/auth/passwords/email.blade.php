@extends('layouts.app')

@section('title', 'Password Reset Request')

@section('content')
@if (session('status'))
    <x-alert>
        {{ session('status') }}
    </x-alert>
@endif

<article class="max-w-md mx-auto">
    <x-form-header>
        <x-slot name="title">Reset Your Password</x-slot>

        If you have an email address associated with your account, then we'll send you an email containing instructions to reset your password.
    </x-form-header>

    <x-panel class="px-4 sm:px-10 py-8 mt-8">
        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div>
                <label class="block text-sm font-medium leading-tight" for="email">Email</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <input class="form-input block w-full @error('email') border-red-300 text-red-900 @enderror"
                           id="email"
                           name="email"
                           type="text"
                           value="{{ old('email') }}"
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

            <div class="mt-6 rounded-md shadow-sm">
                <x-button class="w-full">Send Password Reset Link</x-button>
            </div>
        </form>
    </x-panel>
</article>
@endsection
