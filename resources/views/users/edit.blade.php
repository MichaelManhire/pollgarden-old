@extends('layouts.app')

@section('title', 'Edit Your Profile')

@section('content')
<article>
    <h1 class="sr-only">Edit Your Profile</h1>
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PATCH')

        <x-panel class="px-4 py-5 sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h2 class="text-lg font-medium leading-6">Account Info</h2>
                    <p class="mt-1 text-sm leading-5 text-gray-500">Some line of text.</p>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div>
                        <label class="block text-sm font-medium leading-tight" for="username">Username</label>
                        <div class="mt-1.5 rounded-md shadow-sm">
                            <input class="form-input block w-full @error('username') border-red-300 text-red-900 @enderror"
                                   id="username"
                                   name="username"
                                   type="text"
                                   value="{{ $user->username }}"
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
                        <label class="block text-sm font-medium leading-tight" for="email">Email</label>
                        <div class="mt-1.5 rounded-md shadow-sm">
                            <input class="form-input block w-full @error('email') border-red-300 text-red-900 @enderror"
                                   id="email"
                                   name="email"
                                   type="email"
                                   value="{{ $user->email }}"
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

                    <div class="mt-6">
                        <label class="block text-sm font-medium leading-tight" for="password">Password</label>
                        <div class="mt-1.5 rounded-md shadow-sm">
                            <input class="form-input block w-full @error('password') border-red-300 text-red-900 @enderror"
                                   id="password"
                                   name="password"
                                   type="password"
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
                            <input class="form-input block w-full @error('password-confirm') border-red-300 text-red-900 @enderror"
                                   id="password-confirm"
                                   name="password_confirmation"
                                   type="password"
                                   autocomplete="new-password"
                                   minlength="8"
                                   @error('password-confirm')
                                   aria-invalid="true"
                                   aria-describedby="password-confirm-error"
                                   @enderror>
                        </div>
                        @error('password-confirm')
                            <p class="mt-2 text-sm text-red-600" id="password-confirm-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </x-panel>

        <div class="flex justify-end mt-6">
            <button class="py-2 px-4 text-sm font-medium leading-5 text-white border-1 border-transparent rounded-md bg-green-600 hover:bg-green-500" type="submit">
                Save Profile
            </button>
        </div>
    </form>
</article>
@endsection
