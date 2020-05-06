<!doctype html>
<html class="h-full text-gray-900 bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Poll Garden'))</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://rsms.me/inter/inter.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="flex flex-col h-full">
    <header class="sticky top-0 bg-white shadow-sm">
        <div class="container flex justify-between h-16">
            <div class="flex">
                @if (Request::is('/'))
                    <h1 class="flex-shrink-0 flex items-center text-xl font-medium leading-none">
                        <img class="block h-8 w-auto" src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Poll Garden') }}" height="32" width="32">
                        <span class="hidden sm:block sm:ml-1">{{ config('app.name', 'Poll Garden') }}</span>
                    </h1>
                @else
                    <a class="flex-shrink-0 flex items-center text-xl font-medium leading-none" href="{{ url('/') }}">
                        <img class="block h-8 w-auto" src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Poll Garden') }}" height="32" width="32">
                        <span class="hidden sm:block sm:ml-1">{{ config('app.name', 'Poll Garden') }}</span>
                    </a>
                @endif

                <nav class="flex ml-6" aria-label="Primary navigation">
                    <ul class="flex">
                        <li class="flex">
                            @if (url()->current() === route('polls.create'))
                                <span class="flex items-center px-1 pt-1 border-b-2 border-green-500 text-sm font-medium leading-5 text-gray-900" aria-current="true">
                                    {{ __('Create Poll') }}
                                </span>
                            @else
                                <a class="flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:border-gray-300 hover:text-gray-700" href="{{ route('polls.create') }}">
                                    {{ __('Create Poll') }}
                                </a>
                            @endif
                        </li>
                        <li class="flex">
                            @if (url()->current() === route('polls.index'))
                                <span class="flex items-center px-1 pt-1 ml-8 border-b-2 border-green-500 text-sm font-medium leading-5 text-gray-900" aria-current="true">
                                    {{ __('View Polls') }}
                                </span>
                            @else
                                <a class="flex items-center px-1 pt-1 ml-8 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:border-gray-300 hover:text-gray-700" href="{{ route('polls.index') }}">
                                    {{ __('View Polls') }}
                                </a>
                            @endif
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="flex items-center ml-6">
                @guest
                    <div class="flex-shrink-0">
                        <a class="flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-50" href="{{ route('login') }}">
                            {{ __('Log In') }}
                        </a>
                    </div>

                    <div class="ml-4 flex-shrink-0">
                        <a class="flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-500" href="{{ route('register') }}">
                            {{ __('Sign Up') }}
                        </a>
                    </div>

                @else
                    <div class="flex-shrink-0">
                        <a class="text-gray-400 hover:text-gray-500" href="#" title="{{ __('Notifications') }}">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="sr-only">{{ __('Notifications') }}</span>
                        </a>
                    </div>

                    <div class="flex-shrink-0 ml-3 text-white">
                        <a class="block rounded-full shadow-solid" href="{{ route('users.show', Auth::user()) }}" title="{{ __('My Profile') }}">
                            <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->avatar }}" alt="" height="32" width="32">
                            <span class="sr-only">{{ __('Profile') }}</span>
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <main class="flex-grow flex-shrink-0 container py-12">
        @yield('content')
    </main>

    <footer class="flex-shrink-0 py-4 text-sm text-white bg-gray-900">
        <div class="container flex justify-between items-center">
            <ul class="flex justify-around">
                <li>
                    <a class="hover:underline" href="{{ url('/terms-of-use') }}">{{ __('Terms of Use') }}</a>
                </li>
                <li class="ml-8">
                    <a class="hover:underline" href="{{ url('/privacy-policy') }}">{{ __('Privacy Policy') }}</a>
                </li>
            </ul>
            <small class="text-left text-sm">&copy; {{ __('Copyright') . ' ' . now()->year . ' ' . config('app.name', 'Poll Garden') }}</small>
        </div>
    </footer>
</body>
</html>
