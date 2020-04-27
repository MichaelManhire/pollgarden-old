<!doctype html>
<html class="h-full text-gray-900" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="flex flex-col h-full">
    <header class="py-4 bg-gray-100 border-b border-gray-200">
        <div class="container md:flex md:justify-between md:items-center">
            <a class="flex justify-center items-center mb-2 text-xl leading-none md:justify-start md:mb-0" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Laravel') }}" height="40" width="40"><span>{{ config('app.name', 'Laravel') }}</span>
            </a>
            <nav>
                <ul class="flex justify-center md:justify-around">
                    <li class="mr-8">
                        <a class="hover:text-green-600 hover:underline focus:text-green-600 focus:underline"
                           href="">
                            {{ __('Create Poll') }}
                        </a>
                    </li>
                    <li class="mr-8">
                        <a class="hover:text-green-600 hover:underline focus:text-green-600 focus:underline"
                           href="">
                            {{ __('View Polls') }}
                        </a>
                    </li>
                    @guest
                        <li class="mr-8">
                            <a class="hover:text-green-600 hover:underline focus:text-green-600 focus:underline"
                               href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </li>
                        <li>
                            <a class="hover:text-green-600 hover:underline focus:text-green-600 focus:underline"
                               href="{{ route('register') }}">
                                {{ __('Signup') }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a class="hover:text-green-600 hover:underline focus:text-green-600 focus:underline"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </nav>
        </div>
    </header>

    <main class="flex-grow flex-shrink-0 my-12">
        @yield('content')
    </main>

    <footer class="flex-shrink-0 py-4 text-sm bg-green-100 border-t border-green-200">
        <div class="container md:flex md:justify-between md:items-center">
            <ul class="flex justify-center mb-2 md:justify-around md:mb-0">
                <li class="mr-8">
                    <a class="hover:underline focus:underline" href="{{ url('/terms-of-use') }}">{{ __('Terms of Use') }}</a>
                </li>
                <li>
                    <a class="hover:underline focus:underline" href="{{ url('/privacy-policy') }}">{{ __('Privacy Policy') }}</a>
                </li>
            </ul>
            <small class="block text-center text-sm md:text-left">&copy; {{ __('Copyright') }} {{ now()->year }} {{ config('app.name', 'Laravel') }}</small>
        </div>
    </footer>
</body>
</html>
