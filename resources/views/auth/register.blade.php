@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <div class="text-center">
        <img class="mx-auto" src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Poll Garden') }}" height="64" width="64">
        <h1 class="mt-4 text-3xl leading-9 font-extrabold">{{ __('Sign up for a new account') }}</h1>
        <p class="mt-2 text-sm leading-5 text-gray-600">{{ __('Registering an account allows you to create polls, vote in polls, share your opinions, message other users, and more.') }}</p>
    </div>
    <form class="px-4 py-8 mt-8 bg-white shadow sm:px-10 sm:rounded-lg" action="{{ route('register') }}" method="POST">
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

<!--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
@endsection
