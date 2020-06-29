@extends('layouts.app')

@section('title', 'Password Reset Request')

@section('content')
@if (session('status'))
    <aside class="p-4 mb-4 bg-blue-50 rounded-md" role="alert">
        <div class="flex">
            <div class="flex-shrink-0 text-blue-400">
                @include('icons.checkmark', ['width' => '20', 'height' => '20'])
            </div>
            <div class="ml-3">
                <h2 class="text-sm font-medium leading-5 text-blue-800">Success</h2>
                <div class="mt-2 text-sm leading-5 text-blue-700">
                    <p>{{ session('status') }}</p>
                </div>
            </div>
        </div>
    </aside>
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
