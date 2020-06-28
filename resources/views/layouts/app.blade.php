<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title') - Poll Garden</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="text-gray-900 bg-gray-100">
    {{-- Mobile Navigation --}}
    <div class="sticky top-0 z-10 lg:hidden bg-white shadow-sm">
        <div class="container flex justify-between h-16">
            <div class="flex items-center">
                @if (Request::is('/'))
                    <span class="flex-shrink-0 flex items-center text-xl font-medium leading-none">
                        <img src="{{ asset('images/logo.svg') }}" alt="Poll Garden" width="32" height="32" loading="lazy">
                        <span class="hidden sm:block sm:ml-1">Poll Garden</span>
                    </span>
                @else
                    <a class="flex-shrink-0 flex items-center text-xl font-medium leading-none" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.svg') }}" alt="Poll Garden" width="32" height="32" loading="lazy">
                        <span class="hidden sm:block sm:ml-1">Poll Garden</span>
                    </a>
                @endif

                <ul class="flex sm:ml-2">
                    @can('create', App\Poll::class)
                        <li>
                            @if (url()->current() === route('polls.create'))
                                <span class="py-2 px-3 ml-2 text-sm font-medium leading-5 text-green-600 bg-green-50 rounded-md">Create Poll</span>
                            @else
                                <a class="py-2 px-3 ml-2 text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md" href="{{ route('polls.create') }}">Create Poll</a>
                            @endif
                        </li>
                    @endcan
                    <li>
                        @if (url()->current() === route('polls.index'))
                            <span class="py-2 px-3 ml-2 text-sm font-medium leading-5 text-green-600 bg-green-50 rounded-md">View Polls</span>
                        @else
                            <a class="py-2 px-3 ml-2 text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md" href="{{ route('polls.index') }}">View Polls</a>
                        @endif
                    </li>
                </ul>
            </div>
            <div class="flex items-center">
                @guest
                    <ul class="flex sm:ml-2">
                        <li>
                            @if (url()->current() === route('login'))
                                <span class="py-2 px-3 ml-2 text-sm font-medium leading-5 text-green-600 bg-green-50 rounded-md">Log In</span>
                            @else
                                <a class="py-2 px-3 ml-2 text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md" href="{{ route('login') }}">Log In</a>
                            @endif
                        </li>
                        <li>
                            @if (url()->current() === route('register'))
                                <span class="py-2 px-3 ml-2 text-sm font-medium leading-5 text-green-600 bg-green-50 rounded-md">Sign Up</span>
                            @else
                                <a class="py-2 px-3 ml-2 text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md" href="{{ route('register') }}">Sign Up</a>
                            @endif
                        </li>
                    </ul>
                @else
                    <a class="flex-shrink-0 ml-3 text-gray-400 hover:text-gray-500" href="">
                        @include('icons.notifications', ['width' => '24', 'height' => '24'])
                        <span class="sr-only">Notifications</span>
                    </a>
                    <a class="flex-shrink-0 ml-3 text-white" href="{{ route('users.show', Auth::user()) }}">
                        <x-avatar :src="Auth::user()->avatar" width="32" height="32" />
                        <span class="sr-only">Profile</span>
                    </a>
                @endguest
            </div>
        </div>
    </div>

    {{-- Desktop Navigation --}}
    <div class="flex container py-12">
        <header class="hidden lg:inline-block min-w-1/5 mr-6">
            <x-panel class="p-4">
                @if (Request::is('/'))
                    <h1 class="flex items-center text-xl font-medium leading-none">
                        <img src="{{ asset('images/logo.svg') }}" alt="Poll Garden" width="42" height="42" loading="lazy">
                        <span class="hidden sm:block sm:ml-1">Poll Garden</span>
                    </h1>
                @else
                    <a class="flex items-center text-xl font-medium leading-none" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.svg') }}" alt="Poll Garden" width="42" height="42" loading="lazy">
                        <span class="hidden sm:block sm:ml-1">Poll Garden</span>
                    </a>
                @endif

                <nav class="mt-4" aria-label="Primary navigation">
                    <ul>
                        @can('create', App\Poll::class)
                            <li class="block mt-1">
                                @if (url()->current() === route('polls.create'))
                                    <span class="flex items-center p-2 text-sm font-medium leading-6 text-green-600 rounded-md bg-green-100">
                                        <div class="mr-2 text-green-400">
                                            @include('icons.create', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Create New Poll
                                    </span>
                                @else
                                    <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="{{ route('polls.create') }}">
                                        <div class="mr-2 text-gray-400 group-hover:text-gray-500">
                                            @include('icons.create', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Create New Poll
                                    </a>
                                @endif
                            </li>
                        @endcan
                        <li class="block mt-1">
                            @if (url()->current() === route('polls.index'))
                                <span class="flex items-center p-2 text-sm font-medium leading-6 text-green-600 rounded-md bg-green-100">
                                    <div class="mr-2 text-green-400">
                                        @include('icons.poll', ['width' => '20', 'height' => '20'])
                                    </div>
                                    View Polls
                                </span>
                            @else
                                <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="{{ route('polls.index') }}">
                                    <div class="mr-2 text-gray-400 group-hover:text-gray-500">
                                        @include('icons.poll', ['width' => '20', 'height' => '20'])
                                    </div>
                                    View Polls
                                </a>
                            @endif
                        </li>
                        @guest
                            <li class="block mt-1">
                                @if (url()->current() === route('login'))
                                    <span class="flex items-center p-2 text-sm font-medium leading-6 text-green-600 rounded-md bg-green-100">
                                        <div class="mr-2 text-green-400">
                                            @include('icons.login', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Log In
                                    </span>
                                @else
                                    <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="{{ route('login') }}">
                                        <div class="mr-2 text-gray-400 group-hover:text-gray-500">
                                            @include('icons.login', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Log In
                                    </a>
                                @endif
                            </li>
                            <li class="block mt-1">
                                @if (url()->current() === route('register'))
                                    <span class="flex items-center p-2 text-sm font-medium leading-6 text-green-600 rounded-md bg-green-100">
                                        <div class="mr-2 text-green-400">
                                            @include('icons.signup', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Create an Account
                                    </span>
                                @else
                                    <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="{{ route('register') }}">
                                        <div class="mr-2 text-gray-400 group-hover:text-gray-500">
                                            @include('icons.signup', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Create an Account
                                    </a>
                                @endif
                            </li>
                        @else
                            <li class="block mt-1">
                                <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="">
                                    <div class="mr-2 text-gray-400 group-hover:text-gray-500">
                                        @include('icons.notifications', ['width' => '20', 'height' => '20'])
                                    </div>
                                    Notifications
                                </a>
                            </li>
                            <li class="block mt-1">
                                <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="">
                                    <div class="mr-2 text-gray-400 group-hover:text-gray-500">
                                        @include('icons.message', ['width' => '20', 'height' => '20'])
                                    </div>
                                    Messages
                                </a>
                            </li>
                            <li class="block mt-1">
                                @if (url()->current() === route('users.edit', Auth::user()))
                                    <span class="flex items-center p-2 text-sm font-medium leading-6 text-green-600 rounded-md bg-green-100">
                                        <div class="mr-2 text-green-400">
                                            @include('icons.settings', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Settings
                                    </span>
                                @else
                                    <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="{{ route('users.edit', Auth::user()) }}">
                                        <div class="mr-2 text-gray-400 group-hover:text-gray-500">
                                            @include('icons.settings', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Settings
                                    </a>
                                @endif
                            </li>
                        @endguest
                    </ul>
                </nav>

                @auth
                    <a class="group flex items-center mt-12 text-white" href="{{ route('users.show', Auth::user()) }}">
                        <div>
                            <x-avatar :src="Auth::user()->avatar" width="42" height="42" />
                        </div>
                        <div class="ml-3">
                            <p class="text-base font-medium leading-6 text-gray-700 group-hover:text-gray-900">{{ Auth::user()->username }}</p>
                            <p class="text-sm font-medium leading-5 text-gray-500 group-hover:text-gray-700">View Profile</p>
                        </div>
                    </a>
                @endauth
            </x-panel>
        </header>

        <main class="flex-grow">
            @yield('content')
        </main>
    </div>
</body>
</html>
