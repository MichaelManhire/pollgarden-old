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
                        <img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Poll Garden') }}" width="32" height="32" loading="lazy">
                        <span class="hidden sm:block sm:ml-1">{{ config('app.name', 'Poll Garden') }}</span>
                    </span>
                @else
                    <a class="flex-shrink-0 flex items-center text-xl font-medium leading-none" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Poll Garden') }}" width="32" height="32" loading="lazy">
                        <span class="hidden sm:block sm:ml-1">{{ config('app.name', 'Poll Garden') }}</span>
                    </a>
                @endif

                <ul class="flex md:ml-2">
                    @can('create', App\Poll::class)
                        <li>
                            <a class="py-2 px-3 ml-2 text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md" href="{{ route('polls.create') }}">Create Poll</a>
                        </li>
                    @endcan
                    <li>
                        <a class="py-2 px-3 ml-2 text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md" href="{{ route('polls.index') }}">View Polls</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center">
                @guest
                    <ul class="flex md:ml-2">
                        <li>
                            <a class="py-2 px-3 ml-2 text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md" href="{{ route('login') }}">Log In</a>
                        </li>
                        <li>
                            <a class="py-2 px-3 ml-2 text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    </ul>
                @else
                    <a class="flex-shrink-0 ml-3 text-gray-400 hover:text-gray-500" href="">
                        @include('icons.notifications')
                        <span class="sr-only">Notifications</span>
                    </a>
                    <a class="flex-shrink-0 ml-3 text-white" href="{{ route('users.show', Auth::user()) }}">
                        @include('_avatar', ['imageSrc' => Auth::user()->avatar, 'height' => 32, 'width' => 32, 'username' => Auth::user()->username])
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
                                <a class="block p-2 text-base font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="{{ route('polls.create') }}">Create New Poll</a>
                            </li>
                        @endcan
                        <li class="block mt-1">
                            <a class="block p-2 text-base font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="{{ route('polls.index') }}">View Polls</a>
                        </li>
                        @guest
                            <li class="block mt-1">
                                <a class="block p-2 text-base font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="{{ route('login') }}">Log In</a>
                            </li>
                            <li class="block mt-1">
                                <a class="block p-2 text-base font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="{{ route('register') }}">Create an Account</a>
                            </li>
                        @else
                            <li class="block mt-1">
                                <a class="block p-2 text-base font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="">Notifications</a>
                            </li>
                            <li class="block mt-1">
                                <a class="block p-2 text-base font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="">Messages</a>
                            </li>
                            <li class="block mt-1">
                                <a class="block p-2 text-base font-medium leading-6 text-gray-600 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50" href="{{ route('users.edit', Auth::user()) }}">Edit Profile</a>
                            </li>
                        @endguest
                    </ul>
                </nav>

                @auth
                    <a class="group flex items-center mt-12 text-white" href="{{ route('users.show', Auth::user()) }}">
                        <div>
                            @include('_avatar', ['imageSrc' => Auth::user()->avatar, 'height' => 42, 'width' => 42, 'username' => Auth::user()->username])
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
