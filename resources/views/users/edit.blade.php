@extends('layouts.app')

@section('title', 'Edit Your Profile')

@section('content')
<article>
    <h1 class="sr-only">Edit Your Profile</h1>

    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <x-panel class="px-4 py-5 sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h2 class="text-lg font-medium leading-6">Profile Details</h2>
                    <p class="mt-1 text-sm leading-5 text-gray-500">These details will be displayed on your profile page. Everything is optional.</p>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div>
                        <label class="block text-sm font-medium leading-tight" for="avatar">Avatar</label>
                        <div class="mt-1.5">
                            <div class="inline-block align-middle mr-4 text-white">
                                <x-avatar :src="$user->getAvatar()" />
                            </div>

                            <input class="inline-block align-middle @error('avatar') border-red-300 text-red-900 @enderror"
                                id="avatar"
                                name="avatar"
                                type="file"
                                accept="image/*"
                                @error('avatar')
                                aria-invalid="true"
                                aria-describedby="avatar-error"
                                @enderror>
                        </div>
                        @error('avatar')
                            <p class="mt-2 text-sm text-red-600" id="avatar-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium leading-tight" for="description">Short Description</label>
                        <div class="mt-1.5 rounded-md shadow-sm">
                            <textarea class="form-input block w-full @error('description') border-red-300 text-red-900 @enderror"
                                      id="description"
                                      name="description"
                                      rows="5"
                                      autocomplete="off"
                                      maxlength="300"
                                      @error('description')
                                      aria-invalid="true"
                                      aria-describedby="description-error"
                                      @enderror>{{ $user->description }}</textarea>
                        </div>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600" id="description-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium leading-tight" for="age">Age</label>
                        <div class="mt-1.5 rounded-md shadow-sm">
                            <input class="form-input block w-full @error('age') border-red-300 text-red-900 @enderror"
                                id="age"
                                name="age"
                                type="number"
                                value="{{ $user->age }}"
                                autocomplete="off"
                                min="13"
                                max="99"
                                @error('age')
                                aria-invalid="true"
                                aria-describedby="age-error"
                                @enderror>
                        </div>
                        @error('age')
                            <p class="mt-2 text-sm text-red-600" id="age-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium leading-tight" for="gender_id">Gender</label>
                        <div class="mt-1.5 rounded-md shadow-sm">
                            <select class="form-select block w-full @error('gender_id') border-red-300 text-red-900 @enderror"
                                    id="gender_id"
                                    name="gender_id"
                                    autocomplete="off"
                                    @error('gender_id')
                                    aria-invalid="true"
                                    aria-describedby="gender-error"
                                    @enderror>
                                    <option value="">Please select a gender</option>
                                @foreach ($genders as $gender)
                                    <option value="{{ $gender->id }}" {{ $user->gender_id == $gender->id ? 'selected' : '' }}>{{ $gender->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('gender_id')
                            <p class="mt-2 text-sm text-red-600" id="gender-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ countryId: {{ $user->country_id ? $user->country_id : 0 }} }">
                        <div class="mt-4">
                            <label class="block text-sm font-medium leading-tight" for="country_id">Country</label>
                            <div class="mt-1.5 rounded-md shadow-sm">
                                <select class="form-select block w-full @error('country_id') border-red-300 text-red-900 @enderror"
                                        id="country_id"
                                        name="country_id"
                                        autocomplete="off"
                                        @error('country_id')
                                        aria-invalid="true"
                                        aria-describedby="country-error"
                                        @enderror
                                        x-model="countryId">
                                    <option value="">Please select a country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ $user->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('gender_id')
                                <p class="mt-2 text-sm text-red-600" id="gender-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4" x-show="countryId == 1">
                            <label class="block text-sm font-medium leading-tight" for="state_id">State</label>
                            <div class="mt-1.5 rounded-md shadow-sm">
                                <select class="form-select block w-full @error('state_id') border-red-300 text-red-900 @enderror"
                                        id="state_id"
                                        name="state_id"
                                        autocomplete="off"
                                        @error('state_id')
                                        aria-invalid="true"
                                        aria-describedby="state-error"
                                        @enderror>
                                    <option value="">Please select a state</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" {{ $user->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('gender_id')
                                <p class="mt-2 text-sm text-red-600" id="gender-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </x-panel>

        <div class="flex justify-end mt-6">
            <x-button>Save Profile Details</x-button>
        </div>
    </form>

    <form class="mt-8" action="{{ route('users.settings.update', $user) }}" method="POST">
        @csrf
        @method('PATCH')

        <x-panel class="px-4 py-5 sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h2 class="text-lg font-medium leading-6">Account Info</h2>
                    <p class="mt-1 text-sm leading-5 text-gray-500">In case you need to update it...</p>
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

                    <div class="mt-4">
                        <label class="block text-sm font-medium leading-tight" for="email">Email</label>
                        <div class="mt-1.5 rounded-md shadow-sm">
                            <input class="form-input block w-full @error('email') border-red-300 text-red-900 @enderror"
                                   id="email"
                                   name="email"
                                   type="email"
                                   value="{{ $user->email }}"
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

                    <div class="mt-4">
                        <label class="block text-sm font-medium leading-tight" for="password">New Password</label>
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

                    <div class="mt-4">
                        <label class="block text-sm font-medium leading-tight" for="password-confirm">Confirm New Password</label>
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
            <x-button>Save Account Settings</x-button>
        </div>
    </form>

    <form class="mt-8" action="{{ route('users.destroy', $user) }}" method="POST" x-data x-on:submit.prevent="if (confirm('Are you sure you want to delete your account?')) { $el.submit() }">
        @csrf
        @method('DELETE')

        <x-panel class="px-4 py-5 sm:p-6">
            <h2 class="text-lg font-medium leading-6">Deleting Your Account</h2>
            <p class="mt-2 text-sm">If you'd like to delete your account, please click the button below. After your account has been deleted, other users will no longer be able to access your profile page and you will no longer be able to log in.</p>
            <div class="flex justify-end mt-6">
                <button class="py-2 px-4 text-sm font-medium leading-5 text-white border-1 border-transparent rounded-md bg-red-600 hover:bg-red-500 transition-colors duration-150 ease-in-out" type="submit">Delete Your Account</button>
            </div>
        </x-panel>
    </form>
</article>
@endsection
