<!doctype html>
<html class="h-full text-gray-900" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Poll Garden') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="flex flex-col h-full">
    <header class="text-gray-200 bg-gray-800">
        <div class="container flex items-center justify-between h-16">
            <div class="flex items-center">
                <a class="flex justify-start items-center flex-shrink-0 text-xl leading-none hover:text-white" href="{{ url('/') }}">
                    <img class="block h-8 w-auto" src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Poll Garden') }}" height="32" width="32">
                    <span class="hidden sm:block sm:ml-1">{{ config('app.name', 'Poll Garden') }}</span>
                </a>

                <div class="ml-2 sm:ml-6">
                    <nav class="flex">
                        <a class="px-3 py-2 rounded-md text-sm font-medium leading-5 hover:text-white hover:bg-gray-700" href="#">
                            {{ __('Create Poll') }}
                        </a>
                        <a class="sm:ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 hover:text-white hover:bg-gray-700" href="#">
                            {{ __('View Polls') }}
                        </a>
                    </nav>
                </div>
            </div>
            <div class="ml-2 sm:ml-6">
                <div class="flex items-center">
                    @guest
                        <div class="flex-shrink-0">
                            <span class="rounded-md shadow-sm">
                                <a class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-50" href="{{ route('login') }}">
                                    {{ __('Log In') }}
                                </a>
                            </span>
                        </div>

                        <div class="ml-4 flex-shrink-0">
                            <span class="rounded-md shadow-sm">
                                <a class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-500" href="{{ route('register') }}">
                                    {{ __('Sign Up') }}
                                </a>
                            </span>
                        </div>

                    @else
                        <a class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-white" href="#">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="sr-only">{{ __('Notifications') }}</span>
                        </a>

                        <div class="ml-3">
                            <div>
                                <a class="block border-2 border-transparent rounded-full hover:border-gray-200" href="#">
                                    <img class="h-8 w-8 rounded-full" src="https://source.unsplash.com/64x64/" alt="" height="32" width="32">
                                    <span class="sr-only">{{ __('Profile') }}</span>
                                </a>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow flex-shrink-0 my-12">
        @yield('content')
    </main>

    <footer class="flex-shrink-0 py-4 text-sm text-gray-500 bg-white border-t border-gray-100">
        <div class="container md:flex md:justify-between md:items-center">
            <ul class="flex justify-center mb-2 md:justify-around md:mb-0">
                <li>
                    <a class="hover:text-gray-700 hover:underline" href="{{ url('/terms-of-use') }}">
                        {{ __('Terms of Use') }}
                    </a>
                </li>
                <li class="ml-8">
                    <a class="hover:text-gray-700 hover:underline" href="{{ url('/privacy-policy') }}">
                        {{ __('Privacy Policy') }}
                    </a>
                </li>
            </ul>
            <small class="block text-center text-sm md:text-left">&copy; {{ __('Copyright') }} {{ now()->year }} {{ config('app.name', 'Poll Garden') }}</small>
        </div>
    </footer>
</body>
</html>
