@extends('layouts.app')

@section('title', 'Password Reset')

@section('content')
<article class="max-w-md mx-auto">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <x-form-header>
        <x-slot name="title">Reset Your Password</x-slot>

        If you have an email address associated with your account, then we'll send you an email containing instructions to reset your password.
    </x-form-header>

    <x-panel class="px-4 sm:px-10 py-8 mt-8">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div>
                <label class="block text-sm font-medium leading-tight" for="email">Email</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <input class="form-input block w-full @error('email') border-red-300 text-red-900 @enderror"
                           id="email"
                           name="email"
                           type="text"
                           value="{{ old('email') }}"
                           autocomplete="email"
                           required
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
                <button class="w-full py-2 px-4 text-sm font-medium text-white border-1 border-transparent rounded-md bg-green-600 hover:bg-green-500" type="submit">Send Password Reset Link</button>
            </div>
        </form>
    </x-panel>
</article>
@endsection
