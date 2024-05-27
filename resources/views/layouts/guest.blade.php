<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans flex items-center bg-gray-100 text-gray-900 antialiased">
    <div class="w-[50%] px-5 py-5 ">
        {{-- methode 1 --}}

        {{-- @if (Request::url() === 'http://127.0.0.1:8000/login')
        <div class='login_bg'></div>
        @else
            <div class='register_bg'></div>
            @endif --}}

        {{-- methode 2 --}}

        @if (Request::is('login'))
            <div class='login_bg'></div>
        @else
            <div class='register_bg'></div>
        @endif

    </div>
    <div
        class="min-h-screen w-[50%] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <a href="/">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                <img width="200" src="{{ asset('images/rental_logo_blue.png') }}" alt="">
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
