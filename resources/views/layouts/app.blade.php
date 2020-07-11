<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title') - Poll Garden</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#3f9142">
    <meta name="theme-color" content="#ffffff">

    <script src="{{ mix('/js/app.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body class="text-gray-900 bg-offwhite">
    {{-- Mobile Navigation --}}
    <div class="sticky top-0 z-20 lg:hidden bg-white shadow-sm">
        <div class="container flex justify-between h-16">
            <div class="flex items-center">
                @if (Request::is('/'))
                    <span class="flex-shrink-0 flex items-center text-xl font-medium leading-none">
                        <img src="{{ asset('images/logo.svg') }}" alt="Poll Garden" width="24" height="24" loading="lazy">
                        <span class="hidden sm:block sm:ml-2.5">Poll Garden</span>
                    </span>
                @else
                    <a class="flex-shrink-0 flex items-center text-xl font-medium leading-none" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.svg') }}" alt="Poll Garden" width="24" height="24" loading="lazy">
                        <span class="hidden sm:block sm:ml-2.5">Poll Garden</span>
                    </a>
                @endif

                <ul class="flex ml-2">
                    @can('create', App\Poll::class)
                        @if (url()->current() === route('polls.create'))
                            <li aria-current="page">
                                <span class="py-1 sm:py-2 px-2 sm:px-3 ml-1 sm:ml-2 text-xs sm:text-sm font-medium leading-5 text-green-600 bg-green-50 rounded-md">Create <span class="hidden sm:inline">Poll</span></span>
                            </li>
                        @else
                            <li>
                                <a class="py-1 sm:py-2 px-2 sm:px-3 ml-1 sm:ml-2 text-xs sm:text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md" href="{{ route('polls.create') }}">Create <span class="hidden sm:inline">Poll</span></a>
                            </li>
                        @endif
                    @endcan
                    @if (url()->current() === route('polls.index'))
                        <li aria-current="page">
                            <span class="py-1 sm:py-2 px-2 sm:px-3 ml-1 sm:ml-2 text-xs sm:text-sm font-medium leading-5 text-green-600 bg-green-50 rounded-md">View <span class="@auth hidden sm:inline @endauth">Polls</span></span>
                        </li>
                    @else
                        <li>
                            <a class="py-1 sm:py-2 px-2 sm:px-3 ml-1 sm:ml-2 text-xs sm:text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md" href="{{ route('polls.index') }}">View <span class="@auth hidden sm:inline @endauth">Polls</span></a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="flex items-center">
                @guest
                    <ul class="flex sm:ml-2">
                        @if (url()->current() === route('login'))
                            <li aria-current="page">
                                <span class="py-1 sm:py-2 px-2 sm:px-3 ml-1 sm:ml-2 text-xs sm:text-sm font-medium leading-5 text-green-600 bg-green-50 rounded-md">Log In</span>
                            </li>
                        @else
                            <li>
                                <a class="py-1 sm:py-2 px-2 sm:px-3 ml-1 sm:ml-2 text-xs sm:text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md" href="{{ route('login') }}">Log In</a>
                            </li>
                        @endif
                        @if (url()->current() === route('register'))
                            <li aria-current="page">
                                <span class="py-1 sm:py-2 px-2 sm:px-3 ml-1 sm:ml-2 text-xs sm:text-sm font-medium leading-5 text-green-600 bg-green-50 rounded-md">Sign Up</span>
                            </li>
                        @else
                            <li>
                                <a class="py-1 sm:py-2 px-2 sm:px-3 ml-1 sm:ml-2 text-xs sm:text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md" href="{{ route('register') }}">Sign Up</a>
                            </li>
                        @endif
                    </ul>
                @else
                    @if (url()->current() === route('conversations.index'))
                        <span class="flex-shrink-0 ml-3 sm:ml-4 text-green-400">
                            @include('icons.message', ['width' => '24', 'height' => '24'])
                            <span class="sr-only">Messages</span>
                        </span>
                    @else
                        <a class="flex-shrink-0 ml-3 sm:ml-4 text-gray-400 hover:text-gray-500" href="{{ route('conversations.index') }}">
                            @include('icons.message', ['width' => '24', 'height' => '24'])
                            <span class="sr-only">Messages</span>
                        </a>
                    @endif

                    @if (url()->current() === route('notifications'))
                        <span class="flex-shrink-0 ml-3 sm:ml-4 text-green-400">
                            @include('icons.notifications', ['width' => '24', 'height' => '24'])
                            <span class="sr-only">Notifications</span>
                        </span>
                    @else
                        @if (Auth::user()->unreadNotifications->count())
                            <a class="relative flex-shrink-0 ml-3 sm:ml-4 text-purple-400 hover:text-purple-500" href="{{ route('notifications') }}">
                                @include('icons.notifications', ['width' => '24', 'height' => '24'])
                                <span class="sr-only">Notifications</span>
                                <span class="absolute text-center text-xs font-medium text-purple-700 bg-purple-100 rounded-full notifications-counter">
                                    {{ Auth::user()->unreadNotifications->count() }}
                                </span>
                            </a>
                        @else
                            <a class="flex-shrink-0 ml-3 sm:ml-4 text-gray-400 hover:text-gray-500" href="{{ route('notifications') }}">
                                @include('icons.notifications', ['width' => '24', 'height' => '24'])
                                <span class="sr-only">Notifications</span>
                            </a>
                        @endif
                    @endif
                    <a class="flex-shrink-0 ml-3 sm:ml-4 text-white" href="{{ route('users.show', Auth::user()) }}">
                        <x-avatar :src="Auth::user()->getAvatar()" width="32" height="32" />
                        <span class="sr-only">Profile</span>
                    </a>

                    <div class="relative flex-shrink-0 h-6 ml-2 sm:ml-3" x-data="{ isShown: false }">
                        <button class="text-gray-400 hover:text-gray-500" type="button" @click="isShown = ! isShown" @click.away="isShown = false">
                            @include('icons.more', ['width' => '24', 'height' => '24'])
                            <span class="sr-only">More Items</span>
                        </button>
                        <div class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg" x-show="isShown">
                            <div class="rounded-md bg-white shadow-xs">
                                <div class="py-1">
                                    <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900" href="{{ route('users.edit', Auth::user()) }}">Settings</a>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf

                                        <button class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900" type="submit">Log Out</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>

    {{-- Desktop Navigation --}}
    <div class="flex container py-8 lg:py-12 main-content">
        <header class="hidden lg:inline-block min-w-1/5 mr-6">
            <x-panel class="p-4">
                @if (Request::is('/'))
                    <h1 class="flex items-center text-xl font-medium leading-none">
                        <img src="{{ asset('images/logo.svg') }}" alt="Poll Garden" width="32" height="32" loading="lazy">
                        <span class="hidden sm:block sm:ml-2.5">Poll Garden</span>
                    </h1>
                @else
                    <a class="flex items-center text-xl font-medium leading-none" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.svg') }}" alt="Poll Garden" width="32" height="32" loading="lazy">
                        <span class="hidden sm:block sm:ml-2.5">Poll Garden</span>
                    </a>
                @endif

                <nav class="mt-4" aria-label="Primary navigation">
                    <ul>
                        @can('create', App\Poll::class)
                            @if (url()->current() === route('polls.create'))
                                <li class="block mt-1" aria-current="page">
                                    <span class="flex items-center p-2 text-sm font-medium leading-6 text-green-600 rounded-md bg-green-50">
                                        <div class="mr-2 text-green-400">
                                            @include('icons.create', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Create New Poll
                                    </span>
                                </li>
                            @else
                                <li class="block mt-1">
                                    <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-700 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50 transition-colors duration-150 ease-in-out" href="{{ route('polls.create') }}">
                                        <div class="mr-2 text-gray-500 group-hover:text-gray-600 transition-colors duration-150 ease-in-out">
                                            @include('icons.create', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Create New Poll
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @if (url()->current() === route('polls.index'))
                            <li class="block mt-1" aria-current="page">
                                <span class="flex items-center p-2 text-sm font-medium leading-6 text-green-600 rounded-md bg-green-50">
                                    <div class="mr-2 text-green-400">
                                        @include('icons.poll', ['width' => '20', 'height' => '20'])
                                    </div>
                                    View Polls
                                </span>
                            </li>
                        @else
                            <li class="block mt-1">
                                <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-700 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50 transition-colors duration-150 ease-in-out" href="{{ route('polls.index') }}">
                                    <div class="mr-2 text-gray-500 group-hover:text-gray-600 transition-colors duration-150 ease-in-out">
                                        @include('icons.poll', ['width' => '20', 'height' => '20'])
                                    </div>
                                    View Polls
                                </a>
                            </li>
                        @endif
                        @guest
                            @if (url()->current() === route('login'))
                                <li class="block mt-1" aria-current="page">
                                    <span class="flex items-center p-2 text-sm font-medium leading-6 text-green-600 rounded-md bg-green-50">
                                        <div class="mr-2 text-green-400">
                                            @include('icons.login', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Log In
                                    </span>
                                </li>
                            @else
                                <li class="block mt-1">
                                    <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-700 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50 transition-colors duration-150 ease-in-out" href="{{ route('login') }}">
                                        <div class="mr-2 text-gray-500 group-hover:text-gray-600 transition-colors duration-150 ease-in-out">
                                            @include('icons.login', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Log In
                                    </a>
                                </li>
                            @endif
                            @if (url()->current() === route('register'))
                                <li class="block mt-1" aria-current="page">
                                    <span class="flex items-center p-2 text-sm font-medium leading-6 text-green-600 rounded-md bg-green-50">
                                        <div class="mr-2 text-green-400">
                                            @include('icons.signup', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Create an Account
                                    </span>
                                </li>
                            @else
                                <li class="block mt-1">
                                    <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-700 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50 transition-colors duration-150 ease-in-out" href="{{ route('register') }}">
                                        <div class="mr-2 text-gray-500 group-hover:text-gray-600 transition-colors duration-150 ease-in-out">
                                            @include('icons.signup', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Create an Account
                                    </a>
                                </li>
                            @endif
                        @else
                            @if (url()->current() === route('notifications'))
                                <li class="block mt-1" aria-current="page">
                                    <span class="group flex items-center p-2 text-sm font-medium leading-6 text-green-600 rounded-md bg-green-50">
                                        <div class="mr-2 text-green-400">
                                            @include('icons.notifications', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Notifications
                                    </span>
                                </li>
                            @else
                                @if (Auth::user()->unreadNotifications->count())
                                    <li class="block mt-1">
                                        <a class="group flex items-center p-2 text-sm font-medium leading-6 text-purple-500 hover:text-purple-600 rounded-md bg-purple-100 hover:bg-purple-50 transition-colors duration-150 ease-in-out" href="{{ route('notifications') }}">
                                            <div class="mr-2 text-purple-400 group-hover:text-purple-500 transition-colors duration-150 ease-in-out">
                                                @include('icons.notifications', ['width' => '20', 'height' => '20'])
                                            </div>
                                            Notifications
                                            <span class="inline-block py-0.5 px-3 ml-auto text-xs leading-4 rounded-full">
                                                {{ Auth::user()->unreadNotifications->count() }}
                                            </span>
                                        </a>
                                    </li>
                                @else
                                    <li class="block mt-1">
                                        <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-700 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50 transition-colors duration-150 ease-in-out" href="{{ route('notifications') }}">
                                            <div class="mr-2 text-gray-500 group-hover:text-gray-600 transition-colors duration-150 ease-in-out">
                                                @include('icons.notifications', ['width' => '20', 'height' => '20'])
                                            </div>
                                            Notifications
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (url()->current() === route('conversations.index'))
                                <li class="block mt-1" aria-current="page">
                                    <span class="group flex items-center p-2 text-sm font-medium leading-6 text-green-600 rounded-md bg-green-50">
                                        <div class="mr-2 text-green-400">
                                            @include('icons.message', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Messages
                                    </span>
                                </li>
                            @else
                                <li class="block mt-1">
                                    <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-700 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50 transition-colors duration-150 ease-in-out" href="{{ route('conversations.index') }}">
                                        <div class="mr-2 text-gray-500 group-hover:text-gray-600 transition-colors duration-150 ease-in-out">
                                            @include('icons.message', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Messages
                                    </a>
                                </li>
                            @endif
                            @if (url()->current() === route('users.edit', Auth::user()))
                                <li class="block mt-1" aria-current="page">
                                    <span class="flex items-center p-2 text-sm font-medium leading-6 text-green-600 rounded-md bg-green-50">
                                        <div class="mr-2 text-green-400">
                                            @include('icons.settings', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Settings
                                    </span>
                                </li>
                            @else
                                <li class="block mt-1">
                                    <a class="group flex items-center p-2 text-sm font-medium leading-6 text-gray-700 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50 transition-colors duration-150 ease-in-out" href="{{ route('users.edit', Auth::user()) }}">
                                        <div class="mr-2 text-gray-500 group-hover:text-gray-600 transition-colors duration-150 ease-in-out">
                                            @include('icons.settings', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Settings
                                    </a>
                                </li>
                            @endif
                            <li class="block mt-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <button class="group flex items-center w-full p-2 text-sm font-medium leading-6 text-gray-700 hover:text-gray-900 rounded-md bg-gray-100 hover:bg-gray-50 transition-colors duration-150 ease-in-out" type="submit">
                                        <div class="mr-2 text-gray-500 group-hover:text-gray-600 transition-colors duration-150 ease-in-out">
                                            @include('icons.logout', ['width' => '20', 'height' => '20'])
                                        </div>
                                        Log Out
                                    </button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </nav>

                @auth
                    <a class="group flex items-center mt-12 text-white" href="{{ route('users.show', Auth::user()) }}">
                        <div>
                            <x-avatar :src="Auth::user()->getAvatar()" width="42" height="42" />
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
            @if (session('success'))
                <x-alert>
                    {{ session('success') }}
                </x-alert>
            @endif

            @yield('content')
        </main>
    </div>

    <footer class="text-sm border-t border-gray-50 bg-white footer">
        <div class="container flex justify-end py-2">
            <a class="text-green-600 hover:underline" href="{{ url('terms') }}">Terms of Use</a>
            <p class="ml-6 text-gray-600">Copyright &copy; {{ now()->year }} Poll Garden</p>
        </div>
    </footer>
</body>
</html>
